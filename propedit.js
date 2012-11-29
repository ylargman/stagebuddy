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
	
	$(".createCharButton").unbind("click");
	$(".createCharButton").bind("click", function (event) {
		event.preventDefault();
		console.info(this);
		console.info($(this).closest("form"));
		
		$.post("insert_char.php", $(this).closest("form").serialize(), function(data) {
		});
		$(document).find("#createCharPopup").popup("close");
		delayedRefresh();
	});
	
	$("#createElemButton").unbind("click");
	$("#createElemButton").bind("click", function (event) {
		event.preventDefault();
		$.post("insert_elem.php", $("#newElemForm").serialize(), function(data) {
		});
			
		delayedRefresh();
	});
	
	$(".deleteprop").unbind("click");
	$(".deleteprop").bind("click", function (event, ui){
		propToDelete = $(this).parents(".deletePropPopup").find(".currPropID").val();
		$.post("delete_prop.php", {propid: propToDelete});
		
		$(this).parents(".deletePropPopup").popup("close");
		delayedRefresh();
	});
	
	$(".deletechar").unbind("click");
	$(".deletechar").bind("click", function (event, ui){
		charToDelete = $(this).parents(".deleteCharPopup").find(".currCharID").val();
		$.post("delete_char.php", {charid: charToDelete});
		
		$(this).parents(".deleteCharPopup").popup("close");
		delayedRefresh();
	});
	
	$(".deleteelem").unbind("click");
	$(".deleteelem").bind("click", function (event, ui){
		elemToDelete = $(this).parents(".deleteElemPopup").find(".currElemID").val();
		$.post("delete_elem.php", {elemid: elemToDelete});
		
		$(this).parents(".deleteElemPopup").popup("close");
		delayedRefresh();
	});
	
	$(".saveprop").unbind("click");
	$(".saveprop").bind("click", function (event, ui){
		propToUpdate = $(this).parents(".propCollapsible").find(".currPropID").val();
		serArray = $(this).parents(".propCollapsible").find(".curPropForm").serializeArray();
		serArray.push({"name": "propid", "value": propToUpdate});
		console.info(serArray);
		
		$.post("save_prop.php", serArray);
		
		delayedRefresh();
	});
	
	$(".savechar").unbind("click");
	$(".savechar").bind("click", function (event, ui){
		charToUpdate = $(this).parents(".charCollapsible").find(".currCharID").val();
		serArray = $(this).parents(".charCollapsible").find(".curCharForm").serializeArray();
		serArray.push({"name": "charid", "value": charToUpdate});
		console.info(serArray);
		
		$.post("save_char.php", serArray);
		
		delayedRefresh();
	});
	
	$(".saveelem").unbind("click");
	$(".saveelem").bind("click", function (event, ui){
		elemToUpdate = $(this).parents(".elemCollapsible").find(".currElemID").val();
		serArray = $(this).parents(".elemCollapsible").find(".curElemForm").serializeArray();
		serArray.push({"name": "elemid", "value": elemToUpdate});
		console.info(serArray);
		
		$.post("save_elem.php", serArray);
		
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
	
	$(".deleteshow").unbind("click");
	$(".deleteshow").bind("click", function (event, ui){
		serArray = $(this).parents(".deleteShowForm").serializeArray();
		$.post("deleteshow.php", serArray);
		delayedRefresh();
	});
	
	$(".changeShowName").unbind("click");
	$(".changeShowName").bind("click", function (event, ui){
		event.preventDefault();
		
		serArray = $(this).parents(".changeShowForm").serializeArray();
		$.post("change_show_name.php", serArray);
		$(this).parents(".manageShowPopup").popup("close");
		delayedRefresh();
	});
	
	$(".editNumScenesButton").unbind("click");
	$(".editNumScenesButton").bind("click", function (event, ui){
		event.preventDefault();
		
		serArray = $(this).parents("#editNumScenesForm").serializeArray();
		
		$.post("edit_num_scenes.php", serArray);
		$(this).parents("#editNumScenesPopup").popup("close");
		delayedRefresh();
	});
	
	//find the headings we want to watch
	//$(this).find('#outer-ul').find('.ui-collapsible-heading').unbind("click");
    $(this).find('.outer-ul').find('.ui-collapsible-heading').on('click', function () {

        //cache the parent collapsible widget
        var that = $(this).closest('.ui-collapsible')[0];
		
		if($(this).closest('.ui-collapsible').hasClass('itemCollapsible')){
			//collapse all other collapsible widgets
			$(this).closest('ul').find('.ui-collapsible').filter(function () {

				//filter-out the collapsible widget that got clicked, so it functions
				return this !== that;
			}).trigger('collapse');

			//since we are messing around with the listview widget, let's refresh it
			$(this).closest('ul').trigger('refresh');
		}
    });

})