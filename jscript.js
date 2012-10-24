$(document).live('pageinit', function(){
	$("#generate").click(function(){
		
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
})

