$(document).live('pagechange pageshow pageinit', function(){
	$(".generateButton").unbind("click");
	$(".generateButton").click(function(){
		event.preventDefault();
		numActs = $("#numActs").val();
		if (numActs > 10 || numActs < 1){
			alert("Number of acts must be between 1 and 10.");
		}
		else{
			html = '<form class="genShowForm" data-ajax="false">';
			for (var i = 0; i < numActs; i++){
				iprime = i+1;
				name = 'act' + iprime + 'NumScenes';
				html += '<div data-role="fieldcontain">';
				html += '<label>Act ' + iprime + ' number of scenes</label><input type="number" id="' + name + '" name="' + name + '"/>';
				html += '</div>';
			}
			
			html += '<div data-role="fieldcontain">';
			html += '<input type="submit" class="playCreateButton" value="Create" />';
			html += '</div>';
			html += '</form>';
			$('#scenePopContents').html(html);
			$('#scenePop').popup("open");
			$('.ui-page').trigger('create');
			
			
			$(".playCreateButton").click(function(){
				event.preventDefault();
				serArray = $(this).parents(".genShowForm").serializeArray();
				showTitle = $("#playname").val();
				numActs = $("#numActs").val();
				for(var i = 0; i < serArray.length; i++) {
					numScenes = serArray[i].value;
					if(numScenes < 1 || numScenes >	30) {
						alert("Number of scenes must be between 1 and 30.");
						return;
					}
				}
				userID = $(document).find("#userID").val();
				serArray.push({"name": "userID", "value": userID});
				
				serArray.push({"name": "showTitle", "value": showTitle});
				serArray.push({"name": "numActs", "value": numActs});
				console.info(serArray);
				$.post("gen_show.php", serArray, function(data, textStatus, jqxhrob){
					page = "acts_view.php?playID=" + jqxhrob.responseText;
					$.mobile.changePage(page);
				});
			});
		}
	});
	
	$('#data-view-pane').load('acts_view_content.html',function(){
		$('#data-view-pane').trigger('create');
	});
})

