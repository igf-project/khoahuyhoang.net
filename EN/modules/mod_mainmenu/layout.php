<?php include("helper.php");
if($r['class']!='') echo '<div class="module '.$r['class'].'">';
if($r['viewtitle']==1){?>
	<h3 class="title" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></h3>
    <?php }?>
    <?php include(MOD_PATH."mod_$MOD/brow/".$theme.'.php'); 
if($r['class']!='') echo '</div>';
unset($obj); unset($r);?>