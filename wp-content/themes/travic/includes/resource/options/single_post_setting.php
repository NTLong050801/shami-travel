<?php

return array(
	'title'      => esc_html__( 'Single Post Settings', 'travic' ),
	'id'         => 'single_post_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => 'single_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Single Post Source Type', 'travic' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'travic' ),
				'e' => esc_html__( 'Elementor', 'travic' ),
			),
			'default' => 'd',
		),
		
		array(
			'id'       => 'single_default_st',
			'type'     => 'section',
			'title'    => esc_html__( 'Post Default', 'travic' ),
			'indent'   => true,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
		array(
			'id'      => 'single_post_date',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Date', 'travic' ),
			'desc'    => esc_html__( 'Enable to show post publish date on posts detail page', 'travic' ),
			'default' => true,
		),
		array(
			'id'      => 'single_post_category',
			'type'    => 'switch',
			'title'   => esc_html__( 'Show Category', 'travic' ),
			'desc'    => esc_html__( 'Enable to show number of category on posts single page', 'travic' ),
			'default' => true,
		),
		array(
			'id'      => 'show_social_icon',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable/Disable Social Icons', 'travic' ),
			'desc'    => esc_html__( 'Enable to show Social Icons', 'travic' ),
			'default' => false,
		),
		//Author Box
		array(
			'id'      => 'single_post_author_box',
			'type'    => 'switch',
			'title'   => esc_html__( 'Enable/Disable Author Box Info', 'travic' ),
			'desc'    => esc_html__( 'Enable to show Author Box Info', 'travic' ),
			'default' => false,
		),
		
		array(
			'id'       => 'single_section_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'single_source_type', '=', 'd' ],
		),
	),
);





