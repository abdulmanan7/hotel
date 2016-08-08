<?php
include_once "connect.php";

if (isset($_POST['email'])) {

	function check_user() {
		global $connection;

		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['password']);

		try
		{
			$query = $connection->query("SELECT * FROM hl_users
        Where user_email ='" . $email . "'
        and user_password='" . $password . "'");
			$user = $query->fetch();
			return $user;
		} catch (Exception $e) {
			return false;
		}
	}

	$user = check_user($_POST);

	if ($user) {

		session_start();

		$_SESSION['username'] = $user['user_login'];
		$_SESSION['user_id'] = $user['user_id'];

		header("location: home.php");
	} else {
		set_message("wrong user informations try again</a>");
		redirect('home.php');
	}
}
?>