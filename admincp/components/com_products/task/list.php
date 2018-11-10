<?php
	defined('ISHOME') or die('Can not acess this page, please come back!');
	$keyword='Keyword';	$action='';	$catid=''; $to_date=''; $from_date='';
	
	if(!isset($_SESSION['EDU_CONTENT_CATID'])) $_SESSION['EDU_CONTENT_CATID']='';
	if(!isset($_SESSION['TODATE'])) $_SESSION['TODATE']='';
	if(!isset($_SESSION['FROMDATE'])) $_SESSION['FROMDATE']='';
	if(!isset($_SESSION['PARTNER'])) $_SESSION['PARTNER']='';
	if(!isset($_SESSION['EDU_CONTENT_ACT'])) $_SESSION['EDU_CONTENT_ACT']='';
	
	if(isset($_POST['txtkeyword'])){
		$keyword=trim($_POST['txtkeyword']);
		// $to_date=date('Y-m-d',strtotime($_POST['txt_todate']));
		// $from_date=date('Y-m-d',strtotime($_POST['txt_fromdate']));
		$_SESSION['EDU_CONTENT_ACT']=$_POST['cbo_active'];
		$_SESSION['EDU_CONTENT_CATID']=$_POST['cbo_cont'];
		// $_SESSION['PARTNER']=$_POST['cbo_partner'];
		$_SESSION['TODATE']=date('d-m-Y',strtotime($to_date));
		$_SESSION['FROMDATE']=date('d-m-Y',strtotime($from_date));
	}
	$catid = $_SESSION['EDU_CONTENT_CATID'];
	$action = $_SESSION['EDU_CONTENT_ACT'];
	// $partner=$_SESSION['PARTNER'];
	
	$strwhere='';
	if($keyword!='' && $keyword!='Keyword')
		$strwhere.=" AND ( `name` like '%$keyword%' OR `meta_title` like '%$keyword%')";
	// if($to_date!='1970-01-01' && $to_date!=''&& $from_date!='1970-01-01' && $from_date!='')
	// 	$strwhere.=" AND `cdate` between '$to_date' AND '$from_date' ";
	if($catid!='' && $catid!='all')
		$strwhere.=" AND `cat_id` = '$catid' ";
	// if($partner!='' && $partner!='all')
	// 	$strwhere.=" tbl_product.partner_id = '$partner' ";
	if($action!='' && $action!='all' )
		$strwhere.=" AND tbl_product.isactive = '$action'";
	// if($strwhere!='') $strwhere=' AND 1=1 '.$strwhere;
	//echo $strwhere;
	if(!isset($_SESSION['CUR_PAGE_PRO']))
		$_SESSION['CUR_PAGE_PRO']=1;
	if(isset($_POST['txtCurnpage'])){
		$_SESSION['CUR_PAGE_PRO']=$_POST['txtCurnpage'];
	}
	$obj->getList($strwhere,'');
	$total_rows=$obj->Num_rows();
	if($_SESSION['CUR_PAGE_PRO']>ceil($total_rows/MAX_ROWS))
		$_SESSION['CUR_PAGE_PRO']=ceil($total_rows/MAX_ROWS);
	$cur_page=($_SESSION['CUR_PAGE_PRO']<1)?1:$_SESSION['CUR_PAGE_PRO'];
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
  $(function() {
	$( "#date1" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});
	$(function() {
		$( "#date2" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});
</script>
  <form id="frm_list" name="frm_list" method="post" action="">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="Header_list">
      <tr>
        <td><strong><?php echo SEARCH;?>:</strong>
            <input type="text" name="txtkeyword" id="txtkeyword" value="<?php echo $keyword;?>" onfocus="onsearch(this,1);" onblur="onsearch(this,0)" />&nbsp;         
			<input type="submit" name="button" id="button" value="<?php echo SEARCH;?>" class="button" size='30'/>
		</td>
        <td align="right">
        <label>		 
		  &nbsp; &nbsp;
        <select name="cbo_cont" id="cbo_cont" onchange="document.frm_list.submit();">
          <option value="all">Tìm theo nhóm sản phẩm</option>
              <?php 
			  if(!isset($objcata))
			  	$objcata=new CLS_CATALOGS;
			  	echo $objcata->getListCate(0,"");
			  ?>
          <script language="javascript">
			cbo_Selected('cbo_cont','<?php echo $catid;?>');
          </script>
        </select>
        </label>&nbsp; &nbsp;
        <select name="cbo_active" id="cbo_active" onchange="document.frm_list.submit();">
          <option value="all"><?php echo MALL;?></option>
          <option value="1"><?php echo MPUBLISH;?></option>
          <option value="0"><?php echo MUNPUBLISH;?></option>
          <script language="javascript">
			cbo_Selected('cbo_active','<?php echo $action;?>');
            </script>
        </select></td>
      </tr>
    </table>
	<div style="clear:both;height:10px;"></div>
    <table width="100%" border="0" cellspacing="0" cellpadding="3" class="list">
      <tr class="header">
        <th width="30" align="center">#</th>
        <th width="30" align="center"><input type="checkbox" name="chkall" id="chkall" value="" onclick="docheckall('chk',this.checked);" /></th>
        <th align="center">Mã sản phẩm</th>
        <th align="center">Tên sản phẩm</th>
        <th width="180" align="center">Nhóm sản phẩm</th>
		<th width="150" align="center">Nhà cung cấp</th>
        <th align="center" width="100">Giá sản phẩm</th>
        <th align="center" width="90"><?php echo CVISITED;?></th>
        <th width="30" align="center"><?php echo CORDER;?>
			<a href="javascript:saveOrder()">
				<img src="templates/default/images/save.png" border="0" width="13" alt="Save" longdesc="#" />
			</a>
        </th>
		<th width="30" align="center">isHot</th>
        <th width="30" align="center"><?php echo CACTIVE;?></th>
        <th width="30" align="center"><?php echo CEDIT;?></th>
        <th width="30" align="center"><?php echo CDELETE;?></th>
      </tr>
      <?php 
	  $obj->listTablePro($strwhere,$cur_page);
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