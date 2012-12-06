<?php
session_save_path('/afs/ir.stanford.edu/users/s/k/skyguy/cgi-bin/stagebuddy_temp/temp');
session_start();
include("config.php");
$loggedin = 1;

if (empty($_SESSION['id'])) {

	$username = mysql_real_escape_string($_POST['username']);
	$password = md5(mysql_real_escape_string($_POST['password']));

	if (!isset($username) || !isset($password)) {

		$loggedin = 0;
	}

	elseif (empty($username) || empty($password)) {
		$loggedin = 0;
		
	}
	else {
		
		$result   = mysql_query("SELECT * FROM Users WHERE username LIKE '{$username}' AND password LIKE '{$password}'");
		$rowCheck = mysql_num_rows($result);
		print_r("Test");
		if ($rowCheck > 0) {
			while ($row = mysql_fetch_array($result)) {
				print_r("Test");
				$_SESSION['id'] = $row['id'];
				$_SESSION['username'] = $username;
			}
			
		} 
		else{
			$loggedin = 0;
		}
	}
}
if(strlen($_SESSION['id'])==0){
	$loggin=0;
}
?>

<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css">
	
	<link rel="apple-touch-icon" href="StageBuddyHighResIcon.png" />
	<link rel="apple-touch-startup-image" href="StageBuddyHighResLaunchImage.png" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="jscript.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	
//	<style type="text/css">
//		body {
//    		background: url(StageBuddyLowResBackground.png);
//   			background-repeat:repeat-y;
//    		background-position:center center;
//    		background-attachment:scroll;
//    		background-size:100% 100%;
//		}
//		.ui-page {
//    		background: transparent;
//		}
//		.ui-content{
//    		background: transparent;
//		}
//	</style>
</head> 

<body> 

<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="content">
		<?php
		if($loggedin != 0){
		?>
	
		<div class="ui-grid-b">
			<div class="ui-block-a">
				<img src="Logo.png"/>
				<h2>Welcome <?php echo $_SESSION['username'] ?> </h2>
			</div>
			<div class="ui-block-b"></div>
			<div class="ui-block-c">
				<form action="submit.php" method="post">
					<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     				<a href="index.php" data-role="button" class="ui-btn-active">
     				Access</a>
					<a href="manageshows.php" data-role="button">
     				Manage</a>
					</fieldset>
				</form>
			</div>
			
			<div class="ui-block-a">
				<a href="createshow.php" data-role="button"><img src="Plus-sign.png"/><br>+ New Show <br></a>
			</div>
		
		<?php
			include("config.php");
			$userID = $_SESSION['id'];
			$query="SELECT * FROM Plays WHERE userID='$userID'";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$p=0;
			while($p < $numrows){
				$name=mysql_result($result, $p, "name");
				$playid=mysql_result($result, $p, "playID");
				?>
				<div class="ui-block-b">
					<a href="acts_view.php?playID=<?php echo $playid ?>" data-role="button" class="playbutton" id=<?php echo $playid?>><img src="playcover.png"/><br><?php echo $name ?><br></a>
				</div>
				<?php
				$p++;	
			}
		?>
		</div>
		<?php
		}
		else{
			echo "Incorrect login credentials {$username}.  Click Change User to try again.";
		}
		?>
		<a href="login.php" data-role="button" data-ajax="false">Change User</a>
	</div><!-- /content -->
	
</div><!-- /page -->

</body>
</html>