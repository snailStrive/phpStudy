<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$conn->query("set names utf8");
	$rql=$conn->prepare("update webProfile set webName=?,webUrl=?,webCopyright=?,webCopyrights=?,webIcp=?,webPower=?,webKey=?,webIntro=?");
	$webName=htmlspecialchars($_POST['webName']);
	$webUrl=htmlspecialchars($_POST['webUrl']);
	$webCopyright=htmlspecialchars($_POST['webCopyright']);
	$webCopyrights=htmlspecialchars($_POST['webCopyrights']);
	$webIcp=htmlspecialchars($_POST['webIcp']);
	$webPower=htmlspecialchars($_POST['webPower']);
	$webKey=htmlspecialchars($_POST['webKey']);
	$webIntro=htmlspecialchars($_POST['webIntro']);
	$rql->bind_param("ssssssss",$webName,$webUrl,$webCopyright,$webCopyrights,$webIcp,$webPower,$webKey,$webIntro);
	$rql->execute();
	if($rql)
		echo(1);
	else
		echo(0);
?>