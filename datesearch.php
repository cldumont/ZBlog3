<?php
	session_start();
	include("connection.php");
	if (isset($_POST['janquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-01-01' and date < '2017-01-31'";
	}
	if (isset($_POST['febquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-02-01' and date < '2017-02-28'";
	}
	if (isset($_POST['marquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-03-01' and date < '2017-03-31'";
	}
	if (isset($_POST['aprquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-04-01' and date < '2017-04-30'";
	}
	if (isset($_POST['mayquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-05-01' and date < '2017-05-31'";
	}
	if (isset($_POST['junquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-06-01' and date < '2017-06-30'";
	}
	if (isset($_POST['julquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-07-01' and date < '2017-07-31'";
	}
	if (isset($_POST['augquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-08-01' and date < '2017-08-31'";
	}
	if (isset($_POST['septquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-09-01' and date < '2017-09-30'";
	}
	if (isset($_POST['octquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-10-01' and date < '2017-10-31'";
	}
	if (isset($_POST['novquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-11-01' and date < '2017-11-30'";
	}
	if (isset($_POST['decquery'])) {
	$sql = "SELECT * FROM blog WHERE date >='2017-12-01' and date < '2017-12-31'";
	}
?>
<!DOCTYPE html>
<html>
<head>
<LINK href="special.css" rel="stylesheet" type="text/css">
	<title>Search Results</title>
</head>
<body>
<div class="container">  

<header class="header">
<h1>Blog<br>Computer Information Systems</h1>
<h3>Bristol Community College</h3>
</header>  
<div class="main"> 
<center><h1>Search Results</h1></center>
<?php
    include_once("connection.php");
	date_default_timezone_set("America/New_York");
	
	$query = mysqli_query($dbCon, $sql); 
         
        while ($row = mysqli_fetch_array($query)) {
        $title = $row[1];
        $content = $row[2];
        $date = date_create($row[3]);
	?>
	<h3><?php echo date_format($date, 'l jS \of F Y h:i:s A'); ?></h3>
    <h2><?php echo $title; ?></h2>
    <p><?php echo $content; ?></p>
    <hr />
	<?php
		 }
?>		 

<a href="logout.php">Main Blog Page</a>
</div>  
<footer class="footer">Bristol Community College - 777 Elsbree St - Fall River, Ma</footer>
</div>
</body>
</html>
