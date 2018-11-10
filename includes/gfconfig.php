<?php
// define path to dirs
	define('ROOTHOST','http://'.$_SERVER['SERVER_NAME'].'/khoahuyhoang.net/');
	define('WEBSITE','http://'.$_SERVER['SERVER_NAME'].'/khoahuyhoang.net/');
	define('DOMAIN',$_SERVER['SERVER_NAME']);
	define('BASEVIRTUAL0',ROOTHOST.'images/');
	define('ROOT_PATH',''); 
	define('TEM_PATH',ROOT_PATH.'templates/');
	define('COM_PATH',ROOT_PATH.'components/');
	define('MOD_PATH',ROOT_PATH.'modules/');
	define('LAG_PATH',ROOT_PATH.'languages/');
	define('EXT_PATH',ROOT_PATH.'extensions/');
	define('EDI_PATH',EXT_PATH.'editor/');
	define('DOC_PATH',ROOT_PATH.'documents/');
	define('DAT_PATH',ROOT_PATH.'databases/');
	define('IMG_PATH',ROOT_PATH.'images/');
	define('MED_PATH',ROOT_PATH.'media/');
	define('LIB_PATH',ROOT_PATH.'libs/');
	define('JSC_PATH',ROOT_PATH.'js/');
	define('LOG_PATH',ROOT_PATH.'logs/');
	
	define('MAX_ROWS','50');
	define('MAX_ITEM','20'); // số bản ghi trên 1 trang
	define('LOGIN_TIME_OUT','60');
	define('URL_REWRITE','1');
	define('MAX_ROWS_INDEX',12);
	
	define('THUMB_WIDTH',285);
	define('THUMB_HEIGHT',285);
	
	$LANG_CODE='vi';
	
	define('SMTP_SERVER','smtp.gmail.com');
	define('SMTP_PORT','465');
	define('SMTP_USER','khoahuyhoang.net@gmail.com');
	define('SMTP_PASS','huyhoang868');
	define('SMTP_MAIL','khoahuyhoang.net@gmail.com');
	define('IGF_LICENSE','77667050813dd94a49756d59de5cea88');
	
	define('SHOP_CODE','TD');//hàng tiêu dùng
	define('SITE_NAME','seogoogle.com');
	define('SITE_TITLE','');
	define('SITE_DESC','');
	define('SITE_KEY','');
	define('COM_NAME','Copyright &copy; by IGF');
	define('COM_CONTACT','');
?>