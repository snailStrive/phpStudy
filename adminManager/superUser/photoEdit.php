<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$conn->query('set names utf8');
	$title=$_GET['title'];
	$cls=$_GET['cls'];
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$rql=$conn->prepare("select * from photo where id=?");
		$rql->bind_param("i",$id);
		$rql->execute();
		$res=$rql->get_result();
		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
			$tle=$row['tle'];
			$dte=$row['dte'];
			$imgTop=$row['imgTop'];
			$imgTxt=$row['imgTxt'];
			$img=$row['img'];
			$bdy=$row['bdy'];
			$intro=$row['intro'];
			$hit=$row['hit'];
			
			if(!empty($img))
			{
				$imgs=explode("|",$img);
				$imgTxts=explode("|",$imgTxt);
				$txt="<div class='mulImgBtn'><input type='button' id='J_selectImage' value='批量上传' class='btn-del' /></div><div id='J_imageView'>";
				for($n=0; $n<count($imgs); $n++)
				{
					if($n==$imgTop)
						$txt.="<div class='mulImg'><table cellpadding='0' cellspacing='0' border='0'><tr><td valign='bottom' width='180' height='100'><img src='".$imgs[$n]."' /></td></tr></table><span><input type='text' value='".$imgTxts[$n]."' />&nbsp;<a href='javascript:;' class='mulImgTop mulImgTopOn'>置顶</a>&nbsp;<a href='javascript:;' class='mulImgDel' title='删除'>&nbsp;</a></span></div>";
					else
						$txt.="<div class='mulImg'><table cellpadding='0' cellspacing='0' border='0'><tr><td valign='bottom' width='180' height='100'><img src='".$imgs[$n]."' /></td></tr></table><span><input type='text' value='".$imgTxts[$n]."' />&nbsp;<a href='javascript:;' class='mulImgTop'>置顶</a>&nbsp;<a href='javascript:;' class='mulImgDel' title='删除'>&nbsp;</a></span></div>";
					
				}
				$txt.="</div>";
				
			}
			
		}
		else
		{
			echo("<script>alert('编辑的信息不存在！');history.go(-1);</script>");
		}
	}
	else
	{
		$tle='';
		$dte='';
		$imgTop='';
		$imgTxt='';
		$img='';
		$bdy='';
		$intro='';
		$hit=0;
		$id=0;
	}
	$sort=strpos($_GET['css'],'sort')!==false?1:0;
	$para="cls={$_GET['cls']}&css={$_GET['css']}&title={$_GET['title']}&page={$_GET['page']}";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
	<link href="../../kindeditor/plugins/code/prettify.css" type="text/css" rel="stylesheet" />
	<script charset="utf-8" src="../../kindeditor/kindeditor-min.js"></script>
	<script charset="utf-8" src="../../kindeditor/lang/zh_CN.js"></script>
	<script charset="utf-8" src="../../kindeditor/plugins/code/prettify.js"></script>
    <script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
    <script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="bdy"]', {
				cssPath : '/kindeditor/plugins/code/prettify.css',
				uploadJson : '/kindeditor/php/upload_json.php',
				fileManagerJson : '/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
				afterBlur:function(){document.getElementById("bdy").value=editor1.html();}
			});
			prettyPrint();
		});
	</script>
    <script>
		$(function(){
			$("#submit").click(function(){
				var mulImg="";
				var mulTxt="";
				var mulTop=0;
				for(var n=0;n<$(".mulImg").length;n++)
				{
					mulImg=mulImg+$(".mulImg").eq(n).find("img").attr("src")+"|";
					mulTxt=mulTxt+$(".mulImg").eq(n).find("input").attr("value")+"|";
					if($(".mulImg").eq(n).children("span").children("a.mulImgTop").attr("class")=="mulImgTop mulImgTopOn")
					{
						mulTop=n;
					}
				}
				if(mulImg!="")mulImg=mulImg.substr(0,mulImg.length-1);
				if(mulTxt!="")mulTxt=mulTxt.substr(0,mulTxt.length-1);
				
				var tle=$("#tle").val()?$("#tle").val():"";
				var cls=$("#cls").val()?$("#cls").val():"";
				var imgTop=mulTop;
				var imgTxt=mulTxt;
				var img=mulImg;
				var bdy=$("#bdy").val()?$("#bdy").val():"";
				var hit=$("#hit").val()?$("#hit").val():0;
				var dte=$("#dte").val()?$("#dte").val():null;
				var intro=$("#intro").val()?$("#intro").val():"";
				$.post("photoEditSubmit.php",{"id":<?php echo($id)?>,"tle":tle,"cls":cls,"imgTop":imgTop,"imgTxt":imgTxt,"img":img,"bdy":bdy,"hit":hit,"dte":dte,"intro":intro,"sort":<?php echo($sort)?>},function(data){
					if(data==1)
					{
						alert("信息提交成功！");
						location.href="photo.php?<?php echo($para);?>";
					}
					else
						alert("信息提交失败");//
				});
			});
			$(".mulImgTop").live("click",function(){
				$(".mulImgTop").attr("class","mulImgTop");
				$(this).attr("class","mulImgTop mulImgTopOn");
			});
			$(".mulImgDel").live("click",function(){
				var imgUrl=$(this).parent().parent().children("table").find("img").attr("src");
				var me=this;
				var delImgObj=$.get("uploadReset.php",{"img":imgUrl},function(){$(me).parent().parent().remove()});
			});	
		});
	</script>
