<?php
	ob_start();
	//session_start();
	//session_unset();
	error_reporting(0);
/*
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
*/
	require_once('db/db.php');
	$i=new db;
	//$i->LuuThongTinSession();
 	$i->LuuThongKeKhachHang();
	$info=$i->detailInfo();
	$row_info=mysql_fetch_assoc($info);
	/*===== PROMOTION =====*/
	$checkPA=$i->checkPromotionActive();
	if($checkPA){
		$activePromotion=$i->getPromotionActiveCode();
		$row_AP=mysql_fetch_assoc($activePromotion);
		$pro_code=$row_AP['code'];
		$promotion=$i->detailPromotion($pro_code);
		$row_promotion=mysql_fetch_assoc($promotion);
		$promotion_price=$row_promotion['conditionMoney'];
		$reduceMoney=$row_promotion['reduceMoney'];
	}
	if(isset($_GET['p']))
		$p=$_GET['p'];
    if($_SESSION["keep_me"]){
        $keep_me = $_SESSION["keep_me"];
    }
    elseif($_COOKIE["keep_me"]){
        $keep_me = $_COOKIE["keep_me"];
        if ($keep_me) {
            $_SESSION["keep_me"] ="tontai";
            $ep=explode(":", $keep_me);
            $email=$ep[0];
            $pass=$ep[1];
            $user=$i->LayThongTinUser($email,$pass);
            $row_user = mysql_fetch_assoc($user);
            $_SESSION['id'] = $row_user['idUser'];
            $_SESSION['email'] = $row_user['Email'];
            $_SESSION['group'] = $row_user['idGroup'];
            $_SESSION['hoten'] = $row_user['HoTen'];
            $_SESSION['gioitinh'] = $row_user['GioiTinh'];
            $_SESSION['dienthoai'] = $row_user['DienThoai'];
            $_SESSION['diachi'] = $row_user['DiaChi'];
			$_SESSION['tinhthanh'] = $row_user['idTinh'];
			$_SESSION['quanhuyen'] = $row_user['idQuanHuyen'];
			$_SESSION['phuong'] = $row_user['idPhuong'];
            $_SESSION['ngaysinh'] = $row_user['NgaySinh'];
        }
    }
    if(isset($_POST['btndn'])){
        $email=$_POST['email'];
        $pass=$_POST['password'];
        if (get_magic_quotes_gpc()== false) {
            $email=trim(mysql_real_escape_string($email));
            $password=trim(mysql_real_escape_string($password));
        }
        $pass=md5($_POST['password']);
        $url_now=$_SERVER["REQUEST_URI"];
        if($i->KTEmail($email)==false){
            $_SESSION['thongbao_error']="Tên đăng nhập hoặc mật khẩu bạn nhập không đúng. <br />Vui lòng thử lại.";
            header("location:$url_now");
            exit();
        }
        else{
            $user=$i->LayThongTinUser($email,$pass);
            if(mysql_num_rows($user)<=0){
                $_SESSION['thongbao_error']="Tên đăng nhập hoặc mật khẩu bạn nhập không đúng. <br />Vui lòng thử lại. ";
                header("location:$url_now");
                exit();
            }
            else{
                $c=$_POST['keep-logged'];
                $time= time()+60*60*24*30;
                $row_user = mysql_fetch_assoc($user);
                $_SESSION['id'] = $row_user['idUser'];
                $_SESSION['email'] = $row_user['Email'];
                $_SESSION['group'] = $row_user['idGroup'];
                $_SESSION['hoten'] = $row_user['HoTen'];
                $_SESSION['gioitinh'] = $row_user['GioiTinh'];
                $_SESSION['dienthoai'] = $row_user['DienThoai'];
                $_SESSION['diachi'] = $row_user['DiaChi'];
				$_SESSION['tinhthanh'] = $row_user['idTinh'];
				$_SESSION['quanhuyen'] = $row_user['idQuanHuyen'];
				$_SESSION['phuong'] = $row_user['idPhuong'];
                $_SESSION['ngaysinh'] = $row_user['NgaySinh'];
                if($c=="on"){
                    setcookie("keep_me", $email.":".$pass, $time, "/", ".".$_SERVER["HTTP_HOST"]);
                }
                else {
                    $_SESSION["keep_me"] = "tontai";
                    session_write_close();
                }
				if(isset($_SESSION['back']))
				{
					$back=$_SESSION['back'];
					unset($_SESSION['back']);
					header("location:$back");
					exit();
				}
				else
				{
                	header("location:$url_now");
					exit();
				}                
            }
        }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://bitas.com.vn" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META name="description" content="
<?php
	// for My account page
	if(isset($_GET['pi']))
		$pi=$_GET['pi'];
	// for Detail product page
	if(isset($_GET['idNSP']))
		$idNSP_i=$_GET['idNSP'];
	// for Product page
	if(isset($_GET['lspgt']) && !isset($_GET['lspdsg']))
	{
		$lspgt = $_GET['lspgt'];
		$idLoaispGT = $i->LayidlspgtTuTenSEO($lspgt);
	}
	elseif(isset($_GET['lspgt']) && isset($_GET['lspdsg']))
	{
		$lspdsg = $_GET['lspdsg'];
		$idLoaispDSG = $i->LayidlspdsgTuTenSEO($lspdsg);
	}
	elseif(isset($_GET['option']))
	{
		$option=$_GET['option'];
		if(isset($_GET['lsp']))
			$lsp=$_GET['lsp'];
	}
	// for detail news page
	if(isset($_GET['idTin']))
		$idTin=$_GET['idTin'];
	$meta=$i->meta_description($p,$option,$idLoaispGT);
	if(!empty($meta)){
		echo $meta;
	}else{
		echo 'Bitas.com.vn là website bán giày dép online với mức giá tốt nhất. Bao gồm: giày dép nam, giày dép nữ, giày dép trẻ em, giày dép thời trang với tiêu chí rẻ, đẹp, bền';
	}
?>
" />
<?php
	if(isset($_GET['idNSP']) || isset($_GET['idTin'])){
		if(isset($_GET['idNSP'])){
			$og = $i->getOgMetadata($_GET['idNSP'],0);
		}else if(isset($_GET['idTin'])){
			$og = $i->getOgMetadata(0,$_GET['idTin']);
		}
		$ogObj = json_decode($og,true);
		echo '<meta property="og:type" content="' . $ogObj['ogType'] . '">';
		echo '<meta property="og:url" content="' . $ogObj['ogUrl'] . '">';
		echo '<meta property="og:image" itemprop="thumbnailUrl" content="' . $ogObj['ogImg'] . '">';
		echo '<meta property="og:title" itemprop="headline" content="' . $ogObj['ogTitle'] . '">';
		echo '<meta property="og:description" content="' . $ogObj['ogDesc'] . '">';
	}
?>

<title>
<?php
	$title=$i->title($p,$pi,$idNSP_i,$idLoaispGT,$idLoaispDSG,$option,$lsp,$idTin);
	echo $title;
?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/style-responsive.css"/>
<link rel="stylesheet" type="text/css" href="css/slider_home.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css"/>
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="css/slidebars.css"/>
<script type="text/javascript" src="js/jquery-1.11.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/slidebars.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-vi.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="js/local-cache.js"></script>
<script>
	$(document).ready(function(e) {
		$.slidebars();
		//var title=$("#title").text();
		//$(this).attr("title",title);
		$( "#country" ).bind({
			hover: function() {
				$('#country_list').show();
			},
			mouseleave: function() {
				$('#country_list').hide();
			}
		});
		//Dang ki nhan ban tin
		$("#email_sub").click(function(e) {
			var email=$("input[name='email_news']").val();
			$("#thank").load("emailmarketing.php?email="+email);
        });
		//lay so luong tu input gan vao gio hang
		var tongsl=$("#tongsl").val();
		$("#num_in_cart").text(tongsl);
		//hien gio hang tom tat khi re chuot vao gio hang
		$("#header_cart").on("mouseenter","#header_cart_button",function(){
			$("#cart_sum").stop().slideDown();
		});
		$("#header_cart").on("mouseleave","#header_cart_button",function(){
			setTimeout(function(){
				$("#cart_sum").stop().slideUp();
			},1000);
		});
		//kiem tra du lieu search
		$("#s_btn").click(function(e) {
			var s=$("#s_txt").val();
            if(s=="Gõ từ khóa để tìm kiếm"||s=="Type to search")
				return false;
        });
		//show login for
        $("#link_login").click(function(e) {
            $(".form-login").toggle();
			e.stopPropagation();
        });
		//hide login form when click outside
		$(document).click(function(e) {
			if (!$(e.target).is('.form-login, .form-login *')) {
				$(".form-login").hide();
			}
    	});
		//show account panel when hover hello username div
        $("#hello-box").bind({
            hover: function() {
                $('.account').show();
            },
            mouseleave: function() {
                $('.account').hide();
            }
        });
		//show wishlist when hover
        $("#wishlist").bind({
            hover: function() {
                $('.wishlist-detail').show();
            },
            mouseleave: function() {
                $('.wishlist-detail').hide();
            }
        });
        //Show notification when wrong email or pass
        $("#notification").delay(5000).fadeOut(500);
		$("#notification_success").delay(10000).fadeOut(500);
		//validate formdangnhap
        $('#formdangnhap').validationEngine();
		//scroll down and keep menu on position
        $(window).bind('scroll', function() {
        var navHeight = 150;
             if ($(window).scrollTop() > navHeight) {
                 $('.nav').addClass('fixed');
             }
             else {
                 $('.nav').removeClass('fixed');
             }
        });
		$(".support_online").click(function(e) {
			e.preventDefault();
            $(".sbzoff").click();
        });
    });//document.ready
	function chuyenngonngu(lang){
		$.cookie("lang",lang,{ expires: 7 ,path:'/'});
		window.location.reload();
	}
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-58262465-1', 'auto');
  ga('send', 'pageview');
</script>
<script type='text/javascript'>window._sbzq||function(e){e._sbzq=[];var t=e._sbzq;t.push(["_setAccount",13158]);var n=e.location.protocol=="https:"?"https:":"http:";var r=document.createElement("script");r.type="text/javascript";r.async=true;r.src=n+"//static.subiz.com/public/js/loader.js";var i=document.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)}(window);</script>
</head>
<body <?php if($p=="cart_dn_dk" && $_SERVER["HTTP_REFERER"]="http://bitas.com.vn/index.php?p=cart_ttkh" && isset($_SESSION['id'])) {?> onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="" <?php }?>>
<div id="sb-site">
<?php require_once "header.php"; ?>
<div id="wrapper">
	<?php 
  		if($checkPA){
	?>
    	
        <div class="promotion-banner">
        	<?php if($pro_code=="NOEL2015"){?>
        		<a href="http://bitas.com.vn/news/detail/50/" ><img src="img/banner/giang-sinh-2015-banner-small.jpg" alt="giang sinh an lanh" /></a>
            <?php }elseif($pro_code=="DONXUAN2016"){?>
            	<a href="http://bitas.com.vn/news/detail/51/" ><img src="img/banner/banner-don-xuan-2016.jpg" alt="giang sinh an lanh" /></a>
            <?php }?>
        </div>
        
        <?php }//end check promotion active?>
    <?php
        if(isset($_SESSION['thongbao_error'])){
    ?>
        <div id="notification" class="box_size">
            <h2>{Error}</h2>
            <img src="img/remove_icon.png" class="close" alt="close" title"{Close}">
            <p><?php echo $_SESSION['thongbao_error']; unset($_SESSION['thongbao_error']);?></p>
        </div>
    <?php }
		if(isset($_SESSION['thongbao_success'])){
	?>
    	<div id="notification_success" class="box_size">
			<?php echo $_SESSION['thongbao_success']; unset($_SESSION['thongbao_success']);?>
        </div>
    <?php }?>
  <?php if($p!="" && $p!="product" && $p!="detail" && $p!="cart" && $p!="cart_dn_dk" && $p!="cart_ttkh" && $p!="cart_finish" && $p!="search" && $p!="quayso") require_once "breadcrumb.php";
  ?>
  <div class="clear"></div>
  <div id="content" class="box_size">
  	<?php 
		if($p=='product') 
			require_once 'product.php';
		elseif($p=='detail')
			require_once 'detail.php';
		elseif($p=='cart')
			require_once 'cart.php';
		elseif($p=='cart_dn_dk')
			require_once 'cart_dangnhap_dangki.php';
		elseif($p=='cart_ttkh')
			require_once 'cart_ttkh.php';
		elseif($p=='cart_finish')
			require_once 'cart_finish.php';
		elseif($p=='online_shopping')
			require_once 'online_shopping.php';
		elseif($p=='taikhoan')
			require_once 'taikhoan.php';
		else
		{
	?> 
    <?php if($p=="") {?>
    <div id="pagewrap">
        <?php require_once "slider_home.php";?>
	  </div><!-- end pagewrap -->
    <?php }?>
    <div class="clear"></div>
        <div id="content_inside box_size">
          <div id="content_center" class="box_size">

            <?php 
				if($p=='delivery_system')
					require_once 'deliverysystem.php';
				elseif($p=='gioithieu')
					require_once 'gioithieu.php';
				elseif($p=='detail_news')
					require_once 'detail_news.php';
				elseif($p=='tintuc')
					require_once 'tintuc.php';
				elseif($p=='khuyenmai')
					require_once 'khuyenmai.php';
				elseif($p=='detail_km')
					require_once 'detail_km.php';
				elseif($p=='tuyendung')
					require_once 'tuyendung.php';
				elseif($p=='thanhvien')
					require_once 'thanhvien.php';
				elseif($p=='lienhe')
					require_once 'lienhe.php';
				elseif($p=='dangki')
					require_once 'dangkithanhvien.php';
				elseif($p=='dangnhap')
					require_once 'dangnhap.php';
				elseif($p=='search')
					require_once 'search.php';
				elseif($p=='quenpass')
					require_once 'taikhoan_quenpass.php';
				elseif($p=='quenpass_doipass')
					require_once 'taikhoan_quenpass_doipass.php';
				elseif($p=='doi_baohanh_map')
					require_once 'doi_baohanh_map.php';
				elseif($p=='hethongcuahangle')
					require_once 'hethongcuahangle.php';
				elseif($p=='chinhsach_baomat')
					require_once 'chinhsach_baomat.php';
				elseif($p=='chinhsach_hotrovanchuyen')
					require_once 'chinhsach_hotrovanchuyen.php';
				elseif($p=='chinhsach_doihang')
					require_once 'chinhsach_doihang.php';
				elseif($p=='chinhsach_baohanh')
					require_once 'chinhsach_baohanh.php';
				elseif($p=='chinhsach_huydonhang')
					require_once 'chinhsach_huydonhang.php';
				elseif($p=='huongdan_muahang')
					require_once 'huongdan_muahang.php';
				elseif($p=='huongdan_thanhtoan')
					require_once 'huongdan_thanhtoan.php';
				elseif($p=='huongdan_chonsize')
					require_once 'huongdan_chonsize.php';
				elseif($p=='baochitruyenthong')
					require_once 'baochitruyenthong.php';
				elseif($p=='faq')
					require_once 'faq.php';
				elseif($p=='dieukhoansudung')
					require_once 'dieukhoansudung.php';
				elseif($p=='quayso')
					require_once 'custompage/quayso.php';
				else{
			?>
            	<?php require_once 'main_banner.php';?>
                <div class="clear"></div>
                <div class="hot-product">
                	<div class="header">
                    	<h1>{Fav_product}</h1>
                        <div class="hot-product-content">
                        	<?php require_once "hot_product.php" ?>
                        </div>
                    </div>
                </div><!-- end hot-product -->
                <div class="short-intro box_size">
					<div class="intro-bottom-title">
                 		<p>Bita's - Đến với mọi khoảng cách</p>
				  		<p>Thương hiệu giày hàng đầu Việt Nam</p>
					</div>
                  <p class="intro-bottom-text">Bita’s online được thành lập vào ngày 01/08/2014 và thuộc sở hữu của Công ty TNHH Sản xuất Hàng tiêu dùng Bình Tân (BITA’S) - một trong những công ty hàng đầu trong lĩnh vực sản xuất, kinh doanh giày dép chất lượng cao tại thị trường Việt Nam. Bitas.com.vn là website thương mại điện tử chuyên về giày dép chính hãng nhằm mang lại cho quý khách hàng một kênh thông tin mua sắm tiện lợi, hữu ích và nhanh chóng.</p>
                  <div id="feature-with-icon">
                  	<ul>
                    	<li class="quality box_size">
                        	<img src="img/icon/icon-quality.png" alt="chat luong tot, gia hop ly" />
                            <p>Chất lượng tốt</p>
                            <p>Giá hợp lý</p>
                        </li>
                        <li class="cod box_size">
                        	<img src="img/icon/icon-payment.png" alt="thanh toan linh hoat" />
                        	<p>Thanh toán</p>
                            <p>Linh hoạt</p>
                        </li>
                        <li class="return box_size">
                        	<img src="img/icon/icon-return-2.png" alt="10 ngay doi hang" />
                        	<p>10 ngày</p>
                            <p>đổi hàng</p>
                        </li>
                        <li class="warranty box_size">
                        	<img src="img/icon/icon-60.png" alt="bao hanh 2 thang" />
                            <p>Bảo hành</p>
                            <p>2 tháng</p></li>
                    </ul>
                  </div>
                </div>
            <?php }?>
	</div><!-- end content_center-->
	<?php }?>
  </div> <!--end_content_inside-->
