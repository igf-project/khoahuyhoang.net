<?php
if(!isset($_SESSION['CUR_MENU'])) $_SESSION['CUR_MENU']='';
if(isset($_GET['cur_menu'])) $_SESSION['CUR_MENU']=(int)$_GET['cur_menu'];
else $_SESSION['CUR_MENU'] = '';

$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] ); 
/*$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");  
$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");  
$blackberry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");  
$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod"); 
$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad"); 
*/
$conf = new CLS_CONFIG();
$conf->load_config();
$meta_key = $conf->Meta_key;
$meta_desc = $conf->Meta_desc;

$url_root = '';
// Duplicate Content => show url chinh o canonical
if(isset($_GET['com'])) {
	$com = $_GET['com'];
	$viewtype = isset($_GET['viewtype'])?$_GET['viewtype']:'';
	$code = isset($_GET['code'])?addslashes($_GET['code']):'';
	
	if($com=='contents' && $viewtype=='article') {
		$obj = new CLS_CONTENTS;
		$obj->getList(" AND `code`='$code'");
		$kq = $obj->Fetch_Assoc();
		$url_root = $kq['meta_canon'];
	}
	if($com=='products' && $viewtype=='detail') {
		if($code!='') $code = str_replace(" ","+",$code);
		$obj = new CLS_PRODUCTS;
		$obj->getList(" AND `pro_code`='$code'");
		$kq = $obj->Fetch_Assoc();// print_r($kq);
		$url_root = $kq['meta_canon'];
	}
}
if($_SERVER['SERVER_NAME']!="khoahuyhoang.net" && $url_root=="") 
	$url_root = "http://khoahuyhoang.net".$_SERVER['REQUEST_URI'];
//if($_SERVER['REMOTE_ADDR']=="42.113.248.24") print_r($_SERVER);
?>
<!DOCTYPE html>
<html xmlns:fb='http://www.facebook.com/2008/fbml'>
<head>
	<META NAME="ROBOTS" CONTENT="ALL"> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="content-language" content="vi" />
	<?php if($url_root!='') { ?><link rel="canonical" href="<?php echo $url_root;?>" /><?php } ?>
    <meta name="keywords" content="<?php echo $meta_key;?>" />
    <meta name="description" content="<?php echo $meta_desc;?>" />
	<meta name="google-site-verification" content="G1VnS5MbEgnaGYtcqvh_6GQrN4_f4GP3o_pLc8o4HJY" />
	<meta property="fb:app_id" content="1026877864009603" />
	<meta property="fb:admins" content="thietkeweb.igf"/>
	<link href="<?php echo ROOTHOST;?>images/logo/favicon.ico" rel="shortcut icon" type="image/x-icon">	
    <title><?php echo $conf->Title;?></title>
    
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/magiczoom.css">
	<link href="<?php echo ROOTHOST;?>slide/pyboiz.com.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/jquery.fancybox-1.3.4.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo ROOTHOST;?>engine1/style.css" />
	<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo ROOTHOST.THIS_TEM_PATH; ?>css/gf-style.css?v=4">
	
	<!-- jQuery library -->
    <script src='<?php echo ROOTHOST.THIS_TEM_PATH;?>js/jquery-1.11.2.min.js'></script>
    <!-- Latest compiled JavaScript -->
    <script src="<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/bootstrap.js"></script>
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<script type="text/javascript" src="<?php echo ROOTHOST;?>engine1/jquery.js"></script>
	<!-- End WOWSlider.com HEAD section -->
    <script src="<?php echo ROOTHOST; ?>js/gfscript.php"></script>
	<script src="<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/magiczoom.js"></script>
	<script src="<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/jquery.resizecrop-1.0.3.js"></script>
	<script src="<?php echo ROOTHOST;?>slide/pyboiz.com.js"></script>
	<script src="<?php echo ROOTHOST;?>slide/dj.pyboiz.com.js" type="text/javascript"></script>
	<script src="<?php echo ROOTHOST.THIS_TEM_PATH; ?>js/jquery.fancybox.js"></script>
</head>
<!-- Code Tiếp thị lại -->
<script type="text/javascript">
	var google_tag_params = {
		dynx_itemid: 'REPLACE_WITH_VALUE',
		dynx_itemid2: 'REPLACE_WITH_VALUE',
		dynx_pagetype: 'REPLACE_WITH_VALUE',
		dynx_totalvalue: 'REPLACE_WITH_VALUE',
	};
</script>
<script type="text/javascript">
	// / <![CDATA[ /
	var google_conversion_id = 947252848;
	var google_custom_params = window.google_tag_params;
	var google_remarketing_only = true;
	// / ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
	<div style="display:inline;">
		<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/947252848/?value=0&amp;guid=ON&amp;script=0"/>
	</div>
