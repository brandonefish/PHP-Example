<?php 

include ("includes/header.php");



 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Search Results</title>
 </head>
 <body>
 <div class="row">

 <div class="well col-md-3">

<h3>Filter Results</h3>

<form action="search.php" method="post">
<div class="form-group">
<input type="text" name="searchterm" class="form-control" style="margin-bottom: 20px; width: 165px; display: inline; margin-right:10px;" value="<?php echo htmlspecialchars($searchterm); ?>">



<input type="submit" name="submit" class="btn btn-info" value="Search">
</div>

</form>


<button class="accordion">Guitar Type</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=type&displayvalue=electric">Electric</a></li>
			<li><a href="catalog.php?displayby=type&displayvalue=acoustic">Acoustic</a></li>
			<li><a href="catalog.php?displayby=type&displayvalue=bass">Bass</a></li>
		</ul>
	</div>

<button class="accordion">Brand</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=brand&displayvalue=Fender">Fender</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Gibson">Gibson</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Martin">Martin</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Takamine">Takamine</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Seagull">Seagull</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Taylor">Taylor</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Squier">Squier</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Ibanez">Ibanez</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Gretsch">Gretsch</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Rickenbacker">Rickenbacker</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=PRS">PRS</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Dean">Dean</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=Jackson">Jackson</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=BC Rich">BC Rich</a></li>
			<li><a href="catalog.php?displayby=brand&displayvalue=ESP">ESP</a></li>
		</ul>
	</div>

<button class="accordion">Electric Body Type</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Solid">Solid</a></li>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Semi-Hollow">Semi-Hollow</a></li>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Hollow">Hollow</a></li>
		</ul>
	</div>

<button class="accordion">Acoustic Size</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Dreadnought">Dreadnought</a></li>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Grand Symphone">Grand Symphony</a></li>
		</ul>
	</div>

<button class="accordion">Bass Length</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Short Scale">Short Scale</a></li>
			<li><a href="catalog.php?displayby=bodytype&displayvalue=Long Scale">Long Scale</a></li>
		</ul>
	</div>

<button class="accordion">Number of Strings</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=strings&displayvalue=4">4</a></li>
			<li><a href="catalog.php?displayby=strings&displayvalue=5">5</a></li>
			<li><a href="catalog.php?displayby=strings&displayvalue=6">6</a></li>
			<li><a href="catalog.php?displayby=strings&displayvalue=7">7</a></li>
			<li><a href="catalog.php?displayby=strings&displayvalue=8">8</a></li>
			<li><a href="catalog.php?displayby=strings&displayvalue=12">12</a></li>
		</ul>
	</div>

<button class="accordion">Price</button>
	<div class="panel">
		<ul>
			<li><a href="catalog.php?displayby=price&min=0&max=300">$0 - $300</a></li>
			<li><a href="catalog.php?displayby=price&min=300&max=500">$300- $500</a></li>
			<li><a href="catalog.php?displayby=price&min=500&max=800">$500 - $800</a></li>
			<li><a href="catalog.php?displayby=price&min=800&max=1000">$800 - $1000</a></li>
			<li><a href="catalog.php?displayby=price&min=1000&max=1500">$1000 - $1500</a></li>
			<li><a href="catalog.php?displayby=price&min=1500&max=3000">$1500 - $3000</a></li>
			<li><a href="catalog.php?displayby=price&min=3000&max=10000">$3000+</a></li>
		</ul>
	</div>

</div>

<script>
	var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}
</script>

<div class="col-md-9">
<h1>Search Results</h1>

<?php 

if (isset($_POST['submit'])){


	$searchterm = trim($_POST['searchterm']);

	if($searchterm != ""){

	// some different syntax
		$searchterm = $_POST['searchterm'];
		echo "<p>Search for \"$searchterm\"</p>";
		$sql = "SELECT * FROM guitars WHERE model LIKE '$searchterm'
		OR description LIKE '%$searchterm%' OR brand LIKE '$searchterm' OR type LIKE '$searchterm'
		";

		$result = mysqli_query($con, $sql) or die(mysqli_error($con));
				

	if(mysqli_num_rows($result) > 0){ // did we get any search results

		/*echo 'YES';*/
		while($row = mysqli_fetch_array($result)){
	
		$brand = $row['brand'];
	$model = $row['model'];
	$filename = $row['filename'];
	$guitar_ID = $row['gid'];


	

	echo "\n<div class=\"col-md-3 item\">";
	echo "\n\t<a href=\"display.php?gid=$guitar_ID\"><img src=\"admin/thumbs/$filename\"></a><br>";
	echo "\n\t$brand $model<br>";
	echo "\n</div>";




		}// \ loop


	}
	else{
		echo "<p>Your search did not yield any results</p>";
	}

}// \ if post is null

} // \submit


 ?>
 <div>

 </body>
 </html>