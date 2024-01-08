<?php

/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class superb_pixels_theme_Customize_Control_Pro extends WP_Customize_Control
{

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'superb_pixels_control';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_description = '';


	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_content()
	{ ?>
		<div class="info-superb-content-customizer-wrapper">
			<h3 class="customize-control-title">
				<?= esc_html($this->label); ?>
			</h3>
			<p>
				<?= esc_html($this->pro_description); ?>
			</p>
			<a href="<?= esc_html($this->pro_url); ?>" class="button button-secondary" target="_blank"><?= esc_html($this->pro_text); ?></a>
		</div>
<?php }
}
