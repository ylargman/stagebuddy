<?
	include("config.php");
	$propID=uniqid();
	$name=$_POST['newpropname'];
	$note=$_POST['newnote'];
	
	$playID = $_POST['currPlayID'];
	
	$query_info = "INSERT INTO PropsInfo VALUES ('$playID', '$propID','$name', '$note')";
	mysql_query($query_info);
	
	
	include("config.php");
	$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	$result_as=mysql_query($query_as);
	   						
	$a=1;
	while($a <= 10){
		$numscenes_as=mysql_result($result_as, '0', "act{$a}");
	   	//print_r($numscenes_as);
		if($numscenes_as < 1)
	   		break;
	   	$sc=1;
	   	while($sc <=$numscenes_as){
	   		$asid="a{$a}s{$sc}";
			if(isset($_POST[$asid])){
				$query_scenes="INSERT INTO PropsScenes VALUES ('$playID', '$propID', '$a', '$sc')";
				mysql_query($query_scenes);
			}
								
			$sc++;
	   	}
	   	$a++;
	}	
?>