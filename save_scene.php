<?
	include("config.php");
	$notes=$_POST['sceneNotes'];
	$location=$_POST['location'];
	$act=$_POST['act'];
	$scene=$_POST['scene'];
	
	$query="UPDATE Scenes SET location='$location', notes='$notes' WHERE act={$act} AND scene={$scene}";
	//$query="UPDATE Scenes SET location='test', notes='test' WHERE act=2";
	mysql_query($query);
	
	$cquery="SELECT * FROM Characters";
	$cresult=mysql_query($cquery);
	$numcrows=mysql_numrows($cresult);
	
	$c=0;
	while($c < $numcrows){
		$cname=mysql_result($cresult, $c, "name");
		$upquery ="";
		if(isset($_POST["a{$act}s{$scene}-$cname"]) ){
			$upquery="UPDATE Characters SET a{$act}s{$scene}=1 WHERE name='$cname'";
		}
		else{
			$upquery="UPDATE Characters SET a{$act}s{$scene}=0 WHERE name='$cname'";
		}
		mysql_query($upquery);
		$c++;
	}
	
	$pquery="SELECT * FROM Props";
	$presult=mysql_query($pquery);
	$numprows=mysql_numrows($presult);
	
	$p=0;
	while($p < $numprows){
		$pname=mysql_result($presult, $p, "name");
		$upquery ="";
		if(isset($_POST["a{$act}s{$scene}-$pname"]) ){
			$upquery="UPDATE Props SET a{$act}s{$scene}=1 WHERE name='$pname'";
		}
		else{
			$upquery="UPDATE Props SET a{$act}s{$scene}=0 WHERE name='$pname'";
		}
		mysql_query($upquery);
		$p++;
	}
?>