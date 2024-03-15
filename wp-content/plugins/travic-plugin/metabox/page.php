<?php
return array(
	'title'      => 'Travic Setting',
	'id'         => 'travic_meta',
	'icon'       => 'el el-cogs',
	'position'   => 'normal',
	'priority'   => 'core',
	'post_types' => array( 'page', 'post', 'service', 'project', 'tf_tours'),
	'sections'   => array(
		require_once TRAVICPLUGIN_PLUGIN_PATH . '/metabox/header.php',
		require_once TRAVICPLUGIN_PLUGIN_PATH . '/metabox/banner.php',
		require_once TRAVICPLUGIN_PLUGIN_PATH . '/metabox/sidebar.php',
		require_once TRAVICPLUGIN_PLUGIN_PATH . '/metabox/footer.php',
	),
);