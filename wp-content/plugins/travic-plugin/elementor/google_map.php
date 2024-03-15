<?php namespace TRAVICPLUGIN\Element;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Stroke;
use Elementor\Plugin;
/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Google_Map extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_google_map';
    }
    /**
     * Get widget title.
     * Retrieve button widget title.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Travic Google Map', 'travic' );
    }
    /**
     * Get widget icon.
     * Retrieve button widget icon.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-google-maps';
    }
    /**
     * Get widget categories.
     * Retrieve the list of categories the button widget belongs to.
     * Used to determine where to display the widget in the editor.
     *
     * @since  2.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'travic' ];
    }
    /**
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'google_map',
            [
                'label' => esc_html__( 'Google Map', 'travic' ),
            ]
        );
		
		$this->add_control(
			'google_map_code',
			[
				'label'       => __( 'Google Map Iframe Code', 'travic' ),
				'type'        => Controls_Manager::TEXTAREA,				
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Google Map Iframe Code', 'travic' ),
			]
		);
		
		$this->end_controls_section();
		
		/** Style Tab **/
		$this->register_style_background_controls();
    }
	
	/************************************************************************
								Tab Style Start
	*************************************************************************/
	
	protected function register_style_background_controls()
	{	
		/**Layout Control Style**/		
		$this->start_controls_section(
			'travic_layout_style',
			[
				'label' => esc_html__('Buildnox Layout Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'travic_layout_margin',
            [
                'label'              => __( 'Spacing', 'travic' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', 'em', '%' ],
                'selectors'          => [
                    '{{WRAPPER}} .bn-google-map' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'frontend_available' => true,
				
            ]
        );
		$this->add_responsive_control(
            'travic_layout_padding',
            [
                'label'              => __( 'Gapping', 'travic' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', 'em', '%' ],
                'selectors'          => [
                    '{{WRAPPER}} .bn-google-map' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'frontend_available' => true,
				
            ]
        );
		$this->end_controls_section();	
		
    }
	
	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
	?>
    
    <!-- contact-map-section -->
    <section class="contact-map-section">
        <div class="auto-container">
            <div class="map-inner bn-google-map">
                <?php echo do_shortcode($settings['google_map_code']);?>
            </div>
        </div>
    </section>
    <!-- contact-map-section end --> 
	
	<?php
    }
}