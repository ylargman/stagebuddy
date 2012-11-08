<?
	include("config.php");
	
	$playID = $_POST['currPlayID'];
	$propIDToSave=$_POST['propid'];
	
	$note=$_POST['propnotes'];
	$name=$_POST['propname'];
	
	$query="UPDATE PropsInfo SET name='$name', notes='$note' WHERE propID='$propIDToSave'";
	
	mysql_query($query);
?>