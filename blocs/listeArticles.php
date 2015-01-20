		<h2>Liste des articles</h2>

		<?php
			$query = $pdo->query("SELECT * FROM article");

			// fetchAll retourne tous les résultats d'un coup
			$articles = $query->fetchAll();
			echo '<ul>'; // unordered list
			foreach ($articles as $article) {
				echo '<li>' // list item
					// titre de l'article dans un lien pour readArticle
					.'<a href="index.php?page=readArticle&id='.$article['id'].'">'
						.$article['titre'].'</a> - '
					// lien d'édition
					.'<a href="index.php?page=editArticle&id='.$article['id'].'">'
						.'éditer</a> - '
					// lien de suppression
					.'<a href="index.php?page=deleteArticle&id='.$article['id'].'">'
						.'supprimer</a>'
					.'</li>';
			}
			echo '</ul>';

			// lien pour ajouter un article
			echo '<p><a href="index.php?page=newArticle">Ajouter un article</a></p>';

			$query->closeCursor();