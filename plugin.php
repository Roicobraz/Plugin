<?php
/**
* Plugin Name: Plugin JV
* Plugin URI: https://www.your-site.com/
* Description: Plugin de test
* Version: 0.1
* Author: Justin VAVASSORI
* Author URI: https://www.your-site.com/
**/

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

function content_plugin_test(){
	define('__ROOT__', dirname(__FILE__));

	require 'controler/routeur.php';

	$routeur = new Routeur();
	$routeur->routerRequete();
}