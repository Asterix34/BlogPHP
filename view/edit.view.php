<h2>Ajouter un article</h2>
		
<form name="article" method="POST" action="index.php?entity=article&action=edit<?php
	echo ($id>0) ? "&id=".$id : "";
	 ?>">
	Formulaire de soumission d'article
	<p>Titre <input type="text" name="titre" value="<?php
	echo ($id>0) ? $article->titre : ""; 
	 ?>" /></p>
	<p>Contenu <textarea name="contenu"><?php 
	echo ($id>0) ? $article->contenu : ""; 
	?></textarea></p>
	<input type="submit" name="soumis" value="Poster"/>
</form>