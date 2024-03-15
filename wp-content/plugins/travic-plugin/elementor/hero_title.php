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
class Hero_Title extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_hero_title';
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
        return esc_html__( 'Travic Hero Title', 'travic' );
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
        return 'eicon-site-identity';
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
            'hero_title',
            [
                'label' => esc_html__( 'Travic Hero Title', 'travic' ),
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
					'{{WRAPPER}} .sec-title' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
            'subtitle_show',
            [
                'label'        => esc_html__( 'Enable Small Title', 'travic' ),
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
				'label' => esc_html__( 'Small Title', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your small title', 'travic' ),
				'default' => esc_html__( 'Add Your Sub Heading Text Here', 'travic' ),
				'condition'   => [ 'subtitle_show' => 'yes' ]
			]
		);
		$this->add_control(
			'small_title_tag',
			[
				'label' => esc_html__( 'Small Title HTML Tag', 'travic' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'span',
				'condition'   => [ 'subtitle_show' => 'yes' ]
			]
		);
		
		$this->add_control(
            'title_show',
            [
                'label'        => esc_html__( 'Enable Title', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
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
				'condition'   => [ 'title_show' => 'yes' ]
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Size', 'travic' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'travic' ),
					'small' => esc_html__( 'Small', 'travic' ),
					'medium' => esc_html__( 'Medium', 'travic' ),
					'large' => esc_html__( 'Large', 'travic' ),
					'xl' => esc_html__( 'XL', 'travic' ),
					'xxl' => esc_html__( 'XXL', 'travic' ),
				],
				'condition'   => [ 'title_show' => 'yes' ]
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Title HTML Tag', 'travic' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
				'condition'   => [ 'title_show' => 'yes' ]
			]
		);
		
		//Text
		$this->add_control(
            'text_show',
            [
                'label'        => esc_html__( 'Enable Text', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
		
		$this->add_control(
            'text',
            [
                'label'   => esc_html__( 'Description', 'travic' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your Text Here', 'travic' ),
				'default' => esc_html__( 'Sed gravida nisl a porta tincidunt. Integer aliquam nisi sit amet magna suscipit, fermentum mattis erat rutrum. Sed suscipit libero lectus, at ullamcorper erat feugiat eu. Nam posuere ultrices nibh ut sagittis. Etiam arcu turpis, elementum ac nulla vel, tristique cursus libero. Fusce feugiat, justo at mattis tincidunt, velit ante congue ante, et lacinia metus ipsum a risus.', 'travic' ),
				'condition'   => [ 'text_show' => 'yes' ]
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
                    '{{WRAPPER}} .sec-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .sec-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .sec-title',				
			]
		);
		$this->end_controls_section();
		
		//Small Title Style
		$this->start_controls_section(
			'small_title_style',
			[
				'label' => esc_html__( 'Small Title', 'travic' ),
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
			'text_style',
			[
				'label' => esc_html__( 'Text', 'travic' ),
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
                    '{{WRAPPER}} .normal__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .normal__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
					'{{WRAPPER}} .normal__text p' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __('Typography', 'travic'),
				'selector' => '{{WRAPPER}} .normal__text p',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_text_shadow',
				'selector' => '{{WRAPPER}} .normal__text p',
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
	
		$this->add_render_attribute( 'subtitle', 'class', 'sub-title te-subtitle' );
		$subtitle = $settings['subtitle'];
		$subtitle_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['small_title_tag'] ), $this->get_render_attribute_string( 'subtitle' ), $subtitle );
		
		$this->add_render_attribute( 'title', 'class', 'te-title' );
		if ( ! empty( $settings['title_size'] ) ) {
			$this->add_render_attribute( 'title', 'class', 'travic-size-' . $settings['title_size'] );
		}
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag( $settings['title_tag'] ), $this->get_render_attribute_string( 'title' ), $title );
		
		$text = $settings[ 'text' ];
	?>
    	
        <div class="sec-title">
            <?php echo wp_kses( $subtitle_html, true );?>
            <?php echo wp_kses( $title_html, true );?>
        </div>
        
		<?php if( $text ){ ?>
        <div class="text-box normal__text">
            <p><?php echo wp_kses( $text, true );?></p>
        </div>
        <?php } ?>
        
    <?php 
    }
}