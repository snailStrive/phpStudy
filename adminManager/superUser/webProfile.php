<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
		$(function(){
			$("#submit").click(function(){
				if($("#webName").val()==""||$("#webUrl").val()==""||$("#webCopyright").val()==""||$("#webCopyrights").val()=="")
				{
					alert("带 * 项为必填项，请填写");
					return false;
				}
				var para={"webName":$("#webName").val(),"webUrl":$("#webUrl").val(),"webCopyright":$("#webCopyright").val(),"webCopyrights":$("#webCopyrights").val(),"webIcp":$("#webIcp").val(),"webPower":$("#webPower").val(),"webKey":$("#webKey").val(),"webIntro":$("#webIntro").val()};
				$.post("webProfileSubmit.php",para,function(data){
					if(data==1)
						alert("信息保存成功！");
					else
						alert("信息保存失败，请检查所填的输入项！");
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
	$res=$conn->query("select * from webprofile");
	$row=$res->fetch_assoc();
?>
<div id="tab">
	<div class="info">后台管理系统 >> 网站基本资料</div>
    <table width="100%" border="0" cellpadding="5" cellspacing="0" align="center">
    	<tr>
        	<td colspan="2" class="tab-tle">网站基本资料信息设置</td>
        </tr>
        <tr>
            <td width="20%" align="right">网站名称：</td>
            <td width="80%"><input name="webName" type="text" id="webName" value="<?php echo($row['webName']); ?>" size="40" maxlength="30" />
          <span class="red">*</span></td>
        </tr>
        <tr>
            <td align="right">网站URL：</td>
            <td><input name="webUrl" type="text" id="webUrl" value="<?php echo($row['webUrl']); ?>" size="40" maxlength="40" />
          <span class="red">* </span> <span class="gry">(例：www.abc.com)</span></td>
        </tr>
        <tr>
            <td align="right">网站授权：</td>
            <td><input name="webCopyright" type="text" id="webCopyright" value="<?php echo($row['webCopyright']); ?>" size="40" maxlength="30" />
          <span class="red">*</span></td>
        </tr>
        <tr>
            <td align="right">授权期限：</td>
            <td><input name="webCopyrights" type="text" id="webCopyrights" value="<?php echo($row['webCopyrights']); ?>" size="40" maxlength="20" />
          <span class="red">*</span> <span class="gry">(例：2008 或 2008-2010)</span></td>
        </tr>
        <tr>
            <td align="right">ICP备案号：</td>
          <td><input name="webIcp" type="text" id="webIcp" value="<?php echo($row['webIcp']); ?>" size="40" maxlength="20" /></td>
        </tr>
        <tr>
            <td align="right">技术顾问：</td>
            <td><input name="webPower" type="text" id="webPower" value="<?php echo($row['webPower']); ?>" size="40" maxlength="30" /></td>
        </tr>
        <tr>
            <td align="right">网站关键词：</td>
          <td class="gry"><input name="webKey" type="text" id="webKey" value="<?php echo($row['webKey']); ?>" size="69" maxlength="80" /> 用 | 分隔，建议低于6个</td>
        </tr>
        <tr>
            <td align="right">网站简介：</td>
            <td class="gry" style="line-height:20px; padding-bottom:10px;"><textarea name="webIntro" cols="80" rows="4" id="webIntro"><?php echo($row['webIntro']); ?></textarea>100字以内<br />用简短的语言描述自己的网站，最好小于40个字，超过40字不利于百度排名<br />说明：某某某公司成立于1990年，专注于（此处填写网站关键词）等，（此处填写企业理念）<br />例：某某某公司成立于2010年，专注于网站建设、网站开发、微信平台开发、网站空间域名等服务，我们用心打造专业品牌。</td>
        </tr>
    </table>
	<div class="btm-btn"><input type="button" id="submit" class="btn" value=" 保 存 " /></div>
</div>
</body>
</html>