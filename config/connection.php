<?php

	$dbname = "hotwheels";
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpassword = "";
	$dsn = "mysql:dbname=$dbname;host=$dbhost";

	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword);
	} catch (PDOException $e) {
		echo "Erro: " . $e->getMessage();
	}
