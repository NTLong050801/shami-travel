<?php

///----footer widgets---
//About Company
class Travic_About_Company extends WP_Widget
{
	
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Travic_About_Company', /* Name */esc_html__('Travic About Company','travic'), array( 'description' => esc_html__('Show the About Company', 'travic' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		echo wp_kses_post($before_widget);?>
        
        <div class="logo-widget">
            <?php if($instance['widget_logo_img']) { ?><figure class="footer-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $instance['widget_logo_img'] );?>" alt="<?php esc_attr_e( 'Awesome Image', 'travic' );?>"></a></figure><?php } ?>
            <div class="text-box">
                <?php if($instance['text']) { ?><p><?php echo wp_kses( $instance[ 'text' ], true );?></p><?php } ?>
                <?php if($instance['email'] || $instance['phone']) { ?>
                <ul class="info-list clearfix">
                    <?php if($instance['email']) { ?><li><a href="mailto:<?php echo esc_attr( $instance[ 'email' ], true );?>"><?php echo wp_kses( $instance[ 'email' ], true );?></a></li><?php } ?>
                    <?php if($instance['phone']) { ?><li><a href="tel:<?php echo esc_attr( $instance[ 'phone' ], true );?>"><?php echo wp_kses( $instance[ 'phone' ], true );?></a></li><?php } ?>
                </ul>
                <?php } ?>
            </div>
        </div>
                             
        <?php		
		echo wp_kses_post($after_widget);
	}
	
	
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['widget_logo_img'] = strip_tags($new_instance['widget_logo_img']);
		$instance['text'] = $new_instance['text'];
		$instance['email'] = $new_instance['email'];
		$instance['phone'] = $new_instance['phone'];
		
		return $instance;
	}

	/** @see WP_Widget::form */
	function form($instance)
	{
		$widget_logo_img = ($instance) ? esc_attr($instance['widget_logo_img']) : '';
		$text = ($instance) ? esc_attr($instance['text']) : '';
		$email = ($instance) ? esc_attr($instance['email']) : '';
		$phone = ($instance) ? esc_attr($instance['phone']) : '';
	?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_logo_img')); ?>"><?php esc_html_e('Widget Logo Image: ', 'travic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_logo_img')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_logo_img')); ?>" type="text" value="<?php echo esc_attr( $widget_logo_img ); ?>" />
        </p> 
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('text')); ?>"><?php esc_html_e('Text:', 'travic'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>" ><?php echo wp_kses_post($text); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email Address: ', 'travic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr( $email ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone Number: ', 'travic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr( $phone ); ?>" />
        </p>
    <?php 
	}
	
}

//Blog Widgets
//Recent Posts
class Travic_Recent_Posts extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Travic_Recent_Posts', /* Name */esc_html__('Travic Recent Posts','travic'), array( 'description' => esc_html__('Show the Recent Posts', 'travic' )) );
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo wp_kses_post($before_widget); ?>
		
        <div class="post-widget">
            <div class="mb_25">
                <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            </div>
            <div class="post-inner">
                <?php $query_string = array('showposts'=>$instance['number']);
				if ($instance['cat']) {
					$query_string['tax_query'] = array(array('taxonomy' => 'category','field' => 'id','terms' => (array)$instance['cat']));
				}
				$this->posts($query_string); ?>
            </div>
        </div>
        
		<?php echo wp_kses_post($after_widget);
	}
 
 
	/* @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}

	/* @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : esc_html__('Popular Post', 'travic');
		$number = ( $instance ) ? esc_attr($instance['number']) : 3;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';?>
			
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title: ', 'travic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('No. of Posts:', 'travic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php esc_html_e('Category', 'travic'); ?></label>
            <?php wp_dropdown_categories(array('show_option_all'=>esc_html__('All Categories', 'travic'), 'taxonomy' => 'category', 'selected'=>$cat, 'class'=>'widefat', 'name'=>$this->get_field_name('cat'))); ?>
        </p>
            
		<?php 
	}
	
	function posts($query_string)
	{
		
		$query = new WP_Query($query_string);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
			<?php 
				global $post;
				while ( $query->have_posts() ) : $query->the_post(); 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
			?>
            
            <div class="post">
                <figure class="post-thumb"><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_post_thumbnail('travic_90x90'); ?></a></figure>
                <h5><a href="<?php echo esc_url(get_the_permalink(get_the_id()));?>"><?php the_title(); ?></a></h5>
                <span class="post-date"><i class="icon-19"></i><?php echo get_the_date('');?></span>
            </div>
                        
            <?php endwhile; ?>
            
        <?php endif;
		wp_reset_postdata();
    }
}

//Our Projects
class Travic_Our_Projects extends WP_Widget
{
	/** constructor */
	function __construct()
	{
		parent::__construct( /* Base ID */'Travic_Our_Projects', /* Name */esc_html__('Travic Our Projects','travic'), array( 'description' => esc_html__('Show the Our Projects', 'travic' )) );
	}
 
	/** @see WP_Widget::widget */
	function widget($args, $instance)
	{
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo wp_kses_post($before_widget); ?>
		
        <div class="gallery-widget">
            <div class="mb_20">
                <?php echo wp_kses_post($before_title.$title.$after_title); ?>
            </div>
            <div class="widget-content">
                <ul class="image-list clearfix">
                    <?php 
						$args = array('post_type' => 'project', 'showposts'=>$instance['number']);
						if( $instance['cat'] ) $args['tax_query'] = array(array('taxonomy' => 'project_cat','field' => 'id','terms' => (array)$instance['cat']));
						$this->posts($args);
                    ?>
                </ul>
            </div>
        </div>
        
        <?php echo wp_kses_post($after_widget);
	}
 
 
	/** @see WP_Widget::update */
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['cat'] = $new_instance['cat'];
		
		return $instance;
	}
	/** @see WP_Widget::form */
	function form($instance)
	{
		$title = ( $instance ) ? esc_attr($instance['title']) : 'Our Projects';
		$number = ( $instance ) ? esc_attr($instance['number']) : 6;
		$cat = ( $instance ) ? esc_attr($instance['cat']) : '';
		?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'travic'); ?></label>
            <input placeholder="<?php esc_attr_e('Our Projects', 'travic');?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts: ', 'travic'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('cat')); ?>"><?php esc_html_e('Category', 'travic'); ?></label>
            <?php wp_dropdown_categories( array('show_option_all'=>esc_html__('All Categories', 'travic'), 'selected'=>$cat, 'taxonomy' => 'project_cat', 'class'=>'widefat', 'name'=>$this->get_field_name('cat')) ); ?>
        </p>
        
		<?php 
	}
	
	function posts($args)
	{
		
		$query = new WP_Query($args);
		if( $query->have_posts() ):?>
        
           	<!-- Title -->
            <?php 
				global $post;
				while( $query->have_posts() ): $query->the_post(); 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id); 
			?>
            <li><a href="<?php echo esc_url($post_thumbnail_url);?>" class="lightbox-image" data-fancybox="gallery"><img src="<?php echo esc_url($post_thumbnail_url);?>" alt="<?php esc_attr_e( 'Awesome Image', 'travic' );?>"></a></li>
            <?php endwhile; ?>
                
        <?php endif;
		wp_reset_postdata();
    }
}

