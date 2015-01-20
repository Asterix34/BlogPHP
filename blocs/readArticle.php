<?php

	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	if ( $id > 0) {
		// on forge le sql
		$sql = "SELECT * FROM article WHERE id=".$id;
		// on passe la requete à PDO
		$query = $pdo->query($sql);
		// on lui demande un resultat
		$article = $query->fetch();

	} else {
		header("Location: index.php?msg=".urlencode("Aucun id d'article n'a été fourni."));
	}

	// TODO ajouter un test pour voir si un article existe avec cet id

	?>

		<h2>Consulter un article</h2>

		<h3><?php echo $article['titre']; ?></h3>

		<p><?php echo nl2br($article['contenu']); ?></p>
