<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="actnav.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page">

	<div data-role="header" data-position="fixed">
		<a href="index.html" data-icon="grid">Home</a>
		
		<h1>Acts</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="acts_view.php" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="acts_edit.php" data-role="button">
     		Edit</a>
			</fieldset>
		</form>

		<div data-role="navbar">
			<ul>
				<?php
					include("config.php");
					$query_a="SELECT * FROM Plays";
					$result_a=mysql_query($query_a);
					$numrows_a=mysql_numrows($result_a);
			
					$a=0;
					while($a < $numrows_a){
			
						$name=mysql_result($result_a, $a, "name");
					
						$b = 1;
						while($b <= 10){
							$numscenes_a=mysql_result($result_a, $a, "act{$b}");
							if ($numscenes_a > 0){
								?>
								<li><a class="selectedact">Act <?php echo $b?></a></li>
						<?php
							}
							$b++;
						}
						$a++;
					}
					?>
			</ul>
		</div><!-- /navbar -->
		
		<div class="ui-grid-d">
			<div class="ui-block-a">
				<h2>Scene</h2>
			</div>
			<div class="ui-block-b">
				<h2>Location</h2>		
			</div>
			<div class="ui-block-c">
				<h2>Characters</h2>	
			</div>
			<div class="ui-block-d">
				<h2>Props</h2>	
			</div>
			<div class="ui-block-e">
				<h2>Notes</h2>	
			</div>
		
		<?php
			include("config.php");
			
			if(isset($_POST['actnum'])){
				$actnum=$_POST['actnum'];
			}else{
				$actnum=1;	
			}
			
			$query="SELECT * FROM Scenes WHERE act={$actnum}";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$act=mysql_result($result, $i, "act");
			$scene=mysql_result($result, $i, "scene");
			$location=mysql_result($result, $i, "location");
			$time=mysql_result($result, $i, "time");
			$notes=mysql_result($result, $i, "notes");
			?>
		
			<div class="ui-block-a">
				<h1><?php echo $act?>.<?php echo $scene?></h1>
			</div>
			<div class="ui-block-b">STUFF
				<?php 
				echo $location;
				echo $_POST['actnum'];
				?></div>
			<div class="ui-block-c">
				<?php
						include("config.php");
				
						$query_c="SELECT * FROM Characters WHERE a{$act}s{$scene}=1";
						$result_c=mysql_query($query_c);
						$numrows_c=mysql_numrows($result_c);
			
						$n=0;
						while($n < $numrows_c){
							$cname=mysql_result($result_c, $n, "name");
							echo $cname;
							echo "<br>";
							$n++;
						}
				?>			
			</div>
			<div class="ui-block-d">
				<?php
						include("config.php");
				
						$query_p="SELECT * FROM Props WHERE a{$act}s{$scene}=1";
						$result_p=mysql_query($query_p);
						$numrows_p=mysql_numrows($result_p);
			
						$x=0;
						while($x < $numrows_p){
							$pname=mysql_result($result_p, $x, "name");
							echo $pname;
							echo "<br>";
							$x++;
						}
				?>	
			</div>
			<div class="ui-block-e"><?php echo $notes ?></div>
			
			<?php
			$i++;
			}
			?>

		</div><!-- /grid-d -->
		
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters_view.php" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php" id="props" data-icon="custom">Props</a></li>
			<li><a href="scheduler.html" id="scheduler" data-icon="custom">Scheduler</a></li>
		</ul>
		</div>
	</div>
</div><!-- /page -->

</body>
</html>