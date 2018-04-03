<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$oldPass=md5($_POST['oldPass']).'a6';
	$rql=$conn->prepare("select * from adminUser where `adminName`='admin' and adminPass=?");
	$rql->bind_param('s',$oldPass);
	$rql->execute();
	$res=$rql->get_result();
	if($res->num_rows>0)
	{
		$newPass=md5($_POST['newPass']).'a6';
		$editRql=$conn->prepare('update adminUser set adminPass=?');
		$editRql->bind_param('s',$newPass);
		$editRql->execute();
		echo(1);
	}
	else
	{
		echo(0);
	}
?>