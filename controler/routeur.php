<?php

require_once(__ROOT__.'/controler/controleuraccueil.php');
require_once(__ROOT__.'/view/vue.php');
class Routeur {

    private $ctrlAccueil;

    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequete() {
        try {
            if (isset($_GET['page'])) {
                if ($_GET['page'] == 'test_plugin') {
					
                    $idBillet = intval($this->getParametre($_GET, 'id'));
                    if ($idBillet != 0) {
                        $this->ctrlBillet->billet($idBillet);
                    }
                    else {
                        throw new Exception("Identifiant de billet non valide");
					}
                }
                else if ($_GET['page'] == 'commenter') {
                    $auteur = $this->getParametre($_POST, 'auteur');
                    $contenu = $this->getParametre($_POST, 'contenu');
                    $idBillet = $this->getParametre($_POST, 'id');
                    $this->ctrlBillet->commenter($auteur, $contenu, $idBillet);
                }
                else {
                    throw new Exception("Action non valide");
				}
            }
            else {  // aucune action définie : affichage de l'accueil
               
            }
        }
        catch (Exception $e) {
            //$this->erreur($e->getMessage());
			$this->ctrlAccueil->accueil();
        }
    }

    // Affiche une erreur
//    private function erreur($msgErreur) {
//        $vue = new Vue("erreur");
//        $vue->generer(array('msgerreur' => $msgErreur));
//    }

    // Recherche un paramètre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else {
            throw new Exception("Paramètre '$nom' absent");
		}
    }

}