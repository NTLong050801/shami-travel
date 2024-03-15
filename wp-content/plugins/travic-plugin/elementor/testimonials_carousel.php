<?php

namespace TRAVICPLUGIN\Element;

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
use \Elementor\Group_Control_Image_Size;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Testimonials_Carousel extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'travic_testimonials_carousel';
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
		return esc_html__( 'Travic Testimonials Carousel', 'travic' );
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
		return 'eicon-testimonial-carousel';
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
		wp_register_script( 'testimonial-carousel', YT_URL . 'assets/js/banner-carousel.js', [ 'elementor-frontend' ], '1.0.0', true );
		return [ 'testimonial-carousel' ];
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
			'testimonials_carousel',
			[
				'label' => esc_html__( 'Testimonials Carousel', 'travic' ),
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
				),
			]
		);
		$this->add_control(
			'text_limit',
			[
				'label'   => esc_html__( 'Text Limit', 'travic' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_number',
			[
				'label'   => esc_html__( 'Number of post', 'travic' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
			]
		);
		$this->add_control(
			'query_orderby',
			[
				'label'   => esc_html__( 'Order By', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'       => esc_html__( 'Date', 'travic' ),
					'title'      => esc_html__( 'Title', 'travic' ),
					'menu_order' => esc_html__( 'Menu Order', 'travic' ),
					'rand'       => esc_html__( 'Random', 'travic' ),
				),
			]
		);
		$this->add_control(
			'query_order',
			[
				'label'   => esc_html__( 'Order', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => esc_html__( 'DESC', 'travic' ),
					'ASC'  => esc_html__( 'ASC', 'travic' ),
				),
			]
		);
		$this->add_control(
            'query_category', 
			[
			  'type' => Controls_Manager::SELECT,
			  'label' => esc_html__('Category', 'travic'),
			  'label_block' => true,
			  'options' => get_testimonials_categories(),
			]
		);
		
		
		$this->end_controls_section();
		
		/**Carousel Setting Start**/
		$this->start_controls_section(
			'carousel',
			[
				'label' => esc_html__( 'Carousel Setting', 'travic' ),
			]
		);
		$this->add_control(
			'infinite',
			[
				'label' => __( 'infinite Loop?', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'travic' ),
				'label_off' => __( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
			'items_show',
			[
				'label' => esc_html__( 'No. of Items', 'travic' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'default' => 3,
			]
		);
		$this->add_responsive_control(
			'image_item_gap',
			[
				'label' => __( 'Item Gap', 'travic' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'default' => 30,
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay?', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'travic' ),
				'label_off' => __( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay_speed',
			array(
				'label'       => __( 'Animation Speed', 'travic' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '2500', 'travic' ),
			)
		);
		$this->add_control(
			'smart_speed',
			array(
				'label'       => __( 'Smart Speed', 'travic' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '500', 'vertox' ),
			)
		);
		$this->add_control(
            'travic_nav_heading',
            [
                'label' => __('Navigation', 'travic'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
			]
        );
		$this->add_control(
			'arrows',
			[
				'label' => __( 'Enable Arrows?', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'travic' ),
				'label_off' => __( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Enable Dots?', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'travic' ),
				'label_off' => __( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => '',
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
				'label' => esc_html__('Loop Layout Setting', 'travic'),
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
                    '{{WRAPPER}} .te-testimonial' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
                    '{{WRAPPER}} .te-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
				
            ]
        );
		$this->add_control(
			'travic_layout_background',
			[
				'label'                 => __( 'Background', 'travic' ),
				'type'                  => Controls_Manager::HEADING,
				'separator'             => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'travic_layout_bgtype',
				'label' => __( 'Loop Background', 'travic' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 
					'{{WRAPPER}} .te-testimonial',				
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'project_box_border_type',
				'selector' => 
					'{{WRAPPER}} .te-testimonial',				
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'project_box_shadow',
				'selector' => 
					'{{WRAPPER}} .te-testimonial',				

				'separator' => 'before',
			]
		);
		$this->add_control(
			'project_border_radius',
			[
				'label' => esc_html__('Border Radius', 'travic'),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .te-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->end_controls_section();
		
		/**Loop Item Style**/
		$this->start_controls_section(
			'loop_title_style',
			[
				'label' => esc_html__('Loop Style Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		//Content
		$this->add_control(
			'show_loop_content_style',
			[
				'label'       => __( 'ON/OFF Loop Content Style', 'travic' ),
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
                'name' => 'loop_content_typography',
                'label' => __('Loop Content Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-text',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_content_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_content_color',
            [
                'label' => __('Loop Content Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-text' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_content_style'    => 'yes',
				],
            ]
        );
		//Title
		$this->add_control(
			'show_loop_author_title_style',
			[
				'label'       => __( 'ON/OFF Loop Author Title Style', 'travic' ),
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
                'label' => __('Loop Author Title Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-title',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_author_title_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_author_title_color',
            [
                'label' => __('Loop Author Title Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-title' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_author_title_style'    => 'yes',
				]
            ]
        );
		//Designation
		$this->add_control(
			'show_loop_author_designation_style',
			[
				'label'       => __( 'ON/OFF Loop Author Designation Style', 'travic' ),
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
                'name' => 'loop_designation_typography',
                'label' => __('Loop Author Designation Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-designation',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_author_designation_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_author_designation_color',
            [
                'label' => __('Loop Author Designation Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-designation' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_author_designation_style'    => 'yes',
				]
            ]
        );
		//Rating
		$this->add_control(
			'show_loop_rating_style',
			[
				'label'       => __( 'ON/OFF Loop Rating Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
            'loop_rating_color',
            [
                'label' => __('Loop Rating Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .rating i' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_rating_style'    => 'yes',
				]
            ]
        );
		$this->add_responsive_control(
            'loop_rating_margin',
            [
                'label'              => __( 'Spacing', 'travic' ),
                'type'               => Controls_Manager::DIMENSIONS,
                'size_units'         => [ 'px', 'em', '%' ],
                'selectors'          => [
                    '{{WRAPPER}} .rating i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'frontend_available' => true,
				
            ]
        );
		$this->end_controls_section();
		
		
		/*******************
		Arrow Styling Start
		*******************/
		$this->start_controls_section(
			'carousel_navigation_arrow',
			[
				'label' => esc_html__('Navigation - Arrow', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		/******Tabs Start**********/
		
		$this->start_controls_tabs( 'travic_tabs_nav_position' );
			
			$this->start_controls_tab(
				'travic_tab_navs_position_left',
				[
					'label' => __( 'Left Arrow', 'travic' ),
				]
			);
			$this->add_control(
				'arrow_position_toggle',
				[
					'label' => __( 'Position', 'travic' ),
					'type' => Controls_Manager::POPOVER_TOGGLE,
					'label_off' => __( 'None', 'travic' ),
					'label_on' => __( 'Custom', 'travic' ),
					'return_value' => 'yes',
				]
			);
			/******Popup Start**********/
			$this->start_popover();
				$this->add_responsive_control(
					'arrow_position_y',
					[
						'label' => __( 'Vertical', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => ['px', '%'],
						'condition' => [
							'arrow_position_toggle' => 'yes'
						],
						'range' => [
							'px' => [
								'min' => -100,
								'max' => 500,
							],
							'%' => [
								'min' => -110,
								'max' => 110,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .testimonial-style1-carousel.owl-nav-style-one.owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'arrow_position_x',
					[
						'label' => __( 'Horizontal', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => ['px', '%'],
						'condition' => [
							'arrow_position_toggle' => 'yes'
						],
						'range' => [
							'px' => [
								'min' => -100,
								'max' => 500,
							],
							'%' => [
								'min' => -110,
								'max' => 110,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .testimonial-style1-carousel.owl-nav-style-one.owl-theme .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
						],
					]
				);
			$this->end_popover();
			$this->add_control(
				'nav_arrow_position',
				[
					'label' => esc_html__( 'Position', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'options' => [
						'relative'  => esc_html__( 'Relative', 'textdomain' ),
						'absolute' => esc_html__( 'Absolute', 'textdomain' ),
						'fixed' => esc_html__( 'Fixed', 'textdomain' ),
					],
					'selectors' => [
						'{{WRAPPER}} .testimonial-style1-carousel.owl-nav-style-one.owl-theme .owl-nav' => 'position: {{VALUE}};',
					],
				]
			);
			
			$this->end_controls_tab();
		
			$this->start_controls_tab(
				'travic_tab_navs_position_right',
				[
					'label' => __( 'Right Arrow', 'travic' ),
				]
			);
			$this->add_control(
				'right_arrow_position_toggle',
				[
					'label' => __( 'Position', 'travic' ),
					'type' => Controls_Manager::POPOVER_TOGGLE,
					'label_off' => __( 'None', 'travic' ),
					'label_on' => __( 'Custom', 'travic' ),
					'return_value' => 'yes',
				]
			);
			$this->start_popover();
				$this->add_responsive_control(
					'right_arrow_position_y',
					[
						'label' => __( 'Vertical', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => ['px', '%'],
						'condition' => [
							'arrow_position_toggle' => 'yes'
						],
						'range' => [
							'px' => [
								'min' => -100,
								'max' => 500,
							],
							'%' => [
								'min' => -110,
								'max' => 110,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .owl-nav-style-one.owl-theme .owl-nav .owl-prev' => 'top: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'right_arrow_position_x',
					[
						'label' => __( 'Horizontal', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => ['px', '%'],
						'condition' => [
							'arrow_position_toggle' => 'yes'
						],
						'range' => [
							'px' => [
								'min' => -100,
								'max' => 500,
							],
							'%' => [
								'min' => -110,
								'max' => 110,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .owl-nav-style-one.owl-theme .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
						],
					]
				);
			$this->end_popover();
		$this->end_controls_tabs();
		
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_text_typography',
                'label' => __('Button Text Typography', 'travic'),
                'selector' => 
					'{{WRAPPER}} .owl-theme .owl-nav button span',				
                'separator' => 'before',
			]
        );
		$this->add_control(
			'arrow_nav_size',
			[
				'label' => __( 'Width', 'travic' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-nav button' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'arrow_nav_heigt_size',
			[
				'label' => __( 'Height', 'travic' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .owl-theme .owl-nav button' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		
		$this->add_control(
            'arrow_border_radius',
            [
                'label' => __('Border Radius', 'travic'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .owl-theme .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
		
		$this->add_responsive_control(
			'arrow_nav_padding',
			array(
				'label'      => __('Padding', 'travic'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'.owl-theme .owl-nav button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
					
				),
			)
		);
		
		$this->start_controls_tabs( 'travic_tabs_nav' );
		$this->start_controls_tab(
			'travic_tab_navs_normal',
			[
				'label' => __( 'Normal', 'travic' ),
			]
		);
		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_border_type',
                'selector' => '{{WRAPPER}} .owl-theme .owl-nav button',				
				'separator' => 'before',
            ]
        );
		$this->add_control(
			'navigation_bg_color',
			array(
				'label'     => __('Background Color', 'travic'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .owl-theme .owl-nav button' => 'background-color: {{VALUE}}!important',
					
				),
			)
		);
		$this->add_control(
			'navigation_color',
			array(
				'label'     => __('Color', 'travic'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .owl-theme .owl-nav button span' => 'color: {{VALUE}}!important',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'travic_tab_nav_hover',
			[
				'label' => __( 'Hover', 'travic' ),
			]
		);
		$this->add_control(
            'navigation_border_hover_color',
            [
                'label' => __('Border Hover Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .owl-theme .owl-nav button:hover' => 'border-color: {{VALUE}}!important',
                ],
                'separator' => 'before',
			 ]
        );
		$this->add_control(
			'navigation_bg_hover_color',
			array(
				'label'     => __('Background Color', 'travic'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .owl-theme .owl-nav button:hover:before' => 'background-color: {{VALUE}}!important',
					
				),
			)
		);
		$this->add_control(
			'navigation_hover_color',
			array(
				'label'     => __('Color', 'travic'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .owl-theme .owl-nav button:hover span' => 'color: {{VALUE}}!important',
				),
			)
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
		
		$items_show = $settings[ 'items_show' ];
		$image_item_gap = $settings[ 'image_item_gap' ];
		$autoplay_speed = $settings[ 'autoplay_speed' ];
		$smart_speed = $settings[ 'smart_speed' ];
		
		if($settings['infinite'] == 'yes'){
			$infiinite = 'true';
		}else{
			$infiinite = 'false';
		}

		if($settings['autoplay'] == 'yes'){
			$autoplay = 'true';
		}else{
			$autoplay = 'false';
		}

		if($settings['dots'] == 'yes'){
			$dots = 'true';
		}else{
			$dots = 'false';
		}

		if($settings['arrows'] == 'yes'){
			$arrows = 'true';
		} else{
			$arrows = 'false';
		}
		
		
        $paged = travic_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;

		$this->add_render_attribute( 'wrapper', 'class', 'templatepath-travic' );
		$args = array(
			'post_type'      => 'testimonials',
			'posts_per_page' => travic_set( $settings, 'query_number' ),
			'orderby'        => travic_set( $settings, 'query_orderby' ),
			'order'          => travic_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
		if( travic_set( $settings, 'query_category' ) ) $args['testimonials_cat'] = travic_set( $settings, 'query_category' );
		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) 
	 { ?>
     
	
	<?php if($settings['layout_control'] == '2') :?>
    
    <section class="testimonial-style-two centred p-0 m-0">
        <div class="three-item-carousel owl-carousel owl-theme <?php if( $settings['arrows'] == 'yes' ) echo 'nav-style-one'; else echo 'owl-nav-none';?> <?php if( $settings['dots'] == 'yes' ) echo ''; else echo 'owl-dots-none';?>"
        data-owl-options='{
                "loop": <?php echo esc_attr( $infiinite );?>,
                "autoplay": <?php echo esc_attr( $autoplay );?>,
                "margin": <?php echo esc_attr( $image_item_gap );?>,
                "nav": <?php echo esc_attr( $arrows );?>,
                "dots": <?php echo esc_attr( $dots );?>,
                "smartSpeed": <?php echo esc_attr( $smart_speed );?>,
                "autoplayTimeout": <?php echo esc_attr( $autoplay_speed );?>,
                "navText": ["<span class=\"fa fa-long-arrow-left\"></span>","<span class=\"fa fa-long-arrow-right\"></span>"],
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "480": {
                        "items": 1
                    },
                    "600": {
                        "items": 2
                    },
                    "800": {
                        "items": 2
                    },
                    "1200": {
                        "items": <?php echo esc_attr( $items_show );?>
                    }
                }
            }'
          >
            
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="testimonial-block-two">
                <div class="inner-box te-testimonial">
                    <figure class="thumb-box"><?php the_post_thumbnail('travic_100x100'); ?></figure>
                    <h3 class="te-title"><?php the_title(); ?></h3>
                    <span class="designation te-designation"><?php echo (get_post_meta( get_the_id(), 'author_designation', true)); ?></span>
                    <div class="rating">
                        <?php $rating = get_post_meta( get_the_id(), 'testimonial_rating', true );
                            if(!empty($rating)){
                            for ($x = 1; $x <= 5; $x++) {
                                if($x <= $rating) echo '<i class="fa fa-star"></i>'; else echo '<i class="fa fa-star-o"></i>';
                            }
                        } ?>
                    </div>
                    <p class="te-text"><?php echo wp_kses(wp_trim_words(get_the_content(), $settings['text_limit']), true); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
            
        </div>
    </section>
    
    <?php else: ?>
    
    <section class="testimonial-section p-0 m-0">
        <div class="two-item-carousel owl-carousel owl-theme <?php if( $settings['arrows'] == 'yes' ) echo 'nav-style-one'; else echo 'owl-nav-none';?> <?php if( $settings['dots'] == 'yes' ) echo 'dots-style-one'; else echo 'owl-dots-none';?>"
        data-owl-options='{
                "loop": <?php echo esc_attr( $infiinite );?>,
                "autoplay": <?php echo esc_attr( $autoplay );?>,
                "margin": <?php echo esc_attr( $image_item_gap );?>,
                "nav": <?php echo esc_attr( $arrows );?>,
                "dots": <?php echo esc_attr( $dots );?>,
                "smartSpeed": <?php echo esc_attr( $smart_speed );?>,
                "autoplayTimeout": <?php echo esc_attr( $autoplay_speed );?>,
                "navText": ["<span class=\"fa fa-long-arrow-left\"></span>","<span class=\"fa fa-long-arrow-right\"></span>"],
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "480": {
                        "items": 1
                    },
                    "600": {
                        "items": 1
                    },
                    "800": {
                        "items": 2
                    },
                    "1024": {
                        "items": 2
                    },
                    "1200": {
                        "items": <?php echo esc_attr( $items_show );?>
                    }
                }
            }'
          >
                        
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="testimonial-block-one">
                <div class="inner-box te-testimonial">
                    <div class="rating">
                        <?php $rating = get_post_meta( get_the_id(), 'testimonial_rating', true );
                            if(!empty($rating)){
                            for ($x = 1; $x <= 5; $x++) {
                                if($x <= $rating) echo '<i class="fa fa-star"></i>'; else echo '<i class="fa fa-star-o"></i>';
                            }
                        } ?>
                    </div>
                    <div class="author-box">
                        <figure class="author-thumb"><?php the_post_thumbnail('travic_60x60'); ?></figure>
                        <h3 class="te-title"><?php the_title(); ?></h3>
                        <span class="designation te-designation"><?php echo (get_post_meta( get_the_id(), 'author_designation', true)); ?></span>
                    </div>
                    <p class="te-text"><?php echo wp_kses(wp_trim_words(get_the_content(), $settings['text_limit']), true); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
            
        </div>
    </section>
    
    <?php endif; ?>
    
    <?php } 
    wp_reset_postdata();
	}

}
