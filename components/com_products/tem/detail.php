<div id="colmain">
	<div class="clr padding2"></div>
<?php
$name = $code='';
if(isset($_GET['code'])) {
	$code=addslashes($_GET['code']); 
	$name=isset($_GET['name'])?addslashes($_GET['name']):''; 
	// TH mã SP chứa dấu + trên URL sẽ trả về ký tự trắng. Vì vậy cần thay ký tự trắng về dấu +
	$code = str_replace(" ","+",$code);
}
if($code!=''){
	//Dem luot xem bai viet
	if(!isset($_SESSION['VIEW_PRODUCT_ID']) || $_SESSION['VIEW_PRODUCT_ID']!="$code") {
		$_SESSION['VIEW_PRODUCT_ID']=$code;
		$obj->setVisited("$code");
	}
	$obj->getList(' AND `pro_code`="'.$code.'"');
	
	$row=$obj->Fetch_Assoc();
	$pro_code=$row['pro_code'];
	
	$objcat = new CLS_CATALOGS;
	$cat_code = $objcat->getNameById($row['cat_id']);
	$cat_id = $row['cat_id'];
	
	$name=stripslashes($row['name']);
	$pro_code=stripslashes($row['pro_code']);
	$intro=stripslashes($row['intro']);
	$content=stripslashes($row['fulltext']);
	$link = ROOTHOST.un_unicode($name).'/'.$pro_code.'.html';
?>
<div class='pro_info'>
	<div class="col-md-6 col-sm-6 col-xs-6 box_thumb" id="pro_img">
		<?php $img = explode(',,|',stripslashes($row["thumb"]));
		echo "<a href='".$img[0]."' class='MagicZoom' id='Zoomer' rel='selectors-change: mouseover; selectors-effect: fade' title='".$pro_code."'>
				<img align='left' src='".$img[0]."' class='imgZoom img-responsive'/></a>";
		?>
	</div>
	<div class='col-md-6 col-sm-6 col-xs-6 info'>
		<h1 class="code"><?php echo $name;?></h1>
		<div class="pro_intro">
		<ul><li><span class="pro_label">Mã sản phẩm:</span><span class="pro_text"><strong><?php echo $pro_code;?></strong></span></li>
		<li><span class="pro_label">Thương hiệu:</span><span class="pro_text"><strong>Khóa Huy Hoàng</strong></span></li></ul>
		<?php if($intro!='') { ?>
		<?php echo $intro;?>
		<?php } ?>
		</div>
		<hr size=1 width="100%">
		<?php echo '<div class="img_item">';
		for($i=0;$i<count($img)-1;$i++) {
			if($img[$i]=='') $img[$i]=ROOTHOST.'images/no-image.jpg';
			echo "<a href='".$img[$i]."' rel='zoom-id:Zoomer' rev='".$img[$i]."'><img align='left' src='".$img[$i]."' class='thumb'/></a>";
		}
		echo '</div>';
		?>
		<div class="clr"></div>
		<hr size=1 width="100%">
		<div class="price"><a href="<?php echo ROOTHOST.'lien-he';?>">Liên hệ báo giá  <span class="glyphicon glyphicon-forward"></span></a></div>
	</div>
</div>
<div class="clr"></div>
<?php if($content!='') {
$info = $techno = $document = '';
$arr = explode("<div>{/tab1}</div>",$content);

if(count($arr)>0) {
	if(isset($arr[0])) $info = str_replace("<div>{tab1}</div>","",$arr[0]);
	if(isset($arr[1])) $techno = explode("<div>{/tab2}</div>",$arr[1]);
	if(count($techno)>0) {
		if(isset($techno[1])) 	$document = $techno[1];
		if(isset($techno[0])) 	$techno   = str_replace("<div>{tab2}</div>","",$techno[0]); 
		if($document!='') {
			$document = str_replace("<div>{tab3}</div>","",$document);
			$document = str_replace("<div>{/tab3}</div>","",$document);
			$document = str_replace("</a></li>"," <span class='glyphicon glyphicon-save'></span></a></li>",$document);
		}
	}
}
else $info = $content;
?>
<div class="detail_product rows" code='detail'>
	<div id="tabs">
		<ul>
		<li rel="tab-feature" class="active">Tính năng</li>
		<li rel="tab-techno">Thông số kỹ thuật</li>
		<li rel="tab-document">Tài liệu hướng dẫn</li>
		</ul>
	</div>
	<?php //if($_SERVER['REMOTE_ADDR']=="1.55.150.126") { ?>
	<div id="tab-feature" class="tab_content"><h2>Tính năng của <?php echo $name;?></h2><?php echo $info;?></div>
	<div id="tab-techno" class="tab_content"><h2>Thông số kỹ thuật <?php echo $name;?></h2><?php echo $techno;?></div>
	<div id="tab-document" class="tab_content"><h2>Tài liệu hướng dẫn <?php echo $name;?></h2><?php echo $document;?></div>
<?php 
} unset($row); unset($product); unset($title); unset($id);
}
?>
</div>
<div class='clr'></div>
<div id="box_comments">
	<div class="fb-comments" data-href="<?php echo $link;?>" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
</div>
<div class='clr'></div>
<!-- RELATES PRODUCTS -->
<?php 
$objpro = new CLS_PRODUCTS;
$str = $objpro->ReleaseProduct($pro_code,$cat_id," ORDER BY RAND() "," LIMIT 0,9");	
if($str!='') {
?>
<div class="rows col-relates">
	<h3 class="tieu-de"><span><?php echo $cat_code;?> cùng loại</span></h3>
	<div class="relates slide_products"><?php echo $str;?></div>
</div><br>
<?php } 
$str2 = $objpro->ReleaseProduct($pro_code,0," ORDER BY RAND() "," LIMIT 0,6");
if($str2!='') {
?>
<!-- RELATES PRODUCTS -->
<div class="rows col-relates">
	<div class="tieu-de"><span>Có thể bạn quan tâm</span></div>
	<div class="products"><?php echo $str2;?></div>
</div>
<br>
<?php }
unset($objpro);unset($pro_code);?>