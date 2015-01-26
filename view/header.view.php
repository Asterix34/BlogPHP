<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Mon premier Blog</title>
	</head>

	<body>
		<h1><?php echo $titre; ?></h1>
		
		<?php 
		// on cherche l'existence d'un message à afficher
		if (isset($msg) && $msg != "") {
			// et on l'affiche
			echo '<p>'.$msg.'</p>';
		}
		?>
		
		
		<div id="content"> <!--  beging div content -->