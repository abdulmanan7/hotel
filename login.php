<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
    <!-- Bootstrap Css file -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- Font Awsome -->
    <link rel="stylesheet" type="text/css" href="assets/font-awsome/css/font-awesome.min.css">


</head>
<body style="background-image:url(assets/images/bg-image.jpg">

  <div class="container"> 
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <div class="alert alert-success" style="margin-top:1em">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $_GET['error']; ?>
          </div>
            <div class="panel panel-default" style="margin-top:3em">
                <div class="panel-body">
                    <div class="row" style="border-bottom:1px solid #e0e0d1">
                        
                        <h2 class="font">Login to our site</h2>
                        <?php include_once("secure.php")  ?>
                    </div>  
        <div class="col-sm-7 col-sm-offset-1" style='margin-top: 1em'>
            <form action="login.php" method="post" id="login">
                <label>Email:</label> 
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="form-group">    
                       <input type="text" id="email" name="email" class="form-control" placeholder="Please enter email">
                    </div>   
                </div>  
                    </br>  
                <label>Password:</label> 
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    </div>    
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Please enter password">
                    </div>   
                </div>   
                    </br> 
                    <div class="form-group">
                        <button type="submit" id="submit" name="submit" class="btn btn-info ">
                            Login <span class="glyphicon glyphicon-log-in"></span>
                        </button>
                    </div>   
            </form>

        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("footer.php"); ?>

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


if ($user) 
   {

    session_start();

    $_SESSION[ 'username' ] = $user[ 'user_login' ];
    $_SESSION[ 'user_id' ] = $user[ 'user_id' ];


    header( "location: home.php" );
   }
   else
   {
    echo "<div class='col-sm-4 col-sm-offset-4'>
            <div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                wrong user informations</a>
            </div>
          </div>  
         ";
   }
}



//require_once('lib/php_self');
//$return = https_php_self();
?>
<!-- <script>
  $(document).on('click', '#submit', function(event) {
    event.preventDefault();
    /* Act on the event */
    var error = false;
    if ($('#email').val()=="") {
      var error = true;
      $('#email').addClass('error').focus(function(event) {
        $(this).removeClass('error');
      });
    }else if($('#password').val()=="") {
      var error = true;
      $('#password').addClass('error').focus(function(event) {
        $(this).removeClass('error');
      });
    } else{
      
      $('#login').submit();
    }
      
  });
</script> -->