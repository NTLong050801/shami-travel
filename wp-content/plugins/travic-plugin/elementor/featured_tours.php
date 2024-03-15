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
class Featured_Tours extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'travic_featured_tours';
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
		return esc_html__( 'Travic Featured Tours Tabs', 'travic' );
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
		return 'eicon-library-open';
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
		wp_register_script( 'tours-tab-script', YT_URL . 'assets/js/tours-tabs.js', [ 'elementor-frontend' ], '1.0.0', true );
		return [ 'tours-tab-script' ];
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
			'featured_tours',
			[
				'label' => esc_html__( 'Travic Featured Tours Tabs', 'travic' ),
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
			'col_grid',
			[
				'label'   => esc_html__( 'Choose Column', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'three',
				'options' => array(
					'one' => esc_html__( 'One Column Grid ', 'travic'),
					'two'  => esc_html__( 'Two Column Grid', 'travic' ),
					'three'  => esc_html__( 'Three Column Grid', 'travic' ),
					'four'  => esc_html__( 'Four Column Grid', 'travic' ),
					'five'  => esc_html__( 'Six Column Grid', 'travic' ),
				),
			]
		);
		//Bg Image
		$this->add_control(
			'bg_img',
			[
				'label' => esc_html__( 'BG Image', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'   => [ 'layout_control' => '1' ]
			]
		);
		
		//Title Section
		$this->add_control(
            'show_title_section',
            [
                'label'        => esc_html__( 'Enable Title Section', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
		$this->add_control(
            'subtitle',
            [
                'label'       => __('Sub Title', 'travic'),
				'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your subtitle', 'travic'),
				'condition'   => [ 'show_title_section' => 'yes' ]
            ]
        );
		$this->add_control(
            'title',
            [
                'label'       => __('Title', 'travic'),
				'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'travic'),
				'condition'   => [ 'show_title_section' => 'yes' ]
            ]
        );
		
		//Our Feature Table		
		$repeater = new Repeater();		
		$repeater->add_control(
			'tab_title',
			[
				'label'       => __( 'Tab Title', 'travic' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Tab Title', 'travic' ),
			]
		);
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
        $repeater->add_control(
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
        $repeater->add_control(
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
		$repeater->add_control(
            'query_category', 
			[
			  'type' => Controls_Manager::SELECT2,
			  'label_block' => true,
			  'label' => esc_html__('Category', 'travic'),
			  'options' => get_tour_categories()
			]
		);
		$repeater->add_control(
			'btn_text',
			[
				'label'       => __( 'Button Text', 'travic' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title Here', 'travic' ),
			]
		);
		$this->add_control(
			'tours_tab',
			[
				'label'                 => __('Add Tours Item', 'travic'),
				'type'                  => Controls_Manager::REPEATER,
				'fields'                => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
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
		
		//Box Style
		$this->start_controls_section(
			'box-wrapper__style',
			[
				'label' => esc_html__( 'Box Wrapper Setting', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-box__common' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bgtype',
				'label' => __( 'Background', 'travic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .te-box__common',				
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border_type',
				'selector' => 
					'{{WRAPPER}} .te-box__common',				
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_border_box_shadow',
				'selector' => 
					'{{WRAPPER}} .te-box__common',				
				'separator' => 'before',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' => esc_html__('Border Radius', 'travic'),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .te-box__common' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		
		$grid_col = $settings[ 'col_grid' ];
		if( $grid_col == 'one' ){
			$classes = 'col-lg-12 col-md-12 col-sm-12';
		}elseif( $grid_col == 'two' ){
			$classes = 'col-lg-6 col-md-6 col-sm-12';
		}elseif( $grid_col == 'three' ){
			$classes = 'col-lg-4 col-md-6 col-sm-12';
		}elseif( $grid_col == 'four' ){
			$classes = 'col-lg-3 col-md-6 col-sm-12';
		}elseif( $grid_col == 'five' ){
			$classes = 'col-lg-2 col-md-6 col-sm-12';
		}else{
			$classes = 'col-lg-3 col-md-6 col-sm-12';
		}
		
	?>
	
    <?php if($settings['layout_control'] == '2') :?>
    
    <!-- destinations-section -->
    <section class="destinations-section pb_60">
        <div class="auto-container">
            <div class="tabs-box">
                <div class="upper-box mb_60">
                    <?php if($settings['show_title_section']){ ?>
                    <div class="sec-title">
                        <?php if($settings['subtitle']){ ?><span class="sub-title"><?php echo wp_kses($settings['subtitle'], true); ?></span><?php } ?>
                        <?php if($settings['title']){ ?><h2><?php echo wp_kses($settings['title'], true); ?></h2><?php } ?>
                    </div>
                    <?php } ?>
                    
                    <div class="tab-btn-box p_relative">
                        <ul class="tab-btns tab-buttons clearfix">
                        	<?php foreach($settings['tours_tab'] as $key => $item):?>
                            <li class="tab-btn <?php if($key == 0) echo 'active-btn';?>" data-tab="#tab-8<?php echo esc_attr($key);?>"><?php echo wp_kses($item['tab_title'], true);?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="tabs-content">
                	<?php foreach($settings['tours_tab'] as $keys => $item):
					
						$show_rating = $item[ 'show_rating' ];
						$show_meta = $item[ 'show_meta' ];
						$show_user = $item[ 'show_user' ];
						$show_duration = $item[ 'show_duration' ];
						$show_price = $item[ 'show_price' ];
						$show_description = $item[ 'show_description' ];
						$btn_text = $item[ 'btn_text' ];												
						
						$paged = get_query_var('paged');
						$paged = travic_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;
		
						$this->add_render_attribute( 'wrapper', 'class', 'templatepath-travic' );
						$args = array(
							'post_type'      =>  'tf_tours',
							'posts_per_page' => travic_set( $item, 'query_number' ),
							'orderby'        => travic_set( $item, 'query_orderby' ),
							'order'          => travic_set( $item, 'query_order' ),
							'text_limit'     => travic_set( $item, 'text_limit' ),
							'paged'          => $paged
						);
						
						if( travic_set( $item, 'query_category' ) ) $args['tour_destination'] = travic_set( $item, 'query_category' );
						$query = new \WP_Query( $args );
						if ( $query->have_posts()):	
					?>
                    <div class="tab <?php if($keys == 0) echo 'active-tab';?>" id="tab-8<?php echo esc_attr($keys);?>">
                        <div class="row clearfix">
                            <?php 
								global  $post;
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
                            <div class="<?php echo esc_attr( $classes );?> destinations-block">
                                <div class="destinations-block-one">
                                    <div class="inner-box">
                                        <?php if(has_post_thumbnail()){ ?>
                                        <figure class="image-box"><?php the_post_thumbnail( 'travic_80x80' ); ?></figure>
                                        <?php } ?>
                                        
                                        <h4 class="te-title"><a href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php the_title();?></a></h4>
                                        <span class="text te-cat__style"><?php echo $first_destination_name; ?></span>
                                        
										<?php if( $show_meta == 'yes' ){?>
												
											<?php if( $show_price == 'yes' ){?>
                                            <p class="te-price">
                                                <?php esc_html_e('From -', 'travic'); ?>
                                                
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
                                            </p>
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
                            <?php endwhile;?>
                        </div>
                    </div>
                    <?php endif;?>
					<?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <!-- destinations-section end -->
    
    <?php else: ?>
    
    <!-- tours-section -->
    <section class="tours-section te-gen__common pt_100 pb_70">
        <?php if($settings['bg_img']){ ?><div class="pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['bg_img']['id'])); ?>);"></div><?php } ?>
        
        <div class="auto-container">
            <div class="tabs-box">
                <div class="upper-box mb_60">
                    
					<?php if($settings['show_title_section']){ ?>
                    <div class="sec-title">
                        <?php if($settings['subtitle']){ ?><span class="sub-title"><?php echo wp_kses($settings['subtitle'], true); ?></span><?php } ?>
                        <?php if($settings['title']){ ?><h2><?php echo wp_kses($settings['title'], true); ?></h2><?php } ?>
                    </div>
                    <?php } ?>
                    
                    <div class="tab-btn-box p_relative">
                        <ul class="tab-btns tab-buttons clearfix">
                            <?php foreach($settings['tours_tab'] as $key => $item):?>
                            <li class="tab-btn <?php if($key == 0) echo 'active-btn';?>" data-tab="#tab-<?php echo esc_attr($key);?>"><?php echo wp_kses($item['tab_title'], true);?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="tabs-content">
                	<?php foreach($settings['tours_tab'] as $keys => $item):
					
						$show_rating = $item[ 'show_rating' ];
						$show_meta = $item[ 'show_meta' ];
						$show_user = $item[ 'show_user' ];
						$show_duration = $item[ 'show_duration' ];
						$show_price = $item[ 'show_price' ];
						$show_description = $item[ 'show_description' ];
						$btn_text = $item[ 'btn_text' ];												
						
						$paged = get_query_var('paged');
						$paged = travic_set($_REQUEST, 'paged') ? esc_attr($_REQUEST['paged']) : $paged;
		
						$this->add_render_attribute( 'wrapper', 'class', 'templatepath-travic' );
						$args = array(
							'post_type'      =>  'tf_tours',
							'posts_per_page' => travic_set( $item, 'query_number' ),
							'orderby'        => travic_set( $item, 'query_orderby' ),
							'order'          => travic_set( $item, 'query_order' ),
							'text_limit'     => travic_set( $item, 'text_limit' ),
							'paged'          => $paged
						);
						
						if( travic_set( $item, 'query_category' ) ) $args['tour_destination'] = travic_set( $item, 'query_category' );
						$query = new \WP_Query( $args );
						if ( $query->have_posts()):	
					?>
                    <div class="tab <?php if($keys == 0) echo 'active-tab';?>" id="tab-<?php echo esc_attr($keys);?>">
                        <div class="row clearfix">
                        	<?php 
								global  $post;
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
                            <div class="<?php echo esc_attr( $classes );?> tours-block">
                                <div class="tours-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <?php if(has_post_thumbnail()){ ?>
                                            <figure class="image"><?php the_post_thumbnail( 'travic_300x200' ); ?></figure>
                                            <?php } ?>
                                            
											<?php if ( $related_comments and $show_rating == 'yes' ) { ?>
                                            <span class="rating">
                                            	<div class="tf-slider-rating-star te-rating">
                                                    <i class="far fa-star"></i> <span><?php echo tf_total_avg_rating( $related_comments ); ?></span>
                                                </div>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <div class="lower-content">
                                            <h6 class="te-cat__style"><?php echo $first_destination_name; ?></h6>
                                            <h4 class="te-title"><a href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php the_title();?></a></h4>
                                            
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
                                            
                                            <div class="link "><a class="travic-btn" href="<?php echo esc_url( get_the_permalink( get_the_id() ) );?>"><?php echo $btn_text ? $btn_text : 'Explore more'?><i class="fas fa-long-arrow-right"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                    <?php endif;?>
					<?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <!-- tours-section end -->
    
	<?php endif; ?>
    
	<?php 
	}

}