</div> <!--end_content--> 
</div><!--end_wrapper-->
<?php require_once "footer.php"; ?>
</div><!-- end sb-site -->
<div class="sb-slidebar sb-left">
    <div class="m-reg-log">
    	<?php if(!isset($_SESSION['id'])) {?><div id="reg" class="box_size"><a href="user/dang-ki/"><i class="fa fa-user"></i>{Register}</a></div><?php } ?>
        <div id="login" class="box_size">
            <?php if(isset($_SESSION['id'])==false){?>
                <a href="user/dang-nhap/" id="link_login"><i class="fa fa-sign-in"></i>{Login}</a>
            <?php 
            } else {
                $ht_arr=explode(" ", $_SESSION['hoten']);
            ?>
            <div id="hello-box">
                <div class="toggle-menu">
                	<span id="hello">Xin chào, <?php echo $ht_arr[count($ht_arr)-1];?>!</span>
                    <i class="fa fa-plus toggle-button"></i>
				</div>
                <ul class="sub-menu">
                    <li><a href="user/tai-khoan/">{My_Account}</a></li>
                    <li><a href="user/don-hang/">{My_Order}</a></li>
                    <li><a href="user/doi-mat-khau/">{Change_Pass}</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">{Logout}</a></li>
                </ul>
            </div><!-- end hello_box -->
            <?php }?>
        </div><!-- end login -->
    </div><!-- end m-reg-log -->
    <div class="hd-mua-hang large-links">
    	<p><a href="cat/huong-dan-mua-hang/"><i class="fa fa-book"></i> Hướng dẫn mua hàng</a></p>
    </div><!-- end hd-mua-hang -->
    <div class="online-support large-links">
    	<p><a href="#nogo" onclick="_sbzq.push(['expandWidget']);"><i class="fa fa-question-circle"></i> Hỗ trợ trực tuyến</a></p>
    </div><!-- end online-support -->
    <nav class="nav-menu">
    	<ul>
        	<li><a href="home.bitas">Trang chủ</a></li>
            <li>
            	<div class="toggle-menu">
	            	<a class="new" href="san-pham/option/hang-moi/">Hàng mới</a>
                    <i class="fa fa-plus toggle-button"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="san-pham/option/hang-moi/nam/">Nam</a></li>
                    <li><a href="san-pham/option/hang-moi/nu/">Nữ</a></li>
                    <li><a href="san-pham/option/hang-moi/be-trai/">Bé trai</a></li>
                    <li><a href="san-pham/option/hang-moi/be-gai/">Bé gái</a></li> 
                    <li><a href="san-pham/option/hang-moi/thoi-trang/">Thời trang</a></li>
                </ul>
            </li>
            <li>
            	<div class="toggle-menu">
	            	<a class="men" href="san-pham/nam/">Nam</a>
                    <i class="fa fa-plus toggle-button"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="san-pham/nam/dep-nam/">{Foot_wear}</a></li>
                    <li><a href="san-pham/nam/sandal-nam/">Sandals</a></li>
                    <li><a href="san-pham/nam/giay-nam/">{Shoes}</a></li>
                    <li><a href="san-pham/nam/thoi-trang-nam/">{Fashion}</a></li>
                </ul>
            </li>
            <li>
            	<div class="toggle-menu">
	            	<a class="women" href="san-pham/nu/">Nữ</a>
                    <i class="fa fa-plus toggle-button"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="san-pham/nu/dep-nu/">{Foot_wear}</a></li>
                    <li><a href="san-pham/nu/sandal-nu/">Sandals</a></li>
                    <li><a href="san-pham/nu/giay-nu/">{Shoes}</a></li>
                    <li><a href="san-pham/nu/thoi-trang-nu/">{Fashion}</a></li>
                </ul>
            </li>
            <li>
            	<div class="toggle-menu">
	            	<a class="baby_boy" href="san-pham/giay-tre-em-be-trai/">Bé trai</a>
                    <i class="fa fa-plus toggle-button"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="san-pham/giay-tre-em-be-trai/dep-be-trai/">{Foot_wear}</a></li>
                    <li><a href="san-pham/giay-tre-em-be-trai/sandal-be-trai/">Sandals</a></li>
                    <li><a href="san-pham/giay-tre-em-be-trai/giay-be-trai/">{Shoes}</a></li>
                </ul>
            </li>
            <li>
            	<div class="toggle-menu">
	            	<a class="baby_girl" href="san-pham/giay-tre-em-be-gai/">Bé gái</a>
                    <i class="fa fa-plus toggle-button"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="san-pham/giay-tre-em-be-gai/dep-be-gai/">{Foot_wear}</a></li>
                    <li><a href="san-pham/giay-tre-em-be-gai/sandal-be-gai/">Sandals</a></li>
                    <li><a href="san-pham/giay-tre-em-be-gai/giay-be-gai/">{Shoes}</a></li>
                </ul>
            </li>
            <li>
            	<div class="toggle-menu">
	            	<a class="sale_off" href="san-pham/option/hang-giam-gia/">Giảm giá</a>
                    <i class="fa fa-plus toggle-button"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="san-pham/option/hang-giam-gia/nam/">Nam</a></li>
                    <li><a href="san-pham/option/hang-giam-gia/nu/">Nữ</a></li>
                    <li><a href="san-pham/option/hang-giam-gia/be-trai/">Bé trai</a></li>
                    <li><a href="san-pham/option/hang-giam-gia/be-gai/">Bé gái</a></li>  
                    <li><a href="san-pham/option/hang-giam-gia/thoi-trang/">Thời trang</a></li>
                </ul>
            </li>
        </ul>
    </nav><!-- end nav-menu -->
