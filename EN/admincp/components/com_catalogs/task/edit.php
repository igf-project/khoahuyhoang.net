<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$id="";
if(isset($_GET["id"]))
	$id=$_GET["id"];
$obj->getList(' And cat_id='.$id,' limit 0,1');
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

	$(".tab_content").hide();
	$(".tab_content:first").show(); 
	$("ul.tab_menu li").click(function() {
		$("ul.tab_menu li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn(); 
	});	
})
 </script>
  <form id="frm_action" name="frm_action" method="post" action="">
	<div class="tab_dk">
		<ul class="tab_menu">
			<li rel="tab1" class="active">Thông tin sản phẩm</li>
            <li rel="tab2" class="">Meta Data</li>
		</ul>
    </div>
	<div style="clear: both;height: 20px;"></div>
	<div id="tab1" class="tab_content">
    <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:#CCC 1px solid;">
      <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong><?php echo CNAME;?> <font color="red">*</font></strong></td>
        <td>
          <input name="txtname" type="text" id="txtname" value="<?php echo $row['name'];?>" size="40">
          <label id="txtname_err" class="check_error"></label>
	      <input type="hidden" name="txtid" id="txtid" value="<?php echo $row['cat_id'];?>"></td>
      </tr>
	  <tr>
        <td width="150" align="right" bgcolor="#EEEEEE"><strong>Ảnh</strong></td>
        <td>
          <input name="txtthumb" type="text" id="txtthumb" value="<?php echo $row['thumb'];?>" size="40">
          <a href="#" onclick="OpenPopup('extensions/upload_image.php');">Chọn</a>
		  <label id="txtthumb_err" class="check_error"></label>
		</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#EEEEEE"><strong><?php echo CPAR_ID;?>&nbsp;</strong></td>
        <td>
            <select name="cbo_cate" id="cbo_cate">
              <option value="0" selected="selected"  style="background-color:#eeeeee; font-weight:bold">
              <?php echo "Root";?></option>
               <?php
                if(!isset($objCata))
                $objCata=new CLS_CATALOGS();
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
    <fieldset>
    <legend><strong><?php echo CDESC;?>:</strong></legend>
            <textarea name="txtdesc" id="txtdesc" cols="45" rows="5"><?php echo $row['intro'];?></textarea>
        	<script language="javascript">
				var oEdit1=new InnovaEditor("oEdit1");
				oEdit1.width="100%";
				oEdit1.height="100";
				oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
				oEdit1.REPLACE("txtdesc");
				document.getElementById("idContentoEdit1").style.height="450px";
			</script>
    </fieldset>
	</div>
	<div id="tab2" class="tab_content">
		<strong>Meta Title (Tiêu đề trang)</strong><br> 
		<div style="color:red"><span id="count_title">0</span> / 70 ký tự</div>
		<textarea name="meta_title" id="meta_title" style="width:100%" rows="2" maxlength="255"><?php echo $row['meta_title'];?></textarea>
		<strong>Meta Description (Mô tả trang)</strong><br> 
		<div style="color:red"><span id="count_desc">0</span> / 170 ký tự</div>
		<textarea name="meta_desc" id="meta_desc" style="width:100%" rows="4" maxlength="255"><?php echo $row['meta_desc'];?></textarea>
		<strong>Meta Keywords (Từ khóa)</strong><br> 
		<textarea name="meta_key" id="meta_key" style="width:100%" rows="2" maxlength="255"><?php echo $row['meta_key'];?></textarea>
	</div>
	<script>
	var num = $('#meta_title').val().length;
	$('#count_title').html(num);
	num = $('#meta_desc').val().length;
	$('#count_desc').html(num);
	</script>
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
  </form>
</div>