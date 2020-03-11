<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php 



include ("../includes/mysql_connect.php");

$guitar_ID = $_GET['gid'];

if(isset($guitar_ID)){

mysqli_query($con, "DELETE FROM guitars WHERE gid = '$guitar_ID'") or die(mysqli_error($con));

}

header("Location:edit.php");


 ?>



</body>
</html>

