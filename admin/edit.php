<?php 

include ("../includes/header.php");
include ("../includes/functions.php");


//Check session
	session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
if (!isset($_SESSION['guitarsession'])) {
	header("Location:../login.php");
}// \\check session


// Get specific guitar to edit
$guitar_ID = $_GET['gid'];

if(!isset($guitar_ID)){


	$result = mysqli_query($con, "SELECT * FROM guitars LIMIT 1") or die(mysqli_error($con));

	while($row = mysqli_fetch_array($result)){

		$guitar_ID = $row['gid'];

	}// \ loop

}// \ isset

// IF ISSET EDIT

// isset
if(isset($_POST['edit'])){
	$newType = strip_tags(trim($_POST['type']));
	$newModel = strip_tags(trim($_POST['model']));
	$newBrand = strip_tags(trim($_POST['brand']));
	$newBodytype = strip_tags(trim($_POST['bodytype']));
	$newStrings = strip_tags(trim($_POST['strings']));
	$newPrice = strip_tags(trim($_POST['price']));
	$newDescription = strip_tags(trim($_POST['description']));
	$newLink = strip_tags(trim($_POST['link']));

	$boolvalidateOK = 1;



// Validation for guitar type
	if($newType == ""){
		$boolvalidateOK = 0;
		$typeValidationMessage = "Please select a guitar type.";
	}

// Validation for Model
	if(empty($newModel)){
		$boolvalidateOK = 0;
		$modelNullValidationMessage = "Please enter a model name.";
	}

	if(strlen($newModel) > 150){
		$boolvalidateOK = 0;
		$modelLengthValidationMessage = "Model name cannot exceed 150 characters.";
	}

// Validation for Brand
	if(empty($newBrand)){
		$boolvalidateOK = 0;
		$brandNullValidationMessage = "Please enter a brand name.";
	}

	if(strlen($newBrand) > 100){
		$boolvalidateOK = 0;
		$brandLengthValidationMessage = "Brand name cannot exceed 100 characters.";
	}

// Validation for body type
	if(empty($newBodytype)){
		$boolvalidateOK = 0;
		$bodytypeNullValidationMessage = "Please describe the body type.";
	}

	if(strlen($newBodytype) > 100){
		$boolvalidateOK = 0;
		$bodytypeLengthValidationMessage = "Body type cannot exceed 100 characters.";
	}

// Validation for strings
	if(empty($newStrings)){
		$boolvalidateOK = 0;
		$stringNullValidationMessage = "Please enter number of strings.";
	}

	if($newStrings > 12){
		$boolvalidateOK = 0;
		$stringMaxValidationMessage = "Guitars with more than 12 strings are unlikely. Contact admin if you found one you want to add.";
	}

	if($newStrings < 4 && $newStrings >=1){
		$boolvalidateOK = 0;
		$stringMinValidationMessage = "Your guitar needs more than 3 strings.";
	}

// validation for price
	if(!preg_match('/^[0-9]+(\.[0-9]{2})?$/',$newPrice)){
		$boolvalidateOK = 0;
		$priceValidationMessage = "Please enter a price in a decimal format (e.g. 10.00).";
	}

// Validation for description
	 if(empty($newDescription)){
		$boolvalidateOK = 0;
		$descriptionNullValidationMessage = "Please enter a description.";
	}

	if(strlen($newDescription) > 5000){
		$boolvalidateOK = 0;
		$descriprionLengthValidationMessage = "Description is too long.";
	}

// Validation for URL
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$newLink)) {
  		$boolvalidateOK = 0;
		$urlValidationMessage = "Please enter a proper URL. (http://www.website.com)";
	}







// IF VALIDATION PASSES

	if($boolvalidateOK == 1){


			mysqli_query($con, "UPDATE guitars SET type = '$newType', brand = '$newBrand', model = '$newModel', bodytype = '$newBodytype', strings = '$newStrings', price = '$newPrice', description = '$newDescription', link = '$newLink' WHERE gid = '$guitar_ID'") or die(mysqli_error($con));

			$ValidationMessage = "Guitar info has been edited.";
			$newType = "";
			$newBrand = "";
			$newModel = "";
			$newBodytype = "";
			$newStrings = "";
			$newPrice = "";
			$newDescription = "";
			$newFilename = "";
			$newLink = "";
		}
		else{
			echo "Upload ERROR";
		}
	}




// PUT ALL GUITARS IN A DROP DOWN LIST

$result = mysqli_query($con,"SELECT * FROM guitars") or die(mysqli_error($con));


		while($row = mysqli_fetch_array($result)){
	
		$model = $row['model'];
		$gid = $row['gid'];

		if ($gid == $guitar_ID) {
		$allOptions .= "\n\t\t\t<option value=\"edit.php?gid=$gid\" selected>$brand $model</option>";
	} else {
		$allOptions .= "\n\t\t\t<option value=\"edit.php?gid=$gid\">$brand $model</option>";
	}
	

}// \ loop


// RETRIEVE DATA FROM SELECTED OPTION
$result2 = mysqli_query($con, "SELECT * FROM guitars WHERE gid = '$guitar_ID'") or die(mysqli_error($con));

while ($row = mysqli_fetch_array($result2)) {
			
	$type = $row['type'];
	$brand = $row['brand'];
	$model = $row['model'];
	$bodytype = $row['bodytype'];
	$strings = $row['strings'];
	$price = $row['price'];
	$description = $row['description'];
	$filename = $row['filename'];
	$link = $row['link'];

}// \ loop

// DELETE
if (isset($_POST['delete'])) {
	//echo "Delete pressed";

	header("Location: delete.php?gid=$gid");

	// test on other page
} /// \if isset delete


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Edit Guitar</title>
 </head>
 <body>

 <h1>Edit Guitar Information</h1>

 <script type="text/javascript">
	function confirm_delete() {
	  return confirm('Guitar information will be deleted.');
	}
