<?php

echo "<h2>Liste des articles</h2>";

echo '<ul>'; // unordered list
foreach ($articles as $article) {
	echo '<li>' // list item
	// titre de l'article dans un lien pour readArticle
	.'<a href="index.php?entity=article&action=read&id='.$article->id.'">'
					.$article->titre.'</a> - '
				// lien d'édition
	.'<a href="index.php?entity=article&action=edit&id='.$article->id.'">'
	.'éditer</a> - '
				// lien de suppression
	.'<a href="index.php?entity=article&action=delete&id='.$article->id.'">'
	.'supprimer</a>'
	.'</li>';
}
echo '</ul>';

// lien pour ajouter un article
echo '<p><a href="index.php?entity=article&action=edit">Ajouter un article</a></p>';