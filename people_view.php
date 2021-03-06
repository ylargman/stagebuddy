<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	
	<link rel="stylesheet" href="themes/stagebuddytheme.min.css" />
  	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile.structure-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css">
	<link type="text/css" rel="stylesheet" href="../fpdf.css">
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="propedit.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="header" data-position="fixed">
		<a href="index.php" data-icon="grid">Home</a>
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
		<a href="login.php" data-icon="gear" data-ajax="false">Change User</a>
	</div><!-- /header -->

	<div data-role="content">	
	
	<p class='demo'><a href='PDF_Generator/tutorial/printablepeople.php?playID=<?php echo $playID ?>' target='_blank' class='demo' data-role="button" data-icon="forward" data-inline="true">Export as PDF</a></p>
	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="people_view.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="people_edit.php?playID=<?php echo $playID?>" data-role="button" data-transition="slideup">
     		Edit</a>
			</fieldset>
		</form>
	
	<div class="ui-grid-c">
				<div class="ui-block-a"><h3>Name<h3></div>
				<div class="ui-block-b"><h3>Position<h3></div>
				<div class="ui-block-c"><h3>Email Address<h3></div>
				<div class="ui-block-d"><h3>Phone Number<h3></div>
			</div><!-- /grid-c -->
		
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
				
				
				$query_q="SELECT * FROM PeoplePositions WHERE personID LIKE '{$personID}' AND playID LIKE '{$playID}'";
				$result_q=mysql_query($query_q);
				$numrows_q=mysql_numrows($result_q);
				
				if($numrows_q > 0){
					
					?>
				
					<p> 
					<ul data-role="listview" data-inset="true" data-theme="c">
					<li>
					<div class="ui-grid-c">
						<div class="ui-block-a">
							<?php  
								echo $name;
							?>
						</div>
						
						<div class="ui-block-b">
					
					<?php
				
					$j=0;
					while($j < $numrows_q){
						$position=mysql_result($result_q, $j, "position");
						?>
						<?php
						echo $position;						
						echo "<br>";
						$j++;
					}
					if($position != NULL){
						?>
					
					</div>			
					<div class="ui-block-c">
						<?php 
							echo $email;
						?>
					</div>
					<div class="ui-block-d">
						<?php 
							echo $phone;
						?>
					</div>
					<div class="ui-block-a"><br></div>
					<div class="ui-block-b"><br></div>
					<div class="ui-block-c"><br></div>
					<div class="ui-block-d"><br></div>
				</p>
				</div><!-- /grid-c -->
				</li>
		<?php
					}
				}
				
				$i++;
			}
		?>
			
		</ul>
	
	</div><!-- /content -->
	
	<div data-role="footer" data-id="navigation" data-position="fixed" data-theme="c" class="nav-glyphish-example">
		<div data-role="navbar" class="nav-glyphish-example">
		<ul>
			<li><a href="acts_view.php?playID=<?php echo $playID?>" id="acts" data-icon="custom" data-transition="slide">Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom" data-transition="slide">Characters</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom" data-transition="slide">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom" data-transition="slide">Set Elements</a></li>
			<li><a href="people_view.php?playID=<?php echo $playID?>" id="people" data-icon="custom" class="ui-btn-active" data-transition="slide">People</a></li>
		</ul>
		</div>
	</div>

</div><!-- /page -->

</body>
</html>