<?php
ini_set('display_errors',1);
	defined("ISHOME") or die("Can't acess this page, please come back!");
	$id="";
	if(isset($_GET["id"]))
		$id=$_GET["id"];
	$obj->getList(' AND cat_id='.$id,' limit 0,1');
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
	<div>Những mục đánh dấu <font color="red">*</font> là yêu cầu bắt buộc.</div>
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" value="<?php echo $row['name'];?>" size="40">
          <label id="txtname_err" class="check_error"></label>
	      <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['cat_id'];?>"></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPAR_ID;?>&nbsp;</strong></td>
        <td>
            <select name="cbo_cate" id="cbo_cate">
              <option value="0" selected="selected"  style="background-color:#eeeeee; font-weight:bold">
              <?php echo "Root";?></option>
               <?php
                if(!isset($obj))
                $obj=new CLS_CATE();
                $obj->ListCategory($id,$row['par_id'],0,1);
               ?>
            </select></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPUBLIC;?>&nbsp;</strong></td>
        <td>
        <input name="optactive" type="radio" id="radio" value="1" <?php if($row['isactive']==1) echo "checked";?>>
			<?php echo CYES;?>
        <input name="optactive" type="radio" id="radio2" value="0" <?php if($row['isactive']==0) echo "checked";?>>
			<?php echo CNO;?></td>
      </tr>
    </table>
	<strong>Meta Title (Tiêu đề trang)</strong><br> 
	<div style="color:red"><span id="count_title">0</span> / 70 ký tự</div>
	<textarea name="meta_title" id="meta_title" style="width:100%" rows="2" maxlength="255"><?php echo $row['meta_title'];?></textarea>
	<strong>Meta Description (Mô tả trang)</strong><br> 
	<div style="color:red"><span id="count_desc">0</span> / 170 ký tự</div>
	<textarea name="meta_desc" id="meta_desc" style="width:100%" rows="4" maxlength="255"><?php echo $row['meta_desc'];?></textarea>
	<strong>Meta Keywords (Từ khóa)</strong><br> 
	<textarea name="meta_key" id="meta_key" style="width:100%" rows="2" maxlength="255"><?php echo $row['meta_key'];?></textarea>
	<script>
	var num = $('#meta_title').val().length;
	$('#count_title').html(num);
	num = $('#meta_desc').val().length;
	$('#count_desc').html(num);
	</script>
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>