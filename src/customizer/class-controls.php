<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;
use SuperbThemesCustomizer\CustomizerPanels;
use SuperbThemesCustomizer\CustomizerSections;

class CustomizerControls
{
    const GENERAL_BOXMODE = 'general_layout_boxmode';
    const GENERAL_BOXMODE_HIDE_MOBILE = 'general_layout_boxmode_hide_mobile';
    //

    const HEADER_METASLIDER_SHORTCODE = 'header_metaslider_overwrite';
    const HEADER_METASLIDER_ONLY_FRONTPAGE = 'only_show_header_frontpage_metaslider';

    const HEADER_ONLY_FRONTPAGE = 'only_show_header_frontpage';
    const HEADER_TITLE = 'header_img_text';
    const HEADER_TAGLINE = 'header_img_text_tagline';
    const HEADER_BUTTON_TEXT = 'header_img_button_text';
    const HEADER_BUTTON_LINK = 'header_img_button_link';

    const SITE_IDENTITY_LOGO_HEIGHT = 'navigation_logo_height';
    const SITE_IDENTITY_HIDE_TAGLINE = 'navigation_hide_tagline';

    const NAVIGATION_LAYOUT_STYLE = 'navigation_layout_style';
    const NAVIGATION_LAYOUT_CHOICE_SMALL = 'navigation_layout_style_choice_small';
    const NAVIGATION_LAYOUT_CHOICE_LARGE = 'navigation_layout_style_choice_large';
    const NAVIGATION_AUTHOR_IMAGE = 'navigation_large_author_image';
    const NAVIGATION_AUTHOR_NAME = 'navigation_large_author_name';
    const NAVIGATION_AUTHOR_TAGLINE = 'navigation_large_author_tagline';
    const NAVIGATION_RIGHTALIGNED_BUTTON_TEXT = 'navigation_large_rightalignedbutton_text';
    const NAVIGATION_RIGHTALIGNED_BUTTON_LINK = 'navigation_large_rightalignedbutton_link';
    const NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK = 'navigation_large_rightalignedbutton_link_targetblank';

    const SIDEBAR_WOOCOMMERCE_HIDE = 'hide_wc_sidebar';

    const FOOTER_GOTOTOP_HIDE = 'footer_go_to_top_hide';

    ////
    const BLOGFEED_COLUMNS_STYLE = 'blogfeed_columns_style';
    //
    const BLOGFEED_ONE_COLUMNS = 'blogfeed_onecolumn';
    const BLOGFEED_TWO_COLUMNS = 'blogfeed_twocolumn';
    const BLOGFEED_THREE_COLUMNS = 'blogfeed_three_columns';
    const BLOGFEED_TWO_COLUMNS_MASONRY = 'blogfeed_twocolumn_masonry';
    const BLOGFEED_THREE_COLUMNS_MASONRY = 'blogfeed_three_colums_masonry';
    /////
    const BLOGFEED_HIDE_SIDEBAR = 'blogfeed_show_sidebar';
    ////
    const BLOGFEED_FEATURED_IMAGE_STYLE = 'blogfeed_featured_image_style';
    //
    const BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE = 'blogfeed_featured_image_style_fullimage';
    const BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE = 'blogfeed_featured_image_style_cover';
    const BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR = 'blogfeed_featured_image_style_coverblur';
    ////
    const BLOGFEED_FEATURED_IMAGE_PLACEHOLDER = 'blogfeed_featured_image_placeholder';

    ////
    const SINGLE_FEATURED_IMAGE_STYLE = 'SINGLE_featured_image_style';
    //
    const SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE = 'SINGLE_featured_image_style_fullimage';
    const SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE = 'SINGLE_featured_image_style_cover';
    const SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR = 'SINGLE_featured_image_style_coverblur';
    ////
    const SINGLE_HIDE_RELATED_POSTS = 'postpage_show_hide_relatedposts';
    const SINGLE_HIDE_SIDEBAR = 'postpage_hide_sidebar';


    //
    const SHORTPIXEL_ENABLE = 'shortpixel_spst_enable';

