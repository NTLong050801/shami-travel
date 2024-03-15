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
use \Elementor\Group_Control_Text_Stroke;
use Elementor\Plugin;
use Tour_Price;


/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Packages_Carousel extends Widget_Base {
	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'travic_packages_carousel';
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
		return esc_html__( 'Tours Packages Carousel', 'travic' );
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
		return 'eicon-post-list';
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
		wp_register_script( 'packages-carousel', YT_URL . 'assets/js/banner-carousel.js', [ 'elementor-frontend' ], '1.0.0', true );
		return [ 'packages-carousel' ];
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
			'packages_carousel',
			[
				'label' => esc_html__( 'Tours Packages Carousel', 'travic' ),
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
		
		//Ratting
		$this->add_control(
            'show_rating',
            [
                'label'        => esc_html__( 'ON/OFF Rating', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
			]
        );
		$this->add_control(
            'show_meta',
            [
                'label'        => esc_html__( 'ON/OFF Meta Info', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
		$this->add_control(
            'show_user',
            [
                'label'        => esc_html__( 'ON/OFF User', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
				'condition'   => [ 'show_meta' => 'yes' ],
            ]
        );
		$this->add_control(
            'show_duration',
            [
                'label'        => esc_html__( 'ON/OFF Duration', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
				'condition'   => [ 'show_meta' => 'yes' ],
            ]
        );
		$this->add_control(
            'show_price',
            [
                'label'        => esc_html__( 'ON/OFF Price', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
				'condition'   => [ 'show_meta' => 'yes' ],
            ]
        );
		$this->add_control(
            'show_description',
            [
                'label'        => esc_html__( 'ON/OFF Description', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
		$this->add_control(
			'text_limit',
			[
				'label'   => esc_html__( 'Text Limit', 'travic' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 25,
				'min'     => 1,
				'max'     => 100,
				'step'    => 1,
				'condition'   => [ 'show_description' => 'yes' ],
			]
		);
		$this->add_control(
            'query_number',
            [
                'label'   => esc_html__( 'Number of post', 'travic' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
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
                'default' => 'ASC',
                'options' => array(
                    'DESC' => esc_html__( 'DESC', 'travic' ),
                    'ASC'  => esc_html__( 'ASC', 'travic' ),
                ),
            ]
        );
		$this->add_control(
            'query_category', 
			[
			  'type' => Controls_Manager::SELECT2,
			  'label_block' => true,
			  'multiple'    => true,
			  'label' => esc_html__('Category', 'travic'),
			  'options' => get_tour_categories()
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label'       => __( 'Button Text', 'travic' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title Here', 'travic' ),
				'condition'             => [
					'layout_control'    => '1',
				],
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
		
		/************************************************************************
								Tab Style Start
		*************************************************************************/
		
		//General Style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__( 'General Setting', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'gen_spacing',
			[
				'label' => __( 'Spacing', 'travic' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .te-gen__common' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
            'gen_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-gen__common' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .te-gen__common',				
			]
		);
		$this->end_controls_section();
				
		/**Category Style**/
		$this->start_controls_section(
			'category_style',
			[
				'label' => esc_html__('Category Style Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'travic_tabs_btn' );
		
			$this->start_controls_tab(
				'travic_cat_tab_btn_normal',
				[
					'label' => __( 'Normal', 'travic' ),
				]
			);
				$this->add_responsive_control(
					'cat_padding',
					[
						'label'              => __( 'Padding', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .te-cat__style' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'cat_border_type',
						'selector' => 
							'{{WRAPPER}} .te-cat__style',				
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'cat_border_box_shadow',
						'selector' => 
							'{{WRAPPER}} .te-cat__style',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'cat_border_radius',
					[
						'label' => esc_html__('Border Radius', 'travic'),
						'type' => Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => ['px'],
						'selectors' => [
							'{{WRAPPER}} .te-cat__style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'cat_title_typography',
						'label' => __('Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .te-cat__style',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'cat_title_bg_color',
					[
						'label' => __('Background Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-cat__style' => 'background: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				$this->add_control(
					'cat_title_color',
					[
						'label' => __('Text Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-cat__style' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				
			$this->end_controls_tab();
			
			$this->start_controls_tab(
				'travic_cat_tab_btn_hover',
				[
					'label' => __( 'Hover', 'travic' ),
				]
			);
			
				$this->add_control(
					'cat_title_bg_color_hover',
					[
						'label' => __('Background Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-cat__style:hover' => 'background: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				$this->add_control(
					'cat_title_hover_color',
					[
						'label' => __('Text Hover Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-cat__style:hover' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
			
			$this->end_controls_tab();			
		$this->end_controls_tabs();   
		$this->end_controls_section();
		
		/**Icon Box Style**/
		$this->start_controls_section(
			'rating_style',
			[
				'label' => esc_html__('Rating Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'travic_rating_icon_tab' );
		
			$this->start_controls_tab(
				'travic_social_icon_normal',
				[
					'label' => __( 'Normal', 'travic' ),
				]
			);
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'icon_box_bgtype',
						'label' => __( 'Background', 'travic' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => 
							'{{WRAPPER}} .te-rating'				
					]
				);
				$this->add_control(
					'social_icon_color',
					[
						'label' => __('Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-rating' => 'color: {{VALUE}}'
						],
						'separator' => 'before',
					]
				);
				$this->add_responsive_control(
					'icon_box_padding',
					[
						'label'              => __( 'Padding', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .te-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'social_icon_border_type',
						'selector' => 
							'{{WRAPPER}} .te-rating',				
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'social_icon_box_shadow',
						'selector' => 
							'{{WRAPPER}} .te-rating',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'social_icon_border_radius',
					[
						'label' => esc_html__('Border Radius', 'travic'),
						'type' => Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => ['px'],
						'selectors' => [
							'{{WRAPPER}} .te-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						],
					]
				);
			$this->end_controls_tab();
			
			$this->start_controls_tab(
				'travic_socials_icon_box_hover',
				[
					'label' => __( 'Hover', 'travic' ),
				]
			);
			
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'social_icon_hover_bg_bgtype',
						'label' => __( 'Hover Background', 'travic' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => 
							'{{WRAPPER}} .te-rating:hover',				
					]
				);
				
				$this->add_control(
					'icon_hover_color',
					[
						'label' => __('Icon Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-rating:hover' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				
				$this->add_control(
					'social_icon_hover_transition',
					[
						'label' => esc_html__( 'Transition Duration', 'travic' ),
						'type' => Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'max' => 3,
								'step' => 0.1,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .te-rating:hover' => 'transition-duration: {{SIZE}}s',
						],
					]
				);
				
			$this->end_controls_tab();
			
		$this->end_controls_tabs();   
		$this->end_controls_section();
		
		/**Category Style**/
		$this->start_controls_section(
			'metainfo_style',
			[
				'label' => esc_html__('Meta Info Style Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'travic_meta_tabs_btn' );
		
			$this->start_controls_tab(
				'travic_meta_tab_btn_normal',
				[
					'label' => __( 'Normal', 'travic' ),
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'meta_title_typography',
						'label' => __('Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .te-meta__style',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'meta_title_color',
					[
						'label' => __('Text Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-meta__style' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				
			$this->end_controls_tab();
			
			$this->start_controls_tab(
				'travic_meta_tab_btn_hover',
				[
					'label' => __( 'Hover', 'travic' ),
				]
			);
			
				$this->add_control(
					'meta_title_hover_color',
					[
						'label' => __('Text Hover Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .te-meta__style:hover' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
			
			$this->end_controls_tab();			
		$this->end_controls_tabs();   
		$this->end_controls_section();
		
		//Title Style
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Setting', 'travic' ),
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
		
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'travic' ),
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
				'selector' => 
					'{{WRAPPER}} .te-title',
			]
		);

		$this->end_controls_section();
		
		//Price Style
		$this->start_controls_section(
			'price_style',
			[
				'label' => esc_html__( 'Price Setting', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);		
		$this->add_responsive_control(
            'price__margin',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );		
        $this->add_responsive_control(
            'price_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );		
		$this->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Text Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-price bdi' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .te-price bdi .woocommerce-Price-currencySymbol' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __('Typography', 'travic'),
				'selector' => 
					'{{WRAPPER}} .te-price',
			]
		);
		$this->end_controls_section();
		
		//Text Style
		$this->start_controls_section(
			'text_style',
			[
				'label' => esc_html__( 'Text Setting', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
            'text__margin',
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
            'text_padding',
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
			'text_color',
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
				'name' => 'text_typography',
				'label' => __('Typography', 'travic'),
				'selector' => 
				'{{WRAPPER}} .te-text',
			]
		);

		$this->end_controls_section();
		
		/**Tour Post Button Style**/
		$this->start_controls_section(
			'tour_post_button_style',
			[
				'label' => esc_html__('Button Style Setting', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'travic_tour_tabs_btn' );
		
			$this->start_controls_tab(
				'travic_tour_tab_btn_normal',
				[
					'label' => __( 'Normal', 'travic' ),
				]
			);
				$this->add_responsive_control(
					'tour_btn_width_size',
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
							'{{WRAPPER}} .travic-btn' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'tour_btn_height_size',
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
							'{{WRAPPER}} .travic-btn' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'tour_btn_margin',
					[
						'label'              => __( 'Margin', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .btn-other__options' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_responsive_control(
					'tour_btn_padding',
					[
						'label'              => __( 'Padding', 'travic' ),
						'type'               => Controls_Manager::DIMENSIONS,
						'size_units'         => [ 'px', 'em', '%' ],
						'selectors'          => [
							'{{WRAPPER}} .travic-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'tour_btn_border_type',
						'selector' => 
							'{{WRAPPER}} .travic-btn',				
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'tour_border_box_shadow',
						'selector' => 
							'{{WRAPPER}} .travic-btn',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'tour_btn_border_radius',
					[
						'label' => esc_html__('Border Radius', 'travic'),
						'type' => Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => ['px'],
						'selectors' => [
							'{{WRAPPER}} .travic-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'tour_btn_title_typography',
						'label' => __('Button Text Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .travic-btn',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'tour_btn_title_bg_color',
					[
						'label' => __('Button Background Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .travic-btn' => 'background: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				$this->add_control(
					'tour_btn_title_color',
					[
						'label' => __('Button Text Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .travic-btn' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
				$this->add_control(
					'tour_btn_title_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .travic-btn svg' => 'color: {{VALUE}};',
						],
					]
				);
				
			$this->end_controls_tab();
			
			$this->start_controls_tab(
				'travic_tour_tab_btn_hover',
				[
					'label' => __( 'Hover', 'travic' ),
				]
			);
			
				$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'tour_btn_hover_bg_bgtype',
						'label' => __( 'Button Hover Background', 'travic' ),
						'types' => [ 'classic', 'gradient' ],
						'selector' => 
							'{{WRAPPER}} .travic-btn:before,
							{{WRAPPER}}	.travic-btn:hover',				
					]
				);
				$this->add_control(
					'tour_btn_title_hover_color',
					[
						'label' => __('Button Text Hover Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .travic-btn:hover' => 'color: {{VALUE}}',
						],
						'separator' => 'before',
					]
				);
			
			$this->end_controls_tab();			
		$this->end_controls_tabs();   
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
							'{{WRAPPER}} .owl-nav-style-one.owl-theme .owl-nav' => 'top: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .owl-nav-style-one.owl-theme .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
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
						'{{WRAPPER}} .owl-nav-style-one.owl-theme .owl-nav' => 'position: {{VALUE}};',
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
		
		$show_rating = $settings[ 'show_rating' ];
		$show_meta = $settings[ 'show_meta' ];
		$show_user = $settings[ 'show_user' ];
		$show_duration = $settings[ 'show_duration' ];
		$show_price = $settings[ 'show_price' ];
		$show_description = $settings[ 'show_description' ];
		$btn_text = $settings[ 'btn_text' ];
				
		$paged = get_query_var('paged');
		$paged = travic_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;
		
		$this->add_render_attribute( 'wrapper', 'class', 'templatepath-travic' );
		$args = array(
			'post_type'      =>  'tf_tours',
			'posts_per_page' => travic_set( $settings, 'query_number' ),
			'orderby'        => travic_set( $settings, 'query_orderby' ),
			'order'          => travic_set( $settings, 'query_order' ),
			'paged'         => $paged
		);
				
		if( travic_set( $settings, 'query_category' ) ) $args['tour_destination'] = travic_set( $settings, 'query_category' );
			$query = new \WP_Query( $args );
			if ( $query->have_posts() ) 
		{ 
	?>
  
    <?php if($settings['layout_control'] == '2') :?>
    
    <!-- pricing-section -->
    <section class="pricing-section te-gen__common">
        <div class="inner-container">
            <div class="pricing-carousel owl-carousel owl-theme <?php if( $settings['arrows'] == 'yes' ) echo 'nav-style-one'; else echo 'owl-nav-none';?> <?php if( $settings['dots'] == 'yes' ) echo ''; else echo 'owl-dots-none';?>"
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
                                "items": 2
                            },
                            "600": {
                                "items": 3
                            },
                            "800": {
                                "items": 4
                            },
                            "1200": {
                                "items": <?php echo esc_attr( $items_show );?>
                            }
                        }
                    }'
                >
                
                <?php 
					global $post;
					while ( $query->have_posts() ) : $query->the_post(); 
					$selected_post_id       = get_the_ID();
					$destinations           = get_the_terms( $selected_post_id, 'tour_destination' );
					$first_destination_name = $destinations[0]->name;
					$related_comments       = get_comments( array( 'post_id' => $selected_post_id ) );
					$meta = get_post_meta( get_the_ID(),'tf_tours_opt',true );
					$group_size    = ! empty( $meta['group_size'] ) ? $meta['group_size'] : '';
					$tour_duration = ! empty( $meta['duration'] ) ? $meta['duration'] : '';
					$duration_time = ! empty( $meta['duration_time'] ) ? $meta['duration_time'] : '';
					
					/**
					 * Pricing
					 */
					$pricing_rule = ! empty( $meta['pricing'] ) ? $meta['pricing'] : '';
					$tour_type    = ! empty( $meta['type'] ) ? $meta['type'] : '';
					if ( $tour_type && $tour_type == 'continuous' ) {
						$custom_avail = ! empty( $meta['custom_avail'] ) ? $meta['custom_avail'] : false;
					}
					$discount_type  = ! empty( $meta['discount_type'] ) ? $meta['discount_type'] : 'none';
					$disable_adult  = ! empty( $meta['disable_adult_price'] ) ? $meta['disable_adult_price'] : false;
					$disable_child  = ! empty( $meta['disable_child_price'] ) ? $meta['disable_child_price'] : false;
					$disable_infant = ! empty( $meta['disable_infant_price'] ) ? $meta['disable_infant_price'] : false;
					if ( $tour_type == 'continuous' && $custom_avail == true ) {
						$pricing_rule = ! empty( $meta['custom_pricing_by'] ) ? $meta['custom_pricing_by'] : 'person';
					}
					$tour_price = new Tour_Price( $meta );
					
				?>
                <div class="pricing-block-one">
                    <div class="pricing-table">
                        <?php if(has_post_thumbnail()){ ?>
                        <figure class="image-box"><?php the_post_thumbnail( 'travic_315x400' ); ?></figure>
                        <?php } ?>
                        <div class="content-box">
                            <h6 class="te-cat__style"><?php echo $first_destination_name; ?></h6>
                            <h4><a class="te-title" href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php the_title();?></a></h4>
                            
                            <?php if( $show_meta == 'yes' ){?>
                                                
								<?php if( $show_price == 'yes' ){?>
                                <h5 class="te-price">
                                    <span><?php esc_html_e('From -', 'travic'); ?> </span>
                                    
                                    <?php if ( $pricing_rule == 'group' ) { ?>
                                        <?php echo $tour_price->wc_sale_group ? $tour_price->wc_sale_group : $tour_price->wc_group; ?>
                                    <?php } elseif ( $pricing_rule == 'person' ) { ?>
                                        <?php if ( ! $disable_adult && ! empty( $tour_price->adult ) ) { ?>
                                            <?php echo $tour_price->wc_sale_adult ? $tour_price->wc_sale_adult : $tour_price->wc_adult; ?>
                                        <?php }
                                        
                                        if ( ! $disable_child && ! empty( $tour_price->child ) ) { ?>
                                            <?php echo $tour_price->wc_sale_child ? $tour_price->wc_sale_child : $tour_price->wc_child; ?>
                                        <?php }
                                        
                                        if ( ! $disable_adult && ( ! $disable_infant && ! empty( $tour_price->infant ) ) ) { ?>
                                            <?php echo $tour_price->wc_sale_infant ? $tour_price->wc_sale_infant : $tour_price->wc_infant; ?>
                                        <?php } ?>
                                    <?php } ?>
                                </h5>
                                <?php } ?>
                            
                                <?php if( $show_duration == 'yes' and ! empty( $tour_duration ) ){?>
                                <span class="day-time">
                                    <i class="icon-1"></i>
                                    <?php echo esc_html( $tour_duration ); ?>
                                        <?php
                                        if ( $tour_duration > 1 ) {
                                            $dur_string         = 's';
                                            $duration_time_html = $duration_time . $dur_string;
                                        } else {
                                            $duration_time_html = $duration_time;
                                        }
                                        echo " " . esc_html( $duration_time_html );
                                    ?>
                                </span>
                                <?php } ?>
                                
                                <?php if( $show_user == 'yes' and $group_size ){?>
                                <span class="te-meta__style day-time"><i class="icon-7"></i><?php echo esc_html( $group_size ) ?> <?php esc_html_e( 'People', 'travic' );?></span>
                                <?php } ?>
                                
                            <?php } ?>
                            
                            <?php if( $show_description == 'yes' ){?>
                            <p class="regular-text-v1 te-text !leading-1.6 mt-[14px]"><?php echo wp_trim_words( get_the_excerpt(), $item[ 'text_limit' ] ); ?></p>
                            <?php } ?>
                            
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <!-- pricing-section end -->
    
    <?php else: ?>
   	
    <!-- tours-section -->
    <section class="tours-section alternat-2 te-gen__common">
        
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
            
            <?php 
				global $post;
				while ( $query->have_posts() ) : $query->the_post(); 
				$selected_post_id       = get_the_ID();
				$destinations           = get_the_terms( $selected_post_id, 'tour_destination' );
				$first_destination_name = $destinations[0]->name;
				$related_comments       = get_comments( array( 'post_id' => $selected_post_id ) );
				$meta = get_post_meta( get_the_ID(),'tf_tours_opt',true );
				$group_size    = ! empty( $meta['group_size'] ) ? $meta['group_size'] : '';
				$tour_duration = ! empty( $meta['duration'] ) ? $meta['duration'] : '';
				$duration_time = ! empty( $meta['duration_time'] ) ? $meta['duration_time'] : '';
				
				/**
				 * Pricing
				 */
				$pricing_rule = ! empty( $meta['pricing'] ) ? $meta['pricing'] : '';
				$tour_type    = ! empty( $meta['type'] ) ? $meta['type'] : '';
				if ( $tour_type && $tour_type == 'continuous' ) {
					$custom_avail = ! empty( $meta['custom_avail'] ) ? $meta['custom_avail'] : false;
				}
				$discount_type  = ! empty( $meta['discount_type'] ) ? $meta['discount_type'] : 'none';
				$disable_adult  = ! empty( $meta['disable_adult_price'] ) ? $meta['disable_adult_price'] : false;
				$disable_child  = ! empty( $meta['disable_child_price'] ) ? $meta['disable_child_price'] : false;
				$disable_infant = ! empty( $meta['disable_infant_price'] ) ? $meta['disable_infant_price'] : false;
				if ( $tour_type == 'continuous' && $custom_avail == true ) {
					$pricing_rule = ! empty( $meta['custom_pricing_by'] ) ? $meta['custom_pricing_by'] : 'person';
				}
				$tour_price = new Tour_Price( $meta );
				
			?>
            <div class="tours-block-one">
                <div class="inner-box">
                    <?php if(has_post_thumbnail()){ ?>
                    <div class="image-box">
                    	<figure class="image"><?php the_post_thumbnail( 'travic_410x275' ); ?></figure>
                    </div>
                    <?php } ?>
                    
                    <div class="lower-content">
                        <div class="d-flex justify-content-between align-items-center te-lw-cnt__box">
                            <h6 class="te-cat__style"><?php echo $first_destination_name; ?></h6>
                            <?php if ( $related_comments and $show_rating == 'yes' ) { ?>
                            <span class="rating offer-box">
                                <div class="tf-slider-rating-star te-rating">
                                    <i class="far fa-star"></i> <span><?php echo tf_total_avg_rating( $related_comments ); ?></span>
                                </div>
                            </span>
                            <?php } ?>
                        </div>
                        <h4><a class="te-title" href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php the_title();?></a></h4>
                                    
                        <?php if( $show_meta == 'yes' ){?>
												
							<?php if( $show_price == 'yes' ){?>
                            <h5 class="te-price">
                                <span><?php esc_html_e('From -', 'travic'); ?> </span>
                                
                                <?php if ( $pricing_rule == 'group' ) { ?>
                                    <?php echo $tour_price->wc_sale_group ? $tour_price->wc_sale_group : $tour_price->wc_group; ?>
                                <?php } elseif ( $pricing_rule == 'person' ) { ?>
                                    <?php if ( ! $disable_adult && ! empty( $tour_price->adult ) ) { ?>
                                        <?php echo $tour_price->wc_sale_adult ? $tour_price->wc_sale_adult : $tour_price->wc_adult; ?>
                                    <?php }
                                    
                                    if ( ! $disable_child && ! empty( $tour_price->child ) ) { ?>
                                        <?php echo $tour_price->wc_sale_child ? $tour_price->wc_sale_child : $tour_price->wc_child; ?>
                                    <?php }
                                    
                                    if ( ! $disable_adult && ( ! $disable_infant && ! empty( $tour_price->infant ) ) ) { ?>
                                        <?php echo $tour_price->wc_sale_infant ? $tour_price->wc_sale_infant : $tour_price->wc_infant; ?>
                                    <?php } ?>
                                <?php } ?>
                            </h5>
                            <?php } ?>
                        
                            <?php if( $show_duration == 'yes' and ! empty( $tour_duration ) ){?>
                            <span class="day-time">
                                <i class="icon-1"></i>
                                <?php echo esc_html( $tour_duration ); ?>
                                    <?php
                                    if ( $tour_duration > 1 ) {
                                        $dur_string         = 's';
                                        $duration_time_html = $duration_time . $dur_string;
                                    } else {
                                        $duration_time_html = $duration_time;
                                    }
                                    echo " " . esc_html( $duration_time_html );
                                ?>
                            </span>
                            <?php } ?>
                            
                            <?php if( $show_user == 'yes' and $group_size ){?>
                            <span class="te-meta__style day-time"><i class="icon-7"></i><?php echo esc_html( $group_size ) ?> <?php esc_html_e( 'People', 'travic' );?></span>
                            <?php } ?>
                            
                        <?php } ?>
                        
                        <?php if( $show_description == 'yes' ){?>
                        <p class="regular-text-v1 te-text !leading-1.6 mt-[14px]"><?php echo wp_trim_words( get_the_excerpt(), $item[ 'text_limit' ] ); ?></p>
                        <?php } ?>
                        
                        <div class="link"><a class="travic-btn" href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php echo $btn_text ? $btn_text : 'Explore more'?><i class="fas fa-long-arrow-right"></i></a></div>
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
    </section>
    <!-- tours-section end -->
    
    <?php endif; ?>
       
    <?php }
    wp_reset_postdata();
	}
}