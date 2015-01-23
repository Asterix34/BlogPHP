<?php 

require("includes/pdo.php");
require("model/Article.class.php");
require("controller/ArticleController.php");


	// page permet d'inclure la page demandée par l'utilisateur
	$page = isset($_GET['page']) ? $_GET['page'] : "home";

	// on récupère un éventuel message encodé dans la barre d'adresse
	$msg = isset($_GET['msg']) ? urldecode($_GET['msg']) : "";
	

	/* bloc controleur frontal */	
	$articleRepo = new ArticleRepository( $pdo );
	
	$articleController = new ArticleController($articleRepo);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Mon premier Blog</title>
	</head>

	<body>
		<h1>Ma page web</h1>

<?php
	// on cherche l'existence d'un message à afficher
	if (isset($msg) && $msg != "") {
		// et on l'affiche
		echo '<p>'.$msg.'</p>';
	}


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