<?
	include("config.php");
	$note=$_POST['charnotes'];
	$name=$_POST['charname'];
	$actor=$_POST['actorname'];

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
	
	$query="UPDATE Characters SET a1s1=$a1s1, a1s2=$a1s2, actor='$actor', notes='$note' WHERE name='$name'";
	
	mysql_query($query);
?>