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
				$("#className").val("");
				$("#classType").val("");
				$("#classFather").val("");
				$(".popupDiv").addClass("popupShow");
				$("#cover").addClass("popupShow");
				classID=0;
			});
			$(".popupTitle a ,.popupButton a.popupCancel").click(function(){
				$(".popupDiv").removeClass("popupShow");
				$("#cover").removeClass("popupShow");
			});
			
			$("#classSubmit").click(function(){
				if($("#className").val()=="")
				{
					alert("请输入栏目名称！");
					$("#className").focus();
					return false;
				}
				if($("#classType").val()=="")
				{
					alert("请选择栏目类型！");
					$("#className").focus();
					return false;
				}
				if($("#classFather").val()=="")
				{
					alert("请选择父级栏目！");
					$("#className").focus();
					return false;
				}
				var tmpArr=$("#classFather").val().split("|");
				$.post("classSubmit.php",{"id":classID,"className":$("#className").val(),"classType":$("#classType").val(),"classFather":tmpArr[0],"classIndex":tmpArr[1],"oldFather":oldFather},function(data){
					if(data==1)
					{
						alert("栏目信息编辑成功！");
						location.href=location.href;
					}
					else
					{
						alert("您输入的栏目信息已存在！");
					}
				});
			});
			$(".operate-edit").on("click",function(){
				classID=$(this).attr("data-id");
				$(".popupDiv").addClass("popupShow");
				$("#cover").addClass("popupShow");
				var $my=$(this).parent().parent();
				$("#className").val($my.children("td").eq(1).text());
				$("#classType").val($my.children("td").eq(3).html());
				oldFather=$(this).attr("data-father");
				var classIndex=$(this).attr("data-father")==0?0:$(this).attr("data-index");
				$("#classFather").val($(this).attr("data-father")+"|"+classIndex);
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
				var classFather=$(this).attr("data-father");
				$.post("classSort.php",{"id":id,"sortType":sortType,"oldSort":oldSort,"classFather":classFather},function(data){
					if(data==1)
					{
						location.href=location.href;
					}
				});
			});
			$(".tabClass i.iconfont").click(function(){
				var hideOn=$(this).attr("class").indexOf("1")>0?0:1;
				var id=$(this).attr("data-id");
				var me=this;
				$.post("classHidden.php",{"id":id,"hideOn":hideOn},function(data){
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
        	<td height="40" width="50%">后台管理系统 >> 网站栏目管理 >> 栏目列表 </td>
            <td width="50%" align="right"><input type="button" value="添加栏目" id="addClass" /></td>
        </tr>
    </table>
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabClass">
        <tr bgcolor="#ffffff">
            <td width="8%" height="30" align="center">ID</td>
            <td width="42%" class='tableTitle'>类别名称</td>
            <td width="10%" align="center">显示/隐藏</td>
            <td width="15%" align="center">栏目类型</td>
            <td width="10%" align="center">排序</td>
            <td width="15%" align="center">操作</td>
        </tr>
        <?php
		$conn->query("set names utf8");
		$rs=$conn->query("select * from class order by classIndex asc,classFather asc,classSort asc");
		$html="";
		$curTr=0;
		while($row=$rs->fetch_assoc())
		{
			if($curTr==$row['classIndex'])
			{
				$html.="<tr>";
				$htmlSort='<a href="javascript:;" class="tabClassSort" data-id='.$row['id'].' data-oldsort='.$row['classSort'].' data-father='.$row['classFather'].' data-sort="up">上移</a> <a href="javascript:;" class="tabClassSort" data-id='.$row['id'].' data-oldsort='.$row['classSort'].' data-father='.$row['classFather'].' data-sort="down">下移</a>';
			}
			else
			{
				$html.="<tr class='tabClassHead'>";
				$curTr=$row['classIndex'];
				$htmlSort='';
			}
			$html.="<td align='center'>{$row['id']}</td>";
			$html.="<td class='tableTitle'>".$row['className']."</td>";
			$html.="<td align='center'><i class='iconfont classHidden".$row['classHidden']."' data-id='".$row['id']."'>&#xe656;</i></td>";
			$html.="<td align='center'>{$row['classType']}</td>";
			$html.="<td align='center'>$htmlSort</td>";
			$html.="<td align='center'><a href='javascript:;' class='operate-edit' data-id='".$row['id']."' data-father='".$row['classFather']."' data-index='".$row['classIndex']."'>修改</a>&emsp;<a href='javascript:;' class='operate-del' data-id='".$row['id']."'>删除</a></td>";
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
            	<p><i class="iconfont">&#xe761;</i>编辑栏目信息</p>
                <a href="javascript:;"><i class="iconfont">&#xe646;</i></a>
            </div>
            <div class="popupContent">
            	<dl class="popupClassForm">
                	<dt>栏目名称：</dt>
                    <dd><input type="text" name="className" id="className" placeholder="请输入栏目名称" /></dd>
                    <dt>栏目类型：</dt>
                    <dd>
                    	<select name="classType" id="classType">
                        	<option value="">请选择</option>
                            <option value="单页内容页">单页内容页</option>
                            <option value="文章列表页">文章列表页</option>
                            <option value="图片列表页">图片列表页</option>
                        </select>
                    </dd>
                    <dt>父级栏目：</dt>
                    <dd>
                    	<select name="classFather" id="classFather">
                        	<option value="">请选择</option>
                            <option value="0|0" style="color:#f00;">一级栏目</option>
                            <?php
							$classStm=$conn->query("select * from class where classFather=0 order by classSort asc");
							while($rowNew=$classStm->fetch_assoc())
							{
								echo("<option value='".$rowNew['id']."|".$rowNew['classIndex']."'>{$rowNew['className']}</option>");
							}
							?>
                        </select>
                    </dd>
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