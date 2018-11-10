<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$action=''; $albumid =0;
	$strwhere='';
	if (isset($_GET['albumid'])) {
		$albumid =$_GET['albumid'];
		$strwhere.=" AND `album_id` = '$albumid'";
	}
	if (isset($_POST['cboid']) && $_POST['cboid']!='all' && $_POST['cboid']!='') {$albumid = $_POST['cboid']; $strwhere.=" AND `album_id` = '$albumid'";}
	if (isset($_POST['cbo_active']) && $_POST['cbo_active']!='all') { $action = $_POST['cbo_active']; $strwhere.=" AND g.`isactive` = ".$_POST['cbo_active'];}
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_GALLERY']))
		$_SESSION['CUR_PAGE_GALLERY']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_GALLERY']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_GALLERY']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_GALLERY']=ceil($total_rows/MAX_ROWS);
	$cur_page=$_SESSION['CUR_PAGE_GALLERY'];
?>
<div id="list">
  <script language="javascript">
  function checkinput()
  {
	  var strids=document.getElementById("txtids");
	  if(strids.value=="")
	  {
		  alert('You are select once record to action');
		  return false;
	  }
	  return true;
  }
  </script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td>
        </td>
        <td align="right">
          <select name="cboid" id="cboid" onchange="document.frm_list.submit();">
          	<option value="">Hiện tất cả</option>
          	<?php $obj->listAlbum($albumid);?>
          </select>
          <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
          	<option value="all"><?php echo MALL;?></option>
            <option value="1"><?php echo MPUBLISH;?></option>
            <option value="0"><?php echo MUNPUBLISH;?></option>
            <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
            </script>
          </select>
        </td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <td width="30" align="center">#</td>
        <td width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></td>
        <td align="center">Thư mục ảnh</td>
        <td align="center">Ảnh đại diện</td>
        <td align="center">Tên dự án</td>
		<td align="center">Giới thiệu</td>
		<td align="center">Lượt xem</td>
		<td align="center"><?php echo CORDER;?>
			<a href="javascript:saveOrder()">
				<img src="templates/default/images/save.png" border="0" width="13" alt="Save" longdesc="#" />
			</a>
		</td>
        <td width="50" align="center"><?php echo CACTIVE;?></td>
        <td width="50" align="center"><?php echo CEDIT;?></td>
        <td width="50" align="center"><?php echo CDELETE;?></td>
      </tr>
      <?php
	  $obj->listTable($strwhere,$cur_page);
	  ?>
      
    </table>
  </form>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Footer_list">
      <tr>
        <td align="center">	  
        <?php 
            paging($total_rows,MAX_ROWS,$cur_page);
        ?>
        </td>
      </tr>
  </table>
</div>
<?php //----------------------------------------------?>