<?php
class CLS_CONFIG{
	private $pro=array(
		'Title'=>'Công ty tư vấn & thiết kế website uy tín tại Hà Nội, Cung cấp dịch vụ hosting, domain, quản trị website, quảng cáo google, seo...',
		'Meta_key'=>'',
		'Meta_desc'=>'',
		'Logo'=>'http://igf.com.vn/images/logo-igf.png',
		'Img'=>'http://igf.com.vn/images/logo-igf.png',
		'Email'=>'',
		'Phone'=>'',
		'Contact'=>'',
		'Footer'=>'',
		'Nich_yahoo'=>'',
		'Name_yahoo'=>''
	);
	private $objmysql=null;
	public function CLS_CONFIG(){
		$this->objmysql=new CLS_MYSQL;
		$this->objmysql->Query("SELECT * FROM tbl_configsite");
		$row=$this->objmysql->Fetch_Assoc();
		$this->Title=($row['title']!="")?$row['title']:SITE_TITLE;
		$this->Meta_desc=($row['meta_descript']!="")?$row['meta_descript']:SITE_DESC;
		$this->Meta_key=($row['meta_keyword']!="")?$row['meta_keyword']:SITE_KEY;
		$this->Contact=($row['contact']!="")?$row['contact']:COM_CONTACT;
		$this->Footer=$row['footer'];
		$this->Email=$row['email'];
		$this->Phone=$row['phone'];
		$this->Nich_yahoo=$row['nick_yahoo'];
		$this->Name_yahoo=$row['name_yahoo'];
		$this->Logo=$row['logo'];
	}
	// property set value
	function __set($proname,$value){
		if(!isset($this->pro[$proname])){
			//echo "Error set: $proname không phải là thành viên của class configsite"; 
			return;
		}
		$this->pro[$proname]=$value;
	}
	function __get($proname){
		if(!isset($this->pro[$proname])){
			//echo ("Error get:$proname không phải là thành viên của class configsite" ); 
			return;
		}
		return $this->pro[$proname];
	}
	function load_config(){
		$com =		isset($_GET['com'])?addslashes($_GET['com']):'';
		$viewtype =	isset($_GET['viewtype'])?addslashes($_GET['viewtype']):'';
		$code =		isset($_GET['code'])?addslashes($_GET['code']):'';
		
		switch($com) {
		case 'contents':
			$objcon=new CLS_CONTENTS;
			$objcat=new CLS_CATE;
			if($viewtype=='block'){
				$objcat->getList(" AND `alias`='$code'");
				$r_cat=$objcat->Fetch_Assoc();
				if($r_cat['meta_title']!='')
					$this->Title=stripslashes($r_cat['meta_title']);
				else
					$this->Title=$r_cat['name']." | Huy Hoang Lock";
				$this->Meta_key=stripslashes($r_cat['meta_key']);
				$this->Meta_desc=stripslashes($r_cat['meta_desc']);
			}
			elseif($viewtype=='article'){
				$objcon->getList(" AND `code`='$code'");
				$r_con=$objcon->Fetch_Assoc();
				
				if($r_con['meta_title']!='')
					$this->Title=stripslashes($r_con['meta_title']);
				else
					$this->Title=stripslashes($r_con['title'])." | Huy Hoang Lock";
				$this->Meta_key=stripslashes($r_con['meta_key']);
				$this->Meta_desc=stripslashes($r_con['meta_desc']);
			}elseif($viewtype=='search'){
				$key='';
				if(isset($_GET['keyword']))
				$key=stripslashes($_GET['keyword']);
				$this->Title="Huy Hoang Lock - Search with keywords \"$key\"";
				$this->Meta_desc="Huy Hoang Lock: Search for the type of lock,Handle Lock HC, Cabinet Lock, Padlock , Lock the door, Hinges, cremone";
			}
			break;
		case 'products':
			$objcata= new CLS_CATALOGS;
			$objpro = new CLS_PRODUCTS;
			if($viewtype=='block'){
				$objcata->getList(" AND `alias`='$code'");
				$r_cata=$objcata->Fetch_Assoc();
				if($r_cata['meta_title']!='')
					$this->Title=stripslashes($r_cata['meta_title']);
				else
					$this->Title=$r_cata['name']." | Huy Hoang Lock";
				$this->Meta_key=stripslashes($r_cata['meta_key']);
				$this->Meta_desc=stripslashes($r_cata['meta_desc']);
			}
			elseif($viewtype=='detail'){
				// TH mã SP chứa dấu + trên URL sẽ trả về ký tự trắng. Vì vậy cần thay ký tự trắng về dấu +
				$code = str_replace(" ","+",$code);
				$objpro->getList(" AND `pro_code`='$code'");
				$r_pro=$objpro->Fetch_Assoc();
				
				if($r_pro['meta_title']!='')
					$this->Title=stripslashes($r_pro['meta_title']);
				else
					$this->Title=stripslashes($r_pro['name'])." | Huy Hoang Lock";

				$this->Meta_key=stripslashes($r_pro['meta_key']);
				$this->Meta_desc=stripslashes($r_pro['meta_desc']);
			}
			else {
				$this->Title="Huy Hoang Lock - Lock the door, Padlock, Cremone Bolts, Inox Hinges";
				$this->Meta_key=" High Security Huy Hoang Lock,About Huy Hoang Lock, Huy Hoang Lock lines";
				$this->Meta_desc="Huy Hoang lock products have won the award: “Vietnam high quality goods”. With many model lock the door, Hendle high security, Padlock, Cremone Bolts, Inox Hinges";
			}
			break;
		case 'gallery':
			if($viewtype=='block'){
				$id =	isset($_GET['id'])?addslashes($_GET['id']):0;
				if($id==1) {
					$this->Title="Huy Hoang Lock - Projects made by Huy Hoang";
					$this->Meta_key="Huy Hoang projects, Projects made by Huy Hoang";
					$this->Meta_desc="Some pictures of the project was implemented of Huy Hoang Lock company";
				}
				else if($id==2) {
					$this->Title="Huy Hoang Lock - Projects made by Huy Hoang";
					$this->Meta_key="Huy Hoang projects, Project Ongoing by Huy Hoang";
					$this->Meta_desc="Some pictures of the projects being implemented of Huy Hoang Lock company";
				}
			} elseif($viewtype=='detail') {
				$gid =	isset($_GET['gid'])?addslashes($_GET['gid']):0; 
			} else {
				$this->Title="Huy Hoang Lock - Projects of Huy Hoang Lock company";
				$this->Meta_key="Huy Hoang projects, Projects pictures of Huy Hoang lock, Projects of Huy Hoang Lock company";
				$this->Meta_desc="Some pictures of the projects being implemented of Huy Hoang Lock company";
			}
			break;
		case 'contact': 
			$this->Title="Huy Hoang Lock - Contact & Product distribution system lock";
			$this->Meta_key=" Huy Hoang Lock Contact, hệ thống phân phối Huy Hoàng,địa chỉ Huy Hoang Lock";
			$this->Meta_desc="Thông tin liên hệ & Product Distribution System of Huy Hoang Lock company";
			break;
		}
	}
}
?>