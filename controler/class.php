<?php 
class tableau {
//propriété
	private $board;
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
		
	public function setBoard($taxname){	
		
		$title = $this->getTitle();
		
		$code_html = '';
		for ($i = 0; $i < count($this->term_name); $i++){
			$name = $this->term_name[$i];
			$id = $this->term_id[$i];
			
			if(empty($this->term_on[$i]))
			{
				$template = "-";
			}
			else
			{
				$template = get_the_title($this->term_template[$i]);
			}
						
			$code_html .= '
			<tr>
				<td>
					'.$name.'
				</td>
				<td>
					'.$id.'
				</td>
				<td>
					'.$template.'
				</td>				
				<td>
					'.$this->active.'
				</td>
			</tr>';
		}
		
		$content = '
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
		
		$this->board = $content;
	}
	
	public function getBoard(){	
		return($this->board);
	}
}