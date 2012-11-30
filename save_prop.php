<?
	include("config.php");
	
	$playID = $_POST['currPlayID'];
	$propIDToSave=$_POST['propid'];
	
	$name=$_POST['propname'];
	$note=$_POST['propnotes'];
	
	$query="UPDATE PropsInfo SET name='$name', notes='$note' WHERE propID='$propIDToSave'";


	$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	$result_as=mysql_query($query_as);
	   						
	$a=1;
	while($a <= 10){
		$numscenes_as=mysql_result($result_as, '0', "act{$a}");
		if($numscenes_as < 1)
	   		break;
	   	$sc=1;
	   	while($sc <=$numscenes_as){
	   		$asid="a{$a}s{$sc}prop{$propIDToSave}";
	   		$query_find="SELECT * FROM PropsScenes WHERE propID LIKE '{$propIDToSave}' AND act='$a' AND scene='$sc'";
	   		$result_find=mysql_query($query_find);
	   		$numrows_find=mysql_numrows($result_find);
	   		
			if(isset($_POST[$asid]) && $numrows_find < 1){
				$query_scenes="INSERT INTO PropsScenes VALUES ('$playID', '$propIDToSave', '$a', '$sc')";
				mysql_query($query_scenes);
			}
			else if(!(isset($_POST[$asid])) && $numrows_find > 0){
				$query_scenes="DELETE FROM PropsScenes WHERE propID LIKE '{$propIDToSave}' AND act='$a' AND scene='$sc'";
				mysql_query($query_scenes);
			}
								
			$sc++;
	   	}
	   	$a++;
	}
	
	mysql_query($query);
?>