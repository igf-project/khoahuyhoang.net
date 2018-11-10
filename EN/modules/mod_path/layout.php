<?php
if(isset($_GET['com'])) { 
	$com = addslashes($_GET['com']);
	$action = isset($_GET['action'])?addslashes($_GET['action']):'';
	$viewtype = isset($_GET['viewtype'])?addslashes($_GET['viewtype']):'';
	$path_name = '';

	switch($com) {
		case 'contents':
			$code = isset($_GET['code'])?addslashes($_GET['code']):'';	
		
			$objcon = new CLS_CONTENTS;
			$objcat = new CLS_CATE;		
			if($viewtype=="block") {
				$cat_name = $objcat->getNameByCode(" `alias`='$code'");
				if($cat_name!='') {
					$arr_name = explode(";;",$cat_name);
					for($i=0;$i<count($arr_name)-1;$i++) 
						$path_name.= '<li><a href="'.ROOTHOST.'news/'.un_unicode($arr_name[$i]).'/">'.$arr_name[$i].'</a></li>';
				}
			}else if($viewtype=="article") {
				$objcon->getList(" AND `code`='".$code."'");
				if ($objcon->Num_rows()>0) {
					$row = $objcon->Fetch_Assoc();
					$title = stripslashes($row['title']);
					$cat_name = $objcat->getNameByCode(" `cat_id`='$row[cat_id]'");
					if($cat_name!='') {
						$arr_name = explode(";;",$cat_name);
						for($i=0;$i<count($arr_name)-1;$i++) 
							$path_name.= '<li><a href="'.ROOTHOST.'news/'.un_unicode($arr_name[$i]).'/">'.$arr_name[$i].'</a></li>';
					}
					//$path_name .= '<li><a href="'.ROOTHOST.'tin-tuc/'.$code.'.html">'.$title.'</a></li>';
				}
				
			}else if($viewtype=="search") {
				$path_name = '<li><a href="'.ROOTHOST.'">Search</a></li>';
			}
			break;
		case 'contact': 
			$path_name = '<li><a href="'.ROOTHOST.'contact/">Contact</a></li>';
			break;
		case 'gallery': 
			$path_name = '<li><a href="'.ROOTHOST.'project/">Project</a></li>';
			if($viewtype=='block') {
				$id = isset($_GET['id'])?(int)($_GET['id']):0;
				$objga = new CLS_GALLERY;
				$ablum = $objga->getNameById($id); unset($objga);
				$path_name .= '<li><a href="'.ROOTHOST.'project/'.$id.'">'.$ablum.'</a></li>';
			}
			break;
		case 'products':
			$path_name = '<li><a href="'.ROOTHOST.'product/">Products</a></li>';
			$code = isset($_GET['code'])?addslashes($_GET['code']):'';	
			if($code!='') {
				// TH chứa dấu + trên URL sẽ trả về ký tự trắng. Vì vậy phải thay ký tự trắng về dấu +
				$code = str_replace(" ","+",$code);
			}
			$objcata = new CLS_CATALOGS;
			if($viewtype=="block") {
				$name = $objcata->getNameByAlias($code);
				$path_name.= '<li><a href="'.ROOTHOST.$code.'">'.$name.'</a></li>';
			}
			else if ($viewtype=="detail"){
				$objpro = new CLS_PRODUCTS;
				$info = $objpro->getInfoByCode($code);
				$pro_name = $info['name'];
				$cat_name = $objcata->getNameById($info['cat_id']);
				$path_name.= '<li><a href="'.ROOTHOST.un_unicode($cat_name).'">'.$cat_name.'</a></li>';
				//$path_name.= '<li><a href="'.ROOTHOST.un_unicode($cat_name).'/'.$code.'.html">'.$pro_name.'</a></li>';
			}
			break;
	} // end switch
	$link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	?>
<div id="path"class="container-fluid">
	<div class='container'>
		<ul class="pull-left col-md-7 col-sm-6 col-xs-12">
			<li>
				<a href="<?php echo ROOTHOST;?>" class="home">
					<img src="<?php echo ROOTHOST.'images/icons/glyphicons-21-home.png';?>" width="20" align="middle" alt="Huy Hoang Lock"/>
				</a>
			</li>
			<?php echo $path_name;?>
		</ul>
		<?php if($viewtype=="detail" or $viewtype=="article") {?>
		<div class="pull_right like_share_box col-md-5 col-sm-6 col-xs-12">
			<div class="fb  col-xs-6">
				<div class="fb-like" data-href="<?php echo $link;?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				<div class="fb-share-button" data-href="<?php echo $link;?>" data-layout="button_count"></div>			
			</div>
			<div class="g-tw">
				<div class="g-plusone" data-size="medium" data-href="<?php echo $link;?>"></div>
				<div class="g-plus" data-action="share" data-annotation="bubble" data-href="<?php echo $link;?>"></div>	
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $link;?>">Tweet</a>		
			</div>			
		</div>
		<?php } ?>
	</div>
</div>
<?php } // end if?>