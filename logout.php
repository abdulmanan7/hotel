<html>
<body>
<?php
session_start();
if (isset($_SESSION['username'])) {
	unset($_SESSION['username']);
}
$_SESSION['msg'] = '<p>You have successfully logged out.</p>';
header("location:login.php");
?>

</body