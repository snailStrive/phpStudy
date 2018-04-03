<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
		$(function(){
			$("#release").click(function(){
				$.get("releaseCreate.php?t="+Math.random(),function(data){
					if(data==1)
						alert("更新发布成功！");
					else
						alert("更新发布失败，请检查文件夹权限！");
				});
			});
		});
	</script>
</head>

<body style="background-color:#eee;">
	<?php include("adminCheck.php");?>
	<div style="font-size:18px; text-align:center; padding-top:100px; font-family:'微软雅黑';">
    	您是否要对所做的操作进行更新发布，更新发布的时间会有些长，请耐心等待。
    </div>
    <div style="text-align:center; padding-top:50px;">
    	<input style="height:45px; font-size:16px; border-radius:2px;" type="button" class="btn" value="确认更新发布" id="release" />
    </div>
</body>
</html>