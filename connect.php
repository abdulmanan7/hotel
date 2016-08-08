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
function select_query($table) {
	global $connection;

	try
	{
		$query = $connection->query("SELECT * FROM " . $table);
		$cities = $query->fetchAll();
		return $cities;
	} catch (Exception $e) {
		return false;
	}
}
function set_message($message = '') {
	$_SESSION["msg"] = $message;
}
function get_message() {
	$error = "";
	if (isset($_SESSION["msg"])) {
		$error = $_SESSION["msg"];
		session_unset($_SESSION["msg"]);
	} else {
		$error = "";
	}
	return $error;
}
?>