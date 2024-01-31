<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

function plugin_jv_delete_plugin() {
	global $wpdb;


	$posts = get_posts(
		array(
			'numberposts' => -1,
			'post_type' => 'taxonomy',
			'post_status' => 'any',
		)
	);

	foreach ( $posts as $post ) {
		wp_delete_post( $post->ID, true );
	}

	$wpdb->query( sprintf(
		"DROP TABLE IF EXISTS %s",
		$wpdb->prefix . 'terms_template'
	) );
}

if ( ! defined( 'WPCF7_VERSION' ) ) {
	plugin_jv_delete_plugin();
}
