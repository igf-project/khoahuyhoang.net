<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$id='';
	if(isset($_GET['id']))
		$id=trim($_GET['id']);
	// TH mã SP chứa dấu + trên URL sẽ trả về ký tự trắng. Vì vậy cần thay ký tự trắng về dấu +
	$id = str_replace(" ","+",$id);
	$obj->Delete($id);
	echo "<script language=\"javascript\">window.location='index.php?com=".COMS."'</script>";
?>