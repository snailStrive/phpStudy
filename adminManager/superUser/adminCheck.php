<?php
	session_start();
	if(empty($_SESSION['adminUserName']))exit("<script>alert('登陆超时或连接错误!');parent.location.href='login.php';</script>");
?>