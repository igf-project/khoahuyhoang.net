<?php
defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
<script language="javascript">
function checkinput(){
if($("#txt_name").val()==""){
	$("#txttitle_err").fadeTo(200,0.1,function(){ 
	  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
	});
	$("#txt_name").focus();
	return false;
}
return true;
}
$(document).ready(function() {
	$("#txt_name").blur(function(){
		if ($("#txt_name").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập hãng sản xuất').fadeTo(900,1);
			});
		}
	});
});

</script>
  <form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
  <fieldset>
   <legend><strong><?php echo CDETAIL;?>&nbsp;</strong></legend>
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td width="150" align="right" bgcolor="#EEEEEE"><strong>Tên Hãng Sản Xuất<font color="red">*</font></strong></td>
			<td><input name="txt_name" type="text" id="txt_name" size="35" />
			<label id="txttitle_err" class="check_error"></label></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
			<td><input name="optactive" type="radio" value="1" checked='true' />
			<?php echo CYES;?>
			<input name="optactive" type="radio" value="0" />
			<?php echo CNO;?></td>
		</tr>
	</table>
    </fieldset>
    <br style="clear:both" />
    <strong><?php echo CINTRO;?></strong>
    <textarea name="txtintro" id="txtintro" cols="45" rows="5">&nbsp;</textarea>
     <script language="javascript">
            var oEdit2=new InnovaEditor("oEdit2");
            oEdit2.width="100%";
            oEdit2.height="100";
            oEdit2.cmdAssetManager ="modalDialogShow('<?php echo EDI_PATH;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit2.REPLACE("txtintro");
			document.getElementById("idContentoEdit2").style.height="100px";
      </script>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>