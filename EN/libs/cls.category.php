<?php
class CLS_CATE{
	private $objmysql=null;
	public function CLS_CATE(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($where='',$lag_id=0){
		$sql="SELECT * FROM `view_cate`  WHERE `lag_id`=$lag_id AND isactive=1 ".$where; 
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	function getCatIDChild($where='',$parid,$lag_id=0){
		$sql="SELECT * FROM `view_cate` WHERE `lag_id`='$lag_id' AND isactive=1 AND par_id='$parid' ".$where."LIMIT 0,1";
		//echo $sql;
		$objdata=new CLS_MYSQL();
		$this->result=$objdata->Query($sql);
		$str='';
		if($objdata->Num_rows()>0) {
			while ($rows=$objdata->Fetch_Assoc()) {
				$str.=$rows['cat_id']."','";
				$str.=$this->getCatIDChild('',$rows['cat_id']);
			}
		}
		return $str;
	}
	public function getNameById($cat_id){
		$objdata=new CLS_MYSQL;
		$sql="SELECT `name` FROM `view_cate`  WHERE isactive=1 AND `cat_id` = '$cat_id'"; 
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['name'];
	}
	public function getNameByCode($where){
		$objdata=new CLS_MYSQL;
		$sql="SELECT * FROM `view_cate`  WHERE isactive=1 AND $where";
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		$str = '';
		if($row['par_id']>0) 
			$str.=$this->getNameByCode(" `cat_id`=".$row['par_id']);
		$str.=$row['name'].";;"; 
		return $str;
	}
}
?>