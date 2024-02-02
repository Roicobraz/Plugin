<?php
	require_once 'model/model.php';
	
	class Tax extends model{
		public function getTemplates() {
			$sql = 'select id_template as id, active as active,'
					. ' id as template, term_id as template from wp_sandboxjvterms_template'
					. ' order by id_template desc';
			$templates = $this->executerRequete($sql);
			return $templates;
		}
		
		public function getTemplate($idBillet) {
			$sql = 'select id_template as id, active as active,'
					. ' id as template, term_id as template from wp_sandboxjvterms_template'
					. ' where id_template=?';
			$template = $this->executerRequete($sql, array($idTemplate));
			if ($template->rowCount() > 0)
				return $template->fetch();  // Accès à la première ligne de résultat
			else
				throw new Exception("Aucun template ne correspond à l'identifiant '$idTemplate'");
		}
	}