<?php
//ini_set('display_errors','0');
//ini_set('zlib_output_compression','On');
//ini_set('output_buffering','On');
session_start();
header("Expires:".gmdate("D, d M Y H:i:s", time()+15360000)."GMT");
header("Cache-Control: max-age=315360000");
// include config
define('incl_path','includes/');
define('libs_path','libs/');

require_once(incl_path.'simple_html_dom.php');
require_once(incl_path.'gfconfig.php');
require_once(incl_path.'gfinnit.php');
require_once(incl_path.'gffunction.php');
// include libs
require_once(libs_path.'cls.mysql.php');
require_once(libs_path.'cls.template.php');
require_once(libs_path.'cls.module.php');
require_once(libs_path.'cls.menuitem.php');
require_once(LIB_PATH.'cls.category.php');
require_once(LIB_PATH.'cls.content.php');
require_once(LIB_PATH.'cls.catalogs.php');
require_once(LIB_PATH.'cls.products.php');
require_once(LIB_PATH.'cls.simple_image.php');
require_once(LIB_PATH.'cls.partner.php');
require_once(LIB_PATH.'cls.vendor.php');
require_once(LIB_PATH.'cls.orders.php');
require_once(libs_path.'cls.configsite.php');
require_once(libs_path.'cls.mail.php');
require_once(libs_path.'cls.gallery.php');

$tmp=new CLS_TEMPLATE();
$tmp_name=$tmp->Load_defaul_tem();
$this_tem_path=TEM_PATH.$tmp_name.'/';
// Define this template path
define('ISHOME',true);
define('THIS_TEM_PATH',$this_tem_path);
$tmp->WapperTem();
?>