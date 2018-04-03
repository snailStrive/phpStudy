<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
		$(function(){
			$(".operate-del").click(function(){
				var id=$(this).attr("data-id");
				if(confirm("是否确认删除该信息！"))
				{
					$.post("Delete.php",{"tab":"article","id":id},function(data){
						if(data==1)
							location.href=location.href;
						else
							alert(data);
					});
				}
			});
			$(".articleHidden").click(function(){
				var hideOn=$(this).attr("class").indexOf("1")>0?0:1;
				var id=$(this).attr("data-id");
				var me=this;
				$.post("articleHidden.php",{"id":id,"hideOn":hideOn},function(data){
					$(me).attr("class","iconfont articleHidden classHidden"+hideOn);
				});
			});
			$(".articleTop").click(function(){
				var hideOn=$(this).attr("class").indexOf("1")>0?0:1;
				var id=$(this).attr("data-id");
				var me=this;
				$.post("articleTop.php",{"id":id,"hideOn":hideOn},function(data){
					$(me).attr("class","iconfont articleTop classHidden"+hideOn);
				});
			});
			$(".tabTdSort input[type=button]").click(function(){
				var movePos=$(this).parent().children("input[type=text]").val();
				if(movePos==""||isNaN(movePos))
				{
					alert("请正确输入移至数位!");
					return false;
				}
				var id=$(this).parent().attr("data-id");
				var oldSort=$(this).parent().attr("data-sort");
				$.post("articleSort.php",{"id":id,"pos":movePos,"cls":<?php echo($_GET['cls']);?>,"oldSort":oldSort},function(data){
					if(data==1)
						location.href=location.href;
					else
						alert(data);
				});
			});
		});
	</script>
</head>

<body>
<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$sort=strpos($_GET['css'],'sort')!==false;
	$page=isset($_GET["page"])?$_GET["page"]:1;
?>
<div id="tab">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" id="info">
    	<tr>
        	<td height="40" width="50%">后台管理系统 >> <?php echo($_GET['title'])?>管理 >> 信息列表 </td>
            <td width="50%" align="right"><input type="button" value="添加新信息" id="addClass" onclick="location.href='articleEdit.php?cls=<?php echo($_GET['cls']);?>&css=<?php echo($_GET['css']);?>&title=<?php echo($_GET['title']);?>&page=<?php echo($page);?>';" /></td>
        </tr>
    </table>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabList">
        <tr bgcolor="#ffffff">
            <td width="8%" height="30" align="center">ID</td>
            <td width="40%" class='tableTitle'>标题</td>
            <td width="12%" align="center">栏目</td>
            <td width="10%" align="center">日期</td>
            <td width="8%" align="center">显示</td>
            <td width="12%" align="center"><?php if($sort){?>排序<?php }else{?>置顶<?php }?></td>
            <td width="10%" align="center">操作</td>
        </tr>
        <?php
		$conn->query("set names utf8");
		if($sort)
			$sql="select article.id,article.tle,article.dte,article.display,article.recommend,article.img,article.sort,class.className from article inner join class on article.cls=class.id where article.cls=? order by article.sort asc";
		else
			$sql="select article.id,article.tle,article.dte,article.display,article.recommend,article.img,article.sort,class.className from article inner join class on article.cls=class.id where article.cls=? order by article.recommend desc,article.id desc";
		$rql=$conn->prepare($sql);
		$rql->bind_param("i",$_GET['cls']);
		$rql->execute();
		$res=$rql->get_result();
		while($row=$res->fetch_assoc())
		{?>
        <tr bgcolor="#FFFFFF">
            <td align="center"><?php echo($row["id"]);?></td>
			<?php $tle=!empty($row["img"])?$row["tle"]."<span class='red'>&nbsp;[图]</span>":$row["tle"];?>
            <td><?php echo($tle)?></td>
            <td align="center"><?php echo($row["className"]);?></td>
            <td align="center" class="gry"><?php echo(substr($row["dte"],0,10));?></td>
            <td align="center"><i class="iconfont articleHidden classHidden<?php echo($row['display']);?>" data-id="<?php echo($row['id']);?>">&#xe656;</i></td>
            <td align="center" class="tabTdSort" data-id="<?php echo($row['id']);?>" data-sort='<?php echo($row['sort']);?>'><?php if($sort){?>移至<input type="text" />位 <input type="button" value="跳转" /><?php }else{?><i class="iconfont articleTop classHidden<?php echo($row['recommend']);?>" data-id="<?php echo($row['id']);?>">&#xe656;</i><?php }?></td>
            <td align="center"><a href="articleEdit.php?id=<?php echo($row["id"]);?>&page=1&cls=<?php echo($_GET['cls']);?>&css=<?php echo($_GET['css']);?>&title=<?php echo($_GET["title"]);?>" title="修改" class="operate-edit">&nbsp;</a>　<a href="javascript:;" data-id="<?php echo($row['id']);?>" title="删除" class="operate-del">&nbsp;</a></td>
        </tr>
		<?php }?>
    </table>
</div>

</body>
</html>