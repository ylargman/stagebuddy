<!DOCTYPE html> 
<html> 
<head> 
	<script src="//cdn.optimizely.com/js/141933355.js"></script>
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page" data-theme="b" data-content-theme="b">

	<div data-role="header" data-position="fixed">
		<a href="index.php" data-icon="grid">Home</a>
		<a href="login.php" data-icon="gear" data-ajax="false">Change User</a>
		<h1>
		<?php
			include("config.php");
			$playID = $_GET['playID'];
			
			$query_i="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
			$result_i=mysql_query($query_i);
			$numrows_i=mysql_numrows($result_i);
			
			$name=mysql_result($result_i, '0', "name");
			echo $name;
		?>
		</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="acts_view.php?playID=<?php echo $playID?>" data-role="button">
     		View</a>

     		<a href="acts_edit.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>

		<div data-role="navbar">
			<ul>
				<?php
					include("config.php");
					
					if(isset($_GET['actnum'])){
						$actnum=$_GET['actnum'];
					}else{
						$actnum=1;	
					}
				
					$query_a="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
					$result_a=mysql_query($query_a);
					$numrows_a=mysql_numrows($result_a);
			
					$a=0;
					while($a < $numrows_a){
			
						$name=mysql_result($result_a, $a, "name");
					
						$b = 1;
						while($b <= 10){
							$numscenes_a=mysql_result($result_a, $a, "act{$b}");
							if ($numscenes_a > 0){
								if ($b == $actnum) {
								?>
									<li><a href="acts_edit.php?playID=<?php echo $playID?>&actnum=<?php echo $b?>" class="ui-btn-active">Act <?php echo $b?></a></li>
								<?php
								} else {
								?>
									<li><a href="acts_edit.php?playID=<?php echo $playID?>&actnum=<?php echo $b?>">Act <?php echo $b?></a></li>
						<?php
								}
							}
							$b++;
						}
						$a++;
					}
					?>
			</ul>
		</div><!-- /navbar -->
		
		<p>
		</p>
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<ul data-role="listview" data-filter="true" id="outer-ul">
			<?php
			include("config.php");
			
			$query="SELECT * FROM Scenes WHERE act={$actnum} AND playID LIKE '{$playID}' ORDER BY scene";
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
			
			<li>
			<div data-role="collapsible" class="sceneCollapsible" data-collapsed="true">
			
				<h3><div class="sceneName"><?php echo $act ?>.<?php echo $scene ?></div></h3>
				
				<a data-role="button" data-inline="true" class="savescene">Save</a>

				<form class="curSceneForm">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
								
				<label for="location">Location:</label>

				<input type="text" name="location" id="location" value="<?php echo $location ?>"  />
				
				<label for="time">Time:</label>
				<input type="text" name="time" id="time" value="<?php echo $time ?>" />
				
				<div data-role="fieldcontain">
				
					<fieldset data-role="controlgroup">
						<legend>Characters:</legend>
						<?php
						include("config.php");
				
						$query_c="SELECT * FROM CharactersInfo WHERE playID LIKE '{$playID}'";
						$result_c=mysql_query($query_c);
						$numrows_c=mysql_numrows($result_c);
			
						$cc=0;
						while($cc < $numrows_c){
						$cname=mysql_result($result_c, $cc, "name");
						$cid=mysql_result($result_c, $cc, "characterID");
						$query_cs = "SELECT * FROM CharactersScenes WHERE characterID LIKE '{$cid}' AND act=$act AND scene=$scene AND playID LIKE '{$playID}' ORDER BY scene";
						$results_cs = mysql_query($query_cs);
						$numrows_cs=mysql_numrows($results_cs);

						$charid="a{$act}s{$scene}char{$cid}";
						?>
						<input type="checkbox" name="<?php echo $charid ?>" id="<?php echo $charid ?>" class="custom" 
						<?php
							if($numrows_cs > 0)
								echo 'checked="checked"'
						?>/>
						<label for="<?php echo $charid ?>"><?php echo $cname ?></label>
						<?php
						 $cc++;
						}
						?>
					</fieldset>
					<p></p>
					<fieldset data-role="controlgroup">
						<legend>Props:</legend>
						<?php
						include("config.php");
				
						$query_p="SELECT * FROM PropsInfo WHERE playID LIKE '{$playID}'";
						$result_p=mysql_query($query_p);
						$numrows_p=mysql_numrows($result_p);
			
						$pp=0;
						while($pp < $numrows_p){
						$pname=mysql_result($result_p, $pp, "name");
						$pid=mysql_result($result_p, $pp, "propID");
						$query_ps = "SELECT * FROM PropsScenes WHERE propID LIKE '{$pid}' AND act=$act AND scene=$scene AND playID LIKE '{$playID}' ORDER BY scene";
						$results_ps = mysql_query($query_ps);
						$numrows_ps=mysql_numrows($results_ps);

						$propid="a{$act}s{$scene}prop{$pid}";
						?>
						<input type="checkbox" name="<?php echo $propid ?>" id="<?php echo $propid ?>" class="custom" 
						<?php
							if($numrows_ps > 0)
								echo 'checked="checked"'
						?>/>
						<label for="<?php echo $propid ?>"><?php echo $pname ?></label>
						<?php
						$pp++;
						}
						?>
					</fieldset>
					
					<p></p>
					<label for="sceneNotes">Notes:</label>
					<textarea name="sceneNotes" id="sceneNotes">
					<?php echo $notes ?>
					</textarea>
					<p></p>
					<a data-role="button" data-inline="true" class="savescene">Save</a>
				
				</div>
				</form>
			</div>
			</li>
			<?php
			$i++;
			}
			?>
			</ul>				
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php?playID=<?php echo $playID?>" id="acts" data-icon="custom" class="ui-btn-active">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom">Set Elements</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>