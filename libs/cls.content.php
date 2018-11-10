<?php
class CLS_CONTENTS{
	private $objmysql=null;
	public function CLS_CONTENTS(){
		$this->objmysql=new CLS_MYSQL;
	}
	function getList($where=' ',$order=' ORDER BY RAND() ',$limit=' ',$lag_id='0'){
		$sql="SELECT * FROM `view_content` WHERE lag_id=$lag_id AND isactive=1 ".$where.$order.$limit;
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Seek($num){
		return $this->objmysql->Seek($num);
	}
	public function setVisited($code){
		$sql="UPDATE tbl_content SET `visited`=`visited`+1 WHERE `code`='".$code."'";
		return $this->objmysql->Query($sql);
	}
	public function checkImages($urlimage){
		if($urlimage=='') return false;
	    $url = getimagesize($urlimage);
	    if(is_array($url)){
	        return true;
	    }
	    else {
	         return false;
	    }
	}
}
?>