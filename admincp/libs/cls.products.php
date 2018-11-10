<?php
ini_set('display_errors', 1);
class CLS_PRODUCTS{
	private $pro=array(
			'ID'=>'-1',
			'Pro_Code'=>'',
            'Partner_ID'=>'0',
			'Vendor_ID'=>'0',
			'Cata_ID'=>'0',	
			'Name'=>'',			
			'Color'=>'',
			'Size'=>'',
			'Intro'=>'',
			'Fulltext'=>'',
			'Thumb'=>'',
            'Start_price'=>'0',
			'Old_price'=>'0',
			'Cur_price'=>'0',
			'Quantity'=>'0',
			'Cdate'=>'',
			'Mdate'=>'',
			'MTitle'=>'',
			'MKey'=>'',
			'MDesc'=>'',
			'MCanon'=>'',
			'Visit'=>'',
            'Author'=>'',
			'Order'=>'',
			'isHot'=>'0',
			'isActive'=>'1');
	private $objmysql;
	public function CLS_PRODUCTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_PRODUCTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($strwhere="",$lagid=0){
		$sql=" SELECT * FROM tbl_product WHERE 1=1 $strwhere";
		// echo $sql;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getCatName($catid) {
		$sql="SELECT name FROM tbl_catalog WHERE cat_id=$catid";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['name'];
		}
	}
	public function listTablePro($strwhere="",$page){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT tbl_product.*,tbl_partners.company_name,tbl_partners.phone FROM tbl_product,tbl_partners 
				Where tbl_partners.partner_id=tbl_product.partner_id $strwhere 
				ORDER BY `order` ASC, `pro_code` ASC LIMIT $star,$leng";
		// echo $sql;
		// $sql="SELECT * FROM tbl_product INNER JOIN tbl_partners on tbl_partners.partner_id=tbl_product.partner_id  $strwhere ORDER BY `order` ASC, `pro_code` ASC LIMIT 0,50";
		// echo $sql;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);	$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$ids=$rows['pro_code'];
			$title=Substring(stripslashes($rows['name']),0,10);
			$nsx=Substring(stripslashes($rows['partner_id']),0,10);
			$cty_name=$rows['company_name'].'('.$rows['phone'].')';
			$color=Substring(stripslashes($rows['color']),0,10);
			$size=Substring(stripslashes($rows['size']),0,10);
			include_once("../includes/simple_html_dom.php");
			$intro = Substring(stripslashes($rows['intro']),0,10);
			$intro = str_get_html($intro);
			$cur_price = number_format($rows['cur_price']);
			$category = $this->getCatName($rows['cat_id']);
			$visited=$rows['visited'];
			$order=$rows['order'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td title='$intro' width=\"80\" ><b>$ids</b></td>";
			echo "<td title='$intro'>$title</td>";
			echo "<td>$category</td>";
			echo "<td>$cty_name</td>";
			echo "<td nowrap='nowrap' align=\"center\"><span style='color:red;'>$cur_price</span><b> đ</b></td>";
			echo "<td nowrap='nowrap' align='center'>$visited</td>";
			echo "<td align=\"center\"><input type='text' value='".$order."' name='txt_order'/></td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=hot&amp;id=$ids\">";
			showIconFun('publish',$rows['ishot']);
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=active&amp;id=$ids\">";
			showIconFun('publish',$rows['isactive']);
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=edit&amp;id=$ids\">";
			showIconFun('edit','');
			echo "</a>";
		
			echo "</td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"javascript:detele_field('index.php?com=".COMS."&amp;task=delete&amp;id=$ids')\" >";
			showIconFun('delete','');
			echo "</a>";
		
			echo "</td>";
			echo "</tr>";
		}
	}
	public function Add_new(){
		$sql="INSERT INTO `tbl_product` (`pro_code`,`cat_id`,`partner_id`,`vendor_id`,`size`,`color`,`name`,`intro`,`fulltext`,`thumb`,`cur_price`,`quantity`,`author`,`cdate`,`mdate`,`meta_title`,`meta_key`,`meta_desc`,`meta_canon`,`ishot`,`isactive`) VALUES ";
		$sql.="('".$this->Pro_Code."','".$this->Cata_ID."','".$this->Partner_ID."','".$this->Vendor_ID."','".$this->Size."','".$this->Color."','".$this->Name."','".$this->Intro."','".$this->Fulltext."','".$this->Thumb."','";
		$sql.=$this->Cur_price."','".$this->Quantity."','".$this->Author."','";
		$sql.=$this->Cdate."','".$this->Mdate."','";
		$sql.=$this->MTitle."','".$this->MKey."','".$this->MDesc."','".$this->MCanon."','".$this->isHot."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	public function Update(){
		$sql="UPDATE `tbl_product` SET  
				`pro_code`='".$this->Pro_Code."',
				`partner_id`='".$this->Partner_ID."', 
				`Vendor_id`='".$this->Vendor_ID."', 
				`cat_id`='".$this->Cata_ID."',									
				`color`='".$this->Color."',
				`size`='".$this->Size."',									 
				`name`='".$this->Name."',
				`intro`='".$this->Intro."',
				`fulltext`='".$this->Fulltext."',
				`thumb`='".$this->Thumb."',										
				`cur_price`='".$this->Cur_price."',								
				`quantity`='".$this->Quantity."',
				`cdate`='".$this->Cdate."',
				`mdate`='".$this->Mdate."',
				`author`='".$this->Author."',
				`meta_title`='".($this->MTitle)."',
				`meta_key`='".($this->MKey)."',
				`meta_desc`='".($this->MDesc)."',
				`meta_canon`='".($this->MCanon)."',
				`ishot`='".$this->isHot."',
				`isactive`='".$this->isActive."' 
		WHERE `pro_code`='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	public function Delete($ids){
		$sql="DELETE FROM `tbl_product` WHERE `pro_code` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setHot($ids){
		$sql="UPDATE `tbl_product` SET `ishot`=if(`ishot`=1,0,1) WHERE `pro_code` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	public function setActive($ids,$status=''){
		$sql="UPDATE `tbl_product` SET `isactive`='$status' WHERE `pro_code` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_product` SET `isactive`=if(`isactive`=1,0,1) WHERE `pro_code` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Order($arr_id,$arr_quan){
		$n=count($arr_id); 
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_product` SET `order`='".$arr_quan[$i]."' WHERE `pro_code` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}
	public function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
}
?>