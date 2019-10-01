<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

namespace Iola\Api\Contract\Integration;

interface UserRepositoryInterface extends AuthRepositoryInterface
{
    /**
     * @param array $args
     * @return <User>
     */
    public function create($args);

    /**
     * @param string $userId
     * @return void
     */
    public function trackUserActivity($userId);

    /**
     * @param array $ids
     * @return array<User>
     */
    public function findByIds($ids);

    /**
     * @param array $args
     * @return array
     */
    public function findAllIds(array $args);

    /**
     * @param array $args
     * @return array
     */
    public function countAll(array $args);

    /**
     * @param array $ids
     * @return array
     */
    public function getIsOnlineByIds($ids);

    /**
     * @param array $ids
     * @return array
     */
    public function getIsApprovedByIds($ids);

    /**
     * @param array $ids
     * @return array
     */
    public function getIsEmailVerifiedByIds($ids);

    /**
     * @param $ids
     * @param $args
     * @return mixed
     */
    public function findPhotos($ids, array $args);

    /**
     * @param $ids
     * @param array $args
     * @return mixed
     */
    public function countPhotos($ids, array $args);

    /**
     * @param $ids
     * @param array $args
     * @return mixed
     */
    public function findAvatars($ids, array $args);

    /**
     * @param mixed[] $ids
     * @param mixed[] $args
     *
     * @return string[]
     */
    public function findChat($ids, array $args);

    /**
     * @param $ids
     * @param array $args
     * @return mixed
     */
    public function getInfo($ids, array $args);

    /**
     * @param $userId
     * @return boolean
     */
    public function delete($userId);
}