</script>

<div class="row">
	<div class="col-md-6">
		<form id="myform" name="myform" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<label for="post">Select Guitar Information: </label>
				<select class="form-control" onchange="location = this.options[this.selectedIndex].value;">
					<?php echo $allOptions ?>
				</select>
			</div>
			<hr/>	

			<div>
				<?php 
					if ($ValidationMessage) {
					echo "<div class=\"alert alert-success\">$ValidationMessage</div>";
					}
			 	?>
			</div>

			
			<?php 

			echo "\n\t<img src=\"display/$filename\" align=\"center\"><br>";

 			?>		

			<div class="form-group">
				<label for="filename">Image:</label>
				<input type="file" name="myfile" value=<?php echo $fileName ?> class="form-control">
			</div>

			<div>
				<?php 

					if ($imageTypeValidationMessage) {
					echo "<div class=\"alert alert-danger\">$imageTypeValidationMessage</div>";
					}

					if ($imageSizeValidationMessage) {
					echo "<div class=\"alert alert-danger\">$imageSizeValidationMessage</div>";
					}
				 ?>
			</div>

		
	</div>
</div>

<div class="row">
			<div class="form-group col-md-6">
				<label for="type">Guitar Type:</label>
				<select name="type" class="form-control">
					<option value="">[Select a Guitar Type]</option>
					<option value="electric" <?php if ($type=="electric") echo'selected="selected"'; ?>>Electric</option>
					<option value="acoustic" <?php if ($type=="acoustic") echo'selected="selected"'; ?>>Acoustic</option>
					<option value="bass" <?php if ($type=="bass") echo'selected="selected"'; ?>>Bass</option>
				</select>
			
				<?php 
					if ($typeValidationMessage) {
					echo "<div class=\"alert alert-danger\">$typeValidationMessage</div>";
					}
				 ?>
			</div>


			<div class="form-group col-md-6">
				<label for="model">Model:</label>
				<input type="text" name="model" class="form-control" value="<?php echo $model ?>">

		
				<?php 
					if ($modelNullValidationMessage) {
					echo "<div class=\"alert alert-danger\">$modelNullValidationMessage</div>";
					}

					if ($modelLengthValidationMessage) {
					echo "<div class=\"alert alert-danger\">$modelLengthValidationMessage</div>";
					}
			 	?>
			</div>
</div>


<div class="row">
			<div class="form-group col-md-6">
				<label for="brand">Brand:</label>
				<input type="text" name="brand" class="form-control" value="<?php echo $brand ?>">



				<?php 
					if ($brandNullValidationMessage) {
					echo "<div class=\"alert alert-danger\">$brandNullValidationMessage</div>";
					}

					if ($brandLengthValidationMessage) {
					echo "<div class=\"alert alert-danger\">$brandLengthValidationMessage</div>";
					}
			 	?>
			</div>

			<div class="form-group col-md-6">
				<label for="bodytype">Guitar Body Type:</label>
				<input type="text" name="bodytype" class="form-control" value="<?php echo $bodytype ?>">

				<?php 
					if ($bodytypeNullValidationMessage) {
					echo "<div class=\"alert alert-danger\">$bodytypeNullValidationMessage</div>";
					}

					if ($bodytypeLengthValidationMessage) {
					echo "<div class=\"alert alert-danger\">$bodytypeLengthValidationMessage</div>";
					}
			 	?>
			</div>
</div>

<div class="row">
			<div class="form-group col-md-6">
				<label for="strings">Number of Strings:</label>
				<input type="text" name="strings" class="form-control" value="<?php echo $strings ?>">



				<?php 
					if ($stringNullValidationMessage) {
					echo "<div class=\"alert alert-danger\">$stringNullValidationMessage</div>";
					}

					if ($stringMaxValidationMessage) {
					echo "<div class=\"alert alert-danger\">$stringMaxValidationMessage</div>";
					}

					if ($stringMinValidationMessage) {
					echo "<div class=\"alert alert-danger\">$stringMinValidationMessage</div>";
					}
			 	?>
			</div>

			<div class="form-group col-md-6">
				<label for="price">Price:</label>
				<input type="text" name="price" class="form-control" value="<?php echo $price ?>">

				<?php 
					

					if ($priceValidationMessage) {
					echo "<div class=\"alert alert-danger\">$priceValidationMessage</div>";
					}
			 	?>
			</div>
</div>

<div class="row">
			<div class="form-group">
				<label for="description">Description:</label>
				<textarea name="description" class="form-control"><?php echo $description ?></textarea>

				<?php 
					if ($descriptionNullValidationMessage) {
					echo "<div class=\"alert alert-danger\">$descriptionNullValidationMessage</div>";
					}

					if ($descriptionLengthValidationMessage) {
					echo "<div class=\"alert alert-danger\">$descriptionLengthValidationMessage</div>";
					}
			 	?>
			</div>
</div>

<div class="row">
			<div class="form-group">
				<label for="link">URL:</label>
				<input type="text" name="link" class="form-control" value="<?php echo $link ?>">

				<?php 


					if ($urlValidationMessage) {
					echo "<div class=\"alert alert-danger\">$urlValidationMessage</div>";
					}
			 	?>
			</div>
</div>

		<div class="form-group">
			<label for="edit">&nbsp;</label>
			<input type="submit" name="edit" class="btn btn-info" value="Edit">

			<label for="delete">&nbsp;</label>
			<input type="submit" name="delete" class="btn btn-info" onclick="return confirm_delete()" value="Delete">
		</div>

			


		</form>
	</div>
</div>
 
 </body>
 </html>