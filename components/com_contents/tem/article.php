<div class='content_body content_detail'>
<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$code=''; $lagid=0;
if(isset($_GET['code']))
	$code=addslashes($_GET['code']);
if($code!=''){
	//Dem luot xem bai viet
	if(!isset($_SESSION['VIEW_ARTICLE_CODE']) || $_SESSION['VIEW_ARTICLE_CODE']!=$code) {
		$_SESSION['VIEW_ARTICLE_CODE']=$code;
		$obj->setVisited($code);
	}
	$obj->getList(" AND `code`='$code'");
	if($obj->num_rows()==0) echo '<script>window.location.href="'.ROOTHOST.'404.html";</script>';
	
	$row=$obj->Fetch_Assoc();
	$img=stripslashes($row["thumb_img"]);
	$title=stripslashes($row['title']);
	$intro=stripslashes(trim($row['intro']));
	$content=stripslashes($row['fulltext']);
	$key=explode(',',$row['meta_key']);
	$link=ROOTHOST.'tin-tuc/'.$row['code'].'.html';
?>
<header>
<h1 class='title-article' title='<?php echo $title;?>'><?php echo $title; ?></h1>
</header>
<section class="content" style="overflow:hidden;">
	<?php echo $content;?>
</section><br>
<div class='clr'></div>
<div id="box_comments">
	<div class="fb-comments" data-href="<?php echo $link;?>" data-numposts="5" data-colorscheme="light" data-width="100%"></div>
</div>
<div class='clr'></div>
<?php
$where=" AND cat_id='".$row['cat_id']."' AND `code`!='".$code."'";
$obj->getList(" $where ",' ORDER BY `modifydate` DESC '," LIMIT 0,10");
if($obj->Num_rows()>0) {
?>
<div class="row">
	<div class='others title'>Bài viết khác</div>
	<ul class="others_news">
	<?php 
	while($rows=$obj->Fetch_Assoc()){
		$title = stripslashes($rows["title"]);
		$link=ROOTHOST.'tin-tuc/'.$rows['code'].'.html';
		echo '<li class="col-md-6 col-sm-12"><a href="'.$link.'" title="'.$title.'">'.$title.'</a></li>';
	}
	} 
	?></ul>
</div>
<?php
} // endif
unset($content); unset($title); unset($code);
?><br><br>
</div>