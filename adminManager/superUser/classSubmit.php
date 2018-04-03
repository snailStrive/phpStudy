<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$conn->query('set names utf8');
	$stsm=$conn->prepare("select id from class where className=? and id<>?");
	$id=htmlspecialchars($_POST['id']);
	$className=htmlspecialchars($_POST['className']);
	$classFather=htmlspecialchars($_POST['classFather']);
	$classIndex=htmlspecialchars($_POST['classIndex']);
	$classType=htmlspecialchars($_POST['classType']);
	$stsm->bind_param("si",$className,$id);
	$stsm->execute();
	$rs=$stsm->get_result();
	if($rs->num_rows>0)
	{
		echo(0);
	}
	else
	{
		$tt=$conn->prepare("select max(classSort) from class where classFather=?");
		$tt->bind_param("i",$classFather);
		$tt->execute();
		$ttRs=$tt->get_result();
		$classSort=0;
		if($ttRs->num_rows>0)
		{
			$row=$ttRs->fetch_array();
			$classSort=$row[0]+1;
		}
		else
		{
			$classSort=1;
		}
		$classIndex=$classIndex==0?$classSort:$classIndex;
		$classHidden=0;
		
		if($_POST['id']==0)
		{
			$stm=$conn->prepare("insert into class (className,classType,classFather,classHidden,classSort,classIndex) values(?,?,?,?,?,?)");
			$stm->bind_param("ssibii",$className,$classType,$classFather,$classHidden,$classSort,$classIndex);
			$stm->execute();
		}
		else
		{
			if($_POST['oldFather']==$_POST['classFather'])
			{
				$stm=$conn->prepare("update class set className=?,classType=?,classFather=?,classHidden=? where id=?");
				$stm->bind_param("ssibi",$className,$classType,$classFather,$classHidden,$id);
			}
			else
			{
				$stm=$conn->prepare("update class set className=?,classType=?,classFather=?,classHidden=?,classSort=?,classIndex=? where id=?");
				$stm->bind_param("ssibiii",$className,$classType,$classFather,$classHidden,$classSort,$classIndex,$id);
			}
			$stm->execute();
		}
		
		echo(1);
	}
?>