<?php 

// IMAGE RESIZING 100 by 319 for thumbnail 212 by 675 for display



include ("../includes/header.php");
include ("../includes/functions.php");



//Check session
	session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI']; 
if (!isset($_SESSION['guitarsession'])) {
	header("Location:../login.php");
}// \\check session



// isset
if(isset($_POST['submit'])){
	$type = strip_tags(trim($_POST['type']));
	$model = strip_tags(trim($_POST['model']));
	$brand = strip_tags(trim($_POST['brand']));
	$bodytype = strip_tags(trim($_POST['bodytype']));
	$strings = strip_tags(trim($_POST['strings']));
	$price = strip_tags(trim($_POST['price']));
	$description = strip_tags(trim($_POST['description']));
	$link = strip_tags(trim($_POST['link']));
	$filename = strip_tags(trim($_POST['filename']));

	$boolvalidateOK = 1;

// Validation for image
	//Type
	$types = array('image/jpeg', 'image/jpg', 'image/png');
	if(!in_array($_FILES['myfile']['type'], $types)){
		$boolvalidateOK = 0;
		$imageTypeValidationMessage = "Please upload a JPEG or PNG image.";
	}

	//Size
	if($_FILES['myfile']['size'] > 10000000){
		$boolvalidateOK = 0;
		$imageSizeValidationMessage = "File is too large. Must be less than 10MB.";
	}


// Validation for guitar type
	if($type == ""){
		$boolvalidateOK = 0;
		$typeValidationMessage = "Please select a guitar type.";
	}

// Validation for Model
	if(empty($model)){
		$boolvalidateOK = 0;
		$modelNullValidationMessage = "Please enter a model name.";
	}

	if(strlen($model) > 150){
		$boolvalidateOK = 0;
		$modelLengthValidationMessage = "Model name cannot exceed 150 characters.";
	}

// Validation for Brand
	if(empty($brand)){
		$boolvalidateOK = 0;
		$brandNullValidationMessage = "Please enter a brand name.";
	}

	if(strlen($brand) > 100){
		$boolvalidateOK = 0;
		$brandLengthValidationMessage = "Brand name cannot exceed 100 characters.";
	}

// Validation for body type
	if(empty($bodytype)){
		$boolvalidateOK = 0;
		$bodytypeNullValidationMessage = "Please describe the body type.";
	}

	if(strlen($bodytype) > 100){
		$boolvalidateOK = 0;
		$bodytypeLengthValidationMessage = "Body type cannot exceed 100 characters.";
	}

// Validation for strings
	if(empty($strings)){
		$boolvalidateOK = 0;
		$stringNullValidationMessage = "Please enter number of strings.";
	}

	if($strings > 12){
		$boolvalidateOK = 0;
		$stringMaxValidationMessage = "Guitars with more than 12 strings are unlikely. Contact admin if you found one you want to add.";
	}

	if($strings < 4 && $strings >=1){
		$boolvalidateOK = 0;
		$stringMinValidationMessage = "Your guitar needs more than 3 strings.";
	}

// validation for price

	if(!preg_match('/^[0-9]+(\.[0-9]{2})?$/',$price)){
		$boolvalidateOK = 0;
		$priceValidationMessage = "Please enter a price in a decimal format (e.g. 10.00).";
	}

// Validation for description
	 if(empty($description)){
		$boolvalidateOK = 0;
		$descriptionNullValidationMessage = "Please enter a description.";
	}

	if(strlen($description) > 5000){
		$boolvalidateOK = 0;
		$descriprionLengthValidationMessage = "Description is too long.";
	}

// Validation for URL
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$link)) {
  		$boolvalidateOK = 0;
		$urlValidationMessage = "Please enter a proper URL. (http://www.website.com)";
	}

// IF VALIDATION PASSES
if($boolvalidateOK == 1 && ($_FILES['myfile']['type'] == "image/jpeg")){
		if(move_uploaded_file($_FILES['myfile']['tmp_name'], "originals/" . $_FILES['myfile']['name'])){

			$thisFile = "originals/" . $_FILES['myfile']['name'];


			resizeImage($thisFile, "thumbs/", 300); 

			resizeImage($thisFile, "display/", 700); 


			$fileName = $_FILES['myfile']['name'];


			mysqli_query($con, "INSERT INTO guitars (type, brand, model, bodytype, strings, price, description, filename, link) VALUES ('$type', '$brand', '$model', '$bodytype', '$strings', '$price', '$description', '$fileName', '$link')") or die(mysqli_error($con));

			$ValidationMessage = "Guitar info has been uploaded.";
			$type = "";
			$brand = "";
			$model = "";
			$bodytype = "";
			$strings = "";
			$price = "";
			$description = "";
			$fileName = "";
			$link = "";
		}
		else{
			echo "Upload ERROR";
		}
	}

if($boolvalidateOK == 1 && ($_FILES['myfile']['type'] == "image/png")){
		if(move_uploaded_file($_FILES['myfile']['tmp_name'], "originals/" . $_FILES['myfile']['name'])){

			$thisFile = "originals/" . $_FILES['myfile']['name'];


			resizeImagePNG($thisFile, "thumbs/", 300); 

			resizeImagePNG($thisFile, "display/", 700); 


			$fileName = $_FILES['myfile']['name'];


			mysqli_query($con, "INSERT INTO guitars (type, brand, model, bodytype, strings, price, description, filename, link) VALUES ('$type', '$brand', '$model', '$bodytype', '$strings', '$price', '$description', '$fileName', '$link')") or die(mysqli_error($con));

			$ValidationMessage = "Guitar info has been uploaded.";
			$type = "";
			$brand = "";
			$model = "";
			$bodytype = "";
			$strings = "";
			$price = "";
			$description = "";
			$fileName = "";
			$link = "";
		}
		else{
			echo "Upload ERROR";
		}
	}


} // \\isset

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Insert New Guitar</title>
 </head>
 <body>
 
<h1>Insert New Guitar</h1>

<div>
				<?php 
					if ($ValidationMessage) {
					echo "<div class=\"alert alert-success\">$ValidationMessage</div>";
					}
			 	?>
			</div>

<div class="row">
	<div class="col-md-6">
		<form id="myform" name="myform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

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
				<input type="text" name="model" class="form-control" value=<?php echo $model ?>>

		
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
				<input type="text" name="brand" class="form-control" value=<?php echo $brand ?>>



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
				<input type="text" name="bodytype" class="form-control" value=<?php echo $bodytype ?>>

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
				<input type="text" name="strings" class="form-control" value=<?php echo $strings ?>>



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
				<input type="text" name="price" class="form-control" value=<?php echo $price ?>>

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
				<input type="text" name="link" class="form-control" value=<?php echo $link ?>>

				<?php 


					if ($urlValidationMessage) {
					echo "<div class=\"alert alert-danger\">$urlValidationMessage</div>";
					}
			 	?>
			</div>
</div>

			<div class="form-group">
				<label for="submit">&nbsp;</label>
				<input type="submit" name="submit" class="btn btn-info" value="Submit">
			</div>

			


		</form>
	</div>
</div>




 </body>
 </html>