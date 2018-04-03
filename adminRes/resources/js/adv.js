// JavaScript Document
$(document).ready(function(e) {
	$("#advSetting").click(function(){
		if($("#advSet").css("display")=="none")
			$("#advSet").slideDown();
		else
			$("#advSet").slideUp();
	});
});