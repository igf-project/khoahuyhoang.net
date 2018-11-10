<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	define('COMS','config');
	if($check_isadmin==false) die('Bạn không có quyền truy cập.');
?>
<script language="javascript" src="../js/checkform.js"></script>
<script language="javascript">
	function checkinput() {
		var  email = document.getElementById('email_contact');
		var  title = document.getElementById('meta_title');
		
		if(title.value=='') {
			alert('Vui lòng nhập đầy đủ thông tin cấu hình. Các thông tin sẽ này ảnh hưởng đến việc hiển thị trên website');
			title.focus();
			return false;
		}
		//if(email.value!='' && !checkEmail(email.value)){email.focus();return false;}
		return true;
	}
</script>
	<div id="menus" class="toolbars">
	  <form id="frm_menu" name="frm_menu" method="post" action="">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><h2 style="margin:0px; padding:0px;">THÔNG TIN CẤU HÌNH WEBSITE</h2></td>
            <label>
			  <input type="hidden" name="txtids" id="txtids" />
			  <input type="hidden" name="txtaction" id="txtaction" />
			</label>
            </td>
			<td align="right">
			<ul>
                <li><a class="save"  href="#" onclick="dosubmitAction('frm_action','save');" title="<?php echo MSAVE;?>"><?php echo MSAVE;?></a></li>
                <li><a class="help"  href="index.php?com=<?php echo COMS;?>&task=help" title="<?php echo MHELP;?>"><?php echo MHELP;?></a></li>
            </ul>
			</td>
		  </tr>
		</table>
	  </form>
	</div>