</div><!-- end sl-slidebar -->
<script>
		/* SCRIPT TO TOP*/
		$(document).ready(function(e) {
			$body = $("body");
			$(document).on({
				ajaxStart: function() { $body.addClass("loading");},
				 ajaxStop: function() { $body.removeClass("loading"); }    
			});
			$("#to_top").hide();
			$(function (){
				$(window).scroll(function(){
						if($(this).scrollTop()>100)
						{
							$('#to_top').fadeIn(300);
						}
						else
						{
							$('#to_top').fadeOut(300);
						}
				});
				$("#to_top").click(function(e) {
					$("body,html").animate({ scrollTop:0},800);
					return false;
				});
			});
			// Toggle mobile navigation menu
			$(".toggle-menu .toggle-button").on("click", function(){
				$this = $(this);
				if($this.hasClass("fa-plus")){
					$this.removeClass("fa-plus").addClass("fa-minus");
				}else{
					$this.removeClass("fa-minus").addClass("fa-plus");
				}
				$this.parent().next().slideToggle(300);
			})
			$(".search-toggle").on("click", function(){
				//$this=$(this);
				//var data=$this.attr("data-toggle");
				$(".nav-search").slideToggle(300);
			});
			//Show POPUP
			/*
			if(typeof(Storage) !== "undefined"){
				if(localStorage.getCacheItem("popup")!="show"){
				
				var innerWidth = $(window).innerWidth();
				if(innerWidth>768){
					setTimeout(function(){	
						$( "#dialog" ).dialog({
							modal: true,
							width: 38 + '%',
							show: {
								effect: "fade",
								duration: 500
							},
							hide: {
								effect: "fade",
								duration: 300
							}	
						});
						$(".ui-dialog").css({"position":"fixed","top":"10%","background":"transparent","border":"none","left":"50%","margin-left":"-19%"});
						localStorage.setCacheItem("popup", "show", { days: 1 });
					}, 500);
				}
				else{
					setTimeout(function(){	
						$( "#dialog" ).dialog({
							modal: true,
							width: 90 + '%',
							show: {
								effect: "fade",
								duration: 500
							},
							hide: {
								effect: "fade",
								duration: 300
							}	
						});
						$(".ui-dialog").css({"position":"fixed","top":"10%","background":"transparent","border":"none","left":"50%","margin-left":"-45%"});
						localStorage.setCacheItem("popup", "show", { days: 1 });
					}, 500);
				}
				}else{
				}
			}else{
				alert("Lalalalalala, I love u baby");
			}
			*/
			// display site down notice
			/*
			if($.cookie("enter")=="yes")
				$(".overlay").remove();		
			$(".input-text").keypress(function(e) {
				var pass=$(".input-text").val();
				if(e.which == 13) {
					if(pass=="bitas1628"){
						$(".overlay").remove();
						var date = new Date();
 						var minutes = 300;
 						date.setTime(date.getTime() + (minutes * 60 * 1000));
						$.cookie("enter","yes",{ expires: date ,path:'/'});
						window.location.reload();
					}
					else
						alert("Wrong password. Please try again.");
				}
			});
			*/
		});
</script>
<div id="to_top">{To_Top}</div>
<div id="dialog" title="" style="display: none">
<a href="#"><img src="img/st/thong-bao-dut-cap.jpg" usemap="#popup" alt="thong bao dut cap"  /></a>
</div>
<div class="modal"></div>
<!-- display site down -->
<!--
<div class="overlay">
	<div class="site-down">
    	<a href="https://www.facebook.com/bitasfootwear"><img src="img/site-down.jpg"  /></a>
        <input type="password" class="input-text" placeholder="Type password to enter" />
    </div>
</div>
-->
<!-- end display site down -->
</body>
</html>