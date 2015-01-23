<?php

class ArticleController {
	
	private $_model;
	
	public function __construct(ArticleRepository $model) {
		$this->_model = $model; 
	}
	
	public function index() {
		
		echo "<h2>Liste des articles</h2>";

		// fetchAll retourne tous les résultats d'un coup
		$articles = $this->_model->getAll();
		
		echo '<ul>'; // unordered list
		foreach ($articles as $article) {
			echo '<li>' // list item
				// titre de l'article dans un lien pour readArticle
				.'<a href="index.php?page=readArticle&id='.$article->id.'">'
					.$article->titre.'</a> - '
				// lien d'édition
				.'<a href="index.php?page=editArticle&id='.$article->id.'">'
					.'éditer</a> - '
				// lien de suppression
				.'<a href="index.php?page=deleteArticle&id='.$article->id.'">'
					.'supprimer</a>'
				.'</li>';
		}
		echo '</ul>';

		// lien pour ajouter un article
		echo '<p><a href="index.php?page=newArticle">Ajouter un article</a></p>';
		
	}
	
	public function read() {
		$id = isset ( $_GET ['id'] ) ? ( int ) $_GET ['id'] : 0;
		
		if ($article = $this->_model->get($id)) {
		?>
					
		<h2>Consulter un article</h2>
		<h3><?php echo $article->titre; ?></h3>
		<p><?php echo nl2br( $article->contenu ); ?></p>
		
		<?php 
		
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
	
		?> <h2>Ajouter un article</h2>
		
			<form name="article" method="POST" action="index.php?page=editArticle<?php
				echo ($id>0) ? "&id=".$id : "";
				 ?>">
				Formulaire de soumission d'article
				<p>Titre <input type="text" name="titre" value="<?php
				echo ($id>0) ? $article->titre : ""; 
				 ?>" /></p>
				<p>Contenu <textarea name="contenu"><?php 
				echo ($id>0) ? $article->contenu : ""; 
				?></textarea></p>
				<input type="submit" name="soumis" value="Poster"/>
			</form>
			
			<?php 
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
		
		?>
				<h2>Supprimer un article</h2>
		
				<form name="article" method="POST" action="index.php?page=deleteArticle&id=<?php echo $id; ?>">
					Vous confirmez la suppression de l'article ?<br/>
					<input type="submit" name="supprimer" value="Supprimer"/>
					<input type="submit" name="annuler" value="Annuler"/>
				</form>
		<?php 
	}
}