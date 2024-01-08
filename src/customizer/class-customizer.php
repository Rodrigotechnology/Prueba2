<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\CustomizerPanels;
use SuperbThemesCustomizer\CustomizerSections;
use SuperbThemesCustomizer\CustomizerControls;

use SuperbThemesCustomizer\CustomizerColorScheme;
use SuperbThemesCustomizer\Modules\Services\ShortPixelController;
use SuperbThemesCustomizer\Utils\CustomizerRefocusButton;

class CustomizerController
{
	private static $Instance;
	public static function GetInstance()
	{
		if (!isset(self::$Instance)) {
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	private static $CustomizerObject = false;
	private static $COLOR_SCHEME = false;
	private static $RefocusButtons = array();

	public function __construct()
	{
		add_action('customize_register', array($this, 'superbthemes_customizer_customize_register_init'));
		add_action('customize_controls_print_styles', array($this, 'superbthemes_customizer_customizer_scripts'));
		add_action('customize_controls_print_footer_scripts', array($this, 'superbthemes_customizer_customizer_footer_scripts'));
		add_action('customize_preview_init', array($this, 'superbthemes_customizer_preview_scripts'));
		add_action('customize_controls_enqueue_scripts', array($this, 'superbthemes_customizer_scripts'));
		add_action('wp_head', array($this, 'superbthemes_customizer_css_final_output'));
		add_action('wp_enqueue_scripts', array($this, 'superbthemes_customizer_scripts_final_output'), 0);
		new ShortPixelController();
	}

	public static function GetColorScheme()
	{
		if (!self::$COLOR_SCHEME) {
			self::$COLOR_SCHEME = new CustomizerColorScheme();
		}
		return self::$COLOR_SCHEME;
	}

	public function superbthemes_customizer_customize_register_init($wp_customize)
	{
		self::$CustomizerObject = $wp_customize;
		new CustomizerPanels();
		new CustomizerSections();
		new CustomizerControls(self::GetColorScheme());

		/* Overwrite values */
		$this->OverwriteValues();
		/* */

		self::$CustomizerObject = false;
	}


	private function OverwriteValues()
	{
		$wp_customize = self::$CustomizerObject;
		if (isset($wp_customize->selective_refresh)) {
			$wp_customize->selective_refresh->add_partial('blogname', array(
				'selector'        => '.logofont',
				'render_callback' => array($this, 'superbthemes_customizer_customize_partial_blogname'),
			));
			$wp_customize->selective_refresh->add_partial('blogdescription', array(
				'selector'        => '.logodescription',
				'render_callback' => array($this, 'superbthemes_customizer_customize_partial_blogdescription'),
			));
		}

		$wp_customize->get_control('custom_logo')->priority = 0;
		$wp_customize->get_section('background_image')->panel = 'superb-pixels-site-bg-panel';
		$wp_customize->get_control('background_color')->section = 'background_image';

		$wp_customize->get_control('header_textcolor')->section = CustomizerSections::COLOR_SCHEME;
		$wp_customize->get_control('header_textcolor')->label = __('Logo Text Color', 'superb-pixels');
		$wp_customize->get_control('header_textcolor')->description = __('Sets the text colors for the logo.', 'superb-pixels');
		$wp_customize->get_control('header_textcolor')->priority = 99;

		$wp_customize->get_control('header_image')->section = CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT;
		$wp_customize->get_section(CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT)->title = __('Default Header', 'superb-pixels');
	}

	public function superbthemes_customizer_preview_scripts()
	{
		wp_enqueue_script('superb-pixels-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array('customize-preview'), wp_get_theme()->Version, true);
		wp_localize_script('superb-pixels-customizer-preview', 'superb_pixels_customizer_preview_variables', array(
			'COLOR_VARIABLES' => self::$COLOR_SCHEME->GetColorIdsNoVariants(),
			'COLOR_VARIABLES_VARIANTS' => self::$COLOR_SCHEME->GetColorIdsVariantsOnly()
		));
	}

	public function superbthemes_customizer_scripts()
	{
		wp_enqueue_script('superb-pixels-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), wp_get_theme()->Version, true);
		wp_localize_script('superb-pixels-customizer', 'superb_pixels_customizer_variables', array(
			'COLOR_VARIABLES_VARIANTS' => self::$COLOR_SCHEME->GetColorIdsVariantsOnly()
		));
	}

	public function superbthemes_customizer_customizer_scripts()
	{
		wp_enqueue_style('superb-pixels-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), wp_get_theme()->Version);
	}

	public function superbthemes_customizer_customizer_footer_scripts()
	{
		echo '<script id="superbthemes-customizer-refocus-buttons">';
		foreach (self::$RefocusButtons as $RefocusButton) {
			echo "
			wp.customize.control( '" . esc_attr($RefocusButton->GetWrapperId()) . "', function( control ) {
				control.container.find( '.superbthemes-customizer-refocus-button' ).on( 'click', function() {
					wp.customize." . esc_html($RefocusButton->GetType()) . "( '" . esc_attr($RefocusButton->GetRefocusId()) . "' ).focus();
					} );
					} );
					";
		}
		echo '</script>';
	}

	public static function AddRefocusButtonToScripts($button)
	{
		if ($button instanceof CustomizerRefocusButton) {
			self::$RefocusButtons[] = $button;
		}
	}

	public static function GetCustomizerObject()
	{
		return self::$CustomizerObject;
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function superbthemes_customizer_customize_partial_blogname()
	{
		bloginfo('name');
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function superbthemes_customizer_customize_partial_blogdescription()
	{
		bloginfo('description');
	}

	public function superbthemes_customizer_scripts_final_output()
	{
		if (
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
		) {
			wp_enqueue_script('superb-pixels-colcade-masonry', get_template_directory_uri() . '/js/lib/colcade.js', array('jquery'), wp_get_theme()->Version, false);
			wp_enqueue_script('superb-pixels-colcade-masonry-init', get_template_directory_uri() . '/js/colcade-init.js', false, wp_get_theme()->Version, true);
		}
		if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_BOXMODE) == "1") {
			$boxmode_media_rule = CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_BOXMODE_HIDE_MOBILE) == "1" ? "all and (min-width: 600px)" : "all";
			wp_enqueue_style('superb-pixels-boxed', get_template_directory_uri() . '/css/boxed-theme-mode.css', array(), wp_get_theme()->Version, $boxmode_media_rule);
		}
	}

	public function superbthemes_customizer_css_final_output()
	{ ?>
		<style type="text/css">
			<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_LAYOUT_STYLE) === CustomizerControls::NAVIGATION_LAYOUT_CHOICE_LARGE) : ?>.content-wrap.navigation-layout-large {
				width: 1480px;
				padding: 0;
			}

			.main-navigation ul li a {
				font-size: var(--font-primary-medium);
			}

			.header-content-container.navigation-layout-large {
				padding: 25px 0 20px;
			}

			.header-content-author-container,
			.header-content-some-container {
				display: flex;
				align-items: center;
				min-width: 300px;
				max-width: 300px;
			}

			.header-content-some-container {
				justify-content: right;
			}

			.header-content-some-container a {
				text-align: center;
			}

			.logo-container.navigation-layout-large {
				text-align: center;
				width: 100%;
				max-width: calc(100% - 600px);
				padding: 0 10px;
			}

			.header-author-container-img-wrapper {
				min-width: 60px;
				min-height: 60px;
				max-width: 60px;
				max-height: 60px;
				margin-right: 10px;
				border-radius: 50%;
				border-style: solid;
				border-width: 2px;
				border-color: var(--superb-pixels-primary);
				overflow: hidden;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: center;
			}

			.header-author-container-text-wrapper .header-author-name {
				display: block;
				font-size: var(--font-primary-large);
				font-family: var(--font-primary);
				font-weight: var(--font-primary-bold);
				color: var(--superb-pixels-foreground);
			}

			.header-author-container-text-wrapper .header-author-tagline {
				margin: 0;
				font-family: var(--font-primary);
				font-family: var(--font-primary-small);
				display: block;
				color: var(--superb-pixels-foreground);
			}

			.logo-container a.custom-logo-link {
				margin-top: 0px;
			}

			.navigation-layout-large .site-title {
				font-family: var(--font-secondary);
				font-weight: var(--font-secondary-default);
				font-size: var(--font-secondary-xxl);
				margin: 0 0 15px 0;
			}

			p.logodescription {
				margin-top: 0;
			}

			.header-content-some-container a {
				background-color: var(--superb-pixels-primary);
				border-radius: 25px;
				padding: 15px 25px;
				font-family: var(--font-primary);
				font-weight: var(--font-primary-bold);
				font-family: var(--font-primary-small);
				text-decoration: none;
				display: inline-block;
				-webkit-transition: 0.2s all;
				-o-transition: 0.2s all;
				transition: 0.2s all;
			}

			.header-content-some-container a:hover {
				background-color: var(--superb-pixels-primary-dark);
			}

			.navigation-layout-large .center-main-menu {
				max-width: 100%;
			}

			.navigation-layout-large .center-main-menu .pmenu {
				text-align: center;
				float: none;
			}

			.navigation-layout-large .center-main-menu .wc-nav-content {
				justify-content: center;
			}


			<?php endif; ?>.custom-logo-link img {
				width: auto;
				max-height: <?php echo absint(CustomizerControls::GetSelectedOrDefault(CustomizerControls::SITE_IDENTITY_LOGO_HEIGHT)); ?>px;
			}

			<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_ONE_COLUMNS) : ?>.all-blog-articles {
				display: block;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 100%;
				max-width: 100%;
				flex: 100%;
			}

			.all-blog-articles article h2.entry-title {
				font-size: var(--font-secondary-xxl);
			}

			@media (max-width: 1100px) {
				.all-blog-articles article h2.entry-title {
					font-size: var(--font-secondary-xl);
				}
			}

			@media (max-width: 700px) {
				.all-blog-articles article h2.entry-title {
					font-size: var(--font-secondary-large);
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
				width: 100%;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list p {
				margin: 0;
			}

			.all-blog-articles article h2.entry-title {
				font-size: var(--font-secondary-large);
			}



			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 31%;
				max-width: 31%;
				-webkit-box-flex: 31%;
				-ms-flex: 31%;
				flex: 31%;
				margin-bottom: 30px;
			}

			.entry-title {
				font-size: var(--font-secondary-large);
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header {
				display: -webkit-box;
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
				width: 100%;
			}

			.add-blog-to-sidebar .all-blog-articles .blogposts-list p {
				margin: 0;
			}

			@media (max-width: 1024px) {
				.add-blog-to-sidebar .all-blog-articles .blogposts-list {
					width: 48%;
					max-width: 48%;
					-webkit-box-flex: 48%;
					-ms-flex: 48%;
					flex: 48%;
				}
			}

			@media (max-width: 600px) {
				.add-blog-to-sidebar .all-blog-articles .blogposts-list {
					width: 100%;
					max-width: 100%;
					-webkit-box-flex: 100%;
					-ms-flex: 100%;
					flex: 100%;
				}
			}

			<?php endif; ?><?php if (
								CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
								CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
							) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 100%;
				max-width: 100%;
			}

			.all-blog-articles article h2.entry-title {
				font-size: var(--font-secondary-large);
			}

			.superb-pixels-colcade-column {
				-webkit-box-flex: 1;
				-webkit-flex-grow: 1;
				-ms-flex-positive: 1;
				flex-grow: 1;
				margin-right: 2%;
			}

			.superb-pixels-colcade-column.superb-pixels-colcade-last {
				margin-right: 0;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY) : ?>.superb-pixels-colcade-column {
				max-width: 48%;
			}

			@media screen and (max-width: 800px) {
				.superb-pixels-colcade-column {
					max-width: 100%;
					margin-right: 0;
				}

				.superb-pixels-colcade-column:not(.superb-pixels-colcade-first) {
					display: none !important;
				}

				.superb-pixels-colcade-column.superb-pixels-colcade-first {
					display: block !important;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY) : ?>.superb-pixels-colcade-column {
				max-width: 31%;
			}

			@media screen and (max-width: 1024px) {
				.superb-pixels-colcade-column {
					max-width: 48%;
				}

				.superb-pixels-colcade-column.superb-pixels-colcade-last {
					display: none;
				}
			}

			@media screen and (max-width: 600px) {
				.superb-pixels-colcade-column {
					max-width: 100%;
					margin-right: 0px;
				}

				.superb-pixels-colcade-column:not(.superb-pixels-colcade-first) {
					display: none !important;
				}

				.superb-pixels-colcade-column.superb-pixels-colcade-first {
					display: block !important;
				}
			}

			<?php endif; ?><?php if (get_theme_mod(CustomizerControls::SIDEBAR_WOOCOMMERCE_HIDE) == '1') : ?>.woocommerce-page .wc-sidebar-wrapper {
				display: none;
			}

			.woocommerce-page .featured-content {
				width: 100%;
				margin-right: 0px;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) == CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE) : ?>.blogposts-list .featured-thumbnail {
				height: 200px;
				background-size: cover;
				background-position: center;
			}

			.related-posts-posts .blogposts-list .featured-thumbnail {
				height: 200px;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) == CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) : ?>.blogposts-list .featured-thumbnail {
				height: 200px;
				display: flex;
				align-items: center;
				justify-content: center;
				overflow: hidden;
			}

			.related-posts-posts .blogposts-list .featured-thumbnail {
				height: 200px;
			}

			.blogposts-list .featured-thumbnail img {
				z-index: 1;
				border-radius: 0;
				width: auto;
				height: auto;
				max-height: 100%;
			}

			.blogposts-list .featured-thumbnail .featured-img-category {
				z-index: 2;
			}

			.blogposts-list .featured-img-bg-blur {
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				background-size: cover;
				background-position: center;
				filter: blur(5px);
				opacity: .5;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) == CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE) : ?>.featured-thumbnail-cropped {
				min-height: 360px;
			}

			@media screen and (max-width: 1024px) {
				.featured-thumbnail-cropped {
					min-height: 300px;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) == CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) : ?>.featured-thumbnail-cropped {
				position: relative;
				min-height: 360px;
				display: flex;
				align-items: center;
				justify-content: center;
				overflow: hidden;
			}

			@media screen and (max-width: 1024px) {
				.featured-thumbnail-cropped {
					min-height: 300px;
				}
			}

			.featured-thumbnail-cropped img {
				width: auto;
				height: auto;
				max-height: 100%;
			}

			.featured-thumbnail-cropped .featured-img-bg-blur {
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				background-size: cover;
				background-position: center;
				filter: blur(5px);
				opacity: .5;
			}

			.featured-thumbnail-cropped img {
				z-index: 1;
			}

			<?php endif; ?>

			/** COLOR SCHEME **/
			:root {
				<?php
				foreach (self::GetColorScheme()->GetColors() as $customizerColor) {
					echo esc_html($customizerColor->GetId()) . ': ' . esc_html(CustomizerControls::GetSelectedOrDefault($customizerColor->GetId())) . ';';
				} ?>
			}

			/** COLOR SCHEME **/
		</style>

<?php
	}


