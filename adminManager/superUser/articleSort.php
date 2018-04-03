<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$sRql=$conn->prepare("select sort from article where cls=? order by sort asc limit ".($_POST['pos']-1).",1");
	$sRql->bind_param("i",$_POST['cls']);
	$sRql->execute();
	$sRes=$sRql->get_result();
	$sRow=$sRes->fetch_array();
	$posiSort=$sRow[0];
	
	if($posiSort<$_POST['oldSort'])
	{
		$rql=$conn->prepare("update article set sort=sort+1 where sort>=? and cls=?");
		$rql->bind_param("ii",$posiSort,$_POST['cls']);
		$rql->execute();
	}
	else
	{
		$rql=$conn->prepare("update article set sort=sort-1 where sort<=? and cls=?");
		$rql->bind_param("ii",$posiSort,$_POST['cls']);
		$rql->execute();
	}
	
	$nRql=$conn->prepare("update article set sort=? where id=?");
	$nRql->bind_param("ii",$posiSort,$_POST['id']);
	$nRql->execute();
	echo(1);
?>