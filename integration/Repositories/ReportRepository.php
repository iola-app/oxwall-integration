<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

namespace Iola\Oxwall\Repositories;

use Iola\Api\Contract\Integration\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    protected $entityTypes = [
        self::CONTENT_USER => \BASE_CLASS_ContentProvider::ENTITY_TYPE_PROFILE,
        self::CONTENT_PHOTO => \PHOTO_CLASS_ContentProvider::ENTITY_TYPE,
    ];

    protected $reasons = [
        self::REASON_ILLEGAL => "illegal",
        self::REASON_OFFENCE => "offence",
        self::REASON_SPAM => "spam",
    ];

    public function addReport($contentType, $contentId, $userId, $reportReason) {
        \BOL_FlagService::getInstance()->addFlag(
            $this->entityTypes[$contentType],
            $contentId,
            $this->reasons[$reportReason],
            $userId
        );

        return true;
    }
}