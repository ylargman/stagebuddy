<?
	include("config.php");
	$notes=$_POST['sceneNotes'];
	$scName=$_POST['scName'];
	$location=$_POST['location'];
	$time=$_POST['time'];
	$act=$_POST['act'];
	$scene=$_POST['scene'];
	$playID=$_POST['currPlayID'];;
	
	$query="UPDATE Scenes SET name='$scName', location='$location', time='$time', notes='$notes' WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}'";
	echo($query);
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
	
	$equery="SELECT * FROM ElementsInfo";
	$eresult=mysql_query($equery);
	$numerows=mysql_numrows($eresult);
	
	$e=0;
	while($e < $numerows){
		$eID=mysql_result($eresult, $e, "elementID");
		
		$easid="a{$act}s{$scene}elem{$eID}";
		$query_es="SELECT * FROM ElementsScenes WHERE elementID LIKE '{$eID}' AND act='$act' AND scene='$scene'";
		$result_es=mysql_query($query_es);
		$numrows_es=mysql_numrows($result_es);

		echo($easid);
		if(isset($_POST[$easid]) && $numrows_es < 1){
			$upquery_e="INSERT INTO ElementsScenes VALUES ('$playID', '$eID', '$act', '$scene', ' ')";
			mysql_query($upquery_e);
			echo($upquery_e);
		}
		else if(!(isset($_POST[$easid])) && $numrows_es > 0){
			$upquery_e="DELETE FROM ElementsScenes WHERE elementID LIKE '{$eID}' AND act='$act' AND scene='$scene'";
			mysql_query($upquery_e);
			echo($upquery_e);
		}		
		
		$e++;
	}
	//echo "finished save_scene"
?>