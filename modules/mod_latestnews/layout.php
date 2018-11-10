<?php include("helper.php");?>
<div class="module <?php echo $r['class'];?>">
<?php if($r['viewtitle']==1){ 
	echo '<div class="tieu-de" title="'.$r['title'].'">'.$r['title'].'</div>';
}
	include(MOD_PATH."mod_$MOD/brow/".$theme.'.php'); ?>
</div>
<?php
unset($obj); unset($r);
?>