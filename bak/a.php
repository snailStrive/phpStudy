<?php
session_start();
if(isset($_SESSION['myUser']))
	echo($_SESSION['myUser']);
else
	echo('您的session未定义！');

session_destroy();
?>