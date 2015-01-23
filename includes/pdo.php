<?php

/* connexion BDD avec PDO */
$dbHost = "localhost";
$dbName = "blogphp";
$dbUser = "blogphp";
$dbPwd = "blogpwd";
$dsn = "mysql:host=".$dbHost.";dbname=".$dbName;

$pdo = new PDO($dsn, $dbUser, $dbPwd);

// set default fetch to ASSOC
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);