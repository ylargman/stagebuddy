<?
	include("config.php");
	$name=$_POST['charname'];
	
	$query = "DELETE FROM Characters WHERE name='$name'";
	mysql_query($query);
?>