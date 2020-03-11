<?php 

include ("includes/header.php");

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<title>Fish Guitars</title>
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
<h1>Project Overview</h1>
<p>This project will catalog some of my favorite guitars. This catalog will list various electric, acoustic, and bass guitars. The guitars will be cataloged by various different attributes such as the brand (Fender, Gibson, etc.), model name, body type (solid, semi-hollow, hollow, dreadnought, classical, etc.), and number of strings. All guitars will have an image and a short description explaining its make, hardware, and other interesting information. The guitars will have a various range of prices so users can search for less expensive budget guitars to high end expensive guitars.</p>
<br>
<p>
The home page will display a sidebar that will allow users to filter guitars by their preferred search options. There will also be a login section for administrators. This project, along with cataloging items, will also have admin pages to add, edit, and delete new guitars. The home page will show a display of thumbnails and details based on search results and when the user clicks a thumbnails, will be directed to a more in depth details page for that product. The details page will also display a link to the manufacturers website for more information.</p>
<br>
<p>
Special Features:
<ul>
	<li>Ability to insert JPG and PNG images.</li>
	<li>jQuery zoom function on images on display page</li>
</ul>
</p>
</div>

 </body>
 </html>