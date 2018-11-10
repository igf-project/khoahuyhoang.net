<?php include("helper.php");?>
<div class="module<?php echo " ".$r['class'];?>">
	<?php if($r['viewtitle']==1){?>
	<a href="<?php echo ROOTHOST.'san-pham';?>" title="<?php echo $r['title'];?>">
		<?php if($theme=="brow1") { ?>
		<div class="head_title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></div>
		<?php } else { ?>
		<div class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></div>
		<?php }?>
	</a>
	<?php 
	}
	include(MOD_PATH."mod_$MOD/brow/".$theme.'.php'); ?>
</div>
<?php unset($obj); unset($r);?>