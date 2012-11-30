<?
	include("config.php");
	
	$playID = $_POST['currPlayID'];
	$elemIDToSave=$_POST['elemid'];
	
	$name=$_POST['elemname'];
	$note=$_POST['elemnotes'];
	
	$query="UPDATE ElementsInfo SET name='$name', notes='$note' WHERE elementID='$elemIDToSave'";


	$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	$result_as=mysql_query($query_as);
	   						
	$a=1;
	while($a <= 10){
		$numscenes_as=mysql_result($result_as, '0', "act{$a}");
		if($numscenes_as < 1)
	   		break;
	   	$sc=1;
	   	while($sc <=$numscenes_as){
	   		$asid="a{$a}s{$sc}elem{$elemIDToSave}";
	   		$query_find="SELECT * FROM ElementsScenes WHERE elementID LIKE '{$elemIDToSave}' AND act='$a' AND scene='$sc'";
	   		$result_find=mysql_query($query_find);
	   		$numrows_find=mysql_numrows($result_find);
	   		
			if(isset($_POST[$asid]) && $numrows_find < 1){
				$query_scenes="INSERT INTO ElementsScenes VALUES ('$playID', '$elemIDToSave', '$a', '$sc', '')";
				mysql_query($query_scenes);
			}
			else if(!(isset($_POST[$asid])) && $numrows_find > 0){
				$query_scenes="DELETE FROM ElementsScenes WHERE elementID LIKE '{$elemIDToSave}' AND act='$a' AND scene='$sc'";
				mysql_query($query_scenes);
			}
								
			$sc++;
	   	}
	   	$a++;
	}
	
	mysql_query($query);
?>