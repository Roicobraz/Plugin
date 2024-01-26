<?php 
class tableau extends listterm {
//propriété
	private $board;
//méthode
	public function setBoard($taxname){	
		$this->setTerm($taxname);
		$code_html = '';		
		
		$title = '<tr>
					<th class="manage-column">
						Nom
					</th>
					<th class="manage-column">
						Id
					</th>
					<th class="manage-column">
						Template
					</th>
					<th class="manage-column">
						Actif
					</th>
				</tr>';
		
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
						
			if($this->term_on[$i]==1)
			{
				$active = "&#9989;";
			}
			else
			{
				$active = "&#10060;";
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
					'.$active.'
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