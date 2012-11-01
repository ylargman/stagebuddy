<?
	include("config.php");
	$name=$_POST['newcharname'];
	$actor=$_POST['newActorName'];
	$note=$_POST['newnote'];
	$a1s1 = 1;
	$a1s2 = 1;
	if(isset($_POST['a1s1']) )
	{
		$a1s1=1;
	}
	else
	{
		$a1s1=0;
	}
	
	if(isset($_POST['a1s2']) )
	{
		$a1s2=1;
	}
	else
	{
		$a1s2=0;
	}
	
	$query = "INSERT INTO Characters VALUES ('$name', '$a1s1', '$a1s2', '$actor', '$note')";
	mysql_query($query);
?>