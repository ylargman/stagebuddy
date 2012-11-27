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
	
		      
		<form action="submit.php" method="post" data-ajax="false">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="characters_view.php?playID=<?php echo $playID?>" data-role="button">
     		View</a>

     		<a href="characters_edit.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>
		
		<p></p>
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<ul data-role="listview" data-filter="true" id="outer-ul">
			<?php
			include("config.php");
			
			$query="SELECT * FROM CharactersInfo WHERE playID LIKE '{$playID}' ORDER BY name";
			$result=mysql_query($query);
			$numrows=mysql_numrows($result);
			
			$i=0;
			while($i < $numrows){
			
			$charID=mysql_result($result, $i, "characterID");
			$name=mysql_result($result, $i, "name");
			$actor=mysql_result($result, $i, "actor");
			$notes=mysql_result($result, $i, "notes");
			?>
			<li>
			<div class="charCollapsible" data-role="collapsible" data-collapsed="true">
			<h3><div class="charName"><?php echo $name ?></div></h3>
			<p> </p> 
			
			<a data-role="button" data-inline="true" class="savechar">Save</a>
			<a href="#deleteCharPopup<?php echo $i?>" data-rel="popup" data-role="button" data-inline="true">Delete</a>
			<div data-role="popup" id="deleteCharPopup">
				<input type="hidden" class="currCharID" value=<?php echo $charID ?>>
				<p>Are you sure you wish to delete?<p> 
				<p>(Tap elsewhere to cancel)<p>
				<a data-role="button" data-inline="true" class="deletechar">Delete</a>
			</div>
			  				
				<form class="curCharForm" data-ajax="false">
					<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
					<input type="hidden" class="currCharID" value=<?php echo $charID ?>>

    				<div data-role="fieldcontain">
						<label for="actorname">Actor:</label>
						<textarea name="actorname" id="actorname"><?php echo $actor ?>
						</textarea>
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						
	   						<?php
	   						include("config.php");
	   						$query_acts="SELECT * FROM Plays WHERE playID LIKE '{$playID}'";
	   						$result_acts=mysql_query($query_acts);
	   						
	   						$act=1;
	   						while($act <= 10){
	   							$numscenes=mysql_result($result_acts, '0', "act{$act}");
	   							if($numscenes < 1)
	   								break;
	   							$scene=1;
	   							while($scene <=$numscenes){
	   								$query_cs = "SELECT * FROM CharactersScenes WHERE characterID LIKE '{$charID}' AND act=$act AND scene=$scene AND playID LIKE '{$playID}'";
									$results_cs = mysql_query($query_cs);
									$numrows_cs=mysql_numrows($results_cs);

									$cid="a{$act}s{$scene}char{$charID}";
									?>
									<input type="checkbox" name="<?php echo $cid ?>" id="<?php echo $cid ?>" class="custom" 
									<?php
									if($numrows_cs > 0)
										echo 'checked="checked"'
									?>/>
									<label for="<?php echo $cid ?>"><?php echo "{$act}.{$scene}" ?></label>
									<?php
									$scene++;
	   							}
	   							$act++;
	   						}
	   					?>

   					 	</fieldset>
						<p>
						</p>
						<label for="charnotes">Notes:</label>
						<textarea name="charnotes" id="charnotes"><?php echo $notes ?>
						</textarea>
					</div>
				</form>
				<a data-role="button" data-inline="true" class="savechar">Save</a>
				<a href="#deleteCharPopup<?php echo $i?>" data-rel="popup" data-role="button" data-inline="true">Delete</a>
				<div data-role="popup" class="deleteCharPopup" id="deleteCharPopup<?php echo $i ?>">
					<input type="hidden" class="currCharID" value=<?php echo $charID ?>>
					<p>Are you sure you wish to delete?<p> 
					<p>(Tap elsewhere to cancel)<p>
					<a data-role="button" data-inline="true" class="deletechar">Delete</a>
				</div>
			<p></p>
			</div>
			</li>
			<?php
			$i++;
			}
			?>
			</ul>
			
			<h3>Add New Character</h3>
			<form action="insert_char.php" method="post" id="newCharForm" data-ajax="false">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
				<p>    				
    				<div data-role="fieldcontain">
						<label for="newcharname">Character name:</label>
						<input type="text" name="newcharname" id="newcharname" value=""  />
						
						<label for="newActorName">Played by:</label>
						<input type="text" name="newActorName" id="newActorName" value=""  />
						
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
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
	   							while($sc <=$numscenes_as){
	   								$asid="a{$a}s{$sc}";
	   								?>
									<input type="checkbox" name="<?php echo $asid ?>" id="<?php echo $asid ?>" class="custom"/>
									<label for="<?php echo $asid ?>"><?php echo "{$a}.{$sc}" ?></label>
									<?php
									$sc++;
	   							}
	   							$a++;
	   						}
	   					?>
   					 	</fieldset>
						
						<label for="newnote">Notes:</label>
						<textarea name="newnote" id="newnote">
						</textarea>
						
						<input type="submit" id="createCharButton" value="Create Character" />
					</div>
				</p>
				</p>
			</form>	
		</div>
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php?playID=<?php echo $playID?>" id="acts" data-icon="custom">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom" class="ui-btn-active">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom">Set Elements</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>