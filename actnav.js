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
$(document).live('pageinit', function(){
	$(".selectedact_edit").unbind("click");
	$(".selectedact_edit").bind("click", function(){
		actName = $(this).text();
		nameSplit = actName.split(" ");
		actNum = parseInt(nameSplit[1]);
		playID = $(".playID_c").html();
		
		$('<form action="acts_edit.php?playID=' + playID + '" method="POST">' + 
    		'<input type="hidden" name="actnum" value="' + actNum + '">' +
    		'</form>').submit();
	});
});