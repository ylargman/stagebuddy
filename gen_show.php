<?
	include("config.php");
	$playID=uniqid();
	$playTitle =$_POST['showTitle'];
	$numActs = $_POST['numActs'];
	
	print_r($playID);
	$query_info = "INSERT INTO Plays VALUES ('$playTitle', '$playID', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
	mysql_query($query_info);
	
	$a=1;
	while($a <= $numActs){
		$astr = strval($a);
		$numsc = $_POST["act{$astr}NumScenes"];
		$act_query = "UPDATE Plays SET act{$a}=$numsc WHERE playID LIKE '$playID'";
		mysql_query($act_query);
		$a++;
	}
?>