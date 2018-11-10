<?php
ini_set('display_errors',0);
$COM='members';
?>
<div class='content'>
<div id="col_main">
	<div class='content' style='padding:11px;'>
	<?php $this->LoadModule('user1');?>
	<?php
	$viewtype='';
	if(isset($_GET['viewtype'])){
		$viewtype=addslashes($_GET['viewtype']);
	}
	if(is_file(COM_PATH.'com_'.$COM.'/tem/'.$viewtype.'.php'))
		include_once('tem/'.$viewtype.'.php');	
	unset($viewtype); unset($obj); unset($COM);
	?>
	</div>
</div>
<div id="col_right">
	<div class='content' style='padding:10px;'>
	<?php
	$objsaler=new CLS_SALER;
	if($objsaler->isLogin()){
	?>
	<div class='module private'>
		<div class='Avata'>&nbsp;</div>
		<ul>
			<li><a href="<?php echo ROOTHOST;?>thong-tin-ca-nhan.html">Thông tin</a></li>
			<li><a href="<?php echo ROOTHOST;?>danh-sach-don-hang.html">Dạnh sách đơn hàng</a></li>
			<li><a href="<?php echo ROOTHOST;?>danh-sach-san-pham.html">Sản phẩm mới</a></li>
			<li><a href="<?php echo ROOTHOST;?>danh-sach-thanh-viet.html">Thành viên</a></li>
			<li>lịch sử giao dịch</li>
			<li>Thống kê?</li>
		</ul>
	</div>
	<?php 
	}
	$this->LoadModule('right');?>
	</div>
</div>
<div class='clr'></div>
</div>