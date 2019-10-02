<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

namespace Iola\Api\Schema;

use Iola\Api\Contract\Schema\ConnectionObjectInterface;
use GraphQL\Error\InvariantViolation;
use GraphQL\Utils\Utils;

class ConnectionObject implements ConnectionObjectInterface
{
    protected $root;
    protected $arguments;
    protected $itemsGetter;
    protected $countGetter;
    protected $itemDecorator;

    public function __construct(
        $root,
        $arguments,
        callable $itemsGetter = null,
        callable $countGetter = null
    ) {
        $this->root = $root;
        $this->arguments = $arguments;
        $this->itemsGetter = $itemsGetter;
        $this->countGetter = $countGetter;
    }

    public function getItems($arguments = null)
    {
        $getter = $this->itemsGetter;

        if (!$getter) {
            throw new InvariantViolation(
                "Connection can not load items due to invalid loader: " . Utils::printSafe($getter)
            );
        }

        return $getter($arguments !== null ? $arguments : $this->arguments);
    }

    public function getCount($arguments = null)
    {
        $getter = $this->countGetter;

        if (!$getter) {
            throw new InvariantViolation(
                "Connection can not load items count due to invalid loader: " . Utils::printSafe($getter)
            );
        }

        return $getter($arguments !== null ? $arguments : $this->arguments);
    }

    public function getArguments()
    {
        return (array) $this->arguments;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function __toString()
    {
        return spl_object_hash($this);
    }
}
