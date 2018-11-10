<?php 
$id=0;
if(isset($_GET["id"])) $id = (int)$_GET["id"];

if(!isset($objga)) $objga = new CLS_GALLERY;
?>
<div id="colmain">
	<div class="clr padding"></div>
	<?php if($id!=0) 
	{ 
	$title=$objga->getNameById($id);
	if($title=='') $title = 'Project';
	?>
	<div class="gallery">
		<div class="box_title">
			<h1 class="title"><a href="<?php echo ROOTHOST.'project/'.un_unicode($title);?>"><?php echo $title; ?></a></h1>
			<div>Some pictures of the company's projects TNHH Huy Hoang Lock.</div>
		</div>
		<div class="content">
		<?php
			$start_r=($cur_page-1)*MAX_ITEM;
			if($id!=0) $objga->ListGallery(" AND `album_id` in ('$id') ");
			else $objga->ListAlbum();
		?></div>
	</div>
	<?php
	} else {
		$title=$objga->getNameById(1);
	?>
	<div class="gallery">
		<div class="box_title">
			<h1 class="title"><a href="<?php echo ROOTHOST.'project/1';?>"><?php echo $title; ?></a></h1>
			<div>Some pictures of the project was done by the company TNHH Huy Hoang Lock.</div>
		</div>
		<div class="content">
		<?php $objga->ListGallery(" AND `album_id`=1 ");?>
		</div>
	</div>
	<?php $title=$objga->getNameById(2);?>
	<div class="gallery">
		<div class="box_title">
			<h1 class="title"><a href="<?php echo ROOTHOST.'project/2';?>"><?php echo $title; ?></a></h1>
			<div>Some pictures of the project is done by the company TNHH Huy Hoang Lock.</div>
		</div>
		<div class="content">
		<?php $objga->ListGallery(" AND `album_id`=2 ");?>
		</div>
	</div>
	<?php
	}?>
</div>
<?php 
unset($objga);?>