<?
	include("config.php");
	
	$playID = $_POST['currPlayID'];
	$personIDToSave=$_POST['personid'];
	
	$name=$_POST['personName'];
	$position=$_POST['personPosition'];
	$email=$_POST['personEmail'];
	$phone=$_POST['personPhone'];
	
	$query_i="UPDATE PeopleInfo SET name='$name', email='$email', phone='$phone' WHERE personID LIKE '{$personIDToSave}'";
	mysql_query($query_i);


	$query_s="SELECT * FROM PeoplePositions WHERE playID LIKE '{$playID}' AND personID LIKE '{$personIDToSave}'";
	$result_s=mysql_query($query_s);	
	$numrows_s=mysql_numrows($result_s);
				
	if($numrows_s > 0){
			$query_se="UPDATE PeoplePositions SET position='$position' WHERE personID LIKE '{$personIDToSave}' AND playID LIKE '{$playID}'";
			mysql_query($query_se);
	}			
?>