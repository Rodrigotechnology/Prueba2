<?php
defined("ABSPATH") || exit();


add_action('admin_menu', 'superb_pixels_themepage');
function superb_pixels_themepage()
{
    add_menu_page(__('Theme Settings', 'superb-pixels'), __('Theme Settings', 'superb-pixels'), 'manage_options', 'superb_pixels_themepage', 'superb_pixels_themepage_content', get_template_directory_uri() . '/inc/info_content/themepage/src/wp-icon-superb.svg', 61);
}

function superb_pixels_themepage_content()
{
    require_once(trailingslashit(get_template_directory()) . 'inc/info_content/themepage/src/themepage.php');
}

function superb_pixels_comparepage_css($hook)
{
    if ('toplevel_page_superb_pixels_themepage' != $hook) {
        return;
    }
    wp_enqueue_style('superb-pixels-custom-style', get_template_directory_uri() . '/inc/info_content/themepage/src/compare.css');
}
add_action('admin_enqueue_scripts', 'superb_pixels_comparepage_css');

// Theme page end
