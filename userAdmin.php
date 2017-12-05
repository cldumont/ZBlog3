<?php
    error_reporting(E_ALL & ~E_NOTICE);
    session_start();

    function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}
     if(isset($_SESSION['id'])) {
        $username = $_SESSION['username'];
        $userId = $_SESSION['id'];

        if((time() - $_SESSION['timeStamp']) > 600) {
            header('Location: logout.php');
        }
        $_SESSION['timeStamp'] = time();
        if ($_POST['submitUser']) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $admin = $_POST['admin'];
            include_once("connection.php");
            if($username != "" && $password != ""){
            $sql = "INSERT INTO user (id, username, password, admin) VALUE ('null', '$username', '$password', '$admin')";
            mysqli_query($dbCon, $sql);
            phpAlert("User added.");
        }else{ phpAlert("Please enter the Users Name and Password!");}
            
        }
        if ($_POST['submitEdit']) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $admin = $_POST['admin'];
            include_once("connection.php");
          if($id != ""){
             if($username != "" && $password != "" && $admin != ""){
              $sql = "UPDATE user SET username = '$username', password = '$password', admin = '$admin' Where id = $id";
              mysqli_query($dbCon, $sql);
              phpAlert("User updated.");
             }
             if($username != "" && $password == "" && $admin == ""){
              $sql = "UPDATE user SET username = '$username' Where id = $id";
              mysqli_query($dbCon, $sql);
              phpAlert("User updated.");
             }
             if($username != "" && $password != "" && $admin == ""){
              $sql = "UPDATE user SET username = '$username', password = '$password' Where id = $id";
              mysqli_query($dbCon, $sql);
              phpAlert("User updated.");
             }
             if($password != "" && $username == "" && $admin == ""){
             $sql = "UPDATE user SET password = '$password' Where id = $id";
             mysqli_query($dbCon, $sql);
             phpAlert("User updated.");
             }
             if($password != "" && $username == "" && $admin != ""){
             $sql = "UPDATE user SET password = '$password', admin = '$admin' Where id = $id";
             mysqli_query($dbCon, $sql);
             phpAlert("User updated.");
             }
             if($admin != "" && $username == "" && $password == ""){
             $sql = "UPDATE user SET admin = '$admin' Where id = $id";
             mysqli_query($dbCon, $sql);
             phpAlert("User updated.");
             }
             if($admin != "" && $username != "" && $password == ""){
             $sql = "UPDATE user SET admin = '$admin', username = '$username' Where id = $id";
             mysqli_query($dbCon, $sql);
             phpAlert("User updated.");
            }
             
    }else{ phpAlert("Enter a valid User Id!");}
  
  }  
   if ($_POST['submitDel']) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $admin = $_POST['admin'];
            include_once("connection.php");
          if($id != ""){
             if($username == "" && $password == "" && $admin == ""){
              $sql = "DELETE from user where id = $id";
             mysqli_query($dbCon, $sql);
              phpAlert("User deleted.");
             }
             }else{ phpAlert("Delete Users by only entering a valid User Id!");}
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
    <title>CIS Blog User Administration</title>
</head>
<body>
<div class="container">  

<header class="header">
<h2>Blog<br>Computer Information Systems<br>Bristol Community College</h2>
<h3>User Adminstration Portal</h3>
</header>  
<div class="main"> 
<h1>Welcome, Administrator!</h1>
<h2>Administration Panel</h2>
<h3>Add User</h3>
    <form method="post" action="userAdmin.php">
        <input placeholder="Enter User Name" type="text" name="username" autofocus size="48" /><br />
        <input placeholder="Enter User Password" type="text" name="password" autofocus size="48" /><br />
        <input placeholder="Authority Level Default 0, Admin 1" type="text" name="admin" autofocus size="48"/><br />
        <input type="submit" name="submitUser" value="Add User" />
    </form>
<h3>Edit User</h3>
    <form method="post" action="userAdmin.php">
        <input placeholder="Enter User Id (** Required **)" type="text" name="id" autofocus size="48" /><br />
        <input placeholder="Enter New User Name" type="text" name="username" autofocus size="48" /><br />
        <input placeholder="Enter New User Password" type="text" name="password" autofocus size="48" /><br />
        <input placeholder="Change Authority Level (1 for Admin)" type="text" name="admin" autofocus size="48"/><br />
        <input type="submit" name="submitEdit" value="Edit User" />
        <input type="submit" name="submitDel" value="Delete User" />
    </form>
    <br />
    <a href="logout.php">Main Blog Page</a>
</div>  
<aside class="aside sidebar">
        <table>
        <tr>
        <th>ID #</th>
        <th>User Name</th>
        <th>Admin Level 1</th>
        </tr>
        
 <?php
    include_once("connection.php");

    $sql = "SELECT * FROM user";
    $result = mysqli_query($dbCon, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $id = $row['id'];
        $username = $row['username'];
        $password = $row['password'];
        $admin = $row['admin'];
    ?>
        
        <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $username; ?></td>
        <td><?php echo $admin; ?></td>
        </tr>
        
        
    <?php
        }
    ?>
    </table>
</aside>
<footer class="footer">Bristol Community College - 777 Elsbree St - Fall River, Ma</footer>
</div>
</body>
</html>