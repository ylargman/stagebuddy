<?
	include("config.php");

	$playID = $_POST['currPlayID'];

	$act=1;
	while($act <=10){
		$curVal = intval($_POST["a{$act}CurNumScenes"]);
		$newVal = intval($_POST["a{$act}NumScenes"]);
		if($curVal != $newVal){
			$query_num="UPDATE Plays SET act{$act}='$newVal' WHERE playID LIKE '$playID'";
			mysql_query($query_num);
			
			if($newVal > $curVal){
				$scene=$curVal + 1;
				while($scene <= $newVal) {
					$query_newscene = "INSERT INTO Scenes VALUES ('$playID', '$act', '$scene', ' ', ' ', ' ', ' ')";
					mysql_query($query_newscene);
					$scene++;		
				} 
			}
			
			if($newVal < $curVal){
				$query_c = "DELETE FROM CharactersScenes WHERE act={$act} AND scene > {$newVal}";
				$query_p = "DELETE FROM ElementsScenes WHERE act={$act} AND scene > {$newVal}";
				$query_e = "DELETE FROM PropsScenes WHERE act={$act} AND scene > {$newVal}";
				$query_s = "DELETE FROM Scenes WHERE playID='{$playID}' AND act={$act} AND scene > {$newVal}";
				mysql_query($query_c);
				mysql_query($query_p);
				mysql_query($query_e);
				mysql_query($query_s);
			}
		}
		$act++;
	}
	
	
	mysql_query($query);
?>