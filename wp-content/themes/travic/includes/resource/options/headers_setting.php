<?php
return array(
	'title'      => esc_html__( 'Header Setting', 'travic' ),
	'id'         => 'headers_setting',
	'desc'       => '',
	'subsection' => false,
	'fields'     => array(
		array(
			'id'      => 'header_source_type',
			'type'    => 'button_set',
			'title'   => esc_html__( 'Header Source Type', 'travic' ),
			'options' => array(
				'd' => esc_html__( 'Default', 'travic' ),
				'e' => esc_html__( 'Elementor', 'travic' ),
			),
			'default' => 'd',
		),
		array(
			'id'       => 'header_elementor_template',
			'type'     => 'select',
			'title'    => __( 'Template', 'travic' ),
			'data'     => 'posts',
			'args'     => [
				'post_type' => [ 'elementor_library' ],
				'posts_per_page'	=> -1
			],
			'required' => [ 'header_source_type', '=', 'e' ],
		),
		array(
			'id'       => 'header_style_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Settings', 'travic' ),
			'required' => array( 'header_source_type', '=', 'd' ),
		),

		//Header Settings
		array(
		    'id'       => 'header_style_settings',
		    'type'     => 'image_select',
		    'title'    => esc_html__( 'Choose Header Styles', 'travic' ),
		    'subtitle' => esc_html__( 'Choose Header Styles', 'travic' ),
		    'options'  => array(

			    'header_v1'  => array(
				    'alt' => esc_html__( 'Header Style 1', 'travic' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header_v1.png',
			    ),
			    'header_v2'  => array(
				    'alt' => esc_html__( 'Header Style 2', 'travic' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header_v2.png',
			    ),
				'header_v3'  => array(
				    'alt' => esc_html__( 'Header Style 3', 'travic' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header_v3.png',
			    ),
				'header_v4'  => array(
				    'alt' => esc_html__( 'Header Style 4', 'travic' ),
				    'img' => get_template_directory_uri() . '/assets/images/redux/header/header_v4.png',
			    ),
			),
			'required' => array( 'header_source_type', '=', 'd' ),
			'default' => 'header_v4',
	    ),

		/***********************************************************************
								Header Version 1 Start
		************************************************************************/
		array(
			'id'       => 'header_v1_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style One Settings', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		//Header Topbar
		array(
            'id' => 'show_header_topbar',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Header Top', 'travic'),
            'default' => false,
            'required' => array( 'header_style_settings', '=', 'header_v1' ),
        ),	
		array(
			'id'      => 'opening_hours_v1',
			'type'    => 'text',
			'title'   => __( 'Opening Hours', 'travic' ),
			'required' => array( 'show_header_topbar', '=', true ),
		),
		array(
            'id' => 'show_social_icon_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'default' => false,
            'required' => array( 'show_header_topbar', '=', true ),
        ),
		array(
			'id'      => 'phone_no_v1',
			'type'    => 'text',
			'title'   => __( 'Phone Number', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		array(
			'id'      => 'email_v1',
			'type'    => 'text',
			'title'   => __( 'Email Address', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		array(
            'id' => 'show_social_icon_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'default' => false,
            'required' => array( 'show_header_topbar', '=', true ),
        ),
		array(
			'id'      => 'btn_title_v1',
			'type'    => 'text',
			'title'   => __( 'Button Title', 'travic' ),
			 'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		array(
			'id'      => 'btn_link_v1',
			'type'    => 'text',
			'title'   => __( 'Button Link', 'travic' ),
			 'required' => array( 'header_style_settings', '=', 'header_v1' ),
		),
		//Search Icon
		array(
            'id' => 'show_seach_form_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Search Icon', 'travic'),
            'default' => false,
            'required' => array( 'header_style_settings', '=', 'header_v1' ),
        ),
		
		/***********************************************************************
								Header Version 2 Start
		************************************************************************/
		array(
			'id'       => 'header_v2_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Two Settings', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		),
		array(
			'id'      => 'btn_title_v2',
			'type'    => 'text',
			'title'   => __( 'Button Title', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		),
		array(
			'id'      => 'btn_link_v2',
			'type'    => 'text',
			'title'   => __( 'Button Link', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v2' ),
		),
		//Search Icon
		array(
            'id' => 'show_seach_form_v2',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Search Icon', 'travic'),
            'default' => false,
            'required' => array( 'header_style_settings', '=', 'header_v2' ),
        ),
		
		/***********************************************************************
								Header Version 3 Start
		************************************************************************/
		array(
			'id'       => 'header_v3_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'One Pager Header Settings', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		//Header Topbar
		array(
            'id' => 'show_header_topbar_v3',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Header Top', 'travic'),
            'default' => false,
            'required' => array( 'header_style_settings', '=', 'header_v3' ),
        ),	
		array(
            'id' => 'social_icons_show3',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'default' => false,
            'required' => array( 'show_header_topbar_v3', '=', true ),
        ),
		array(
			'id'      => 'opening_hours_v3',
			'type'    => 'text',
			'title'   => __( 'Opening Hours', 'travic' ),
			'required' => array( 'show_header_topbar_v3', '=', true ),
		),
		array(
			'id'      => 'phone_no_v3',
			'type'    => 'text',
			'title'   => __( 'Phone Number', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		array(
			'id'      => 'email_v3',
			'type'    => 'text',
			'title'   => __( 'Email Address', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		array(
            'id' => 'show_social_icon_v3',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'default' => false,
            'required' => array( 'show_header_topbar', '=', true ),
        ),
		array(
			'id'      => 'btn_title_v3',
			'type'    => 'text',
			'title'   => __( 'Button Title', 'travic' ),
			 'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		array(
			'id'      => 'btn_link_v3',
			'type'    => 'text',
			'title'   => __( 'Button Link', 'travic' ),
			 'required' => array( 'header_style_settings', '=', 'header_v3' ),
		),
		//Search Icon
		array(
            'id' => 'show_seach_form_v3',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Search Icon', 'travic'),
            'default' => false,
            'required' => array( 'header_style_settings', '=', 'header_v3' ),
        ),
		
		/***********************************************************************
								Header Version 4 Start
		************************************************************************/
		array(
			'id'       => 'header_v4_settings_section_start',
			'type'     => 'section',
			'indent'      => true,
			'title'    => esc_html__( 'Header Style Four Settings', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		),
		array(
			'id'      => 'btn_title_v4',
			'type'    => 'text',
			'title'   => __( 'Button Title', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		),
		array(
			'id'      => 'btn_link_v4',
			'type'    => 'text',
			'title'   => __( 'Button Link', 'travic' ),
			'required' => array( 'header_style_settings', '=', 'header_v4' ),
		),
		//Search Icon
		array(
            'id' => 'show_seach_form_v4',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Search Icon', 'travic'),
            'default' => false,
            'required' => array( 'header_style_settings', '=', 'header_v4' ),
        ),
		
		array(
			'id'       => 'header_style_section_end',
			'type'     => 'section',
			'indent'      => false,
			'required' => [ 'header_source_type', '=', 'd' ],
		),
	),
);
