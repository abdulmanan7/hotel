<?php function redirect($url = '') {
	header("Location: $url"); /* Redirect browser */
	exit;
}
error_reporting(0);
setcookie("TestCookie"
	, "TestValue"
	, time() + 5 * 60
	, "/students"
	, "farthing.ex.ac.uk"
	, false
	, true);
include_once "connect.php";

include_once 'secure.php';

if (!isset($_SESSION['username'])) {
	$_SESSION['message'] = "<p>Please login first to access</p>";
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Mangment System</title>

    <!-- Bootstrap Css file -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Font Awsome -->
    <link rel="stylesheet" type="text/css" href="assets/font-awsome/css/font-awesome.min.css">
</head>
<body style="background-image:linear-gradient(rgba((34, 27, 27, 0.3),rgba((34, 27, 27, 0.3)),url(assets/images/hotel.jpg);">
<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Hotel Mangment System</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><?php echo $_SESSION['username'];?></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>