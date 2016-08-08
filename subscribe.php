<?php include_once "connect.php";

if (!isset($_POST["email"])) {
	?>

    <?php include_once 'header.php';?>
    <div class="container">


        <div class="submit">
            <h2>Subcribe</h2>

            <form method="post" action="<?=$_SERVER['PHP_SELF'];?>" id="subscribe" name="subscribe">
                <div>
                    <input id="name" name="name" class="submit-input" type="text" placeholder="Name"/>
                </div>
                <div>
                    <input id="fname" name="fname" class="submit-input" type="text" placeholder="Firstname"/>
                </div>
                <div>
                    <input id="login" name="login" class="submit-input" type="text" placeholder="Login"/>
                </div>
                <div>
                    <input id="password" name="password" class="submit-input" type="password"
                           placeholder="Password"/>
                </div>
                <div>
                    <input id="email" name="email" class="submit-input" type="email" placeholder="Email"/>
                </div>
                <div>
                    <input id="phone" name="phone" class="submit-input" type="tel" placeholder="Phone number"/>
                </div>

                <input type="submit" value="Submit" class="submit-button"/>

            </form>


        </div>

    </div>

    <?php include_once 'footer.php';

	//  require_once('lib/php_self.php');
	//  $return = https_php_self();
} else {

	function add_submit() {

		global $connection;

		$name = mysql_real_escape_string($_POST["name"]);
		$fname = mysql_real_escape_string($_POST["fname"]);
		$login = mysql_real_escape_string($_POST["login"]);
		$pwd = mysql_real_escape_string($_POST["password"]);
		$email = mysql_real_escape_string($_POST["email"]);
		$phone = mysql_real_escape_string($_POST["phone"]);

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
