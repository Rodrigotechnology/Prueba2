<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;

class CustomizerPanels
{
    const LAYOUT = 'superbthemes_customizer_panel_LAYOUT';
    const WOOCOMMERCE = 'superbthemes_customizer_panel_WOOCOMMERCE';
    const NAVIGATION = 'superbthemes_customizer_panel_NAVIGATION';
    const HEADER = 'superbthemes_customizer_panel_HEADER';

    const SHOULD_REFOCUS_TO_PANEL = array();

    public function __construct()
    {
        new CustomizerItem(self::LAYOUT, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Layout', 'superb-pixels'),
            "description" => __('Layout Customization', 'superb-pixels')
        ));
        new CustomizerItem(self::WOOCOMMERCE, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('WooCommerce', 'superb-pixels'),
            "description" => __('WooCommerce Customization', 'superb-pixels')
        ));
        new CustomizerItem(self::NAVIGATION, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Navigation', 'superb-pixels'),
            "description" => __('Navigation Customization', 'superb-pixels')
        ));
        new CustomizerItem(self::HEADER, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Header', 'superb-pixels'),
            "description" => __('Header Customization', 'superb-pixels')
        ));
    }
}
