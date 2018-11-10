<?php
include_once(libs_path.'cls.menu.php');
$obj_mnulang=new LANG_MENU;	
$check_isadmin = $UserLogin->isAdmin();
if(isset($_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID']))
$userlogin=$_SESSION[MD5($_SERVER['HTTP_HOST']).'_USERID'];
?>
<div id="navitor">
<?php if($UserLogin->isLogin()){?>
<ul>
	<li>
		<a href="index.php" class="active"><span><?php echo $obj_mnulang->SYSTEM;?></span></a>
		<ul class="submenu">
			<?php if($check_isadmin==true){?>
			<li><a href="index.php?com=config"><span>Cấu hình website</span></a></li>
			<li><a href="index.php?com=gusers"><span>Nhóm users</span></a></li>
			<li><a href="index.php?com=users"><span>Quản lý users</span></a></li>
			<?php }?>
			<li><a href="index.php?com=users&task=edit&id=<?php echo $userlogin;?>"><span>Thông tin cá nhân</span></a></li>
			<li class="space"><a href="index.php?com=users&task=changepass&id=<?php echo $userlogin;?>"><span>Đổi mật khẩu</span></a></li>
			<li><a href="index.php?com=users&task=logout"><span><?php echo $obj_mnulang->LOGOUT;?></span></a></li>
		</ul>
	</li>
	<li>
		<a href="#"><span>Quản lý menu</span></a>
		<ul class="submenu">
			<li><a href="index.php?com=menus&task=add"><span>Thêm menu</span></a></li>
			<li class="space" ><a href="index.php?com=menus"><span>Quản lý menu</span></a></li>
			<?php $objmnu=new CLS_MENU();	echo $objmnu->getListmenu("list");	unset($objmnu);	?>
		</ul>
	</li>
	<li>
		<a href="#"><span>Quản lý bài viết</span></a>
		<ul class="submenu">
			<li class="space"><a href="index.php?com=category"><span>Danh sách nhóm tin</span></a></li>
			<?php // ?>
			<li><a href="index.php?com=contents&task=add"><span>Thêm bài viết</span></a></li>	
			<li><a href="index.php?com=contents"><span>Danh sách bài viết</span></a></li>
			<?php ?>
		</ul>
	</li>
	<li>
		<a href="#"><span>Quản lý sản phẩm</span></a>
		<ul class="submenu">
			<li class="space"><a href="index.php?com=catalogs"><span>Danh sách nhóm SP</span></a></li>
			<?php // ?>
			<li><a href="index.php?com=products&task=add"><span>Thêm sản phẩm</span></a></li>	
			<li><a href="index.php?com=products"><span>Danh sách sản phẩm</span></a></li> 
			<?php ?>
		</ul>
	</li>
	<li>
            <a href="#"><span>Dự án</span></a>
            <ul class="submenu">
                <li><a href="index.php?com=ablum&task=add"><span>Thêm nhóm dự án</span></a></li>
                <li><a href="index.php?com=ablum"><span>DS nhóm dự án</span></a></li>
                <li><a href="index.php?com=gallery&task=add"><span>Thêm dự án</span></a></li>
                <li><a href="index.php?com=gallery"><span>DS dự án</span></a></li>
            </ul>
        </li>
	<li>
		<a href="index.php?com=module"><span>Quản lý chức năng</span></a>
	</li>
	<li>
		<a href="#"><span><?php echo MHELP;?></span></a>
		<ul class="submenu">
			<li><a href="index.php?com=about"><span><?php echo MABOUT;?></span></a></li>
			<li class="space"><a href="index.php?com=version"><span><?php echo MVERSTION;?></span></a></li>
			<li><a href="index.php?com=help"><span><?php echo MHELP;?></span></a></li>
		</ul>
	</li>
</ul>
<?php }?>
</div>