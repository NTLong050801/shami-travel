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
class Banner extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_banner';
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
        return esc_html__( 'Travic Banner', 'travic' );
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
            'banner',
            [
                'label' => esc_html__( 'Banner', 'travic' ),
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
            'show_shapes',
			[
				'label' => __( 'Enable/Disable Shape Images', 'travic' ),
				'type'     => Controls_Manager::SWITCHER,
				'condition' => ['layout_control' => '1' ],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enable/Disable Shape Images', 'travic' ),
			]
		);
		$this->add_control(
			'feature_image',
			[
				'label' => esc_html__( 'Banner Image', 'travic' ),
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
			'feature_image2',
			[
				'label' => esc_html__( 'Banner Image 02', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => ['layout_control' => '1' ],
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'feature_image3',
			[
				'label' => esc_html__( 'Banner Image 03', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => ['layout_control' => '1'],
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'bigtitle',
			[
				'label'       => __( 'Big Title ', 'travic' ),
				'label_block' => true,
				'condition' => ['layout_control' => '1' ],
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Big Title', 'travic' ),
			]
		);
		$this->add_control(
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
			'text',
			[
				'label' => esc_html__( 'Text', 'travic' ),
				'condition' => ['layout_control' => '1' ],
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your text', 'travic' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'travic' ),
			]
		);
		$this->add_control(
			'title2',
			[
				'label' => esc_html__( 'Circle Title', 'travic' ),
				'condition' => ['layout_control' => '1' ],
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your circle title', 'travic' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'travic' ),
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
		
		/**Button Text Style**/
		$this->start_controls_section(
			'btn_text_style',
			[
				'label' => esc_html__('Big Text Style Settings', 'travic'),
				'condition' => ['layout_control' => '1' ],
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
                'label' => __('Big Title Typography', 'travic'),
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
				'label' => esc_html__('Sub Title Style Settings', 'travic'),
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
		
		//Title Style
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style Settings', 'travic' ),
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
		
		//Text Style
		
		$this->start_controls_section(
			'text_style3',
			[
				'label' => esc_html__( 'Text Style Settings', 'travic' ),
				'condition' => ['layout_control' => '1' ],
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
		
		/**Content Style**/
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__('Circle Text Style Settings', 'travic'),
				'condition' => ['layout_control' => '1' ],
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_content_style',
			[
				'label'       => __( 'ON/OFF  Circle Text Style', 'travic' ),
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
        
	<?php if($settings['layout_control'] == '2') :?>
    
    <!-- banner-style-three -->
    <section class="banner-style-three p_relative centred te-icon-box">
        <?php if($settings['feature_image']['id']){ ?><div class="bg-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"></div><?php } ?>
        <div class="auto-container">
            <div class="content-box">
                <?php if($settings[ 'subtitle']) {?><span class="title-text te-subtitle"><?php echo wp_kses($settings['subtitle'], true ) ;?></span><?php } ?>
                <?php if($settings[ 'title']) {?><h2 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h2><?php } ?>
            </div>
        </div>
    </section>
    <!-- banner-style-three end -->
    
    <?php else: ?>
    
    <!-- banner-section -->
    <section class="banner-style-two pt_100 te-icon-box">
        <?php if($settings[ 'bigtitle']) {?><span class="big-text video-title"><?php echo wp_kses($settings['bigtitle'], true ) ;?></span><?php } ?>
        <?php if($settings[ 'show_shapes']) {?><div class="pattern-layer" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-6.png);"></div><?php } ?>
        <div class="auto-container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div class="content-box">
                        <?php if($settings[ 'subtitle']) {?><span class="title-text te-subtitle"><?php echo wp_kses($settings['subtitle'], true ) ;?></span><?php } ?>
                        <?php if($settings[ 'title']) {?><h2 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h2><?php } ?>
                        <?php if($settings[ 'text']) {?><p class="te-text"><?php echo wp_kses($settings['text'], true ) ;?> </p><?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div class="image-box ml_40">
                        <?php if($settings['feature_image']['id']){ ?><figure class="image image-1 mb_30"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
                        <?php if($settings['feature_image2']['id']){ ?><figure class="image image-2"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image2']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
                        <?php if($settings['feature_image3']['id']){ ?><figure class="image image-3"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image3']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
                        <?php if($settings[ 'title2']) {?>
                        <div class="curve-text">
                            <div class="icon-box"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icons/icon-3.png" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></div>
                            <span class="curved-circle te-circle"><?php echo wp_kses($settings['title2'], true ) ;?></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner-section end --> 
      
    <?php endif;
    }
}