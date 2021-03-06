<!DOCTYPE html> 
<html> 
<head> 
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
	<script src="//cdn.optimizely.com/js/141933355.js"></script>
	<div data-role="header" data-position="fixed">
		<a href="index.php" data-icon="grid">Home</a>
		<h1>
		<?php
			include("config.php");
			$playID = "50a2a04570263";
			
			$query_i="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
			$result_i=mysql_query($query_i);
			$numrows_i=mysql_numrows($result_i);
			
			$name=mysql_result($result_i, '0', "name");
			echo $name;
		?>
		</h1>
		<a href="acts_view_alternate.php?playID=<?php echo $playID?>" data-icon="gear" class="ui-btn-active ui-state-persist">Edit</a>
	</div><!-- /header -->

	<div data-role="content">	      

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
									<li><a href="acts_edit_alternate.php?playID=<?php echo $playID?>&actnum=<?php echo $b?>" class="ui-btn-active"><h1>Act <?php echo $b?></h1></a></li>
								<?php
								} else {
								?>
									<li><a href="acts_edit_alternate.php?playID=<?php echo $playID?>&actnum=<?php echo $b?>"><h1>Act <?php echo $b?></h1></a></li>
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
		
		<div class="ui-grid-a">
    		<div class="ui-block-a"><br></div>
    		<div class="ui-block-b"><br></div>
    	</div>
    	
    	
    	
    	<div data-role="collapsible-set" data-theme="d" data-content-theme="d">
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
					
					<h1><div class="sceneName"><p><h3><?php echo $act ?>.<?php echo $scene ?>: Scene Name</h3></p></div></h1>
					
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
    	
    	</div>
</div><!-- /page -->

<script type="text/javascript">
setTimeout(function(){var a=document.createElement("script");
var b=document.getElementsByTagName("script")[0];
a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/5848.js?"+Math.floor(new Date().getTime()/3600000);
a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
</script>

</body>
</html>