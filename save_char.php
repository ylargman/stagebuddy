<?
	include("config.php");
	
	$playID = $_POST['currPlayID'];
	$charIDToSave=$_POST['charid'];
	
	$note=$_POST['charnotes'];
	$actor=$_POST['actorname'];
	
	$query="UPDATE CharactersInfo SET actor='$actor', notes='$note' WHERE charID='$charIDToSave'";


	$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	$result_as=mysql_query($query_as);
	   						
	$a=1;
	while($a <= 10){
		$numscenes_as=mysql_result($result_as, '0', "act{$a}");
		if($numscenes_as < 1)
	   		break;
	   	$sc=1;
	   	while($sc <=$numscenes_as){
	   		$asid="a{$a}s{$sc}char{$charIDToSave}";
	   		$query_find="SELECT * FROM CharactersScenes WHERE charID LIKE '{$charIDToSave}' AND act='$a' AND scene='$sc'";
	   		$result_find=mysql_query($query_find);
	   		$numrows_find=mysql_numrows($result_find);
	   		
			if(isset($_POST[$asid]) && $numrows_find < 1){
				$query_scenes="INSERT INTO CharactersScenes VALUES ('$playID', '$charIDToSave', '$a', '$sc')";
				mysql_query($query_scenes);
			}
			else if(!(isset($_POST[$asid])) && $numrows_find > 0){
				$query_scenes="DELETE FROM PropsScenes WHERE characterID LIKE '{$charIDToSave}' AND act='$a' AND scene='$sc'";
				mysql_query($query_scenes);
			}
								
			$sc++;
	   	}
	   	$a++;
	}
	
	mysql_query($query);
?>