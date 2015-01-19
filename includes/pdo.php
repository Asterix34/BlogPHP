<?php

	/* connexion BDD avec PDO */
	$host = "localhost";
	$bd_name = "blogphp";
	$bd_user = "blogphp";
	$bd_pwd = "blogpwd";
	$dsn = "mysql:host=".$host.";dbname=".$bd_name;

	$pdo = new PDO($dsn, $bd_user, $bd_pwd);