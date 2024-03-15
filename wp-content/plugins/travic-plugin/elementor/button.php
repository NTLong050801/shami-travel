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
class Button extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_button';
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
        return esc_html__( 'Travic Button', 'travic' );
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
        return 'eicon-button';
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
            'button',
            [
                'label' => esc_html__( 'Button', 'travic' ),
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
				
		$this->add_responsive_control(
			'general_align',
			[
				'label' => esc_html__( 'Alignment', 'travic' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'travic' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'travic' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'travic' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .yt-btn' => 'text-align: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'btn_title',
			[
				'label'       => __( 'Button Title', 'travic' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Button Title Here', 'travic' ),
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
							'{{WRAPPER}} .travic-btn' => 'width: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .travic-btn' => 'height: {{SIZE}}{{UNIT}};',
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
							'{{WRAPPER}} .travic-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
							'{{WRAPPER}} .travic-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						
						'frontend_available' => true,
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' => 'btn_border_type',
						'selector' => 
							'{{WRAPPER}} .travic-btn',				
						'separator' => 'before',
					]
				);
				$this->add_group_control(
					Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'border_box_shadow',
						'selector' => 
							'{{WRAPPER}} .travic-btn',				
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
							'{{WRAPPER}} .travic-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'btn_title_typography',
						'label' => __('Button Text Typography', 'travic'),
						'selector' => 
							'{{WRAPPER}} .travic-btn',				
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_title_bg_color',
					[
						'label' => __('Button Background Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .travic-btn' => 'background: {{VALUE}}!important',
						],
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
							'{{WRAPPER}} .travic-btn' => 'color: {{VALUE}}!important',
						],
						'separator' => 'before',
					]
				);
				$this->add_control(
					'btn_title_icon_color',
					[
						'label' => esc_html__( 'Icon Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'condition' => ['btn_style' => ['1'], ],
						'selectors' => [
							'{{WRAPPER}} .travic-btn i' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_control(
					'btn_title_bg_icon_color',
					[
						'label' => esc_html__( 'Icon Background Color', 'travic' ),
						'type' => Controls_Manager::COLOR,
						'condition' => ['btn_style' => ['2', '3'], ],
						'selectors' => [
							'{{WRAPPER}} .travic-btn span' => 'background-color: {{VALUE}};',
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
							'{{WRAPPER}} .travic-btn:before,
										 .travic-btn:hover',				
					]
				);
				$this->add_control(
					'btn_title_hover_color',
					[
						'label' => __('Button Text Hover Color', 'travic'),
						'type' => Controls_Manager::COLOR,
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .travic-btn:hover' => 'color: {{VALUE}}!important',
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
		if($settings['layout_control'] == '2') :
	?>
    
    <a href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?> class="theme-btn travic-btn"> <?php echo wp_kses($settings['btn_title'], true);?> <i class="fas fa-long-arrow-right"></i></a>
    
    <?php else: ?>
    
    <div class="yt-btn">
        <div class="place-style-two p-0 m-0">
            <div class="sec-title p-0 m-0">
                <a class="travic-btn yt-btn" href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?> ><?php echo wp_kses($settings['btn_title'], true);?> <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>       
    
    <?php endif; 
    }
}