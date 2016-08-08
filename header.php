<?php
setcookie( "TestCookie"
    , "TestValue"
    , time() + 5*60
    , "/students"
    , "farthing.ex.ac.uk"
    , false
    , true );
include_once("connect.php");

include_once('secure.php');

if( isset($_SESSION['username'])) {

    echo '<p>Hello ' . $_SESSION['username'] . '!</p>';
    echo '<p><a href="logout.php">Click here to logout</a></p>';

}
else{?>

    <form action="login.php"
          method="post">
        Email: <input type="text" name="email"> <br/>
        Password: <input type="password" name="password"> <br/>
        <input type="submit" name="submit">
    </form>
    <?php
}?>



<html>
<body>
