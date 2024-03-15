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
class Our_Features extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_our_features';
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
        return esc_html__( 'Travic Our Features', 'travic' );
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
            'our_features',
            [
                'label' => esc_html__( 'Our Features', 'travic' ),
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
				),
			]
		);
		$this->add_control(
			'feature_image',
			[
				'label' => esc_html__( 'Feature Image', 'travic' ),
				'type' => Controls_Manager::MEDIA,
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
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your title', 'travic' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'travic' ),
			]
		);
		$this->add_control(
			'title2',
			[
				'label' => esc_html__( 'Dicount', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'layout_control' => ['2', '3'],
				],
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your Dicount', 'travic' ),
			]
		);
		$this->add_control(
			'title3',
			[
				'label' => esc_html__( 'Designation', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'layout_control' => ['2', '3'],
				],
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your Designation', 'travic' ),
			]
		);
		$this->add_control(
			'btn_title',
			[
				'label' => esc_html__( 'Button Title', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'layout_control' => ['2', '3'],
				],
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your Button title', 'travic' ),
			]
		);		
		$this->add_control(
			'link_option',
			[
				'label'   => esc_html__( 'Select link Option', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'extranal',
				'options' => array(
					'extranal' => esc_html__( 'Extranal ', 'travic'),
					'page' => esc_html__( 'Page ', 'travic'),
				),
			]
		);		
		$this->add_control(
			'link',
			[
				'label' => __( 'External Link', 'travic' ),
				'type' => Controls_Manager::URL,
				'label_block' => true, 
				'placeholder' => __( 'https://your-link.com', 'travic' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition'   => [
					'link_option' => 'extranal'
				]
			]
		);		
		$this->add_control(
			'page_select',
			[
				'label'   => esc_html__( 'Select Page', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT2,
				'default' => 'extranal',
				'options' => travic_page_list(),
				'condition'   => [
					'link_option' => 'page'
				]
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
					'{{WRAPPER}} .te-title a' => 'color: {{VALUE}};',
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
		
		//Discount Style		
		$this->start_controls_section(
			'text_style3',
			[
				'label' => esc_html__( 'Discount Style', 'travic' ),
				'condition' => ['layout_control' => ['2', '3'], ],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
            'text__margin3',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		
        $this->add_responsive_control(
            'text_padding3',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		
		$this->add_control(
			'text_color3',
			[
				'label' => esc_html__( 'Text Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography3',
				'label' => __('Typography', 'travic'),
				'selector' => '{{WRAPPER}} .te-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_text_shadow3',
				'selector' => '{{WRAPPER}} .te-text',
			]
		);

		$this->end_controls_section();
		
		/**Designation Style**/
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('DESIGNATION SETTING', 'travic'),
				'condition' => ['layout_control' => ['2', '3'], ],
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_content_style',
			[
				'label'       => __( 'ON/OFF  Designation Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);	
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bgtype',
				'label' => __( 'Content Background', 'travic' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 
					'{{WRAPPER}} .te-circle',				
				'condition'             => [
					'show_content_style'    => 'yes',
				]
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Content Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-circle',                 
                'separator' => 'before',
				'condition'             => [
					'show_content_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'content_color',
            [
                'label' => __('Content Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-circle' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_content_style'    => 'yes',
				]
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
							'{{WRAPPER}} .te-btn' => 'width: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .te-btn' => 'height: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .te-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .te-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'btn_border_type',
						'selector' => 
							'{{WRAPPER}} .te-btn',				
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
							'{{WRAPPER}} .te-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'btn_title_typography',
						'label' => __('Button Icon Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .te-btn',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_title_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .te-btn' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'btn_title_bg_icon_color',
					[
						'label' => esc_html__( 'Icon Background Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .te-btn' => 'background-color: {{VALUE}};',
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
		
		$page = $settings['link_option'];
		$page_select = $settings[ 'page_select' ];
		$ext_url = $settings[ 'link' ];
		
		if( $page == 'page' ){
			$mount_link = get_page_link( $page_select );
		}else{
			$mount_link = $ext_url['url'];
			$target = $ext_url['is_external'] ? ' target="_blank"' : '';
			$nofollow = $ext_url['nofollow'] ? ' rel="nofollow"' : '';
		}
	?>
    
    <?php 
		if($settings['layout_control'] == '3') :
	?>
        
    <div class="travic-block">
        <div class="offers-block-one">
            <div class="inner-box te-icon-box" <?php if($settings['feature_image']['id']){ ?> style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"<?php } ?>>
                <?php if($settings[ 'title']) {?><span class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></span><?php } ?>
                <?php if($settings[ 'title2']) {?><h1 class="te-text"><?php echo wp_kses($settings['title2'], true ) ;?></h1><?php } ?>
                <?php if($settings[ 'title3']) {?><p class="text te-circle"><?php echo wp_kses($settings['title3'], true ) ;?></p><?php } ?>
                <?php if($settings[ 'btn_title']) {?><a class="te-btn" href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?> ><?php echo wp_kses($settings['btn_title'], true ) ;?></a><?php } ?>
            </div>
        </div>
    </div>
	
	<?php 
		elseif($settings['layout_control'] == '2') :
	?>
        
    <div class="travic-block">
        <div class="offers-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
            <div class="inner-box te-icon-box" <?php if($settings['feature_image']['id']){ ?> style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"<?php } ?>>
                <?php if($settings[ 'title']) {?><span class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></span><?php } ?>
                <?php if($settings[ 'title2']) {?><h2 class="te-text"><?php echo wp_kses($settings['title2'], true ) ;?></h2><?php } ?>
                <?php if($settings[ 'title3']) {?><p class="te-circle"><?php echo wp_kses($settings['title3'], true ) ;?></p><?php } ?>
                <?php if($settings[ 'btn_title']) {?><a class="te-btn" href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?> ><?php echo wp_kses($settings['btn_title'], true ) ;?></a><?php } ?>
            </div>
        </div>
    </div>
        	
    <?php else: ?>	
    
    <div class="place-block-one">
        <div class="inner-box te-icon-box">
            <?php if($settings['feature_image']['id']){ ?><figure class="image-box"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
            <?php if($settings[ 'title']) {?><span class="text te-title"><a href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?>><?php echo wp_kses($settings['title'], true ) ;?></a></span><?php } ?>
        </div>
    </div>
	
	<?php endif;
    }
}