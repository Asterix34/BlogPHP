		<h2>Liste des articles</h2>

		<?php
			$query = $pdo->query("SELECT * FROM article");

			// fetch() retourne les résultats un par un
			/*while ( $article = $query->fetch() ) {
				echo '<p><i>'.$article['titre'].'</i><br/>'.$article['contenu'].'</p>';
			}*/

			// fetchAll retourne tous les résultats d'un coup
			$articles = $query->fetchAll();

			foreach ($articles as $article) {
				echo '<p><i>'.$article['titre'].'</i><br/>'.$article['contenu'].'</p>';
			}

			$query->closeCursor();