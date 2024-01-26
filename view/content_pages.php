<?php 
	function content_plugin_test(){
		$content = '<h1>Gestion des templates des pages archives</h1>';
		echo($content);
		
		$categories = new tableau;
		$categories->setBoard(array('categories', 'tags'));
		echo($categories->getBoard());	
	}

	function my_custom_fields() {  
		global $wpdb;
		$request = $wpdb->get_results("SELECT active, id FROM {$wpdb->prefix}terms_template where term_id={$_REQUEST['tag_ID']}");

		$default = '';
		
		if(($request[0]->id) == null)
		{
			$default = 'selected';
		}
		
		$content = "<option {$default} disabled>-- Sélectionner --</option>";
		
		$args = array( 'post_type' => 'taxonomy');
		$loop = new WP_Query( $args );
		
		while ( $loop->have_posts() )
		{
			$loop->the_post();
			$link = get_edit_post_link();
			$title = get_the_title();
			$id = get_the_id();
			$current = '';
			if(($request[0]->id) == $id)
			{
				$current = 'selected';
			}
			$content .= "<option {$current} value='{$link}'>{$title}</option>";
		}
		wp_reset_query();

	?>
		<tr class="form-field tax_form-field">
			<th scope="row">  
				Template 
			</th>
			<td>
				<div><input class="tax_trfal" name="active" type="checkbox">Ajouter un template</div>
				<input class="tax_id" name="id" type="text">
			</td>
		</tr>
		<tr>
			<th scope="row"></th>
			<td>
				<div class="tax_cstm">
					<select name="template" class="tax_drop">
						<?= $content ?>
					</select>
					<a class="button tax_btn" href="">Voir la page</a>
				</div>
			</td>
		</tr>
<!--
		<tr>
			<th scope="row">
				<input class="button" type="submit" value="mettre à jour le template">
			</th>
		</tr>
-->

	<style>
		.tax_cstm, .tax_id
		{
			display: none;
		}
	</style>

	<script>
		const checkbox = document.querySelectorAll('.tax_trfal');
		const tax_group = document.querySelectorAll('.tax_cstm');
		const dropdown = document.querySelectorAll('.tax_drop');
		const btn = document.querySelectorAll('.tax_btn');
		
		if(<?= $request[0]->active ?>){
			console.log(checkbox[0].checked=true);
			tax_group[0].style.display="inline-block";
		}

		checkbox.forEach((input) => {
			input.addEventListener("change", (e) => {
				const ischeck = checkbox[0].checked;
				if(!ischeck){
					tax_group[0].style.display="none";
				}else{
					tax_group[0].style.display="inline-block";
				}
			});
		});

		dropdown.forEach((input) => {
			input.addEventListener("change", (e) => {
				const drop_value = dropdown[0].value;
				btn[0].attributes[1].value = drop_value;
			});
		});
	</script>
	<?
	} 

//	add_action('category_add_form_fields', 'my_custom_fields', 10, 2 );
//	add_action('post_tag_add_form_fields', 'my_custom_fields', 10, 2 );
	add_action('category_edit_form_fields', 'my_custom_fields', 10, 2 );
	add_action('post_tag_edit_form_fields', 'my_custom_fields', 10, 2 );