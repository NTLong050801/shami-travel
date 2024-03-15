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
class Newsletter_Form extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_newsletter_form';
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
        return esc_html__( 'Travic Newsletter Form', 'travic' );
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
        return 'eicon-icon-box';
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
            'newsletter_form',
            [
                'label' => esc_html__( 'Newsletter Form', 'travic' ),
            ]
        );
		
		$this->add_control(
			'layout_control',
			[
				'label'   => esc_html__( 'Layout Style', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => array(
					'1' => esc_html__( 'Style One ', 'travic'),
					'2' => esc_html__( 'Style Two ', 'travic'),
					'3' => esc_html__( 'Style Three ', 'travic'),
					'4' => esc_html__( 'Style Four ', 'travic'),
				),
			]
		);
		$this->add_control(
            'show_shapes',
			[
				'label' => __( 'Enable/Disable Shape Images', 'travic' ),
				'type'     => Controls_Manager::SWITCHER,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enable/Disable Shape Images', 'travic' ),
			]
		);
		$this->add_control(
			'feature_image',
			[
				'label' => esc_html__( 'Background Image', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => ['layout_control' => ['2', '3', '4'], ],
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'travic' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your title', 'travic' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'travic' ),
			]
		);
		$this->add_control(
			'mailchimp_form_url',
			[
				'label' => esc_html__( 'MailChimp Form url', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your MailChimp Form url', 'travic' ),
				'default' => esc_html__( '[mc4wp_form id=1243]', 'travic' ),
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
                    '{{WRAPPER}} .te-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .te-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .te-icon-box',				
			]
		);
		$this->end_controls_section();
		
		//Title Style
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
            'title__margin',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		
        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bgtype',
				'label' => __( 'Background', 'travic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .te-title',				
			]
		);
		
		$this->add_control(
			'title_color',
			[

				'label' => esc_html__( 'Title Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __('Typography', 'travic'),
				'selector' => '{{WRAPPER}} .te-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .te-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'selector' => '{{WRAPPER}} .te-title',
			]
		);
		
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
							'{{WRAPPER}} .form-group button' => 'width: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .form-group button' => 'height: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .form-group button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .form-group button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'btn_border_type',
						'selector' => 
							'{{WRAPPER}} .form-group button',				
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
							'{{WRAPPER}} .form-group button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'btn_title_typography',
						'label' => __('Button Icon Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .form-group button',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_title_icon_color',
					[
						'label' => esc_html__( 'Button Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .form-group button' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'btn_title_hover_color',
					[
						'label' => esc_html__( 'Button Hover Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .form-group button:hover' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'btn_title_bg_icon_color',
					[
						'label' => esc_html__( 'Background Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .form-group button' => 'background-color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'btn_title_bg_hover_color',
					[
						'label' => esc_html__( 'Background Hover Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .form-group button:before' => 'background: {{VALUE}};',
						],
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
        
        <?php if($settings['layout_control'] == '4') :?>
        
        <!-- subscribe-style-two -->
        <section class="subscribe-style-two about-page alternat-2 te-icon-box">
            <div class="bg-color"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <?php if($settings['feature_image']['id']){ ?><div class="bg-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"></div><?php } ?>
                    <?php if($settings[ 'show_shapes']) {?>
                    <div class="shape">
                        <div class="shape-1" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-16.png);"></div>
                        <div class="shape-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-17.png);"></div>
                    </div>
                    <?php } ?>
                    <div class="content-box">
                        <?php if($settings[ 'title']) {?><h2 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h2><?php } ?>
                        <div class="form-inner">
                            <?php echo do_shortcode($settings['mailchimp_form_url'] ) ;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-style-two end -->
		
		<?php elseif($settings['layout_control'] == '3') :?>
        
        <!-- subscribe-style-two -->
        <section class="subscribe-style-two about-page alternat-2 te-icon-box">
            <div class="auto-container">
                <div class="inner-container">
                    <?php if($settings['feature_image']['id']){ ?><div class="bg-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"></div><?php } ?>
                    <?php if($settings[ 'show_shapes']) {?>
                    <div class="shape">
                        <div class="shape-1" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-16.png);"></div>
                        <div class="shape-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-17.png);"></div>
                    </div>
                    <?php } ?>
                    <div class="content-box">
                        <?php if($settings[ 'title']) {?><h2 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h2><?php } ?>
                        <div class="form-inner">
                            <?php echo do_shortcode($settings['mailchimp_form_url'] ) ;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-style-two end -->
		
		<?php elseif($settings['layout_control'] == '2') :?>
        
        <!-- subscribe-style-two -->
        <section class="subscribe-style-two te-icon-box">
            <div class="bg-color te-icon-box"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <?php if($settings['feature_image']['id']){ ?><div class="bg-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"></div><?php } ?>
                    <?php if($settings[ 'show_shapes']) {?>
                    <div class="shape">
                        <div class="shape-1" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-16.png);"></div>
                        <div class="shape-2" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-17.png);"></div>
                    </div>
                    <?php } ?>
                    <div class="content-box">
                        <?php if($settings[ 'title']) {?><h2 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h2><?php } ?>
                        <div class="form-inner">
                            <?php echo do_shortcode($settings['mailchimp_form_url'] ) ;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-style-two end -->
        
        <?php else: ?>
        
        <!-- subscribe-section -->
        <section class="subscribe-section te-icon-box">
            <div class="bg-color te-icon-box"></div>
            <div class="auto-container">
                <div class="inner-container">
                    <?php if($settings[ 'show_shapes']) {?><div class="shape" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-4.png);"></div><?php } ?>
                    <div class="row align-items-center">
                        <?php if($settings[ 'title']) {?>
                        <div class="col-lg-6 col-md-12 col-sm-12 text-column">
                            <div class="text-box mr_50">
                                <h2 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h2>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-6 col-md-12 col-sm-12 form-column">
                            <div class="form-inner ml_65">
                                <?php echo do_shortcode($settings['mailchimp_form_url'] ) ;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-section end -->  
        	
    	
    <?php endif;
    }
}