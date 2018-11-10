<?php if(!isset($_GET['viewtype'])) echo '<div class="clr padding2"></div>';?>
<div class="box_products">
<?php 
$clsimage = new SimpleImage();
$code='';
if(isset($_GET["code"])) $code = addslashes($_GET["code"]); 
$max_rows=MAX_ROWS_INDEX;
$cur_page=1;
if(isset($_POST['txtCurnpage'])){$cur_page=$_POST['txtCurnpage'];}	
$total_rows="0";

if(!isset($objcat)) $objcat = new CLS_CATALOGS;
if(!isset($obj)) $obj = new CLS_PRODUCTS;

if($code=='')	$objcat->getList(" AND par_id=0 ORDER BY cat_id ASC "); 
else $objcat->getList(" AND alias='$code' ORDER BY cat_id ASC"); 
$item = $objcat->Num_rows();
if($item==0) 
	echo '<script>window.location.href="'.ROOTHOST.'404.html";</script>';
else {
	$i=1;
	while($arr = $objcat->Fetch_Assoc()) {
		$name = un_unicode(substr($arr['name'],0,1)).substr($arr['name'],1,strlen($arr['name']));
		$desc = trim(strip_tags($arr['h1']));
		if($code!='') {
			if($desc!='')
				echo '<h1 class="tieu-de"><a href="'.ROOTHOST.un_unicode($arr['name']).'" title="'.$desc.'">'.$desc.'</a></h1>';
			else 
				echo '<h1 class="tieu-de"><a href="'.ROOTHOST.un_unicode($arr['name']).'" title="'.$name.'">Nhóm '.$name.'</a></h1>';
		}else { 
			if($i==1) {
				if($desc!='')
					echo '<h1 class="tieu-de"><a href="'.ROOTHOST.un_unicode($arr['name']).'" title="'.$desc.'">'.$desc.'</a></h1>';
				else 
					echo '<h1 class="tieu-de"><a href="'.ROOTHOST.un_unicode($arr['name']).'" title="'.$name.'">Nhóm '.$name.'</a></h1>';
			}else {
				if($desc!='')
				echo '<h2 class="tieu-de"><a href="'.ROOTHOST.un_unicode($arr['name']).'" title="'.$desc.'">'.$desc.'</a></h2>';
			else 
				echo '<h2 class="tieu-de"><a href="'.ROOTHOST.un_unicode($arr['name']).'" title="'.$name.'">Nhóm '.$name.'</a></h2>';
			}
			$i++;
		} ?>
	<div class="products">
		<?php 
		/* 
		Neu co nhom SP con thi show catalogs con cua nhom 
		Neu ko thi show products cua nhom do
		*/ 
		$kq = $objcat->haveChild($arr['cat_id']);
		if($kq>0) {
			if($code=='') {
				$objcat->getList_4Colunm($arr['cat_id'],30,false);
				echo '<div class="read-more">
					<a href="'.ROOTHOST.$arr['alias'].'">
						<span class="caret"></span> Xem tất cả SP nhóm "'.$arr['name'].'"
					</a>
				</div><br>';
			}else{ 
				$objcat->getAllListCategory($arr['cat_id'],30,false);
				echo '<h3 class="read-more">
					<a href="'.ROOTHOST.$arr['alias'].'">
						<span class="caret"></span> Xem tất cả SP nhóm "'.$arr['name'].'"
					</a>
				</h3><br>';
			}
		}
		else {
			/*
			Neu show product trong trang san-pham: show 4 sp. 
			Neu show trang sp con thì show all co paging 
			*/
			if($code==''){
				$obj->ListProduct(" AND `cat_id`='".$arr['cat_id']."' "," ORDER BY `order` ASC, pro_code ASC "," LIMIT 0,4");
				echo '<div class="read-more">
					<a href="'.ROOTHOST.$arr['alias'].'">
						<span class="caret"></span> Xem tất cả SP nhóm "'.$arr['name'].'"
					</a>
				</div><br>';
			}else {
				$start = ($cur_page-1)*$max_rows;
				$obj->getList(" AND `cat_id`='".$arr['cat_id']."' ");
				$total_rows = $obj->num_rows();
				$obj->ListProduct(" AND `cat_id`='".$arr['cat_id']."' "," ORDER BY `order` ASC, pro_code ASC "," LIMIT $start,".MAX_ROWS_INDEX,3);
				// show Paging
				echo '<h3 class="read-more">
					<a href="'.ROOTHOST.$arr['alias'].'">
						<span class="caret"></span> Xem tất cả SP nhóm "'.$arr['name'].'"
					</a>
				</h3><br>';
				echo '<div class="clr"></div>';
				echo '<div id="paging_index">'.paging_index($total_rows,$max_rows,$cur_page).'</div>';
			}
		}
		?>
	</div>
<?php 
	} // end while
} //end if?>
</div>