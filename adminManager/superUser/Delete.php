<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$tab=addslashes($_POST['tab']);
	$rql=$conn->prepare("delete from ".$tab." where id=?");
	$rql->bind_param("i",$_POST['id']);
	if($rql->execute())
		echo(1);
	else
		echo(0);
	
?>