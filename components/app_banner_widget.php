<?php
/**
 * Copyright © 2019 iola. All rights reserved. Contacts: <hello@iola.app>
 * iola is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 * You should have received a copy of the license along with this work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>
 */

class IOLA_CMP_AppBannerWidget extends BASE_CLASS_Widget
{
    public function __construct(BASE_CLASS_WidgetParameter $paramObj)
    {
        parent::__construct();

        $settings = $paramObj->customParamList;
        $siteName = OW::getConfig()->getValue("base", "site_name");
        $url = OW::getRequest()->buildUrlQueryString("https://iola.app/for-users", [
            "site-url" => urlencode(OW_URL_HOME),
            "site-name" => urlencode($siteName)
        ]);

        $this->assign("url", $url);
        $this->assign("settings", array_merge($settings, [
            "text" => str_replace('"', "'", OW::getLanguage()->text("iola", "banner_widget_text", [
                "moreUrl" => $url
            ]))
        ]));
    }

    public function onBeforeRender()
    {
        parent::onBeforeRender();

        IOLA_CLASS_Plugin::getInstance()->addStatic();
    }

    public static function getSettingList()
    {
        $settingList = [];

        $settingList['showLogo'] = [
            'presentation' => self::PRESENTATION_CHECKBOX,
            'label' => OW::getLanguage()->text('iola', 'banner_widget_show_logo'),
            'value' => 3
        ];

        $settingList['showText'] = [
            'presentation' => self::PRESENTATION_CHECKBOX,
            'label' => OW::getLanguage()->text('iola', 'banner_widget_show_text'),
            'value' => 3
        ];

        $settingList['showIOS'] = [
            'presentation' => self::PRESENTATION_CHECKBOX,
            'label' => OW::getLanguage()->text('iola', 'banner_widget_show_ios'),
            'value' => 3
        ];

        $settingList['showAndroid'] = [
            'presentation' => self::PRESENTATION_CHECKBOX,
            'label' => OW::getLanguage()->text('iola', 'banner_widget_show_android'),
            'value' => 3
        ];

        return $settingList;
    }

    public static function getStandardSettingValueList()
    {
        return [
            self::SETTING_SHOW_TITLE => false,
            self::SETTING_TITLE => OW::getLanguage()->text('iola', 'banner_widget_title'),
            self::SETTING_WRAP_IN_BOX => true,
            self::SETTING_ICON => self::ICON_MOBILE
        ];
    }

    public static function getAccess()
    {
        return self::ACCESS_ALL;
    }
}