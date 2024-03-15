<?php
return array(
	'title'      => 'Travic Testimonials Setting',
	'id'         => 'travic_meta_testimonials',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'testimonials' ),
	'sections'   => array(
		array(
			'id'     => 'travic_testimonials_meta_setting',
			'fields' => array(
				array(
					'id'    => 'shape_image',
					'type'  => 'media',
					'title' => esc_html__( 'Shape Image', 'travic' ),
				),
				array(
					'id'    => 'author_name',
					'type'  => 'text',
					'title' => esc_html__( 'Author Name', 'travic' ),
				),
				array(
					'id'    => 'author_designation',
					'type'  => 'text',
					'title' => esc_html__( 'Author Designation', 'travic' ),
				),
				array(
					'id'    => 'testimonial_rating',
					'type'  => 'select',
					'title' => esc_html__( 'Choose the Client Rating', 'travic' ),
					'options'  => array(
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
					),
				),
			),
		),
	),
);