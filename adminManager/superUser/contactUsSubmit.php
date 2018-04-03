<?php
	include('adminCheck.php');
	include('../../inc/conn.php');
	$conn->query("set names utf8");
	$name=htmlspecialchars($_POST['name']);
	$phone=htmlspecialchars($_POST['phone']);
	$tel=htmlspecialchars($_POST['tel']);
	$fax=htmlspecialchars($_POST['fax']);
	$post=htmlspecialchars($_POST['post']);
	$address=htmlspecialchars($_POST['address']);
	$qq=htmlspecialchars($_POST['qq']);
	$email=htmlspecialchars($_POST['email']);
	$weixin=htmlspecialchars($_POST['weixin']);
	$QRcode=htmlspecialchars($_POST['QRcode']);
	$bus=htmlspecialchars($_POST['bus']);
	$mapPos=htmlspecialchars($_POST['mapPos']);
	$mapKey=htmlspecialchars($_POST['mapKey']);
	$rql=$conn->prepare("update contact set name=?,phone=?,tel=?,fax=?,post=?,address=?,qq=?,email=?,weixin=?,QRcode=?,bus=?,mapPos=?,mapKey=?");
	$rql->bind_param("sssssssssssss",$name,$phone,$tel,$fax,$post,$address,$qq,$email,$weixin,$QRcode,$bus,$mapPos,$mapKey);
	$rql->execute();
	if($rql)
		echo(1);
	else
		echo(0);
?>