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
	
		      
		<form action="submit.php" method="post" data-ajax="false">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="people_view.php?playID=<?php echo $playID?>" data-role="button">
     		View</a>

     		<a href="people_edit.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>
		
		<p></p>
		<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
			<ul data-role="listview" data-filter="true" id="outer-ul">
			<?php
			include("config.php");
			$query_p="SELECT * FROM PeopleInfo ORDER BY name";
			$result_p=mysql_query($query_p);
			$numrows_p=mysql_numrows($result_p);
			
			$i=0;
			while($i < $numrows_p){
			
				$personID=mysql_result($result_p, $i, "personID");
				$name=mysql_result($result_p, $i, "name");
				$email=mysql_result($result_p, $i, "email");
				$phone=mysql_result($result_p, $i, "phone");
				$position=NULL;
				$chars=" - ";
				$numchars = 0;
				
				$query_q="SELECT * FROM PeoplePositions WHERE personID LIKE '{$personID}' AND playID LIKE '{$playID}'";
				$result_q=mysql_query($query_q);
				$numrows_q=mysql_numrows($result_q);
				
				if($numrows_q > 0){
					$j=0;
					while($j < $numrows_q){
						$position=mysql_result($result_q, $j, "position");
						$j++;	
					}
				}
				if($position != NULL){
		?>
		
			<li>
			<div class="personCollapsible" data-role="collapsible" data-collapsed="true">
			<h3><div class="personName"><?php echo $name ?></div></h3>
			<p> </p>
			  				
				<form class="curPersonForm" data-ajax="false">
					<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
					<input type="hidden" class="currPersonID" value=<?php echo $personID ?>>

    				<div data-role="fieldcontain">
						<label for="personName">Name:</label>
						<input type="text" name="personName" id="personName" value="<?php echo $name ?>"  />
						
						<label for="personPosition">Position:</label>
						<input type="text" name="personPosition" id="personPosition" value= "<?php echo $position ?>"  />
						
						<label for="personEmail">Email address:</label>
						<input type="text" name="personEmail" id="personEmail" value="<?php echo $email ?>"  />
    					
						<label for="personPhone">Phone number:</label>
						<input type="text" name="personPhone" id="personPhone" value="<?php echo $phone ?>" />
					</div>
				</form>
				<a data-role="button" data-inline="true" class="saveperson">Save</a>
				<a href="#deletePersonPopup<?php echo $i?>" data-rel="popup" data-role="button" data-inline="true">Delete</a>
				<div data-role="popup" class="deletePersonPopup" id="deletePersonPopup<?php echo $i ?>">
					<input type="hidden" class="currPlayID" value=<?php echo $playID ?>>
					<input type="hidden" class="currPersonID" value=<?php echo $personID ?>>
					<p>Are you sure you wish to delete?<p> 
					<p>(Tap elsewhere to cancel)<p>
					<a data-role="button" data-inline="true" class="deleteperson">Delete</a>
				</div>
			<p></p>
			</div>
			</li>
			
			<?php
				}
			$i++;
			}
			?>
			</ul>
			
			<h3>Add New Person</h3>
			<form action="insert_person.php" method="post" id="newPersonForm" data-ajax="false">
				<input type="hidden" name="currPlayID" value=<?php echo $playID ?>>
				<p>    				
    				<div data-role="fieldcontain">
						<label for="newPersonName">Name:</label>
						<input type="text" name="newPersonName" id="newPersonName" value=""  />
						
						<label for="newPersonPosition">Position:</label>
						<input type="text" name="newPersonPosition" id="newPersonPosition" value=""  />
						
						<label for="newPersonEmail">Email address:</label>
						<input type="text" name="newPersonEmail" id="newPersonEmail" value=""  />
    					
						<label for="newPersonPhone">Phone number:</label>
						<input type="text" name="newPersonPhone" id="newPersonPhone" value="" />

						<input type="submit" id="createPersonButton" value="Add Person" />
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
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom">Characters</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom">Set Elements</a></li>
			<li><a href="people_view.php?playID=<?php echo $playID?>" id="people" data-icon="custom" class="ui-btn-active">People</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>