<?php

class View {
	
	private $template;
	private $params;
	
	public function __construct($template, $params) {
		$this->template = $template;
		$this->params = $params;
	}
	
	public function render() {
		// on test l'existence d'un fichier template dans le dossier vues
		if (isset($this->template) && !empty($this->template)) {
			if (file_exists("view/".$this->template.".view.php")) {
				foreach ($this->params as $key => $value) {
					$$key = $value;
				}
				
				include ("view/".$this->template.".view.php");
			}
			else echo "No file view/".$this->template.".view.php has been found.<br/>"; 
		}
	}
	
}