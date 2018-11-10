<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','saler');
	ini_set('display_errors',1);
	// Begin Toolbar
	require_once(LAG_PATH.'vi/lang_sales.php');
	require_once(libs_path.'cls.sales.php');
	if(!isset($objlang)) $objlang = new LANG_SALES;
	$title_manager = $objlang->CATE_MANAGER;
	if(isset($_GET['task']) && $_GET['task']=='add')
		$title_manager = $objlang->CATE_MANAGER_ADD;
	if(isset($_GET['task']) && $_GET['task']=='edit')
		$title_manager = $objlang->CATE_MANAGER_EDIT;		
	require_once('includes/toolbar.php');
	// End toolbar
?>
<?php
	$obj=new CLS_SALES();
	if(isset($_POST['cmdsave']))
	{
		$obj->Cty_Name=addslashes($_POST['txt_ctyname']);
        $obj->Address=addslashes($_POST['txt_address']);
        $obj->Phone=addslashes($_POST['txt_phone']);
		$obj->Fax=addslashes($_POST['txt_fax']);
		$obj->Name_Contact=addslashes($_POST['txt_ncontact']);
        $obj->Tel=addslashes($_POST['txt_tel']);
		$obj->Email=addslashes($_POST['txt_email']);
		$sContent=addslashes($_POST['txt_intro']);
		$obj->Intro=encodeHTML($sContent);
		$obj->isActive=(int)$_POST['optactive'];
		$obj->Author=$_SESSION['IGFUSERLOGIN'];
		if(isset($_POST['txtid'])){
			$obj->Sale_ID=(int)$_POST['txtid'];
			$obj->Update();
		}
        else{
			$obj->Add_new();
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."&mess=U01'</script>";
	}
	if(isset($_POST["txtaction"]) && $_POST["txtaction"]!="")
	{
		$ids=trim($_POST["txtids"]);
		if($ids!='')
			$ids = substr($ids,0,strlen($ids)-1);
		$ids=str_replace(",","','",$ids);
		switch ($_POST["txtaction"]){
			case "public": 		$obj->setActive($ids,1); 		break;
			case "unpublic": 	$obj->setActive($ids,0); 		break;
			case "delete": 		$obj->Delete($ids); 			break;
		}
		echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
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