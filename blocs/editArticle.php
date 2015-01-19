<?php

	$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
/*
print_r($_POST);
echo "ID = ".$id;
*/

	// on cherche la soumission d'un article par un formulaire en POST
	if (isset($_POST['soumis'])) {

		if ( $id > 0) {
			$sql = "UPDATE article SET titre=:titre, contenu=:contenu WHERE id=".$id;
		} else {
			$sql = "INSERT INTO article (titre, contenu) VALUES(:titre, :contenu)";
		}

		$req = $pdo->prepare($sql);

		$params = array('titre' => $_POST['titre'],
						'contenu' => $_POST['contenu']);

		$req->execute($params);


	} 
	// TODO: evitez d'aller chercher en base des données qu'on vient d'entrer
	// si on a un id, on charge les valeurs depuis la base de données
	if ( $id > 0 ) {
		$sql = "SELECT * FROM article WHERE id=".$id;
		// on recupère la requete PDO
		$query = $pdo->query($sql);
		// on recupère le premier article (et le seul)
		// TODO: traiter l'id inconnu
		$article = $query->fetch();
	}
	?>

		<h2>Ajouter un article</h2>

		<form name="article" method="POST" action="index.php?page=editArticle<?php
			echo ($id>0) ? "&id=".$id : "";
			 ?>">
			Formulaire de soumission d'article
			<p>Titre <input type="text" name="titre" value="<?php
			echo ($id>0) ? $article['titre'] : ""; 
			 ?>" /></p>
			<p>Contenu <textarea name="contenu"><?php 
			echo ($id>0) ? $article['contenu'] : ""; 
			?></textarea></p>
			<input type="submit" name="soumis" value="Poster"/>
		</form>
