<?php 

/**
* 	class récupérant toutes les taxonomies
**/
class taxonomyv1{
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
			$tax_terms = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}term_taxonomy where taxonomy='{$taxname}';");
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

