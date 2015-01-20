<?php

/* connexion BDD avec PDO */
$dbHost = "localhost";
$dbName = "blogphp";
$dbUser = "blogphp";
$dbPwd = "blogpwd";
$dsn = "mysql:host=".$dbHost.";dbname=".$dbName;

$pdo = new PDO($dsn, $dbUser, $dbPwd);