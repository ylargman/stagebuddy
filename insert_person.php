<?
	include("config.php");
	$personID=uniqid();
	$name=$_POST['newPersonName'];
	$position=$_POST['newPersonPosition'];
	$email=$_POST['newPersonEmail'];
	$phone=$_POST['newPersonPhone'];
	
	$playID = $_POST['currPlayID'];
	
	$query_info = "INSERT INTO PeopleInfo VALUES ('$personID','$name', '$email', '$phone')";
	mysql_query($query_info);
	
	
	$query_pos = "INSERT INTO PeoplePositions VALUES ('$playID', '$personID', '$position')";
	mysql_query($query_pos);
	   						
?>