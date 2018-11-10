<?php include("helper.php");?>
<?php 
include_once(libs_path.'cls.products.php');
include_once(libs_path.'cls.simple_image.php');
$clsimage = new SimpleImage();
$obj=new CLS_PRODUCTS;
$objcat=new CLS_CATALOGS;
?>
<div class="module<?php echo " ".$r['class'];?>">
<?php if($r['viewtitle']==1){?>
<h2 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h2>
<div class="title-desc">Sản xuất trên dây truyền thiết bị hiện đại - Sản lượng trên 10 triệu SP/năm</div>
<?php } ?>
<div class="products">
	<?php 
	$obj->getList(' ',' ORDER BY cdate DESC ',' ');
	while($rows=$obj->Fetch_Assoc()){
		$img_src = '';
		if($rows['thumb']!='') {
			$img_src = explode(",,|",$rows['thumb']);
			$img_src = $img_src[0];
		}
		$link = ROOTHOST."san-pham/".$rows['pro_code'].".html";
	?>
	<article class="product col-md-4 col-sm-6 col-xs-12 text-center"> 
		<div class="content-inner">
			<a href="<?php echo $link;?>"><img src="<?php echo $img_src;?>" align="absmiddle" class="img-responsive" alt="<?php echo $rows['name'];?>"/></a>
			<h3 class="title"><a href="<?php echo $link;?>"><?php echo $rows['name'];?></a></h3>
			<div class="description"><?php echo Substring(stripslashes($rows['intro']),0,20);?></div>
			<div class="icon">
				<?php if($rows['ishot']==1) echo '<span class="hit"></span>';?>
				<?php if($rows['visited']>=1) echo '<span class="best"></span>';?>
			</div>
		</div>
	</article>
	<?php } ?>
    <div class='clr'></div>
</div>
</div>
<?php unset($obj); unset($r);?>