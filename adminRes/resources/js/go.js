// JavaScript Document
function go(u){
if(confirm('确认删除该信息？'))
	if(/MSIE (\d+\.\d+);/.test(navigator.userAgent))
	{
		var referLink = document.createElement('a');  
		referLink.href = u;  
		document.body.appendChild(referLink);  
		referLink.click();  
	}
	else
		{location.href = u;}  
} 
