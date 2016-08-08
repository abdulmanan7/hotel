<?php
include_once("connect.php");

if ( isset( $_POST[ 'email' ] ) )
{


    function check_user()
    {
        global $connection;

        $email = $_POST['email'];
        $password = $_POST[ 'password' ];

        try
        {
            $query = $connection->query("SELECT * FROM hl_users
                                          Where user_email ='".$email."'
                                          and user_password='".$password."'");
            $user = $query->fetch();
            return $user;
        }
        catch (Exception $e)
        {
            return false;
        }
    }

    $user = check_user($_POST);


if ($user) {

    session_start();

    $_SESSION[ 'username' ] = $user[ 'user_login' ];
    $_SESSION[ 'user_id' ] = $user[ 'user_id' ];


    header( "location: home.php" );
}
else
{
    echo "wrong user informations <a href='home.php'>try again</a>";
}
}



//require_once('lib/php_self');
//$return = https_php_self();
?>



