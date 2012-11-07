<?
	include("config.php");
	$propID=uniqid();
	$name=$_POST['newpropname'];
	$note=$_POST['newnote'];
	
	$query_info = "INSERT INTO PropsInfo VALUES ('0', '$propID','$name', '$note')";
	mysql_query($query_info);
	
	
	include("config.php");
	$query_as="SELECT * FROM Plays WHERE playID LIKE '0'";
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
				$query_scenes="INSERT INTO PropsScenes VALUES ('0', '$propID', '$a', '$sc')";
				mysql_query($query_scenes);
				print_r("Insert attempt");
			}
								
			$sc++;
	   	}
	   	$a++;
	}	
	
	
	print_r($_POST);
	print_r($_GET);
?>