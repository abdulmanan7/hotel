<?php

try
{
	$dns = 'mysql:host=localhost;dbname=hotel';
	$utilisateur = 'root';
	$motDePasse = '';

	//option de connexion
	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);

	$connection = new PDO($dns, $utilisateur, $motDePasse, $options);
	// echo "base de données connectée";
} catch (Exception $e) {
	echo "connection", $e->getMessage();
	die();
}
?>