</head>

<body>
<div id="tab">
    <div class="info">后台管理系统 >> <?php echo($title)?>管理 >> <?php echo($title)?>信息编辑</div>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2" height="30" class="tab-tle"><?php echo($_GET['title']);?>信息编辑<input type="button" value="返回" class="btn-back" onClick="location.href='photo.php?<?php echo($para);?>';" /></td>
        </tr>
        <?php if(strpos($_GET['css'],'tle')!==false){?>
        <tr bgcolor="#ffffff">
            <td width="15%" height="35" align="right"><strong>标题：</strong></td>
            <td width="85%" class="red"><input name="tle" type="text" id="tle" size="72" value="<?php echo($tle)?>" maxlength="60" /></td>
        </tr>
        <?php }if(strpos($_GET['css'],'cls')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td height="35" align="right"><strong>所属栏目：</strong></td>
            <td>
                <?php 
					$classRql=$conn->prepare("select * from class where classFather=?");
					$classRql->bind_param("i",$cls);
					$classRql->execute();
					$classRes=$classRql->get_result();
					if($classRes->num_rows>0)
					{
						echo("<select name='cls' id='cls'>");
						while($classRow=$classRes->fetch_assoc())
						{
							if($classRow["id"]==$cls)
								echo("<option value='".$classRow["id"]."' selected='selected'>".$classRow["className"]."</option>");
							else
								echo("<option value='".$classRow["id"]."'>".$classRow["className"]."</option>");
						}
						echo("</select>");
					}
					else
					{
						echo($title);
						echo("<input type='hidden' name='cls' id='cls' value='$cls'>");
					}
				?>
				<span class="red">*</span>
            </td>
        </tr>
        <?php }else{echo("<input type='hidden' name='cls' id='cls' value='$cls'>");}if(strpos($_GET['css'],'src')!==false){?>
        <?php $webRql=$conn->query("select webName from webProfile");
		$webRow=$webRql->fetch_array();?>
        <tr bgcolor="#ffffff">
            <td align="right" height="35"><b>文章来源：</b></td>
            <td><input name="src" type="text" id="src" value="<?php echo($src)?>" size="20" maxlength="60" />　<a href="#" onclick="document.getElementById('src').value='网上转载';" class="gry">网上转载</a>　<a href="#" onclick="document.getElementById('src').value='媒体报道';" class="gry">媒体报道</a>　<a href="#" onclick="document.getElementById('src').value='<?php echo($webRow[0])?>';" class="gry"><?php echo($webRow[0])?></a></td>
        </tr>
        <?php }if(strpos($_GET['css'],'wrt')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td align="right" height="35"><b>文章作者：</b></td>
            <td><input name="wrt" type="text" id="wrt" value="<?php echo($wrt)?>" size="20" maxlength="20" />　<a href="#" onclick="document.getElementById('wrt').value='佚名';" class="gry">佚名</a>　<a href="#" onclick="document.getElementById('wrt').value='匿名';" class="gry">匿名</a>　<a href="#" onclick="document.getElementById('wrt').value='网站编辑员';" class="gry">网站编辑员</a></td>
        </tr>
        <?php }if(strpos($_GET['css'],'img')!==false){?>
        <script>
		KindEditor.ready(function(K) {	
			var editor = K.editor({
				cssPath : '/kindeditor/plugins/code/prettify.css',
				uploadJson : '/kindeditor/php/upload_json.php',
				fileManagerJson : '/kindeditor/php/file_manager_json.php',
				allowFileManager : true,
			});
			prettyPrint();
			K('#J_selectImage').click(function() {
				editor.loadPlugin('multiimage', function() {
					editor.plugin.multiImageDialog({
						clickFn : function(urlList) {
							var div = K('#J_imageView');
							K.each(urlList, function(i, data) {
								div.append("<div class='mulImg'><table cellpadding='0' cellspacing='0' border='0'><tr><td valign='bottom' width='180' height='100'><img src='"+data.url+"' /></td></tr></table><span><input type='text' />&nbsp;<a href='javascript:;' class='mulImgTop'>置顶</a>&nbsp;<a href='javascript:;' class='mulImgDel' title='删除'>&nbsp;</a></span></div>");
							});
							editor.hideDialog();
						}
					});
				});
			});
		});
		</script>
        <tr bgcolor="#ffffff">
            <td height="60" align="right" style="line-height:16px"><strong>图片：</strong><div style="font-size:12px; color:#666666; padding:0px">单张图片小于1M</div></td>
            <td>
            	<input type="hidden" name="img" id="img" value="<?php echo($img);?>" />
            	<?php if(empty($img)){?>
            	<div class="mulImgBtn"><input type="button" id="J_selectImage" value="批量上传" class="btn-del" /></div>
                <div id="J_imageView"></div>
            	<?php }else{ echo($txt); }?>
            </td>
        </tr>
        <?php }if(strpos($_GET['css'],'bdy')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td align="right" valign="top" style="padding-top:15px;"><strong>详细内容：</strong></td>
            <td style="padding:13px 5px;"><textarea name="bdy" id="bdy" style="width:800px;height:360px;visibility:hidden;"><?php echo($bdy)?></textarea></td>
        </tr>
        <?php }if(strpos($_GET['css'],'url')!==false){?>
        <tr bgcolor="#ffffff">
            <td width="15%" align="right"><b>链接到：</b></td>
            <td width="85%" class="gry"><input name="url" type="text" id="url" value="<?php echo($url)?>" size="40" maxlength="100" /> 链接以 http:// 开头</td>
        </tr>
        <?php }if(strpos($_GET['css'],'hit')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td align="right"><b>点击数：</b></td>
            <td><input name="hit" type="text" id="hit" value="<?php echo($hit)?>" size="40" maxlength="10" /></td>
        </tr>
        <!--<tr bgcolor="#ffffff">
            <td align="right"><b>视频HTML代码：</b></td>
            <td><textarea name="video" cols="60" rows="3" id="video"><?php echo($video)?></textarea> <a href="resources/images/fx.jpg" target="_blank">如何获取视频HTML代码</a></td>
        </tr>-->
        <?php }if(strpos($_GET['css'],'dte')!==false){?>
        <tr>
            <td align="right"><b>文章日期：</b></td>
            <td class="gry"><input name="dte" type="text" id="dte" value="<?php echo($dte)?>" size="40" /> 不填默认为当前日期 例:2016-3-10</td>
        </tr>
        <?php }if(strpos($_GET['css'],'keyword')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td align="right"><strong>关键词：</strong></td>
            <td class="gry"><input type="text" name="key" id="key" value="<?php echo($keyword)?>" size="40" /> 多个关键词用 | 区分</td>
        </tr>
        <?php }if(strpos($_GET['css'],'intro')!==false){?>
        <tr bgcolor="#ffffff">
            <td align="right" valign="top" style="padding-top:15px;"><strong>文章简介：</strong></td>
            <td style="padding:13px 5px;"><textarea name="intro" style="width:800px;" rows="4" id="intro" ><?php echo($intro)?></textarea></td>
        </tr>
        <?php }?>
    </table>
    <div align="center" style="padding-top:15px; text-align:center; padding-bottom:15px"><input type="button" id="submit" class="btn" value=" 提 交 " />　　　　　　　　　　　　　　　　<input type="button" class="btn" value=" 返 回 " onClick="location.href='photo.php?<?php echo($para);?>';" /></div>
</div>

</body>
</html>