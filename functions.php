<?php 

/*--------------------------------------------------*/
/*		Avoir le contenu d'une page via son id		*/
/*--------------------------------------------------*/
function cstm_get_content() 
{ 
	//	version : 23/01/2024
	$term = get_queried_object();

	if(get_field('add_template', $term))
	{
		$id = get_field('template', $term);
		$content = get_the_content('', '', $id);
		return $content;
	}
}

function create(){
	global $wpdb;
	$wpdb->query("
	CREATE TABLE IF NOT EXISTS {$wpdb->prefix}terms_template (
    id_template INT NOT NULL AUTO_INCREMENT, 
	active BOOL,
    id bigint(20) UNSIGNED REFERENCES {$wpdb->prefix}posts (ID), 
    term_id bigint(20) UNSIGNED REFERENCES {$wpdb->prefix}terms (term_id), 
    PRIMARY KEY(Id_template),
	FOREIGN KEY (id) REFERENCES {$wpdb->prefix}posts (ID), 
    FOREIGN KEY (term_id) REFERENCES {$wpdb->prefix}terms (term_id)
)
ENGINE=INNODB DEFAULT CHARSET=utf8mb4;"); 
}

function add(){
	global $wpdb;
	$wpdb->query("INSERT INTO {$wpdb->prefix}terms_template (active, id, term_id)
	VALUES ({$test}, {$test}, {$test})");	
}

function add_id()
{
	global $wpdb;
	$post_id = get_the_id();
	$wpdb->query($wpdb->prepare("
	IF EXISTS (SELECT * FROM {$wpdb->prefix}terms_template where term_id = {$post_id})
	BEGIN
   		UPDATE {$wpdb->prefix}terms_template SET id = {$_POST['template']}, active = {$_POST['active']} where term_id = {$post_id}
	END
	ELSE
	BEGIN
		INSERT INTO {$wpdb->prefix}terms_template (active, id, term_id) VALUES ({$_POST['active']}, {$_POST['template']}, {$post_id})
	END
	"));
}
add_action('save_post_category', 'add_id', 15 );

function del(){
	global $wpdb;
	$wpdb->query("DROP TABLE {$wpdb->prefix}terms_template;");
}

//create();
//add();
//del();

/////////////////////////
function wpm_custom_post_type() {

		// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
		$labels = array(
			// Le nom au pluriel
			'name'                => _x( 'Taxonomie avancée', 'Post Type General Name'),
			// Le nom au singulier
			'singular_name'       => _x( 'Taxonomie avancée', 'Post Type Singular Name'),
			// Le libellé affiché dans le menu
			'menu_name'           => __( 'Taxonomie avancée'),
			// Les différents libellés de l'administration
			'all_items'           => __( 'Toutes les taxonomie'),
			'view_item'           => __( 'Voir les taxonomie'),
			'add_new_item'        => __( 'Ajouter une nouvelle taxonomie'),
			'add_new'             => __( 'Ajouter'),
			'edit_item'           => __( 'Editer la taxonomie'),
			'update_item'         => __( 'Modifier la taxonomie'),
			'search_items'        => __( 'Rechercher une taxonomie'),
			'not_found'           => __( 'Non trouvée'),
			'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
		);

		// On peut définir ici d'autres options pour notre custom post type

		$args = array(
			'label'               => __( 'Taxonomie'),
			'description'         => __( 'Tous sur taxonomie'),
			'labels'              => $labels,
			// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes'),
			/* 
			* Différentes options supplémentaires
			*/
			'show_in_rest' 		  => true,
			'hierarchical'        => true,
			'public'              => true,
//			'publicly_queryable'  => false,
			'menu_position' 	  => 83,
			'menu_icon'			  => 'dashicons-drumstick',
			'has_archive'         => false,
			'rewrite'			  => array( 'slug' => 'taxonomy'),
			'publicly_queryable'  => false,

		);

		// On enregistre notre custom post type qu'on nomme ici "realisation" et ses arguments
		register_post_type( 'taxonomy', $args );

	}

	add_action( 'init', 'wpm_custom_post_type', 0 );

//	add_action( 'init', 'wpm_add_taxonomies', 0 );

	/*function wpm_add_taxonomies() 
	{

		// Catégorie de réalisation

		$labels_cat_real = array(
			'name'                       => _x( 'Catégories', 'taxonomy general name'),
			'singular_name'              => _x( 'Catégories', 'taxonomy singular name'),
			'search_items'               => __( 'Rechercher une catégorie'),
			'popular_items'              => __( 'Catégories populaires'),
			'all_items'                  => __( 'Toutes les catégories'),
			'edit_item'                  => __( 'Editer une catégorie'),
			'update_item'                => __( 'Mettre à jour une catégorie'),
			'add_new_item'               => __( 'Ajouter une nouvelle catégorie'),
			'new_item_name'              => __( 'Nom de la nouvelle catégorie'),
			'add_or_remove_items'        => __( 'Ajouter ou supprimer une catégorie'),
			'choose_from_most_used'      => __( 'Choisir parmi les catégories les plus utilisées'),
			'not_found'                  => __( 'Pas de catégories trouvées'),
			'menu_name'                  => __( 'Catégories'),
		);

		$args_cat_real = array(
		// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
			'hierarchical'          => true,
			'labels'                => $labels_cat_real,
			'show_ui'               => true,
			'show_in_rest'			=> true,
			'show_admin_column'     => true,
			'query_var'             => true,
		// 'rewrite'               => array( 'slug' => 'categories-realisations' ),
		);

		register_taxonomy( 'categoriesrealisations', 'taxonomy', $args_cat_real );
	}*/

	function my_custom_fields() {  
		global $wpdb;
		$request = $wpdb->get_results("SELECT active, id FROM {$wpdb->prefix}terms_template where term_id={$_REQUEST['tag_ID']}");

		$default = '';
		
		if(!empty($request))
		{
			if(($request[0]->id) == null)
			{
				$default = 'selected';
			}
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
			if(!empty($request))
			{
				if(($request[0]->id) == $id)
				{
					$current = 'selected';
				}
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
		<tr
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