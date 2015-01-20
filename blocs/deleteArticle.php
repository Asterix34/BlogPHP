<?php

	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	// en cas d'annulation, on redirige sur l'index
	if (isset($_POST['annuler'])) {
		$msg = "Suppression annulée.";
		header("Location: index.php?msg=".urlencode($msg));

	}


	// sinon on cherche un id d'article à supprimer
	else if (isset($_POST['supprimer'])) {

		if ( $id > 0) {
			// on forge la requete SQL
			$sql = "DELETE FROM article WHERE id=".$id;

			// on l'execute
			$query = $pdo->query($sql);
			$query->execute();


			// on effectue une redirection vers la page d'accueil à la fin du traitement
			// on peut passer un message encodé pour confirmer
			$msg = "L'article a été supprimé avec succès.";
			header("Location: index.php?msg=".urlencode($msg));
		} else {
			// sinon on redirige en indiquant qu'il faut fournir un id
			Header("Location: index.php?msg=".urlencode("Aucun id d'article à supprimer"));
		}

	} 

	?>

		<h2>Supprimer un article</h2>

		<form name="article" method="POST" action="index.php?page=deleteArticle&id=<?php echo $id; ?>">
			Vous confirmez la suppression de l'article ?<br/>
			<input type="submit" name="supprimer" value="Supprimer"/>
			<input type="submit" name="annuler" value="Annuler"/>
		</form>
