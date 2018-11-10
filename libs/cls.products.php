<?php
class CLS_PRODUCTS{
	private $objmysql=null;
	public function CLS_PRODUCTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where=' ',$order=' ORDER BY RAND() ',$limit=' '){
		$sql="SELECT * FROM `tbl_product` WHERE isactive=1 ".$where.$order.$limit; 
		return $this->objmysql->Query($sql);
	}
	public function ListProduct($where=' ',$order=' ORDER BY `order` ASC, `cdate` DESC ',$limit=' ',$col=4){
		$sql="SELECT * FROM `tbl_product` WHERE isactive=1 ".$where.$order.$limit;
		$objdata=new CLS_MYSQL();
		$objcat = new CLS_CATALOGS;
		$objdata->Query($sql);
		$clsimage=new SimpleImage;
		$i=1; $catname =''; $cat_id = 0;
		while($row=$objdata->Fetch_Assoc()){
			$img_src = '';
			if($row['thumb']!='') {
				$img_src = explode(",,|",$row['thumb']);
				$img_src = $img_src[0];
				// Lấy đường dẫn ảnh -> trỏ dến đường dẫn ảnh thumb
				// $arr_img = explode("/",$img_src);
				// $str = $arr_img[count($arr_img)-1];
				// $img_src = str_replace("$str","$str",$img_src);
			}
			$link = ROOTHOST.un_unicode(stripslashes($row['name'])).'/'.$row['pro_code'].'.html';
			$intro = Substring(stripslashes($row['intro']),0,25); 
			
			if($col==4)
				echo '<article class="product col-md-3 col-sm-4 col-xs-6 text-center">';
			else 
				echo '<article class="product_3col col-md-4 col-sm-4 col-xs-6 text-center">';
				
			echo '<div class="content-inner">
					<a href="'.$link.'" class="product-thumb"><img src="'.$img_src.'" class="img-responsive" alt="'.$row['name'].'"/></a>
					<h2 class="title"><a href="'.$link.'">'.$row['name'].'</a></h2>';
			echo '</div>
			</article>';
		}
	}
	public function ReleaseProduct($pro_code='',$cat_id=0,$order=' ORDER BY pro_code DESC ',$limit=' '){
		$sql="SELECT * FROM `tbl_product` WHERE isactive=1 AND pro_code <> '$pro_code'".$order.$limit;
		if($cat_id!=0) $sql="SELECT * FROM `tbl_product` WHERE isactive=1 AND `cat_id`='$cat_id' AND pro_code <> '$pro_code'".$order.$limit;
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0){
			while($row=$objdata->Fetch_Assoc()){
				$img_src = '';
				if($row['thumb']!='') {
					$img_src = explode(",,|",$row['thumb']);
					$img_src = $img_src[0];
				}
				$link = ROOTHOST.un_unicode(stripslashes($row['name'])).'/'.$row['pro_code'].'.html';
				$intro = Substring(stripslashes($row['intro']),0,25); 

				$str.='<article class="product_3col col-md-4 col-sm-4 col-xs-6 text-center"> 
					<div class="content-inner">
						<a href="'.$link.'" class="box_img product-thumb"><img src="'.$img_src.'" class="img-responsive" alt="'.$row['name'].'"/></a>
						<div class="title"><a href="'.$link.'">'.$row['name'].'</a></div>';
				$str.='</div>
				</article>';
			}
		}
		return $str;
	}
	public function getInfoByCode($code){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `cat_id`,`name` FROM `tbl_product`  WHERE `pro_code` = '$code'";
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row;
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function setVisited($id){
		$sql='UPDATE tbl_product SET `visited`=`visited`+1 WHERE `pro_code`="'.$id.'"';
		return $this->objmysql->Query($sql);
	}
}
?>