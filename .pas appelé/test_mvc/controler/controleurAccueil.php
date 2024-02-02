<?php
	require_once 'model/tax.php';
	require_once 'view/vue.php';

	class controleurAccueil{
		private $tax;

		public function __construct() {
			$this->tax = new Tax();
		}

	// Affiche la liste de tous les billets du blog
		public function accueil() {
			$taxonomies = $this->tax->getTemplates();
			$vue = new Vue("Accueil");
			$vue->generer(array('taxonomies' => $taxonomies));
		}
	}