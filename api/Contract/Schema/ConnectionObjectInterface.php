<?php

namespace Everywhere\Api\Contract\Schema;

use GraphQL\Executor\Promise\Promise;

interface ConnectionObjectInterface
{
    /**
     * @return mixed
     */
    public function getRoot();

    /**
     * @param mixed|null $arguments
     * @return Promise
     */
    public function getItems($arguments = null);

    /**
     * @param mixed|null $arguments
     * @return Promise
     */
    public function getCount($arguments = null);

    /**
     * @return mixed
     */
    public function getArguments();
}
