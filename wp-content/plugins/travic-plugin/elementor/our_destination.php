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
class Our_Destination extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_our_destination';
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
        return esc_html__( 'Travic Our Destination', 'travic' );
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
            'our_destination',
            [
                'label' => esc_html__( 'Our Destination', 'travic' ),
            ]
        );
		//Banner SLide Repeater
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'travic' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Title', 'travic' ),
			]
		);
		$repeater->add_control(
			'feature_image',
			[
				'label' => esc_html__( 'Category Image', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
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
		$repeater->add_control(
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
		$repeater->add_control(
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
				'label' => esc_html__( 'Loop General Setting', 'travic' ),
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
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'general_bgtype',
				'label' => __( 'Background', 'travic' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .te-banner',				
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
        
		<section class="place-style-two p-0 m-0">
            <ul class="place-list">
                
                <?php foreach($settings['slide'] as $key => $item): ?>
                <li>
                    <div class="place-block-two te-banner">
                        <div class="inner-box">
                            <?php if($item[ 'feature_image' ]['id']){ ?><figure class="image-box"><img src="<?php echo esc_url(wp_get_attachment_url($item['feature_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
                            <?php if($item[ 'title']){ 
							$page = $item['link_option'];
							$page_select = $item[ 'page_select' ];
							$ext_url = $item[ 'link' ];
							
							if( $page == 'page' ){
								$mount_link = get_page_link( $page_select );
							}else{
								$mount_link = $ext_url['url'];
								$target = $ext_url['is_external'] ? ' target="_blank"' : '';
								$nofollow = $ext_url['nofollow'] ? ' rel="nofollow"' : '';
							}
							?>
								<h4><a class="te-title" href="<?php echo esc_url( $mount_link );?>" <?php if( $page == 'extranal' ) echo esc_attr( $target );?> <?php if( $page == 'extranal' ) echo esc_attr( $nofollow );?> ><?php echo wp_kses( $item[ 'title'], true  );?></a></h4>
							<?php } ?>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                
            </ul>
        </section>
        	
    	
    <?php
    }
}