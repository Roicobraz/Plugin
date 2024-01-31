<?php 
class listtax extends tableau{
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
	
	public function setTerms() {
		$this->terms = array();
		$content = '';
		$categorie = array('categories', 'categorie', 'category', 'Categories', 'Categorie', 'Category');
		$tag = array('tags', 'tag', 'Tags', 'Tag');
		foreach( $this->getTax() as $wanted )
		{
			if(in_array($wanted, $categorie))
			{
				array_push($this->terms, get_categories());
			}
			elseif(in_array($wanted, $tag))
			{
				array_push($this->terms, get_tags());
			}
			else
			{
				if(!post_type_exists($taxname)){
					die;
				}			
				$this->cpt = true;
				$args = array( 'post_type' => $taxname);
				$query = new WP_Query( $args );
				array_push($this->terms, $query->posts);
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
	protected $term_template;
//méthode
	public function setTerm_id() {
		$tax = $this->getTerms();
		$this->term_id = array();
		
		foreach($tax as $cats )
		{
			foreach($cats as $cat )
			{	
				switch ($cat->taxonomy) 
				{
					case 'category':
						array_push($this->term_id, $cat->term_id);	
						break;
					case 'post_tag':
						array_push($this->term_id, $cat->term_id);
						break;
				}
			}
		}	
	}
	
	public function getTerm_id() {
		return($this->term_id);
	}
	
	public function setTerm_template($column) {
		$active = array('active', 'ACTIVE', 'Active');
		$id = array('id', 'ID', 'Id');
		$values = '';
		foreach( $column as $value )
		{
			if($value != $column[0])
			{
				$values .= ', ';
			}
			
			if(in_array($value, $id))
			{
				$values .= 'id';
			}
			elseif(in_array($value, $active))
			{
				$values .= 'active';
			}
			else
			{
				$values .= '';
			}
		}
		$ids = '';
		$terms_id = $this->getTerm_id();
		foreach($terms_id as $term_id)
		{
			if($term_id != $terms_id[0])
			{
				$ids .= ' AND ';
			}
			$ids= 'term_id='.$term_id;
		}
		global $wpdb;
		$this->term_template = $wpdb->get_results("SELECT {$values} FROM {$wpdb->prefix}terms_template where {$ids}");
	}	
	
	public function getTerm_template() {
		return($this->term_template);
	}
}