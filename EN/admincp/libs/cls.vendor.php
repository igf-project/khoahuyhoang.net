<?php
class CLS_VENDOR{
	private $pro=array( 'Vendor_ID'=>1,
						'Name'=>'',
						'Intro'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_VENDOR(){
		$this->objmysql=new CLS_MYSQL;
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo ('Can not found $proname member');
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
		$sql="SELECT * FROM `tbl_vendor` ".$where;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getListNCC(){
		$sql="SELECT `vendor_id`,`name` FROM `tbl_vendor` WHERE `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc()){
			$id=$rows['vendor_id'];
			$name=$rows['name'];
			echo "<option value='$id'> $name</option>";
		}
	}
	function listTableNCC($strwhere=""){
		$sql="SELECT * FROM tbl_vendor WHERE 1=1 ".$strwhere ;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		$rowcount=0;
		while($rows=$objdata->Fetch_Assoc()){	
			$rowcount++;
			$id=$rows['vendor_id'];
			$name=Substring($rows['name'],0,10);
			$intro=$rows['intro'];
			echo "<tr name='trow'>";
			echo "<td width='50' align='center'>$rowcount</td>";
			echo "<td width='60' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td width='70' align='center'>$id</td>";
			echo "<td nowrap='nowrap' title='$intro'>$name</td>";
			echo "<td width='80' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=active&amp;id=$id'>";
				showIconFun('publish',$rows["isactive"]);
				echo "</a>";
			echo "</td>";
			echo "<td width='80' align='center'>";
				echo "<a href='index.php?com=".COMS."&amp;task=edit&amp;id=$id'>";
				showIconFun('edit','');
				echo "</a>";
			echo "</td>";
			echo "<td width='80' align='center'>";
				echo "<a href='javascript:detele_field(\"index.php?com=".COMS."&amp;task=delete&amp;id=$id\")'>";
				showIconFun('delete','');
				echo "</a>";
			echo "</td>";
		  	echo "</tr>";
		}
	}
	public function getNameById($id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_vendor`  WHERE isactive=1 AND `vendor_id` = '$id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	function Add_new(){
		$sql=" INSERT INTO `tbl_vendor`(`name`,`intro`,`isactive`) VALUES";
		$sql.="('".$this->Name."',N'".$this->Intro."','".$this->isActive."')";
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE `tbl_vendor` SET `name`='".$this->Name."',`intro`=N'".$this->Intro."',`isactive`='".$this->pro["isActive"]."' WHERE `vendor_id`='".$this->Vendor_ID."'";
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_vendor` SET `isactive`='$status' WHERE `vendor_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_vendor` SET `isactive`=if(`isactive`=1,0,1) WHERE `vendor_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_vendor` WHERE `vendor_id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>