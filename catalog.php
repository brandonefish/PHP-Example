<!-- the include function is used to include something in other pages so it can be reused
here the header has been included and will be displayed on every page that has this include statement -->
<?php

include ("includes/header.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Guitar Catalog</title>
	
</head>
<body>



<div class="main">



<div class="row">

<div class="well col-md-3">

<h3>Filter Results</h3>

<form action="search.php" method="post">
<div class="form-group">
<input type="text" name="searchterm" class="form-control" style="margin-bottom: 20px; width: 165px; display: inline; margin-right:10px;" value="<?php echo htmlspecialchars($searchterm); ?>">
<!-- The htmlspecialchars function in PHP is used to convert 5 characters into corresponding HTML entities where applicable. It is used to encode user input on a website so that users cannot insert harmful HTML codes into a site.
this is just a protective measure so people can't break stuff with my search bar  -->


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

<!-- this is just some javascript to make my sidebar look nice -->
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
<h1>Guitar Catalog</h1>
<br>
<br>

<?php 



// DEFAULT QUERY RETRIEVE EVERYTHING
// this query will post all results onto the catalog page, retrieving stuff from the database just uses pretty basic
// SQL queries, variables in php are always written with a dollar sign in from of them
// the $con variable refers to the connection to the database, whenever you do an mysqli_query you must put the connection to the database first and then your SQL query second
// or die (mysql_error()) is just saying if the query fails then display an error
// How did I make my connection into a small variable? This involves tracing back a few pages
// this page includes the header, when you go to my header page you will see the header page contains an include statement for mysql_connect.php, this page contains all connection information and you will be able to see where I set the connection as a variable
$result = mysqli_query($con,"SELECT * FROM guitars") or die (mysql_error());

// FILTERING
// to understand these click on some of my filters and see what it says in the link bar
// for example if you select guitar type and the choose electric you will see
// http://bfish1.dmitstudent.ca/dmit2025/Lab8/catalog.php?displayby=type&displayvalue=electric
// the results are displayed by their type with the value of electric 
// play around with other filters and see what the results have to say
// here is a good tutorial to understand what $_GET means https://www.w3schools.com/php/php_forms.asp
$displayby = $_GET['displayby'];
$displayvalue = $_GET['displayvalue'];

if(isset($displayby) && isset($displayvalue)) {
	// HERE IS THE MAGIC: WE TELL OUR DB WHICH COLUMN TO LOOK IN, AND THEN WHICH VALUE FROM THAT COLUMN WE'RE LOOKING FOR
	$result = mysqli_query($con,"SELECT * FROM guitars WHERE $displayby LIKE '$displayvalue' ") or die (mysql_error());	
}

// this is similar to above but it just selects a range of values
$min = $_GET['min'];
$max = $_GET['max'];
if(isset($displayby) && isset($min) && isset($max)){
	$result = mysqli_query($con, "SELECT * from guitars WHERE $displayby BETWEEN '$min' AND '$max' ORDER BY price");
}




// here is a loop to fetch all results and then display them in a div

while ($row = mysqli_fetch_array($result)){
	$brand = $row['brand'];
	$model = $row['model'];
	$filename = $row['filename'];
	$guitar_ID = $row['gid'];


	

	echo "\n<div class=\"col-md-3 item\">";
	echo "\n\t<a href=\"display.php?gid=$guitar_ID\"><img src=\"admin/thumbs/$filename\"></a><br>";
	echo "\n\t$brand $model<br>";
	echo "\n</div>";


// FOR SEARCH


}


 ?>

</div>


 </div>





</body>
</html>



<?php

include ("includes/footer.php");
?>