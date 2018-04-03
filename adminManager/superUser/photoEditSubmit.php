<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$conn->query('set names utf8');
	$id=htmlspecialchars($_POST['id']);
	$tle=htmlspecialchars($_POST['tle']);
	$cls=htmlspecialchars($_POST['cls']);
	$imgTop=htmlspecialchars($_POST['imgTop']);
	$imgTxt=htmlspecialchars($_POST['imgTxt']);
	$img=htmlspecialchars($_POST['img']);
	$bdy=htmlspecialchars($_POST['bdy']);
	$hit=htmlspecialchars($_POST['hit']);
	if($_POST['dte']=="null")
		$dte=date("Y/m/d h:i:s");
	else
		$dte=htmlspecialchars($_POST['dte']);
	$intro=htmlspecialchars($_POST['intro']);
	if($id==0)
	{
		if($_POST['sort']==1)
		{
			$sortRql=$conn->prepare("select max(sort) from photo where cls=?");
			$sortRql->bind_param('i',$cls);
			$sortRql->execute();
			$sortRes=$sortRql->get_result();
			if($sortRes->num_rows>0)
			{
				$sortRow=$sortRes->fetch_array();
				$sort=$sortRow[0]+1;
			}
			else
			{
				$sort=1;
			}
			
			$rql=$conn->prepare("insert into photo (tle,cls,imgTop,imgTxt,img,bdy,hit,dte,intro,sort) values(?,?,?,?,?,?,?,?,?,?)");
			$rql->bind_param("sissssissi",$tle,$cls,$imgTop,$imgTxt,$img,$bdy,$hit,$dte,$intro,$sort);
		}
		else
		{
			$rql=$conn->prepare("insert into photo (tle,cls,imgTop,imgTxt,img,bdy,hit,dte,intro) values(?,?,?,?,?,?,?,?,?)");
			$rql->bind_param("sissssiss",$tle,$cls,$src,$wrt,$img,$bdy,$hit,$dte,$intro);
		}
		if($rql->execute())
			echo(1);
		else
			echo(0);
	}
	else
	{
		$rql=$conn->prepare("update photo set tle=?,cls=?,imgTop=?,imgTxt=?,img=?,bdy=?,hit=?,dte=?,intro=? where id=?");
		$rql->bind_param("sissssissi",$tle,$cls,$imgTop,$imgTxt,$img,$bdy,$hit,$dte,$intro,$id);
		if($rql->execute())
			echo(1);
		else
			echo(0);
	}
?>