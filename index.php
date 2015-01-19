<?php 

	/* connexion BDD avec PDO */
	$host = "localhost";
	$bd_name = "blogphp";
	$bd_user = "blogphp";
	$bd_pwd = "blogpwd";
	$dsn = "mysql:host=".$host.";dbname=".$bd_name;

	$pdo = new PDO($dsn, $bd_user, $bd_pwd);



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

		<h2>Ajouter un article</h2>

		<form name="article" method="POST" action="index.php">
			Formulaire de soumission d'article
			<p>Titre <input type="text" name="titre" value="<?php echo $titre; ?>" /></p>
			<p>Contenu <textarea name="contenu"><?php echo $contenu; ?></textarea></p>
			<input type="submit" name="soumis" />
		</form>

		<?php if (isset($_POST['soumis'])) { ?> 

		<p>Vous avez saisi :<br/>
		<b>Titre :</b> <?php echo $titre; ?> <br/>
		<b>Contenu :</b> <?php echo nl2br($contenu); ?></p>
		
		<?php } else { ?>

		<p>Vous n'avez rien saisi.</p>

		<?php } ?>

		<h2>Liste des articles</h2>

		<?php
			$query = $pdo->query("SELECT * FROM article");

			// fetch() retourne les résultats un par un
			while ( $article = $query->fetch() ) {
				echo '<p>'.$article['titre'].'<br/>'.$article['contenu'].'</p>';
			}

			// fetchAll retourne tous les résultats d'un coup
			$articles = $query->fetchAll();

			foreach ($articles as $article) {
				echo '<p>'.$article['titre'].'<br/>'.$article['contenu'].'</p>';
			}

		?>
	</body>
</html>