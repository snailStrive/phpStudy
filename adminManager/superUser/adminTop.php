<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style type="text/css">
		td{font-size:14px}
		#tab a{text-decoration:none; color:#999; display:block; height:40px; line-height:40px;}
		#tab a:hover{color:#fff;}
		a.logout{color:#ff0000; text-decoration:none;}
		a.logout:hover{color:#ff0000; text-decoration:underline;}
		#tab td.de{background:url(/adminRes/resources/images/top-line.gif) no-repeat right top;}
		#tab td.des{background:#f5f5f5 url(resources/images/top-line.gif) no-repeat right top; font-weight:bold;}
		#tab td.des a{color:#ff0000;}
		#tab td.des a:hover{color:#ff0000;}
    </style>
    <script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $("#tab td a").click(function(){
				var x=parent.document.getElementById("frame1");
				var y=(x.contentWindow || x.contentDocument);
				if (y.document)y=y.document;
				var $brother=$(y);
				$brother.find("#main-nav").children("li").children("a.nav-top-item").removeClass("current");
				$brother.find("#main-nav").children("li").children("ul").slideUp();
				$brother.find("#main-nav").find("a.current").removeClass("current");
				$("#tab td").attr("class","de");
				$(this).parent().attr("class","des");
			});
        });
	</script>
</head>

<body background="/adminRes/resources/images/topBG.jpg" style="padding:0px; margin:0px;">
<div style="float:left;">
<table cellpadding="0" cellspacing="0" border="0" id="tab">
	<tr>
		<td width="6" height="40"></td>
		<td width="120" align="center" class="de"><a href="class.php" target="main">网站栏目管理</a></td>
		<td width="120" align="center" class="de"><a href="password.php" target="main">管理员密码</a></td>
		<td width="120" align="center" class="de"><a href="webProfile.php" target="main">网站基本资料</a></td>
		<td width="120" align="center" class="de"><a href="release.php" target="main" style="color:#ff3434; font-weight:bold; font-size:15px;">更新发布</a></td>
	</tr>
</table>
</div>
<div style="float:right; padding-right:10px;">
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td height="40" style="color:#ccc;">欢迎 <span style="color:#fff;">超级管理员</span> 登陆 <a href="logout.php" class="logout" target="_parent">【退出】</a></td>
	</tr>
</table>
</div>
</body>
</html>
