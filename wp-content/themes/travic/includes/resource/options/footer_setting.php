<?php

return array(
	'title'      => esc_html__( 'Footer Setting', 'travic' ),
	'id'         => 'footer_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'footer_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Footer Source Type', 'travic' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'travic' ),
				'e' => esc_html__( 'Elementor', 'travic' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'footer_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'travic' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'footer_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'footer_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Settings', 'travic' ),
			'required' => array( 'footer_source_type', '=', 'd' ),
		),
		array(
		    'id'       => 'footer_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Footer Styles', 'travic' ),
		    'subtitle' => esc_html__( 'Choose Footer Styles', 'travic' ),
		    'options'  => array(

			    'footer_v1'  => array(
				    'alt' => esc_html__( 'Footer Style 1', 'travic' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer_v1.png',
			    ),
				'footer_v2'  => array(
				    'alt' => esc_html__( 'Footer Style 2', 'travic' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/footer/footer_v2.png',
			    ),
			),
			'required' => array( 'footer_source_type', '=', 'd' ),
	    ),
		
		
		/***********************************************************************
								Footer Version 1 Start
		************************************************************************/
		array(
			'id'       => 'footer_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style One Settings', 'travic' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
			'id'       => 'shape_image',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Shape Image', 'travic' ),
			'subtitle' => esc_html__( 'Insert Footer Background Shape Image', 'travic' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
		),
		array(
            'id' => 'show_bottom_footer_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Bottom Footer', 'travic'),
            'default' => false,
            'required' => array( 'footer_style_settings', '=', 'footer_v1' ),
        ),
		array(
			'id'      => 'footer_copyright_text_v1',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'travic' ),
			'required' => array( 'show_bottom_footer_v1', '=', true ),
		),
		array(
            'id' => 'show_footer_social_icon_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'default' => false,
            'required' => array( 'show_bottom_footer_v1', '=', true ),
        ),
		
		/***********************************************************************
								Footer Version 2 Start
		************************************************************************/
		array(
			'id'       => 'footer_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Footer Style Two Settings', 'travic' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
			'id'       => 'shape_image2',
			'type'     => 'media',
			'url'      => true,
			'title'    => esc_html__( 'Footer Background Shape Image', 'travic' ),
			'subtitle' => esc_html__( 'Insert Footer Background Shape Image', 'travic' ),
			'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
		),
		array(
            'id' => 'show_bottom_footer_v2',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Bottom Footer', 'travic'),
            'default' => false,
            'required' => array( 'footer_style_settings', '=', 'footer_v2' ),
        ),
		array(
			'id'      => 'footer_copyright_text_v2',
			'type'    => 'textarea',
			'title'   => __( 'Copyright Text', 'travic' ),
			'required' => array( 'show_bottom_footer_v2', '=', true ),
		),
		array(
            'id' => 'show_footer_social_icon_v2',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'default' => false,
            'required' => array( 'show_bottom_footer_v2', '=', true ),
        ),
		
		array(
			'id'       => 'footer_default_ed',
			'type'     => 'section',
			'indent'   => false,
			'required' => [ 'footer_source_type', '=', 'd' ],
		),
	),
);
