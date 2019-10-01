<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

$patchedPlugins = require __DIR__ . "/plugins.php";

foreach ($patchedPlugins as $pluginKey) {
    $isActive = OW::getPluginManager()->isPluginActive($pluginKey);
    $initPatchPath = __DIR__ . "/$pluginKey/init.php";

    if ($isActive && file_exists($initPatchPath)) {
        require $initPatchPath;
    }
}

/**
 * Post install patches
 */
OW::getEventManager()->bind(
    OW_EventManager::ON_AFTER_PLUGIN_INSTALL,
    function(OW_Event $event) use($patchedPlugins) {
        $params = $event->getParams();
        $pluginKey = $params["pluginKey"];

        if (!in_array($pluginKey, $patchedPlugins)) {
            return;
        }

        $installPatchPath = __DIR__ . "/$pluginKey/install.php";
        if (file_exists($installPatchPath)) {
            require $installPatchPath;
        }
    }
);