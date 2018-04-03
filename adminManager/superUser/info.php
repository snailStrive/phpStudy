<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$conn->query("set names utf8");
	$title=$_GET['title'];
	$rql=$conn->prepare('select id,bdy,img,intro from article where cls=?');
	$rql->bind_param('i',$_GET['id']);
	$rql->execute();
	$res=$rql->get_result();
	if($res->num_rows>0)
	{
		$row=$res->fetch_assoc();
		$bdy=$row['bdy'];
		$img=$row['img'];
		$id=$_GET['id'];
		$intro=$row['intro'];
	}
	else
	{
		$id=0;
		$bdy='';
		$intro='';
		$img='';
	}
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
			K('#J_selectImage').click(function() {
				editor1.loadPlugin('image', function() {
					editor1.plugin.imageDialog({
						showRemote : false,
						clickFn : function(url, title, width, height, border, align) {
							document.getElementById("upload-img").style.display="";
							document.getElementById("J_selectImage").style.display="none";
							document.getElementById("upload-reset").href="javascript:uploadreset('"+url+"');";
							document.getElementById("upload-imgs").style.background="url("+url+") no-repeat center center / cover";
							document.getElementById("img").style.display="";
							document.getElementById("img").value=url;
							editor1.hideDialog();
						}
					});
				});
			});
		});
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
				var img=$("#img").val()?$("#img").val():"";
				var intro=$("#intro").val()?$("#intro").val():"";
				$.post("infoSubmit.php",{"id":<?php echo($id);?>,"img":img,"bdy":$("#bdy").val(),"intro":intro,"cls":<?php echo($_GET['id']);?>},function(data){
					if(data==1)
					{
						alert("信息提交成功！");
					}
					else
					{
						alert("信息提交失败！");
					}
				});
			});
		});
	</script>
</head>

<body>
<div id="tab">
	<div class="info">后台管理系统 >> <?php echo($title);?>信息</div>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">
    	<tr>
        	<td colspan="2" class="tab-tle"><b><?php echo($title);?></b> 资料编辑</td>
        </tr>
        <?php if(strpos($_GET['css'],'img')!==false){?>
        <tr>
            <td width="15%" align="right">形象照片：</td>
            <td width="85%">
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
        <?php }?>
        <tr>
            <td width="15%" align="right">详细内容：</td>
            <td width="85%"><textarea name="bdy" id="bdy" style="width:800px;height:400px;visibility:hidden;"><?php echo($bdy);?></textarea></td>
        </tr>
        <?php if(strpos($_GET['css'],'intro')!==false){?>
        <tr>
            <td width="15%" align="right">信息简介：</td>
            <td width="85%"><textarea name="intro" id="intro" style="width:800px;height:64px;"><?php echo($intro);?></textarea></td>
        </tr>
		<?php }?>
    </table>
	<div class="btm-btn"><input type="button" id="submit" class="btn" value=" 保 存 " /></div>
</div>
</body>
</html>