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
class Icon_Box extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_icon_box';
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
        return esc_html__( 'Travic Icon Box', 'travic' );
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
            'icon_box',
            [
                'label' => esc_html__( 'Icon Box', 'travic' ),
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
		
		$this->add_responsive_control(
			'general_align',
			[
				'label' => esc_html__( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'elementor' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'elementor' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'elementor' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .te-icon-box' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Enter The icons', 'travic'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'icon-mail',
					'library' => 'solid',
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
			]
		);
		
		$this->add_control(
			'link_option',
			[
				'label'   => esc_html__( 'Select link Option', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'extranal',
				'condition' => [
					'layout_control' => ['2'],
				],
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
		
		$this->add_control(
			'text',
			[
				'label' => esc_html__( 'Text', 'travic' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your text', 'travic' ),
				'condition' => [
					'layout_control' => ['1', '2'],
				],
			]
		);
		$this->add_control(
			'info',
			[
				'label' => esc_html__( 'Info', 'travic' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your info', 'travic' ),
				'condition' => [
					'layout_control' => ['3'],
				],
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
		
		$this->add_control(
			'title_hover_color',
			[

				'label' => esc_html__( 'Title Hover Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-title:hover' => 'color: {{VALUE}};',
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
			
		
		//Icon Style		
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'travic' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'icon__margin',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		$this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bgtype',
				'label' => __( 'Background', 'travic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .te-icon i',				
			]
		);
		$this->end_controls_section();
		
		//Text Style
		
		$this->start_controls_section(
			'text_style3',
			[
				'label' => esc_html__( 'Text Style', 'travic' ),
				'condition' => [
					'layout_control' => ['1', '2'],
				],
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
		
		//Info Style
		$this->start_controls_section(
			'small_title_style',
			[
				'label' => esc_html__( 'Info Title', 'travic' ),
				'condition' => [
					'layout_control' => ['3'],
				],
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
            'small_title__margin',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		
        $this->add_responsive_control(
            'small_title_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
            ]
        );
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'small_title_bgtype',
				'label' => __( 'Background', 'travic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .te-subtitle',				
			]
		);
		
		$this->add_control(
			'small_title_color',
			[
				'label' => esc_html__( 'Text Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'small_title_typography',
				'label' => __('Typography', 'travic'),
				'selector' => '{{WRAPPER}} .te-subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'small_title_text_stroke',
				'selector' => '{{WRAPPER}} .te-subtitle',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'small_title_text_shadow',
				'selector' => '{{WRAPPER}} .te-subtitle',
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
		$layout = $settings[ 'layout_control' ];
		$icon = $settings['icon'];
		
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
		
		<?php if( $layout == 3 ):?>
        
        <div class="info-block-one">
            <div class="inner-box te-icon-box">
                <div class="icon-box te-icon">
					<?php
                         $icon = str_replace( "icon ",  "",  $settings['icon']);
                         if( !empty( $icon ) ):?>
                        <?php \Elementor\Icons_Manager::render_icon( $icon ); ?>
                    <?php else:?>
                        <i class="icon-15"></i>
                    <?php endif;?>
                </div>
                <?php if($settings['title']){ ?><h3 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h3><?php } ?>
                <?php if($settings['info']){ ?><p class="te-subtitle"><?php echo wp_kses($settings['info'], true ) ;?></p><?php } ?>
            </div>
        </div>
                    
        <?php elseif( $layout == 2 ):?>
                   
        <div class="chooseus-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
            <div class="inner-box te-icon-box">
                <div class="icon-box te-icon">
					<?php
                         $icon = str_replace( "icon ",  "",  $settings['icon']);
                         if( !empty( $icon ) ):?>
                        <?php \Elementor\Icons_Manager::render_icon( $icon ); ?>
                    <?php else:?>
                        <i class="icon-15"></i>
                    <?php endif;?>
                </div>
                <h3><a class="te-title" href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?> ><?php echo wp_kses($settings['title'], true ) ;?></a></h3>
                <?php if($settings['text']){ ?><p class="te-text"><?php echo wp_kses($settings['text'], true ) ;?></p><?php } ?>
             </div>
        </div>
		
		<?php else:?>
        
        <div class="content_block_one p-0 m-0">
            <div class="content-box p-0 m-0">
                <div class="inner-box te-icon-box p-0 m-0">
                    <div class="single-item">
                        <div class="icon-box te-icon">
                            <?php
                                 $icon = str_replace( "icon ",  "",  $settings['icon']);
                                 if( !empty( $icon ) ):?>
                                <?php \Elementor\Icons_Manager::render_icon( $icon ); ?>
                            <?php else:?>
                                <i class="icon-13"></i>
                            <?php endif;?>
                        </div>
                        <?php if($settings['title']){ ?><h3 class="te-title"><?php echo wp_kses($settings['title'], true ) ;?></h3><?php } ?>
                        <?php if($settings['text']){ ?><p class="te-text"><?php echo wp_kses($settings['text'], true ) ;?></p><?php } ?>
                    </div>
                </div>
            </div>
        </div>
        	
    	
    <?php endif;
    }
}