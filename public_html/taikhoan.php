<?php

	require_once "checklogin.php";

	if(isset($_GET['pi']))

		$pi=$_GET['pi'];

		

	if(isset($_SESSION['email']))

		$email=$_SESSION['email'];

	$tt=$i->LayQuanHuyenTinhThanhTheoEmail($email);

	$row_tt=mysql_fetch_assoc($tt);

?>

<script type="text/javascript" src="js/jquery.validationEngine-vi.js"></script>

<script type="text/javascript" src="js/jquery.validationEngine.js"></script>

<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/sweet-alert.js"></script>
<script>

$(document).ready(function(e) {
		$('#f_changepass').validationEngine();
		$('.remove').click(function(e) {
			e.preventDefault();
			var idAB=$(this).attr("data-idAB");
            swal({
			  title: "Bạn chắc chứ?",
			  text: "Bạn sẽ không thể hoàn tác lại bước này!",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Vâng, tôi muốn xóa!",
			  cancelButtonText: "Không, tôi không muốn!",
			  closeOnConfirm: false,
			  closeOnCancel: false
			},
			function(isConfirm){
			  if (isConfirm) {
				swal("Đã xóa!", "Địa chỉ của bạn đã được xóa.", "success");
				document.location="taikhoan_xoadiachigiaohang.php?idAB="+idAB;
			  } else {
					swal("Hoàn tác", "Địa chỉ của bạn vẩn an toàn :)", "error");
			  }
			});
        });
});

</script>
<link rel="stylesheet" href="css/sweet-alert.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css"/>

<div id="taikhoan" class="box_shadow box_size">

	<div id="tk_left" class="box_size">

    	<div id="tk_nav">

        <h1 class="title page_title">{Account}</h1>

        	<ul>

            	<li <?php if($pi==""||$pi=="taikhoan_doidiachigiaohang"||$pi=="taikhoan_themdiachigiaohang") echo "class='active'"?>><a href="user/tai-khoan/"><i class="fa fa-user"></i> {My_Account}</a></li>

                <li <?php if($pi=="taikhoan_doithongtin") echo "class='active'"?>><i class="fa fa-book"></i> <a href="user/doi-thong-tin/">{Account_Info}</a></li>

                <li <?php if($pi=="taikhoan_doidiachi") echo "class='active'"?>><i class="fa fa-map-marker"></i> <a href="user/doi-dia-chi/">{Address}</a></li>
				<li <?php if($pi=="taikhoan_tienthuong") echo "class='active'"?>><i class="fa fa-usd"></i>
</i> <a href="user/tien-thuong/">Tiền thưởng</a></li>
                <li <?php if($pi=="taikhoan_wishlist") echo "class='active'"?>><i class="fa fa-heart"></i> <a href="user/wish-list/">{Wishlist}</a></li>

                <li <?php if($pi=="taikhoan_donhang" || $pi=="taikhoan_donhangchitiet") echo "class='active'"?>><i class="fa fa-history"></i> <a href="user/don-hang/">{Order_History}</a></li>

            </ul>

        </div>

    </div><!--end_tk_left-->

    <div id="tk_right" class="box_size">

    <?php

    	if($pi=="taikhoan_doimatkhau")

			require_once "taikhoan_doimatkhau.php";

		elseif($pi=="taikhoan_doithongtin")

			require_once "taikhoan_doithongtin.php";

		elseif($pi=="taikhoan_doidiachi")
			require_once "taikhoan_doidiachi.php";
		elseif($pi=="taikhoan_themdiachigiaohang")
			require_once "taikhoan_themdiachigiaohang.php";

		elseif($pi=="taikhoan_doidiachigiaohang")

			require_once "taikhoan_doidiachigiaohang.php";

		elseif($pi=="taikhoan_donhang")

			require_once "taikhoan_donhang.php";

		elseif($pi=="taikhoan_donhangchitiet")

			require_once "taikhoan_donhangchitiet.php";

		elseif($pi=="taikhoan_wishlist")

			require_once "taikhoan_wishlist.php";
		elseif($pi=="taikhoan_tienthuong")

			require_once "taikhoan_tienthuong.php";	

		else{

	?>

    	<h1 class="title page_title">{My_Account}</h1>

        <h3>{Hello} <?php echo $_SESSION['hoten']?></h3>

        <p class="info">{Order_Intro}</p>

        <div class="clear"></div>

        <div class="box_tk">

        	<h1 class="page_title title">{Contact_Info}</h1>

            <div class="box_tk_info">
            	<div class="personal-info">
                    <p><?php echo $_SESSION['hoten']?></p>
                    <p><?php echo $_SESSION['email']?></p>
                    <p><a href="user/doi-mat-khau/">{Change_Pass}</a></p>
                    <p><a href="user/doi-thong-tin/" class="btn">{Change_Info}</a></p>
                </div>

                <div class="personal-address">

                	<p>{Address}: <?php echo $_SESSION['diachi']?>, <?php echo $row_tt['typePhuong']." ".$row_tt['TenPhuong']?>, <?php echo $row_tt['type']." ".$row_tt['TenQH']?>, <?php echo $row_tt['TenTT']?></p>

                	<p>{Tel}: <?php echo $_SESSION['dienthoai']?></p>

                	<p><a href="user/doi-dia-chi/" class="btn">{Change}</a></p>

                </div>

            </div>

        </div>

        <div class="box_tk">

        	<h1 class="page_title title">{Address_and_Delivery}</h1>

            <div class="box_tk_info">
            	<?php
                	$ab=$i->listAddressBook($_SESSION['id']);
					$n_ab=mysql_num_rows($ab);
					while($row_ab=mysql_fetch_assoc($ab)){
						$idTinh=$row_ab['idTinh'];
						$idQH=$row_ab['idQuanHuyen'];
						$idPhuong=$row_ab['idPhuong'];
						$tinh=$i->ChiTietTinhThanh($idTinh);
						$row_tinh=mysql_fetch_assoc($tinh);
						$qh=$i->ChiTietQuanHuyen($idQH);
						$row_qh=mysql_fetch_assoc($qh);
						$px=$i->ChiTietPhuong($idPhuong);
						$row_px=mysql_fetch_assoc($px);
				?>
            	<div class="addressbook-ele idAB-<?php echo $row_ab['idAB']?>">
                	<div class="addressbook-text">
                        <p><?php echo $row_ab['HoTen']?>, <?php echo $row_ab['DienThoai']?></p>
                        <p><?php echo $row_ab['DiaChi'].", ".$row_px['type']." ".$row_px['Ten'].", ".$row_qh['type']." ".$row_qh['Ten'].", ".$row_tinh['Ten']?></p>
                    </div>
                    <div class="addressbook-button">
						<?php if($n_ab>1){?><a href="" class="btn remove" data-idAB="<?php echo $row_ab['idAB']?>">Xóa</a><?php }?>
                        <a href="user/doi-dia-chi-giao-hang/<?php echo $row_ab['idAB']?>/" class="btn change">Thay đổi</a>
                    </div>
                </div>
                <?php }?>
                <a href="user/them-dia-chi-giao-hang/" class="btn">Thêm địa chỉ giao hàng</a>
            </div>
        </div>
    <?php }?>

    </div><!--end_tk_right-->

</div><!--end_taikhoan-->