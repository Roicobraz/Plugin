<?php 
	abstract class model{
		private $db;
		
		protected function getDB(){
			if($this->db == null)
			{
				$this->db = new mysqli('justinsandbox', 'justin', 'hL3*c[4BxGzY1!I9EQ6L', 'localhost');

				// Check connection
				if ($this->db->connect_error) :
				{
					die("&Eacute;chec de connection : " . $conn->connect_error);
				}
				else:
				{
					echo 'reussi';
				}
				endif;

				return ($conn);
			}
		}
		
		protected function executerRequete($sql, $params = null) {
			if ($params == null) {
				$resultat = $this->getDB()->query($sql); // exécution directe
			}
			else {
				$resultat = $this->getDB()->prepare($sql);  // requête préparée
				$resultat->execute($params);
			}
			return $resultat;
		}
	}