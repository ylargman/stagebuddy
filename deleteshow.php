<?
	include("config.php");
	$playID=$_POST['currPlayID'];
	
	$query_ci = "DELETE FROM CharactersInfo WHERE playID LIKE '{$playID}'";
	mysql_query($query_ci);
	
	$query_cs = "DELETE FROM CharactersScenes WHERE playID LIKE '{$playID}'";
	mysql_query($query_cs);
	
	$query_ei = "DELETE FROM ElementsInfo WHERE playID LIKE '{$playID}'";
	mysql_query($query_ei);
	
	$query_es = "DELETE FROM ElementsScenes WHERE playID LIKE '{$playID}'";
	mysql_query($query_es);
	
	$query_p = "DELETE FROM Plays WHERE playID LIKE '{$playID}'";
	mysql_query($query_p);
	
	$query_pi = "DELETE FROM PropsInfo WHERE playID LIKE '{$playID}'";
	mysql_query($query_pi);
	
	$query_ps = "DELETE FROM PropsScenes WHERE playID LIKE '{$playID}'";
	mysql_query($query_ps);
	
	$query_s = "DELETE FROM Scenes WHERE playID LIKE '{$playID}'";
	mysql_query($query_s);
?>