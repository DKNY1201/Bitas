<!-- BEGIN SIDEBAR -->
<div class="page-sidebar nav-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->        
	<ul class="page-sidebar-menu">
		<li class="toggle-menu">
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class="sidebar-toggler hidden-phone"></div>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
		</li>
		<li class="start <?php if($p==''){ echo 'active';}?>">
			<a href="index.php">
				<i class="icon-home"></i> 
				<span class="title">Dashboard</span>
				<?php if($p==''){?><span class="selected"></span><?php } ?>
			</a>
		</li>
		<li class="<?php if($p=='tintuc_list' || $p=='tintuc_them' || $p=='tintuc_sua'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="fa fa-newspaper-o"></i> 
				<span class="title">Tin tức</span>
				<span class="arrow "></span>
				<?php if($p=='tintuc_list'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if($p=='tintuc_list' || $p=='tintuc_them' || $p=='tintuc_sua'){ echo 'active';}?>"><a href="index.php?p=tintuc_list">Danh sách tin tức</a></li>
			</ul>
		</li>
		<?php
			if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9 || $_SESSION['group']==10) {
		?>  
		<li class="<?php if($p=='donhang_list' || $p=='donhang_huy' || $p=='donhang_chitiet' || $p=='donhang_chinhsua' || $p=='donhang_chinhsua_add' || $p=='donhang_chinhsua_edit'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="icon-shopping-cart"></i> 
				<span class="title">Đơn hàng</span>
				<span class="arrow "></span>
				<?php if($p=='donhang_list' || $p =='donhang_huy' || $p=='donhang_chitiet' || $p=='donhang_chinhsua' || $p=='donhang_chinhsua_add' || $p=='donhang_chinhsua_edit'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if(($p=='donhang_list' && $_GET['idTT'] != 19) || $p=='donhang_chitiet' || $p=='donhang_chinhsua' || $p=='donhang_chinhsua_add' || $p=='donhang_chinhsua_edit'){ echo 'active';}?>"><a href="index.php?p=donhang_list">Danh sách đơn hàng</a></li>
				<li class="<?php if(($p=='donhang_list' && $_GET['idTT'] == 19) || $p =='donhang_huy'){ echo 'active';}?>"><a href="index.php?p=donhang_list&idTT=19">Đơn hàng chờ hủy</a></li>
			</ul>
		</li>
		<?php } ?>
		<?php
			if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
		?>  
		<li class="<?php if($p=='sanpham_list' || $p=='sanpham_them' || $p=='sanpham_sua' || $p=='sanpham_themnhieu_sosp' || $p=='sanpham_themnhieu' || $p=='nhomsp_list' || $p=='nhomsp_them' || $p=='nhomsp_sua' || $p=='nhomsp_themhinhzoom' || $p=='color_list' || $p=='color_them' || $p=='color_sua'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="icon-coffee"></i> 
				<span class="title">Sản phẩm</span>
				<span class="arrow "></span>
				<?php  if($p=='sanpham_list' || $p=='sanpham_them' || $p=='sanpham_sua' || $p=='sanpham_themnhieu_sosp' || $p=='sanpham_themnhieu' || $p=='nhomsp_list' || $p=='nhomsp_them' || $p=='nhomsp_sua' || $p=='nhomsp_themhinhzoom' || $p=='color_list' || $p=='color_them' || $p=='color_sua'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if($p=='sanpham_list' || $p=='sanpham_them' || $p=='sanpham_sua' || $p=='sanpham_themnhieu_sosp' || $p=='sanpham_themnhieu'){ echo 'active';}?>"><a href="index.php?p=sanpham_list">Danh sách sản phẩm</a></li>
				<li class="<?php if($p=='nhomsp_list' || $p=='nhomsp_them' || $p=='nhomsp_sua' || $p=='nhomsp_themhinhzoom'){ echo 'active';}?>"><a href="index.php?p=nhomsp_list">Nhóm sản phẩm</a></li>
				<li class="<?php if($p=='color_list' || $p=='color_them' || $p=='color_sua'){ echo 'active';}?>"><a href="index.php?p=color_list">Màu sản phẩm</a></li>
			</ul>
		</li>
		<?php } ?>
		<li class="<?php if($p=='user_list' || $p=='user_them' || $p=='user_sua' || $p=='user_lichsu' || $p=='ykien_list' || $p=='ykien_traloi' || $p=='search_list' || $p=='email_marketing_list'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="icon-user"></i> 
				<span class="title">Khách hàng</span>
				<span class="arrow "></span>
				<?php if($p=='user_list' || $p=='user_them' || $p=='user_sua' || $p=='user_lichsu' || $p=='ykien_list' || $p=='ykien_traloi' || $p=='search_list' || $p=='email_marketing_list'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if($p=='user_list' || $p=='user_them' || $p=='user_sua' || $p=='user_lichsu'){ echo 'active';}?>"><a href="index.php?p=user_list">Danh sách khách hàng</a></li>
				<li class="<?php if($p=='ykien_list' || $p=='ykien_traloi'){ echo 'active';}?>"><a href="index.php?p=ykien_list">Ý kiến phản hồi</a></li>
				<li class="<?php if($p=='search_list'){ echo 'active';}?>"><a href="index.php?p=search_list">Tìm kiếm</a></li>
				<li class="<?php if($p=='email_marketing_list'){ echo 'active';}?>"><a href="index.php?p=email_marketing_list">Email nhận tin</a></li>
			</ul>
		</li>
		<?php if($_SESSION['group']==1){ ?>
		<li class="<?php if($p=='admin_list' || $p=='admin_them' || $p=='admin_sua'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="icon-dashboard"></i> 
				<span class="title">Tài khoản Admin</span>
				<span class="arrow "></span>
				<?php if($p=='admin_list' || $p=='admin_them' || $p=='admin_sua'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if($p=='admin_list' || $p=='admin_them' || $p=='admin_sua'){ echo 'active';}?>"><a href="index.php?p=admin_list">Danh sách tài khoản</a></li>
			</ul>
		</li>
		<?php } ?>
		<li class="<?php if($p=='info' || $p=='slider_list' || $p=='slider_them' || $p=='slider_sua'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="icon-cogs"></i> 
				<span class="title">Cấu hình chung</span>
				<span class="arrow "></span>
				<?php if($p=='info'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if($p=='info'){ echo 'active';}?>"><a href="index.php?p=info">Thông tin chung</a></li>
				<li class="<?php if($p=='slider_list' || $p=='slider_them' || $p=='slider_sua'){ echo 'active';}?>"><a href="index.php?p=slider_list">Banner quảng cáo</a></li>
			</ul>
		</li>
		<li class="<?php if($p=='log_list'){ echo 'active';}?>">
			<a href="javascript:;">
				<i class="icon-medkit"></i> 
				<span class="title">Logs</span>
				<span class="arrow "></span>
				<?php if($p=='log_list'){?><span class="selected"></span><?php } ?>
			</a>
			<ul class="sub-menu">
				<li class="<?php if($p=='log_list'){ echo 'active';}?>"><a href="index.php?p=log_list">Danh sách Logs</a></li>
			</ul>
		</li>
		<li class="last">
			<a href="http://bitas.com.vn/" target="_blank">
				<i class="fa fa-play"></i> 
				<span class="title">Xem trang chủ</span>
			</a>
		</li>
	</ul>
	<!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->