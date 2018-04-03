<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员登录</title>
	<link href="../adminRes/resources/css/reset.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="../adminRes/resources/css/style.css" type="text/css" rel="stylesheet" media="screen" />
    <link href="../adminRes/resources/css/invalid.css" type="text/css" rel="stylesheet" media="screen" />
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../adminRes/resources/scripts/login.js"></script>
</head>

<body id="login">
    <div id="login-wrapper" class="png_bg">
	    <div id="login-top">
		    <h1>Simpla Admin</h1>
		    <img id="logo" src="../adminRes/resources/images/logo.jpg" alt="Simpla Admin logo" />
	    </div> <!-- End #logn-top -->
	    <div id="login-content">
		    <form id="adminLogin">
		    <div class="notification information png_bg">
			    <div>Just click "登录" to management</div>
		    </div>
		    <p><label>　帐户名 :</label><input type="text" class="text-input" id="userName" name="userName" maxlength="16" />&nbsp;(4-16 位字母、数字、下划线)</p>
		    <p><label>帐户密码 :</label><input type="password" class="text-input" id="userPass" name="userPass" maxlength="16" />&nbsp;(4-16 位字符)</p>
		    <p><label>　验证码 :</label><input type="text" class="text-input rndCode" id="rndCode" name="rndCode" maxlength="4" />&nbsp;<img id="rndCodeImg" alt="验证码" src="Captcha/" style="border:0; cursor:pointer;" /></p>
		    <p style="padding-top:0px; text-align:center;"><input class="button" id="submit" type="button" value=" 登 录 " style="float:none; width:128px; height:40px; font-size:16px!important; margin:10px 0 0 0;" /></p>
		    </form>
	    </div>
    </div>
</body>
</html>