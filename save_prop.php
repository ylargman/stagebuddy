<?
	include("config.php");
	$note=$_POST['propnotes'];
	$name=$_POST['propname'];

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
	
	$query="UPDATE PropsInfo SET a1s1=$a1s1, a1s2=$a1s2, notes='$note' WHERE name='$name'";
	
	mysql_query($query);
?>