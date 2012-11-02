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
     		<a href="acts_view.php" data-role="button">
     		View</a>

     		<a href="acts_edit.php" data-role="button" class="ui-btn-active">
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
								<li><a class="selectedact_edit">Act <?php echo $b?></a></li>
						<?php
							}
							$b++;
						}
						$a++;
					}
					?>
			</ul>
		</div><!-- /navbar -->
		
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
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
			
			<div data-role="collapsible" data-collapsed="false">
				<h3><?php echo $act ?>.<?php echo $scene ?></h3>
				<label for="location">Location:</label>

				<input type="text" name="name" id="location" value="<?php echo $location ?>"  />
				
				Timer: <?php echo $time ?>
				<a href="acts_edit.html" id="stopwatch" data-role="button" data-icon="custom" data-inline="true">Timer</a>
				
				<div data-role="fieldcontain">
					<fieldset data-role="controlgroup">
						<legend>Characters:</legend>
						<?php
						include("config.php");
				
						$query_c="SELECT * FROM Characters WHERE a{$act}s{$scene}=1";
						$result_c=mysql_query($query_c);
						$numrows_c=mysql_numrows($result_c);
			
						$n=0;
						while($n < $numrows_c){
						$pname=mysql_result($result_c, $n, "name");
						$charid="a{$act}s{$scene}char{$i}";
						?>
						<input type="checkbox" name="character<?php echo $charid ?>" id="<?php echo $charid ?>" class="custom" />
						<label for="<?php echo $charid ?>"><?php echo $pname ?></label>
						<?php
						$n++;
						}
						?>
					</fieldset>
					<p></p>
					<fieldset data-role="controlgroup">
						<legend>Props:</legend>
						<input type="checkbox" name="prop1" id="prop1" class="custom" />
						<label for="prop1">feather duster</label>
						
						<input type="checkbox" name="prop2" id="prop2" class="custom" />
						<label for="prop2">packages</label>
					</fieldset>
					
					<p></p>
					<label for="textarea-a">Notes:</label>
					<textarea name="textarea" id="textarea-a">
					<?php echo $notes ?>
					</textarea>
				</div>
			</div>
			
			<?php
			$i++;
			}
			?>
							
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