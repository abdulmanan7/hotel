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
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Hotel Mangment System</a>
        </div>
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


                if( isset($_SESSION['username']))
                 {
                ?>       
                    
                   
                 
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#"><?php echo '<p>Hello ' . $_SESSION['username'] . '!</p>';?>
                 </a></li>
                <li><?php echo '<a href="logout.php">Click here to logout</a>';?> </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>


<div class="container"> 
<?php 
   }
else
   {

?> 
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row" style="border-bottom:1px solid #e0e0d1">
                        <h2 class="font">Login to our site</h2>
                    </div>  
        <div class="col-sm-7 col-sm-offset-1" style='margin-top: 2em'>
            <form action="login.php" method="post">
                <label>Email:</label> 
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="form-group">    
                       <input type="text" name="email" class="form-control" placeholder="Please enter email">
                    </div>   
                </div>  
                    </br>  
                <label>Password:</label> 
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                    </div>    
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="            Please enter password">
                    </div>   
                </div>   
                    </br> 
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info ">
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

    <?php
   }
?>


 
