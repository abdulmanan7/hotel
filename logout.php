<html>
<body>
<?php
session_start();



if ( isset( $_SESSION['username' ] ) )
 {
    unset( $_SESSION[ 'username' ] );

    echo '';
}
header("location:login.php?error=<p>You have successfully logged out.</p>");
?>

</body