	public function superbthemes_customizer_blog_first_row_has_thumbnail()
	{
		/* ** Only Display Navigation::before BG Color if First Row Has Thumbnail ** */
		global $wp_query;
		if (have_posts()) {
			$superb_pixels_has_first_row_image = false;
			$superb_pixels_has_first_row_current_idx = 0;
			switch (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE)) {
				case CustomizerControls::BLOGFEED_ONE_COLUMNS:
					$superb_pixels_has_first_row_idx_max = 1;
					break;
				case CustomizerControls::BLOGFEED_TWO_COLUMNS:
					$superb_pixels_has_first_row_idx_max = 2;
					break;
				case CustomizerControls::BLOGFEED_THREE_COLUMNS:
				default:
					$superb_pixels_has_first_row_idx_max = 3;
					break;
			}
			foreach ($wp_query->posts as $superb_pixels_current_post_in_loop) {
				if ($superb_pixels_has_first_row_current_idx >= $superb_pixels_has_first_row_idx_max) {
					break;
				}
				$this_has_image = has_post_thumbnail($superb_pixels_current_post_in_loop->ID);
				if ($this_has_image) {
					$superb_pixels_has_first_row_image = true;
					break;
				}
				$superb_pixels_has_first_row_current_idx++;
			}

			return $superb_pixels_has_first_row_image;
		}
		/* **************************************************************************************** */
	}

	public static function MaybeGetMasonryColumnOutput()
	{
		$selected_blog_style = CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE);
		if (
			$selected_blog_style === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
			$selected_blog_style === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
		) {
			$col_amount = $selected_blog_style === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ? 2 : 3;
			for ($i = 1; $i <= $col_amount; $i++) {
				echo '<div class="superb-pixels-colcade-column' . ($i === $col_amount ? ' superb-pixels-colcade-last' : ($i === 1 ? ' superb-pixels-colcade-first' : '')) . '"></div>';
			}
		}
	}
}
