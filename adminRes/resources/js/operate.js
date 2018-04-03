// JavaScript Document
$(document).ready(function(e) {
	//检索信息
	$("#showSearch").click(function(){
		if($("#search").css("display")=="none")
			$("#search").slideDown();
		else
			$("#search").slideUp();
	});
	$("#exitSearch").click(function(){
		$("#search").slideUp();
	});


	//收缩/拉开高级选项
	$("#advSetting").click(function(){
		if($("#advSet").css("display")=="none")
			$("#advSet").slideDown();
		else
			$("#advSet").slideUp();
	});
	
});

//删除信息
function del(u){
	if(confirm('确认删除该信息？'))
	{
		if(/MSIE (\d+\.\d+);/.test(navigator.userAgent))
		{
			var referLink = document.createElement('a');  
			referLink.href = u;  
			document.body.appendChild(referLink);  
			referLink.click();  
		}
		else
		{
			location.href = u;
		}  
	}
} 
