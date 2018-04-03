<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	if($_POST['sortType']=='up')
	{
		$sRql=$conn->prepare("select * from class where classSort<? and classFather=? order by classSort desc limit 1");
	}
	else
	{
		$sRql=$conn->prepare("select * from class where classSort>? and classFather=? order by classSort asc limit 1");
	}
	$id=htmlspecialchars($_POST['id']);
	$oldSort=htmlspecialchars($_POST['oldSort']);
	$classFather=htmlspecialchars($_POST['classFather']);
	$sRql->bind_param("ii",$oldSort,$classFather);
	$sRql->execute();
	$sRes=$sRql->get_result();
	if($sRes->num_rows>0)
	{
		$sRow=$sRes->fetch_assoc();
		$newId=$sRow['id'];
		$newSort=$sRow['classSort'];
		
		$oldRql=$conn->prepare("update class set classSort=? where id=?");
		$oldRql->bind_param("ii",$newSort,$id);
		$oldRql->execute();
		
		$newRql=$conn->prepare("update class set classSort=? where id=?");
		$newRql->bind_param("ii",$oldSort,$newId);
		$newRql->execute();
		
		echo(1);
	}
	else
	{
		echo(0);
	}
?>