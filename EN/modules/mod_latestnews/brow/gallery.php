<div class="content">
<?php 
require_once(libs_path."cls.gallery.php");
if(!isset($objgal)) $objgal = new CLS_GALLERY();

$objgal->getList(' AND isactive=1',' ORDER BY RAND() LIMIT 10');
echo "<ul>"; $i=0;
while ($item_r = $objgal->Fetch_Assoc()) {
	$name = stripslashes($item_r["name"]);
	$intro = stripslashes($item_r["intro"]);
	$img = stripslashes($item_r["img"]);
	$link = ROOTHOST.'du-an/'.$item_r['id'].'/'.un_unicode($name).'.html';
	if($img!='') $img = '<img src="'.$img.'" alt="'.$name.'" class="img-responsive"/>';
	
	if($i==0) {
		echo '<li class="lastest gallery_news">
				<div class="logo-mark">&nbsp;</div>
				<a href="'.$link.'" class="thumb_img" title="'.$name.'">'.$img.'</a>
				<a href="'.$link.'" title="'.$name.'"><div class="title">'.$name.'</div></a>';
		if($intro!='')
		echo '	<div class="intro">'.$intro.'</div>';
		echo '	<div class="readmore">
					<a href="'.$link.'">VIEW MORE <span class="glyphicon glyphicon-forward"></span></a>
				</div></li>';
	} else echo '<li class="item"><a href="'.$link.'">'.$name.'</a></li>';
	$i++;
}	
echo "</ul><br>";
 ?>
</div>