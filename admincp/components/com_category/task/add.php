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
        <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" size="40">
          <label id="txtname_err" class="check_error"></label>
          <input name="txttask" type="hidden" id="txttask" value="1" />
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPAR_ID;?>&nbsp;</strong></td>
        <td>
            <select name="cbo_cate" id="cbo_cate">
              <option value="0" selected="selected" style="background-color:#eeeeee; font-weight:bold">Root</option>
               <?php
                if(!isset($objCate))
                $objCate=new CLS_CATE();
                $objCate->ListCategory(0,0,0,1);
               ?>
              <script language="javascript">
			  cbo_Selected('cbo_cate','<?php echo $objcate->ParID;?>');
			  </script>
            </select></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" checked><?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0"><?php echo CNO;?></td>
      </tr>
    </table>
    <strong>Meta Title (Tiêu đề trang)</strong><br> 
	<div style="color:red"><span id="count_title">0</span> / 70 ký tự</div>
	<textarea name="meta_title" id="meta_title" style="width:100%" rows="2" maxlength="255"></textarea>
	<strong>Meta Description (Mô tả trang)</strong><br> 
	<div style="color:red"><span id="count_desc">0</span> / 170 ký tự</div>
	<textarea name="meta_desc" id="meta_desc" style="width:100%" rows="4" maxlength="255"></textarea>
	<strong>Meta Keywords (Từ khóa)</strong><br> 
	<textarea name="meta_key" id="meta_key" style="width:100%" rows="2" maxlength="255"></textarea>
    <input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>