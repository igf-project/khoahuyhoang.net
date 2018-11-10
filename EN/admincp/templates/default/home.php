<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
if(!isset($_SESSION["CUR_MENU"]))
	$_SESSION["CUR_MENU"]="";
if(isset($_GET["cur_menu"]))
	$_SESSION["CUR_MENU"]=$_GET["cur_menu"];
$UserLogin=new CLS_USERS();
?>
<!DOCTYPE html>
<html language='vi'>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="shortcut icon" href="images/favicon.png" type="image/png">
	<title>Khoahuyhoang.net- CMS Control panel</title>
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/gfstyle.css?v=2" type="text/css" />
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/jquery-ui.css" type="text/css" media="all" /> 
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/ui.theme.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo THIS_TEM_ADMIN_PATH; ?>css/colorpicker.css" type="text/css"/>
	<?php if($_GET['com']=="contents" && $_GET['task']=="preview") { ?>
	<link rel="stylesheet" href="http://khoahuyhoang.net/templates/default/css/bootstrap.css" type="text/css" >
	<link rel="stylesheet" href="http://khoahuyhoang.net/templates/default/css/gf-style.css" type="text/css" >
	<?php } ?>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<script src="<?php echo ROOTHOST;?>extensions/colorpicker.js"></script>
	<script type='text/javascript' src="<?php echo THIS_TEM_ADMIN_PATH; ?>js/calendar_vi.php"></script>
	<script type='text/javascript' src="<?php echo THIS_TEM_ADMIN_PATH; ?>js/function.php"></script>
	<script type='text/javascript' src="<?php echo THIS_TEM_ADMIN_PATH; ?>js/check_form.php"></script>
	<script type='text/javascript' src="<?php echo EDIT_FULL_PATH; ?>"></script>
	<script type='text/javascript' src="../<?php echo JSC_PATH; ?>gfscript.php"></script>
	<script type='text/javascript' src="../<?php echo JSC_PATH; ?>jquery.validate.php"></script>
	<script type='text/javascript'>
		$(document).ready(function(){
			$("#navitor ul li").each(function(){
				var popup= $(this).find(".submenu");
				if (popup){ 
					$(this).hover(function(){ 
						popup.show(); 
					},function(){ popup.hide(); });
				}else{
					alert("not exit");
				}
			});
			//----------------------------------------------------
			var content;
			$('#meta_title').on('keyup', function(){
				// count words by whitespace
				var words = $(this).val().length;
				$('#count_title').html(words);
			});
			$('#meta_desc').on('keyup', function(){
				// count words by whitespace
				var words = $(this).val().length;
				$('#count_desc').html(words);
			});
		});
	</script>
</head>
<body>
<div id="wapper">
	<?php require_once(LAG_PATH."vi/general.php");?>
    <?php require_once(LAG_PATH."vi/lang_menu.php");?>
	<?php require_once(MOD_PATH."mod_mainmenu/layout.php");?>
    <div id="body">
   		<?php
    	if($UserLogin->isLogin()!=true){
			include_once(COM_PATH."com_users/task/login.php");
		}else{
        ?>
		<div id="path" style="text-align:right; height:30px; line-height:30px;background:#ddd;"><strong>Chào: <?php echo $_SESSION[MD5($_SERVER['HTTP_HOST'])."_USERLOGIN"];?></strong></div>
    	<div id="panel_main">
        	<div class="content" style="margin: 10px;">
                <?php 
					$com="";
					if(isset($_GET["com"]))
					$com=$_GET["com"];
					if(!is_file(COM_PATH."com_".$com."/layout.php"))
						$com='fronpage';
					include(COM_PATH."com_".$com."/layout.php");
				?>
            </div>   
			<div class="clr">&nbsp;</div>
        </div>
        <?php } ?>
    </div>
    <div id="footer"><?php require_once(MOD_PATH."mod_footer/layout.php");?></div>
	<div class="clr">&nbsp;</div>
</div>
</body>
</html>