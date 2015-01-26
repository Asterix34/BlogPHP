<?php 

require("includes/Pdo.php");
require("includes/View.php");
require("includes/Controller.php");
require("includes/Repository.php");

	
// page permet d'inclure la page demandée par l'utilisateur
$entityName = isset($_GET['entity']) ? strtolower($_GET['entity']) : "article";
$actionName = isset($_GET['action']) ? strtolower($_GET['action']) : "index";

// on nettoie les variables pour les sécuriser
$entityName = preg_replace('/[^a-z0-9 "\']/', '', $entityName);
$actionName = preg_replace('/[^a-z0-9 "\']/', '', $actionName);

// On forge les noms de Repo et de Controller
$entityName = ucfirst($entityName); // on ajoute une majuscule
$repoName = $entityName . "Repository"; // ArticleRepository
$controllerName = $entityName . "Controller"; // ArticleController

// On inclut les bons fichiers
require("model/".$entityName.".class.php");
require("controller/".$entityName."Controller.php");

// on les instancie
$repo = new $repoName( $pdo );
$controller = new $controllerName($repo);

// on appelle la méthode demandée
$controller->$actionName();