<div class="content">
<?php 
require_once(libs_path."cls.content.php");
require_once(libs_path."cls.category.php");
if(!isset($objcon)) $objcon = new CLS_CONTENTS();
if(!isset($objcat)) $objcat = new CLS_CATE();
$catid='';
if($r['cat_id']!=''){
$catid = $r['cat_id']."','".$objcat->getCatIDChild('',$r['cat_id']);
}
if($catid!=''){
$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY con_id DESC ',' LIMIT 0,10');
}else{
$objcon->getList("",' ORDER BY con_id DESC ',' LIMIT 0,10');
}
echo "<ul>";
while ($item_r = $objcon->Fetch_Assoc()) {
	$imgs=stripslashes($item_r["thumb_img"]);
	if($imgs!='') $imgs ='<img src="'.$imgs.'" width="100" height="72" align="left" style="margin-right:10px"/>';
	$title = stripslashes($item_r["title"]);
	//$date=date('d/m/Y',strtotime($item_r["modifydate"]));
	//$author=$item_r["author"];
	$link = ROOTHOST.stripslashes($item_r["code"]).'.html';
	echo '<li><a href="'.$link.'">'.$imgs.'<strong>'.$title.'</strong></a></li>';
}	
echo "</ul>";
 ?>
</div>