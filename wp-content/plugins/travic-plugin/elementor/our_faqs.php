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
class Our_Faqs extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_our_faqs';
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
        return esc_html__( 'Travic Our Faqs', 'travic' );
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
        return 'eicon-image-box';
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
	
	public function get_script_depends() {
		wp_register_script( 'faq-script', YT_URL . 'assets/js/accordion-tabs.js', [ 'elementor-frontend' ], '1.0.0', true );
		return [ 'faq-script' ];
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
            'our_faqs',
            [
                'label' => esc_html__( 'Our Faqs', 'travic' ),
            ]
        );
		
		
		//Our Slider		
		$repeater = new Repeater();	
		$repeater->add_control(
			'block_title',
			[
				'label'       => __( 'Block Title', 'travic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Block Title', 'travic' ),
			]
		);
		$repeater->add_control(
			'block_text',
			[
				'label'       => __( 'Block Text', 'travic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Block Text', 'travic' ),
			]
		);
		$this->add_control(
			'slides',
			[
				'label'                 => __('Add Slide Item', 'travic'),
				'type'                  => Controls_Manager::REPEATER,
				'fields'                => $repeater->get_controls(),
			]
		);
		
		$this->end_controls_section();
		
		//General Style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__( 'General Setting', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->add_responsive_control(
            'general_margin',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-faq' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );		
        $this->add_responsive_control(
            'general_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-faq' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'general_bgtype',
				'label' => __( 'Background', 'travic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .te-faq',				
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
		
		/**Loop Style**/
		$this->start_controls_section(
			'loop_style',
			[
				'label' => esc_html__('LOOP CONTENT STYLE SETTING', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		//Title Style
		$this->add_control(
			'show_loop_title_style',
			[
				'label'       => __( 'ON/OFF  Title Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'loop_title_typography',
                'label' => __('Title Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .faq-title',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_title_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_title_color',
            [
                'label' => __('Title Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .faq-title' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_title_style'    => 'yes',
				]
            ]
        );
		//Content Style
		$this->add_control(
			'show_loop_value_style',
			[
				'label'       => __( 'ON/OFF  Text Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'loop_value_typography',
                'label' => __('Text Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .faq-text',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_value_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_value_color',
            [
                'label' => __('Text Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .faq-text' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_value_style'    => 'yes',
				]
            ]
        );
		//Icon Style
		$this->add_control(
			'show_icon_style',
			[
				'label'       => __( 'ON/OFF  Icon Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'loop_icon_typography',
                'label' => __('Icon Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .acc-btn .icon-box:before',                 
                'separator' => 'before',
				'condition'             => [
					'show_icon_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_icon_color',
            [
                'label' => __('Icon Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .acc-btn .icon-box:before' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_icon_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_icon_bg_color',
            [
                'label' => __('Icon Background Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .acc-btn .icon-box:before' => 'background-color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_icon_style'    => 'yes',
				]
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
        
   <!-- faq-section -->
    <section class="faq-section te-faq p-0 m-0">
        <div class="inner-box">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-12 col-sm-12 accordion-column">
                    <ul class="accordion-box">
                        <?php $i = 1; $counts = 0; foreach($settings['slides'] as $key => $item):?>
                        <?php if(($counts%5) == 0 && $counts != 0):?>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 accordion-column">
                    <ul class="accordion-box te-faq">
                        <?php endif; ?>
                        <li class="accordion block <?php if($i == 1) echo 'active-block' ?>">
                            <div class="acc-btn <?php if($i == 1) echo 'active' ?>">
                                <div class="icon-box"></div>
                                <h5 class="faq-title"><?php echo wp_kses($item['block_title'], true) ;?></h5>
                            </div>
                            <div class="acc-content <?php if($i == 1) echo 'current' ?>">
                                <div class="text">
                                    <p class="faq-text"><?php echo wp_kses($item['block_text'], true) ;?></p>
                                </div>
                            </div>
                        </li>
                        <?php $i++; $counts++; endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- faq-section end -->
	        
    <?php 
    }
}