    private static $CONTROL_DEFAULTS = array(
        self::SITE_IDENTITY_LOGO_HEIGHT => 65,
        self::BLOGFEED_COLUMNS_STYLE => self::BLOGFEED_THREE_COLUMNS_MASONRY,
        self::BLOGFEED_FEATURED_IMAGE_STYLE => self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE,
        self::SINGLE_FEATURED_IMAGE_STYLE => self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE,
        self::NAVIGATION_LAYOUT_STYLE => self::NAVIGATION_LAYOUT_CHOICE_SMALL,
        self::BLOGFEED_HIDE_SIDEBAR => "1",
        self::SINGLE_HIDE_SIDEBAR => "",
        self::SINGLE_HIDE_RELATED_POSTS => "1",
        self::NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK => "1",
        self::GENERAL_BOXMODE => "1",
        self::GENERAL_BOXMODE_HIDE_MOBILE => "1",
        self::SITE_IDENTITY_HIDE_TAGLINE => "1",
        self::SHORTPIXEL_ENABLE => "0",
        self::FOOTER_GOTOTOP_HIDE => "1",
        self::HEADER_ONLY_FRONTPAGE => "1"
    );

    public function __construct($colorScheme)
    {
        /*
        *
        * COLOR SCHEME
        *
        */
        $dark_variants = array();
        foreach ($colorScheme->GetColors() as $customizerColor) {
            $dark_variants[] = $customizerColor->GetDarkId();
            $this->CreateColorCustomizerItem($customizerColor, in_array($customizerColor->GetId(), $dark_variants, true));
        }

        /*
        */

        /*
        *
        * SHORTPIXEL
        *
        */
        // Requires >= WP 6.0 
        global $wp_version;
        if (version_compare($wp_version, '6') >= 0) {
            new CustomizerItem(self::SHORTPIXEL_ENABLE, array(
                "type" => CustomizerType::CONTROL_CHECKBOX,
                "label" => __('Enable Image Optimization', 'superb-pixels'),
                "description" => __('When this setting is enabled, images on your website will be automatically optimized using ShortPixel and delivered as the modern image format .webp through their free CDN.', 'superb-pixels'),
                "section" => CustomizerSections::SHORTPIXEL,
                "default" => 0
            ));
        }
        /*
        */

        /*
        *
        * GENERAL
        *
        */
        new CustomizerItem(self::GENERAL_BOXMODE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Boxed Layout', 'superb-pixels'),
            "description" => __('When this setting is enabled, elements on the website will be boxed.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => 1
        ));

        new CustomizerItem(self::GENERAL_BOXMODE_HIDE_MOBILE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Disable Boxed Layout on Mobile', 'superb-pixels'),
            "description" => __('When this setting is enabled, and Boxed Layout is enabled, the boxed layout will not be applied on mobile devices and other low-width screens.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => 1
        ));

        /*
        *
        * HEADER METASLIDER
        *
        */
        new CustomizerItem(self::HEADER_METASLIDER_SHORTCODE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('MetaSlider Shortcode', 'superb-pixels'),
            "description" => __('Add your MetaSlider slider shortcode in this field to use the Slider as your header. This will be used instead of the default theme header.', 'superb-pixels'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_METASLIDER,
            "priority" => 1,
        ));
        new CustomizerItem(self::HEADER_METASLIDER_ONLY_FRONTPAGE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Show header on all pages', 'superb-pixels'),
            "description" => __('Enabling this option will display the MetaSlider header on all pages.', 'superb-pixels'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_METASLIDER,
            "default" => 0,
        ));

        /*
        *
        * HEADER DEFAULT
        *
        */
        /* Header */
        new CustomizerItem(self::HEADER_TITLE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Title', 'superb-pixels'),
            "description" => __('The title text displayed in your header.', 'superb-pixels'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_TAGLINE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Tagline', 'superb-pixels'),
            "description" => __('The tagline text displayed in your header.', 'superb-pixels'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Button Text', 'superb-pixels'),
            "description" => __('The button text displayed in your header.', 'superb-pixels'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_LINK, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Button Link', 'superb-pixels'),
            "description" => __('The link used by the button in your header.', 'superb-pixels'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));

        /*
        *
        * SITE IDENTITY
        *
        */
        new CustomizerItem(self::SITE_IDENTITY_LOGO_HEIGHT, array(
            "type" => CustomizerType::CONTROL_RANGE,
            "label" => __('Logo Height', 'superb-pixels'),
            "description" => __('Sets the height limit for the logo image, if one is selected.', 'superb-pixels'),
            "section" => 'title_tagline',
            "priority" => 1,
            "default" => self::$CONTROL_DEFAULTS[self::SITE_IDENTITY_LOGO_HEIGHT],
            "range" => array(
                'min' => 25,
                'max' => 200,
                'step' => 1
            )
        ));

        new CustomizerItem(self::SITE_IDENTITY_HIDE_TAGLINE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Tagline Only', 'superb-pixels'),
            "section" => 'title_tagline',
            "default" => 1
        ));

        /*
        *
        * NAVIGATION
        *
        */
        /* Layout */

        new CustomizerItem(self::NAVIGATION_LAYOUT_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO_IMAGE,
            "label" => __('Navigation Layout', 'superb-pixels'),
            "description" => __('Select the layout of the navigation area on your website.', 'superb-pixels'),
            "priority" => 1,
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "default" => self::$CONTROL_DEFAULTS[self::NAVIGATION_LAYOUT_STYLE],
            "choices" => array(
                self::NAVIGATION_LAYOUT_CHOICE_SMALL =>  '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="37.94" viewBox="0 0 119.958 37.94"><title>' . esc_html__("Small Navigation Layout", "superb-pixels") . '</title><g transform="translate(-49.021 -37.125)"><rect width="30.966" height="8.753" transform="translate(57.387 44.969)" /><rect width="9.966" height="3.753" transform="translate(151 47.469)" /><rect width="9.966" height="3.753" transform="translate(137 47.469)" /><rect width="9.966" height="3.753" transform="translate(123 47.469)" /><rect width="9.966" height="3.753" transform="translate(109 47.469)" /><path d="M373.5,57.034H254.566v37.94H374.524V57.034ZM256.559,92.981V59.027H372.532V92.981Z" transform="translate(-205.545 -19.909)"></path></g></svg>',
                self::NAVIGATION_LAYOUT_CHOICE_LARGE =>  '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="37.94" viewBox="0 0 119.958 37.94"><title>' . esc_html__("Full Navigation Layout", "superb-pixels") . '</title><g transform="translate(-49.021 -82.628)"><rect width="32.966" height="10.753" transform="translate(93.051 90.845)" /><rect width="13.094" height="5.722" rx="2.861" transform="translate(147.871 93.361)" /><g transform="translate(1.483)"><rect width="9.966" height="3.753" transform="translate(123.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(137.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(67.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(109.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(95.534 108.469)" /><rect width="9.966" height="3.753" transform="translate(81.534 108.469)" /></g><path d="M373.5,57.034H254.566v37.94H374.524V57.034ZM256.559,92.981V59.027H372.532V92.981Z" transform="translate(-205.545 25.594)" /><g transform="translate(-0.484)"><rect width="9.966" height="2.753" transform="translate(68.387 93.095)" /><rect width="9.966" height="1.753" transform="translate(68.387 97.595)" /><circle cx="4.516" cy="4.516" r="4.516" transform="translate(57.871 91.706)" /></g></g></svg>',
            )
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_IMAGE, array(
            "type" => CustomizerType::CONTROL_IMAGE,
            "label" => __('Author Image', 'superb-pixels'),
            "description" => __('If the Full Navigation Layout is active, sets the author image in the top left side of the navigation layout.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "default" => "",
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_NAME, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Author Name', 'superb-pixels'),
            "description" => __('If the Full Navigation Layout is active, sets the author name in the top left side of the navigation.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_TAGLINE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Author Tagline', 'superb-pixels'),
            "description" => __('If the Full Navigation Layout is active, sets the author tagline in the top left side of the navigation.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Right-Aligned Button Text', 'superb-pixels'),
            "description" => __('If the Full Navigation Layout is active, sets the text of the button in the top right side of the navigation.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));

        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_LINK, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Right-Aligned Button Link', 'superb-pixels'),
            "description" => __('If the Full Navigation Layout is active, sets the link of the button in the top right side of the navigation.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
        ));
        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Open Link in new Window/Tab', 'superb-pixels'),
            "description" => __('When this setting is enabled, the link of the button will be opened in a new window/tab when clicked.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
            "default" => 1
        ));


        /*
        *
        * SIDEBAR
        *
        */
        /* Layout */
        new CustomizerItem(self::BLOGFEED_HIDE_SIDEBAR, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Sidebar on Blog Feed, Search Page and Archive Pages', 'superb-pixels'),
            "description" => __('Enabling this setting will hide the sidebar on the blog feed, search page and archive pages and use the full width of the page for the page content.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SIDEBAR,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_HIDE_SIDEBAR]
        ));


        /*
        *
        * BLOG FEED
        *
        */
        /* Layout */
        new CustomizerItem(self::BLOGFEED_COLUMNS_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO_IMAGE,
            "label" => __('Blog Feed Column Layout', 'superb-pixels'),
            "description" => __('Select the layout of the columns on your blog feed.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_COLUMNS_STYLE],
            "choices" => array(
                self::BLOGFEED_ONE_COLUMNS => '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="119.939" viewBox="0 0 119.958 119.939"><title>' . esc_html__("1-Column Layout", "superb-pixels") . '</title><g transform="translate(-154 -253)"><g transform="translate(-100.545 196.091)"><rect width="76.966" height="33.753" transform="translate(275.933 66.878)" /><rect width="73.583" height="1.984" transform="translate(275.933 104.646)" /><rect width="65.932" height="1.984" transform="translate(275.933 111.672)" /><rect width="76.966" height="33.753" transform="translate(275.933 122.027)" /><rect width="73.583" height="1.984" transform="translate(275.933 159.795)" /><rect width="65.932" height="1.984" transform="translate(275.933 166.821)" /><path d="M373.5,57.034H254.566v119.94H374.524V57.034ZM256.559,174.981V59.027H372.532V174.981Z" /></g></g></svg>',
                self::BLOGFEED_TWO_COLUMNS =>  '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="119.94" viewBox="0 0 119.958 119.94"><title>' . esc_html__("2-Column Layout", "superb-pixels") . '</title><g transform="translate(-154.021 -390.53)"><g transform="translate(-100.545 196.091)"><rect width="46.966" height="32.983" transform="translate(262.528 202.372)" /><rect width="43.902" height="1.984" transform="translate(262.528 239.371)" /><rect width="41.881" height="1.984" transform="translate(262.528 246.396)" /><rect width="44.466" height="32.983" transform="translate(319.515 202.308)" /><rect width="41.693" height="1.984" transform="translate(319.515 239.307)" /><rect width="39.688" height="1.984" transform="translate(319.515 246.332)" /><rect width="44.466" height="32.983" transform="translate(319.515 260.712)" /><rect width="41.693" height="1.984" transform="translate(319.515 297.711)" /><rect width="39.688" height="1.984" transform="translate(319.515 304.736)" /><rect width="46.895" height="32.983" transform="translate(262.528 260.712)" /><rect width="43.902" height="1.984" transform="translate(262.528 297.711)" /><rect width="41.859" height="1.984" transform="translate(262.528 304.736)" /><path d="M373.5,194.439H254.566v119.94H374.524V194.439ZM256.559,312.386V196.432H372.532V312.386Z" /></g></g></svg>',
                self::BLOGFEED_THREE_COLUMNS => '<svg xmlns="http://www.w3.org/2000/svg" width="119.958" height="119.939" viewBox="0 0 119.958 119.939"><title>' . esc_html__("3-Column Layout", "superb-pixels") . '</title><g transform="translate(-154.042 -557.096)"><g transform="translate(-100.545 196.091)"><rect width="29.776" height="32.983" transform="translate(262.549 368.937)" /><rect width="27.004" height="1.984" transform="translate(262.549 405.936)" /><rect width="24.998" height="1.984" transform="translate(262.549 412.961)" /><rect width="29.776" height="32.983" transform="translate(299.678 368.937)" /><rect width="27.004" height="1.984" transform="translate(299.678 405.936)" /><rect width="24.998" height="1.984" transform="translate(299.678 412.961)" /><rect width="29.776" height="32.983" transform="translate(336.615 368.873)" /><rect width="27.004" height="1.984" transform="translate(336.615 405.872)" /><rect width="24.998" height="1.984" transform="translate(336.615 412.898)" /><rect width="29.776" height="32.983" transform="translate(262.549 427.277)" /><rect width="27.004" height="1.984" transform="translate(262.549 464.276)" /><rect width="24.998" height="1.984" transform="translate(262.549 471.302)" /><rect width="29.776" height="32.983" transform="translate(299.678 427.277)" /><rect width="27.004" height="1.984" transform="translate(299.678 464.276)" /><rect width="24.998" height="1.984" transform="translate(299.678 471.302)" /><rect width="29.776" height="32.983" transform="translate(336.615 427.214)" /><rect width="27.004" height="1.984" transform="translate(336.615 464.212)" /><rect width="24.998" height="1.984" transform="translate(336.615 471.238)" /><path d="M373.519,361.005H254.587V480.944H374.545V361.005ZM256.579,478.952V363H372.553V478.952Z" /></g></g></svg>',
                self::BLOGFEED_TWO_COLUMNS_MASONRY => '<svg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"><title>' . esc_html__("2-Column Masonry Layout", "superb-pixels") . '</title><g><rect x="1" y="1" width="118" height="118" rx="3" fill="none" stroke-width="2"/><rect x="6" y="6" width="51" height="20" rx="4" /><rect x="6" y="30" width="28" height="4" rx="2" /><rect x="6" y="38" width="16" height="4" rx="2" /><rect x="63" y="78" width="51" height="20" rx="4" /><rect x="63" y="102" width="28" height="4" rx="2" /><rect x="63" y="110" width="16" height="4" rx="2" /><rect x="6" y="50" width="51" height="48" rx="4" /><rect x="6" y="102" width="28" height="4" rx="2" /><rect x="6" y="110" width="16" height="4" rx="2" /><rect x="63" y="6" width="51" height="48" rx="4" /><rect x="63" y="58" width="28" height="4" rx="2" /><rect x="63" y="66" width="16" height="4" rx="2" /></g></svg>',
                self::BLOGFEED_THREE_COLUMNS_MASONRY => '<svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"><title>' . esc_html__("3-Column Masonry Layout", "superb-pixels") . '</title><g><rect x="1" y="1" width="118" height="118" rx="3" fill="none" stroke-width="2"/><rect x="6" y="6" width="32" height="20" rx="4" /><rect x="6" y="30" width="28" height="4" rx="2" /><rect x="6" y="38" width="16" height="4" rx="2" /><rect x="82" y="6" width="32" height="20" rx="4" /><rect x="82" y="30" width="28" height="4" rx="2" /><rect x="82" y="38" width="16" height="4" rx="2" /><rect x="6" y="50" width="32" height="48" rx="4" /><rect x="6" y="102" width="28" height="4" rx="2" /><rect x="6" y="110" width="16" height="4" rx="2" /><rect x="82" y="50" width="32" height="48" rx="4" /><rect x="82" y="102" width="28" height="4" rx="2" /><rect x="82" y="110" width="16" height="4" rx="2" /><rect x="44" y="6" width="32" height="48" rx="4" /><rect x="44" y="58" width="28" height="4" rx="2" /><rect x="44" y="66" width="16" height="4" rx="2" /><rect x="44" y="78" width="32" height="20" rx="4" /><rect x="44" y="102" width="28" height="4" rx="2" /><rect x="44" y="110" width="16" height="4" rx="2" /></g></svg>'
            )
        ));

        new CustomizerItem(self::BLOGFEED_FEATURED_IMAGE_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO,
            "label" => __('Featured Image Layout', 'superb-pixels'),
            "description" => __('Select the layout of the featured images on your blog feed.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_FEATURED_IMAGE_STYLE],
            "choices" => array(
                self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE => "Full Image",
                self::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE => "Scale to fit Recommended Size",
                self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR => "Keep Full Image, But Fill Background to Recommended Size"
            )
        ));

        new CustomizerItem(self::BLOGFEED_FEATURED_IMAGE_PLACEHOLDER, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Display Placeholder Featured Image', 'superb-pixels'),
            "description" => __('Enabling this setting will display a placeholder featured image for all posts that do not have a featured image set.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => 0
        ));


        /*
        *
        * SINGLE / POSTS & PAGES / POSTS / PAGES
        *
        */
        /* Layout */
        new CustomizerItem(self::SINGLE_FEATURED_IMAGE_STYLE, array(
            "type" => CustomizerType::CONTROL_RADIO,
            "label" => __('Featured Image Layout', 'superb-pixels'),
            "description" => __('Select the layout of the featured images on your blog feed.', 'superb-pixels'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => self::$CONTROL_DEFAULTS[self::SINGLE_FEATURED_IMAGE_STYLE],
            "choices" => array(
                self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE => "Full Image",
                self::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE => "Scale to fit Recommended Size",
                self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR => "Keep Full Image, But Fill Background to Recommended Size"
            )
        ));
    }

    private function CreateColorCustomizerItem($customizerColor, $is_dark_variant = false)
    {
        new CustomizerItem($customizerColor->GetId(), array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => $customizerColor->GetLabel(),
            "description" => $customizerColor->GetDescription(),
            "section" => $is_dark_variant ? 'superb-pixels-color-scheme-dark-variations' : CustomizerSections::COLOR_SCHEME,
            "default" => self::GetDefault($customizerColor->GetId())
        ));
    }

    public static function OverwriteDefault($control, $value)
    {
        self::$CONTROL_DEFAULTS[$control] = $value;
    }

    public static function GetSelectedOrDefault($control)
    {
        $theme_mod = \get_theme_mod($control);
        if (($theme_mod || empty($theme_mod)) && $theme_mod !== false) {
            return $theme_mod;
        }

        return self::GetDefault($control);
    }

    public static function GetDefault($control)
    {
        if (isset(self::$CONTROL_DEFAULTS[$control])) {
            return self::$CONTROL_DEFAULTS[$control];
        }
        // No default for control found
        // Maybe a color control 
        return CustomizerController::GetColorScheme()->MaybeGetDefault($control);
    }
}
