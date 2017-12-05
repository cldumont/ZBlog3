<?php
    session_start();

    function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
    if (isset($_POST['submit'])) {
        include("connection.php"); //connection.php
        $username = strip_tags($_POST['name']);
        $password = strip_tags($_POST['password']);
        
        $sql = "SELECT id, username, password FROM user WHERE username = '$username' LIMIT 1";
        
        $query = mysqli_query($dbCon, $sql); 
         if ($query) {
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
            $dbUsername = $row[1];
            $dbPassword = $row[2];
           
         }
        if (strtolower($username) == strtolower($dbUsername) && $password == $dbPassword) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userId;
            $_SESSION['timeStamp'] = time();
            header('Location: admin.php');
        } else {
            phpAlert("Incorrect User Name or Password");
        }
    }
    if (isset($_POST['adminsubmit'])) {
        include("connection.php"); //connection.php
        $username = strip_tags($_POST['name']);
        $password = strip_tags($_POST['password']);
        
        $sql = "SELECT id, username, password FROM user WHERE username = '$username' AND admin = '1' LIMIT 1";
        
        $query = mysqli_query($dbCon, $sql); 
         if ($query) {
            $row = mysqli_fetch_row($query); 
            $userId = $row[0];
            $dbUsername = $row[1];
            $dbPassword = $row[2];
           
         }
        if (strtolower($username) == strtolower($dbUsername) && $password == $dbPassword) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $userId;
            $_SESSION['timeStamp'] = time();
            header('Location: userAdmin.php');
        } else {
            phpAlert("Incorrect User Name or Password");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <LINK href="special.css" rel="stylesheet" type="text/css">
        <title>CIS Blog</title>
    </head>
    <body>
    <div class="container">  
    <header class="header">
    <h1>Blog<br>Computer Information Systems</h1>
    <h3>Bristol Community College</h3>
    </header>
    <article class="main">
    <?php
    date_default_timezone_set("America/New_York");
    include_once("connection.php");

    $sql = "SELECT * FROM blog ORDER BY id DESC LIMIT 10";
    $result = mysqli_query($dbCon, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $content = $row['content'];
        $date = date_create($row['date']);
    ?>
         
        <h3><?php echo date_format($date, 'l jS \of F Y h:i:s A'); ?></h3>
        <h2><?php echo $title; ?></h2>
        <p><?php echo $content; ?></p>
        <hr />
        
    <?php
        }
    ?>
    </article>
        <aside class="aside sidebar">
        <hr>
        <strong><p>
        The opinions expressed by the BCC<br>
        Student Bloggers are theirs alone,<br>
        and do not reflect the opinions<br> 
        of Bristol Community College or any<br> 
        faculty member thereof. Bristol<br> 
        Community College is not responsible for<br> 
        the accuracy of any of the information<br>
        supplied by the Student Bloggers.
        </p></strong>
        <hr>
        <h3>Search by Title</h3>
        <form method="post" action="searchresult.php">
            <input type="text" name="search" placeholder="Search" /><br />
            <input type="submit" name="searchsubmit" value="Search" />
        </form>
        <h3>Search by Date</h3>
        <details>
         <summary>Year 2017</summary>
        <form method="post" action="datesearch.php">
            <input type="submit" name="janquery" value="January" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="febquery" value="February" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="marquery" value="March" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="aprquery" value="April" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="mayquery" value="May" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="junquery" value="June" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="julquery" value="July" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="augquery" value="August" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="septquery" value="September" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="octquery" value="October" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="novquery" value="November" />
        </form>
        <form method="post" action="datesearch.php">
            <input type="submit" name="decquery" value="December" />
        </form>
        </details>
        <hr>
        <h3>Login to Post</h3>
        <form method="post" action="index.php">
            <input type="text" name="name" placeholder="User Name" /><br />
            <input type="password" name="password" placeholder="Password" /><br />
            <input type="submit" name="submit" value="Login" />
        </form>
        <hr>
        <h3>Administration Login</h3>
        <form method="post" action="index.php">
            <input type="text" name="name" placeholder="User Name" /><br />
            <input type="password" name="password" placeholder="Password" /><br />
            <input type="submit" name="adminsubmit" value="Login" />
        </form>
        <hr>
        </aside> 
        <footer class="footer">Bristol Community College - 777 Elsbree St - Fall River, Ma</footer>
        </div>
    </body>

</html>