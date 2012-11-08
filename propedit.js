function delayedRefresh(){
	window.setTimeout(function(){
			$.mobile.changePage(
				window.location.href,
				{
					allowSamePageTransition : true,
					transition              : 'none',
					showLoadMsg             : false,
					reloadPage              : true
				}
			)
	}, 200);
}
$(document).live('pagechange', function(){	
	$("#createPropButton").unbind("click");
	$("#createPropButton").bind("click", function (event) {
		event.preventDefault();
		$.post("insert_prop.php", $("#newPropForm").serialize(), function(data) {
		});
			
		delayedRefresh();
	});
	
	$(".deleteprop").unbind("click");
	$(".deleteprop").bind("click", function (event, ui){
		propToDelete = $(this).parents(".propCollapsible").find(".currPropID").val();
		$.post("delete_prop.php", {propid: propToDelete});
				
		delayedRefresh();
	});
	
	$(".saveprop").unbind("click");
	$(".saveprop").bind("click", function (event, ui){
		propToUpdate = $(this).parents(".propCollapsible").find(".currPropID").val();
		serArray = $(this).parents(".propCollapsible").find(".curPropForm").serializeArray();
		serArray.push({"name": "propname", "value": propToUpdate});
		console.info(serArray);
		
		$.post("save_prop.php", serArray);
		
		delayedRefresh();
	});
	
	$("#createCharButton").unbind("click");
	$("#createCharButton").bind("click", function (event) {
		event.preventDefault();
		$.post("insert_char.php", $("#newCharForm").serialize(), function(data) {
		});
		delayedRefresh();
	});
	
	$(".deletechar").unbind("click");
	$(".deletechar").bind("click", function (event, ui){
		charToDelete = $(this).parents(".charCollapsible").find(".currCharID").val();
		$.post("delete_char.php", {charid: charToDelete});
		delayedRefresh();
	});
	
	$(".savechar").unbind("click");
	$(".savechar").bind("click", function (event, ui){
		charToUpdate = $(this).parents(".charCollapsible").find(".charName").val();
		serArray = $(this).parents(".charCollapsible").find(".curCharForm").serializeArray();
		serArray.push({"name": "charname", "value": charToUpdate});
		console.info(serArray);
		
		$.post("save_char.php", serArray);
		
		delayedRefresh();
	});
	
	$(".savescene").unbind("click");
	$(".savescene").bind("click", function (event, ui){
		sceneName = $(this).parents(".sceneCollapsible").find(".sceneName").text();
		nameSplit = sceneName.split(".");
		serArray = $(this).parents(".sceneCollapsible").find(".curSceneForm").serializeArray();
		serArray.push({"name" : "act", "value": parseInt(nameSplit[0]) });
		serArray.push({"name" : "scene", "value": parseInt(nameSplit[1]) });
		console.info(serArray);

		var jqreq = $.post("save_scene.php", serArray);
		//console.info(jqreq.responseText);
		//console.log(jqreq);

		delayedRefresh();
	});
})