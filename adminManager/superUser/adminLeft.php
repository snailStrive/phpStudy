<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <link rel="stylesheet" href="/adminRes/resources/css/reset.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/adminRes/resources/css/style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/adminRes/resources/css/invalid.css" type="text/css" media="screen" />
    <script type="text/javascript" src="/js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $(".de").click(function(){
				var x=parent.document.getElementById("frame2");
				var y=(x.contentWindow || x.contentDocument);
				if (y.document)y=y.document;
				var $brother=$(y);
				$brother.find("#tab").find("td").attr("class","de");
			});
        });
	</script>
    <script type="text/javascript" src="/adminRes/resources/scripts/jscroll.js"></script>
    <script type="text/javascript" src="/adminRes/resources/scripts/simpla.jquery.configuration.js"></script>
    <style type="text/css">
    	html{overflow-y:hidden}
    </style>
</head>
<!--html参数解释
html=3|news|20|1
(0)、生成信息种类，0=全部，1=首页，2=单内容页..
(1)、0=不更新首页，1=更新首页
(2)、0=不影响侧边的内容，>0影响侧边内容,而且该数值就是影响到的分类，影响多个分类用-符号隔开
-->
<body>

        <div id="sidebar">
            <div id="sidebar-wrapper">
              <a href="javascript:;"><img id="logo" src="/adminRes/resources/images/logos.jpg" alt="Manage Logo" /></a>
              <div id="profile-links"><a href="javascript:;" onclick="window.open('/')" title="View the Site">浏览网站</a>　|　<a href="logout.php" title="Sign Out" target="_parent">安全退出</a></div>        
                <ul id="main-nav" class="abc">
                    <li><a class="nav-top-item">网站首页</a>
                        <ul>
                        	<li><a href="article.php?cls=27&css=tle|img|url|sort&title=首页轮播图" class="de" target="main">首页轮播图</a></li>
                            <li><a href="article.php?cls=28&css=tle|url|sort&title=首页轮播图" class="de" target="main">友情链接</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-top-item">关于我们</a>
                        <ul>
                            <li><a href="info.php?id=21&css=img|intro&title=企业介绍" class="de" target="main">企业介绍</a></li>
                            <li><a href="info.php?id=22&css=&title=企业文化" class="de" target="main">企业文化</a></li>
                            <li><a href="info.php?id=23&css=&title=企业荣誉" class="de" target="main">企业荣誉</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-top-item">新闻动态</a>
                        <ul>
                            
                            <li><a href="article.php?cls=17&css=tle|cls|wrt|src|img|bdy|url|hit|dte|keyword|intro&title=企业动态" class="de" target="main">企业动态</a></li>
                            <li><a href="article.php?cls=18&css=tle|cls|wrt|src|bdy|url|hit|dte|keyword|intro&title=行业新闻" class="de" target="main">行业新闻</a></li>   
                        </ul>
                    </li>
                    <li><a href="article.php?cls=5&css=tle|cls|img|bdy|hit|sort|intro&title=成功案例" class="nav-top-item no-submenu de" target="main">成功案例</a></li>
                    <li><a href="photo.php?cls=29&css=tle|cls|img|bdy|hit|sort|intro&title=员工风采" class="nav-top-item no-submenu de" target="main">员工风采</a></li>
                    <li><a class="nav-top-item">联系方式管理</a>
                        <ul>
                            <li><a href="contactUs.php" class="de" target="main">联系方式</a></li>
                            <li><a href="services.php" class="de" target="main">浮动QQ客服</a></li>
                        </ul>
                    </li>
                </ul>
          </div>
        </div>
</body>
</html>