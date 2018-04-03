<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$id=htmlspecialchars($_POST['id']);
	$oldSort=htmlspecialchars($_POST['oldSort']);
	if($_POST['sortType']=='up')
	{
		$sRql=$conn->prepare("select * from services where sort<? order by sort desc limit 1");
	}
	else
	{
		$sRql=$conn->prepare("select * from services where sort>? order by sort asc limit 1");
	}
	$sRql->bind_param("i",$oldSort);
	$sRql->execute();
	$sRes=$sRql->get_result();
	if($sRes->num_rows>0)
	{
		$sRow=$sRes->fetch_assoc();
		$newId=$sRow['id'];
		$newSort=$sRow['sort'];
		
		$oldRql=$conn->prepare("update services set sort=? where id=?");
		$oldRql->bind_param("ii",$newSort,$id);
		$oldRql->execute();
		
		$newRql=$conn->prepare("update services set sort=? where id=?");
		$newRql->bind_param("ii",$oldSort,$newId);
		$newRql->execute();
		
		echo(1);
	}
?>