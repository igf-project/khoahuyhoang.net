<div class="clr padding"></div>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$code='';
if(isset($_GET["code"])) 	$code = addslashes($_GET["code"]);
$max_rows=MAX_ROWS_INDEX;
$cur_page=1;
if(isset($_POST['txtCurnpage'])){$cur_page=$_POST['txtCurnpage'];}	
$total_rows="0";

if(!isset($objcat)) $objcat = new CLS_CATE;
$objcat->getList(" AND alias='$code' ");
if($objcat->num_rows()==0) {
	echo '<script>window.location.href="'.ROOTHOST.'404.html";</script>';
}else {
	$row_cat=$objcat->Fetch_Assoc();
	$catename= $objcat->getNameById($row_cat['cat_id']);
	$ids = $objcat->getCatIDChild('',$row_cat['cat_id']);

	if($ids!='') {
		$arr = explode("','",$ids);
		$n = count($arr)-1;
		unset($arr[$n]);
		
		foreach($arr as $item) { 
			$name =  $objcat->getNameById($item); 
			$limit = " LIMIT 0,6";
			$onCategory = false;
			include(COM_PATH."com_contents/tem/list.php");
		} // end foreach
	} else {
		$item = $row_cat['cat_id'];
		$name =  $objcat->getNameById($item);
		$start = ($cur_page-1)*$max_rows;
		$limit = '';
		$onCategory = true;
		include(COM_PATH."com_contents/tem/list.php");
	}
} // end if
?>