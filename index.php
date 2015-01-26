<?php 

require("includes/Pdo.php");
require("includes/View.php");
require("model/Article.class.php");
require("controller/ArticleController.php");


	// page permet d'inclure la page demandée par l'utilisateur
	$page = isset($_GET['page']) ? $_GET['page'] : "home";
	

	/* bloc controleur frontal */	
	$articleRepo = new ArticleRepository( $pdo );
	
	$articleController = new ArticleController($articleRepo);




	switch($page) {
		case "newArticle":
		case "editArticle":
			$articleController->edit();
			break;
			
		case "deleteArticle":
			$articleController->delete();
			break;

		case "readArticle":
		case "article":
			$articleController->read();
			break;

		case "home":
		case "listArticles":
		default:
			$articleController->index();
	}


?>
	</body>
</html>