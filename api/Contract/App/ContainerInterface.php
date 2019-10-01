<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

namespace Iola\Api\Contract\App;

use Psr\Container\ContainerInterface as PsrContainerInterface;
use Iola\Api\Contract\Integration\IntegrationInterface;
use Slim\Collection;

interface ContainerInterface extends PsrContainerInterface
{
    /**
     * @return IntegrationInterface
     */
    public function getIntegration();

    /**
     * @return Collection
     */
    public function getSettings();
}
