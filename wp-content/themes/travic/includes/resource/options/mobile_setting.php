<?php

return array(

    'title'         => esc_html__( 'Mobile Sidebar Settings', 'travic' ),
    'id'            => 'mobile_setting',
    'desc'          => '',
    'icon'          => 'el el-font',
    'fields'        => array(
        array(
            'id' => 'show_mobile_info_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Contact Info', 'travic'),
            'default' => false,
        ),
		array(
            'id' => 'show_mobile_searchform_v1',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Search Form', 'travic'),
            'required' => array( 'show_mobile_info_v1', '=', true ),
        ),
		array(
			'id'      => 'mobile_info_title_v1',
			'type'    => 'text',
			'title'   => __( 'Info Title', 'travic' ),
			'required' => array( 'show_mobile_info_v1', '=', true ),
		),
		array(
			'id'      => 'mobile_address_v1',
			'type'    => 'textarea',
			'title'   => __( 'Address', 'travic' ),
			'required' => array( 'show_mobile_info_v1', '=', true ),
		),
		array(
			'id'      => 'mobile_email_address_v1',
			'type'    => 'text',
			'title'   => __( 'Email Address', 'travic' ),
			'required' => array( 'show_mobile_info_v1', '=', true ),
		),
		array(
			'id'      => 'mobile_phone_no_v1',
			'type'    => 'text',
			'title'   => __( 'Phone Number', 'travic' ),
			'required' => array( 'show_mobile_info_v1', '=', true ),
		),
		array(
            'id' => 'show_mob_social_icon',
            'type' => 'switch',
            'title' => esc_html__('Enable/Disable Social Icons', 'travic'),
            'required' => array( 'show_mobile_info_v1', '=', true ),
        ),
    ),
);

