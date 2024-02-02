<?php
require_once(__ROOT__.'/modele/model.php');

/**
* 	class récupérant les templates
**/
class template {
//propriété
	
//méthode
	public function getTemplates() {
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts where post_type='taxonomy';");
		return($query);
	}
	
	/**
	* 	Template récupéré via id ou slug
	**/
	public function getTemplate($term_id) {
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}posts where post_type='taxonomy' AND (ID='{$term_id}' OR post_title='{$term_id}');");
		return($query);
		
	}
}