<?php

namespace TRAVICPLUGIN\Inc;
use TRAVICPLUGIN\Inc\Abstracts\Taxonomy;

class Taxonomies extends Taxonomy {

	public static function init() {

		$labels = array(
			'name'              => _x( 'Project Category', 'wptravic' ),
			'singular_name'     => _x( 'Project Category', 'wptravic' ),
			'search_items'      => __( 'Search Category', 'wptravic' ),
			'all_items'         => __( 'All Categories', 'wptravic' ),
			'parent_item'       => __( 'Parent Category', 'wptravic' ),
			'parent_item_colon' => __( 'Parent Category:', 'wptravic' ),
			'edit_item'         => __( 'Edit Category', 'wptravic' ),
			'update_item'       => __( 'Update Category', 'wptravic' ),
			'add_new_item'      => __( 'Add New Category', 'wptravic' ),
			'new_item_name'     => __( 'New Category Name', 'wptravic' ),
			'menu_name'         => __( 'Project Category', 'wptravic' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'project_cat' ),
		);

		register_taxonomy( 'project_cat', 'project', $args );
		
		
		//Testimonials Taxonomy Start
		$labels = array(
			'name'              => _x( 'Testimonials Category', 'wptravic' ),
			'singular_name'     => _x( 'Testimonials Category', 'wptravic' ),
			'search_items'      => __( 'Search Category', 'wptravic' ),
			'all_items'         => __( 'All Categories', 'wptravic' ),
			'parent_item'       => __( 'Parent Category', 'wptravic' ),
			'parent_item_colon' => __( 'Parent Category:', 'wptravic' ),
			'edit_item'         => __( 'Edit Category', 'wptravic' ),
			'update_item'       => __( 'Update Category', 'wptravic' ),
			'add_new_item'      => __( 'Add New Category', 'wptravic' ),
			'new_item_name'     => __( 'New Category Name', 'wptravic' ),
			'menu_name'         => __( 'Testimonials Category', 'wptravic' ),
		);
		$args   = array(
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'show_admin_column'  => true,
			'query_var'          => true,
			'public'             => true,
			'publicly_queryable' => true,
			'rewrite'            => array( 'slug' => 'testimonials_cat' ),
		);


		register_taxonomy( 'testimonials_cat', 'testimonials', $args );
		
	}
	
}
