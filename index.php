<?php 

require("includes/pdo.php");

	// on récupère le prenom et nom en GET
	$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : "";
	$nom = isset($_GET['nom']) ? $_GET['nom'] : "";

	// page permet d'inclure la page demandée par l'utilisateur
	$page = isset($_GET['page']) ? $_GET['page'] : "home";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Mon premier Blog</title>
	</head>

	<body>
		<h1>Ma page web</h1>
		<p> Bonjour <?php echo $prenom . " " . $nom; ?> !</p>

<?php /* bloc controleur frontal */

	switch($page) {
		case "newArticle":
		case "editArticle":
			include("blocs/editArticle.php");
			break;

		case "listArticles":
			include("blocs/listArticles.php");
			break;
			
		case "deleteArticle":
			echo "TODO deleteArticle";
			break;

		case "readArticle":
		case "article":
			echo "TODO readArticle";
			break;


		case "home":
		default:
			include("blocs/home.php");
	}


?>
	</body>
</html>