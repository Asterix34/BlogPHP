<?php

class ArticleController {
	
	private $_model;
	
	public function __construct(ArticleRepository $model) {
		$this->_model = $model; 
	}
	
	public function index() {
		
		// fetchAll retourne tous les résultats d'un coup
		$articles = $this->_model->getAll();

		include("view/index.view.php");
		
	}
	
	public function read() {
		$id = isset ( $_GET ['id'] ) ? ( int ) $_GET ['id'] : 0;
		
		if ($article = $this->_model->get($id)) {

			include("view/read.view.php");
		
		} else {
			header ( "Location: index.php?msg=" . urlencode ( "Aucun id d'article n'a été fourni." ) );
		}
	}
	
	public function edit() {
		
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		
		
		// on cherche la soumission d'un article par un formulaire en POST
		if (isset($_POST['soumis'])) {
		
			$article = new Article();
			$article->id = $id;
			$article->titre = $_POST['titre'];
			$article->contenu = $_POST['contenu'];
			
			$this->_model->persist($article);
			
			// we need a redirect here
			header("Location: index.php?msg=".urlencode("L'article a été édité avec succès."));
		}
		
		if ( $id > 0 ) {
			$article = $this->_model->get($id);
		
			if ($article==null)
				$id = 0;
		}

		include("view/edit.view.php");
	}

	public function delete() {
		
		$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		
		// en cas d'annulation, on redirige sur l'index
		if (isset($_POST['annuler'])) {
			$msg = "Suppression annulée.";
			header("Location: index.php?msg=".urlencode($msg));
		
		}
		// sinon on cherche un id d'article à supprimer
		else if (isset($_POST['supprimer'])) {

			// on forge la requete SQL
			if ($this->_model->remove($id)) {
		
				// on effectue une redirection vers la page d'accueil à la fin du traitement
				// on peut passer un message encodé pour confirmer
				$msg = "L'article a été supprimé avec succès.";
				header("Location: index.php?msg=".urlencode($msg));
				
			} else {
				// sinon on redirige en indiquant qu'il faut fournir un id
				Header("Location: index.php?msg=".urlencode("Aucun article n'a été trouvé avec cet id."));
			}
		
		}
		
		include ("view/delete.view.php");
	}
}