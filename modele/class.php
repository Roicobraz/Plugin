<?php 
class tax{
//propriété
	private $taxname;
	private $terms_id;
	private $cpt;
//méthode
	public function setTaxname($string){
		$this->taxname = $string;
	}
	
	public function getTaxname(){
		return($this->taxname);
	}
	
	public function setTerms_id($tax) {
		$categorie = array('categories', 'categorie', 'category', 'Categories', 'Categorie', 'Category');
		$tag = array('tags', 'tag', 'Tags', 'Tag', 'post_tag');
		
		$taxonomy = array();
		if(in_array($tax, $categorie))
		{
			array_push($taxonomy, 'category');
		}
		elseif(in_array($tax, $tag))
		{
			array_push($taxonomy, 'post_tag');
		}
		else
		{
			array_push($taxonomy, $tax);
		}

		$Terms_id = array();
		global $wpdb;
		foreach($taxonomy as $taxname)
		{	
			$tax_terms = $wpdb->get_results("SELECT term_id FROM {$wpdb->prefix}term_taxonomy where taxonomy='{$taxname}';");
			foreach ($tax_terms as $tax_term)
			{
				array_push($Terms_id, $tax_term->term_id);
			}
		}
		$this->terms_id = $Terms_id;
	}
	
	public function getTerms_id() {
		return($this->terms_id);
	}
}

class term extends tax {
//propriété
	protected $term_name;
	protected $term_id_template;
	protected $template_active;
//méthode
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

