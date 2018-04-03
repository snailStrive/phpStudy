<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link href="/adminRes/resources/css/admin.css" rel="stylesheet" />
    <script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
    <script>
		$(function(){
			var classID=0;
			var oldFather=0;
			$("#addClass").click(function(){
				$("#tle").val("");
				$("#qq").val("");
				$(".popupDiv").addClass("popupShow");
				$("#cover").addClass("popupShow");
				classID=0;
			});
			$(".popupTitle a ,.popupButton a.popupCancel").click(function(){
				$(".popupDiv").removeClass("popupShow");
				$("#cover").removeClass("popupShow");
			});
			
			$("#classSubmit").click(function(){
				if($("#tle").val()=="")
				{
					alert("请输入客服名称！");
					$("#tle").focus();
					return false;
				}
				if($("#qq").val()=="")
				{
					alert("请客服QQ号码！");
					$("#qq").focus();
					return false;
				}
				$.post("servicesSubmit.php",{"id":classID,"tle":$("#tle").val(),"qq":$("#qq").val()},function(data){
					if(data==1)
					{
						alert("客服信息提交成功！");
						location.href=location.href;
					}
					else
					{
						alert(data);//"客服信息提交失败！"
					}
				});
			});
			$(".operate-edit").on("click",function(){
				classID=$(this).attr("data-id");
				$(".popupDiv").addClass("popupShow");
				$("#cover").addClass("popupShow");
				var $my=$(this).parent().parent();
				$("#tle").val($my.children("td").eq(1).text());
				$("#qq").val($my.children("td").eq(2).html());
			});
			$(".operate-del").click(function(){
				var id=$(this).attr("data-id");
				if(confirm("是否确认删除该信息！"))
				{
					$.post("Delete.php",{"tab":"class","id":id},function(data){
						if(data==1)
							location.href=location.href;
						else
							alert(data);
					});
				}
			});
			$(".tabClassSort").click(function(){
				var id=$(this).attr("data-id");
				var sortType=$(this).attr("data-sort");
				var oldSort=$(this).attr("data-oldsort");
				
				$.post("servicesSort.php",{"id":id,"sortType":sortType,"oldSort":oldSort},function(data){
					if(data==1)
					{
						location.href=location.href;
					}
				});
			});
			$(".tabList i.iconfont").click(function(){
				var hideOn=$(this).attr("class").indexOf("1")>0?0:1;
				var id=$(this).attr("data-id");
				var me=this;
				$.post("servicesHidden.php",{"id":id,"hideOn":hideOn},function(data){
					$(me).attr("class","iconfont classHidden"+hideOn);
				});
			});
			
		});
	</script>
</head>

<body>
<?php
	include("adminCheck.php");
	include("../../inc/conn.php");
?>
<div id="tab">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" id="info">
    	<tr>
        	<td height="40" width="50%">后台管理系统 >> QQ客服管理 >> 客服列表 </td>
            <td width="50%" align="right"><input type="button" value="添加客服" id="addClass" /></td>
        </tr>
    </table>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabList">
        <tr bgcolor="#ffffff">
            <td width="8%" height="30" align="center">ID</td>
            <td width="42%" class='tableTitle'>客服名称</td>
            <td width="15%" align="center">QQ号码</td>
            <td width="10%" align="center">显示/隐藏</td>
            <td width="10%" align="center">排序</td>
            <td width="15%" align="center">操作</td>
        </tr>
        <?php
		$conn->query("set names utf8");
		$rs=$conn->query("select * from services order by sort asc");
		$html="";
		$curTr=0;
		while($row=$rs->fetch_assoc())
		{
			$html.="<tr>";
			$htmlSort='<a href="javascript:;" class="tabClassSort" data-id='.$row['id'].' data-oldsort='.$row['sort'].' data-sort="up">上移</a> <a href="javascript:;" class="tabClassSort" data-id='.$row['id'].' data-oldsort='.$row['sort'].' data-sort="down">下移</a>';
			$html.="<td align='center'>{$row['id']}</td>";
			$html.="<td class='tableTitle'>".$row['tle']."</td>";
			$html.="<td align='center'>{$row['qq']}</td>";
			$html.="<td align='center'><i class='iconfont classHidden".$row['display']."' data-id='".$row['id']."'>&#xe656;</i></td>";
			$html.="<td align='center'>$htmlSort</td>";
			$html.="<td align='center'><a href='javascript:;' class='operate-edit' data-id='".$row['id']."'>修改</a>&emsp;<a href='javascript:;' class='operate-del' data-id='".$row['id']."'>删除</a></td>";
			$html.="</tr>";
			
		}
		echo($html);?>
    </table>
</div>

<div id="cover"></div>
<div class="popupDiv">
	<div class="popupDivTab">
		<div class="popupClass">
        	<div class="popupTitle">
            	<p><i class="iconfont">&#xe761;</i>编辑服务信息</p>
                <a href="javascript:;"><i class="iconfont">&#xe646;</i></a>
            </div>
            <div class="popupContent">
            	<dl class="popupClassForm">
                	<dt>客服名称：</dt>
                    <dd><input type="text" name="tle" id="tle" placeholder="请输入客服名称" /></dd>
                    <dt>客服QQ号：</dt>
                    <dd><input type="text" name="qq" id="qq" placeholder="请输入客服QQ号" /></dd>
                </dl>
            </div>
            <div class="popupButton">
            	<a href="javascript:;" id="classSubmit">提交</a>
                <a href="javascript:;" class="popupCancel">取消</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>