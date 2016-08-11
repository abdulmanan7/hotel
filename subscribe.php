<?php
session_start();
$message = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
?>
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
		<?php if ($message): ?>
          <div class="alert alert-success" style="margin-top:1em">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php unset($_SESSION['msg'])?>
            <?=$message;?>
          </div>
        <?php endif?>
        <?php if ($error): ?>
          <div class="alert alert-success" style="margin-top:1em">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php unset($_SESSION['error'])?>
            <?=$error;?>
          </div>
        <?php endif?>
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

		$name = htmlspecialchars($_POST["name"]);
		$fname = htmlspecialchars($_POST["fname"]);
		$login = htmlspecialchars($_POST["login"]);
		$pwd = htmlspecialchars($_POST["password"]);
		$email = htmlspecialchars($_POST["email"]);
		$phone = htmlspecialchars($_POST["phone"]);

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
				'pwd' => hash_password($pwd),
				'phone' => $phone,

			));
			if (mysql_affected_rows() > 0) {

				return true;
			} else {
				$_SESSION['error'] = '<p>problem encountered while inserting data, try again</p>';
			}

		} catch (Exception $e) {
			$_SESSION['error'] = '<p>Error while connecting to database, try again</p>';
			return false;
		}
	}

	$callback = add_submit($_POST);

	if ($callback) {
		$_SESSION['msg'] = '<p>You have successfully Subscribe.</p>';
		header("location: home.php");
	} else {
		$_SESSION['error'] = '<p>problem encountered, try again</p>';
		header("location: subscribe.php");
	}

}

?>