<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;
use SuperbThemesCustomizer\CustomizerPanels;

class CustomizerSections
{
    const HEADER_METASLIDER = 'superbthemes_customizer_section_header_metaslider';
    const HEADER_DEFAULT = 'superbthemes_customizer_section_header_default';
    const GENERAL = 'superbthemes_customizer_section_general';
    const NAVIGATION = 'superbthemes_customizer_section_navigation';
    const WIDGETS = 'superbthemes_customizer_section_widgets';
    const BLOG = 'superbthemes_customizer_section_blog';
    const SINGLE = 'superbthemes_customizer_section_single';
    const SIDEBAR = 'superbthemes_customizer_section_sidebar';
    const WOOCOMMERCE = 'superbthemes_customizer_section_woocommerce';
    const COLOR_SCHEME = 'superbthemes_customizer_section_color_scheme';
    const SHORTPIXEL = 'superbthemes_customizer_section_shortpixel';

    public function __construct()
    {
        new CustomizerItem(self::SHORTPIXEL, array(
            "type" => CustomizerType::SECTION,
            "label" =>  __('Image Optimization', 'superb-pixels'),
            "parents" => array(""),
            "priority" => 1
        ));

        new CustomizerItem(self::COLOR_SCHEME, array(
            "type" => CustomizerType::SECTION,
            "label" =>  __('Colors', 'superb-pixels'),
            "description" => __('Customize the color scheme of the theme.', 'superb-pixels'),
            "parents" => array("")
        ));

        new CustomizerItem(self::GENERAL, array(
            "type" => CustomizerType::SECTION,
            "label" => __('General', 'superb-pixels'),
            "description" => __('Customize the general layout.', 'superb-pixels'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));

        new CustomizerItem(self::NAVIGATION, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Navigation', 'superb-pixels'),
            "description" => __('Customize the navigation.', 'superb-pixels'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));

        if (class_exists("MetaSliderPlugin") || class_exists("MetaSliderPro")) {
            new CustomizerItem(self::HEADER_METASLIDER, array(
                "type" => CustomizerType::SECTION,
                "label" => __('MetaSlider Header', 'superb-pixels'),
                "description" => __('MetaSlider Header requires the MetaSlider plugin. Using the MetaSlider header will replace the default theme header.', 'superb-pixels'),
                "parents" => array(CustomizerPanels::HEADER)
            ));
        }
        new CustomizerItem(self::HEADER_DEFAULT, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Header', 'superb-pixels'),
            "description" => __('Customize the default theme header. These settings do not apply if you\'re using the MetaSlider header.', 'superb-pixels'),
            "parents" => array(CustomizerPanels::HEADER)
        ));
        new CustomizerItem(self::WIDGETS, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Header Widgets', 'superb-pixels'),
            "description" => __('Customize the header widgets..', 'superb-pixels'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::BLOG, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Blog', 'superb-pixels'),
            "description" => __('Customize the blog feed.', 'superb-pixels'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::SINGLE, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Posts / Pages', 'superb-pixels'),
            "description" => __('Customize Posts and Pages.', 'superb-pixels'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::SIDEBAR, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Sidebar', 'superb-pixels'),
            "description" => __('Customize the sidebar.', 'superb-pixels'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
    }
}
