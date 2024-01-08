<?php

/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class superb_pixels_theme_Customize_Section_Pro extends WP_Customize_Section
{

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'superb-pixels';


	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_description = '';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json()
	{
		$json = parent::json();

		$json['pro_text'] = esc_html($this->pro_text);
		$json['pro_description'] = esc_html($this->pro_description);
		$json['pro_url']  = esc_url($this->pro_url);

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template()
	{ ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<div class="info-superb-content-customizer-wrapper">
				<h3 class="accordion-section-title">
					{{ data.title }}
				</h3>
				<p>
					{{ data.pro_description }}
				</p>
				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary" target="_blank">{{ data.pro_text }}</a>
					<# } #>
			</div>
		</li>
<?php }
}
