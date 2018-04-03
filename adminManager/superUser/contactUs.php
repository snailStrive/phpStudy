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
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
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
							document.getElementById("QRcode").style.display="";
							document.getElementById("QRcode").value=url;
							editor.hideDialog();
						}
					});
				});
			});
		});
	</script>
    <script>
		$(function(){
			$("#submit").click(function(){
				var para={"name":$("#name").val(),"phone":$("#phone").val(),"tel":$("#tel").val(),"fax":$("#fax").val(),"post":$("#post").val(),"address":$("#address").val(),"qq":$("#qq").val(),"email":$("#email").val(),"weixin":$("#weixin").val(),"QRcode":$("#QRcode").val(),"bus":$("#bus").val(),"mapPos":$("#mapPos").val(),"mapKey":$("#mapKey").val()};
				$.post("contactUsSubmit.php",para,function(data){
					if(data==1)
						alert("信息保存成功！");
					else
						alert("信息保存失败，请检查所填的输入项！");//
				});
			});
		});
	</script>
</head>

<body>
<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
	$conn->query('set names utf8');
	$res=$conn->query("select * from contact");
	$row=$res->fetch_assoc();
?>
<div id="tab">
	<div class="info">后台管理系统 >> 联系方式</div>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">
    	<tr>
        	<td colspan="2" class="tab-tle">联系方式信息编辑</td>
        </tr>
        <tr>
            <td width="20%" align="right">联系人：</td>
            <td width="80%"><input name="name" type="text" id="name" value="<?php echo($row['name']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">座机号码：</td>
            <td><input name="phone" type="text" id="phone" value="<?php echo($row['phone']); ?>" size="40" maxlength="40" /></td>
        </tr>
        <tr>
            <td align="right">手机号码：</td>
            <td><input name="tel" type="text" id="tel" value="<?php echo($row['tel']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">传真：</td>
            <td><input name="fax" type="text" id="fax" value="<?php echo($row['fax']); ?>" size="40" maxlength="20" /></td>
        </tr>
        <tr>
            <td align="right">邮编：</td>
          <td><input name="post" type="text" id="post" value="<?php echo($row['post']); ?>" size="40" maxlength="20" /></td>
        </tr>
        <tr>
            <td align="right">地址：</td>
            <td><input name="address" type="text" id="address" value="<?php echo($row['address']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">QQ：</td>
            <td><input name="qq" type="text" id="qq" value="<?php echo($row['qq']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">Email：</td>
            <td><input name="email" type="text" id="email" value="<?php echo($row['email']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">微信：</td>
            <td><input name="weixin" type="text" id="weixin" value="<?php echo($row['weixin']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">二维码：</td>
            <td>
            	<input type="hidden" name="QRcode" id="QRcode" value="<?php echo($row['QRcode']);?>" />
            	<?php if(empty($row['QRcode'])){?>
            	<a href="javascript:;" name="J_selectImage" id="J_selectImage" style="padding:6px 15px; background-color:#aa0000; color:#fff; border-radius:3px;">上传图片</a>
                <div id="upload-img" style="display:none;">
                    <span id="upload-imgs" style="float:left; width:100px; height:80px;"></span>
                    <div style="float:left; height:80px; line-height:80px; padding-left:10px; color:#666;">图片上传成功，如需更改请点击 <a href="" id="upload-reset" style="padding:6px 15px; background-color:#aa0000; color:#fff; border-radius:3px;">重新上传</a></div>
                </div>
            	<?php }else{?>
                <a href="javascript:;" name="J_selectImage" id="J_selectImage" style="display:none; padding:6px 10px; background-color:#aa0000; color:#fff; border-radius:3px;">上传图片</a>
                <div id="upload-img">
                    <span id="upload-imgs" style="float:left; width:100px; height:80px; background:url(<?php echo($row['QRcode']);?>) no-repeat center center / cover;"></span>
                    <div style="float:left; height:80px; line-height:80px; padding-left:10px; color:#666;">图片上传成功，如需更改请点击 <a href="javascript:uploadreset('<?php echo($row['QRcode']);?>');" id="upload-reset" style="padding:6px 15px; background-color:#aa0000; color:#fff; border-radius:3px;">重新上传</a></div>
                </div>
                <?php }?>
            </td>
        </tr>
        <tr>
            <td align="right">乘车线路：</td>
            <td class="gry" style="line-height:20px; padding-bottom:10px;"><textarea name="bus" cols="80" rows="4" id="bus"><?php echo($row['bus']); ?></textarea></td>
        </tr>
        <tr>
            <td align="right">百度地图坐标：</td>
            <td><input name="mapPos" type="text" id="mapPos" value="<?php echo($row['mapPos']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">百度地图key：</td>
            <td><input name="mapKey" type="text" id="mapKey" value="<?php echo($row['mapKey']); ?>" size="40" maxlength="30" /></td>
        </tr>
    </table>
	<div class="btm-btn"><input type="button" id="submit" class="btn" value=" 保 存 " /></div>
</div>
</body>
</html>