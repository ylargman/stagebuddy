<?
	include("config.php");
	$charIDToDel=$_POST['charid'];
	
	$query_s = "DELETE FROM CharactersScenes WHERE characterID='$charIDToDel'";
	mysql_query($query_s);
	
	$query_i = "DELETE FROM CharactersInfo WHERE characterID='$charIDToDel'";
	mysql_query($query_i);
?>