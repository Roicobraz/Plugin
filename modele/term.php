<?php
require_once(__ROOT__.'/modele/model.php');

/**
* 	class récupérant les terms
**/
class term extends taxonomyv1 {
//propriété
	protected $term_name;
	protected $term_id_template;
	protected $template_active;
//méthode
	public function getTerms() {
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms;");
		return($query);
	}
	
	/**
	* 	Term récupéré via id ou slug
	**/
	public function getTerm($term_id) {
		global $wpdb;
		$query = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}terms where term_id='{$term_id}' OR slug='{$term_id}';");
		return($query);
	}
	
	
	public function setTerm_name($term_id) {
		global $wpdb;
		$termsname = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}terms where term_id='{$term_id}';");
		$this->term_name = $termsname[0]->name;
	}

	public function getTerm_name() {
		return($this->term_name);
	}
	
	public function setTerm_id_template($term_id) {
		global $wpdb;
		$template = $wpdb->get_results("SELECT id FROM {$wpdb->prefix}terms_template where term_id={$term_id};");
		if(!empty($template))
		{
			$this->term_id_template = $template[0]->id;
		}
	}
	
	public function getTerm_template() {
		return($this->term_id_template);
	}
	
	public function setTemplate_active($term_id) {
		global $wpdb;
		$template = $wpdb->get_results("SELECT active FROM {$wpdb->prefix}terms_template where term_id={$term_id};");
		if(!empty($template))
		{
			$this->term_id_template = $template[0]->active;
		}
	}
	
	public function getTemplate_active() {
		return($this->template_active);
	}
}