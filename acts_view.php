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
     		<a href="acts_view.php?playID=<?php echo $playID?>" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="acts_edit.php?playID=<?php echo $playID?>" data-role="button">
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
									<li><a href="acts_view.php?playID=<?php echo $playID?>&actnum=<?php echo $b?>" class="ui-btn-active">Act <?php echo $b?></a></li>
								<?php
								} else {
								?>
									<li><a href="acts_view.php?playID=<?php echo $playID?>&actnum=<?php echo $b?>">Act <?php echo $b?></a></li>
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
	    	<div class="ui-block-a">
            	<div class="ui-grid-b">
	            	<div class="ui-block-a"><h2>Scene</h2></div>
	            	<div class="ui-block-b"><h2>Location</h2></div>
	            	<div class="ui-block-c"><h2>Characters</h2></div>
           		</div><!-- /grid-a -->
        	</div>
	    	<div class="ui-block-b">
            	<div class="ui-grid-b">
	            	<div class="ui-block-a"><h2>Props</h2></div>
	            	<div class="ui-block-b"><h2>Set Elements</h2></div>
	            	<div class="ui-block-c"><h2>Notes</h2></div>
            	</div><!-- /grid-a -->
        	</div>
    	</div><!-- /grid-a -->
    	
    	
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

    	<ul data-role="listview" data-inset="true" data-theme="c"><li>
    	<div class="ui-grid-a">
	    	<div class="ui-block-a">
            	<div class="ui-grid-b">	            			
					<div class="ui-block-a">
						<h2><?php echo $act?>.<?php echo $scene?></h2>
					</div>
					<div class="ui-block-b">
						<?php 
							echo $location;
						?></div>
					<div class="ui-block-c">
						<?php
							include("config.php");
				
							$query_c="SELECT * FROM CharactersScenes WHERE act={$act} AND scene={$scene} AND playID LIKE '{$playID}' ORDER BY scene";
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
           		</div><!-- /grid-a -->
        	</div>
	    	<div class="ui-block-b">
            	<div class="ui-grid-b">
	            	<div class="ui-block-a">
						<?php
							include("config.php");
				
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
					<div class="ui-block-b">
						<?php
							include("config.php");
				
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
					<div class="ui-block-c">TIME: 
						<?php 
							echo $time;
							echo "<br>";
							echo $notes;
						?>
					</div>
            	</div><!-- /grid-a -->
        	</div>
    	</div><!-- /grid-a -->
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
			<li><a href="acts_view.php?playID=<?php echo $playID?>" id="acts" data-icon="custom" class="ui-btn-active" >Acts</a></li>
			<li><a href="characters_view.php?playID=<?php echo $playID?>" id="chars" data-icon="custom">Characters/Actors</a></li>
			<li><a href="props_view.php?playID=<?php echo $playID?>" id="props" data-icon="custom">Props</a></li>
			<li><a href="elements_view.php?playID=<?php echo $playID?>" id="elements" data-icon="custom">Set Elements</a></li>
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