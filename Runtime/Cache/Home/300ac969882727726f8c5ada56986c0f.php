<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<title><?php echo C('WEB_SITE_TITLE');?></title>
<link href="/ot/Public/static/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/ot/Public/static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="/ot/Public/static/bootstrap/css/docs.css" rel="stylesheet">
<link href="/ot/Public/static/bootstrap/css/onethink.css" rel="stylesheet">
<script src="/ot/Public/static/bootstrap/js/jquery-1.8.3.min.js"></script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/ot/Public/static/bootstrap/js/html5shiv.js"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/ot/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/ot/Public/static/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/ot/Public/static/bootstrap/js/bootstrap.min.js"></script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo U('index/index');?>">Answering system</a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li>
                            <a href="<?php echo (get_nav_url($nav["url"])); ?>" target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <?php if(isLogin()): ?><ul class="nav" style="margin-right:0">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username($_SESSION['zzc']['id']); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo U('User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>" style="padding-left:0;padding-right:0">注册</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
    </div>
</div>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
    <header class="jumbotron subhead" id="overview">
         <h4>试题列表</h4>
    </header>

<!-- 左侧 nav
================================================== -->
    

<div id="main-container" class="container">
    <div class="row">
        
        <!-- 左侧 nav
        ================================================== -->
            <div class="span3 bs-docs-sidebar">
                
                <ul class="nav nav-list bs-docs-sidenav">
                    <?php echo W('Category/lists', array($category['id'], ACTION_NAME == 'index'));?>
                </ul>
            </div>
        
        
  <div>
      <form>
          <span>一、填空题</span>
          <?php if(is_array($fi_q)): $i = 0; $__LIST__ = $fi_q;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$fi_v): $mod = ($i % 2 );++$i;?><div>
              <p>
                <?php echo ($key+1); ?>.<?php echo str_replace('#','<input type="text" name="answer[]" />',$fi_v['question']) ?>
              </p>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
          <span>二、判断题</span>
          <?php if(is_array($rw_q)): $i = 0; $__LIST__ = $rw_q;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rw): $mod = ($i % 2 );++$i;?><p>
            <?php echo ($key+1); ?>.<?php echo ($rw["question"]); ?>----------<input type="text" placeholder="r=正确，w=错误"  name="rw[]">
            </p><?php endforeach; endif; else: echo "" ;endif; ?>
          <span>三、单选题</span>
          <?php if(is_array($c1_q)): $i = 0; $__LIST__ = $c1_q;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c1): $mod = ($i % 2 );++$i;?><p>
                <?php echo ($key+1); ?>.<?php echo ($c1["question"]); ?>
              </p>
                <?php $answer1 = get_ch1($c1['answer'],$c1['ch1'],$c1['ch2'],$c1['ch3'],$c1['ch4']); ?>
                   <input type="radio" name="answer_<?php echo ($key); ?>" />A.<?php echo ($answer1["0"]); ?>
                   <input type="radio" name="answer_<?php echo ($key); ?>" />B.<?php echo ($answer1["1"]); ?>
                   <input type="radio" name="answer_<?php echo ($key); ?>" />C.<?php echo ($answer1["2"]); ?>
                   <input type="radio" name="answer_<?php echo ($key); ?>" />D.<?php echo ($answer1["3"]); endforeach; endif; else: echo "" ;endif; ?>
          <p>
            <span>四、多选题</span>
            <?php if(is_array($c2_q)): $i = 0; $__LIST__ = $c2_q;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c2): $mod = ($i % 2 );++$i;?><p>
                  <?php echo ($key+1); ?>.<?php echo ($c2["question"]); ?>
                </p>
                  <?php $answer2 = get_ch2($c2['answer'],$c2['ch1'],$c2['ch2'],$c2['ch3'],$c2['ch4']); ?>
                     <input type="checkbox" name="answer_<?php echo ($key); ?>" />A.<?php echo ($answer2["0"]); ?>
                     <input type="checkbox" name="answer_<?php echo ($key); ?>" />B.<?php echo ($answer2["1"]); ?>
                     <input type="checkbox" name="answer_<?php echo ($key); ?>" />C.<?php echo ($answer2["2"]); ?>
                     <input type="checkbox" name="answer_<?php echo ($key); ?>" />D.<?php echo ($answer2["3"]); ?>
                     <input type="checkbox" name="answer_<?php echo ($key); ?>" />E.<?php echo ($answer2["4"]); endforeach; endif; else: echo "" ;endif; ?>
            </p>
            <span>五、操作题</span>
            <p>未开放</p>
      </form>
  </div>

    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	
    <!-- 底部
    ================================================== -->
    <footer class="footer">
      <div class="container">
          <p> 本站由 <strong><a href="http://www.onethink.cn" target="_blank">OneThink</a></strong> 强力驱动</p>
      </div>
    </footer>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "/ot", //当前网站地址
		"APP"    : "/ot/index.php?s=", //当前项目地址
		"PUBLIC" : "/ot/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>