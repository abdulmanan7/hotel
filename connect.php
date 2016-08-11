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
function hash_password($pass = '') {
	$enc_string = hash_hmac("sha256", $pass, "2y$10$UY1KfmGvUVTeyYZheD8Vi", true);
	return base64_encode($enc_string);
}
function verifyPass($user_input, $hash) {
	if (hash_password($user_input) === $hash) {
		return TRUE;
	} else {
		return FALSE;
	}
}