<?php
return array(
	'title'      => esc_html__( 'Logo Setting', 'travic' ),
	'id'         => 'logo_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		//Favicon Style
		array(
			'id'       => 'image_favicon',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Favicon', 'travic' ),
			'subtitle' => esc_html__( 'Insert site favicon image', 'travic' ),
			'default'  => array( 'url' => get_template_directory_uri() . '/assets/images/favicon.ico' ),
		),
		//Dark Logo Style
		array(
            'id' => 'normal_logo_show',
            'type' => 'switch',
            'title' => esc_html__('Enable Dark Logo', 'travic'),
            'default' => true,
        ),
		array(
			'id'       => 'main_color_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Dark Logo Image', 'travic' ),
			'subtitle' => esc_html__( 'Insert site dark logo image', 'travic' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		array(
			'id'       => 'main_color_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Dark Logo Dimentions', 'travic' ),
			'subtitle' => esc_html__( 'Select Dark Logo Dimentions', 'travic' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		
		//Dark Logo Style
		array(
            'id' => 'normal_logo_show2',
            'type' => 'switch',
            'title' => esc_html__('Enable Color Logo', 'travic'),
            'default' => true,
        ),
		array(
			'id'       => 'main_color_logo2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Color Logo Image', 'travic' ),
			'subtitle' => esc_html__( 'Insert site Color logo image', 'travic' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		array(
			'id'       => 'main_color_logo_dimension2',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Color Logo Dimentions', 'travic' ),
			'subtitle' => esc_html__( 'Select Color Logo Dimentions', 'travic' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show', '=', true ),
		),
		
		//Mobile Logo Style
		array(
            'id' => 'normal_logo_show3',
            'type' => 'switch',
            'title' => esc_html__('Enable Mobile Logo', 'travic'),
            'default' => true,
        ),
		array(
			'id'       => 'mobile_logo',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Mobile Logo Image', 'travic' ),
			'subtitle' => esc_html__( 'Insert site Mobile logo image', 'travic' ),
			'required' => array( 'normal_logo_show3', '=', true ),
		),
		array(
			'id'       => 'mobile_logo_dimension',
			'type'     => 'dimensions',
			'title'    => esc_html__( 'Mobile Logo Dimentions', 'travic' ),
			'subtitle' => esc_html__( 'Select Mobile Logo Dimentions', 'travic' ),
			'units'    => array( 'em', 'px', '%' ),
			'default'  => array( 'Width' => '', 'Height' => '' ),
			'required' => array( 'normal_logo_show3', '=', true ),
		),
		//End Logo Settings
		array(
			'id'       => 'logo_settings_section_end',
			'type'     => 'section',
			'indent'      => false,
		),
	),
);
