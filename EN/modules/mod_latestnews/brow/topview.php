<script>
function changeTABcontent(id) {
	if(id==1) {
		$('.max_viewer ul.title li').removeClass('selected');
		$('.max_viewer ul.title li:first').addClass('selected');
		$('.max_viewer ul#view_tab1').css("display","block");
		$('.max_viewer ul#view_tab2').css("display","none");
	}
	else {
		$('.max_viewer ul.title li').removeClass('selected');
		$('.max_viewer ul.title li:last').addClass('selected');
		$('.max_viewer ul#view_tab2').css("display","block");
		$('.max_viewer ul#view_tab1').css("display","none");
	}
}
</script>
<div class="max_viewer">
	<ul class="title">
		<li class="view_tab1 selected" onclick="changeTABcontent(1)">MOST VIEWED</li>
		<li class="view_tab2" onclick="changeTABcontent(2)">NEW POST</li>
	</ul>
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
			$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY `visited` DESC ',' LIMIT 0,5');
		}else{
			$objcon->getList("",' ORDER BY `visited` DESC ',' LIMIT 0,5');
		}
		echo "<ul class='content' id='view_tab1'>";
		while ($item_r = $objcon->Fetch_Assoc()) {

			$imgs=stripslashes($item_r["thumb_img"]);
			$checkimg = $objcon->checkImages($imgs);
			if ($checkimg==true) {
				$imageurl=$imgs;
			}else{
				$imageurl = ROOTHOST.'images/no-image.jpg';
			}
		
			$title = Substring(stripslashes($item_r["title"]),0,15);
			//$intro = Substring(trim(stripslashes($item_r["intro"])),0,20); 
			$cat_name = $objcat->getNameById($item_r['cat_id']); 
			$link = ROOTHOST.'news/'.stripslashes($item_r["code"]).'.html';
			echo '<li><a href="'.$link.'"><img src="'.$imageurl.'" alt="'.$title.'" tilte="'.$title.'"></a>
				<div class="tieude"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div></li>';
		}	
		echo "</ul>";
		if($catid!=''){
			$objcon->getList(" AND cat_id IN ('$catid') ",' ORDER BY `con_id` DESC ',' LIMIT 0,5');
		}else{
			$objcon->getList("",' ORDER BY `con_id` DESC ',' LIMIT 0,5');
		}
		echo "<ul class='content' id='view_tab2'>";
		while ($item_r = $objcon->Fetch_Assoc()) {
			$imgs=stripslashes($item_r["thumb_img"]);
			$checkimg = $objcon->checkImages($imgs);
			if ($checkimg==true) {
				$imageurl=$imgs;
			}else{
				$imageurl = ROOTHOST.'images/no-image.jpg';
			}

			$title = stripslashes($item_r["title"]);
			//$intro = Substring(stripslashes($item_r["intro"]),0,20); 
			$link = ROOTHOST.'news/'.stripslashes($item_r["code"]).'.html';
			echo '<li><a href="'.$link.'"><img src="'.$imageurl.'" alt="'.$title.'" tilte="'.$title.'"></a>
				<div class="tieude"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></div></li>';
		}	
		echo "</ul>";
	?>
</div>