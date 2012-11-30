<?
	include("config.php");
	$personIDToDel=$_POST['personid'];
	
	$query_i = "DELETE FROM PeopleInfo WHERE personID='$personIDToDel'";
	mysql_query($query_i);
	
	$query_s = "DELETE FROM PeoplePositions WHERE personID='$personIDToDel'";
	mysql_query($query_s);
?>