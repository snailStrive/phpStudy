<?php
	session_start();
	if(!isset($_SESSION['adminUserName']))
	{
		echo("<script>alert('非法的登录或登录超时，请重新登录');location.href='/login666/';</script>");
		exit;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员后台操作系统</title>
</head>

<frameset cols="200,*" frameborder="0" border="0" framespacing="0">
	<frame src="adminLeft.php" frameborder="0" id="frame1" noresize="noresize" scrolling="no" marginheight="0" marginwidth="0" />
	<frameset rows="40,*" frameborder="0" border="0" framespacing="0">
		<frame src="adminTop.php" frameborder="0" id="frame2" noresize="noresize" scrolling="no" marginheight="0" marginwidth="0" />
		<frame src="adminMain.php" name="main" frameborder="0" noresize="noresize" marginheight="0" marginwidth="0" />
	</frameset>
</frameset><noframes></noframes>

</html>