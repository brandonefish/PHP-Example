<?php 


include ("includes/header.php");


if(isset($_POST['submit'])){

	//$msg = "Form has been submitted";

	$name = $_POST['name'];
	$password = $_POST['password'];

	//echo "$name | $password";

	if(($name == "brandon") && ($password = "123456")){

		//Succesfull Login: create a session var that we will check for on all secure pages

		session_start();

		//create your own random value for the name of your sessions
		$_SESSION['guitarsession'] = session_id();

		if(isset($_SESSION['url'])) 
		   $url = $_SESSION['url']; // holds url for last page visited.
		else 
		   $url = "login.php"; 

		header("Location: $url");


	}else{

		//unsuccessful login
		$msg = "Incorrect Login";
	}


}

 ?>





<div id="container"> <!-- close container -->

<h1>Login</h1>

<div class="row">
<div class="col-md-4">
<form name="myform" id="myform" method="post" action="login.php">

<div class="form-group">
	<label for="name">Name: </label>
	<input type="text" name="name" id="name" class="form-control">
</div>

<div class="form-group">
	<label for="password">Password: </label>
	<input type="password" name="password" id="password" class="form-control">
</div>
<div class="form-group">
<label for="submit">&nbsp;</label>
	<input type="submit" name="submit" id="submit" class="btn btn-info" value="Login">
</div>


</form>

<div class="message">
<?php 

if($msg){
	echo "<div class=\"alert alert-danger\">$msg</div>";
}


include ("includes/footer.php");


 ?>
</div>

</div>