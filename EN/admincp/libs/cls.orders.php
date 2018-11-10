<?php
class CLS_ORDER{
	private $pro=array(	'Id'=>'0',
						'Cdate'=>'',
						'Cname'=>'',
						'Cphone'=>'',
						'Cemail'=>'',
						'ShipType'=>'',
						'Add'=>'',
						'Payment'=>'',
						'TotalMoney'=>'0',
						'SalerCode'=>'0',
						'Status'=>'0',
                        'Note'=>'',
                        'Author'=>'',
						'Cart'=>null
					);
	private $objmysql=null;
	public function CLS_ORDER(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in set method of class';
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			echo $proname. ' can not found in get method of class';
			return;
		}
		return $this->pro[$proname];
	}
	public function getList($where=' ',$order=' ORDER BY cdate DESC ',$limit=' '){
		$sql="SELECT * FROM `tbl_order` ".$where.$order.$limit;
		return $this->objmysql->Query($sql);
	}
	public function getOrderDetail($order_id){
		$sql="SELECT * FROM `tbl_order_detail` WHERE `order_id`=$order_id";
		return $this->objmysql->Query($sql);
	}
	public function Num_rows(){
		return $this->objmysql->Num_rows();
	}
	public function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function Num_Buy($pro_id){
		$sql="SELECT SUM(`quantity`) as numbuy FROM `tbl_order_detail` WHERE `pro_id`=$pro_id";
		$objdata=new CLS_MYSQL;
		$objdata->Query($sql);
		$row=$objdata->Fetch_Assoc();
		return $row['numbuy']+0;
	}
	public function Num_Person_Buy($pro_id){
		$sql="SELECT * FROM `tbl_order` WHERE `id` in (SELECT `order_id` FROM `tbl_order_detail` WHERE `pro_id`=$pro_id)";
		return $this->objmysql->Query($sql);
	}

	public function Add_new(){
		$sql="INSERT INTO `tbl_order`(`cdate`,`cname`,`cphone`,`cemail`,`shiptype`,`add`,`payment`,`totalmoney`,`salercode`,`status`) VALUES (
		'".$this->Cdate."','".$this->Cname."','".$this->Cphone."','".$this->Cemail."','".$this->ShipType."','".$this->Add."','".$this->Payment."','".$this->TotalMoney."','".$this->SalerCode."','".$this->Status."')";
		$this->objmysql->Exec('BEGIN');
		$result=$this->objmysql->Exec($sql);
		$order_id=$this->objmysql->LastInsertID();
		$sql="INSERT INTO `tbl_order_detail`(`order_id`,`pro_id`,`quantity`,`price`,`note`) VALUES ";
		$n=count($_SESSION['CART']);
		$objpro=new CLS_PRODUCTS;
		for($i=0;$i<$n;$i++){
			$price=$objpro->getPriceById($_SESSION['CART'][$i]['ID']);
			$sql.=" ('".$order_id."','".$_SESSION['CART'][$i]['ID']."','".$_SESSION['CART'][$i]['QUA']."','".$price."','".$_SESSION['CART'][$i]['NOTE']."') ";
			if($i<$n-1) $sql.=" , ";
		}
		//echo $sql; die();
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1 ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
		unset($_SESSION['CART']);
	}
    public function Update_order($id){
		$sql="Update  tbl_order SET `cdate`='".$this->Cdate."',
                                    `cname`='".$this->Cname."',
                                    `cphone`='".$this->Cphone."',
                                    `cemail`='".$this->Cemail."',
                                    `shiptype`='".$this->ShipType."',
                                    `add`='".$this->Add."',
                                    `payment`='".$this->Payment."',
                                    `totalmoney`='".$this->TotalMoney."',
                                    `salercode`='".$this->SalerCode."',
                                    `note`='".$this->Note."',
                                    `status`='".$this->Status."',
                                    `author`='".$this->Author."'
                                    WHERE `id`='".$this->Id."'";
		$this->objmysql->Exec('BEGIN');
		$result=$this->objmysql->Exec($sql);
		$order_id=$this->objmysql->LastInsertID();
        
        $sql_k="select * from tbl_order_detail where `order_id`='".$this->Id."'";
        //echo $sql_k;die;
        //$this->objmysql->Exec('BEGIN');
       // $result=$this->objmysql->Exec($sql_k);
		//$total_rows=$this->objmysql->Num_rows();	
       
        /*$n=count($_SESSION['CART']);
		$objpro=new CLS_PRODUCTS;
        $total_rows=$objpro->Num_rows();
         echo $n;die;
         
		for($i=0;$i<$total_rows;$i++){
			$price=$objpro->getPriceById($_SESSION['CART'][$i]['ID']);
            $sql="UPDATE tbl_order_detail SET `order_id`='".$order_id."',
                                               `pro_id`='".$_SESSION['CART'][$i]['ID']."',
                                               `quantity`='".$_SESSION['CART'][$i]['QUA']."',
                                               `price`='".$price."',
                                               `note`='".$_SESSION['CART'][$i]['NOTE']."'";
		}*/
		//echo $sql; die();
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1 ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
		unset($_SESSION['CART']);
	}
	public function Del($id){
		$sql="DELETE FROM `tbl_order_detail` WHERE `order_id`=$id";
		$this->objmysql->Exec('BEGIN');
		$result=$this->objmysql->Exec($sql);
		$sql="DELETE FROM `tbl_order` WHERE `id`=$id";
		$result1=$this->objmysql->Exec($sql);
		
		if($result && $result1 ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
	}
    public function Del_pro($id){
		$sql="DELETE FROM `tbl_order_detail` WHERE `pro_id`=$id";
		$this->objmysql->Exec('BEGIN');
		$result=$this->objmysql->Exec($sql);
		//$sql="DELETE FROM `tbl_order` WHERE ``=$id";
		//$result1=$this->objmysql->Exec($sql);
		
		if($result ){
			$this->objmysql->Exec('COMMIT');
			return true;
		}else {
			$this->objmysql->Exec('ROLLBACK');
			return false;
		}
	}
	public function setStatus($id,$status){
		$sql="UPDATE `tbl_order` SET `status`='$status' WHERE `id` = $id";
		return $this->objmysql->Query($sql);
	}
}
?>