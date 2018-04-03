<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$conn->query('set names utf8');
	$id=htmlspecialchars($_POST['id']);
	$tle=htmlspecialchars($_POST['tle']);
	$qq=htmlspecialchars($_POST['qq']);

		$classSort=0;
		$rql=$conn->query("select max(sort) from services");
		if($rql->num_rows>0)
		{
			$row=$rql->fetch_array();
			$classSort=$row[0]+1;
		}
		else
		{
			$classSort=1;
		}
		
		if($id==0)
		{
			$uRql=$conn->prepare("insert into services (tle,qq,sort) values(?,?,?)");
			$uRql->bind_param("ssi",$tle,$qq,$classSort);
		}
		else
		{
			$uRql=$conn->prepare("update services set tle=?,qq=? where id=?");
			$uRql->bind_param("ssi",$tle,$qq,$id);
		}
		if($uRql->execute())
			echo(1);
		else
			echo(0);
?>