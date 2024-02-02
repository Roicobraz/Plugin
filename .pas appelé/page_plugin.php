<?php 

add_action( 'admin_menu', 'rudr_top_lvl_menu' );
 
function rudr_top_lvl_menu(){
	add_menu_page(
		'Test Plugin Settings', // page <title>Title</title>
		'Test Plugin', // link text
		'manage_options', // user capabilities
		'test_plugin', // page slug
		'content_plugin_test', // this function prints the page content
		'dashicons-drumstick', // icon (from Dashicons for example)
		82 // menu position
	);
}

/////////////////////////