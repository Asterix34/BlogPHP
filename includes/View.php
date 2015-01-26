<?php

/**
 * View est la classe permettant de charger un template en lui passant une liste de paramètres
 * 
 * @author humanbooster
 */
class View {
	
	/**
	 * Nom du template à trouver dans view/*.view.php
	 * 
	 * @var string
	 */
	private $template;
	
	/**
	 * Params est un tableau associatif pour passer le contenu au template
	 * 
	 * @var array
	 */
	private $params;
	
	public function __construct($template, $params = array()) {
		$this->template = $template;
		$this->params = $params;
	}
	
	/**
	 * Render cherche un template, charge les variable de params et inclut le template
	 */
	public function render() {
		// on teste l'existence d'un fichier template dans le dossier vues
		if (isset($this->template) && !empty($this->template)) {
			if (file_exists("view/".$this->template.".view.php")) {
				// on cherche chaque entrée du tableau de paramètre
				foreach ($this->params as $key => $value) {
					// on instancie une variable qui portera le nom de la clé
					$$key = $value;
				}
				// on inclut la page de template pour l'afficher
				include ("view/".$this->template.".view.php");
			}
			else echo "No file view/".$this->template.".view.php has been found.<br/>"; 
		}
	}
	
}