<?php
	defined("ISHOME") or die("Can't acess this page, please come back!")
?>
<div id="action">
 <script language="javascript">
 function checkinput(){
	if($("#txttitle").val()==""){
	 	$("#txttitle_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
		});
	 	$("#txttitle").focus();
	 	return false;
	}
	if($("#txtcode").val()=="")
	{
	 	$("#txtcode_err").fadeTo(200,0.1,function()
		{ 
		  $(this).html('Vui lòng nhập mã cho bài viết').fadeTo(900,1);
		});
	 	$("#txtcode").focus();
	 	return false;
	}
	return true;
 }
$(function() {
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(function() {
	$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
});

$(document).ready(function() {
	$("#txttitle").blur(function(){
		if ($("#txttitle").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập tên bài viết').fadeTo(900,1);
			});
		}
	});
	$("#txtcode").blur(function(){
		if ($("#txtcode").val()=="") {
			$("#txtcode_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập mã bài viết').fadeTo(900,1);
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
			<td align="right" bgcolor="#EEEEEE"><strong>Tên Saler<font color="red">*</font></strong></td>
			<td><input name="txt_ctyname" type="text" id="txt_ctyname" size="35" /><label id="txttitle_err" class="check_error"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Người đại diện<font color="red">*</font></strong></td>
			<td>
			  <input name="txt_ncontact" type="text" id="txt_name" size="35" />
			  <label id="txttitle_err" class="check_error"></label></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Đại chỉ <font color="red">*</font></strong></td>
			<td><input id = "txt_address" type="text" name="txt_address" size='40' /></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Tel<font color="red">*</font></strong></td>
			<td><input id = "txt_address" type="text" name="txt_tel" /></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Điện thoại bàn</strong></td>
			<td><input name="txt_phone" type="text" value='' /></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Email</strong></td>
			<td><input name="txt_email" type="text" id="txt_email" size="35" />
			<label id="txtcode_err" class="check_error"></label></td>
        </tr>
		 <tr>
			<td width="126" align="right" bgcolor="#EEEEEE"><strong>Fax</strong></td>
			<td>
				<input id = "txt_address" type="text" name="txt_fax" />
			</td>
				<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
				<td><input name="optactive" type="radio" value="1" checked='true' />
				<?php echo CYES;?>
				<input name="optactive" type="radio" value="0" />
				<?php echo CNO;?></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Ai thêm<font color="red">*</font></strong></td>
			<td><?php echo $_SESSION['IGFUSERLOGIN'];?></td>		
        </tr>
      </table>
      </fieldset>
    <br style="clear:both" />
    <strong><?php echo CINTRO;?></strong>
    <textarea name="txt_intro" id="txtintro" cols="45" rows="5">&nbsp;</textarea>
     <script language="javascript">
            var oEdit2=new InnovaEditor("oEdit2");
            oEdit2.width="100%";
            oEdit2.height="100";
            oEdit2.cmdAssetManager ="modalDialogShow('<?php echo URLEDITOR;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
            oEdit2.REPLACE("txtintro");
			document.getElementById("idContentoEdit2").style.height="100px";
      </script>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>