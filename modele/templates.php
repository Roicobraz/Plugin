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
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms_template;");
		return($query);
	}
	
	/**
	* 	Template récupéré via id ou slug
	**/
	public function getTemplate($term_id) {
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms_template where term_id='{$term_id}';");
		return($query);
		
	}
}