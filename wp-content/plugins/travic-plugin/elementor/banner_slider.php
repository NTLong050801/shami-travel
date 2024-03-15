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
use \Elementor\Group_Control_Image_Size;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class Banner_Slider extends Widget_Base {

    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_banner_slider';
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
        return esc_html__( 'Travic Banner Slider', 'travic' );
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
        return 'eicon-banner';
    }

    
    public function get_categories() {
        return [ 'travic' ];
    }
	
	public function get_script_depends() {
		wp_register_script( 'banner-slider-script', YT_URL . 'assets/js/banner-carousel.js', [ 'elementor-frontend' ], '1.0.0', true );
		return [ 'banner-slider-script' ];
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
            'banner_slider',
            [
                'label' => esc_html__( 'Banner Slider', 'travic' ),
            ]
        );
		
		//Banner SLide Repeater
		$repeater = new Repeater();
		$repeater->add_control(
			'banner_image',
			[
				'label' => __( 'Banner Image', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
		);	
		$repeater->add_control(
            'show_shapes',
			[
				'label' => __( 'Enable/Disable Big Text', 'travic' ),
				'type'     => Controls_Manager::SWITCHER,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enable/Disable Big Text', 'travic' ),
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label'       => __( 'Sub Title ', 'travic' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Sub Title', 'travic' ),
			]
		);
		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'travic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Title', 'travic' ),
			]
		);
		$repeater->add_control(
			'text',
			[
				'label'       => __( 'Description', 'travic' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Description', 'travic' ),
			]
		);
		
		$this->add_control(
			'slide',
			[
				'label'                 => __('Add Slide Item', 'travic'),
				'type'                  => Controls_Manager::REPEATER,
				'fields'                => $repeater->get_controls(),
			]
		);
		$this->add_control(
            'show_form',
			[
				'label' => __( 'Enable/Disable Form', 'travic' ),
				'type'     => Controls_Manager::SWITCHER,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enable/Disable Form', 'travic' ),
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
                    '{{WRAPPER}} .te-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .te-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
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
		
		/**Button Text Style**/
		$this->start_controls_section(
			'btn_text_style',
			[
				'label' => esc_html__('BIG TEXT STYLE SETTING', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_btn_text_style',
			[
				'label'       => __( 'ON/OFF  Big Text Style', 'travic' ),
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
				'name' => 'btn_text_bgtype',
				'label' => __( 'Button Text Background', 'travic' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 
					'{{WRAPPER}} .video-title',				
				'condition'             => [
					'show_btn_text_style'    => 'yes',
				]
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_text_typography',
                'label' => __('Button Text Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .video-title',                 
                'separator' => 'before',
				'condition'             => [
					'show_btn_text_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'btn_text_color',
            [
                'label' => __('Button Text Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .video-title' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_btn_text_style'    => 'yes',
				]
            ]
        );
		$this->end_controls_section();
		
		/**Sub Title Style**/
		$this->start_controls_section(
			'sub_title_style',
			[
				'label' => esc_html__('SUB TITLE STYLE SETTING', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_sub_title_style',
			[
				'label'       => __( 'ON/OFF Sub Title Style', 'travic' ),
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
				'name' => 'sub_title_bgtype',
				'label' => __( 'Sub Title Background', 'travic' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 
					'{{WRAPPER}} .te-subtitle',				
				'condition'             => [
					'show_sub_title_style'    => 'yes',
				]
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __('Sub Title Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-subtitle',                 
                'separator' => 'before',
				'condition'             => [
					'show_sub_title_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'sub_title_color',
            [
                'label' => __('Sub Title Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-subtitle' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_sub_title_style'    => 'yes',
				]
            ]
        );
		$this->end_controls_section();
		
		
		/**Title Style**/
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__('TITLE STYLE SETTING', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_title_style',
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
			Group_Control_Background::get_type(),
			[
				'name' => 'title_bgtype',
				'label' => __( 'Title Background', 'travic' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 
					'{{WRAPPER}} .te-title',				
				'condition'             => [
					'show_title_style'    => 'yes',
				]
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-title',                 
                'separator' => 'before',
				'condition'             => [
					'show_title_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-title' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_title_style'    => 'yes',
				]
            ]
        );
		$this->end_controls_section();
		
		/**Content Style**/
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('CONTENT STYLE SETTING', 'travic'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_content_style',
			[
				'label'       => __( 'ON/OFF  Content Style', 'travic' ),
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
					'{{WRAPPER}} .te-text',				
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
                    '{{WRAPPER}} .te-text',                 
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
                    '{{WRAPPER}} .te-text' => 'color: {{VALUE}}'
                ],
                'separator' => 'before',
				'condition'             => [
					'show_content_style'    => 'yes',
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
		
	?>
    
	<!-- banner-section -->
    <section class="banner-section p_relative centred">
        <div class="banner-carousel owl-theme owl-carousel <?php if( $settings['arrows'] == 'yes' ) echo 'nav-style-one'; else echo 'owl-nav-none';?> <?php if( $settings['dots'] == 'yes' ) echo 'dots-style-one'; else echo 'owl-dots-none';?>"
        data-owl-options='{
                "loop": <?php echo esc_attr( $infiinite );?>,
                "autoplay": <?php echo esc_attr( $autoplay );?>,
                "margin": <?php echo esc_attr( $image_item_gap );?>,
                "nav": <?php echo esc_attr( $arrows );?>,
                "dots": <?php echo esc_attr( $dots );?>,
                "smartSpeed": <?php echo esc_attr( $smart_speed );?>,
                "autoplayTimeout": <?php echo esc_attr( $autoplay_speed );?>,
                "animateOut": "fadeOut",
                "animateIn": "fadeIn",
                "navText": ["<span class=\"icon-6\"></span>","<span class=\"icon-7\"></span>"],
                "responsive": {
                    "0": {
                        "items": 1
                    },
                    "600": {
                        "items": 1
                    },
                    "800": {
                        "items": 1
                    },
                    "1024": {
                        "items": 1
                    },
                    "1200": {
                        "items": <?php echo esc_attr( $items_show );?>
                    }
                }
            }'
          >
            
            <?php foreach($settings['slide'] as $key => $item): ?>
            <div class="slide-item p_relative te-banner">
                <?php if($item[ 'banner_image' ]['id']){ ?><div class="bg-layer" style="background-image: url(<?php echo esc_url( wp_get_attachment_url( $item[ 'banner_image' ]['id'] ) );?>);"></div><?php } ?>
                <?php if($item[ 'show_shapes']) {?><span class="big-text animation_text_word video-title"></span><?php } ?>
                <div class="auto-container">
                    <div class="content-box">
                        <?php if($item[ 'subtitle']) {?><span class="special-text te-subtitle"><?php echo wp_kses( $item[ 'subtitle'], true  );?></span><?php } ?>
                        <?php if($item[ 'title']) {?><h2 class="te-title"><?php echo wp_kses( $item[ 'title'], true  );?></h2><?php } ?>
                        <?php if($item[ 'text']) {?><p class="te-text"><?php echo wp_kses( $item[ 'text'], true  );?></p><?php } ?>
                    </div> 
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
        <?php if($settings[ 'show_form']) {?>
        <div class="booking-form">
            <div class="auto-container">
                <div class="booking-inner">
                    
                </div>
            </div>
        </div>
        <?php } ?>
    </section>
    <!-- banner-section end -->
    
    <?php
    }
}
