// JavaScript Document
$(function(){
	$("#submit").click(function(){
		if($("#userName").val()==""||$("#userPass").val()==""||$("#rndCode").val()=="")
		{
			alert("请输入用户名、密码、验证码。");
			return false;
		}
		var userName=checkLoginInput($("#userName").val(),4,16,1);
		if(userName==1)
		{
			alert("帐户名错误，输入字符长度错误或包含非法字符！");
			$("#userName").focus();
			return false;
		}
		var userPass=checkLoginInput($("#userPass").val(),4,16,0);
		if(userPass==1)
		{
			alert("帐户密码错误，输入字符长度错误或包含非法字符！");
			$("#userPass").focus();
			return false;
		}
		var rndCode=checkLoginInput($("#rndCode").val(),4,4,1);
		if(rndCode==1)
		{
			alert("验证码错误，输入字符长度错误或包含非法字符！");
			$("#rndCode").focus();
			return false;
		}
		$.post("loginSubmit/",{"userName":userName,"userPass":userPass,"rndCode":rndCode},function(data){
			switch(data)
			{
				case "2":
					alert("验证码错误！");
					break;
				case "0":
					alert("用户名或密码错误！");
					break;
				default:
					location.href=data;
					break;
				
			}
		});
	});
	$("#rndCodeImg").click(function(){
		$(this).attr("src","Captcha/");
	});
	
	function checkLoginInput(str,minCount,maxCount,tp)
	{
		var sqlChar= /select|update|delete|exec|count|'|"|=|;|>|<|%/i;
		var errChar = /^[a-zA-Z0-9_]{1,}$/;
		if(tp==1)
			if(str.length<minCount||str.length>maxCount||sqlChar.test(str)||!str.match(errChar)){return 1;}
		else
			if(str.length<minCount||str.length>maxCount||sqlChar.test(str)){return 1;}
		return str;
	}
});