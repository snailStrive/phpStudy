<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
		$(function(){
			$("#showSearch").click(function(){
				if($("#search").css("display")=="none")
					$("#search").slideDown();
				else
					$("#search").slideUp();
			});
			$("#exitSearch").click(function(){
				$("#search").slideUp();
			});
			$("#toSearch").click(function(){
				if($("#sType").val()==""||$("#sValue").val()=="")
				{
					alert("请输入要查询的信息！")
					return false;
				}
				if($("#sType").val()==1)
				{
					if(isNaN($("#sValue").val()))
					{
						alert("请输入有效的ID！");
						return false;
					}
				}
				location.href=$(this).attr("data-url")+"&sType="+$("#sType").val()+"&sValue="+$("#sValue").val();
			});
			$(".operate-del").click(function(){
				var id=$(this).attr("data-id");
				if(confirm("是否确认删除该信息！"))
				{
					$.post("Delete.php",{"tab":"photo","id":id},function(data){
						if(data==1)
							location.href=location.href;
						else
							alert("信息删除失败！");
					});
				}
			});
			$(".articleHidden").click(function(){
				var hideOn=$(this).attr("class").indexOf("1")>0?0:1;
				var id=$(this).attr("data-id");
				var me=this;
				$.post("photoHidden.php",{"id":id,"hideOn":hideOn},function(data){
					$(me).attr("class","iconfont articleHidden classHidden"+hideOn);
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
				$.post("photoSort.php",{"id":id,"pos":movePos,"cls":<?php echo($_GET['cls']);?>,"oldSort":oldSort},function(data){
					if(data==1)
						location.href=location.href;
					else
						alert("信息排序失败！");
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
	$sType=isset($_GET['sType'])?$_GET['sType']:'';
	$sValue=isset($_GET['sValue'])?$_GET['sValue']:'';
	$para="cls={$_GET['cls']}&css={$_GET['css']}&title={$_GET['title']}&page=$page";
	$paraSearch="&sType=$sType&sValue=$sValue";
?>
<div id="tab">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" id="info">
    	<tr>
        	<td height="40" width="50%">后台管理系统 >> <?php echo($_GET['title'])?>管理 >> 信息列表 </td>
            <td width="50%" align="right"><input type="button" value="信息检索" id="showSearch" name="showSearch" />&emsp;<input type="button" value="添加新信息" id="addClass" onclick="location.href='photoEdit.php?<?php echo($para.$paraSearch);?>';" /></td>
        </tr>
    </table>
    <div id="search">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color:transparent;">
            <tr>
                <td height="50" style="font-size:14px; color:#333333"><b>文章检索：</b><select name="sType" id="sType" style="padding:0;"><option value="">请选择</option><option value="1">ID</option><option value="2">标题</option></select> <input name="sValue" type="text" id="sValue" class="input" size="12" maxlength="12" /> <input type="button" id="toSearch" value="提交" class="button" data-url="photo.php?<?php echo($para);?>" /> <input type="button" value="显示全部" onclick="location.href='photo.php?<?php echo($para);?>'" class="button" /> <input type="button" class="button" value="退出检索" id="exitSearch" name="exitSearch" /></form></td>
            </tr>
        </table>
    </div>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabList">
        <tr bgcolor="#ffffff">
            <td width="8%" height="30" align="center">ID</td>
            <td width="40%" class='tableTitle'>标题</td>
            <td width="10%" align="center">图片</td>
            <td width="12%" align="center">栏目</td>
            <td width="8%" align="center">显示</td>
            <td width="12%" align="center"><?php if($sort){?>排序<?php }else{?>日期<?php }?></td>
            <td width="10%" align="center">操作</td>
        </tr>
        <?php
		$conn->query("set names utf8");
		if($sort)
			$sortSql=" order by photo.sort asc";
		else
			$sortSql=" order by photo.id desc";
		if($sType=='')
		{
			$sql='select photo.id,photo.tle,photo.dte,photo.display,photo.img,photo.sort,photo.imgTop,class.className from photo inner join class on photo.cls=class.id where photo.cls=?';
			$rql=$conn->prepare($sql.$sortSql);
			$rql->bind_param("i",$_GET['cls']);
			
		}
		else
		{
			if($sType==1)
			{
				$sql='select photo.id,photo.tle,photo.dte,photo.display,photo.img,photo.sort,photo.imgTop,class.className from photo inner join class on photo.cls=class.id where photo.cls=? and photo.id=?';
				$rql=$conn->prepare($sql.$sortSql);
				$rql->bind_param("ii",$_GET['cls'],$sValue);
			}
			else
			{
				$sql='select photo.id,photo.tle,photo.dte,photo.display,photo.img,photo.sort,photo.imgTop,class.className from photo inner join class on photo.cls=class.id where photo.cls=? and photo.tle like ?';
				$rql=$conn->prepare($sql.$sortSql);
				$sValue='%'.$sValue.'%';
				$rql->bind_param("is",$_GET['cls'],$sValue);
			}
		}
		
		$rql->execute();
		$res=$rql->get_result();
		while($row=$res->fetch_assoc())
		{
			if(empty($row['img']))
				$img='';
			else
			{
				$imgArr=explode('|',$row['img']);
				$img=$imgArr[$row['imgTop']];
			}?>
        <tr bgcolor="#FFFFFF">
            <td align="center"><?php echo($row["id"]);?></td>
            <td><?php echo($row["tle"])?></td>
            <td align="center" class="gry" style="padding:10px 0;"><img src="<?php echo($img);?>" style="max-height:60px;" /></td>
            <td align="center"><?php echo($row["className"]);?></td>
            <td align="center"><i class="iconfont articleHidden classHidden<?php echo($row['display']);?>" data-id="<?php echo($row['id']);?>">&#xe656;</i></td>
            <td align="center" class="tabTdSort" data-id="<?php echo($row['id']);?>" data-sort='<?php echo($row['sort']);?>'><?php if($sort){?>移至<input type="text" />位 <input type="button" value="跳转" /><?php }else{?><i class="iconfont articleTop classHidden<?php echo($row['recommend']);?>" data-id="<?php echo($row['id']);?>">&#xe656;</i><?php }?></td>
            <td align="center"><a href="photoEdit.php?id=<?php echo($row["id"]."&".$para.$paraSearch);?>" title="修改" class="operate-edit">&nbsp;</a>　<a href="javascript:;" data-id="<?php echo($row['id']);?>" title="删除" class="operate-del">&nbsp;</a></td>
        </tr>
		<?php }?>
    </table>
</div>

</body>
</html>