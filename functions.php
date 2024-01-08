<?php
require_once __DIR__ . '/vendor/autoload.php';

use SuperbThemesCustomizer\CustomizerController;

/**
 * Superb Pixels functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Superb Pixels
 */


if (!function_exists('superb_pixels_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */

    function superb_pixels_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Superb Pixels, use a find and replace
         * to change 'superb-pixels' to the name of your theme in all the template files.
         */
        load_theme_textdomain('superb-pixels', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(300);

        add_image_size('superb-pixels-grid', 350, 230, true);
        add_image_size('superb-pixels-slider', 850);
        add_image_size('superb-pixels-small', 300, 180, true);


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1'    => esc_html__('Primary', 'superb-pixels'),
        ));

        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('superb_pixels_custom_background_args', array(
            'default-color' => '#ffffff',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'superb_pixels_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function superb_pixels_content_width()
{
    $GLOBALS['content_width'] = apply_filters('superb_pixels_content_width', 640);
}
add_action('after_setup_theme', 'superb_pixels_content_width', 0);


function superb_pixels_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'superb_pixels_woocommerce_support');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function superb_pixels_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'superb-pixels'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'superb-pixels'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="sidebar-headline-wrapper"><div class="sidebarlines-wrapper"><div class="widget-title-lines"></div></div><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ));
    register_sidebar(array(
        'name'          => esc_html__('WooCommerce Sidebar', 'superb-pixels'),
        'id'            => 'sidebar-wc',
        'description'   => esc_html__('Add widgets here.', 'superb-pixels'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="sidebar-headline-wrapper"><div class="sidebarlines-wrapper"><div class="widget-title-lines"></div></div><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget', 'superb-pixels'),
        'id'            => 'footerwidget-1',
        'description'   => esc_html__('Add widgets here.', 'superb-pixels'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ));


    register_sidebar(array(
        'name'          => esc_html__('Header Widget', 'superb-pixels'),
        'id'            => 'headerwidget-1',
        'description'   => esc_html__('Add widgets here.', 'superb-pixels'),
        'before_widget' => '<section id="%1$s" class="header-widget widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<div><div class="sidebar-title-border"><h3 class="widget-title">',
        'after_title'   => '</h3></div></div>',
    ));
}




add_action('widgets_init', 'superb_pixels_widgets_init');


/**
 * Enqueue scripts and styles.
 */
function superb_pixels_scripts()
{
    wp_enqueue_style('superb-pixels-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('superb-pixels-style', get_stylesheet_uri());
    wp_enqueue_script('superb-pixels-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20170823', true);
    wp_enqueue_script('superb-pixels-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170823', true);
    wp_enqueue_script('superb-pixels-script', get_template_directory_uri() . '/js/script.js', array('jquery'), '20160720', true);
        wp_enqueue_script('superb-pixels-accessibility', get_template_directory_uri() . '/js/accessibility.js', array('jquery'), '20160720', true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'superb_pixels_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
CustomizerController::GetInstance();


/**
 * Google fonts
 */

function superb_pixels_enqueue_assets()
{
    // Include the file.
    require_once get_theme_file_path('webfont-loader/wptt-webfont-loader.php');
    // Load the webfont.
    wp_enqueue_style(
        'superb-pixels-fonts',
        wptt_get_webfont_url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Lora:wght@500;600&display=swap'),
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'superb_pixels_enqueue_assets');



/**
 * Dots after excerpt
 */

function superb_pixels_new_excerpt_more($more)
{
	if(is_admin()) {
		return $more;
	}
    return '...';
}
add_filter('excerpt_more', 'superb_pixels_new_excerpt_more');


/**
 * Filter the excerpt length to 50 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function superb_pixels_excerpt_length($length)
{
    if (is_admin()) {
        return $length;
    }
    return 15;
}
add_filter('excerpt_length', 'superb_pixels_excerpt_length', 999);

/**
 * Blog Pagination
 */
if (!function_exists('superb_pixels_numeric_posts_nav')) {
    function superb_pixels_numeric_posts_nav()
    {
        $next_str = __('Next', 'superb-pixels');
        $prev_str = __('Previous', 'superb-pixels');
        //$prev_arrow = is_rtl() ? 'Previous' : 'Next';
        //$next_arrow = is_rtl() ? 'Next' : 'Previous';

        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999; // need an unlikely integer
        if ($total > 1) {
            /*
            if (!$current_page = get_query_var('paged')) {
                $current_page = 1;
            }
            */
            if (get_option('permalink_structure')) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            echo wp_kses_post(paginate_links(array(
                'base'            => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'        => $format,
                'current'        => max(1, get_query_var('paged')),
                'total'         => $total,
                'mid_size'        => 1,
                'end_size'      => 0,
                'type'             => 'list',
                'prev_text'        => $prev_str,
                'next_text'        => $next_str,
            )));
        }
    }
}


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function superb_pixels_skip_link_focus_fix()
{
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
        "use strict";
        /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
            var t, e = location.hash.substring(1);
            /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
        }, !1);
    </script>
    <?php
}
add_action('wp_print_footer_scripts', 'superb_pixels_skip_link_focus_fix');



require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

/**
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Free Seo Optimized Responsive Theme for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'superb_pixels_register_required_plugins');

function superb_pixels_register_required_plugins()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name'      => 'Elementor',
            'slug'      => 'elementor',
            'required'           => false,
        ),
        array(
            'name'      => 'Superb Addons - WordPress Editor And Elementor Blocks, Sections & Patterns',
            'slug'      => 'superb-blocks',
            'required'           => false,
        ),
        array(
            'name'      => 'ShortPixel',
            'slug'      => 'shortpixel-image-optimiser',
            'required'           => false,
        ),
    );

    $config = array(
        'id'           => 'superb-pixels',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );


    tgmpa($plugins, $config);
}



/**
 * Deactivate Elementor Wizard
 */
function superb_pixels_remove_elementor_onboarding()
{
    update_option('elementor_onboarded', true);
}
add_action('after_switch_theme', 'superb_pixels_remove_elementor_onboarding');



/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function superb_pixels_sanitize_checkbox($checked)
{
    // Boolean check.
    return ((isset($checked) && true == $checked) ? true : false);
}







// Theme page start

add_action('admin_menu', 'superb_pixels_themepage');
function superb_pixels_themepage()
{
    $option = get_option('superb_pixels_themepage_seen');
    $awaiting = !$option ? ' <span class="awaiting-mod">1</span>' : '';
    $theme_info = add_theme_page(__('Theme Settings', 'superb-pixels'), __('Theme Settings', 'superb-pixels').$awaiting, 'manage_options', 'superb-pixels-info.php', 'superb_pixels_info_page', 1);
}
function superb_pixels_info_page()
{
    $user = wp_get_current_user();
    $theme = wp_get_theme();
    $parent_name = is_child_theme() ? wp_get_theme($theme->Template) : '';
    $theme_name = is_child_theme() ? $theme." ".__("and", "superb-pixels")." ".$parent_name : $theme;
    $demo_text = is_child_theme() ? sprintf(__("Need inspiration? Take a moment to view our theme demo for the %1\$s parent theme %2\$s!", "superb-pixels"), $theme, $parent_name) : __("Need inspiration? Take a moment to view our theme demo!", "superb-pixels");
    $premium_text = is_child_theme() ? sprintf(__("Unlock all features by upgrading to the premium edition of %1\$s and its parent theme %1\$s.", "superb-pixels"), $theme, $parent_name) : sprintf(__("Unlock all features by upgrading to the premium edition of %s.", "superb-pixels"), $theme);
    $option_name = 'superb_pixels_themepage_seen';
    $option = get_option($option_name, null);
    if (is_null($option)) {
        add_option($option_name, true);
    } elseif (!$option) {
        update_option($option_name, true);
    } ?>
    <div class="wrap">

        <div class="spt-theme-settings-wrapper">
            <div class="spt-theme-settings-wrapper-main-content">
              <div class="spt-theme-settings-tabs">

               <div class="spt-theme-settings-tab">
                   <input type="radio" id="tab-1" name="tab-group-1">



                   <label class="spt-theme-settings-label" for="tab-1"><?php esc_html_e("Get started with", "superb-pixels"); ?> <?php echo esc_html($theme_name); ?></label>

                   <div class="spt-theme-settings-content">

                    <div class="spt-theme-settings-content-getting-started-wrapper">
                        <div class="spt-theme-settings-content-item">
                            <div class="spt-theme-settings-content-item-header">
                                <?php esc_html_e("Add Menus", "superb-pixels"); ?>
                            </div>
                            <div class="spt-theme-settings-content-item-content">
                             <a href="<?php echo esc_url(admin_url('nav-menus.php'))  ?>"><?php esc_html_e("Go to Menus", "superb-pixels"); ?></a>
                         </div>
                     </div>

                     <div class="spt-theme-settings-content-item">
                        <div class="spt-theme-settings-content-item-header">
                         <?php esc_html_e("Add Widgets", "superb-pixels"); ?>
                     </div>
                     <div class="spt-theme-settings-content-item-content">
                        <a href="<?php echo esc_url(admin_url('widgets.php'))  ?>"><?php esc_html_e("Go to Widgets", "superb-pixels"); ?></a>
                    </div>
                </div>

                <div class="spt-theme-settings-content-item">
                    <div class="spt-theme-settings-content-item-header">
                        <?php esc_html_e("Create A Header", "superb-pixels"); ?>
                    </div>
                    <div class="spt-theme-settings-content-item-content">
                        <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
                    </div>
                </div>

                <div class="spt-theme-settings-content-item">
                    <div class="spt-theme-settings-content-item-header">
                     <?php esc_html_e("Change Site Title", "superb-pixels"); ?>
                 </div>
                 <div class="spt-theme-settings-content-item-content">
                    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
                </div>
            </div>

            <div class="spt-theme-settings-content-item">
                <div class="spt-theme-settings-content-item-header">
                 <?php esc_html_e("Upload Logo", "superb-pixels"); ?>
             </div>
             <div class="spt-theme-settings-content-item-content">
                <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
            </div>
        </div>

        <div class="spt-theme-settings-content-item">
            <div class="spt-theme-settings-content-item-header">
             <?php esc_html_e("Set Up Navigation", "superb-pixels"); ?>
         </div>
         <div class="spt-theme-settings-content-item-content">
            <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
        </div>
    </div>
    <div class="spt-theme-settings-content-item">
        <div class="spt-theme-settings-content-item-header">
         <?php esc_html_e("Change Navigation Layout", "superb-pixels"); ?>
     </div>
     <div class="spt-theme-settings-content-item-content">
        <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
    </div>
</div>
<div class="spt-theme-settings-content-item">
    <div class="spt-theme-settings-content-item-header">
     <?php esc_html_e("Change Blog Layout", "superb-pixels"); ?>
 </div>
 <div class="spt-theme-settings-content-item-content">
    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
</div>
</div>
<div class="spt-theme-settings-content-item">
    <div class="spt-theme-settings-content-item-header">
     <?php esc_html_e("Display Placeholder Featured Images", "superb-pixels"); ?>
 </div>
 <div class="spt-theme-settings-content-item-content">
    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
</div>
</div>
<div class="spt-theme-settings-content-item">
    <div class="spt-theme-settings-content-item-header">
     <?php esc_html_e("Choose Featured Image Mode", "superb-pixels"); ?>
 </div>
 <div class="spt-theme-settings-content-item-content">
    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
</div>
</div>
<div class="spt-theme-settings-content-item">
    <div class="spt-theme-settings-content-item-header">
     <?php esc_html_e("Customize Logo Height", "superb-pixels"); ?>
 </div>
 <div class="spt-theme-settings-content-item-content">
    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
</div>
</div>
<div class="spt-theme-settings-content-item">
    <div class="spt-theme-settings-content-item-header">
     <?php esc_html_e("Hide Title And/Or Tagline)", "superb-pixels"); ?>
 </div>
 <div class="spt-theme-settings-content-item-content">
    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
</div>
</div>

<div class="spt-theme-settings-content-item">
    <div class="spt-theme-settings-content-item-header">
     <?php esc_html_e("Add Button To Navigation", "superb-pixels"); ?>
 </div>
 <div class="spt-theme-settings-content-item-content">
    <a href="<?php echo esc_url(admin_url('customize.php')) ?>"><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></a>
</div>
</div>



<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Customize All Fonts", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Customize All Colors", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Import Demo Content", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Demo Import", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Unlock Full SEO Optimization", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Show Full Posts on Blog.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Custom Copyright Text In Footer.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Show 'Continue Reading' Button on blog.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Show Go To Top Button.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/show Related Posts On Posts And Pages.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Optimized Mobile Layout", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide Author Name From Byline.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/show Next/previous Buttons On Posts.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/show Categories And Tags On Posts And Pages.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/show Shopping Cart in Navigation.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Only Show Header On Front Page.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Add A About The Author Section.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/Show Sidebar on WooCommerce Pages.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/Show Sidebar on Blog Feed, Search Page and Archive Pages.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/Show Header Button on Mobile.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Add Custom Button To Header.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Hide/Show Header Tagline on Mobile.", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Unlock Feature Requests", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Feature Requests", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Access All Child Themes", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("View Child Themes", "superb-pixels"); ?></span>
    </div>
</a>

<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Add Recent Posts Widget", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Widgets", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Remove 'Tag' from tag page title", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>


<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Remove 'Author' from author page title", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>
<a target="_blank" href="https://superbthemes.com/superb-pixels/" class="spt-theme-settings-content-item spt-theme-settings-content-item-unavailable">
    <div class="spt-theme-settings-content-item-header">
        <span><?php esc_html_e("Remove 'Category' from author page title", "superb-pixels"); ?></span> <span><?php esc_html_e("Premium", "superb-pixels"); ?></span>
    </div>
    <div class="spt-theme-settings-content-item-content">
        <span><?php esc_html_e("Go to Customizer", "superb-pixels"); ?></span>
    </div>
</a>



</div>
</div> 
</div>


</div>      
</div>

<div class="spt-theme-settings-wrapper-sidebar">

    <div class="spt-theme-settings-wrapper-sidebar-item">
        <div class="spt-theme-settings-wrapper-sidebar-item-header"><?php esc_html_e("Additional Resources", "superb-pixels"); ?></div>
        <div class="spt-theme-settings-wrapper-sidebar-item-content">
            <ul>
                <li>
                    <a target="_blank" href="https://wordpress.org/support/forums/"><span class="dashicons dashicons-wordpress"></span><?php esc_html_e("WordPress.org Support Forum", "superb-pixels"); ?></a>
                </li>
                <li>
                    <a target="_blank" href="https://www.facebook.com/superbthemescom/"><span class="dashicons dashicons-facebook-alt"></span><?php esc_html_e("Find us on Facebook", "superb-pixels"); ?></a>
                </li>
                <li>
                    <a target="_blank" href="https://twitter.com/superbthemescom"><span class="dashicons dashicons-twitter"></span><?php esc_html_e("Find us on Twitter", "superb-pixels"); ?></a>
                </li>
                <li>
                    <a target="_blank" href="https://www.instagram.com/superbthemes/"><span class="dashicons dashicons-instagram"></span><?php esc_html_e("Find us on Instagram", "superb-pixels"); ?></a>
                </li>

            </ul>
        </div>
    </div>


    <div class="spt-theme-settings-wrapper-sidebar-item">
        <div class="spt-theme-settings-wrapper-sidebar-item-header"><?php esc_html_e("View Demo", "superb-pixels"); ?></div>
        <div class="spt-theme-settings-wrapper-sidebar-item-content">
            <p><?php echo esc_html($demo_text); ?></p>
            <a href="https://superbthemes.com/demo/superb-pixels/" target="_blank" class="button button-primary"><?php esc_html_e("View Demo", "superb-pixels"); ?></a>
        </div>
    </div>

    <div class="spt-theme-settings-wrapper-sidebar-item">
        <div class="spt-theme-settings-wrapper-sidebar-item-header"><?php esc_html_e("Upgrade to Premium", "superb-pixels"); ?></div>
        <div class="spt-theme-settings-wrapper-sidebar-item-content">
            <p><?php echo esc_html($premium_text); ?></p>
            <a href="https://superbthemes.com/superb-pixels/" target="_blank" class="button button-primary"><?php esc_html_e("View Premium Version", "superb-pixels"); ?></a>
        </div>
    </div>

    <div class="spt-theme-settings-wrapper-sidebar-item">
        <div class="spt-theme-settings-wrapper-sidebar-item-header"><?php esc_html_e("Helpdesk", "superb-pixels"); ?></div>
        <div class="spt-theme-settings-wrapper-sidebar-item-content">
            <p><?php esc_html_e("If you have issues with", "superb-pixels"); ?> <?php echo esc_html($theme); ?> <?php esc_html_e("then send us an email through our website!", "superb-pixels"); ?></p>
            <a href="https://superbthemes.com/customer-support/" target="_blank" class="button"><?php esc_html_e("Contact Support", "superb-pixels"); ?></a>
        </div>
    </div>

    <div class="spt-theme-settings-wrapper-sidebar-item">
        <div class="spt-theme-settings-wrapper-sidebar-item-header"><?php esc_html_e("Review the Theme", "superb-pixels"); ?></div>
        <div class="spt-theme-settings-wrapper-sidebar-item-content">
            <p><?php esc_html_e("Do you enjoy using", "superb-pixels"); ?> <?php echo esc_html($theme); ?><?php esc_html_e("? Support us by reviewing us on WordPress.org!", "superb-pixels"); ?></p>
            <a href="https://wordpress.org/support/theme/<?php echo esc_attr(get_stylesheet()); ?>/reviews/#new-post" target="_blank" class="button"><?php esc_html_e("Leave a Review", "superb-pixels"); ?></a>
        </div>
    </div>



</div>

</div>
</div>


<?php
}



function superb_pixels_comparepage_css($hook)
{
    if ('appearance_page_superb-pixels-info' != $hook) {
        return;
    }
    wp_enqueue_style('superb-pixels-custom-style', get_template_directory_uri() . '/css/compare.css');
}
add_action('admin_enqueue_scripts', 'superb_pixels_comparepage_css');

// Theme page end




/**
 *  Copyright and License for Upsell button by Justin Tadlock - 2016-2018 © Justin Tadlock. customizer button https://github.com/justintadlock/trt-customizer-pro
 */
require_once(trailingslashit(get_template_directory()) . 'justinadlock-customizer-button/class-customize.php');





add_action('admin_init', 'superb_pixels_spbThemesNotification', 8);

function superb_pixels_spbThemesNotification(){
  $notifications = include('inc/admin_notification/Autoload.php');
  $notifications->Add("superb_pixels_notification", "Unlock All Features with Superb Pixels Premium – Limited Time Offer", "

    Take advantage of the up to <span style='font-weight:bold;'>40% discount</span> and unlock all features with Superb Pixels Premium. 
    The discount is only available for a limited time.

    <div>
    <a style='margin-bottom:15px;' class='button button-large button-secondary' target='_blank' href='https://superbthemes.com/superb-pixels/'>Read More</a> <a style='margin-bottom:15px;' class='button button-large button-primary' target='_blank' href='https://superbthemes.com/superb-pixels/'>Upgrade Now</a>
    </div>

    ", "info");



  $options_notification_start = array("delay"=> "-1 seconds", "wpautop" => false);
  $notifications->Add("superb_pixels_notification_start", "Let's get you started with Superb Pixels!", '
    <span class="st-notification-wrapper">
    <span class="st-notification-column-wrapper">
    <span class="st-notification-column">
    <img src="'. esc_url( get_template_directory_uri() . '/inc/admin_notification/src/preview.png' ).'" width="150" height="177" />
    </span>

    <span class="st-notification-column">
    <h2>Why Superb Pixels</h2>
    <ul class="st-notification-column-list">
    <li>Easy to Use & Customize</li>
    <li>Search Engine Optimized</li>
    <li>Lightweight and Fast</li>
    <li>Top-notch Customer Support</li>
    </ul>
    <a href="https://superbthemes.com/demo/superb-pixels/" target="_blank" class="button">View Superb Pixels Demo <span aria-hidden="true" class="dashicons dashicons-external"></span></a> 

    </span>
    <span class="st-notification-column">
    <h2>Customize Superb Pixels</h2>
    <ul>
    <li><a href="'. esc_url( admin_url( 'customize.php' ) ) .'" class="button button-primary">Customize The Design</a></li>
    <li><a href="'. esc_url( admin_url( 'widgets.php' ) ) .'" class="button button-primary">Add/Edit Widgets</a></li>
    <li><a href="https://superbthemes.com/customer-support/" target="_blank" class="button">Contact Support <span aria-hidden="true" class="dashicons dashicons-external"></span></a> </li>
    </ul>
    </span>
    </span>
    <span class="st-notification-footer">
    Superb Pixels is created by SuperbThemes. We have 100.000+ users and are rated <strong>Excellent</strong> on Trustpilot <img src="'. esc_url( get_template_directory_uri() . '/inc/admin_notification/src/stars.svg' ).'" width="87" height="16" />
    </span>
    </span>

    <style>.st-notification-column-wrapper{width:100%;display:-webkit-box;display:-ms-flexbox;display:flex;border-top:1px solid #eee;padding-top:20px;margin-top:3px}.st-notification-column-wrapper h2{margin:0}.st-notification-footer img{margin-bottom:-3px;margin-left:10px}.st-notification-column-wrapper .button{min-width:180px;text-align:center;margin-top:10px}.st-notification-column{margin-right:10px;padding:0 10px;max-width:250px;width:100%}.st-notification-column img{border:1px solid #eee}.st-notification-footer{display:inline-block;width:100%;padding:15px 0;border-top:1px solid #eee;margin-top:10px}.st-notification-column:first-of-type{padding-left:0;max-width:160px}.st-notification-column-list li{list-style-type:circle;margin-left:15px;font-size:14px}@media only screen and (max-width:1000px){.st-notification-column{max-width:33%}}@media only screen and (max-width:800px){.st-notification-column{max-width:50%}.st-notification-column:first-of-type{display:none}}@media only screen and (max-width:600px){.st-notification-column-wrapper{display:block}.st-notification-column{width:100%;max-width:100%;display:inline-block;padding:0;margin:0}span.st-notification-column:last-of-type{margin-top:30px}}</style>

    ', "info", $options_notification_start);
  $notifications->Boot();
}