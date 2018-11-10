<?php
class CLS_MYSQL{
	private $pro=array(	'HOSTNAME'=>'localhost',
						'USERNAME'=>'root',
						'PASSWORD'=>'',
						'DATANAME'=>'igf_cms');
	private $conn=NULL;
	private $rs;
	private $lastid;
	public function CLS_MYSQL(){
		// set value
		$this->HOSTNAME=HOSTNAME;
		if($_SESSION['CONNECT_TYPE']=='main'){
			$this->USERNAME=DB_USERNAME;
			$this->PASSWORD=DB_PASSWORD;
			$this->DATANAME=DB_DATANAME;
		}else if($_SESSION['CONNECT_TYPE']=='shop01'){
			$this->USERNAME=DB_USERNAME1;
			$this->PASSWORD=DB_PASSWORD1;
			$this->DATANAME=DB_DATANAME1;
		}
		else if($_SESSION['CONNECT_TYPE']=='shop02'){
			$this->USERNAME=DB_USERNAME2;
			$this->PASSWORD=DB_PASSWORD2;
			$this->DATANAME=DB_DATANAME2;
		}else if($_SESSION['CONNECT_TYPE']=='shop03'){
			$this->USERNAME=DB_USERNAME3;
			$this->PASSWORD=DB_PASSWORD3;
			$this->DATANAME=DB_DATANAME3;
		}else if($_SESSION['CONNECT_TYPE']=='shop04'){
			$this->USERNAME=DB_USERNAME4;
			$this->PASSWORD=DB_PASSWORD4;
			$this->DATANAME=DB_DATANAME4;
		}else if($_SESSION['CONNECT_TYPE']=='shop05'){
			$this->USERNAME=DB_USERNAME5;
			$this->PASSWORD=DB_PASSWORD5;
			$this->DATANAME=DB_DATANAME5;
		}else{
			echo "TYPE".$_SESSION['CONNECT_TYPE'];
			echo "Can't Connect Database";
		}
	}
	private function connect(){
		$conn=@mysql_pconnect($this->HOSTNAME,$this->USERNAME,$this->PASSWORD);
		if(!$conn){
			echo "Can't connect MySQL Server!";
			return false;
		}
		$this->conn=$conn;
		if(@!mysql_select_db($this->DATANAME,$this->conn))
			return false;
		return true;
	}
	private function disconnect(){
		if(isset($this->conn))
		return @mysql_close($this->conn);
	}
	// property set value
	public function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			echo "$proname isn't member of MySQL Class ";
			return;
		}
		$this->pro[$proname]=$value;
	}
	public function __get($proname){
		if(!isset($this->pro[$proname])){
			$this->callmess("$proname isn't member of MySQL Class" );
			return;
		}
		return $this->pro[$proname];
	}
	// function query
	public function Query($sql){
		if($this->connect())
		{
			@mysql_query('SET character_set_results=utf8');
			@mysql_query('SET names=utf8');
			@mysql_query('SET character_set_client=utf8');
			@mysql_query('SET character_set_connection=utf8');
			@mysql_query('SET character_set_results=utf8');
			@mysql_query('SET collation_connection=utf8_unicode_ci');
			@$rs=mysql_query($sql,$this->conn);
			@$this->lastid=mysql_insert_id();
			$this->disconnect();
			if($rs){
				$this->rs=$rs;
				return true;
			}
		}
		return false;
	}
	public function Exec($sql){
		if($this->connect()){
			@mysql_query('SET character_set_results=utf8');
			@mysql_query('SET names=utf8');
			@mysql_query('SET character_set_client=utf8');
			@mysql_query('SET character_set_connection=utf8');
			@mysql_query('SET character_set_results=utf8');
			@mysql_query('SET collation_connection=utf8_unicode_ci');
			$result=mysql_query($sql,$this->conn);
			@$this->lastid=mysql_insert_id();
			$this->disconnect();
			return $result;
		}
		return false;
	}
	public function LastInsertID(){
		return $this->lastid;
	}
	public function Fetch_Assoc(){
		return (@mysql_fetch_assoc($this->rs));
	}
	public function Num_rows() { 
        return(@mysql_num_rows($this->rs));
    }
}
?>