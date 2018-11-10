<?php
	defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txtname").val()==""){
	 	$("#txtname_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên nhóm tin').fadeTo(900,1);
		});
	 	$("#txtname").focus();
	 	return false;
	}
	return true;
}
$(document).ready(function(){
	$("#txtname").blur(function() {
		if( $(this).val()=='') {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập tên nhóm tin').fadeTo(900,1);
			});
		}
		else {
			$("#txtname_err").fadeTo(200,0.1,function(){ 
			  $(this).html('').fadeTo(900,1);
			});
		}
	})
})
</script>
  <form id="frm_action" name="frm_action" method="post" action="">
  Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong>Thư mục ảnh <font color="red">*</font></strong></td>
        <td><select name="cboid" id="cboid"><?php $obj->listAlbum();?></select>
          <label id="txtname_err" class="check_error"></label>
          <input name="txttask" type="hidden" id="txttask" value="1" />
		</td>
      </tr>
      <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Ảnh <font color="red">*</font></strong></td>
			<td><input size="35" name="txtthumb" value="" type="text"><a href="#" onclick="OpenPopup('extensions/upload_image.php');">Chọn</a> </td></tr>
      <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Tên dự án</strong></td>
			<td><input type="text" name="txtname" id="txtname" size="35"></td></tr>
      <tr>
	  <tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Giới thiệu</strong></td>
			<td><textarea name="txtintro" cols="40" rows="5" id="txtintro"></textarea>
			<script language="javascript">
				var oEdit2=new InnovaEditor("oEdit2");
				oEdit2.width="100%";
				oEdit2.height="100";
				oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit2.REPLACE("txtintro");
				document.getElementById("idContentoEdit2").style.height="100px";
			</script>
			</td></tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" checked><?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0"><?php echo CNO;?></td>
      </tr>
    </table>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>