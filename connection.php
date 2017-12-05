<?php
$host_name = "db691533539.db.1and1.com";
$database = "db691533539";
$user_name = "dbo691533539";
$password = "hd139227";

$dbCon = mysql_connect($host_name, $user_name, $password, $database);
if (mysql_errno()) {
    die('<p>Failed to connect to MySQL: '.mysql_error().'</p>');
} else {
    echo '<p>Connection to MySQL server successfully established.</p >';
}
?>
