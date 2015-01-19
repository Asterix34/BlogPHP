<?php 

require("includes/pdo.php");

print_r($_POST);


	// on récupère le prenom et nom en GET
	$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : "";
	$nom = isset($_GET['nom']) ? $_GET['nom'] : "";

	// on cherche la soumission d'un article par un
	// formulaire en POST
	$titre = isset($_POST['titre']) ? $_POST['titre'] : "";
	$contenu = isset($_POST['contenu']) ? $_POST['contenu'] : "";

	if (isset($_POST['soumis'])) { 

		$sql = "INSERT INTO article (titre, contenu) VALUES(".
			$pdo->quote($titre).",".$pdo->quote($contenu).")";

		$pdo->query($sql);

	} 


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

		<h2>Ajouter un article</h2>

		<form name="article" method="POST" action="index.php">
			Formulaire de soumission d'article
			<p>Titre <input type="text" name="titre" value="<?php echo $titre; ?>" /></p>
			<p>Contenu <textarea name="contenu"><?php echo $contenu; ?></textarea></p>
			<input type="submit" name="soumis" value="Poster"/>
		</form>

<?php include("blocs/listeArticles.php"); ?>

	</body>
</html>