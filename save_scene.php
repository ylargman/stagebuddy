<?
	include("config.php");
	$notes=$_POST['sceneNotes'];
	$location=$_POST['location'];
	$time=$_POST['time'];
	$act=$_POST['act'];
	$scene=$_POST['scene'];
	$playID=$_POST['currPlayID'];;
	
	$query="UPDATE Scenes SET location='$location', time='$time', notes='$notes' WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}'";
	print_r($query);
	mysql_query($query);
	
	$cquery="SELECT * FROM CharactersInfo";
	$cresult=mysql_query($cquery);
	$numcrows=mysql_numrows($cresult);
	
	$c=0;
	while($c < $numcrows){
		$cID=mysql_result($cresult, $c, "characterID");
		
		$query_cs = "SELECT * FROM CharactersScenes WHERE playID LIKE '{$playID}' AND act=$act AND scene=$scene AND characterID LIKE '{$cID}'";
		$results_cs = mysql_query($query_cs);
		$numrows_cs=mysql_numrows($results_cs);
		
		if($numrows_cs ==0 && isset($_POST["a{$act}s{$scene}char{$cID}"]) ){
			$upquery_c="INSERT INTO CharactersScenes VALUES ('$playID', '$cID', $act, $scene)";
			mysql_query($upquery_c);
			//$upquery="UPDATE Props SET a{$act}s{$scene}=1 WHERE name='$pname'";
		}
		else if($numrows_cs > 0 && (!isset($_POST["a{$act}s{$scene}char{$cID}"] )) ){
			$upquery_c="DELETE FROM CharactersScenes WHERE playID LIKE '{$playID}' AND characterID LIKE '{$cID}' AND act=$act AND scene=$scene" ;
			mysql_query($upquery_c);
			//$upquery="UPDATE Props SET a{$act}s{$scene}=0 WHERE name='$pname'";
		}		
		
		$c++;
	}
	
	$pquery="SELECT * FROM PropsInfo";
	$presult=mysql_query($pquery);
	$numprows=mysql_numrows($presult);
	
	$p=0;
	while($p < $numprows){
		$pID=mysql_result($presult, $p, "propID");
		$upquery ="";
		
		$pasid="a{$act}s{$scene}prop{$pID}";
		$query_ps="SELECT * FROM PropsScenes WHERE propID LIKE '{$pID}' AND act='$act' AND scene='$scene'";
	   		$result_ps=mysql_query($query_ps);
	   		$numrows_ps=mysql_numrows($result_ps);
	   		
			if(isset($_POST[$pasid]) && $numrows_ps < 1){
				$upquery_p="INSERT INTO PropsScenes VALUES ('$playID', '$pID', '$act', '$scene')";
				mysql_query($upquery_p);
			}
			else if(!(isset($_POST[$pasid])) && $numrows_ps > 0){
				$upquery_p="DELETE FROM PropsScenes WHERE propID LIKE '{$pID}' AND act='$act' AND scene='$scene'";
				mysql_query($upquery_p);
			}		
		
		$p++;
	}
	//echo "finished save_scene"
?>