<?php 
$this->titre = "Gestion des templates des pages archives"; ?>

<table>
	<thead>
	</thead>
	<tbody>
	<?php foreach ($taxonomy as $j ):{ ?>
		<tr>
			<td><?php print_r($j); ?></td>
		</tr>
	<?php }endforeach; 
		print_r($term);
		print_r($template);
		?>
	</tbody>
	<tfoot>
	</tfoot>
</table>
