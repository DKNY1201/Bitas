<?php ob_start();
	require_once "checklogin.php";
	require_once "../db/classAdmin.php";
	$i=new admin;
	if(isset($_GET['p'])==true){
		$p=$_GET['p'];
	}else{
		$p="";
	}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Administrator Bita's Website</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->        
	<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>
	<link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL STYLES -->

	<!-- MY JAVASCRIPT -->
	<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
	<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="../js/sweet-alert.js"></script>
	<script type="text/javascript" src="../js/zelect.js"></script>
	<!-- END MY JAVASCRIPT -->

	<!-- MY CSS -->
	<link href="../img/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
	<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css"/>
	<link rel="stylesheet" href="../css/sweet-alert.css">
	<!-- END MY CSS -->
	
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="index2.php">
					<img src="../img/admin/logo32x32.png" alt="logo" />
					Bita's Dashboard
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
					<img src="assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->              
				<ul class="nav pull-right">           
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" src="assets/img/avatar1_small.jpg" />
						<span class="username"><?php echo $_SESSION['hoten']?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Toàn màn hình</a></li>
							<li><a href="extra_lock.html"><i class="icon-lock"></i> Khóa màn hình</a></li>
							<li><a href="logout.php"><i class="icon-key"></i> Đăng xuất</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="start <?php if($p==''){ echo 'active';}?>">
					<a href="index2.php">
						<i class="icon-home"></i> 
						<span class="title">Dashboard</span>
						<?php if($p==''){?><span class="selected"></span><?php } ?>
					</a>
				</li>
				<li class="<?php if($p=='tintuc_list'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Tin tức</span>
						<span class="arrow "></span>
						<?php if($p=='tintuc_list'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='tintuc_list'){ echo 'active';}?>"><a href="index2.php?p=tintuc_list">Danh sách tin tức</a></li>
					</ul>
				</li>
				<?php
					if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9 || $_SESSION['group']==10) {
				?>  
				<li class="<?php if($p=='donhang_list'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Đơn hàng</span>
						<span class="arrow "></span>
						<?php if($p=='donhang_list'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='donhang_list'){ echo 'active';}?>"><a href="index2.php?p=donhang_list">Danh sách đơn hàng</a></li>
						<li><a href="index2.php?p=donhang_list">Đơn hàng chờ hủy</a></li>
					</ul>
				</li>
				<?php } ?>
				<?php
					if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
				?>  
				<li class="<?php if($p=='nhomsp_list' || $p=='sanpham_list' || $p=='color_list'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Sản phẩm</span>
						<span class="arrow "></span>
						<?php if($p=='nhomsp_list' || $p=='sanpham_list' || $p=='color_list'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='nhomsp_list'){ echo 'active';}?>"><a href="index2.php?p=nhomsp_list">Danh sách sản phẩm</a></li>
						<li class="<?php if($p=='sanpham_list'){ echo 'active';}?>"><a href="index2.php?p=sanpham_list">Nhóm sản phẩm</a></li>
						<li class="<?php if($p=='color_list'){ echo 'active';}?>"><a href="index2.php?p=color_list">Màu sản phẩm</a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="<?php if($p=='user_list' || $p=='ykien_list_daduyet'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Khách hàng</span>
						<span class="arrow "></span>
						<?php if($p=='user_list' || $p=='ykien_list_daduyet'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='user_list'){ echo 'active';}?>"><a href="index2.php?p=user_list">Danh sách khách hàng</a></li>
						<li class="<?php if($p=='ykien_list_daduyet'){ echo 'active';}?>"><a href="index2.php?p=ykien_list_daduyet">Ý kiến phản hồi</a></li>
						<li class="<?php if($p=='ykien_list_daduyet'){ echo 'active';}?>"><a href="index2.php?p=ykien_list_daduyet">Tìm kiếm</a></li>
						<li class="<?php if($p=='ykien_list_daduyet'){ echo 'active';}?>"><a href="index2.php?p=ykien_list_daduyet">Email nhận tin</a></li>
					</ul>
				</li>
				<li class="<?php if($p=='user_list'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Tài khoản Admin</span>
						<span class="arrow "></span>
						<?php if($p=='user_list'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='user_list'){ echo 'active';}?>"><a href="index2.php?p=user_list">Danh sách tài khoản</a></li>
					</ul>
				</li>
				<li class="<?php if($p=='info'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Cấu hình chung</span>
						<span class="arrow "></span>
						<?php if($p=='info'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='info'){ echo 'active';}?>"><a href="index2.php?p=info">Thông tin chung</a></li>
						<li class="<?php if($p=='info'){ echo 'active';}?>"><a href="index2.php?p=info">Banner quảng cáo</a></li>
					</ul>
				</li>
				<li class="last <?php if($p=='logs'){ echo 'active';}?>">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">Logs</span>
						<span class="arrow "></span>
						<?php if($p=='logs'){?><span class="selected"></span><?php } ?>
					</a>
					<ul class="sub-menu">
						<li class="<?php if($p=='logs'){ echo 'active';}?>"><a href="index2.php?p=logs">Danh sách Logs</a></li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>Widget Settings</h3>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<?php 
					if($p=='nhomsp_them')
						require_once "nhomsp_them.php";
					elseif($p=='nhomsp_list')
						require_once "nhomsp_list.php";
					elseif($p=='nhomsp_sua')
						require_once "nhomsp_sua.php";
					elseif($p=='nhomsp_themhinhzoom')
						require_once "nhomsp_themhinhzoom.php";
					elseif($p=='sanpham_list')
						require_once "sanpham_list.php";
					elseif($p=='sanpham_them')
						require_once "sanpham_them.php";
					elseif($p=='sanpham_themnhieu')
						require_once "sanpham_themnhieu.php";
					elseif($p=='sanpham_themnhieu_sosp')
						require_once "sanpham_themnhieu_sosp.php";
					elseif($p=='sanpham_sua')
						require_once "sanpham_sua.php";
					elseif($p=='tintuc_list')
						require_once "tintuc_list.php";
					elseif($p=='tintuc_them')
						require_once "tintuc_them.php";
					elseif($p=='tintuc_sua')
						require_once "tintuc_sua.php";
					elseif($p=='khuyenmai_list')
						require_once "khuyenmai_list.php";
					elseif($p=='khuyenmai_them')
						require_once "khuyenmai_them.php";
					elseif($p=='khuyenmai_sua')
						require_once "khuyenmai_sua.php";
					elseif($p=='ykien_list_chuaduyet')
						require_once "ykien_list_chuaduyet.php";
					elseif($p=='ykien_list_daduyet')
						require_once "ykien_list_daduyet.php";
					elseif($p=='ykien_traloi')
						require_once "ykien_traloi.php";
					elseif($p=='user_list')
						require_once "user_list.php";
					elseif($p=='user_them')
						require_once "user_them.php";
					elseif($p=='user_sua')
						require_once "user_sua.php";
					elseif($p=='user_lichsu')
						require_once "user_lichsu.php";
					elseif($p=='color_list')
						require_once "color_list.php";
					elseif($p=='color_them')
						require_once "color_them.php";
					elseif($p=='color_sua')
						require_once "color_sua.php";
					elseif($p=='donhang_list')
						require_once "donhang_list.php";
					elseif($p=='donhang_list_daduyet')
						require_once "donhang_list_daduyet.php";
					elseif($p=='donhang_list_dahuy')
						require_once "donhang_list_dahuy.php";
					elseif($p=='donhang_sua')
						require_once "donhang_capnhattinhtrang.php";
					elseif($p=='donhang_chitiet')
						require_once "donhang_chitiet.php";
					elseif($p=='donhang_uutien')
						require_once "donhang_uutien.php";
					elseif($p=='donhang_gap')
						require_once "donhang_gap.php";
					elseif($p=='donhang_ghichu')
						require_once "donhang_ghichu.php";
					elseif($p=='donhang_doitra_list')
						require_once "donhang_doitra_list.php";
					elseif($p=='donhang_doitra_chitiet')
						require_once "donhang_doitra_chitiet.php";
					elseif($p=='donhang_baohanh_list')
						require_once "donhang_baohanh_list.php";
					elseif($p=='donhang_baohanh_chitiet')
						require_once "donhang_baohanh_chitiet.php";
					elseif($p=='donhang_huy')
						require_once "donhang_huy.php";
					elseif($p=='info')
						require_once "info.php";
					elseif($p=='cskh_main')
						require_once "cskh_main.php";
					elseif($p=='tienthuong_list')
						require_once "tienthuong_list.php";
					elseif($p=='donhang_chinhsua')
						require_once "donhang_chinhsua.php";
					elseif($p=='donhang_chinhsua_edit')
						require_once "donhang_chinhsua_edit.php";
					elseif($p=='donhang_chinhsua_add')
						require_once "donhang_chinhsua_add.php";
					elseif($p=='temp_updatemasp')
						require_once "Temp_UpdateMaSP.php";
					elseif($p=='temp_updateskusp')
						require_once "Temp_UpdateSKUSP.php";
					else require_once "main2.php";
				?>
			</div>
			<!-- END PAGE CONTAINER-->    
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="footer">
		<div class="footer-inner">
			2014 &copy; Bita's Corp
		</div>
		<div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->   
	<script src="assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="assets/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>   
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
	<script src="assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>  
	<script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
	<script src="assets/plugins/gritter/js/jquery.gritter.js" type="text/javascript"></script>
	<script src="assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.sparkline.min.js" type="text/javascript"></script>  
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="assets/scripts/app.js" type="text/javascript"></script>
	<script src="assets/scripts/index.js" type="text/javascript"></script>
	<script src="assets/scripts/tasks.js" type="text/javascript"></script>        
	<!-- END PAGE LEVEL SCRIPTS -->  
	<script>
		jQuery(document).ready(function() {    
		   App.init(); // initlayout and core plugins
		   Index.init();
		   Index.initJQVMAP(); // init index page's custom scripts
		   Index.initCalendar(); // init index page's custom scripts
		   Index.initCharts(); // init index page's custom scripts
		   Index.initChat();
		   Index.initMiniCharts();
		   Index.initDashboardDaterange();
		   Index.initIntro();
		   Tasks.initDashboardWidget();
		});
	</script>

	<script>
		$(document).ready(function(e) {
			$body = $("body");
			$(document).on({
				ajaxStart: function() { $body.addClass("loading");},
				 ajaxStop: function() { $body.removeClass("loading"); }    
			});
			
			$('#select-backed-zelect').zelect();
	    });
	</script>

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>