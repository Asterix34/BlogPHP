<?php

class Controller {
	
	protected $_model;
	
	public function __construct(ArticleRepository $model) {
		$this->_model = $model; 
	}
	
	protected function render($viewName, $params) {
		// on récupère un éventuel message encodé dans la barre d'adresse
		$msg = isset($_GET['msg']) ? urldecode($_GET['msg']) : "";
		
		// render htlm header view
		$view = new View("header", array("titre" => "Ma page web",
										 "msg" => $msg) );
		$view->render();
		
		// render content view
		$view = new View($viewName, $params);
		$view->render();
		
		// render html footer view
		$view = new View("footer");
		$view->render();
	}
	
	protected function redirect($url, $params) {
		$first = true;
		// ajoute les parametres à l'adresse
		foreach ( $params as $key => $value ) {
			if ($first) { // si premier alors ?
				$url .= "?";
				$first = false;
			} else { // sinon &
				$url .= "&";
			}
			$url .= $key . "=" . urlencode($value);
		}
		header ( "Location: ".$url );
	}
	
}