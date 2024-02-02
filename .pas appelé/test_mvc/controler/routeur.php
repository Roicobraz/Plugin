<?php
	require_once 'controler/controleurAccueil.php';
	require_once 'controler/controleurTax.php';
	require_once 'view/vue.php';

	class Routeur {
		private $ctrlAccueil;
		private $ctrlTax;
		
		public function __construct() {
			$this->ctrlAccueil = new controleurAccueil();
			$this->ctrlTax = new controleurTax();
		}
		
		// Route une requête entrante : exécution l'action associée
		public function routerRequete() {
			try {
				if (isset($_GET['action'])) {
					if ($_GET['action'] == 'taxonomy') {
						$idTax = intval($this->getParametre($_GET, 'id'));
						if ($idTax != 0) {
							$this->ctrlTax->tax($idTax);
						}
						else
							throw new Exception("Identifiant de taxonomy non valide");
					}
					else
						throw new Exception("Action non valide");
				}
				else {  // aucune action définie : affichage de l'accueil
					$this->ctrlAccueil->accueil();
				}
			}
			catch (Exception $e) {
				$this->erreur($e->getMessage());
			}
		}

		// Affiche une erreur
		private function erreur($msgErreur) {
			$vue = new Vue("Erreur");
			$vue->generer(array('msgErreur' => $msgErreur));
		}

		// Recherche un paramètre dans un tableau
		private function getParametre($tableau, $nom) {
			if (isset($tableau[$nom])) {
				return $tableau[$nom];
			}
			else
				throw new Exception("Paramètre '$nom' absent");
		}
	}