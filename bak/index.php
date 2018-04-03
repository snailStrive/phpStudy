<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post" action="<?php echo(htmlspecialchars($_SERVER['PHP_SELF']));?>">
	<input type="text" name="yourInput"><br>
	<input type="submit" value="提交">
</form>
<?php
	$a=5;
	$b='abc';
	$c=array('Li','Hua');
	$d=10.568;
	$e=null;
	$f='who ';
	$f.=$b;
	define('myName','Li ming');
	echo("My name is {$c[0]}<br>");
	
	echo('<br>');
	var_dump($e);
	echo('<br>');
	echo(strlen($b).'<br>');
	echo(strpos($b,'a').'<br>');
	echo(myName.'<br>');
	echo($f.'<br>');
	echo(5=='5');

	$x=array('1'=>'aaa','2'=>'bbb');
	$y=array('3'=>'ccc','4'=>'ddd');
	$z=$x+$y;
	var_dump($z);
	var_dump($x==$y);

	$date=date('H');
	if($date==20)
		echo("yes $date");
	elseif($date==5)
		echo('no');
	else
		echo('...');
	
	switch($date)
	{
		case 20:
			echo('20');
			break;
		case 5:
			echo('5');
			break;
		default:
			echo('000');
	}
	echo('<br>');

	$m=1;
	while($m<30)
	{
		echo("this is $m<br>");
		$m*=2;
	}

	for($h=0;$h<5;$h++)
	{
		echo("数字=$h ；");
	}

	foreach($c as $aa)
	{
		echo("当前的值为 {$aa}；");
	}
	echo('<br>');

	function myFunc($i=3)
	{
		echo("您所输入的数字为：$i<br>");
	}
	myFunc(1);
	myFunc();

	function getDates($ddd='lll')
	{
		return "AAA$ddd<br>";
	}
	$xxx=getDates();
	echo($xxx);
	echo(count($c).'<br>');

	$cArr=count($c);
	for($ccc=0;$ccc<$cArr;$ccc++)
	{
		echo($c[$ccc].'<br>');
	}
	echo($x['2'].'<br>');

	foreach($y as $key=>$val)
	{
		echo("Key is $key ； value is $val <br>");
	}

	var_dump($c);
	echo('<br>');
	sort($c);
	var_dump($c);

	$jjj=30;
	$kkk=60;
	function tmpFunc($jjj=30,$kkk=60)
	{
		$GLOBALS['lll']=$jjj+$kkk;
	}
	tmpFunc();
	echo($GLOBALS['lll'].'<br>');
	echo($_SERVER['HTTP_HOST'].'<br>');

	$yourInput=@$_POST['yourInput'];
	echo($yourInput);

	date_default_timezone_set("Asia/Shanghai");
	echo(date("Y/m/d h:i:s").'<br>');

	$tmpDate=mktime(8,0,0,12,16,1984);
	echo(date("Y/m/d h:i:s",$tmpDate).'<br>');

	$aDate=strtotime("+4 Days");
	echo(date("Y/m/d",$aDate).'...<br>');

	$bDate=strtotime("Sunday");
	$cDate=strtotime("+6 weeks",$bDate);
	while($bDate<$cDate)
	{
		echo(date("Y/m/d",$bDate).'<br>');
		$bDate=strtotime("+1 week",$bDate);
	}
	echo(date("Y/m/d",time()/60/60/24).'<br>');

	$d1=strtotime("2018-4-1");
	$d2=ceil(($d1-time())/60/60/24);
	echo($d2.'<br>');

	//require('abc.php');
	$myfile=fopen('1.txt','r') or die('文件打开失败！');
	echo(fread($myfile,filesize("1.txt")).'<br>');
	fclose($myfile);

	$eFile=fopen('1.txt','r') or die('文件打开失败！');
	while(!feof($eFile))
	{
		echo(fgets($eFile).'<br>');
	}
	fclose($eFile);

	/*$aFile=fopen('1.txt','a');
	fwrite($aFile,"Li yan yi \n");
	fclose($aFile);*/

	setcookie('adminUser','Li ming',time()+60);
	if(isset($_COOKIE['adminUser']))
		echo($_COOKIE['adminUser']);
	else
		echo('您访问的cookie不存在！');

	session_start();
	$_SESSION['myUser']='Hua Lin Jiao';

	echo('<br>');
	$int='123';
	$int_options=array(
		"options"=>array("min_range"=>0,"max_range"=>256)
	);
	if(filter_var($int,FILTER_VALIDATE_INT,$int_options))
	{
		echo('变量过滤正常！');
	}
	else
	{
		echo('发现在潜在危险数据！');
	}
	echo('<br>');

	
	$conn=new mysqli('localhost','root','','test');
	$conn->query('set names utf8;');
	$rs=$conn->query('select * from human');
	while($row=mysqli_fetch_assoc($rs))
	{
		echo("My name is {$row['name']}<br>");
	}
	mysqli_close($conn);
	//$row=mysqli_query


	

	//mail('1165116464@qq.com','one mail','测试邮件','From: 109365129@qq.com');


	class myObj{
		var $tt;
		function func1($tt='123'){
			$this->tt=$tt;
		}
		function getFunc(){
			return $this->tt;
		}
	}
?>

<form method="post" action="upload.php" enctype="multipart/form-data">
	<input type="file" name="file" id="file"><br>
	<input type="submit" value="上传">
</form>
</body>
</html>