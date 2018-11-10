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
$objcon->getList("",' ORDER BY con_id DESC ',' LIMIT 0,5');
}
echo "<ul>"; $i=0;
while ($item_r = $objcon->Fetch_Assoc()) {
	$title = stripslashes($item_r["title"]);
	$intro = stripslashes($item_r["intro"]);
	$link = ROOTHOST.'tin-tuc/'.stripslashes($item_r["code"]).'.html';
	$imgs=stripslashes($item_r["thumb_img"]);
	if($imgs!='') $imgs ='<img src="'.$imgs.'" alt="'.$title.'" class="img-responsive"/>';
	
	if($i==0) {
		echo '<li class="lastest">
				<a href="'.$link.'" class="thumb_img" title="'.$title.'">'.$imgs.'</a>
				<a href="'.$link.'" title="'.$title.'"><div class="title">'.$title.'</div></a>';
		if($intro!='')
		echo '	<div class="intro">'.$intro.'</div>';
		echo '	<div class="readmore">
					<a href="'.$link.'" title="Xem them">XEM THÊM <span class="glyphicon glyphicon-forward"></span></a>
				</div></li>';
	} else echo '<li class="item"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
	$i++;
}	
echo "</ul><br>";
 ?>
</div>