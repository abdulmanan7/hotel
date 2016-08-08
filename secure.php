<?php
session_start();
if ( isset( $_SESSION[ 'username' ] ) )
    {
        $username = $_SESSION[ 'username' ];
    }

else
    {
        echo "to book a reservation do not forget to sign in <a href='subscribe.php'>here</a>";
    }
?>


