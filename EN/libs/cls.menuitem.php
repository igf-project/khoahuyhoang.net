<?php
class CLS_MENUITEM{
	private $objmysql=null;
	public function CLS_MENUITEM(){
		$this->objmysql=new CLS_MYSQL;
	}
	public function getList($mnuid=0,$where=""){
		if($where!="")
			$where=" WHERE `mnu_id`='$mnuid' AND ".$where;
		$sql="SELECT * FROM `view_menuitem` ".$where;
		return $this->objmysql->Query($sql);
	}
	function Num_rows() { 
		return $this->objmysql->Num_rows();
	}
	function Fetch_Assoc(){
		return $this->objmysql->Fetch_Assoc();
	}
	public function ListMenuItem($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$style="";
		if($level>=1)$style="dropdown-menu";
		
		
		$str="<ul class=\"$style\">";
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}else{
					$urllink=ROOTHOST.un_unicode($rows["name"])."-mnu".$rows["mnuitem_id"].".html";
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList("AND con_id = '".$rows['con_id']."' ");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
				$objcat->getList("AND cat_id = '".$rows['cat_id']."' ");
				$row_cat=$objcat->Fetch_Assoc();
				$urllink=ROOTHOST.$row_cat['alias'].'/';
			}
			$cls='';
			//if($curmenu==$rows['mnuitem_id'] || $cursub==$rows['mnuitem_id']) $cls.=' active ';
			$cls.="".$rows['class']."";
			$child = $this->ListMenuItem($mnuid,$rows["mnuitem_id"],$level+1);
			if($child) $cls.=" dropdown ";	
			$cls = $cls!=''?"class='".$cls."'":'';
			
			$str.="<li $cls>";
			if(!$child)
				$str.="<a href='".$urllink."' title='".$rows['name']."'><span>".$rows["name"]."</span></a>";
			else {
				$str.="<a class='dropdown-toggle' href='".$urllink."' title='".$rows['name']."'>".$rows["name"]."<span class='caret'></span></a>";
				$str.=$child;
			}
			$str.='</li>';			
		}
		$str.='</ul>';  
		return $str;
	}
	public function ListTopmenu($mnuid=0,$par_id=0,$level=1){
		$sql="SELECT * FROM `view_menuitem` WHERE `par_id`='$par_id' AND `mnu_id`='$mnuid' AND`isactive`='1' ORDER BY `order`";
		$objdata=new CLS_MYSQL();
		$objdata->Query($sql);
		if($objdata->Num_rows()<=0)
			return;
		$style = $str = "";
		if($level>=1)$style="dropdown-menu";
		if($level>=1) $str="<ul class=\"$style\">";
		$i=0;
		while($rows=$objdata->Fetch_Assoc()){
			$urllink="";
			if($rows['viewtype']=='link'){
				if(trim($rows['link'])!=''){
					$urllink=$rows['link'];
				}
			}
			else if($rows['viewtype']=='article'){
				$objcon=new CLS_CONTENTS;
				$objcon->getList("AND con_id = '".$rows['con_id']."' ");
				$row_con=$objcon->Fetch_Assoc();
				$urllink=ROOTHOST.'news/'.$row_con['code'].'.html';
			}
			else if($rows['viewtype']=='block' || $rows['viewtype']=='list' ){
				$objcat=new CLS_CATE;
				$objcat->getList("AND cat_id = '".$rows['cat_id']."' ");
				$row_cat=$objcat->Fetch_Assoc();
				$urllink=ROOTHOST.'news/'.$row_cat['alias'].'/';
			}
			else if($rows['viewtype']=='catalog'){
				$objcata = new CLS_CATALOGS;
				$catalog_name = $objcata->getNameById($rows['cata_id']);
				$urllink = ROOTHOST.un_unicode($catalog_name).'/';
			}
			$cls='';
			//if($curmenu==$rows['mnuitem_id'] || $cursub==$rows['mnuitem_id']) $cls.=' active ';
			$cls.="".$rows['class']."";
			$child = $this->ListTopmenu($mnuid,$rows["mnuitem_id"],$level+1);
			if($child) $cls.=" dropdown ";	
			$cls = $cls!=''?"class='".$cls."'":'';
			
			if($rows['intro']!='' && $rows['intro']!="&nbsp;") 
				$intro = $rows['intro'];
			else $intro ='';
			
			$str.="<li $cls>";
			if(!$child)
				$str.="<a href='".$urllink."' title='".$rows['name']."'>".$intro."<span>".$rows["name"]."</span></a>";
			else {
				$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
                    '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
                    '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );
				$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad"); 

				if($isMobile && $ipad==false)
					$str.="<a class='dropdown-toggle' data-toggle='dropdown' href='#' title='".$rows['name']."'>".$rows["name"]."<span class='caret'></span></a>";
				else
					$str.="<a class='dropdown-toggle' href='".$urllink."' title='".$rows['name']."'>".$rows["name"]."<span class='caret'></span></a>";
				$str.=$child;
			}
			$str.='</li>';			
		}
		if($level>=1)
		$str.='</ul>';  
		return $str;
	}
}
?>