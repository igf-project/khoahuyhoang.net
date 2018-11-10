<?php
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=(int)$_GET["id"];
	$obj->getList(' AND `con_id`='.$id);
	$row=$obj->Fetch_Assoc();
	$img=stripslashes($row["thumb_img"]);
	$title=stripslashes($row['title']);
	$content=stripslashes($row['fulltext']);
	$intro=stripslashes($row['intro']);
?>
<script>
function checkinput(){
	document.getElementById("txtids").value=document.getElementById("con_id").value;
	return true;
}
</script>
<div class="content_body">	
	<header>
	<h1 class='title-article' title='<?php echo $title;?>'><?php echo $title; ?></h1>
	</header>
	<div class="news">
	<div class="col-md-6"><a href="#" class="thumb_img"><img src="<?php echo $img;?>" class="img-responsive"></a></div>
	<div class="col-md-6"><?php echo $intro;?></div>
	</div>
	<div class='clr'></div>
	<hr width="100%" size=2>
	<section class="content" style="overflow:hidden;">
		<?php echo $content;?>
	</section><br>
	<div class='clr'></div>
	<input type="hidden" name="con_id" id="con_id" value="<?php echo $row['con_id'];?>">
</div>