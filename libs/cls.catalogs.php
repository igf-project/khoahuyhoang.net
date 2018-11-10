<?php
class CLS_CATALOGS{
	private $objmysql=null;
	public function CLS_CATALOGS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=''){
		$sql="SELECT * FROM `tbl_catalog`  WHERE `isactive`=1 ".$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function haveChild($cat_id) {
		$sql="SELECT * FROM `tbl_catalog` WHERE `isactive`=1 AND `par_id`='$cat_id'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) return $objdata->Num_rows();
		return 0;
	}
	public function FindRootId($CatId){
		$sql="SELECT `cat_id`,`par_id` FROM `tbl_catalog` WHERE `cat_id`=$CatId";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		if($row['par_id']==0)
			return $row['cat_id'];
		else
			return $this->FindRootId($row['par_id']);
	}
	public function getAllListCategory($par_id=0,$limit = 6,$icon=true){
		$objdata = new CLS_MYSQL;
		$objpro = new CLS_PRODUCTS;
		$sql="SELECT * FROM `tbl_catalog`  WHERE `isactive`=1 AND `par_id`='$par_id' ORDER BY `order` ASC LIMIT 0,$limit"; 
		$objdata->Query($sql);
		$i=1;
		if($objdata->Num_rows()>0){
			echo '<div class="products">';
			while($row=$objdata->Fetch_Assoc()){
				$img = ROOTHOST."images/no-image.jpg";
				$link = ROOTHOST.un_unicode($row['alias']);
				$intro = Substring(trim(stripslashes($row['intro'])),0,25); 
				if($row['thumb']!='') $img = $row['thumb'];

				echo '<article class="catalog col-md-4 col-sm-4 col-xs-6 text-center"> 
						<div class="content-inner">
							<a href="'.$link.'" class="product-thumb" title="'.$row['name'].' Huy Hoàng"><img src="'.$img.'" class="img-responsive" alt="'.$row['name'].'"/></a>
							<h2 class="title"><a href="'.$link.'">'.$row['name'].'</a></h2>';
				if($intro!=' ' && $icon==true)		
					echo '	<div class="description">'.$intro.'</div>';
				if($icon==true) 
				echo '		<div class="social">
								<a class="facebook-share-button" target="_blank" href="http://www.facebook.com/sharer.php?u='.$link.'" onclick="'."javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'".');return false;"></a>
								<a class="twitter-share" target="_blank" href="https://twitter.com/share?url='.$link.'" onclick="'."javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'".');return false;"></a>
								<a class="google-share-button" target="_blank" href="https://plus.google.com/share?url='.$link.'" onclick="'."javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'".');return false;"></a>
							</div>';
				echo '  </div>
					</article>';
			}
			echo '</div>';
			if($par_id==0)
				echo '<div class="read-more"><a href="'.ROOTHOST.'san-pham/'.'"><span class="caret"></span> Xem tất cả sản phẩm</a></div>';
		}
	}
	public function getList_4Colunm($par_id=0,$limit = 6,$icon=true){
		$objdata = new CLS_MYSQL;
		$objpro = new CLS_PRODUCTS;
		$sql="SELECT * FROM `tbl_catalog`  WHERE `isactive`=1 AND `par_id`='$par_id' ORDER BY `order` ASC LIMIT 0,$limit"; 
		$objdata->Query($sql);
		$i=1;
		if($objdata->Num_rows()>0){
			echo '<div class="products">';
			while($row=$objdata->Fetch_Assoc()){
				$img = ROOTHOST."images/no-image.jpg";
				$link = ROOTHOST.un_unicode($row['alias']);
				$intro = Substring(stripslashes($row['intro']),0,25); 
				if($row['thumb']!='') $img = $row['thumb'];

				echo '<article class="product catalog_col4 col-md-3 col-sm-3 col-xs-6 text-center"> 
						<div class="content-inner">
							<a href="'.$link.'" class="product-thumb"><img src="'.$img.'" class="img-responsive" alt="'.$row['name'].'"/></a>
							<h3 class="title"><a href="'.$link.'">'.$row['name'].'</a></h3>';
				if($icon==true) 
				echo '		<div class="social">
								<a class="fb-share-button" target="_blank" href="http://www.facebook.com/sharer.php?u='.$link.'" onclick="'."javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'".');return false;"></a>
								<a class="twitter-share" target="_blank" href="https://twitter.com/share?url='.$link.'" onclick="'."javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'".');return false;"></a>
								<a class="google-share-button" target="_blank" href="https://plus.google.com/share?url='.$link.'" onclick="'."javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'".');return false;"></a>
							</div>';
				echo '  </div>
					</article>';
			}
			echo '</div>';
		}
	}
	public function getAllOptionCategory($par_id=0){
		$objdata=new CLS_MYSQL;
		$objpro=new CLS_PRODUCTS;
		$sql="SELECT `cat_id`,`name` FROM `tbl_catalog`  WHERE `isactive`=1 AND `par_id`='$par_id' "; 
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			while($row=$objdata->Fetch_Assoc()){
				echo "<option value='".$row['name'].'-'.$row['cat_id']."'>".$row['name']."</option>";
				$this->getAllOptionCategory($row['cat_id']);
			}
		}
	}
	public function getListCategory($par_id=0){
		$objdata=new CLS_MYSQL;
		$objpro=new CLS_PRODUCTS;
		$sql="SELECT * FROM `tbl_catalog`  WHERE `isactive`=1 AND `par_id`='$par_id' ORDER BY `order` ASC"; 
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			echo '<ul>';
			while($row=$objdata->Fetch_Assoc()){
				$class='';
				$img = "<img src='".ROOTHOST."images/no-image.jpg' width='100'/>";;
				if($row['thumb']!='') $img = "<img src='".$row['thumb']." ' width='100'/>";
				echo "<li $class id='item".$row['cat_id']."'>
					<a href='".ROOTHOST.un_unicode($row['alias'])."/'>"
					.$img."<span>".$row['name']."</span></a>";
				$this->getListCategory($row['cat_id']);
				echo "</li>";
			}
			echo '</ul>';
		}
	}
	public function getListCatalogName($par_id=0){
		$objdata=new CLS_MYSQL;
		$objpro=new CLS_PRODUCTS;
		$sql="SELECT * FROM `tbl_catalog`  WHERE `isactive`=1 AND `par_id`='$par_id' ORDER BY `order` ASC"; 
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			echo '<ul>';
			while($row=$objdata->Fetch_Assoc()){
				$class='';
				echo "<li $class id='item".$row['cat_id']."'>
					<a href='".ROOTHOST.un_unicode($row['alias'])."/'>
					<span>".$row['name']."</span></a>";
				$this->getListCatalogName($row['cat_id']);
				echo "</li>";
			}
			echo '</ul>';
		}
	}
	public function getListByParId($par_id){
		$objdata=new CLS_MYSQL;
		$objpro=new CLS_PRODUCTS;
		$sql="SELECT `cat_id`,`name`,`alias` FROM `tbl_catalog`  WHERE isactive=1 AND par_id='$par_id' "; 
		$objdata->Query($sql);
		if($objdata->Num_rows()>0){
			echo '<ul>';
			while($row=$objdata->Fetch_Assoc()){
				echo "<li><a href='".ROOTHOST.$row['alias']."' title='".$row['name']."'><span>".$row['name'];
				echo " (".$objpro->NumProByCatid($row['cat_id']).")</span></a>";
				echo "</li>";
			}
			echo '</ul>';
		}
	}
	function getCatIDChild($where='',$parid){
		$sql="SELECT * FROM `tbl_catalog` WHERE isactive=1 AND par_id='$parid' ".$where;
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0) {
			while ($rows=$objdata->Fetch_Assoc()) {
				$str.=$rows['cat_id']."','";
				$str.=$this->getCatIDChild($where,$rows['cat_id']);
			}
		}
		return $str;
	}
	function getIDByAlias($alias){
		$sql="SELECT `cat_id` FROM `tbl_catalog` WHERE `alias`='$alias' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['cat_id'];
	}
	public function getNameByAlias($alias){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_catalog`  WHERE `alias` = '$alias'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function getNameById($cat_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_catalog`  WHERE isactive=1 AND `cat_id` = '$cat_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
}
?>