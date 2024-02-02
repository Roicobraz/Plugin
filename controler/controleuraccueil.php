<?php

require_once(__ROOT__.'/modele/taxonomy.php');
require_once(__ROOT__.'/modele/term.php');
require_once(__ROOT__.'/modele/templates.php');

class tableau {
//propriété
	private $board;
	private $row;
	private $title;
	private $active;
	
//méthode	
	public function setTitle($titles){
		$code_html = '<tr>';
		foreach ($titles as $title)
		{
			$code_html .= '
			<th class="manage-column">
				'.$title.'
			</th>';
		}
		$code_html .= '</tr>';
		$this->title = $code_html;
	}
	public function getTitle(){
		return($this->title);
	}
	
	public function setActive($check, $cross){
		$this->active = array($check, $cross);
	}
	
	public function getActive(){
		return($this->active);
	}
	
	public function setRow($elements){	
		$row = '<tr>';
		foreach ($elements as $element)
		{
			$row .= '
				<td class="manage-column">
					'.$element.'
				</td>';
		}
		$row .= '</tr>';

		$this->row = $row;
	}
	
	public function getRow(){	
		return($this->row);
	}

	public function setBoard($title, $content){	
		$code_html = '';
		foreach ($content as $test)
		{
//			print_r($test);
			$code_html .= '
				<tr>
					<td class="manage-column">';
			$code_html .= str_replace('', '', $test);
			$code_html .= '
					</td>
				</tr>';
		}
		$code_html = '
		<table class="wp-list-table widefat fixed striped table-view-list pages">
			<thead>
				'.$title.'
			</thead>
			<tbody>
				'.$code_html.'
			</tbody>
			<tfoot>
				'.$title.'
			</tfoot>
		</table>
		';
		
		$this->board = $code_html;
	}
	
	public function getBoard(){	
		return($this->board);
	}
}

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
	
	public function accueil() {
        $taxonomy = $this->taxonomy->getTaxs();
        $term = $this->term->getTerms();
        $template = $this->template->getTemplates();
        $vue = new Vue("accueil");
        $vue->generer(array(
			'taxonomy' => $taxonomy,
			'term' => $term,
			'template' => $template,
		));
    }
}