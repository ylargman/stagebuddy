<?
	include("config.php");
	$name=$_POST['propname'];
	
	$query = "DELETE FROM Props WHERE name='$name'";
	mysql_query($query);
?>