<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

namespace Iola\Api\Schema\Resolvers;

use Iola\Api\Contract\Integration\UserRepositoryInterface;
use Iola\Api\Contract\Schema\ContextInterface;
use Iola\Api\Contract\Schema\DataLoaderFactoryInterface;
use Iola\Api\Contract\Schema\DataLoaderInterface;
use Iola\Api\Entities\User;
use Iola\Api\Schema\CompositeResolver;
use GraphQL\Type\Definition\ResolveInfo;

class UserInfoResolver extends CompositeResolver
{
    /**
     * @var DataLoaderInterface
     */
    protected $infoLoader;

    public function __construct(UserRepositoryInterface $userRepository, DataLoaderFactoryInterface $loaderFactory) {
        parent::__construct();

        $this->infoLoader = $loaderFactory->create(function($ids, $args, $context) use($userRepository) {
            return $userRepository->getInfo($ids, $args);
        });
    }

    /**
     * @param User $root
     * @param $fieldName
     * @param $args
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @return mixed
     */
    protected function resolveField($root, $fieldName, $args, ContextInterface $context, ResolveInfo $info)
    {
        return $this->infoLoader->load($root->getId(), [
            "name" => $fieldName
        ]);
    }
}
