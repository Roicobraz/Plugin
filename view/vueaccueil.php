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
				<a href="<?= get_category_link($term[0]->term_id)?>"><?php print_r($term[0]->name); ?></a>
			</td>
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->term_id); ?>
			</td>
				<?php foreach ($templates_cat as $template):{ 
				if(!empty($template[0]->id))
				{
					if($term[0]->term_id == $template[0]->term_id)
					{ ?>
				<td class='title column-title has-row-actions column-primary page-title'>
					<?php print_r($template[0]->id); ?>
				</td>
				<td class='title column-title has-row-actions column-primary page-title'>
					<?php print_r($template[0]->active); ?>
				</td>
				<?php }
					else{?>
				<td class='title column-title has-row-actions column-primary page-title'>
					-
				</td>
				<td class='title column-title has-row-actions column-primary page-title'>
					0
				</td><?php
					}
				}
			}endforeach; ?>
		</tr>
	<?php }endforeach; 
		foreach ($post_tagterm as $term ):{ ?>
		<tr class="iedit author-self level-0 post-125 type-post status-publish format-standard hentry category-test tag-untag">
			<td class='title column-title has-row-actions column-primary page-title'>
				<a href="<?= get_tag_link($term[0]->term_id)?>"><?php print_r($term[0]->name); ?></a>
			</td>
			<td class='title column-title has-row-actions column-primary page-title'>
				<?php print_r($term[0]->term_id); ?>
			</td>
			<?php foreach ($templates_tag as $template):{ 
				if(!empty($template[0]->id))
				{
					if($term[0]->term_id == $template[0]->term_id)
					{ ?>
				<td class='title column-title has-row-actions column-primary page-title'>
					<?php print_r($template[0]->id); ?>
				</td>
				<td class='title column-title has-row-actions column-primary page-title'>
					<?php print_r($template[0]->active); ?>
				</td>
				<?php }
					else{?>
				<td class='title column-title has-row-actions column-primary page-title'>
					-
				</td>
				<td class='title column-title has-row-actions column-primary page-title'>
					0
				</td><?php
					}
				}
			}endforeach; ?>
		</tr>
	<?php }endforeach; 
		?>
	</tbody>

	<tfoot>
		<tr>
			<td class="manage-column column-author">Nom</td>
			<td class="manage-column column-author">Id</td>
			<td class="manage-column column-author">Template</td>
			<td class="manage-column column-author">Actif</td>
		</tr>
	</tfoot>
</table>
