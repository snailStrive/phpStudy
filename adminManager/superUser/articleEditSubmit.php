<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$conn->query('set names utf8');
	$id=htmlspecialchars($_POST['id']);
	$tle=htmlspecialchars($_POST['tle']);
	$cls=htmlspecialchars($_POST['cls']);
	$src=htmlspecialchars($_POST['src']);
	$wrt=htmlspecialchars($_POST['wrt']);
	$img=htmlspecialchars($_POST['img']);
	$bdy=htmlspecialchars($_POST['bdy']);
	$url=htmlspecialchars($_POST['url']);
	$hit=htmlspecialchars($_POST['hit']);
	if($_POST['dte']=="null")
		$dte=date("Y/m/d h:i:s");
	else
		$dte=htmlspecialchars($_POST['dte']);
	$keyword=htmlspecialchars($_POST['keyword']);
	$intro=htmlspecialchars($_POST['intro']);
	if($id==0)
	{
		if($_POST['sort']==1)
		{
			$sortRql=$conn->prepare("select max(sort) from article where cls=?");
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
			
			$rql=$conn->prepare("insert into article (tle,cls,src,wrt,img,bdy,url,hit,dte,keyword,intro,sort) values(?,?,?,?,?,?,?,?,?,?,?,?)");
			$rql->bind_param("sisssssisssi",$tle,$cls,$src,$wrt,$img,$bdy,$url,$hit,$dte,$keyword,$intro,$sort);
		}
		else
		{
			$rql=$conn->prepare("insert into article (tle,cls,src,wrt,img,bdy,url,hit,dte,keyword,intro) values(?,?,?,?,?,?,?,?,?,?,?)");
			$rql->bind_param("sisssssisss",$tle,$cls,$src,$wrt,$img,$bdy,$url,$hit,$dte,$keyword,$intro);
		}
		if($rql->execute())
			echo(1);
		else
			echo(0);
	}
	else
	{
		$rql=$conn->prepare("update article set tle=?,cls=?,src=?,wrt=?,img=?,bdy=?,url=?,hit=?,dte=?,keyword=?,intro=? where id=?");
		$rql->bind_param("sisssssisssi",$tle,$cls,$src,$wrt,$img,$bdy,$url,$hit,$dte,$keyword,$intro,$id);
		if($rql->execute())
			echo(1);
		else
			echo(0);
	}
?>