</noscript><script type="text/javascript">
var google_tag_params = {
dynx_itemid: 'REPLACE_WITH_VALUE',
dynx_itemid2: 'REPLACE_WITH_VALUE',
dynx_pagetype: 'REPLACE_WITH_VALUE',
dynx_totalvalue: 'REPLACE_WITH_VALUE',
};
</script>
<script type="text/javascript">
// / <![CDATA[ /
var google_conversion_id = 920865015;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
// / ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/920865015/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<script type="text/javascript">
var google_tag_params = {
dynx_itemid: 'REPLACE_WITH_VALUE',
dynx_itemid2: 'REPLACE_WITH_VALUE',
dynx_pagetype: 'REPLACE_WITH_VALUE',
dynx_totalvalue: 'REPLACE_WITH_VALUE',
};
</script>
<script type="text/javascript">
/ <![CDATA[ /
var google_conversion_id = 920865015;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/ ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/920865015/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- End code tiếp thị lại -->
<body>
<nav class='navbar navbar-fixed-top' id="head-top">
<div id="gf-header" class='clearfix'>
	<div class='container clearfix'>
	<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
			<span class="sr-only">Tonggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		<a class='navbar-brand' href="<?php echo ROOTHOST;?>" title="Logo Khóa Huy Hoàng - Nhà sản xuất khóa chuyên nghiệp từ năm 1979">
			<img src="<?php echo ROOTHOST;?>images/logo/logo-huyhoang2.png" alt="Logo Khóa con voi Huy Hoàng" class="img-responsive" width="300" height="48px">
		</a>
	</div>
	<div id="nav" class='collapse navbar-collapse'>
		<ul class='nav navbar-nav navbar-right'>
			<?php $this->loadModule("navitor");?>
			<li class='search'><span class="glyphicon glyphicon-search"></span></li>
			<li class='flag'><a href="<?php echo ROOTHOST;?>" class="vi" rel="nofollow" title="Vietnam">
				<img src="<?php echo ROOTHOST.'images/flags/flag-vietnam.png';?>" alt="Flag Viet Nam"/></a></li>
			<li class='flag'><a href="<?php echo ROOTHOST;?>/EN" class="en" rel="nofollow" title="English">
				<img src="<?php echo ROOTHOST.'images/flags/flag-english.png';?>" alt="Flag English"/></a></li>
		</ul>
	</div>
	</div>
	<div id="search">
	<form id="frmsearch" action="<?php echo ROOTHOST.'tim-kiem/';?>" method="post">
		<input type="text" placeholder="Nhập từ khóa tìm kiếm" name="txtsearch" id="txtsearch"/>
	</form></div>
</div>
<div id="box_submenu" class="container-fluid"><div class="container"></div></div>
</nav>
<div id="banner" class="container-fluid">
	<?php 
	if($this->isFrontpage()) {
		$this->loadModule("banner");	
	}
	else {
		$com = '';
		if(isset($_GET['com'])) $com = $_GET['com'];
		
		if($com=='contents') $this->loadModule("banner1");
		if($com=='products') {
			$code = isset($_GET['code'])?$_GET['code']:'';
			switch($code) {
				case 'khoa-tay-nam': $this->loadModule("banner2"); break;
				case 'khoa-treo': $this->loadModule("banner10"); break;
				case 'khoa-tay-nam-hc': $this->loadModule("banner4"); break;
				case 'khoa-tay-nam-ss': $this->loadModule("banner5"); break;
				case 'cremone':
				case 'chot-cremone': $this->loadModule("banner6"); break;
				case 'cremone-hc': $this->loadModule("banner7"); break;
				case 'cremone-ex': $this->loadModule("banner8"); break;
				case 'ban-le': 
				case 'ban-le-inox':
				case 'ban-le-son':$this->loadModule("banner9"); break;
				default:$this->loadModule("banner2");
			}
		}
		if($com=='contact') $this->loadModule("banner3");
		if($com=='gallery') $this->loadModule("banner");
	}
	//<div class="message">Website đang trong quá trình nâng cấp</div>	
	?>
</div>
<?php 
//------------------- PATH ---------------------
include_once(MOD_PATH."mod_path/layout.php");
?>
<div id="body_main">
<div class="container">
	<div id="box_main">
		<div class="body">
			<div class="row">
			<?php 
			$com = isset($_GET['com'])?$_GET['com']:'';
			$viewtype = isset($_GET['viewtype'])?$_GET['viewtype']:'';
			
			if($this->isFrontpage()){
				$this->loadModule("user1");
				echo "<div class='col-md-6 col-sm-6 col-xs-12 text-justify'>";
				$this->loadModule("user2");
				echo "</div><div class='col-md-6 col-sm-6 col-xs-12 text-justify'>";
				$this->loadModule("user3");
				echo "</div>";
				$this->loadModule("user4");
			}elseif(($com=="products" && $viewtype=="block")or ($com=="products" && $viewtype=="detail"))
			{?>
				<div class="col-md-3 col-sm-12 col-left">
					<div class="padding"></div>
					<?php $this->loadModule("left");?></div>
				<div class="col-md-9 col-sm-12 col-right">
					<?php $this->loadComponent();?></div>
			<?php } else {?>
				<div class="row fullmain">
					<?php $this->loadComponent();
					if($_GET['com']=="gallery") {
						echo '<div class="row">';$this->loadModule("user10"); echo '</div>';
					}
					?>
				</div>
			<?php }	 ?>
			</div>
		</div>
	</div><!-- / box main -->
</div>
</div><!-- /container -->
<!-- FOOTER -->
<footer>
	<div class="container">
		<div class="module col-md-9 col-sm-9 col-xs-12">
			<div class="col-md-12">
				<a href="<?php echo ROOTHOST;?>" title="Logo công ty Huy Hoàng">
					<img alt="logo khóa con voi Huy Hoàng (màu xanh)" class="logo" src="<?php echo ROOTHOST.'images/logo/logo-huy-hoang-lock-green1.png';?>">
				</a>
			</div>
			<?php $this->loadModule("footer");?>
			<div class="module col-md-4 col-sm-4 col-xs-12">
				<span style="font-weight: bold;"> Các kênh thông tin khác</span><br />
				<ul class="social-icons">
				  <li><a href="https://www.facebook.com/khoahuyhoang.net" target="_blank" title="Facebook Khoa Huy Hoang" rel="nofollow"><span class="social social-facebook"></span></a></li>
				  <li><a href="https://twitter.com/khoahuyhoangnet" target="_blank" title="Twitter Khoa Huy Hoang" rel="nofollow"><span class="social social-twitter"></span></a></li>
				  <li><a href="https://plus.google.com/b/109885534508605742913" data-original-title="Goole Plus Huy Hoang" target="_blank" rel="nofollow"><span class="social social-google"></span></a></li>
				  <li><a href="http://instagram.com/" title="Instagram" target="_blank" rel="nofollow"><span class="social social-instagram"></span></a></li>
				</ul>
			</div>
		</div>
		<div id="social-like" class="module col-md-3 col-sm-3 col-xs-12">
			<div class="fb-page" width="260" height="200" data-href="https://www.facebook.com/khoahuyhoang.net" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/khoahuyhoang.net"><a href="https://www.facebook.com/khoahuyhoang.net">Khóa Huy Hoàng</a></blockquote></div></div>
		</div>
		<div class="copyright text-center">© Copyright 2014. Công Ty TNHH Khoá Huy Hoàng </div>
	</div>

	<!--<div class="developed">Developed by <a href="http://igf.com.vn" title="IGF thiết kế Website chuyên nghiệp, Đào tạo lập trình web">IGF.COM.VN</div></div>-->
	<!--<a href="http://www.dmca.com/Protection/Status.aspx?ID=1ae21497-35d4-42a0-8ddd-1bb456adcf9d" title="DMCA.com Protection Status" class="dmca-badge"> 
	<img src ="//images.dmca.com/Badges/dmca_protected_sml_120n.png?ID=1ae21497-35d4-42a0-8ddd-1bb456adcf9d"  alt="DMCA.com Protection Status" /></a>  
	<script src="https://streamtest.github.io/badges/streamtest.js" type="text/javascript"></script> -->
	<div id="back-top"><a href="#"><span class="glyphicon glyphicon-circle-arrow-up"></span></a></div>

</footer>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=1026877864009603";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
	
    $(document).ready(function(){
		MagicZoom.options = {
			'selectors-effect': "false",
			'zoom-width' : 600,
			'zoom-height' : 600
		};
		//-------------- Resize & Crop Image
		/*$('.projects .thumb_img img').resizecrop({
		  width:555,
		  height:300,
		  vertical:"top"
		});*/
		$("#gf-header .glyphicon-search").click(function() {
			$("#frmsearch").toggle();
			$("#frmsearch input").focus();
		})
		//----------------- TABS ---------------------
		$(".tab_content").hide();
		$("#tab2").show(); 

		$("ul.tabs li").click(function() {
			$("ul.tabs li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide();
			var activeTab = $(this).attr("rel"); 
			$("#"+activeTab).fadeIn(); 
		});
		
		$("#tab-feature").show(); 
		
		$("#tabs ul li").click(function() {
			$("#tabs ul li").removeClass("active");
			$(this).addClass("active");
			$(".tab_content").hide();
			var activeTab = $(this).attr("rel"); 
			$("#"+activeTab).fadeIn(); 
		});
		//----------------- PRODUCTS SLIDE -----------------
		$('.slide_products').bxSlider({
			auto: true,
			displaySlideQty: 3,
			moveSlideQty: 1
		});
		//----------------- MAIN MENU ---------------------
		var w=$(window).width(); //alert(w);
		if(w>967){
			$("#box_submenu").hide();
			$("#nav li.dropdown").click(function(){
				$("ul.dropdown-menu").css('visible','none');
			});
			
			$("#nav li").hover(function() {
				if($(this).hasClass('dropdown')==true) {
					var strsub = $(this).html();
					strsub = strsub.split('<ul class="dropdown-menu">');
					$("#box_submenu .container").html("<ul>"+strsub[1]);
					$("#box_submenu").slideDown("slow");
				}
				else {
					$("#box_submenu").slideUp("slow");
					$("#box_submenu .container").html("");
				}
			},function(){});
			
			$("#banner").hover(function(){
				$("#box_submenu").slideUp("slow");
				$("#box_submenu .container").html("");
			},function(){});
			
			$("#box_main").hover(function(){
				$("#box_submenu").slideUp("slow");
				$("#box_submenu .container").html("");
			},function(){});
		}
		else {	
			$("#nav li.dropdown").click(function() {
				$("#box_submenu").hide();
				$("ul.dropdown-menu").toggle();
			})
			$('.col-left').hide();
		}
		//---------------------------------------------------------
		$("#back-top").hide();
		// fade in #back-top
		$(function () {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('#back-top').fadeIn();
				} else {
					$('#back-top').fadeOut();
				}
				$('#ads_left').animate({scrollTop:0});
				$('#ads_right').animate({scrollTop:0});
				
				//--------------------- CHANGE MENU TOP -------------------
				var h = $("#banner img").outerHeight()+$("#gf-header").outerHeight(); 
				if($(this).scrollTop() > h) {
					// Header chuyen sang nen trang,logo xanh
					$("#head-top").addClass("navbar-white");
					$("#head-top .navbar-brand img").attr('src','<?php echo ROOTHOST;?>images/logo/logo-huyhoang1.png');
					$(".icon-bar").css("background","#00613f");
					// Fix path + social like share
					//$('#path').css({"position":"fixed","top":"96px","z-index":"1000"});
				}
				else {
					// Header chuyen sang nen xanh,logo trang
					$("#head-top").removeClass("navbar-white");
					$("#head-top .navbar-brand img").attr('src','<?php echo ROOTHOST;?>images/logo/logo-huyhoang2.png');
					$(".icon-bar").css("background","#fff");
					// unfix path + social like share
					//$('#path').css({"position":"relative"});
					
				}
				//-------------- SHOW / HIDE SOCIAL LIKE SHARE ---------------
				var content_h = $(".content_detail .content").outerHeight()+h;
				if ($(this).scrollTop() > content_h) {
				  /*$('.like_share_box').css({
					'position': 'absolute',
					'display':'block'
				  });*/
				}else if ($(this).scrollTop() > h) {
				  $('.social_like_share').css({
					'position': 'fixed',
					'top': '200px',
					'left': '0px',
					'display':'block'
				  });
				  /*$('.like_share_box').css({
					'position': 'fixed',
					'top': '90px',
					'display':'block'
				  });*/
				}else
				  $('.social_like_share').css({
					'position': 'absolute',
					'top': '150px',
					'left': '-46px',
					'display':'block'
				  });
			});
			
			// scroll body to 0px on click
			$('#back-top a').click(function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
			
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' +  (currentIndex + 1) + ' / ' + currentArray.length + ' ' + title + '</span>';
				}
			});

		});		
    });

/* Google Analytics */	
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-62232999-1', 'auto');
ga('send', 'pageview');

/* ----------------- */
$(window).bind("load", function() {
   $.getScript('<?php echo ROOTHOST;?>js/social.js', function() {});
});
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-NMSGKG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NMSGKG');</script>
<!-- End Google Tag Manager -->
<script type="text/javascript">
var google_tag_params = {
dynx_itemid: 'REPLACE_WITH_VALUE',
dynx_itemid2: 'REPLACE_WITH_VALUE',
dynx_pagetype: 'REPLACE_WITH_VALUE',
dynx_totalvalue: 'REPLACE_WITH_VALUE',
};
</script>
<!-- Code tiếp thị lại -->
<script type="text/javascript">
/ <![CDATA[ /
var google_conversion_id = 947252848;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/ ]]> /
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/947252848/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- End code tiếp thị lại -->
</body>
</html>