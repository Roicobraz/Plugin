<?php 
$this->titre = "Gestion des templates des pages archives"; ?>

<table class="wp-list-table widefat fixed striped table-view-list">
	<thead>
		<tr>
			<td class="manage-column column-author">Nom</td>
			<td class="manage-column column-author">Id</td>
			<td class="manage-column column-author">Template</td>
			<td class="manage-column column-author">Actif</td>
		</tr>
	</thead>
	
	<tbody>
	<?php foreach ($categoryterm as $term ):{ ?>
		<tr class="iedit author-self level-0 post-125 type-post status-publish format-standard hentry category-test tag-untag">
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->name); ?>
			</td>
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->term_id); ?>
			</td>
				<?php foreach ($test as $test1):{ 
			print_r($test1[0]);
			echo('<br>')
//			if(($test1->term_id) == ($term[0]->term_id))
//			{
				?>
				<td class='title column-title has-row-actions column-primary page-title'>
				<?php //print_r($test1[0]->id_template); ?>
				</td>
				<td class='title column-title has-row-actions column-primary page-title'>
					<?php //print_r($test1[0]->active); ?>
				</td><?php
//			}
			?>

			
			<?php }endforeach; ?>
		</tr>
	<?php }endforeach; 
		foreach ($post_tagterm as $term ):{ ?>
		<tr class="iedit author-self level-0 post-125 type-post status-publish format-standard hentry category-test tag-untag">
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->name); ?>
			</td>
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->term_id); ?>
			</td>
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->term_id); ?>
			</td>
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->term_id); ?>
			</td>
		</tr>
	<?php }endforeach; 
		?>
	</tbody>
	<?php
//	print_r($term);
//			echo('<br>');
//			echo('<br>');
//
//	foreach($test as $test1)
//	{
//		print_r($test1);
//		echo('<br>');
//		echo('<br>');
//	}
		?>
	<tfoot>
		<tr>
			<td class="manage-column column-author">Nom</td>
			<td class="manage-column column-author">Id</td>
			<td class="manage-column column-author">Template</td>
			<td class="manage-column column-author">Actif</td>
		</tr>
	</tfoot>
</table>
