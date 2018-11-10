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
					$this->Title=$r_cat['name']." | Khóa Huy Hoàng";
				$this->Meta_key=stripslashes($r_cat['meta_key']);
				$this->Meta_desc=stripslashes($r_cat['meta_desc']);
			}
			elseif($viewtype=='article'){
				$objcon->getList(" AND `code`='$code'");
				$r_con=$objcon->Fetch_Assoc();
				
				if($r_con['meta_title']!='')
					$this->Title=stripslashes($r_con['meta_title']);
				else
					$this->Title=stripslashes($r_con['title'])." | Khóa Huy Hoàng";
				$this->Meta_key=stripslashes($r_con['meta_key']);
				$this->Meta_desc=stripslashes($r_con['meta_desc']);
			}elseif($viewtype=='search'){
				$key='';
				if(isset($_GET['keyword']))
				$key=stripslashes($_GET['keyword']);
				$this->Title="Khóa Huy Hoàng - Tìm kiếm với từ khóa \"$key\"";
				$this->Meta_desc="Khóa Huy Hoàng: Tìm kiếm các loại khóa, khóa tay nắm, khóa tủ, khóa treo, khóa cửa, bản lề, cremone";
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
					$this->Title=$r_cata['name']." | Khóa Huy Hoàng";
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
					$this->Title=stripslashes($r_pro['name'])." | Khóa Huy Hoàng";

				$this->Meta_key=stripslashes($r_pro['meta_key']);
				$this->Meta_desc=stripslashes($r_pro['meta_desc']);
			}
			else {
				$this->Title="Khóa Huy Hoàng - Khóa cửa, khóa treo, chốt cremone, bản lề inox";
				$this->Meta_key="khóa cao cấp huy hoàng,các loại khóa Huy Hoàng,các dòng khóa Huy Hoàng";
				$this->Meta_desc="Khóa Huy Hoàng nhiều năm liên tục được bình chọn Hàng Việt nam chất lượng cao. Với nhiều mẫu mã khóa cửa, tay nắm cao cấp, khóa treo, chốt cremone, bản lề inox";
			}
			break;
		case 'gallery':
			if($viewtype=='block'){
				$id =	isset($_GET['id'])?addslashes($_GET['id']):0;
				if($id==1) {
					$this->Title="Khóa Huy Hoàng - Các dự án Huy Hoàng đã thực hiện";
					$this->Meta_key="dự án Huy Hoàng, dự án Huy Hoàng đã thực hiện";
					$this->Meta_desc="Một số hình ảnh về các dự án đã thực hiện của công ty khóa Huy Hoàng";
				}
				else if($id==2) {
					$this->Title="Khóa Huy Hoàng - Các dự án Huy Hoàng đang thực hiện";
					$this->Meta_key="dự án Huy Hoàng, dự án Huy Hoàng đang thực hiện";
					$this->Meta_desc="Một số hình ảnh về các dự án đang thực hiện của công ty khóa Huy Hoàng";
				}
			} elseif($viewtype=='detail') {
				$gid =	isset($_GET['gid'])?addslashes($_GET['gid']):0; 
			} else {
				$this->Title="Khóa Huy Hoàng - Các dự án của công ty TNHH Khóa Huy Hoàng";
				$this->Meta_key="Dự án Huy Hoàng, hình ảnh dự án Huy Hoàng, dự án của công ty khóa Huy Hoàng";
				$this->Meta_desc="Một số hình ảnh về các dự án của công ty Khóa Huy Hoàng";
			}
			break;
		case 'contact': 
			$this->Title="Khóa Huy Hoàng - Liên hệ & Hệ thống phân phối sản phẩm khóa";
			$this->Meta_key="Liên hệ khóa Huy Hoàng,hệ thống phân phối Huy Hoàng,địa chỉ khóa Huy Hoàng";
			$this->Meta_desc="Thông tin liên hệ & Hệ thống phân phối sản phẩm của công ty Khóa Huy Hoàng";
			break;
		}
	}
}
?>