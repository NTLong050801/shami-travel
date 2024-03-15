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
class Blog_Grid extends Widget_Base {
    /**
     * Get widget name.
     * Retrieve button widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'travic_blog_grid';
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
        return esc_html__( 'Travic Blog Grid', 'travic' );
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
    /**
     * Register button widget controls.
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'blog_grid',
            [
                'label' => esc_html__( 'Blog Grid', 'travic' ),
            ]
        );
		
		$this->add_control(
			'layout_control',
			[
				'label'   => esc_html__( 'Layout Style', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'one',
				'options' => array(
					'one' => esc_html__( 'Style One ', 'travic'),
					'two' => esc_html__( 'Style Two ', 'travic'),
				),
			]
		);
		
		$this->add_control(
            'date',
            [
                'label'        => esc_html__( 'Show Date', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		$this->add_control(
            'category',
            [
                'label'        => esc_html__( 'Show Category', 'travic' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'travic' ),
                'label_off'    => esc_html__( 'Off', 'travic' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
		
		$this->add_control(
			'show_pagination',
			[
				'label'       => __( 'Enable/Disable Pagination Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 'layout_control' => ['two'], ],
				'label_on' => __( 'Show', 'travic' ),
				'label_off' => __( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);			
		
		$this->add_control(
			'col_grid',
			[
				'label'   => esc_html__( 'Choose Column', 'travic' ),
				'label_block' => true,
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'  => esc_html__( 'Default', 'travic' ),
					'one' => esc_html__( 'One Column Grid ', 'travic'),
					'two'  => esc_html__( 'Two Column Grid', 'travic' ),
					'three'  => esc_html__( 'Three Column Grid', 'travic' ),
					'four'  => esc_html__( 'Four Column Grid', 'travic' ),
					'five'  => esc_html__( 'Six Column Grid', 'travic' ),
				),
			]
		);	
		$this->add_control(
            'query_number',
            [
                'label'   => esc_html__( 'Number of post', 'travic' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 5,
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
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Category', 'travic'),
				'label_block' => true,
                'options' => get_blog_categories(),
            ]
        );
		
		$this->end_controls_section();
		
		//General Style
		$this->start_controls_section(
			'general_style',
			[
				'label' => esc_html__( 'Loop Setting', 'travic' ),
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
                    '{{WRAPPER}} .te-blog' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .te-blog' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .te-blog',				
			]
		);
			
		
		//Category
		$this->add_control(
			'show_loop_cat_style',
			[
				'label'       => __( 'ON/OFF Loop Category Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'loop_cat_typography',
                'label' => __('Loop Category Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-category',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_cat_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_cat_bg_color',
            [
                'label' => __('Loop Category Background Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-category a' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_cat_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_cat_color',
            [
                'label' => __('Loop Category Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-category a' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_cat_style'    => 'yes',
				]
            ]
        );
		//Title
		$this->add_control(
			'show_loop_title_style',
			[
				'label'       => __( 'ON/OFF Loop Title Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);	
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'loop_title_typography',
                'label' => __('Loop Title Typography', 'travic'),
                'selector' => 
                    '{{WRAPPER}} .te-title',                 
                'separator' => 'before',
				'condition'             => [
					'show_loop_title_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_title_color',
            [
                'label' => __('Loop Title Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-title a' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_title_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
            'loop_title_hover_color',
            [
                'label' => __('Loop Title Hover Color', 'travic'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .te-title a:hover' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
				'condition'             => [
					'show_loop_title_style'    => 'yes',
				]
            ]
        );
		
		$this->add_control(
			'show_loop_meta_style',
			[
				'label'       => __( 'ON/OFF Loop Meta Style', 'travic' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'travic' ),
				'label_off' => esc_html__( 'Hide', 'travic' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
            'meta__margin',
            [
                'label'      => esc_html__( 'Margin', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .te-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
				'condition'             => [
					'show_loop_meta_style'    => 'yes',
				]
            ]
        );		
        $this->add_responsive_control(
            'meta_padding',
            [
                'label'      => esc_html__( 'Padding', 'travic' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                   '{{WRAPPER}} .te-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'  => 'before',
				'condition'             => [
					'show_loop_meta_style'    => 'yes',
				]
            ]
        );
		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Text Color', 'travic' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .te-meta' => 'color: {{VALUE}};',
				],
				'condition'             => [
					'show_loop_meta_style'    => 'yes',
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
		$cat = $settings[ 'category' ];
		$date = $settings[ 'date' ];
		
		$grid_col = $settings[ 'col_grid' ];
		if( $grid_col == 'one' ){
			$classes = 'col-lg-12 col-md-12 col-sm-12';
		}elseif( $grid_col == 'two' ){
			$classes = 'col-lg-6 col-md-6 col-sm-12';
		}elseif( $grid_col == 'three' ){
			$classes = 'col-lg-4 col-md-6 col-sm-12';
		}elseif( $grid_col == 'four' ){
			$classes = 'col-lg-3 col-md-3 col-sm-12';
		}elseif( $grid_col == 'five' ){
			$classes = 'col-lg-2 col-md-4 col-sm-12';
		}else{
			$classes = 'col-lg-4 col-md-6 col-sm-12';
		}
		
		$paged = travic_set($_POST, 'paged') ? esc_attr($_POST['paged']) : 1;
        $this->add_render_attribute( 'wrapper', 'class', 'templatepath-greenture' );
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => travic_set( $settings, 'query_number' ),
            'orderby'        => travic_set( $settings, 'query_orderby' ),
            'order'          => travic_set( $settings, 'query_order' ),
            'paged'         => $paged
        );
        if( travic_set( $settings, 'query_category' ) ) $args['category_name'] = travic_set( $settings, 'query_category' );
        $query = new \WP_Query( $args );
		if ( $query->have_posts() )
		
		$args2 = array(
            'post_type'      => 'post',
            'posts_per_page' => travic_set( $settings, 'query_numbers' ),
            'orderby'        => travic_set( $settings, 'query_orderbys' ),
            'order'          => travic_set( $settings, 'query_orders' ),
            'paged'         => $paged
        );
        if( travic_set( $settings, 'query_categorys' ) ) $args2['category_name'] = travic_set( $settings, 'query_categorys' );
        $query2 = new \WP_Query( $args2 );
		
		if ( $query2->have_posts() ) { 
	?>
    
    <?php if($settings['layout_control'] == 'two') :?>
	
	<!-- news-section -->
    <section class="news-section blog-grid pt_120 pb_120">
        <div class="auto-container">
            <div class="row clearfix">
                
                <?php 
					global $post;
					while ( $query->have_posts() ) : $query->the_post(); 
					$post_thumbnail_id = get_post_thumbnail_id($post->ID);
					$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id); 
				?>
				<div class="<?php echo esc_attr( $classes );?> news-block">
					<div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
						<div class="inner-box te-blog">
							<figure class="image-box"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('travic_410x250'); ?></a></figure>
							<div class="lower-content">
								<ul class="post-info mb_15">
									<?php if( $cat == 'yes' ){?><li class="te-category"><?php the_category(' '); ?></li><?php } ?>
									<?php if( $date == 'yes' ){?><li class="te-meta"><i class="icon-19"></i><?php echo get_the_date(); ?></li><?php } ?>
								</ul>
								<h3 class="te-title">
									<a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a>
								</h3>
							</div>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
                
            </div>
            
            <?php if($settings['show_pagination']) : ?>
            <div class="pagination-wrapper centred pt_20">
                <?php travic_the_pagination2(array('total'=>$query->max_num_pages, 'next_text' => '<i class="fa fa-angle-right"></i>', 'prev_text' => '<i class="fa fa-angle-left"></i>')); ?>
            </div>
            <?php endif; ?>
            
        </div>
    </section>
    <!-- news-section end -->
	
	<?php else: ?>
    
    <div class="row clearfix" id="news">
        
        <?php 
			global $post;
			while ( $query->have_posts() ) : $query->the_post(); 
			$post_thumbnail_id = get_post_thumbnail_id($post->ID);
			$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id); 
		?>
        <div class="<?php echo esc_attr( $classes );?> news-block">
            <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                <div class="inner-box te-blog">
                    <figure class="image-box"><a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_post_thumbnail('travic_410x250'); ?></a></figure>
                    <div class="lower-content">
                        <ul class="post-info mb_15">
                            <?php if( $cat == 'yes' ){?><li class="te-category"><?php the_category(' '); ?></li><?php } ?>
                            <?php if( $date == 'yes' ){?><li class="te-meta"><i class="icon-19"></i><?php echo get_the_date(); ?></li><?php } ?>
                        </ul>
                        <h3 class="te-title">
                            <a href="<?php echo esc_url( the_permalink( get_the_id() ) );?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        
    </div>     
   	
    <?php endif; ?>
   	<?php }
	wp_reset_postdata();
	}
}