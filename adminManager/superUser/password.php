<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
		$(function(){
			$("#submit").click(function(){
				var oldPass=checkPassword($("#oldPass").val());
				var newPass=checkPassword($("#newPass").val());
				var newPassRe=checkPassword($("#newPassRe").val());
				
				if(oldPass==1)
				{
					alert("原始密码输入错误，输入的字符长度错误或包含非法字符!");
					$("#oldPass").focus();
					return false;
				}
				if(newPass==1)
				{
					alert("新密码输入错误，输入的字符长度错误或包含非法字符!");
					$("#newPass").focus();
					return false;
				}
				if(newPassRe!=newPass)
				{
					alert("新密码与重复新密码不一致，请重新输入!");
					$("#newPass").focus();
					return false;
				}
				$.post("passwordSubmit.php",{"oldPass":oldPass,"newPass":newPass},function(data){
					if(data==1)
					{
						alert("管理员密码设置成功！");
						location.href=location.href;
					}
					else
					{
						alert("原始密码错误，请重新输入！");
						$("#oldPass").val("");
						$("#oldPass").focus();
					}
				});
			});
			function checkPassword(str)
			{
				var sqlChar= /select|update|delete|exec|count|'|"|=|;|>|<|%/i;
				if(str.length<4||str.length>16||sqlChar.test(str)){return 1;}
				return str;
			}
		});
	</script>
</head>

<body>
<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$conn->query("set names utf8");
	$res=$conn->query("select * from adminUser limit 1");
	$row=$res->fetch_assoc();
	
?>
<div id="tab">
	<div class="info">后台管理系统 >> 管理员密码设置</div>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">
    	<tr>
        	<td colspan="2" height="30" class="tab-tle">管理员密码设置</td>
        </tr>
        <tr bgcolor="#ffffff">
            <td width="20%" height="35" align="right">管理员帐户：</td>
            <td width="80%" style="font-weight:bold;"><?php echo($row['adminName']); ?></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td height="35" align="right">原始密码：</td>
          <td><input name="oldPass" type="password" id="oldPass" size="30" maxlength="16" /> <span class="red">*</span> <span style="font-size: 12px; color: #666666;">(4-16位字符)</span></td>
      </tr>
        <tr bgcolor="#ffffff">
            <td height="35" align="right">新密码：</td>
          <td><input name="newPass" type="password" id="newPass" size="30" maxlength="16" /> <span class="red">*</span> <span style="font-size: 12px; color: #666666;">(4-16位字符)</span></td>
        </tr>
        <tr bgcolor="#ffffff">
            <td height="35" align="right">重复新密码：</td>
          <td><input name="newPassRe" type="password" id="newPassRe" size="30" maxlength="16" /> <span class="red">*</span> <span style="font-size: 12px; color: #666666;">(4-16位字符)</span></td>
      </tr>
    </table>
    <div class="btm-btn"><input type="button" id="submit" class="btn" value=" 保 存 " /></div>
</div>

</body>
</html>