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
	<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
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
	<link href="assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="assets/css/pages/tasks.css" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL STYLES -->

	<link href="../img/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
	<!-- MY JAVASCRIPT -->
	<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.js"></script>
	<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
	<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="../js/sweet-alert.js"></script>
	<script type="text/javascript" src="../js/zelect.js"></script>
	<script type="text/javascript" src="../js/dataTable.js"></script>
	<!-- END MY JAVASCRIPT -->

	<!-- MY CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="../css/admin.css"/> -->
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
				<a class="brand" href="index.php">
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
		<?php require_once "sidebar.php";?>
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
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							<?php
								if($p=='nhomsp_them'){
									echo 'Thêm nhóm sản phẩm';
								}
								elseif($p=='nhomsp_list'){
									echo 'Nhóm sản phẩm';
								}
								elseif($p=='nhomsp_sua'){
									echo 'Sửa nhóm sản phẩm';
								}
								elseif($p=='nhomsp_themhinhzoom'){
									echo 'Thêm hình zoom';
								}
								elseif($p=='sanpham_list'){
									echo 'Sản phẩm';
								}
								elseif($p=='sanpham_them'){
									echo 'Thêm sản phẩm';
								}
								elseif($p=='sanpham_themnhieu'){
									echo 'Thêm sản phẩm';
								}
								elseif($p=='sanpham_themnhieu_sosp'){
									echo 'Thêm sản phẩm';
								}
								elseif($p=='sanpham_sua'){
									echo 'Sửa sản phẩm';
								}
								elseif($p=='tintuc_list'){
									echo 'Tin tức';
								}
								elseif($p=='tintuc_them'){
									echo 'Thêm tin tức';
								}
								elseif($p=='tintuc_sua'){
									echo 'Sửa tin tức';
								}
								elseif($p=='khuyenmai_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='khuyenmai_them'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='khuyenmai_sua'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='ykien_list'){
									echo 'Ý kiến phản hồi';
								}
								elseif($p=='ykien_traloi'){
									echo 'Trả lời phản hồi của khách hàng';
								}
								elseif($p=='user_list'){
									echo 'Danh sách khách hàng';
								}
								elseif($p=='user_them'){
									echo 'Thêm khách hàng';
								}
								elseif($p=='user_sua'){
									echo 'Sửa thông tin khách hàng';
								}
								elseif($p=='user_lichsu'){
									echo 'Lịch sử mua hàng';
								}
								elseif($p=='color_list'){
									echo 'Màu';
								}
								elseif($p=='color_them'){
									echo 'Thêm màu';
								}
								elseif($p=='color_sua'){
									echo 'Sửa màu';
								}
								elseif($p=='donhang_list' && $_GET['idTT'] != 19){
									echo 'Đơn hàng';
								}elseif($p=='donhang_list' && $_GET['idTT'] == 19){
									echo 'Đơn hàng chờ hủy';
								}
								elseif($p=='donhang_list_daduyet'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_list_dahuy'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_sua'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_chitiet'){
									echo 'Chi tiết đơn hàng';
								}
								elseif($p=='donhang_uutien'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_gap'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_ghichu'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_doitra_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_doitra_chitiet'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_baohanh_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_baohanh_chitiet'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_huy'){
									echo 'Hủy đơn hàng';
								}
								elseif($p=='info'){
									echo 'Thông tin chung';
								}
								elseif($p=='cskh_main'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='tienthuong_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_chinhsua'){
									echo 'Chỉnh sửa đơn hàng';
								}
								elseif($p=='donhang_chinhsua_edit'){
									echo 'Chỉnh sửa đơn hàng - Sửa sản phẩm';
								}
								elseif($p=='donhang_chinhsua_add'){
									echo 'Chỉnh sửa đơn hàng - Thêm sản phẩm';
								}
								elseif($p=='temp_updatemasp'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='temp_updateskusp'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='search_list'){
									echo 'Từ khóa khách hàng tìm kiếm';
								}
								elseif($p=='email_marketing_list'){
									echo 'Email nhận tin';
								}
								elseif($p=='admin_list'){
									echo 'Tài khoản Admin';
								}
								elseif($p=='admin_them'){
									echo 'Thêm tài khoản Admin';
								}
								elseif($p=='admin_sua'){
									echo 'Sửa tài khoản Admin';
								}
								elseif($p=='log_list'){
									echo 'Log';
								}
								elseif($p=='slider_list'){
									echo 'Danh sách banner quảng cáo';
								}
								elseif($p=='slider_them'){
									echo 'Thêm banner quảng cáo';
								}
								elseif($p=='slider_sua'){
									echo 'Sửa banner quảng cáo';
								}
								else{
									echo 'Dashboard <small>statistics and more</small>';
								}
							?>
							
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.php">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<?php
								if($p=='nhomsp_them'){
									echo '<li><a href="index.php?p=nhomsp_list">Nhóm sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm nhóm sản phẩm</li>';
								}
								elseif($p=='nhomsp_list'){
									echo '<li>Nhóm sản phẩm</li>';
								}
								elseif($p=='nhomsp_sua'){
									echo '<li><a href="index.php?p=nhomsp_list">Nhóm sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Sửa nhóm sản phẩm</li>';
								}
								elseif($p=='nhomsp_themhinhzoom'){
									echo '<li><a href="index.php?p=nhomsp_list">Nhóm sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm hình zoom</li>';
								}
								elseif($p=='sanpham_list'){
									echo '<li>Sản phẩm</li>';
								}
								elseif($p=='sanpham_them'){
									echo '<li><a href="index.php?p=sanpham_list">Sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm sản phẩm</li>';
								}
								elseif($p=='sanpham_themnhieu'){
									echo '<li><a href="index.php?p=sanpham_list">Sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm sản phẩm</li>';
								}
								elseif($p=='sanpham_themnhieu_sosp'){
									echo '<li><a href="index.php?p=sanpham_list">Sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm sản phẩm</li>';
								}
								elseif($p=='sanpham_sua'){
									echo '<li><a href="index.php?p=sanpham_list">Sản phẩm</a><i class="icon-angle-right"></i></li>';
									echo '<li>Sửa sản phẩm</li>';
								}
								elseif($p=='tintuc_list'){
									echo '<li>Tin tức</li>';
								}
								elseif($p=='tintuc_them'){
									echo '<li><a href="index.php?p=tintuc_list">Tin tức</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm tin tức</li>';
								}
								elseif($p=='tintuc_sua'){
									echo '<li><a href="index.php?p=tintuc_list">Tin tức</a><i class="icon-angle-right"></i></li>';
									echo '<li>Sửa tin tức</li>';
								}
								elseif($p=='khuyenmai_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='khuyenmai_them'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='khuyenmai_sua'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='ykien_list'){
									echo '<li>Ý kiến phản hồi</li>';
								}
								elseif($p=='ykien_traloi'){
									echo '<li><a href="index.php?p=ykien_list">Ý kiến phản hồi</a><i class="icon-angle-right"></i></li>';
									echo '<li>Trả lời phản hồi</li>';
								}
								elseif($p=='user_list'){
									echo '<li>Khách hàng</li>';
								}
								elseif($p=='user_them'){
									echo '<li><a href="index.php?p=user_list">Khách hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm khách hàng</li>';
								}
								elseif($p=='user_sua'){
									echo '<li><a href="index.php?p=user_list">Khách hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Sửa thông tin khách hàng</li>';
								}
								elseif($p=='user_lichsu'){
									echo '<li><a href="index.php?p=user_list">Khách hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Lịch sử mua hàng</li>';
								}
								elseif($p=='color_list'){
									echo '<li>Màu</li>';
								}
								elseif($p=='color_them'){
									echo '<li><a href="index.php?p=color_list">Màu</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm màu</li>';
								}
								elseif($p=='color_sua'){
									echo '<li><a href="index.php?p=color_list">Màu</a><i class="icon-angle-right"></i></li>';
									echo '<li>Sửa màu</li>';
								}
								elseif($p=='donhang_list' && $_GET['idTT'] != 19){
									echo '<li>Đơn hàng</li>';
								}elseif($p=='donhang_list' && $_GET['idTT'] == 19){
									echo '<li>Đơn hàng chờ hủy</li>';
								}
								elseif($p=='donhang_list_daduyet'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_list_dahuy'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_sua'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_chitiet'){
									echo '<li><a href="index.php?p=donhang_list">Đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Chi tiết đơn hàng</li>';
								}
								elseif($p=='donhang_uutien'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_gap'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_ghichu'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_doitra_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_doitra_chitiet'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_baohanh_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_baohanh_chitiet'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_huy'){
									echo '<li><a href="index.php?p=donhang_list&idTT=19">Đơn hàng chờ hủy</a><i class="icon-angle-right"></i></li>';
									echo '<li>Hủy đơn hàng</li>';
								}
								elseif($p=='info'){
									echo '<li>Thông tin chung</li>';
								}
								elseif($p=='cskh_main'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='tienthuong_list'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='donhang_chinhsua'){
									echo '<li><a href="index.php?p=donhang_list">Đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li><a href="index.php?p=donhang_chitiet&idDH=' . $_GET['idDH'] . '">Chi tiết đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Chỉnh sửa đơn hàng</li>';
								}
								elseif($p=='donhang_chinhsua_edit'){
									$idDHCT = $_GET['idDHCT'] ? $_GET['idDHCT'] : '';
									$dh = $i->ChiTietDonHangChiTiet($idDHCT);
									$row_dh = mysql_fetch_assoc($dh);
									$idDH = $row_dh['idDH'];
									echo '<li><a href="index.php?p=donhang_list">Đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li><a href="index.php?p=donhang_chitiet&idDH=' . $idDH . '">Chi tiết đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li><a href="index.php?p=donhang_chinhsua&idDH=' . $idDH . '">Chỉnh sửa đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Chỉnh sửa đơn hàng - Sửa sản phẩm</li>';
								}
								elseif($p=='donhang_chinhsua_add'){
									echo '<li><a href="index.php?p=donhang_list">Đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li><a href="index.php?p=donhang_chitiet&idDH=' . $_GET['idDH'] . '">Chi tiết đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li><a href="index.php?p=donhang_chinhsua&idDH=' . $_GET['idDH'] . '">Chỉnh sửa đơn hàng</a><i class="icon-angle-right"></i></li>';
									echo '<li>Chỉnh sửa đơn hàng - Thêm sản phẩm</li>';
								}
								elseif($p=='temp_updatemasp'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='temp_updateskusp'){
									echo '<li><a href=""></a></li>';
								}
								elseif($p=='search_list'){
									echo '<li>Tìm kiếm</li>';
								}
								elseif($p=='email_marketing_list'){
									echo '<li>Email nhận tin</li>';
								}
								elseif($p=='admin_list'){
									echo '<li>Tài khoản Admin</li>';
								}
								elseif($p=='admin_them'){
									echo '<li>Thêm tài khoản Admin</li>';
								}
								elseif($p=='admin_sua'){
									echo '<li>Sửa tài khoản Admin</li>';
								}
								elseif($p=='log_list'){
									echo '<li>Log</li>';
								}
								elseif($p=='slider_list'){
									echo '<li>Danh sách banner quảng cáo</li>';
								}
								elseif($p=='slider_them'){
									echo '<li><a href="index.php?p=slider_list">Danh sách banner quảng cáo</a><i class="icon-angle-right"></i></li>';
									echo '<li>Thêm banner quảng cáo</li>';
								}
								elseif($p=='slider_sua'){
									echo '<li><a href="index.php?p=slider_list">Danh sách banner quảng cáo</a><i class="icon-angle-right"></i></li>';
									echo '<li>Sửa banner quảng cáo</li>';
								}
								else{
									echo '<li><a href="index.php">Dashboard</a></li>';
								}
							?>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<?php 
					if($p=='nhomsp_them'){
						require_once "nhomsp_them.php";
					}
					elseif($p=='nhomsp_list'){
						require_once "nhomsp_list.php";
					}
					elseif($p=='nhomsp_sua'){
						require_once "nhomsp_sua.php";
					}
					elseif($p=='nhomsp_themhinhzoom'){
						require_once "nhomsp_themhinhzoom.php";
					}
					elseif($p=='sanpham_list'){
						require_once "sanpham_list.php";
					}
					elseif($p=='sanpham_them'){
						require_once "sanpham_them.php";
					}
					elseif($p=='sanpham_themnhieu'){
						require_once "sanpham_themnhieu.php";
					}
					elseif($p=='sanpham_themnhieu_sosp'){
						require_once "sanpham_themnhieu_sosp.php";
					}
					elseif($p=='sanpham_sua'){
						require_once "sanpham_sua.php";
					}
					elseif($p=='tintuc_list'){
						require_once "tintuc_list.php";
					}
					elseif($p=='tintuc_them'){
						require_once "tintuc_them.php";
					}
					elseif($p=='tintuc_sua'){
						require_once "tintuc_sua.php";
					}
					elseif($p=='khuyenmai_list'){
						require_once "khuyenmai_list.php";
					}
					elseif($p=='khuyenmai_them'){
						require_once "khuyenmai_them.php";
					}
					elseif($p=='khuyenmai_sua'){
						require_once "khuyenmai_sua.php";
					}
					elseif($p=='ykien_list'){
						require_once "ykien_list.php";
					}
					elseif($p=='ykien_traloi'){
						require_once "ykien_traloi.php";
					}
					elseif($p=='user_list'){
						require_once "user_list.php";
					}
					elseif($p=='user_them'){
						require_once "user_them.php";
					}
					elseif($p=='user_sua'){
						require_once "user_sua.php";
					}
					elseif($p=='user_lichsu'){
						require_once "user_lichsu.php";
					}
					elseif($p=='color_list'){
						require_once "color_list.php";
					}
					elseif($p=='color_them'){
						require_once "color_them.php";
					}
					elseif($p=='color_sua'){
						require_once "color_sua.php";
					}
					elseif($p=='donhang_list'){
						require_once "donhang_list.php";
					}
					elseif($p=='donhang_list_daduyet'){
						require_once "donhang_list_daduyet.php";
					}
					elseif($p=='donhang_list_dahuy'){
						require_once "donhang_list_dahuy.php";
					}
					elseif($p=='donhang_sua'){
						require_once "donhang_capnhattinhtrang.php";
					}
					elseif($p=='donhang_chitiet'){
						require_once "donhang_chitiet.php";
					}
					elseif($p=='donhang_uutien'){
						require_once "donhang_uutien.php";
					}
					elseif($p=='donhang_gap'){
						require_once "donhang_gap.php";
					}
					elseif($p=='donhang_ghichu'){
						require_once "donhang_ghichu.php";
					}
					elseif($p=='donhang_doitra_list'){
						require_once "donhang_doitra_list.php";
					}
					elseif($p=='donhang_doitra_chitiet'){
						require_once "donhang_doitra_chitiet.php";
					}
					elseif($p=='donhang_baohanh_list'){
						require_once "donhang_baohanh_list.php";
					}
					elseif($p=='donhang_baohanh_chitiet'){
						require_once "donhang_baohanh_chitiet.php";
					}
					elseif($p=='donhang_huy'){
						require_once "donhang_huy.php";
					}
					elseif($p=='info'){
						require_once "info.php";
					}
					elseif($p=='cskh_main'){
						require_once "cskh_main.php";
					}
					elseif($p=='tienthuong_list'){
						require_once "tienthuong_list.php";
					}
					elseif($p=='donhang_chinhsua'){
						require_once "donhang_chinhsua.php";
					}
					elseif($p=='donhang_chinhsua_edit'){
						require_once "donhang_chinhsua_edit.php";
					}
					elseif($p=='donhang_chinhsua_add'){
						require_once "donhang_chinhsua_add.php";
					}
					elseif($p=='temp_updatemasp'){
						require_once "Temp_UpdateMaSP.php";
					}
					elseif($p=='temp_updateskusp'){
						require_once "Temp_UpdateSKUSP.php";
					}
					elseif($p=='search_list'){
						require_once "search_list.php";
					}
					elseif($p=='email_marketing_list'){
						require_once "email_marketing_list.php";
					}
					elseif($p=='admin_list'){
						require_once "admin_list.php";
					}
					elseif($p=='admin_them'){
						require_once "admin_them.php";
					}
					elseif($p=='admin_sua'){
						require_once "admin_sua.php";
					}
					elseif($p=='log_list'){
						require_once "log_list.php";
					}
					elseif($p=='slider_list'){
						require_once "slider_list.php";
					}
					elseif($p=='slider_them'){
						require_once "slider_them.php";
					}
					elseif($p=='slider_sua'){
						require_once "slider_sua.php";
					}
					else{
						require_once "main.php";
					}
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
	<script src="assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="assets/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/date.js" type="text/javascript"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="text/javascript"></script>     
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