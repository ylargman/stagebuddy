<?
	include("config.php");
	$propIDToDel=$_POST['propid'];
	
	$query_s = "DELETE FROM PropsScenes WHERE propID='$propIDToDel'";
	mysql_query($query_s);
	
	$query_i = "DELETE FROM PropsInfo WHERE propID='$propIDToDel'";
	mysql_query($query_i);
?>