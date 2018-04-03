<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$conn->query('set names utf8');
	$title=$_GET['title'];
	$cls=$_GET['cls'];
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$rql=$conn->prepare("select * from article where id=?");
		$rql->bind_param("i",$id);
		$rql->execute();
		$res=$rql->get_result();
		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
			$tle=$row['tle'];
			$dte=$row['dte'];
			$wrt=$row['wrt'];
			$src=$row['src'];
			$img=$row['img'];
			$bdy=$row['bdy'];
			$intro=$row['intro'];
			$url=$row['url'];
			$hit=$row['hit'];
			$keyword=$row['keyword'];
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
		$wrt='';
		$src='';
		$img='';
		$bdy='';
		$intro='';
		$url='';
		$keyword='';
		$hit=0;
		$id=0;
	}
	$sort=strpos($_GET['css'],'sort')!==false?1:0;
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
		function uploadreset(img)
		{
			$.get("uploadReset.php",{"img":img},function(data){
				if(data==1)
				{
					$("#J_selectImage").css("display","");
					$("#upload-img").css("display","none");
					$("#img").val('');
				}
				else
				{
					alert("原始图片文件删除失败！");
				}
			});
		}
		$(function(){
			$("#submit").click(function(){
				var tle=$("#tle").val()?$("#tle").val():"";
				var cls=$("#cls").val()?$("#cls").val():"";
				var src=$("#src").val()?$("#src").val():"";
				var wrt=$("#wrt").val()?$("#wrt").val():"";
				var img=$("#img").val()?$("#img").val():"";
				var bdy=$("#bdy").val()?$("#bdy").val():"";
				var url=$("#url").val()?$("#url").val():"";
				var hit=$("#hit").val()?$("#hit").val():0;
				var dte=$("#dte").val()?$("#dte").val():null;
				var keyword=$("#keyword").val()?$("#keyword").val():"";
				var intro=$("#intro").val()?$("#intro").val():"";
				$.post("articleEditSubmit.php",{"id":<?php echo($id)?>,"tle":tle,"cls":cls,"src":src,"wrt":wrt,"img":img,"bdy":bdy,"url":url,"hit":hit,"dte":dte,"keyword":keyword,"intro":intro,"sort":<?php echo($sort)?>},function(data){
					if(data==1)
					{
						alert("文章信息提交成功！");
						location.href="article.php?page=<?php echo($_GET["page"]);?>&cls=<?php echo($_GET["cls"]);?>&css=<?php echo($_GET["css"]);?>&title=<?php echo($_GET["title"]);?>";
					}
					else
						alert("文章信息提交失败");
				});
			});
		});
	</script>
</head>

<body>
<div id="tab">
    <div class="info">后台管理系统 >> <?php echo($title)?>管理 >> <?php echo($title)?>信息编辑</div>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td colspan="2" height="30" class="tab-tle"><?php echo($_GET['title']);?>信息编辑<input type="button" value="返回" class="btn-back" onClick="location.href='article.php?page=<?php echo($_GET["page"]);?>&cls=<?php echo($_GET["cls"]);?>&css=<?php echo($_GET["css"]);?>&title=<?php echo($_GET["title"]);?>';" /></td>
        </tr>
        <?php if(strpos($_GET['css'],'tle')!==false){?>
        <tr bgcolor="#ffffff">
            <td width="15%" height="35" align="right"><strong>文章标题：</strong></td>
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
				editor.loadPlugin('image', function() {
					editor.plugin.imageDialog({
						showRemote : false,
						clickFn : function(url, title, width, height, border, align) {
							document.getElementById("upload-img").style.display="";
							document.getElementById("J_selectImage").style.display="none";
							document.getElementById("upload-reset").href="javascript:uploadreset('"+url+"');";
							document.getElementById("upload-imgs").style.background="url("+url+") no-repeat center center / cover";
							document.getElementById("img").style.display="";
							document.getElementById("img").value=url;
							editor.hideDialog();
						}
					});
				});
			});
		});
		</script>
        <tr>
            <td height="60" align="right" style="line-height:16px"><strong>缩略图：</strong><div style="font-size:12px; color:#666666; padding:0px">图片小于2M</div></td>
            <td>
            	<input type="hidden" name="img" id="img" value="<?php echo($img);?>" />
            	<?php if(empty($img)){?>
            	<a href="javascript:;" name="J_selectImage" id="J_selectImage" style="padding:6px 15px; background-color:#aa0000; color:#fff; border-radius:3px;">上传图片</a>
                <div id="upload-img" style="display:none;">
                    <span id="upload-imgs" style="float:left; width:100px; height:80px;"></span>
                    <div style="float:left; height:80px; line-height:80px; padding-left:10px; color:#666;">图片上传成功，如需更改请点击 <a href="" id="upload-reset" style="padding:6px 15px; background-color:#aa0000; color:#fff; border-radius:3px;">重新上传</a></div>
                </div>
            	<?php }else{?>
                <a href="javascript:;" name="J_selectImage" id="J_selectImage" style="display:none; padding:6px 10px; background-color:#aa0000; color:#fff; border-radius:3px;">上传图片</a>
                <div id="upload-img">
                    <span id="upload-imgs" style="float:left; width:100px; height:80px; background:url(<?php echo($img);?>) no-repeat center center / cover;"></span>
                    <div style="float:left; height:80px; line-height:80px; padding-left:10px; color:#666;">图片上传成功，如需更改请点击 <a href="javascript:uploadreset('<?php echo($img);?>');" id="upload-reset" style="padding:6px 15px; background-color:#aa0000; color:#fff; border-radius:3px;">重新上传</a></div>
                </div>
                <?php }?>
            </td>
        </tr>
        <?php }if(strpos($_GET['css'],'bdy')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td align="right"><strong>文章内容：</strong></td>
            <td><textarea name="bdy" id="bdy" style="width:800px;height:420px;visibility:hidden;"><?php echo($bdy)?></textarea></td>
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
            <td class="gry"><input name="dte" type="text" id="dte" value="<?php echo($dte)?>" size="40" /> 例:2016-3-10</td>
        </tr>
        <?php }if(strpos($_GET['css'],'keyword')!==false){?>
        <tr bgcolor="#fbfbfb">
            <td align="right"><strong>关键词：</strong></td>
            <td class="gry"><input type="text" name="key" id="key" value="<?php echo($keyword)?>" size="40" /> 多个关键词用 | 区分</td>
        </tr>
        <?php }if(strpos($_GET['css'],'intro')!==false){?>
        <tr bgcolor="#ffffff">
            <td align="right"><strong>文章简介：</strong></td>
            <td><textarea name="intro" style="width:800px;" rows="4" id="intro" ><?php echo($intro)?></textarea></td>
        </tr>
        <?php }?>
    </table>
    <div align="center" style="padding-top:15px; text-align:center; padding-bottom:15px"><input type="button" id="submit" class="btn" value=" 提 交 " />　　　　　　　　　　　　　　　　<input type="button" class="btn" value=" 返 回 " onClick="location.href='article.php?page=<?php echo($_GET["page"]);?>&cls=<?php echo($_GET["cls"]);?>&css=<?php echo($_GET["css"]);?>&title=<?php echo($_GET["title"]);?>';" /></div>
</div>

</body>
</html>