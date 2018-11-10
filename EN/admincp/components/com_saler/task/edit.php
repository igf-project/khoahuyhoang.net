<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=$_GET["id"];
$obj->getList(' And sale_id='.$id,' limit 0,1');
$row=$obj->Fetch_Assoc();
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
		if( $(this).val()==''){
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
  <fieldset>
   <legend><strong><?php echo CDETAIL;?>&nbsp;</strong></legend>
		<table width="100%" border="0" cellspacing="1" cellpadding="3">
      
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Tên saler<font color="red">*</font></strong></td>
			<td><input name="txtid" type="hidden" id="txtid" value="<?php echo $row['sale_id']?>"/><input name="txt_ctyname" type="text" id="txt_ctyname" size="35" value="<?php echo $row['cty_name']?>"/><label id="txttitle_err" class="check_error"></label></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Người đại diện<font color="red">*</font></strong></td>
			<td>
			  <input name="txt_ncontact" type="text" id="txt_name" size="35" value="<?php echo $row['name_contact']?>"/>
			  <label id="txttitle_err" class="check_error"></label></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Đại chỉ <font color="red">*</font></strong></td>
			<td><input id = "txt_address" type="text" name="txt_address" value="<?php echo $row['address']?>" /></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Tel<font color="red">*</font></strong></td>
			<td><input id = "txt_address" type="text" name="txt_tel" value="<?php echo $row['tel']?>"/></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Điện thoại bàn</strong></td>
			<td><input name="txt_phone" type="text"  value="<?php echo $row['phone']?>"/></td>
			<td align="right" bgcolor="#EEEEEE"><strong>Email</strong></td>
			<td><input name="txt_email" type="text" id="txt_email" size="35" value="<?php echo $row['email']?>"/>
			<label id="txtcode_err" class="check_error"></label></td>
        </tr>
		 <tr>
			<td width="126" align="right" bgcolor="#EEEEEE"><strong>Fax</strong></td>
			<td>
				<input id = "txt_address" type="text" name="txt_fax" value='<?php echo $row['fax'];?>' />
			</td>
				<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
				<td><input name="optactive" type="radio" value="1" <?php if($row['isactive']==1) echo 'checked';?> />
				<?php echo CYES;?>
				<input name="optactive" type="radio" value="0" <?php if($row['isactive']==0 )echo 'checked'; ?> />
				<?php echo CNO;?></td>
        </tr>
		<tr>
			<td align="right" bgcolor="#EEEEEE"><strong>Ai Sửa</strong></td>
			<td><?php echo $_SESSION['IGFUSERLOGIN'];?></td>			
        </tr>
      </table>
      </fieldset>
    <br style="clear:both" />
    <strong><?php echo CINTRO;?></strong>
    <textarea name="txt_intro" id="txtintro" cols="45" rows="5"><?php echo $row['intro'];?></textarea>
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