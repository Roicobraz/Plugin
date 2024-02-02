<?php

require_once(__ROOT__.'/modele/taxonomy.php');
require_once(__ROOT__.'/modele/term.php');
require_once(__ROOT__.'/modele/templates.php');

class controleurAccueil {
//propriété
	private $taxonomy;
	private $term;
	private $template;
//méthode

    public function __construct() {
        $this->taxonomy = new taxonomy();
        $this->term = new term();
        $this->template = new template();
    }	
	
	private function termsoftax($taxname){
		$tax = $this->taxonomy->getTax($taxname);
		$terms = array();
		foreach ($tax as $term)
		{
			array_push($terms, $this->term->getTerm($term->term_id));
		}
		return($terms);
	}
	
	private function termsoftemplate($taxname){
		$tax = $this->termsoftax($taxname);
		$terms = array();
		foreach ($tax as $term)
		{
			if(!empty($this->template->getTemplate($term[0]->term_id)))
			{
				array_push($terms, $this->template->getTemplate($term[0]->term_id));
			}
			else
			{
				array_push($terms, array(array('id' => '-', 'active' => 0)));
			}
		}
		return($terms);
	}	
	
	public function accueil() {
        $taxonomy = $this->taxonomy->getTaxs(); 
        $term = $this->term->getTerms();
        $template = $this->template->getTemplates();	
		
		$category = $this->taxonomy->getTax('category');
       	$post_tag = $this->taxonomy->getTax('post_tag');
		
		$categoryterm = $this->termsoftax('category');
		$post_tagterm = $this->termsoftax('post_tag');
		
		$test = $this->termsoftemplate('category');

        $vue = new Vue("accueil");
        $vue->generer(array(
			'taxonomies' 	=> $taxonomy,
			'terms' 		=> $term,
			'templates' 	=> $template,
	
			'category'		=> $category,	
			'post_tag' 		=> $post_tag,
			
			'categoryterm' 	=> $categoryterm,
			'post_tagterm' 	=> $post_tagterm,
			
			'test' 			=> $test,

		));
    }
	
}