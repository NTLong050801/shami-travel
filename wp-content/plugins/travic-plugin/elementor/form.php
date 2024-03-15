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
class Form extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_form';
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
        return esc_html__( 'Travic Form', 'travic' );
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
        return 'eicon-form-horizontal';
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
            'form',
            [
                'label' => esc_html__( 'Form', 'travic' ),
            ]
        );
		
		$this->add_control(
            'cf7_shortocde_v3',
            [
                'label' => esc_html__('Select Contact Form 7', 'travic'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => get_contact_form_7_list(),
            ]
        );
				
		$this->end_controls_section();
		
		/**Form Style**/
		$this->start_controls_section(
			'form_style25',
			[
				'label' => esc_html__('Form Style Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'travic_tabs_form' );
		
			$this->start_controls_tab(
				'travic_tab_form_normal',
				[
					'label' => __( 'Normal', 'travic' ),
				]
			);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'form_bgtype',
						'label' => __( 'Background', 'travic' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => 
							'{{WRAPPER}} .te-contact-form input,
							 {{WRAPPER}} .te-contact-form textarea,
							 {{WRAPPER}} .te-contact-form select',				
					]
				);
				$this->add_responsive_control(
					'form_width_size',
					[
						'label' => __( 'Width', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%', 'custom' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .te-contact-form input' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form textarea' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form select' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'form_height_size',
					[
						'label' => __( 'Height', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%', 'custom' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .te-contact-form input' => 'height: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form textarea' => 'height: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form select' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'form_spacing',
					[
						'label'              => __( 'Spacing', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .te-contact-form input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_responsive_control(
					'form_padding',
					[
						'label'              => __( 'Padding', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .te-contact-form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'form_border_type',
						'selector' => 
							'{{WRAPPER}} .te-contact-form input,
							 {{WRAPPER}} .te-contact-form textarea,
							 {{WRAPPER}} .te-contact-form select',				
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'form_border_box_shadow',
						'selector' => 
							'{{WRAPPER}} .te-contact-form input,
							 {{WRAPPER}} .te-contact-form textarea,
							 {{WRAPPER}} .te-contact-form select',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'form_border_radius',
					[
						'label' => esc_html__('Border Radius', 'travic'),
						'type' => Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => ['px'],
						'selectors' => [
							'{{WRAPPER}} .te-contact-form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .te-contact-form select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'form_title_typography',
						'label' => __('Text Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .te-contact-form input,
							 {{WRAPPER}} .te-contact-form textarea,
							 {{WRAPPER}} .te-contact-form select',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'form_title_color',
					[
						'label' => __('Text Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-contact-form input' => 'color: {{VALUE}}',
							'{{WRAPPER}} .te-contact-form textarea' => 'color: {{VALUE}}',
							'{{WRAPPER}} .te-contact-form select' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
			$this->end_controls_tab();
			
		$this->end_controls_tabs();   
		$this->end_controls_section();
		
		/**Button Style**/
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__('Button Style Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'travic_tabs_btn' );
		
			$this->start_controls_tab(
				'travic_tab_btn_normal',
				[
					'label' => __( 'Normal', 'travic' ),
				]
			);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'btn_bgtype',
						'label' => __( 'Button Background', 'travic' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => 
							'{{WRAPPER}} .btn-one,
							 {{WRAPPER}} .theme-btn-two',				
					]
				);
				$this->add_responsive_control(
					'btn_width_size',
					[
						'label' => __( 'Width', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%', 'custom' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .btn-one' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .theme-btn-two' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'btn_height_size',
					[
						'label' => __( 'Height', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%', 'custom' ],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 500,
							],
							'%' => [
								'min' => 0,
								'max' => 100,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .btn-one' => 'height: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .theme-btn-two' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'btn_margin',
					[
						'label'              => __( 'Margin', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .btn-one' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .theme-btn-two' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_responsive_control(
					'btn_padding',
					[
						'label'              => __( 'Padding', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .btn-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							'{{WRAPPER}} .theme-btn-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'btn_border_type',
						'selector' => 
							'{{WRAPPER}} .btn-one,
							 {{WRAPPER}} .theme-btn-two',				
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'border_box_shadow',
						'selector' => 
							'{{WRAPPER}} .btn-one,
							 {{WRAPPER}} .theme-btn-two',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_border_radius',
					[
						'label' => esc_html__('Border Radius', 'travic'),
						'type' => Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => ['px'],
						'selectors' => [
							'{{WRAPPER}} .btn-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'btn_title_typography',
						'label' => __('Button Text Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .btn-one',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_title_color',
					[
						'label' => __('Button Text Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn-one' => 'color: {{VALUE}}!important',
						],
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_title_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn-one i' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'btn_title_bg_icon_color',
					[
						'label' => esc_html__( 'Icon Background Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn-one i' => 'background-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();
			
			$this->start_controls_tab(
				'travic_tab_btn_hover',
				[
					'label' => __( 'Hover', 'travic' ),
				]
			);
			
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'btn_hover_bg_bgtype',
						'label' => __( 'Button Hover Background', 'travic' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => 
							'{{WRAPPER}} .btn-one:before',				
					]
				);
				$this->add_control(
					'btn_title_hover_color',
					[
						'label' => __('Button Text Hover Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn-one:hover' => 'color: {{VALUE}}!important',
						],
						'separator' => 'before',
					]
				);
			
			$this->end_controls_tab();			
		$this->end_controls_tabs();   
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
	
	<!-- contact-section -->
    <section class="contact-section p-0 m-0">
        <div class="form-inner">
            <div class="default-form te-contact-form"> 
                <?php echo do_shortcode('[contact-form-7 id="'.esc_attr($settings['cf7_shortocde_v3']).'"]'); ?>
            </div>
        </div>
    </section>
    <!-- contact-sectin end -->
            
    <?php 
    }
}