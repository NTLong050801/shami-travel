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
class Count_Box extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_count_box';
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
        return esc_html__( 'Travic Count Box', 'travic' );
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
            'count_box',
            [
                'label' => esc_html__( 'Count Box', 'travic' ),
            ]
        );
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your title', 'travic' ),
				'default' => esc_html__( 'Add Your Heading Text Here', 'travic' ),
			]
		);
		$repeater->add_control(
			'title2',
			[
				'label' => esc_html__( 'Count Value', 'travic' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter your Count Value', 'travic' ),
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
		
		//Count Value Style
		
		$this->start_controls_section(
			'text_style3',
			[
				'label' => esc_html__( 'Count Value Style', 'travic' ),
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
    
    <div class="home-2 content_block_two p-0 m-0">
        <div class="content-box p-0 m-0">
            <div class="inner-box">
                <div class="row clearfix">
                    <?php foreach($settings['slide'] as $key => $item): ?>
                    <div class="col-lg-6 col-md-6 col-sm-12 single-column">
                        <div class="single-item te-icon-box">
                            <?php if($item[ 'title2']) {?><h2 class="te-text"><?php echo wp_kses( $item[ 'title2'], true  );?></h2><?php } ?>
                            <?php if($item[ 'title']) {?><h4 class="te-title"><?php echo wp_kses( $item[ 'title'], true  );?></h4><?php } ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
	
	<?php
    }
}