<?php

namespace Iola\Api\Schema;

use Iola\Api\Contract\Schema\ContextInterface;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Executor\Executor;
use Iola\Api\Contract\Schema\IDFactoryInterface;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\IDType;
use Iola\Api\Contract\Schema\IDObjectInterface;
use GraphQL\Executor\Values;

class DefaultResolver extends AbstractResolver
{
    /**
     *
     * @var IDFactoryInterface
     */
    protected $idFactory;

    public function __construct(IDFactoryInterface $idFactory)
    {
        $this->idFactory = $idFactory;
    }

    protected function getFinalType($type)
    {
        return Type::getNamedType($type);
    }

    /**
     * Tries to resolve global id based on local id value and `type` directive information
     *
     * @param mixed $value
     * @param ResolveInfo $info
     * 
     * @return mixed
     */
    protected function resolveIDType($value, ResolveInfo $info)
    {
        $typeDirective = $info->schema->getDirective("type");

        if (!$typeDirective) {
            return $value;
        }

        $field = $info->parentType->getField($info->fieldName);
        $directiveValue = Values::getDirectiveValues($typeDirective, $field->astNode);

        if (!$directiveValue) {
            return $value;
        }

        return $this->idFactory->create($directiveValue["name"], $value);
    }

    protected function normalizeValue($value, ResolveInfo $info)
    {
        $finalType = $this->getFinalType($info->returnType);

        if ($finalType instanceof IDType && !$value instanceof IDObjectInterface) {
            return $this->resolveIDType($value, $info);
        }

        return $value;
    }

    public function resolve($root, $args, ContextInterface $context, ResolveInfo $info)
    {
        $value = Executor::defaultFieldResolver($root, $args, $context, $info);

        return $this->normalizeValue($value, $info);
    }
}
