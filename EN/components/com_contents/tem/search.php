<div class="clr padding2"></div>
<?php
$key ='';
if(isset($_POST["txtsearch"]))
   $key= addslashes(trim($_POST["txtsearch"]));

$str_empty = ' kết quả tìm kiếm cho từ khóa <strong>'.$key.'</strong>';
  
if (strlen($key)<=1) 
	echo '<div class="text-center"><h2>Quý khách vui lòng nhập từ khóa muốn tìm kiếm.
			<br><br>Từ khóa tối thiểu là 2 ký tự</h2><br></div>';
else{
	// MUC SAN PHAM
?>
<div class="col-md-6 col-sm-12 news">
	<h2 class="title">Sản phẩm</h2>
	<?php 
	if(!isset($objsp)) $objsp=new CLS_PRODUCTS();
	$objsp->getList(" AND (`pro_code` LIKE '%$key%' OR `name` LIKE '%$key%' OR `intro` LIKE '%$key%' OR `fulltext` LIKE '%$key%')");
	if($objsp->Num_rows()>0) {
		echo "<div class='result'>".$objsp->Num_rows().$str_empty."</div>
			<ul>";
		while($rows = $objsp->Fetch_Assoc()) {
			$link = ROOTHOST.un_unicode(stripslashes($rows['name'])).'/'.$rows['pro_code'].".html";
			echo "<li class='item'><a href='".$link."' title='".stripslashes($rows['name'])."'>".stripslashes($rows['name'])."</a></li>";
		}
		echo "</ul>";
	}
	else echo "<div class='result'>0".$str_empty."</div>";
	?>
</div>
<?php // MUC TIN TUC ?>
<div class="col-md-6 col-sm-12 news">
	<h2 class="title">Tin tức</h2>
	<?php 
	if(!isset($obj)) $obj=new CLS_CONTENTS();
	$obj->getList(" AND (`code` LIKE '%$key%' OR `title` LIKE '%$key%' OR `intro` LIKE '%$key%' OR `fulltext` LIKE '%$key%')");
	if($obj->Num_rows()>0) {
		echo "<div class='result'>".$obj->Num_rows().$str_empty."</div>
			<ul>";
		while($rows = $obj->Fetch_Assoc()) {
			echo "<li class='item'><a href='".ROOTHOST.'tin-tuc/'.$rows['code'].".html' title='".stripslashes($rows['title'])."'>".stripslashes($rows['title'])."</a></li>";
		}
		echo "</ul>";
	}
	else echo "<div class='result'>0".$str_empty."</div>";
	?>
</div>
<?php } unset($obj); unset($objsp);?>