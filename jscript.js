$(document).live('pageshow', function(){
	alert("test");
	$("#generate").click(function(){
		alert("test");
		numActs = $("#numActs").val();
		html = '';
		for (var i = 0; i < numActs; i++){
			name = 'act' + i + 'NumScenes';
			html += '<div data-role="fieldcontain">';
			html += '<label>Act ' + i + ' number of scenes</label><input type="number" id="' + name + '" name="' + name + '"/>';
			html += '</div>';
		}
		
		html += '<div data-role="fieldcontain">';
		html += '<input type="submit" id="playCreateButton" value="Create" />';
		html += '</div>';
		$('#scenePopContents').html(html);
		$('#scenePop').popup("open");
		$('.ui-page').trigger('create');
	});
	
	$('#data-view-pane').load('acts_view_content.html',function(){
		$('#data-view-pane').trigger('create');
	});
})

