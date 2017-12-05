<?php
	session_start();
	if (isset($_POST['searchsubmit'])) {
	include("connection.php");
	$searchquery = ($_POST['search']);
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
	$sql = "SELECT * FROM blog WHERE (`title` LIKE '%".$searchquery."%')";
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
