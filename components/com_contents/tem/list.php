<div class="news_list">
	<h2 class='title'><a href='<?php echo ROOTHOST.'tin-tuc/'.un_unicode($name);?>'><?php echo $name;?></a></h2>
<?php
$where=" AND `cat_id`=$item";
$obj->getList($where);

if($obj->num_rows()>0){
	$obj->getList($where,' ORDER BY `order` ASC,con_id DESC',$limit);
	if($onCategory==true) {
		$total_rows = $obj->num_rows();
		$obj->getList($where,' ORDER BY `order` ASC,con_id DESC'," LIMIT $start,$max_rows");
	}
	
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
	<div class="clr"></div>
	<?php  if($onCategory==true) {?>
	<div class="text-center"><?php echo paging_index($total_rows,$max_rows,$cur_page);?></div>
	<?php } else echo '<div class="text-center read-more"><span class="caret"></span> Xem thêm <a href="'.ROOTHOST.'tin-tuc/'.un_unicode($name).'">'.$name.'</a></div>';?>
</div>
