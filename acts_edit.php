<!DOCTYPE html> 
<html> 
<head> 
	<script src="//cdn.optimizely.com/js/141933355.js"></script>
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css">
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page" data-theme="a" data-content-theme="a">
	<script src="//cdn.optimizely.com/js/141933355.js"></script>
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
		<!-- Edit number of scenes -->
		<a href="#editNumScenesPopup" data-rel="popup" data-role="button" data-inline="true">Edit Number of Scenes</a>
		<div data-role="popup" id="editNumScenesPopup" class="ui-content">
			<div class="warning">WARNING: Reducing the number of scenes will delete scenes from the end of the act</div>
			<p></p>
			<form id="editNumScenesForm">
		<?php
			include("config.php");
		
			$query_p="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
			$result_p=mysql_query($query_p);
			$numrows_p=mysql_numrows($result_p);
		
			$ac = 1;
			while($ac <= 10){
				$numscenes_a=mysql_result($result_p, 0, "act{$ac}");
				if ($numscenes_a > 0){
		?>
					<label for="a<?php echo $ac?>NumScenes">Act <?php echo $ac ?> Number of Scenes</label>
					<input type="hidden" name="a<?php echo $ac ?>CurNumScenes" value="<?php echo $numscenes_a ?>">
					<input type="number" name="a<?php echo $ac ?>NumScenes" value="<?php echo $numscenes_a ?>">
		<?php
				}
				$ac++;
			}
		?>
			<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
			<input type="submit" class="editNumScenesButton" value="Save Number of Scenes">
			</form>
		</div>
		<p>
		</p>
		
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<ul data-role="listview" data-filter="true" class="outer-ul">
			<?php
			include("config.php");
			
			$query="SELECT * FROM Scenes WHERE act={$actnum} AND playID LIKE '{$playID}' ORDER BY scene";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$act=mysql_result($result, $i, "act");
			$scene=mysql_result($result, $i, "scene");
			$sName=mysql_result($result, $i, "name");
			$location=mysql_result($result, $i, "location");
			$time=mysql_result($result, $i, "time");
			$notes=mysql_result($result, $i, "notes");
			?>
			
			<li>
			<div data-role="collapsible" class="sceneCollapsible itemCollapsible" data-collapsed="true">
			
				<h3><div class="sceneName"><?php echo $act ?>.<?php echo $scene ?> <?php echo $sName ?></div></h3>
				
				<a data-role="button" data-inline="true" class="savescene">Save</a>

				<form class="curSceneForm">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
				
				<label for="scName">Scene name:</label>
				<input type="text" name="scName" id="scName" value="<?php echo $sName ?>"  />
								
				<label for="location">Location:</label>
				<input type="text" name="location" id="location" value="<?php echo $location ?>"  />
				
				<label for="time">Time:</label>
				<input type="text" name="time" id="time" value="<?php echo $time ?>" />
				
				<div data-role="fieldcontain">
				
					<div data-role="collapsible">
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
					</div>
					<a href="#createCharPopup" data-rel="popup" data-role="button" data-inline="true">Create New Character</a>
					
					<p></p>
					<div data-role="collapsible">
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
						$query_ps = "SELECT * FROM PropsScenes WHERE propID='{$pid}' AND act=$act AND scene=$scene AND playID LIKE '{$playID}' ORDER BY scene";
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
					</div>
					<a href="#createPropPopup" data-rel="popup" data-role="button" data-inline="true">Create New Prop</a>
					
					<p></p>
					<div data-role="collapsible">
						<legend>Set Elements:</legend>
						<?php
						include("config.php");
				
						$query_e="SELECT * FROM ElementsInfo WHERE playID LIKE '{$playID}'";
						$result_e=mysql_query($query_e);
						$numrows_e=mysql_numrows($result_e);
			
						$ee=0;
						while($ee < $numrows_e){
						$ename=mysql_result($result_e, $ee, "name");
						$eid=mysql_result($result_e, $ee, "elementID");
						$query_es = "SELECT * FROM ElementsScenes WHERE elementID='{$eid}' AND act=$act AND scene=$scene AND playID LIKE '{$playID}' ORDER BY scene";
						$results_es = mysql_query($query_es);
						$numrows_es=mysql_numrows($results_es);

						$elemid="a{$act}s{$scene}elem{$eid}";
						?>
						<input type="checkbox" name="<?php echo $elemid ?>" id="<?php echo $elemid ?>" class="custom" 
						<?php
							if($numrows_es > 0)
								echo 'checked="checked"'
						?>/>
						<label for="<?php echo $elemid ?>"><?php echo $ename ?></label>
						<?php
						$ee++;
						}
						?>
					</div>
					<a href="#createElemPopup" data-rel="popup" data-role="button" data-inline="true">Create New Element</a>
					
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
		
		<div data-role="popup" id="createCharPopup" class="ui-content">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			<h3>Add New Character</h3>
			<form action="insert_char.php" method="post" class="newCharForm" data-ajax="false">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
				<p></p>    				
				<div data-role="fieldcontain">
					<label for="newcharname">Character name:</label>
					<input type="text" name="newcharname" id="newcharname" value=""  />
					
					<label for="newActorName">Played by:</label>
					<input type="text" name="newActorName" id="newActorName" value=""  />
					
					<fieldset data-role="controlgroup">
						<legend>Scenes:</legend>
						<div data-role="collapsible-set" data-theme="a" data-content-theme="a">
						<?php
						include("config.php");
						$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
						$result_as=mysql_query($query_as);
						
						$a=1;
						while($a <= 10){
							$numscenes_as=mysql_result($result_as, '0', "act{$a}");
							if($numscenes_as < 1)
								break;
							$sc=1;
							?>
							<div data-role="collapsible">
							<h2>Act <?php echo $a ?></h2>
							<?php
							while($sc <=$numscenes_as){
								$query_sn="SELECT * FROM Scenes WHERE playID LIKE '{$playID}' AND act=$a AND scene=$sc";
								$result_sn=mysql_query($query_sn);
								
								$asid="a{$a}s{$sc}";
								$scName=mysql_result($result_sn, '0', "name");
								?>
								<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
								<label for="<?php echo $asid ?>"><?php echo "{$a}.{$sc} {$scName}" ?></label>
								<?php
								$sc++;
							}
							$a++;
							?>
							</div>
							<?php
						}
					?>
						</div>
					</fieldset>
					
					<label for="newnote">Notes:</label>
					<textarea name="newnote" id="newnote">
					</textarea>
					
					<input type="submit" id="test" class="createCharButton" value="Create Character" />
				</div>
				</p>
				</p>
			</form>
		</div>
		
		<div data-role="popup" id="createPropPopup" class="ui-content">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			
			<h3>Add New Prop</h3>
			<form action="insert_prop.php" method="post" id="newPropForm" data-ajax="false">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>

				<p>    				
    				<div data-role="fieldcontain">
						<label for="newpropname">Prop name:</label>
						<input type="text" name="newpropname" id="newpropname" value=""  />
						
						
    					<fieldset data-role="controlgroup">
						<legend>Scenes:</legend>
						<div data-role="collapsible-set" data-theme="a" data-content-theme="a">
						<?php
						include("config.php");
						$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
						$result_as=mysql_query($query_as);
						
						$a=1;
						while($a <= 10){
							$numscenes_as=mysql_result($result_as, '0', "act{$a}");
							if($numscenes_as < 1)
								break;
							$sc=1;
							?>
							<div data-role="collapsible">
							<h2>Act <?php echo $a ?></h2>
							<?php
							while($sc <=$numscenes_as){
								$query_sn="SELECT * FROM Scenes WHERE playID LIKE '{$playID}' AND act=$a AND scene=$sc";
								$result_sn=mysql_query($query_sn);
								
								$asid="a{$a}s{$sc}";
								$scName=mysql_result($result_sn, '0', "name");
								?>
								<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
								<label for="<?php echo $asid ?>"><?php echo "{$a}.{$sc} {$scName}" ?></label>
								<?php
								$sc++;
							}
							$a++;
							?>
							</div>
							<?php
						}
					?>
						</div>
					</fieldset>
						
						<label for="newnote">Notes:</label>
						<textarea name="newnote" id="newnote">
						</textarea>
						
						<input type="submit" id="createPropButton" value="Create Prop" />
					</div>
				</p>
				</p>
			</form>
		</div>
		
		<div data-role="popup" id="createElemPopup" class="ui-content">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
			
			<h3>Add New Set Element</h3>
			<form action="insert_elem.php?playID=<?php echo $playID?>" method="post" id="newElemForm" data-ajax="false">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>

				<p>    				
    				<div data-role="fieldcontain">
						<label for="newelemname">Set element name:</label>
						<input type="text" name="newelemname" id="newelemname" value=""  />
						
						
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
							<div data-role="collapsible-set" data-theme="a" data-content-theme="a">
	   						<?php
	   						include("config.php");
	   						$query_as="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	   						$result_as=mysql_query($query_as);
	   						
	   						$a=1;
	   						while($a <= 10){
	   							$numscenes_as=mysql_result($result_as, '0', "act{$a}");
	   							if($numscenes_as < 1)
	   								break;
									
								?>
								<div data-role="collapsible">
								<h2>Act <?php echo $a ?></h2>
								<?php
									
	   							$sc=1;
	   							while($sc <=$numscenes_as){
	   								$query_sn="SELECT * FROM Scenes WHERE playID LIKE '{$playID}' AND act=$a AND scene=$sc";
									$result_sn=mysql_query($query_sn);
								
									$asid="a{$a}s{$sc}";
									$scName=mysql_result($result_sn, '0', "name");
									?>
									<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
									<label for="<?php echo $asid ?>"><?php echo "{$a}.{$sc} {$scName}" ?></label>
									<?php
									$sc++;
	   							}
	   							$a++; ?>
							</div>
							<?php
	   						}
	   					?>
   					 	</fieldset>
						
						<label for="newnote">Notes:</label>
						<textarea name="newnote" id="newnote">
						</textarea>
						
						<input type="submit" id="createElemButton" value="Create Set Element" />
					</div>
				</p>
				</p>
			</form>
		</div>
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php?playID=<?php echo $playID?>" id="acts" data-icon="custom" class="ui-btn-active">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom">Set Elements</a></li>
			<li><a href="people_view.php?playID=<?php echo $playID?>" id="people" data-icon="custom" data-transition="slide">People</a></li>
		</ul>
		</div>
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