<?php
session_start();
ini_set('display_errors', 1);
define('incl_path','../includes/');
define('libs_path','libs/');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.users.php');
require_once(libs_path.'cls.menu.php');
require_once(libs_path.'cls.template.php');
if(!isset($_SESSION['CONNECT_TYPE']) || $_SESSION['CONNECT_TYPE']==''){
	$_SESSION['CONNECT_TYPE']='main';
}
$obj_sql= new CLS_MYSQL();
$UserLogin=new CLS_USERS;
$tmp=new CLS_TEMPLATE;
$tmp->Load_Extension();
define('ISHOME',true);
define('THIS_TEM_ADMIN_PATH',TEM_PATH.'default/');
$tmp->WapperTem();