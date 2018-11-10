<?php
defined('ISHOME') or die('Can not acess this page, please come back!');
define('COMS','products');
define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
// Begin Toolbar
require_once(libs_path.'cls.products.php');
require_once(libs_path.'cls.catalogs.php');
require_once(libs_path.'cls.partner.php');
require_once(libs_path.'cls.vendor.php');

$obj=new CLS_PRODUCTS;
$title_manager="Quản lý sản phẩm";
if(isset($_GET['task']) && $_GET['task']=='add')
	$title_manager = "Thêm mới sản phẩm";
if(isset($_GET['task']) && $_GET['task']=='edit')
	$title_manager = "Sửa sản phẩm";
	
require_once("includes/toolbar.php");
require_once("includes/color_nsx.php");
// End toolbar
if(isset($_POST["cmdsave"])){		
	$obj->Pro_Code=$_POST['txt_code'];
	$obj->Partner_ID=	(int)$_POST['cbo_partner'];
	$obj->Vendor_ID=	(int)$_POST['cbo_vendor'];
	$obj->Cata_ID=		(int)$_POST['cbo_cata'];
	$obj->Name= addslashes($_POST['txt_proname']);
	$obj->Color= addslashes($_POST['txt_color']);		
	$obj->Size=	addslashes($_POST['txt_size']);
	$obj->Old_price=addslashes($_POST['txt_oldprice']);
	$obj->Cur_price=addslashes($_POST['txt_curprice']);
	$obj->Quantity=addslashes($_POST['txt_quantity']);
	$obj->Thumb=addslashes($_POST['txt_thumb']);
	$obj->Author=$_SESSION[md5($_SERVER['HTTP_HOST']).'_USERLOGIN'];		
	$obj->isHot=	(int)$_POST['opt_hot'];
	$obj->isActive=	(int)$_POST['optactive'];
	$obj->Intro=addslashes($_POST['txtintro']);
	$obj->Fulltext=	addslashes($_POST['txtfulltext']);
	$obj->MTitle=addslashes($_POST['meta_title']);	
	$obj->MKey=addslashes($_POST['meta_key']);	
	$obj->MCanon=addslashes($_POST['meta_canon']);	
	$obj->MDesc=addslashes(strip_tags($_POST['meta_desc']));
	
	if(isset($_POST["txtcreadate"])){
	$txtjoindate=trim($_POST["txtcreadate"]);
	$joindate = mktime(0,0,0,substr($txtjoindate,3,2),substr($txtjoindate,0,2),substr($txtjoindate,6,4));
	$obj->Cdate = date("Y-m-d",$joindate);
	}
	if(isset($_POST["txtmodifydate"])) {
		$txtjoindate2=trim($_POST["txtmodifydate"]);
		$joindate2 = mktime(0,0,0,substr($txtjoindate2,3,2),substr($txtjoindate2,0,2),substr($txtjoindate2,6,4));
		$obj->Mdate = date("Y-m-d",$joindate2);
	}		
	if(isset($_POST['txtid'])){
		$obj->ID=$_POST['txtid'];			
		$obj->Update();
	}else{
		$obj->Add_new();
	}
	//echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
}
if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
	$ids=$_POST["txtids"];
	$ids=str_replace(",","','",$ids);
	switch ($_POST["txtaction"]){
		case "public": 		$obj->setActive($ids,1); 		break;
		case "unpublic": 	$obj->setActive($ids,0); 		break;
		case "edit": 	break;
		case 'order':
			$sls=explode(',',$_POST['txtorders']); $ids=explode(',',$_POST['txtids']);
			$obj->Order($ids,$sls); 	break;	
		case "delete": 		$obj->Delete($ids); 		break;
	}
	echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
}
if(isset($_GET['task']))
	$task=$_GET['task'];
if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
	$task='list';
}
include_once(THIS_COM_PATH.'task/'.$task.'.php');
unset($obj); unset($task);	unset($objlang); unset($ids);
?>