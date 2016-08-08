<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
<?php
  session_start();
    if ( isset( $_SESSION[ 'username' ] ) )
      {
         $username = $_SESSION[ 'username' ];
      }

    else
      {
        echo "<p style='padding-left:13.5em;font-size:2em;color:#ff3385;'>
             To book a reservation do not forget to sign in <a href='subscribe.php'>Here</a>
             </p>";
      }
?>
</body>
</html>


