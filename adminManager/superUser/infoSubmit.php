<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$conn->query("set names utf8");
	$img=htmlspecialchars($_POST['img']);
	$bdy=htmlspecialchars($_POST['bdy']);
	$intro=htmlspecialchars($_POST['intro']);
	$cls=$_POST['cls'];
	if($_POST['id']==0)
	{
		$rql=$conn->prepare('insert into article (img,bdy,intro,cls) values(?,?,?,?)');
	}
	else
	{
		$rql=$conn->prepare('update article set img=?,bdy=?,intro=? where cls=?');
	}
	$rql->bind_param('sssi',$img,$bdy,$intro,$cls);
	if($rql->execute())
		echo(1);
	else
		echo(0);
	
?>
