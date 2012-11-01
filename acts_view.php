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

	<div data-role="header" data-position="fixed">
		<a href="index.html" data-icon="grid">Home</a>
		
		<h1>Acts</h1>
	</div><!-- /header -->

	<div data-role="content">	      
		<form action="submit.php" method="post">
			<fieldset data-role="controlgroup" data-type="horizontal" class="localnav">
     		<a href="acts_view.php" data-role="button" class="ui-btn-active">
     		View</a>

     		<a href="acts_edit.php" data-role="button">
     		Edit</a>
			</fieldset>
		</form>

		<div data-role="navbar">
			<ul>
				<li><a href="a.html" class="ui-btn-active ui-state-persist">Act 1</a></li>
				<li><a href="b.html">Act 2</a></li>
				<li><a href="b.html">Act 3</a></li>
			</ul>
		</div><!-- /navbar -->
		
		<div class="ui-grid-d">
			<div class="ui-block-a">
				<h2>
					Scene
				</h2>
			</div>
			<div class="ui-block-b">
				<h2>
					Location
				</h2>		
			</div>
			<div class="ui-block-c">
				<h2>
					Characters
				</h2>	
			</div>
			<div class="ui-block-d">
				<h2>
					Props
				</h2>	
			</div>
			<div class="ui-block-e">
				<h2>
					Notes
				</h2>	
			</div>
		
			<div class="ui-block-a">1.1</div>
			<div class="ui-block-b">
				<textarea rows=4 cols=200 readonly="readonly">
The Abbey</textarea>
			</div>
			<div class="ui-block-c">
				<textarea rows=4 cols=200 readonly="readonly">
1. Charlie
2. Sophie
3. Skylar
4. Yan</textarea>
			</div>
			<div class="ui-block-d">
				<textarea rows=4 cols=200 readonly="readonly">
1. Sword
2. Shield
3. Hankerchief</textarea>
			</div>
			<div class="ui-block-e">
				<a href="#notesPopup" data-rel="popup" data-role="button" data-inline="true">Notes</a>
					<div data-role="popup" id="notesPopup">
						<p>Show Notes<p>
					</div>
			</div>
			
			<div class="ui-block-a">1.2</div>
			<div class="ui-block-b">
				<a href="#locationPopup" data-rel="popup" data-role="button" data-inline="true">Location</a>
					<div data-role="popup" id="locationPopup">
						<p>Show Location<p>
					</div>
			</div>
			<div class="ui-block-c">
				<a href="#charactersPopup" data-rel="popup" data-role="button" data-inline="true">Characters</a>
					<div data-role="popup" id="charactersPopup">
						<p>Show Characters<p>
					</div>
			</div>
			<div class="ui-block-d">
				<a href="#propsPopup" data-rel="popup" data-role="button" data-inline="true">Props</a>
					<div data-role="popup" id="propsPopup">
						<p>Show Props<p>
					</div>
			</div>
			<div class="ui-block-e">
				<a href="#notesPopup" data-rel="popup" data-role="button" data-inline="true">Notes</a>
					<div data-role="popup" id="notesPopup">
						<p>Show Notes<p>
					</div>
			</div>
		</div><!-- /grid-d -->
		
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