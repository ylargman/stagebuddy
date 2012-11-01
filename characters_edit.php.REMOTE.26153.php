<!DOCTYPE html> 
<html> 
<head> 
	<title>Stage Buddy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
</head> 

<body> 

<div data-role="page">

	<div data-role="header">
		<a href="index.html" data-icon="grid">Home</a>
		
		<h1>Characters</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="props.html" data-role="button">
     		View</a>

     		<a href="props_edit.html" data-role="button" class="ui-btn-active">
     		Edit</a>
			</fieldset>
		</form>

        	<div data-role="collapsible-set" data-theme="c" data-content-theme="d">

			<div data-role="collapsible" data-collapsed="false">
			<h3>Shag</h3>
			<p>I'm the collapsible content Shag.</p>
			</div>
	
			<div data-role="collapsible">
			<h3>Judith</h3>
				<p>
					<label for="playedby">Played By:</label>
    				<input type="text" name="name" id="playedby" value=""  />
    				
    				<div data-role="fieldcontain">
    					<fieldset data-role="controlgroup">
    						<legend>Scenes:</legend>
	   						<input type="checkbox" name="scene1" id="scene1" class="custom" />
	   						<label for="scene1">1.1</label>
	   						
	   						<input type="checkbox" name="scene2" id="scene2" class="custom" />
	   						<label for="scene2">1.2</label>
   					 	</fieldset>
					</div>
					
    				<input type="text" name="name" id="newscene" value="Add a new scene"  />
					
					<div data-role="fieldcontain">
   					 	<label for="textarea-a">Notes:</label>
						<textarea name="textarea" id="textarea-a">
Here's a nice lil' note about this here character.
						</textarea>
					</div>

				</p>
			</div>
	
		</div>
				
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