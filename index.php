<?php 

require("includes/Pdo.php");
require("includes/View.php");
require("includes/Controller.php");
require("model/Article.class.php");
require("controller/ArticleController.php");


	// page permet d'inclure la page demandée par l'utilisateur
	//$page = isset($_GET['page']) ? $_GET['page'] : "home";
	
	// page permet d'inclure la page demandée par l'utilisateur
	$entityName = isset($_GET['entity']) ? strtolower($_GET['entity']) : "article";
	$actionName = isset($_GET['action']) ? strtolower($_GET['action']) : "index";
	
	// On créé le Repo et le Controller
	$repoName = ucfirst($entityName) . "Repository"; // ArticleRepository
	$controllerName = ucfirst($entityName) . "Controller"; // ArticleController
	
	$repo = new $repoName( $pdo );
	
	$controller = new $controllerName($repo);


	$controller->$actionName();
/*

	switch($page) {
		case "newArticle":
		case "editArticle":
			$controller->edit();
			break;
			
		case "deleteArticle":
			$controller->delete();
			break;

		case "readArticle":
		case "article":
			$controller->read();
			break;

		case "home":
		case "listArticles":
		default:
			$controller->index();
	}
*/