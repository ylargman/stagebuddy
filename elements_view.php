<!DOCTYPE html> 
<html> 
<head> 
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
     		<a href="elements_view.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="elements_edit.php?playID=<?php echo $playID?>" data-role="button">
     		Edit</a>
			</fieldset>
		</form>

	<div data-role="content">	      
		
		<div class="ui-grid-b">
				<div class="ui-block-a"><h3>Set Element<h3></div>
				<div class="ui-block-b"><h3>Scenes<h3></div>
				<div class="ui-block-c"><h3>Notes<h3></div>
			</div><!-- /grid-b -->
		
		<?php
			include("config.php");
			$query="SELECT * FROM ElementsInfo WHERE playID LIKE '{$playID}'";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$elementID=mysql_result($result, $i, "elementID");
			$name=mysql_result($result, $i, "name");
			$notes=mysql_result($result, $i, "notes");
			?>
			
			<p> 
			<ul data-role="listview" data-inset="true" data-theme="c"><li>
			<div class="ui-grid-b">
				<div class="ui-block-a"><?php echo $name ?></div>
					<div class="ui-block-b">
						<a href="#Scenes_PopupE<?php echo $elementID ?>" data-rel="popup" data-transition="pop">
							<?php
								$query_s_n="SELECT * FROM ElementsScenes WHERE elementID LIKE '{$elementID}' AND playID LIKE '{$playID}' ORDER BY act, scene";
								$result_s_n=mysql_query($query_s_n);
								$numrows_s_n=mysql_numrows($result_s_n);
								
								$j=0;
								while($j < $numrows_s_n){
									$act=mysql_result($result_s_n, $j, "act");
									$scene=mysql_result($result_s_n, $j, "scene");
									echo $act;
									echo ".";
									echo $scene;
									echo "<br>";
									$j++;
								}
							?>
						</a>
						<div data-role="popup" id="Scenes_PopupE<?php echo $elementID ?>">
							<div data-role="collapsible-set" data-inset="true">
								<?php
									$query_scenes_p="SELECT * FROM ElementsScenes WHERE elementID LIKE '{$elementID}' AND playID LIKE '{$playID}' ORDER BY act, scene";
									$result_scenes_p=mysql_query($query_scenes_p);
									$numrows_scenes_p=mysql_numrows($result_scenes_p);
								
									$j=0;
									while($j < $numrows_scenes_p){
										$act=mysql_result($result_scenes_p, $j, "act");
										$scene=mysql_result($result_scenes_p, $j, "scene");
								?>
								<div data-role="collapsible">
									<?php
										$query_sp="SELECT * FROM Scenes WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}'";
										$result_sp=mysql_query($query_sp);
										$numrows_sp=mysql_numrows($result_sp);	
										
										$location=mysql_result($result_sp, 0, "location");
										$time=mysql_result($result_sp, 0, "time");
										$notes=mysql_result($result_sp, 0, "notes");
									?>
									<h3>
										<?php
												echo $act;
												echo ".";
												echo $scene;
										?>
									</h3>
									<h3>Location: <?php echo $location ?></h3>
									<h3>Characters: </h3>
									<div>
										<?php
											$query_c="SELECT * FROM CharactersScenes WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}'";
											$result_c=mysql_query($query_c);
											$numrows_c=mysql_numrows($result_c);
							
											$n=0;
											while($n < $numrows_c){
												$cid=mysql_result($result_c, $n, "characterID");
												$query_c_n="SELECT * FROM CharactersInfo WHERE characterID LIKE '{$cid}' AND playID LIKE '{$playID}'";
												$result_c_n=mysql_query($query_c_n);
											
												$cname=mysql_result($result_c_n, 0, "name");
												echo "- ";
												echo $cname;
												echo "<br>";
												$n++;
											}
										?>
									</div>
									<h3>Props: </h3>
									<div>
										<?php
											$query_p="SELECT * FROM PropsScenes WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}' ORDER BY scene";
											$result_p=mysql_query($query_p);
											$numrows_p=mysql_numrows($result_p);
							
											$x=0;
											while($x < $numrows_p){
												$pid=mysql_result($result_p, $x, "propID");
												$query_p_n="SELECT * FROM PropsInfo WHERE propID LIKE '{$pid}' AND playID LIKE '{$playID}'";
												$result_p_n=mysql_query($query_p_n);
											
												$pname=mysql_result($result_p_n, '0', "name");
												echo "- ";
												echo $pname;
												echo "<br>";
												$x++;
											}
										?>
									</div>
									<h3>Set Elements: </h3>
									<div>
										<?php
											$query_e="SELECT * FROM ElementsScenes WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}' ORDER BY scene";
											$result_e=mysql_query($query_e);
											$numrows_e=mysql_numrows($result_e);
							
											$x=0;
											while($x < $numrows_e){
												$eid=mysql_result($result_e, $x, "elementID");
												$query_e_n="SELECT * FROM ElementsInfo WHERE elementID LIKE '{$eid}' AND playID LIKE '{$playID}'";
												$result_e_n=mysql_query($query_e_n);
											
												$ename=mysql_result($result_e_n, '0', "name");
												echo "- ";
												echo $ename;
												echo "<br>";
												$x++;
											}
										?>
									</div>
									<h3>Time: <?php echo $time ?></h3>
									<h3>Notes: <?php echo $notes ?></h3>
									
								</div>
								<?php
									$j++;
								}
								?>
							</div>
						</div>
					</div>
					<div class="ui-block-c"><?php echo $notes ?></div>
				</p>
				</div><!-- /grid-b -->
				
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
			<li><a href="acts_view.php?playID=<?php echo $playID?>" id="acts" data-icon="custom" data-transition="slide">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom" data-transition="slide">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom" data-transition="slide">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom" class="ui-btn-active" data-transition="slide">Set Elements</a></li>
			<li><a href="people_view.php?playID=<?php echo $playID?>" id="people" data-icon="custom" data-transition="slide">People</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>