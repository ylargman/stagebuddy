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
	$(".selectedact").unbind("click");
	$(".selectedact").bind("click", function(){
		actName = $(this).text();
		nameSplit = actName.split(" ");
		actNum = parseInt(nameSplit[1]);
		console.info(actNum);
		
		$('<form action="acts_view.php" method="POST">' + 
    		'<input type="hidden" name="actnum" value="' + actNum + '">' +
    		'</form>').submit();
	});
	$(".selectedact_edit").unbind("click");
	$(".selectedact_edit").bind("click", function(){
		actName = $(this).text();
		nameSplit = actName.split(" ");
		actNum = parseInt(nameSplit[1]);
		console.info(actNum);
		
		$('<form action="acts_edit.php" method="POST">' + 
    		'<input type="hidden" name="actnum" value="' + actNum + '">' +
    		'</form>').submit();
	});
});