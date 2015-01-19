<?php 
	// on récupère le prenom et nom en GET
	$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : "";
	$nom = isset($_GET['nom']) ? $_GET['nom'] : "";

	// on cherche la soumission d'un article par un
	// formulaire en POST
	$titre = isset($_POST['titre']) ? $_POST['titre'] : "";
	$contenu = isset($_POST['contenu']) ? $_POST['contenu'] : "";

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Mon premier Blog</title>
	</head>

	<body>
		<h1>Ma page web</h1>
		<p> Bonjour <?php echo $prenom . " " . $nom; ?> !
		</p>

		<form name="article" method="POST" action="index.php">
			Formulaire de soumission d'article
			<p>Titre <input type="text" name="titre" value="<?php echo $titre; ?>" /></p>
			<p>Contenu <input type="text" name="contenu" value="<?php echo $contenu; ?>" /></p>
			<input type="submit" name="soumis" />
		</form>

		<?php if (isset($_POST['soumis'])) { ?> 

		<p>Vous avez saisi :<br/>
		<b>Titre :</b> <?php echo $titre; ?> <br/>
		<b>Contenu :</b> <?php echo $contenu; ?></p>
		
		<?php } else { ?>

		<p>Vous n'avez rien saisi.</p>

		<?php } ?>
	</body>
</html>