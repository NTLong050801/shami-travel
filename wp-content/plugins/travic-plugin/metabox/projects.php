<?php
return array(
	'title'      => 'Travic Project Setting',
	'id'         => 'travic_meta_projects',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'project' ),
	'sections'   => array(
		array(
			'id'     => 'travic_projects_meta_setting',
			'fields' => array(
				array(
					'id'    => 'project_external_url',
					'type'  => 'text',
					'title' => esc_html__( 'External Link', 'travic' ),
				),
				array(
					'id'    => 'project_dimension',
					'type'  => 'select',
					'title' => esc_html__( 'Choose the Extra height', 'travic' ),
					'options'  => array(
						'normal_height' => esc_html__( 'Normal Height', 'travic' ),
						'extra_width' 	=> esc_html__( 'Extra Width', 'travic' ),
						'extra_height'  => esc_html__( 'Extra Height', 'travic' ),
					),
					'default'  => 'normal_height',
				),
				array(
					'id'        => 'features_tabs',
					'type'      => 'repeater',
					'icon' => 'el-icon-thumbs-up',
					'title'     => __('Add Features', 'travic'),
					'group_values' => true,
					'sortable' => true,
					'fields'    => array(
						array(
							'id'      => 'feature_title',
							'type'    => 'text',
							'title'   => __('Feature Title', 'travic'),
						),
						array(
							'id'      => 'feature_text',
							'type'    => 'textarea',
							'title'   => __('Feature Text', 'travic'),
						),
					)
				),
				array(
					'id'    => 'project_image',
					'type'  => 'media',
					'title' => esc_html__( 'Project Image 01', 'travic' ),
				),
				array(
					'id'    => 'project_image2',
					'type'  => 'media',
					'title' => esc_html__( 'Project Image 02', 'travic' ),
				),
				
			),
		),
	),
);