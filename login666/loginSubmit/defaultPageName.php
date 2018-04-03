<?php
session_start();
if(empty($_POST['rndCode']))
{
	header("location:../");
	exit;
}
if(strtolower($_SESSION["rndCode"])==strtolower($_POST['rndCode']))
{
	include("../../inc/conn.php");
	$bbb=md5($_POST['userPass']).'a6';

	$stm=$conn->prepare("select * from adminUser where adminName=? and adminPass=?");
	$stm->bind_param("ss",$_POST['userName'],$bbb);
	$stm->execute();
	$rs=$stm->get_result();
	if($rs->num_rows>0)
	{
		$row=$rs->fetch_assoc();
		$_SESSION['adminUserName']=$row['adminName'];
		echo('/adminManager/superUser/');
	}
	else
	{
		echo(0);
	}
}
else
{
	echo(2);
}
?>