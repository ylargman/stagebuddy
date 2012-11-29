<?
	include("config.php");
	$newName=$_POST['newShowName'];
	
	$playID = $_POST['currPlayID'];
	$query="UPDATE Plays SET name='$newName' WHERE playID LIKE '$playID'";
	print_r(newName);
	
	mysql_query($query);
?>