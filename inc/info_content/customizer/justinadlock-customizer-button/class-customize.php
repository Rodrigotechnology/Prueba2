<?php

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class superb_pixels_theme_Customize
{

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance()
	{

		static $instance = null;

		if (is_null($instance)) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct()
	{
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions()
	{

		// Register panels, sections, settings, controls, and partials.
		add_action('customize_register', array($this, 'sections'));

		// Register scripts and styles for the controls.
		add_action('customize_controls_enqueue_scripts', array($this, 'enqueue_control_scripts'), 0);
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections($manager)
	{

		// Load custom sections.
		require_once(trailingslashit(get_template_directory()) . 'inc/info_content/customizer/justinadlock-customizer-button/section-pro.php');
		require_once(trailingslashit(get_template_directory()) . 'inc/info_content/customizer/justinadlock-customizer-button/control-pro.php');

		// Register custom section types.
		$manager->register_section_type('superb_pixels_theme_Customize_Section_Pro');
		//$manager->register_control_type('superb_pixels_theme_Customize_Control_Pro');

		// Register sections.
		$manager->add_section(
			new superb_pixels_theme_Customize_Section_Pro(
				$manager,
				'superb_pixels_theme',
				array(
					'title'    => esc_html__('Upgrade To Premium 👑', 'superb-pixels'),
					'pro_description' => esc_html__('Unlock all customization options with premium. Customize all colors, fonts, layouts, 1-click design and much more!', 'superb-pixels'),
					'pro_text' => esc_html__('View Premium Version', 'superb-pixels'),
					'pro_url'  => 'https://superbthemes.com/superb-pixels/',
					'priority'  => '0'
				)
			)
		);

		$manager->add_setting("superb_pixels_theme_control");
		$manager->add_control(
			new superb_pixels_theme_Customize_Control_Pro(
				$manager,
				'superb_pixels_theme_control',
				array(
					'label'    => esc_html__('Upgrade To Premium 👑', 'superb-pixels'),
					'pro_description' => esc_html__('Upgrade to premium and Unlock all customization options. Customize all colors, fonts, layouts, 1-click design and much more!', 'superb-pixels'),
					'pro_text' => esc_html__('View Premium Version', 'superb-pixels'),
					'pro_url'  => 'https://superbthemes.com/superb-pixels/',
					'priority'  => '999',
					'settings' => 'superb_pixels_theme_control',
					'section' => 'superbthemes_customizer_section_color_scheme',
				)
			)
		);


		$manager->add_setting("superb_pixels_theme_control_layout");
		$manager->add_control(
			new superb_pixels_theme_Customize_Control_Pro(
				$manager,
				'superb_pixels_theme_control_layout',
				array(
					'label'    => esc_html__('Upgrade To Premium 👑', 'superb-pixels'),
					'pro_description' => esc_html__('Upgrade to premium and Unlock all customization options. Customize all colors, fonts, layouts, 1-click design and much more!', 'superb-pixels'),
					'pro_text' => esc_html__('View Premium Version', 'superb-pixels'),
					'pro_url'  => 'https://superbthemes.com/superb-pixels/',
					'priority'  => '999',
					'settings' => 'superb_pixels_theme_control_layout',
					'section' => 'superbthemes_customizer_panel_LAYOUTsuperbthemes_customizer_section_single',
				)
			)
		);



		$manager->add_setting("superb_pixels_theme_control_nav");
		$manager->add_control(
			new superb_pixels_theme_Customize_Control_Pro(
				$manager,
				'superb_pixels_theme_control_nav',
				array(
					'label'    => esc_html__('Upgrade To Premium 👑', 'superb-pixels'),
					'pro_description' => esc_html__('Upgrade to premium and Unlock all customization options. Customize all colors, fonts, layouts, 1-click design and much more!', 'superb-pixels'),
					'pro_text' => esc_html__('View Premium Version', 'superb-pixels'),
					'pro_url'  => 'https://superbthemes.com/superb-pixels/',
					'priority'  => '999',
					'settings' => 'superb_pixels_theme_control_nav',
					'section' => 'superbthemes_customizer_panel_LAYOUTsuperbthemes_customizer_section_sidebar',
				)
			)
		);



		$manager->add_setting("superb_pixels_theme_control_postpage");
		$manager->add_control(
			new superb_pixels_theme_Customize_Control_Pro(
				$manager,
				'superb_pixels_theme_control_postpage',
				array(
					'label'    => esc_html__('Upgrade To Premium 👑', 'superb-pixels'),
					'pro_description' => esc_html__('Upgrade to premium and Unlock all customization options. Customize all colors, fonts, layouts, 1-click design and much more!', 'superb-pixels'),
					'pro_text' => esc_html__('View Premium Version', 'superb-pixels'),
					'pro_url'  => 'https://superbthemes.com/superb-pixels/',
					'priority'  => '999',
					'settings' => 'superb_pixels_theme_control_postpage',
					'section' => 'superbthemes_customizer_panel_LAYOUTsuperbthemes_customizer_section_general',
				)
			)
		);


	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts()
	{

		wp_enqueue_script('superb-pixels-customize-controls', trailingslashit(get_template_directory_uri()) . 'inc/info_content/customizer/justinadlock-customizer-button/customize-controls.js', array('customize-controls'));

		wp_enqueue_style('superb-pixels-customize-controls', trailingslashit(get_template_directory_uri()) . 'inc/info_content/customizer/justinadlock-customizer-button/customize-controls.css', array(), "1.0");
	}
}

// Doing this customizer thang!
superb_pixels_theme_Customize::get_instance();
