<?
	include("config.php");
	$elemIDToDel=$_POST['elemid'];
	
	$query_s = "DELETE FROM ElementsScenes WHERE elemID='$elemIDToDel'";
	mysql_query($query_s);
	
	$query_i = "DELETE FROM ElementsInfo WHERE elementID='$elemIDToDel'";
	mysql_query($query_i);
?>                                                                                                                                                                                                                                                                 