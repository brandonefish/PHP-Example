<?php
include("mysql_connect.php");// here we include the connection script; since this file(header.php) is included at the top of every page we make, the connection will then also be included. Also, config options like BASE_URL are also available to us.

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   

    <title>Fish Guitars</title>

    <!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 -->
<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
 -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 <!-- Your Custom styles for this project -->

<link rel="stylesheet" type="text/css" href="http://bfish1.dmitstudent.ca/dmit2025/Lab8/css/styles.css">
<link rel="stylesheet" type="text/css" href="http://bfish1.dmitstudent.ca/dmit2025/Lab8/css/bootstrap-sandstone.css">
<link rel="stylesheet" type="text/css" href="http://bfish1.dmitstudent.ca/dmit2025/Lab8/css/fontawesome.css">



 
 <!--  Note how we can use BASE_URL constant to resolve all links no matter where the file resides. -->
<link href="<?php echo BASE_URL ?>css/styles.css" rel="stylesheet">


</head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <!--  We'll use the BASE_URL set in the connection script to resolve all links -->
            <a class="navbar-brand" href="<?php echo BASE_URL ?>index.php">Home</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            <li><a href="<?php echo BASE_URL ?>catalog.php">Guitar Catalog</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo BASE_URL ?>admin/insert.php">New Guitar</a></li>
                  <li><a href="<?php echo BASE_URL ?>admin/edit.php">Edit Guitar</a></li>
                  
                 
                </ul>
              </li>
            </ul>
          
         

            <ul class="nav navbar-nav navbar-right">
            <li>
              <?php
                session_start();
                if (! empty($_SESSION['guitarsession']))
                {
                    ?>

                    <a href='<?php echo BASE_URL ?>logout.php'>Log Out</a>

                    <?php
                }
                else
                {
                    echo '<a href="login.php">Log In</a>';
                }?>
              </li>
            </ul>

             <!-- <form class="navbar-form col-md-3 pull-right" role="search">
    			<div class="form-group">
        			<input type="text" class="form-control" placeholder="Search">
    			</div>
    			<button type="submit" class="btn btn-default">Submit</button> -->


    			


				</form>
    			
  


          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

    
