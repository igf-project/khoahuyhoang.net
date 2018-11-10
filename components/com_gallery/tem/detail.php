<?php 
$id=0; 
if(isset($_GET["gid"])) $id = (int)$_GET["gid"];

if(!isset($objga)) $objga = new CLS_GALLERY;

//Dem luot xem bai viet
if(!isset($_SESSION['VIEW_GALLERY_ID']) || $_SESSION['VIEW_GALLERY_ID']!=$id) {
	$_SESSION['VIEW_GALLERY_ID']=$id;
	$objga->setVisited($id);
}

$objga->getList(" AND id=$id");
if($objga->num_rows()==0) echo '<script>window.location.href="'.ROOTHOST.'404.html";</script>';
$row = $objga->Fetch_Assoc();
$album_id = $row['album_id'];
?>
<div id="colmain">
	<div class="clr padding"></div>
	<div class="pro_info">
		<div class="col-md-5 col-sm-6 col-xs-6 gallery_thumb">
			<div class="logo-mark">&nbsp;</div>
			<img src="<?php echo stripslashes($row['img']);?>" class="img-responsive"/></div>
		<div class="col-md-7 col-sm-6 col-xs-6 info">
			<h2 class="gallery_name"><?php echo stripslashes($row['name']);?></h2>
			<div class="intro"><?php echo stripslashes($row['intro']);?></div>
		</div>
	</div>
	<div class="clr padding"></div>
	<div class="gallery">
		<div class="box_title">
			<h1 class="title"><a href="<?php echo ROOTHOST.'du-an/'.$album_id;?>">Một số hình ảnh dự án khác</a></h1>
			<div>Một số hình ảnh dự án khác của công ty TNHH Khóa Huy Hoàng.</div>
		</div>
		<div class="content">
		<?php $objga->ListGallery(" AND `album_id`=".$album_id," ORDER BY `order` ASC, id DESC LIMIT 0,12");?>
		</div>
	</div>
</div>