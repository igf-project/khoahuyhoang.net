<?php
defined("ISHOME") or die("Can't acess this page, please come back!");
$cur_date=date('Y-m-d');
$sql="SELECT count(*) as total FROM `tbl_product` where `cdate`='".$cur_date."%'";
$obj_sql=new CLS_MYSQL;
$obj_sql->Query($sql);
$r=$obj_sql->Fetch_Assoc();
$count=$r['total'];
$count++;
if(0<$count && $count<10)			
	$count='0'.$count;
$pro_code=SHOP_CODE.date('dmy').'-'.$count;
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
$(document).ready(function() {
	$("#txt_proname").blur(function(){
		if ($("#txt_proname").val()=="") {
			$("#txttitle_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập tên sản phẩm').fadeTo(900,1);
			});
		}
	});
	$("#txt_start_price").blur(function(){
		if ($("#txt_start_price").val()=="") {
			$("#txtprice_err").fadeTo(200,0.1,function()
			{ 
			  $(this).html('Vui lòng nhập giá nhập').fadeTo(900,1);
			});
		}
	});
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
	$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
});
$(document).ready(function() {
	$(".tab_content").hide();
	$(".tab_content:first").show(); 
	$("ul.tab_menu li").click(function() {
		$("ul.tab_menu li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn(); 
	});
});
</script>
<div class="info_contact"><!-- Thong tin ben phai -->
	<form id="frm_action" name="frm_action" method="post" action="">
    <div class="tab_dk">
		<ul class="tab_menu">
			<li rel="tab1" class="active">Thông tin sản phẩm</li>
			<li rel="tab2">Hình ảnh</li>
            <li rel="tab3">Tiêu đề</li>
		</ul>
    </div>
    <div style="clear: both;height: 20px;"></div>
	<div id="tab1" class="tab_content">
		<div id="contact_mb">
            <div class="item_ct">
			    <table width="100%" border="0" cellspacing="1" cellpadding="3" class='frm'>
				  <tr>
					<td  width="126" align="right" bgcolor="#EEEEEE"><strong>Nhóm sản phẩm<font color="red">*</font></strong></td>
					<td>
					  <select name="cbo_cata" id="cbo_cata">
						<?php 
						  if(!isset($objcata)) $objcata=new CLS_CATALOGS();
							echo $objcata->getListCate("option");
						?>
					  </select>
					</td>
					<td width="200" align="right" bgcolor="#EEEEEE"><strong>Nhà cung cấp<font color="red">*</font></strong></td>
					<td>
					  <select name="cbo_partner" id="cbo_partner" width="200">
						<?php 
						  $objpartner=new CLS_PARTNER();
						  $objpartner->getListPartner();
						?>
					  </select>
					</td>
				  </tr>
				  <tr>
					<td width='126' align="right" bgcolor="#EEEEEE"><strong>Mã sản phẩm</strong></td>
					<td><input id="txt_code" type="text" name="txt_code" value="<?php echo $pro_code;?>"/></td>
					<td width="126" align="right" bgcolor="#EEEEEE"><strong>Hãng sx<font color="red">*</font></strong></td>
						<td>
						  <select name="cbo_vendor" id="cbo_vendor">
							<option value='0'> Chọn hãng sx </option>
							<?php 
							  $objvendor=new CLS_VENDOR();
							  $objvendor->getListNCC();
							?>
						  </select>
					</td>					
				  </tr>
				  <tr>	
					<td align="right" bgcolor="#EEEEEE"><strong>Tên sản phẩm<font color="red">*</font></strong></td>
					<td>
					  <input name="txt_proname" type="text" id="txt_proname" size="35" />
					  <label id="txttitle_err" class="check_error"></label>
					</td>
					<td width='126' align="right" bgcolor="#EEEEEE"><strong>Ngày tạo</strong></td>
					<td><input id="date1" type="text" name="txtcreadate" value="<?php echo date("d-m-Y");?>"/></td>
				  </tr>
				  <tr>
					<td width="126" align="right" bgcolor="#EEEEEE"><strong>Kích cỡ<font color="red">*</font></strong></td>
					<td>
						<input id = "txt_size" type="text" name="txt_size" value="" size='35'/>
					</td>
					<td width='126' align="right" bgcolor="#EEEEEE"><strong>Ngày sửa</strong></td>
					<td><input id = "date2" type="text" name="txtmodifydate" value="<?php echo date("d-m-Y");?>"/></td>						
					</tr>
					<tr>
						<td align="right" bgcolor="#EEEEEE"><strong>Giá </strong></td>
						<td><input name="txt_oldprice" type="text" value='' />VNĐ</td>
						<td width='126' align="right" bgcolor="#EEEEEE"><strong>Tác giả</strong></td>
						<td><?php  echo  $_SESSION[md5($_SERVER['HTTP_HOST'])."_USERLOGIN"];?></td>							
					</tr>					
					<tr>
						<td align="right" bgcolor="#EEEEEE"><strong>Giá KM</strong></td>
						<td><input name="txt_curprice" type="text" value='' />VNĐ</td>
						<td align="right" bgcolor="#EEEEEE"><strong>isHot&nbsp;</strong></td>
						<td><input name="opt_hot" type="radio" id="radio" value="1" />
						  <?php echo CYES;?>
						  <input name="opt_hot" type="radio" id="radio2" value="0" checked='true' />
						  <?php echo CNO;?></td>	
					</tr>
					<tr>
						<td align="right" bgcolor="#EEEEEE"><strong>Số lượng:</strong></td>
						<td><input name="txt_quantity" type="text" value=''/> Sản phẩm</td>
						<td align="right" bgcolor="#EEEEEE"><strong>isActive</strong></td>
						<td><input name="optactive" type="radio" value="1"/>
						<?php echo CYES;?>
						<input name="optactive" type="radio" value="0" checked='true' />
						<?php echo CNO;?></td>		
					</tr>					
				  </table>
					<br style="clear:both" />
					<strong>Mô tả</strong>
					<textarea name="txtintro" id="txtintro" cols="45" rows="5"></textarea>
					 <script language="javascript">
							var oEdit2=new InnovaEditor("oEdit2");
							oEdit2.width="100%";
							oEdit2.height="100";
							oEdit2.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
							oEdit2.REPLACE("txtintro");
							document.getElementById("idContentoEdit2").style.height="100px";
					  </script>
					<br style="clear:both" />
					<strong><?php echo CFULLTEXT;?>&nbsp;</strong></legend>
					<textarea name="txtfulltext" id="txtfulltext" cols="45" rows="5"></textarea>
					<script language="javascript">
							var oEdit1=new InnovaEditor("oEdit1");
							oEdit1.width="100%";
							oEdit1.height="300";
							oEdit1.cmdAssetManager ="modalDialogShow('<?php echo ROOTHOST;?>admincp/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
							oEdit1.REPLACE("txtfulltext");
							document.getElementById("idContentoEdit1").style.height="225px";
					</script>
					<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;">
            </div>           
		</div>
	</div>
	<div id="tab2" class="tab_content">
        <div id="contact_mt"><div class="item_ct">
		<input type='hidden' name='txt_thumb' id='txt_thumb' style='width:100%' value=''/>
		<input type='hidden' name='txt_color' id='txt_color' style='width:100%' value=''/>
		<b>Thumb Images</b>
		<div id='imgs_thumb'>
			<div class='cnt'></div>
			<img class='no-img' src='' title='no image' alt='no image'/>
		</div>
		<b>Color Images</b>
		<div id='imgs_color'>
			<div class='cnt'></div>
			<img class='no-img' src='' title='no image' alt='no image'/>
		</div>
		<div id='frm_add'><input type='hidden' value='' id='img_type'/>
			<input type='text' style='width:100%' id='img_source' placeholder='http://'/><br/>
			<input type='text' style='width:100%' id='img_title' placeholder='title'/><br/>
			<input type='text' style='width:100%' id='img_alt' placeholder='alt'/><br/>
			<input type='button' value='Ok!' id='cmd_imgadd'/>
			<input type='button' value='Close' id='cmd_imgclose'/>
		</div>
        </div></div>
		<div class='clr'></div>
		<style type='text/css'>
			#imgs_thumb,imgs_color{clear:both;overflow:hidden;}
			#imgs_thumb{border-bottom:#ccc 1px solid;}
			#imgs_thumb img,#imgs_color img{width:60px; height:60px; float:left; margin:5px; display:inline-block;border:#ddd 1px solid;cursor:pointer}
			#frm_add{width:300px;padding:11px;overflow:hidden; border:#999 1px solid;position:absolute;z-index:100;display:none;background:#fff;box-shadow:0px 0px 7px #333;}
		</style>
		<script type='text/javascript'>
		var imgclick;
		$('#imgs_thumb .no-img').click(function(){
			$('#frm_add').show();
			$('#img_type').val('thumb');
			$('#frm_add #img_source').val('');
			$('#frm_add #img_title').val('');
			$('#frm_add #img_alt').val('');
		})
		$('#imgs_color .no-img').click(function(){
			$('#frm_add').show();
			$('#img_type').val('color');
			$('#frm_add #img_source').val('');
			$('#frm_add #img_title').val('');
			$('#frm_add #img_alt').val('');
		})
		$('#frm_add #cmd_imgclose').click(function(){$('#frm_add').hide();});
		$('#frm_add #cmd_imgadd').click(function(){
			$('#frm_add').hide();
			if($('#img_type').val()=='thumb'){
				newimg="<img onclick='edit_img(this);' src='"+$('#frm_add #img_source').val()+"' title='"+$('#frm_add #img_title').val()+"' alt='"+$('#frm_add #img_alt').val()+"'/>";
				$('#imgs_thumb .cnt').html($('#imgs_thumb .cnt').html()+newimg);
			}
			if($('#img_type').val()=='color'){
				newimg="<img onclick='edit_img(this);' src='"+$('#frm_add #img_source').val()+"' title='"+$('#frm_add #img_title').val()+"' alt='"+$('#frm_add #img_alt').val()+"'/>";
				$('#imgs_color .cnt').html($('#imgs_color .cnt').html()+newimg);
			}
			if($('#img_type').val()==''){
				$(imgclick).attr('src',$('#frm_add #img_source').val());
				$(imgclick).attr('title',$('#frm_add #img_title').val());
				$(imgclick).attr('alt',$('#frm_add #img_alt').val());
			}
			getImg();
		});
		function edit_img(img){
			imgclick=img;
			$('#frm_add').show();
			$('#img_type').val('');
			$('#frm_add #img_source').val($(img).attr('src'));
			$('#frm_add #img_title').val($(img).attr('title'));
			$('#frm_add #img_alt').val($(img).attr('alt'));
		}
		function getImg(){
			var imgs=$('#imgs_thumb .cnt').find('img');
			var strimg='';
			for(i=0;i<imgs.length;i++){
				strimg+=$(imgs[i]).attr('src')+','+$(imgs[i]).attr('title')+','+$(imgs[i]).attr('alt');
				strimg+='|';
			}
			$('#txt_thumb').val(strimg);
			var imgs=$('#imgs_color .cnt').find('img');
			var strimg='';
			for(i=0;i<imgs.length;i++){
				strimg+=$(imgs[i]).attr('src')+','+$(imgs[i]).attr('title')+','+$(imgs[i]).attr('alt');
				strimg+='|';
			}
			$('#txt_color').val(strimg);
		}
		</script>
    </div>    
    <div id="tab3" class="tab_content">
        <div id="contact_mn"><div class="item_ct">
		<strong>Meta Title (Tiêu đề trang)</strong><br> 
		<div style="color:red"><span id="count_title">0</span> / 70 ký tự</div>
		<textarea name="meta_title" id="meta_title" style="width:100%" rows="2" maxlength="255"></textarea>
		<strong>Meta Description (Mô tả trang)</strong><br> 
		<div style="color:red"><span id="count_desc">0</span> / 170 ký tự</div>
		<textarea name="meta_desc" id="meta_desc" style="width:100%" rows="4" maxlength="255"></textarea>
		<strong>Meta Keywords (Từ khóa)</strong><br> 
		<textarea name="meta_key" id="meta_key" style="width:100%" rows="2" maxlength="255"></textarea>
		<strong> Meta Canonical (URL chính, trong TH trùng lặp ND)</strong><br>
		<textarea name="meta_canon" id="meta_canon" style="width:100%" rows="2" maxlength="255"></textarea>
		</div></div>
     </div>
  </form>
</div>
</div>