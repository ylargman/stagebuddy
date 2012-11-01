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
	}, 400);
}
$(document).live('pagechange', function(){
	$("#createCharButton").unbind("click");
	$("#createCharButton").bind("click", function (event) {
		event.preventDefault();
		alert("SHIIIT!");
		$.post("insert_char.php", $("#newCharForm").serialize(), function(data) {
		});
		delayedRefresh();
	});
	
	$(".deleteprop").unbind("click");
	$(".deleteprop").bind("click", function (event, ui){
		propToDelete = $(this).parents(".propCollapsible").find(".propName").text();
		$.post("delete_prop.php", {propname: propToDelete});
		
		delayedRefresh();
	});
	
	$(".saveprop").unbind("click");
	$(".saveprop").bind("click", function (event, ui){
		propToUpdate = $(this).parents(".propCollapsible").find(".propName").text();
		serArray = $(this).parents(".propCollapsible").find(".curPropForm").serializeArray();
		serArray.push({"name": "propname", "value": propToUpdate});
		console.info(serArray);
		
		$.post("save_prop.php", serArray);
		
		delayedRefresh();
	});
})