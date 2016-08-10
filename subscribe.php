<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribe</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
<?php include_once "connect.php";

if (!isset($_POST["email"])) {
	?>

    <div class="container">

        <div class="row">
         <h2 id="submit" style="padding:0.5em 0em 0.5em 10em;border-bottom:1px solid #e0e0d1;">Subscribe</h2>
        </div>
        <div class="col-sm-5 col-md-5 col-lg-5 col-lg-offset-3">
            <form method="post" action="<?=$_SERVER['PHP_SELF'];?>" id="subscribe" name="subscribe">
                <div class="form-group">
                    <input id="name" name="name" required="required" class="form-control" type="text" placeholder="Name"/>
                </div>
                <div class="form-group">
                    <input id="fname" name="fname" class="form-control" type="text" placeholder="Firstname"/>
                </div>
                <div class="form-group">
                    <input id="login" name="login" required="required" class="form-control" type="text" placeholder="Login"/>
                </div>
                <div class="form-group">
                    <input id="password" name="password" required="required" class="form-control" type="password"
                           placeholder="Password"/>
                </div>
                <div class="form-group">
                    <input id="email" name="email" required="required" class="form-control" type="email" placeholder="Email"/>
                </div>
                <div class="form-group">
                    <input id="phone" name="phone" class="form-control" type="tel" placeholder="Phone number"/>
                </div>

                <input type="submit" value="Submit"  class="btn btn-info"/>

            </form>


        </div>

    </div>

    <?php include_once 'footer.php';?>


<?php
//  require_once('lib/php_self.php');
	//  $return = https_php_self();
} else {

	function add_submit() {

		global $connection;

		$name = mysql_escape_string($_POST["name"]);
		$fname = mysql_escape_string($_POST["fname"]);
		$login = mysql_escape_string($_POST["login"]);
		$pwd = mysql_escape_string($_POST["password"]);
		$email = mysql_escape_string($_POST["email"]);
		$phone = mysql_escape_string($_POST["phone"]);

		try
		{
			$query = $connection->prepare("insert into hl_users
                (user_name, user_firstname, user_login, user_email, user_password, user_phone)
                values(:username, :fname, :login, :email, :pwd, :phone)");

			$query->execute(array(
				'username' => $name,
				'fname' => $fname,
				'login' => $login,
				'email' => $email,
				'pwd' => $pwd,
				'phone' => $phone,

			));

			return true;

		} catch (Exception $e) {
			echo $e->getMessage();
			echo "try again";
			return false;
		}
	}

	$callback = add_submit($_POST);

	if ($callback) {
		header("location: home.php");
		echo "subscribe ok";
	} else {
		echo "problem encountered, try again";

	}

}

?>