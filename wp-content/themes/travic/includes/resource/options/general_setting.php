<?php
$styles = [];
foreach(range(1, 28) as $val) {
    $styles[$val] = sprintf(esc_html__('Style %s', 'travic'), $val);
}

return  array(
    'title'      => esc_html__( 'General Setting', 'travic' ),
    'id'         => 'general_setting',
    'desc'       => '',
    'icon'       => 'el el-wrench',
    'fields'     => array(
        array(
            'id' => 'theme_preloader',
            'type' => 'switch',
            'title' => esc_html__('Enable Preloader', 'travic'),
            'default' => false,
        ),
		array(
			'id'      => 'preloader_text',
			'type'    => 'textarea',
			'title'   => __( 'Preloader Text', 'travic' ),
			'required' => array( 'theme_preloader', '=', true ),
		),
		array(
            'id' => 'show_scroltop',
            'type' => 'switch',
            'title' => esc_html__('ON/OFF Scroll To Top', 'travic'),
            'default' => false,
        ),
		array(
			'id'      => 'scroltop_text',
			'type'    => 'textarea',
			'title'   => __( 'Scroll To Top Text', 'travic' ),
			'required' => array( 'show_scroltop', '=', true ),
		),
    ),
);
