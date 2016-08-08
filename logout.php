<html>
<body>
<?php
session_start();
if ( isset( $_SESSION['username' ] ) ) {
    unset( $_SESSION[ 'username' ] );

    echo '<p>You have successfully logged out.</p>';
    echo '<a href="home.php"><- back to homepage</a>';
}

?>

</body