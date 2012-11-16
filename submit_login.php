<?php
session_start();
include("config.php");

$username = mysql_real_escape_string($_POST['username']);
$_SESSION['username'] = $username;
$password = md5(mysql_real_escape_string($_POST['password']));

if (!isset($username) || !isset($password)) {

    header("Location: sorry.html");
    
}

elseif (empty($username) || empty($password)) {
	
    header("Location: sorry.html");
    
} else {
	
    $result   = mysql_query("select * from Users where username='$username' AND password='$password'");
    $rowCheck = mysql_num_rows($result);
	print_r("Test");
    if ($rowCheck > 0) {
        while ($row = mysql_fetch_array($result)) {
			print_r("Test");
            $_SESSION['id'] = $row['username'];
        }
        
        header("Location: index.php");
        
    } else {
        header("Location: sorry.html");
    }
}
?>