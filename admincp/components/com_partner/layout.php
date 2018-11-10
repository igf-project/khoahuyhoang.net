<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','partner');
	// Begin Toolbar
	require_once(LAG_PATH.'vi/lang_partner.php');
	require_once(libs_path.'cls.partner.php');
	if(!isset($objlang)) $objlang = new LANG_SALES;
	$title_manager = "Quản lý gian hàng";//$objlang->CATE_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = "Thêm mới gian hàng";//$objlang->CATE_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = "Update gian hàng";//$objlang->CATE_MANAGER_EDIT;		
	require_once('includes/toolbar.php');
	// End toolbar
?>
<?php
	$obj=new CLS_PARTNER();
	if(isset($_POST['cmdsave'])){
		$obj->Company_Name=addslashes($_POST['txt_ctyname']);
        $obj->Address=addslashes($_POST['txt_address']);
        $obj->Phone=addslashes($_POST['txt_phone']);
		$obj->Fax=addslashes($_POST['txt_fax']);
		$obj->Email=addslashes($_POST['txt_email']);
		$obj->Website=addslashes($_POST['txt_website']);
		if($_POST['txtthumb']!='')
			$obj->Logo=addslashes($_POST['txtthumb']);
		else
			$obj->Logo=ROOTHOST.'images/logo-igf.png';		
		$sContent=addslashes($_POST['txtintro']);
		$obj->Intro=encodeHTML($sContent);
		$obj->isActive=(int)$_POST['optactive'];
		$obj->Author=$_SESSION[md5($_SERVER['HTTP_HOST']).'_USERLOGIN'];
		if(isset($_POST['txtid'])){
			$obj->Partner_ID=(int)$_POST['txtid'];
			$obj->Update();
		}
        else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!=""){
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "delete": 		$obj->Delete($ids); 			break;
		}
		echo "<script language=\"javascript\">window.location.href='index.php?com=".COMS."'</script>";
	}
	
	define('THIS_COM_PATH',COM_PATH.'com_'.COMS.'/');
	if(isset($_GET['task']))
		$task=$_GET['task'];
	if(!is_file(THIS_COM_PATH.'task/'.$task.'.php')){
		$task='list';
	}
	include_once(THIS_COM_PATH.'task/'.$task.'.php');
	unset($task); unset($ids); unset($obj); unset($objlang);
?>