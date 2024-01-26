<?php 
class listtax {
//propriété
	private $tax;
	private $terms;
	private $cpt;
//méthode
	public function setTax($taxname){
		$this->tax = $taxname;
	}
	
	public function getTax(){
		return($this->tax);
	}
	
	public function setTerms($taxname) {
		$this->setTax($taxname);
		$this->terms = array(
			'cat'=>array(), 
			'tag'=>array(), 
			'tax'=>array()
		);
		$content = '';
		$categorie = array('categories', 'categorie', 'category', 'Categories', 'Categorie', 'Category');
		$tag = array('tags', 'tag', 'Tags', 'Tag');
		
		foreach( $this->tax as $wanted )
		{
			if(in_array($wanted, $categorie))
			{
				array_push($this->terms['cat'], get_categories());
			}
			elseif(in_array($wanted, $tag))
			{
				array_push($this->terms['tag'], get_tags());
			}
			else
			{
				if(!post_type_exists($taxname)){
					die;
				}			
				$this->cpt = true;
				$args = array( 'post_type' => $taxname);
				$query = new WP_Query( $args );
				array_push($this->terms['tax'], $query->posts);
			}
		}
	}
	
	public function getTerms() {
		return($this->terms);
	}
}

class listterm extends listtax {
//propriété
	protected $term_id;
	protected $term_name;
	protected $term_template;
	protected $term_on;
//méthode
	public function setTerm($taxname) {
		$this->setTerms($taxname);
		$tax = $this->getTerms();
		$this->term_name = array();
		$this->term_id = array();
		$this->term_template = array();
		$this->term_on = array();
		
		$content = '';
		global $wpdb;
		$request = $wpdb->get_results("SELECT id, active FROM {$wpdb->prefix}terms_template /*where term_id=*/");
		
		foreach($tax['cat'] as $cats )
		{
			foreach($cats as $cat )
			{	
				array_push($this->term_name, $cat->name);
				array_push($this->term_id, $cat->term_id);	
			}
		}
		
		foreach($tax['tag'] as $tags )
		{
			foreach($tags as $tag )
			{	
				array_push($this->term_name, $tag->name);
				array_push($this->term_id, $tag->term_id);	
			}
		}
		
		foreach($request as $term )
		{
			array_push($this->term_template, $term->id);
			array_push($this->term_on, $term->active);
		}		
		
		foreach($this->term_name as $test)
		{
			$content .= ''.$test;
		}
	}
	
	public function getTerm_id() {
		return($this->term_id);
	}
	
	public function getTerm_name() {
		return($this->term_name);
	}
	public function getTerm_template() {
		return($this->term_template);
	}
	
	public function getTerm_on() {
		return($this->term_on);
	}
}