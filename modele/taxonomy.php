<?php
require_once(__ROOT__.'/modele/model.php');

/**
* 	class récupérant toutes les taxonomies
**/
class taxonomy{
//propriété

//méthode
	public function getTaxs(){
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}term_taxonomy;");
		return($query);
	}
	
	/**
	* 	Taxonomy récupéré via nom de taxonomy
	**/
	public function getTax($taxname){
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}term_taxonomy where taxonomy='{$taxname}';");
		return($query);
	}
}