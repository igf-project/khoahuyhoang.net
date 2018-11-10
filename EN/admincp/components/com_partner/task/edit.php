<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=$_GET["id"];
$obj->getList(' And partner_id='.$id,' limit 0,1');
$row=$obj->Fetch_Assoc();
?>
<div id="action">
<script language="javascript">
function checkinput(){
	if($("#txt_ctyname").val()==""){
	 	$("#txttitle_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập tên gian hàng').fadeTo(900,1);
		});
	 	$("#txttitle").focus();
	 	return false;
	}
	if($("#txt_website").val()==""){
	 	$("#txtcode_err").fadeTo(200,0.1,function(){ 
		  $(this).html('Vui lòng nhập liên kết gian hàng').fadeTo(900,1);
		});
	 	$("#txt_website").focus();
	 	return false;
	}
	return true;
}
$(document).ready(function() {
	$("#txt_ctyname").blur(function(){
		if ($("#txt_ctyname").val()=="") {
			$("#txtcode_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập liên kết gian hàng').fadeTo(900,1);
			});
		}
	});
	$("#txt_website").blur(function(){
		if ($(this).val()=="") {
			$("#txtcode_err").fadeTo(200,0.1,function(){ 
			  $(this).html('Vui lòng nhập liên kết gian hàng').fadeTo(900,1);
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
			<td align="right" bgcolor="#EEEEEE"><strong>Tên đại lí<font color="red">*</font></strong></td>
			<td><input name="txt_ctyname" type="text" id="txt_ctyname" size="35" value="<?php echo $row['company_name'];?>"/><label id="txttitle_err" class="check_error"></label></td>			
			<td align="right" bgcolor="#EEEEEE"><strong>Website<font color="red">*</font></strong></td>
			<td>
			  <input name="txt_website" type="text" id="txt_website" size="35" value="<?php echo $row['website'];?>" />
			  <label id="txttitle_err" class="check_error"></label></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Đại chỉ <font color="red">*</font></strong></td>
			<td><input id = "txt_address" type="text" name="txt_address" size='40' value="<?php echo $row['address'];?>" /></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Email</strong></td>
			<td><input name="txt_email" type="text" id="txt_email" size="35" value="<?php echo $row['email'];?>"/>
			<label id="txtcode_err" class="check_error"></label></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Mobile</strong></td>
			<td><input name="txt_phone" type="text" value="<?php echo $row['phone'];?>" /></td>
			</td>
				<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
				<td><input name="optactive" type="radio" value="1" checked='true' <?php if($row['isactive']==1) echo "checked";?>/>
				<?php echo CYES;?>
				<input name="optactive" type="radio" value="0"  <?php if($row['isactive']==0) echo "checked";?>/>
				<?php echo CNO;?></td>
        </tr>
		 <tr>
			<td width="126" align="right" bgcolor="#EEEEEE"><strong>Fax</strong></td>
			<td>
				<input id = "txt_address" type="text" name="txt_fax" value="<?php echo $row['fax'];?>"/>
			<td align="right" bgcolor="#EEEEEE"><strong>Admin</strong></td>
			<td><?php echo $_SESSION[md5($_SERVER['HTTP_HOST']).'_USERLOGIN'];?></td>
        </tr>
		 <tr>
			<td width="126" align="right" bgcolor="#EEEEEE"><strong>Logo</strong></td>
			<td><input size="40" name="txtthumb" value="<?php echo $row['logo'];?>" type="text" /></td>
			<td><input name="txtid" type="hidden" id="txtid" value="<?php echo $row['partner_id']?>"/></td>
		</tr>
      </table>
      </fieldset>
    <br style="clear:both" />
    <strong><?php echo CINTRO;?></strong>
    <textarea name="txtintro" id="txtintro" cols="45" rows="5"><?php echo $row['intro'];?></textarea>
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