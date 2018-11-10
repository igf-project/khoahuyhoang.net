<div class="clr padding"></div>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$code='';
if(isset($_GET["code"])) 	$code = addslashes($_GET["code"]);
$max_rows=MAX_ITEM;
$cur_page=1;
if(isset($_POST['txtCurnpage'])){$cur_page=$_POST['txtCurnpage'];}

if(!isset($objcat)) $objcat = new CLS_CATE;
$objcat->getList(" AND alias='$code' ");
if($objcat->num_rows()==0) {
	echo '<script>window.location.href="'.ROOTHOST.'404.html";</script>';
}else {
	$row_cat=$objcat->Fetch_Assoc();
	$catename= $objcat->getNameById($row_cat['cat_id']);
	$ids = $objcat->getCatIDChild('',$row_cat['cat_id']);
	if($ids!='') {
		$arr = explode("','",$ids);
		$n = count($arr)-1;
		unset($arr[$n]);
	} else $arr[0] = $row_cat['cat_id'];
	foreach($arr as $item) { 
		$name =  $objcat->getNameById($item);
?>
		<div class="news_list">
			<h2 class='title'><a href='<?php echo ROOTHOST.'tin-tuc/'.un_unicode($name);?>'><?php echo $name;?></a></h2>
<?php
		$where=" AND `cat_id`=$item";
		$obj->getList($where);

		if($obj->num_rows()>0){
			$obj->getList($where,' ORDER BY `order` ASC,con_id DESC'," LIMIT 0,6");
			while($rows=$obj->Fetch_Assoc()){
				$title = Substring(stripslashes($rows["title"]),0,30);
				//$intro = stripslashes($rows["intro"]);
				//$author = stripslashes($rows["author"]);
				$mdate = date('d/m/Y',strtotime($rows["modifydate"]));
				$thumb = stripslashes($rows["thumb_img"]);
				$link=ROOTHOST.'tin-tuc/'.$rows['code'].'.html';
?>
			<div class="item clearfix">
				<div class="tab_img">
					<a href="<?php echo $link;?>">
						<img src="<?php echo $thumb;?>" alt="<?php echo $title;?>" tilte="<?php echo $title;?>">
					</a>
				</div>
				<h4 class="title" title="<?php echo $title;?>"><a href="<?php echo $link;?>"><?php echo $title;?></a></h4>
				<div class="more"><em>Ngày đăng: <date><?php echo $mdate;?></date></em></div>
				<div class="readmore"><a href="<?php echo $link;?>">Đọc thêm <span class="glyphicon glyphicon-play-circle"></span></a></div>
			</div>
<?php 		}// end while 
		} // end if
?>
		</div>
<?php
	} // end foreach
} // end if
?>