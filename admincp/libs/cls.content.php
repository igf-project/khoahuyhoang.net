<?php
class CLS_CONTENTS{
	private $pro=array(
			'ID'=>'-1',
			'Code'=>'0',
			'CatID'=>'0',
			'Title'=>'',
			'Intro'=>'',
			'Fulltext'=>'',
			'ThumbIMG'=>'',
			'CDate'=>'',
			'MDate'=>'',
			'Author'=>'',
			'GmID'=>'',
			'Meta_title'=>'',
			'Meta_key'=>'',
			'Meta_desc'=>'',
			'Meta_canon'=>'',
			'Visited'=>'',
			'Order'=>'',
			'LangID'=>'0',
			'IsActive'=>'1');
	private $objmysql;
	public function CLS_CONTENTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_CONTENTS Class' );
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ($proname.' is not member of CLS_CONTENTS Class' );
			return '';
		}
		return $this->pro[$proname];
	}
	public function getList($strwhere="",$lagid=0){
		$sql=" SELECT * FROM view_content WHERE lag_id='$lagid' $strwhere";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function getCatName($catid) {
		$sql="SELECT name from view_cate where cat_id='$catid'";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		if($objdata->Num_rows()>0) {
			$r=$objdata->Fetch_Assoc();
			return $r['name'];
		}
	}
	public function LoadGmem($cur_id=0,$par_id=0,$space){
		if($par_id!='0')	$space.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$char='';
		if($space!='') $char=$space.'|---';
		
		$sql="SELECT * FROM `tbl_gmember` WHERE par_id=$par_id";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{
			$modid=$rows['gmem_id'];
			$name=$rows['name'];
			if($cur_id==$modid)
				echo "<option value=\"$modid\" selected=\"selected\">$char$name</option>";
			else
				echo "<option value=\"$modid\">$char$name</option>";
			$this->LoadGmem($cur_id,$modid,$space);
		}
	}
	public function LoadConten($lagid=0){
		$sql="SELECT * FROM `view_content` WHERE lag_id='$lagid' AND isactive='1'";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc()){
			$ids=$rows['con_id'];
			$title=$rows['title'];
			echo "<option value=\"$ids\">$title</option>";
		}
	}
	public function listTableCon($strwhere="",$page,$lagid=0){
		$star=($page-1)*MAX_ROWS;
		$leng=MAX_ROWS;
		$sql="	SELECT * FROM view_content WHERE lag_id='$lagid' $strwhere ORDER BY `order` ASC, con_id DESC LIMIT $star,$leng";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$i=0;
		while($rows=$objdata->Fetch_Assoc())
		{	$i++;
			$ids=$rows['con_id'];
			$title=Substring(stripslashes($rows['title']),0,10);
			include_once("../includes/simple_html_dom.php");
			$intro = Substring(stripslashes($rows['intro']),0,10);
			$intro = str_get_html($intro);
			$author=$rows['author'];
			$category = $this->getCatName($rows['cat_id']);
			$date = date("d/m/Y",strtotime($rows['creatdate']));
			
			$visited=$rows['visited'];
			$order=$rows['order'];
			echo "<tr name=\"trow\">";
			echo "<td width=\"30\" align=\"center\">$i</td>";
			echo "<td width=\"30\" align=\"center\"><label>";
			echo "<input type=\"checkbox\" name=\"chk\" id=\"chk\" 	 onclick=\"docheckonce('chk');\" value=\"$ids\" />";
			echo "</label></td>";
			echo "<td title='$intro'>$title</td>";
			echo "<td>$category</td>";
			echo "<td width=\"100\">$author &nbsp;</td>";
			echo "<td width=\"100\" align=\"center\">$date &nbsp;</td>";
			
			echo "<td width=\"50\" align=\"center\">$visited</td>";
			echo "<td align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
			echo "<td align=\"center\">";
		
			echo "<a href=\"index.php?com=".COMS."&amp;task=preview&amp;id=$ids&active=".$rows['isactive']."\" class='preview'>&nbsp;</a>";
		
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
	public  function Add_new(){
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
		$sql="INSERT INTO tbl_content (`code`,`cat_id`,`thumb_img`,`creatdate`,`modifydate`,`gmem_id`,`isactive`) VALUES ";
		$sql.="('".$this->Code."','".$this->CatID."','".$this->ThumbIMG."','";
		$sql.=$this->CDate."','".$this->MDate."','".$this->GmID."','".$this->IsActive."')";
	
		$result=$objdata->Query($sql);
	
		$ids=$objdata->LastInsertID();
		$sql="INSERT INTO tbl_content_text (`con_id`,`intro`,`title`,`fulltext`,`author`,`meta_title`,`meta_key`,`meta_desc`,`meta_canon`,`lag_id`) VALUES";
		$sql.="('$ids','".$this->Intro."','".$this->Title."','";
		$sql.=$this->Fulltext."','".$this->Author."','".$this->Meta_title."','".$this->Meta_key."','".$this->Meta_desc."','".$this->Meta_canon."','".$this->LangID."')";
		$result1=$objdata->Query($sql);

		if($result && $result1 ){
			$objdata->Query('COMMIT');
			return $result;
		}
		else
			$objdata->Query('ROLLBACK');
	}
	function Update(){
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
		$sql="UPDATE tbl_content SET `code`='".$this->Code."',
									 `cat_id`='".$this->CatID."', 
									 `thumb_img`='".$this->ThumbIMG."',
									 `creatdate`='".$this->CDate."',
									 `modifydate`='".$this->MDate."',
									 `gmem_id`='".$this->GmID."',
									 `isactive`='".$this->IsActive."' 
								WHERE `con_id`='".$this->ID."'";
		$result = $objdata->Query($sql);
		
		$sql="UPDATE tbl_content_text SET `title`='".$this->Title."',
										  `intro`='".$this->Intro."',
										  `fulltext`='".$this->Fulltext."',
										  `meta_title`='".$this->Meta_title."',
									      `meta_key`='".$this->Meta_key."',
									      `meta_desc`='".$this->Meta_desc."',
										  `meta_canon`='".$this->Meta_canon."',										  
										  `author`='".$this->Author."'
								WHERE `con_id`='".$this->ID."' AND 
									  `lag_id`='".$this->LangID."'";
		$result1 = $objdata->Query($sql);
		
		if($result && $result1 ){
			$objdata->Query('COMMIT');
			return $result;
		}
		else
			$objdata->Query('ROLLBACK');
	}
	function Delete($ids){
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
		$sql="DELETE FROM `tbl_content` WHERE `con_id` in ('$ids')";
		$result=$objdata->Query($sql);
		$sql="DELETE FROM `tbl_content_text` WHERE `con_id` in ('$ids')";
		$result1=$objdata->Query($sql);
		//echo $sql;die();
		if($result && $result1 ){
			$objdata->Query('COMMIT');
			return $result;
		}else
			$objdata->Query('ROLLBACK');
	}
	function setActive($ids,$status=''){
		$reviewer = $_SESSION[md5($_SERVER['HTTP_HOST']).'_USERLOGIN'];
		$objdata=new CLS_MYSQL;
		$objdata->Query("BEGIN");
		$sql = "UPDATE `tbl_content` SET `isactive`='$status' WHERE `con_id` in ('$ids')"; 
		if($status=='')
			$sql="UPDATE `tbl_content` SET `isactive`=if(`isactive`=1,0,1) WHERE `con_id` in ('$ids')";
		$result=$objdata->Query($sql);
		
		$sql = "UPDATE `tbl_content_text` SET `reviewer`=N'$reviewer' WHERE `con_id` in ('$ids')";
		$result1=$objdata->Query($sql);
		//echo $sql;die();
		if($result && $result1 ){
			$objdata->Query('COMMIT');
			return $result;
		}else
			$objdata->Query('ROLLBACK');

	}
	function setHot($ids,$status=''){
		$sql="UPDATE `tbl_content` SET `isHot`='$status' WHERE `con_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_content` SET `isHot`=if(`isHot`=1,0,1) WHERE `con_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Order($ids,$order){
		$objdata=new CLS_MYSQL;
		$sql="UPDATE tbl_content SET `order`='".$order."' WHERE `con_id`='".$ids."'";	
		$objdata->Query($sql);	
	}
	function Orders($arids,$arods){
		for($i=0;$i<count($arids);$i++){
			$this->Order($arids[$i],$arods[$i]);
		}
	}
}
?>