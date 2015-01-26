<h2>Supprimer un article</h2>

<form name="article" method="POST" action="index.php?entity=article&action=delete&id=<?php echo $id; ?>">
	Vous confirmez la suppression de l'article ?<br/>
	<input type="submit" name="supprimer" value="Supprimer"/>
	<input type="submit" name="annuler" value="Annuler"/>
</form>