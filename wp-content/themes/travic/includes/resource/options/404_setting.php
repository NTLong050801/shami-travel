<?php

return array(
	'title'      => esc_html__( '404 Page Settings', 'travic' ),
	'id'         => '404_setting',
	'desc'       => '',
	'subsection' => true,
	'fields'     => array(
		array(
			'id'      => '404_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( '404 Source Type', 'travic' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'travic' ),
				'e' => esc_html__( 'Elementor', 'travic' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => '404_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'travic' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
			],
			'required' => [ '404_source_type', '=', 'e' ],
		),
		array(
			'id'       => '404_default_st',
			'type'     => 'section',
			'title'    => esc_html__( '404 Default', 'travic' ),
			'indent'   => true,
			'required' => [ '404_source_type', '=', 'd' ],
		),
		array(
			'id'       => 'bg_image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( '404 Error Image', 'travic' ),
			'desc'     => esc_html__( 'Insert Error image', 'travic' ),
			'default'  => '',
		),
		array(
			'id'    => '404_page_title',
			'type'  => 'text',
			'title' => esc_html__( '404 Page Heading', 'travic' ),
			'desc'  => esc_html__( 'Enter 404 section Page Heading that you want to show', 'travic' ),
		),
		array(
			'id'    => 'back_home_btn',
			'type'  => 'switch',
			'title' => esc_html__( 'Show Button', 'travic' ),
			'desc'  => esc_html__( 'Enable to show back to home button.', 'travic' ),
			'default'  => true,
		),
		array(
			'id'       => 'back_home_btn_label',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Label', 'travic' ),
			'desc'     => esc_html__( 'Enter back to home button label that you want to show.', 'travic' ),
			'default'  => esc_html__( 'Back To Home', 'travic' ),
			'required' => array( 'back_home_btn', '=', true ),
		),
		array(
			'id'    => 'back_home_btn2',
			'type'  => 'switch',
			'title' => esc_html__( 'Show Button 02', 'travic' ),
			'desc'  => esc_html__( 'Enable to show back to home button.', 'travic' ),
			'default'  => true,
		),
		array(
			'id'       => 'back_home_btn_label2',
			'type'     => 'text',
			'title'    => esc_html__( 'Button Label 02', 'travic' ),
			'desc'     => esc_html__( 'Enter back to home button label that you want to show.', 'travic' ),
			'default'  => esc_html__( 'Back To Home', 'travic' ),
			'required' => array( 'back_home_btn2', '=', true ),
		),
		array(
			'id'     => '404_post_settings_end',
			'type'   => 'section',
			'indent' => false,
		),
	),
);