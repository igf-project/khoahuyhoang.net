<?php
class CLS_PARTNER{
	private $pro=array( 'Partner_ID'=>1,
						'Company_Name'=>'',
						'Address'=>'',
						'Phone'=>'',
						'Fax'=>'',
						'Logo'=>'',
						'Email'=>'',
						'Website'=>'',
						'Lat'=>'',
						'Lng'=>'',
						'Intro'=>'',
						'Author'=>'',
						'isActive'=>1);
	private $objmysql=NULL;
	public function CLS_PARTNER(){
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
		$sql="SELECT * FROM `tbl_partners` where 1=1 ".$where.' ORDER BY `company_name` '.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getListPartner()
	{
		$sql="SELECT `partner_id`,`company_name` FROM `tbl_partners` WHERE `isactive`='1' ";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0) return;
		while($rows=$objdata->Fetch_Assoc())
		{
			$id=$rows['partner_id'];
			$name=$rows['company_name'];
			echo "<option value='$id'> $name</option>";
		}
	}
	/*change -------------------------------------------------------------------------*/
	function getListCateSubCurrentCate($parid=0,$level=0,$id=0){
		$sql="SELECT * FROM tbl_partners WHERE `par_id`='$parid' AND `isactive`='1' AND sale_id !='$id' ";

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
	function listTablePartner($strwhere="",$page=1,$rowcount){
		global $rowcount;
		$sql="SELECT * FROM tbl_partners WHERE 1=1 ".$strwhere ;
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		while($rows=$objdata->Fetch_Assoc())
		{	$rowcount++;
			$id=$rows['partner_id'];
			$name=Substring($rows['company_name'],0,10);
			$address=Substring($rows['address'],0,10);
			$phone=Substring($rows['phone'],0,10);
			$logo=trim($rows['logo']);
			$website=$rows['website'];
			$email=Substring($rows['email'],0,10);
			$intro=$rows['intro'];
			echo "<tr name='trow'>";
			echo "<td width='30' align='center'>$rowcount</td>";
			echo "<td width='30' align='center'><label>";
			echo "<input type='checkbox' name='chk' id='chk' onclick='docheckonce(\"chk\");' value='$id' />";
			echo "</label></td>";
			echo "<td width='30' align='center'>$id</td>";
			echo "<td width='70' align='center'><img src='$logo' width='65' height='50'/></td>";
			echo "<td nowrap='nowrap' title='$name' align='left'>$name</td>";
			echo "<td nowrap='nowrap' align='left'><strong style=\"color:#6699cc;\">$phone</strong></td>";
			echo "<td nowrap='nowrap' align='center' width='200'>$address</td>";
			echo "<td nowrap='nowrap' align='center' width='150'>$email</td>";
			echo "<td nowrap='nowrap' align='center'width='150'>$website</td>";
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
		$sql="SELECT `name` FROM `tbl_partners`  WHERE isactive=1 AND `partner_id` = '$sale_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	function getChildID($parid) {
		$sql = "SELECT sale_id FROM tbl_partners WHERE par_id IN ('$parid')"; 
		$objdata = new CLS_MYSQL; 
		$this->result = $objdata->Query($sql);
		
		$ids='';
		if($objdata->Num_rows()>0) {
			while($r = $objdata->Fetch_Assoc()) {
				$ids.=$r['sale_id']."','";
				$ids.=$this->getChildID($r['partner_id']);
			}
		}
		return $ids;
	}
	
	function Add_new(){
		$sql=" INSERT INTO `tbl_partners`(`company_name`,`address`,`phone`,`fax`,`email`,`website`,`logo`,`intro`,`isactive`,`author`) VALUES";
		$sql.="('".$this->Company_Name."','".$this->Address."','".$this->Phone."','".$this->Fax."','".$this->Email."','".$this->Website."','".$this->Logo."','".$this->Intro."','".$this->isActive."','".$this->Author."')";
		//echo $sql; die();
		return $this->objmysql->Exec($sql);
	}
	function Update(){
		$sql = "UPDATE tbl_partners SET `company_name`='".$this->Company_Name."',`address`='".$this->Address."',`phone`='".$this->Phone."',`fax`='".$this->Fax."',`logo`='".$this->Logo."',`website`='".$this->Website."',`author`='".$this->Author."',
		`email`='".$this->Email."',`intro`=N'".$this->Intro."',`isactive`='".$this->pro["isActive"]."' WHERE `partner_id`='".$this->Partner_ID."'";
		//echo $sql; die();
		return $this->objmysql->Exec($sql);
	}
	function setActive($ids,$status=''){
		$sql="UPDATE `tbl_partners` SET `isactive`='$status' WHERE `partner_id` in ('$ids')";
		if($status=='')
			$sql="UPDATE `tbl_partners` SET `isactive`=if(`isactive`=1,0,1) WHERE `partner_id` in ('$ids')";
		return $this->objmysql->Exec($sql);
	}
	function Delete($id){
		$sql="DELETE FROM `tbl_partners` WHERE `partner_id` in ('$id')";
		return $this->objmysql->Exec($sql);
	}
}
?>