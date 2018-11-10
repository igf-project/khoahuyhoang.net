<?php
class CLS_CATALOGS{
	private $pro=array( 'ID'=>'-1',
						'ParID'=>'0',
						'Alias'=>'',
						'Name'=>'',
						'Thumb'=>'',
						'H1'=>'',
						'Intro'=>'',
						'Order'=>'',
						'Meta_Title'=>'',
						'Meta_Desc'=>'',
						'Meta_Key'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_CATALOGS(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo ("Can not found $proname member");
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where='',$limit=''){
		$sql="SELECT * FROM `tbl_catalog` where 1=1 ".$where.' ORDER BY `name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getListCate($parid=0,$level=0)
	{
		$sql="SELECT cat_id,par_id,name FROM tbl_catalog WHERE `par_id`='$parid' AND `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level!=0)
		{
			$char.="&nbsp;&nbsp;&nbsp;";
				$char.="|---";
		}
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows['cat_id'];
			$parid=$rows['par_id'];
			$name=$rows['name'];
			echo "<option value='$id'>$char $name</option>";
			$nextlevel=$level+1;
			$this->getListCate($id,$nextlevel);
		}
	}
	function ListCategory($minus_id=0,$cur_parid=0,$parid=0,$level=0)
	{
		$childID='';
		if($minus_id!=0)
			$childID = $this->getChildID($minus_id);
		$sql="SELECT cat_id,par_id,name, isactive FROM tbl_catalog WHERE `par_id`='$parid' AND cat_id NOT IN ('".$childID."')"; 
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level>1){
			for($i=0;$i<$level;$i++)
				$char.="&nbsp;&nbsp;&nbsp;"; 
			$char.="|---";
		}
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['cat_id'];
			$parid=$rows['par_id'];
			$name=$rows['name'];
			$str='';
			if($id==$cur_parid) $str=" selected='selected' ";
			if($rows['isactive']==0)
				echo '<option value="'.$id.'" style="color:red"'.$str.'>'.$char." ".$name.'</option>';
			else
				echo '<option value="'.$id.'"'.$str.'>'.$char." ".$name.'</option>';
			
			$nextlevel=$level+1;
			$this->ListCategory($minus_id,$cur_parid,$id,$nextlevel);
		}
	}
	/*change -------------------------------------------------------------------------*/
	function getListCateSubCurrentCate($parid=0,$level=0,$id=0){
		$sql="SELECT * FROM tbl_catalog WHERE `par_id`='$parid' AND `isactive`='1' AND cat_id !='$id' ";

		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$char="";
		if($level>0)
		{
			for($i=0;$i<$level;$i++)
				$char.="&nbsp;&nbsp;&nbsp;";
				$char.="|---";
		}
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows["cat_id"];
			$name=$rows["name"];
			echo "<option value='$id'>$char $name</option>";
			$nextlevel=$level+1;
			$this->getListCateSubCurrentCate($id,$nextlevel,$id);
		}
	}
	function listTableCate($strwhere="",$page=1,$parid=0,$level=0,$rowcount){
		global $rowcount;
		$sql="SELECT * FROM tbl_catalog WHERE `par_id`='$parid' ".$strwhere." ORDER BY `order` ASC, cat_id ASC";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$str_space="";
		if($level!=0){	
			for($i=0;$i<$level;$i++)
				$str_space.="&nbsp;&nbsp;&nbsp;"; 
			$str_space.="|---";
		}
		$i=0;
		$save = $parid;
		while($rows=$objdata->Fetch_Assoc())
		{	$rowcount++;
			$id=$rows['cat_id'];
			$parid=$rows['par_id'];
			$name=Substring($rows['name'],0,10);
			//$img=$rows['thumb'];
			//if($img!='') $img ="<img src='".$img."' width='100' height='80'/>";
			$order = $rows['order'];
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$rowcount</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td width='50' align='center'>$parid</td>";
			echo "<td nowrap='nowrap'>$str_space$name</td>";
			//echo "<td nowrap='nowrap'>$img &nbsp;</td>";
			echo "<td width=\"50\" align=\"center\"><input type=\"text\" name=\"txt_order\" id=\"txt_order\" value=\"$order\" size=\"4\" class=\"order\"></td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='50' align='center'>";
				echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
			$nextlevel=$level+1;
			$this->listTableCate($strwhere,$page,$id,$nextlevel,$rowcount);
		}
	}
		/*end change -------------------------------------------------------------------------*/
	/*
	function haveChild($parid) {
		$sql = "SELECT cat_id FROM tbl_catalog WHERE par_id IN ('$parid')"; 
		$objdata = new CLS_MYSQL; 
		$objdata->Query($sql);
		
		if($objdata->Num_rows()>0) {
			return $objdata->Num_rows();
		}
		return 0;
	}*/
	function getChildID($parid) {
		$sql = "SELECT cat_id FROM tbl_catalog WHERE par_id IN ('$parid')"; 
		$objdata = new CLS_MYSQL; 
		$objdata->Query($sql);
		
		$ids='';
		if($objdata->Num_rows()>0) {
			while($r = $objdata->Fetch_Assoc()) {
				$ids.=$r['cat_id']."','";
				$ids.=$this->getChildID($r['cat_id']);
			}
		}
		return $ids;
	}
	function Add_new(){
		$sql=" INSERT INTO `tbl_catalog`(`par_id`,`alias`,`name`,`thumb`,`h1`,`intro`,`meta_title`,`meta_desc`,`meta_key`,`isactive`) VALUES";
		$sql.="('".$this->ParID."','".$this->Alias."',N'".$this->Name."','".$this->Thumb."',N'".$this->H1."',N'".$this->Intro
				."',N'".$this->Meta_Title."',N'".$this->Meta_Desc."',N'".$this->Meta_Key."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_catalog SET par_id='".$this->ParID."',`alias`=N'".$this->Alias."',`name`=N'".$this->Name."',`thumb`=N'".$this->Thumb
				."',`h1`=N'".$this->H1."',`intro`=N'".$this->Intro."',`meta_title`=N'".$this->Meta_Title
				."',`meta_desc`=N'".$this->Meta_Desc."',`meta_key`=N'".$this->Meta_Key
				."',`isactive`='".$this->pro["isActive"]."' WHERE cat_id='".$this->ID."'";
		return $this->objmysql->Exec($sql);
	}
	function Order($arr_id,$arr_quan){
		$n=count($arr_id);
		for($i=0;$i<$n;$i++){
			$sql="UPDATE `tbl_catalog` SET `order`='".$arr_quan[$i]."' WHERE `cat_id` = '".$arr_id[$i]."' ";
			$this->objmysql->Exec($sql);
		}
	}	
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_catalog` SET `isactive`='$status' WHERE `cat_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_catalog` SET `isactive`=if(`isactive`=1,0,1) WHERE `cat_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_catalog` WHERE `cat_id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>