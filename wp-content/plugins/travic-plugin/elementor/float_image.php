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
class Float_Image extends Widget_Base {
	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'travic_float_image';
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
		return esc_html__( 'Travic Float Image', 'travic' );
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
		return 'eicon-image-hotspot';
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
			'float_image',
			[
				'label' => esc_html__( 'Float Image', 'travic' ),
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
					'4' => esc_html__( 'Style Four ', 'travic'),
					'5' => esc_html__( 'Style Five ', 'travic'),
				),
			]
		);
		$this->add_control(
            'show_shapes',
			[
				'label' => __( 'Enable/Disable Shape Images', 'travic' ),
				'type'     => Controls_Manager::SWITCHER,
				'condition' => ['layout_control' => ['3'], ],
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => __( 'Enable/Disable Shape Images', 'travic' ),
			]
		);
		$this->add_control(
			'feature_image',
			[
				'label' => esc_html__( 'Feature Image', 'travic' ),
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
				'label' => esc_html__( 'Feature Image 02', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => ['layout_control' => ['2'], ],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'feature_image3',
			[
				'label' => esc_html__( 'Feature Image 03', 'travic' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'condition' => ['layout_control' => ['2'], ],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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
	
	<?php if($settings['layout_control'] == '4'):?>
	
    
	
	<?php elseif($settings['layout_control'] == '3') :?>
	
	<div class="about-style-two p-0 m-0">
        <div class="image-column">
            <div class="image-box centred">
                <?php if($settings[ 'show_shapes']) {?><div class="image-shape" style="background-image: url(<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/shape/shape-13.png);"></div><?php } ?>
                <?php if($settings['feature_image']['id']){ ?><figure class="image wow slideInRight animated" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
            </div>
        </div>
    </div>
	
	<?php elseif($settings['layout_control'] == '2') :?>
    
    <div class="image_block_one" id="about">
        <div class="image-box">
            <?php if($settings['feature_image']['id']){ ?><figure class="image image-1"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
			<?php if($settings['feature_image2']['id']){ ?><figure class="image image-2"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image2']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
            <?php if($settings['feature_image3']['id']){ ?><figure class="image image-3"><img src="<?php echo esc_url(wp_get_attachment_url($settings['feature_image3']['id'])); ?>" alt="<?php esc_attr_e('Awesome Image', 'travic'); ?>"></figure><?php } ?>
        </div>
    </div>
    
	<?php else: ?>
    
    <div class="about-section p-0 m-0">
    	<div class="pattern-layer" style="background-image: url(<?php echo esc_url(wp_get_attachment_url($settings['feature_image']['id'])); ?>);"></div>
    </div>
    
	<?php endif; ?>  
    
    <?php 
	}
}