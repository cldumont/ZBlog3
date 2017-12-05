<?php
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();

function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
	 if(isset($_SESSION['id'])) {
        $username = $_SESSION['username'];
        $userId = $_SESSION['id'];

        if((time() - $_SESSION['timeStamp']) > 900) {
            header('Location: logout.php');
        }
        $_SESSION['timeStamp'] = time();

		if ($_POST['submit']) {
			$title = $_POST['title'];
			$content = $_POST['content'];
			include_once("connection.php");
			if($title != "" && $content != ""){
			$sql = "INSERT INTO blog (title, content) VALUE ('$title', '$content')";
			mysqli_query($dbCon, $sql);
			phpAlert("Entry posted.");
		}else{ phpAlert("Please enter Title and Content!");}
		}
	} else { 
		header('Location: index.php');
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
<LINK href="special.css" rel="stylesheet" type="text/css">
	<title>Post Page</title>
</head>
<body>
<div class="container">  

<header class="header">
<h1>Blog<br>Computer Information Systems</h1>
<h3>Bristol Community College</h3>
</header>  
<div class="main"> 
<h1>Welcome, <?php echo $username; ?>!</h1>
<h2>Enter a Post</h2>
	<form method="post" action="admin.php">
		<input placeholder="Title" type="text" name="title" autofocus size="50" /><br />
		<textarea placeholder="Content" name="content" rows="20" cols="50"></textarea><br />
		<input type="submit" name="submit" value="Post Blog Entry" />
	</form>

	<br />
	<a href="logout.php">Main Blog Page</a>
</div> 
<aside class="aside sidebar">
<strong><p style="font-size:20px">
The posts made to this blog<br> 
will be immediately posted<br>
to the site as soon as the<br> 
'Post Blog Entry' is pressed.<br> 
Please read your entries<br> 
carefully before submitting.<br> 
If something was posted in<br> 
error, please contact the<br> 
local administrator for removal.<br>
<br>Thank you and happy blogging!
</p></strong>
</aside> 
<footer class="footer">Bristol Community College - 777 Elsbree St - Fall River, Ma</footer>
</div>
</body>
</html>