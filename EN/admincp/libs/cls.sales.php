<?php
class CLS_SALES{
	private $pro=array( 'Sale_ID'=>1,
						'Cty_Name'=>'',
						'Address'=>'',
						'Phone'=>'',
						'Fax'=>'',
						'Name_Contact'=>'',
						'Tel'=>'',
						'Email'=>'',
						'Intro'=>'',
						'Author'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_SALES(){
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
		$sql="SELECT * FROM `tbl_saler` where 1=1 ".$where.' ORDER BY `cty_name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getListSale()
	{
		$sql="SELECT `sale_id`,`cty_name` FROM `tbl_saler` WHERE `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows['sale_id'];
			$name=$rows['cty_name'];
			echo "<option value='$id'> $name</option>";
		}
	}
	function ListCategory($minus_id=0,$cur_parid=0,$parid=0,$level=0)
	{
		$childID='';
		if($minus_id!=0)
			$childID = $this->getChildID($minus_id);
		$sql="SELECT sale_id,par_id,name, isactive FROM tbl_saler WHERE `par_id`='$parid' AND sale_id NOT IN ('".$childID."')"; 
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
			$id=$rows['sale_id'];
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
		$sql="SELECT * FROM tbl_saler WHERE `par_id`='$parid' AND `isactive`='1' AND sale_id !='$id' ";

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
			$id=$rows["sale_id"];
			$name=$rows["name"];
			echo "<option value='$id'>$char $name</option>";
			$nextlevel=$level+1;
			$this->getListCateSubCurrentCate($id,$nextlevel,$id);
		}
	}
	function listTableCate($strwhere="",$page=1,$rowcount){
		global $rowcount;
		$sql="SELECT * FROM tbl_saler WHERE 1=1 ".$strwhere ;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	$rowcount++;
			$id=$rows['sale_id'];
			$name=Substring($rows['cty_name'],0,10);
			$address=Substring($rows['address'],0,10);
			$tel=Substring($rows['tel'],0,10);
			$phone=Substring($rows['phone'],0,10);
			$name_contact=Substring($rows['name_contact'],0,10);
			$email=Substring($rows['email'],0,10);
			$intro=$rows['intro'];
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$rowcount</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td width='50' align='center'>$id</td>";
			echo "<td nowrap='nowrap' title='$intro' align='left'>$name</td>";
			echo "<td nowrap='nowrap' align='left'><strong style=\"color:#6699cc;\">$phone</strong></td>";
			echo "<td nowrap='nowrap' align='center'>$address</td>";
			echo "<td nowrap='nowrap' title='Phone: $tel - Email: $email' align='left'>$name_contact</td>";
			echo "<td nowrap='nowrap' align='center'>$email</td>";
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
		}
	}
	public function getNameById($sale_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `tbl_saler`  WHERE isactive=1 AND `sale_id` = '$sale_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	function getChildID($parid) {
		$sql = "SELECT sale_id FROM tbl_saler WHERE par_id IN ('$parid')"; 
		$objdata = new CLS_MYSQL; 
		$this->result = $objdata->Query($sql);
		
		$ids='';
		if($objdata->Num_rows()>0) {
			while($r = $objdata->Fetch_Assoc()) {
				$ids.=$r['sale_id']."','";
				$ids.=$this->getChildID($r['sale_id']);
			}
		}
		return $ids;
	}
	
	function Add_new(){
		$sql=" INSERT INTO `tbl_saler`(`cty_name`,`address`,`phone`,`fax`,`name_contact`,`tel`,`email`,`intro`,`isactive`,`author`) VALUES";
		$sql.="('".$this->Cty_Name."','".$this->Address."','".$this->Phone."','".$this->Fax."','".$this->Name_Contact."','".$this->Tel."','".$this->Email."','".$this->Intro."','".$this->isActive."','".$this->Author."')";
		//echo $sql; die();
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_saler SET `cty_name`='".$this->Cty_Name."',`address`='".$this->Address."',`phone`='".$this->Phone."',`fax`='".$this->Fax."',`name_contact`='".$this->Name_Contact."',`tel`='".$this->Tel."',`author`='".$this->Author."',
		`email`='".$this->Email."',`tel`='".$this->Tel."',`intro`='".$this->Intro."',`isactive`='".$this->pro["isActive"]."' WHERE `sale_id`='".$this->Sale_ID."'";
		//echo $sql; die();
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_saler` SET `isactive`='$status' WHERE `sale_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_saler` SET `isactive`=if(`isactive`=1,0,1) WHERE `sale_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_saler` WHERE `sale_id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>