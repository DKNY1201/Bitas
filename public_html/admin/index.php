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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator Bita's Website</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="../css/jquery-ui.css"/>
<link href="../img/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
<script type="text/javascript" src="../js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
<link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css"/>
<script type="text/javascript" src="../js/sweet-alert.js"></script>
<script type="text/javascript" src="../js/zelect.js"></script>
<link rel="stylesheet" href="../css/sweet-alert.css">
<script>
	$(document).ready(function(e) {
		//show profile when click user's name
		$( "#profile" ).bind({
			click: function() {
				$('.dropdown').fadeIn(300);
			},
			mouseleave: function() {
				$('.dropdown').fadeOut(300);
			}
		});
		//toggle
        $('#left_nav > li > a').click(function(e) {
			if($(this).attr('class')!='active')
			{
            	$('#left_nav li ul').slideUp(300);
				$(this).next().slideToggle(300);
				$('#left_nav li a').removeClass('active');
				$(this).addClass('active');
			}
        });
		$body = $("body");
		$(document).on({
			ajaxStart: function() { $body.addClass("loading");},
			 ajaxStop: function() { $body.removeClass("loading"); }    
		});
		
		$('#select-backed-zelect').zelect();
    });
</script>
</head>
<body>
<div id="wrapper">
	<div id="top">
    	<div id="logo">
        	<a href="<?php if($_SESSION['group']!=6) echo 'index.php'; else echo 'index.php?p=cskh_main';?>">Bita's Dashboard</a>
        </div>
        <div id="top_ele">
        <?php switch($p){
				case "donhang_list":echo "Danh sách đơn hàng";break;
				case "donhang_list_daduyet":echo "Danh sách đơn hàng đã giao";break;
				case "donhang_list_dahuy":echo "Danh sách đơn hàng đã hủy";break;
				case "donhang_sua":echo "Cập nhật tình trang đơn hàng đơn hàng";break;
				case "donhang_chitiet":echo "Chi tiết đơn hàng";break;
				case "donhang_uutien":echo "Đơn hàng - Ưu tiên";break;
				case "donhang_gap":echo "Đơn hàng - Gấp";break;
				case "donhang_ghichu":echo "Đơn hàng - Ghi chú";break;
				case "donhang_doitra_list":echo "Đơn hàng - Đổi trả";break;
				case "donhang_doitra_chitiet":echo "Đơn hàng - Đổi trả chi tiết";break;
				case "donhang_baohanh_list":echo "Đơn hàng - Bảo hành";break;
				case "donhang_baohanh_chitiet":echo "Đơn hàng - Bảo hành chi tiết";break;
				case "donhang_huy":echo "Đơn hàng - Hủy đơn hàng";break;
				case "nhomsp_them":echo "Thêm nhóm sản phẩm";break;
				case "nhomsp_list":echo "Danh sách nhóm sản phẩm";break;
				case "nhomsp_sua":echo "Sửa nhóm sản phẩm";break;
				case "nhomsp_themhinhzoom":echo "Thêm hình Zoom";break;
				case "sanpham_them":echo "Thêm sản phẩm";break;
				case "sanpham_list":echo "Danh sách sản phẩm";break;
				case "sanpham_sua":echo "Sửa sản phẩm";break;
				case "sanpham_themnhieu":echo "Thêm nhiều sản phẩm";break;
				case "sanpham_themnhieu_sosp":echo "Thêm nhiều sản phẩm";break;
				case "tintuc_them":echo "Thêm tin tức";break;
				case "tintuc_list":echo "Danh sách tin tức";break;
				case "tintuc_sua":echo "Sửa tin tức";break;
				case "khuyenmai_them":echo "Thêm khuyến mãi";break;
				case "khuyenmai_list":echo "Danh sách khuyến mãi";break;
				case "khuyenmai_sua":echo "Sửa khuyến mãi";break;
				case "ykien_list_chuaduyet":echo "Danh sách ý kiến chưa duyệt";break;
				case "ykien_list_daduyet":echo "Danh sách ý kiến đã duyệt";break;
				case "ykien_traloi":echo "Trả lời ý kiến";break;
				case "user_them":echo "Thêm người dùng";break;
				case "user_list":echo "Danh sách người dùng";break;
				case "user_sua":echo "Sửa thông tin người dùng";break;
				case "user_lichsu":echo "Lịch sử mua hàng";break;
				case "color_them":echo "Thêm màu";break;
				case "color_list":echo "Danh sách màu";break;
				case "cskh_main":echo "Chăm sóc khách hàng";break;
				case "info":echo "Thông tin chung";break;
				case "tienthuong_list":echo "Danh sách khách hàng nhận tiền thưởng";break;
				case "donhang_chinhsua":echo "Chỉnh sửa đơn hàng";break;
				case "donhang_chinhsua_edit":echo "Chỉnh sửa đơn hàng - Sửa";break;
				case "donhang_chinhsua_add":echo "Chỉnh sửa đơn hàng - Thêm";break;
			}
		?>
        </div>
        <div id="profile">
        	<h6 class="name"><?php echo $_SESSION['hoten']?></h6>
            <ul class="dropdown box_shadow">
                <li><a href="logout.php">Đăng xuất</a></li>
            </ul>
        </div>
    </div><!--end_top-->
    <div id="content">
    	<div id="left" class="box_shadow">
        	<ul id="left_nav">
             <?php //Phan quyen
			if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9 || $_SESSION['group']==10) {
			?>  
            	<li><a href="#"><span class="donhang"></span>Đơn hàng</a>
                	<ul>
                        <li><a <?php if($p=='donhang_list') echo "class='active'";?> href="index.php?p=donhang_list">Danh sách đơn hàng</a></li>

                        <li><a <?php if($p=='donhang_doitra_list') echo "class='active'";?> href="index.php?p=donhang_doitra_list">Danh sách đơn hàng đổi trả</a></li>
                        <li><a <?php if($p=='donhang_baohanh_list') echo "class='active'";?> href="index.php?p=donhang_baohanh_list">Danh sách đơn hàng bảo hành</a></li>
                    </ul>
                </li>
                <!--
                <li><a href="#"><span class="sp"></span>Tiền thưởng</a>
                	<ul>
                    	<li><a <?php if($p=='tienthuong_list') echo "class='active'";?> href="index.php?p=tienthuong_list">Danh sách khách hàng nhận tiền thưởng</a></li>
                    </ul>
                </li>-->
            <?php }
			//Phan quyen
			if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
			?>
            	 
            	<li><a href="#"><span class="nhomsp"></span>Nhóm sản phẩm</a>
                	<ul>
                    	<?php
							if($_SESSION['group']==1 || $_SESSION['group']==8) {
						?> 
                    	<li><a <?php if($p=='nhomsp_them') echo "class='active'";?> href="index.php?p=nhomsp_them">Thêm nhóm sản phẩm</a></li>
                        <?php }
							if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
						?>
                        <li><a <?php if($p=='nhomsp_list') echo "class='active'";?> href="index.php?p=nhomsp_list">Danh sách nhóm sản phẩm</a></li><?php } ?>
                    </ul>
                </li>
                
                <li><a href="#"><span class="sp"></span>Sản phẩm</a>
                	<ul>
                    	<?php
							if($_SESSION['group']==1 || $_SESSION['group']==8) {
						?>
                    		<li><a <?php if($p=='sanpham_them') echo "class='active'";?> href="index.php?p=sanpham_them">Thêm sản phẩm</a></li>
                        	<li><a <?php if($p=='sanpham_themnhieu_sosp' || $p=='sanpham_themnhieu') echo "class='active'";?> href="index.php?p=sanpham_themnhieu_sosp">Thêm nhiều sản phẩm</a></li>
                        <?php }
							if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
						?>
                        	<li><a <?php if($p=='sanpham_list') echo "class='active'";?> href="index.php?p=sanpham_list">Danh sách sản phẩm</a></li>
                        <?php } ?>
                    </ul>
                </li>
                
                <li><a href="#"><span class="tt"></span>Tin tức</a>
                	<ul>
                    	<?php
							if($_SESSION['group']==1 || $_SESSION['group']==8) {
						?>
	                    	<li><a <?php if($p=='tintuc_them') echo "class='active'";?> href="index.php?p=tintuc_them">Thêm tin tức</a></li>
                        <?php }
							if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
						?>
    	                    <li><a <?php if($p=='tintuc_list') echo "class='active'";?> href="index.php?p=tintuc_list">Danh sách tin tức</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <!--
                <li><a href="#"><span class="km"></span>Khuyến mãi</a>
                	<ul>
                    	<li><a <?php if($p=='khuyenmai_them') echo "class='active'";?> href="index.php?p=khuyenmai_them">Thêm khuyến mãi</a></li>
                        <li><a <?php if($p=='khuyenmai_list') echo "class='active'";?> href="index.php?p=khuyenmai_list">Danh sách khuyến mãi</a></li>
                    </ul>
                </li>
                -->
                <li><a href="#"><span class="us"></span>Màu</a>
                	<ul>
                    	<?php
							if($_SESSION['group']==1 || $_SESSION['group']==8) {
						?>
                    		<li><a <?php if($p=='color_them') echo "class='active'";?> href="index.php?p=color_them">Thêm màu</a></li>
                        <?php }
							if($_SESSION['group']==1 || $_SESSION['group']==8 || $_SESSION['group']==9) {
						?>
                        <li><a <?php if($p=='color_list') echo "class='active'";?> href="index.php?p=color_list">Danh sách màu</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="#"><span class="yk"></span>Ý kiến</a>
                	<ul>
                    	<li><a <?php if($p=='ykien_list_chuaduyet') echo "class='active'";?> href="index.php?p=ykien_list_chuaduyet">Danh sách ý kiến chưa duyệt</a></li>
                        <li><a <?php if($p=='ykien_list_daduyet') echo "class='active'";?> href="index.php?p=ykien_list_daduyet">Danh sách ý kiến đã duyệt</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="us"></span>Khách hàng</a>
                	<ul>
                    	<!--<li><a <?php if($p=='user_them') echo "class='active'";?> href="index.php?p=user_them">Thêm người dùng</a></li>-->
                        <li><a <?php if($p=='user_list') echo "class='active'";?> href="index.php?p=user_list">Danh sách khách hàng</a></li>
                    </ul>
                </li>
                <?php
					if($_SESSION['group']==1 || $_SESSION['group']==8) {
				?>
                <li><a href="#"><span class="us"></span>Thông tin chung</a>
                	<ul>
                        <li><a <?php if($p=='info') echo "class='active'";?> href="index.php?p=info">Thông tin chung</a></li>
                    </ul>
                </li>
                <?php } ?>
            <?php }?>
            </ul>
        </div><!--end_left-->
        <div id="right">
        	<?php if($p=='nhomsp_them')
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
				else require_once "main.php";
			?>
        </div><!--end_content-->
    </div><!--end_content-->
</div><!--end_wrapper-->
<div class="modal"></div>
</body>
</html>