<?php
$title =''; $desc=''; $key='';$email_contact=''; $nickyahoo=''; $nameyahoo='';
$footer=''; $contact=''; $banner=''; $gallery=''; $logo='';
include_once('libs/cls.configsite.php');
$obj = new CLS_CONFIG();
if(isset($_POST['meta_title']) && $_POST['meta_title']!='') {
	
	if($_POST['meta_title']!='') 	$obj->Title = addslashes($_POST['meta_title']);
	if($_POST['meta_desc']!='') 	$obj->Meta_descript = addslashes($_POST['meta_desc']);
	if($_POST['meta_key']!='') 		$obj->Meta_keyword = addslashes($_POST['meta_key']);

	if($_POST['email_contact']!='') $obj->Email = addslashes($_POST['email_contact']);
	if($_POST['txtlogo']!='') 		$obj->Logo = addslashes($_POST['txtlogo']);
	if($_POST['txtnickyahoo']!='') 	$obj->Nickyahoo = addslashes($_POST['txtnickyahoo']);
	if($_POST['txtnameyahoo']!='') 	$obj->Nameyahoo = addslashes($_POST['txtnameyahoo']);
	
	if($_POST['txtcontact']!='')	$obj->Contact = addslashes($_POST['txtcontact']);
	if($_POST['txtfooter']!='')  	$obj->Footer = addslashes($_POST['txtfooter']);
	if($_POST['txtphone']!='')  	$obj->Phone = addslashes($_POST['txtphone']);
		
	$obj->Update();	
}	 
$obj->getList();
if($obj->Num_rows()<=0) {
	echo 'Dữ liệu trống.';
}
else{
	$row = $obj->Fetch_Assoc();
	$title 			= stripslashes($row['title']);
	$desc  			= stripslashes($row['meta_descript']);
	$key 			= stripslashes($row['meta_keyword']);
	$email_contact 	= stripslashes($row['email']);
	$logo		 	= stripslashes($row['logo']);
	$phone			= stripslashes($row['phone']);
	$contact		= stripslashes($row['contact']);
	$footer 		= stripslashes($row['footer']);
	$nickyahoo		= stripslashes($row['nick_yahoo']);
	$nameyahoo 		= stripslashes($row['name_yahoo']);
}
unset($obj);
?>
<div id='action'>
<form name="frm_action" id="frm_action" action="" method="post">
  <table width="100%" border="0" cellpadding="5" cellspacing="0">
    <tr>
      <td colspan="2"><strong>Các thông tin cấu hình yêu cầu nhập đầy đủ trước khi lưu trữ. </strong></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CCCCCC"><strong>Cấu hình website</strong></td>
    </tr>
    <tr>
      <td width="18%">Tiêu đề Website: <span style="color:red"><span id="count_title">0</span> / 70 ký tự </span></td>
      <td width="82%"><textarea name="meta_title" style="width:100%" rows="2" id="meta_title" maxlength="255"><?php echo $title; ?></textarea></td>
    </tr>
    <tr>
      <td>Mô tả Website: <span style="color:red"><span id="count_desc">0</span> / 170 ký tự </span></td>
      <td><textarea name="meta_desc" id="meta_desc" rows="4" style="width:100%" maxlength="255"><?php echo $desc; ?></textarea></td>
    </tr>
    <tr>
      <td>Từ khóa (Keywords):</td>
      <td><textarea name="meta_key" id="meta_key" rows="4" style="width:100%" maxlength="255"><?php echo $key; ?></textarea></td>
    </tr>
	<script>
	var num = $('#meta_title').val().length;
	$('#count_title').html(num);
	num = $('#meta_desc').val().length;
	$('#count_desc').html(num);
	</script>
    <tr>
      <td>Email liên hệ:</td>
      <td><input name="email_contact" type="text" id="email_contact" value="<?php echo $email_contact; ?>" size="30" /></td>
    </tr>
    <tr>
      <td>Số điện thoại:</td>
      <td><input name="txtphone" type="text" id="txtphone" value="<?php echo $phone; ?>" size="30" /></td>
    </tr>
	<tr>
       <td colspan="2" bgcolor="#CCCCCC"><strong>Hỗ trợ trực tuyến (danh sách cách nhau bởi dấu ,) </strong></td></tr>
    <tr>
      <td>Tên Nick Yahoo </td>
      <td><input name="txtnickyahoo" type="text" id="txtnickyahoo" style="width:100%;" value="<?php echo $nickyahoo; ?>"></td>
    </tr>
    <tr>
      <td>Tiêu đề Nick Yahoo</td>
      <td><input name="txtnameyahoo" type="text" id="txtnameyahoo"  style="width:100%;" value="<?php echo $nameyahoo; ?>"></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CCCCCC"><strong>Logo</strong></td></tr>
    <tr>
      <td colspan="2" align="center">
      <textarea name="txtlogo" id="txtlogo" cols="45" rows="5"><?php echo $logo; ?></textarea>
        <script language="javascript">
			var oEdit3=new InnovaEditor("oEdit3");
			oEdit3.width="100%";
			oEdit3.height="100";
			oEdit3.cmdAssetManager ="modalDialogShow('<?php echo EDI_PATH;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
			oEdit3.REPLACE("txtlogo");
		</script>
      </td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#CCCCCC"><strong>Thông tin liên hệ (trong mục Liên hệ)</strong></td></tr>
    <tr>
      <td colspan="2" align="center">
      <textarea name="txtcontact" id="txtcontact" cols="45" rows="5"><?php echo $contact; ?></textarea>
        <script language="javascript">
			var oEdit1=new InnovaEditor("oEdit1");
			oEdit1.width="100%";
			oEdit1.height="100";
			oEdit1.cmdAssetManager ="modalDialogShow('<?php echo EDI_PATH;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
			oEdit1.REPLACE("txtcontact");
		</script>
      </td>
    </tr>
    <tr>
       <td colspan="2" bgcolor="#CCCCCC"><strong>Thông tin liên hệ (Footer - Phía cuối trang)</strong></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <textarea name="txtfooter" id="txtfooter" cols="45" rows="5"><?php echo $footer; ?></textarea>
        <script language="javascript">
			var oEdit2=new InnovaEditor("oEdit2");
			oEdit2.width="100%";
			oEdit2.height="100";
			oEdit2.cmdAssetManager ="modalDialogShow('<?php echo EDI_PATH;?>/extensions/editor/innovar/assetmanager/assetmanager.php',640,465)";
			oEdit2.REPLACE("txtfooter");
		</script>
      </td>
    </tr>
	<input type="submit" name="cmdsave" id="cmdsave" value="Submit" style="display:none;" />
  </table>
</form>
</div>