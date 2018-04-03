<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$rql=$conn->prepare('update class set classHidden=? where id=?');
	$hideOn=htmlspecialchars($_POST['hideOn']);
	$id=htmlspecialchars($_POST['id']);
	$rql->bind_param('ii',$hideOn,$id);
	$rql->execute();
?>