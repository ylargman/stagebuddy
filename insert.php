<?
	include("config.php");
	$name=$_POST['newpropname'];
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
	
	$query = "INSERT INTO Props VALUES ('$name', '$a1s1', '$a1s2', '$note')";
	mysql_query($query);
?>