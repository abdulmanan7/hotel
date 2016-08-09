
	
<?php
  session_start();
    if ( isset( $_SESSION[ 'username' ] ) )
      {
         $username = $_SESSION[ 'username' ];
      }

    else
      {
        echo "<p style='padding-left:2em;font-size:1em;color:#ff3385;'>
             To book a reservation do not forget to sign in <a href='subscribe.php'>Here</a>
             </p>";
      }
?>

