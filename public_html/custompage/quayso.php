<?php
	if (isset($_SESSION['id'])== false){
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
?>
	<div class="bridge">
    	<div class="game-nav">
        	<ul>
            	<li class="active" data-content="#content-1">Gắn kết<br />mọi miền</li>
                <li data-content="#content-2">Thể lệ<br />chương trình</li>
            </ul>
        </div><!-- /.game-nav -->
        <div class="game-content">
            <div id="content-1" class="game content">
            	<p class="chaomung">Chào Mừng Đại Lễ 30/04 Giải Phóng Miền Nam</p>
                <div class="game-banner">
                    <img src="../img/st/game/game-banner-1.png" alt="" title="Vòng quay may mắn gắn kết mọi miền" />
                </div>
                <div class="game-intro">
                     Tặng tiền thưởng mua hàng trên website Bita’s khi tham gia chương trình từ 22/4 - 5/5/2015
                </div>
                <div class="login-register">
                    <a href="user/dang-nhap/" class="login">Đăng nhập</a>
                    <a href="user/dang-ki/" class="register">Đăng ký</a>
                </div>
             </div><!-- /#game -->
             <div id="content-2" class="rule content">
                <h1>THỂ LỆ CHƯƠNG TRÌNH</h1>
                <div class="rule-detail">
                    <p><span class="red">1. Tên chương trình khuyến mại:</span>GẮN KẾT MỌI MIỀN</p>
                    <p><span class="red">2. Thời gian diễn ra:</span> 22/04/2015 – 05/05/2015</p>
                    <p><span class="red">3. Hình thức khuyến mại:</span> Giảm giá - Khách hàng khi tham gia chương trình <strong>Gắn Kết Mọi Miền</strong> sẽ có cơ hội nhận tiền thưởng với giá trị lên đến <strong>100.000 VNĐ</strong> bằng cách nhấn nút <strong>"Nhận Tiền Ngay"</strong> khi truy cập website <a href="http://bitas.com.vn">www.bitas.com.vn</a>. Số tiền sẽ được lưu tại mục <strong>Tiền Thưởng và sẽ được áp dụng trừ trực tiếp trên đơn hàng từ 399.000VNĐ trở lên.</strong></p>
                    <p><span class="red">4. Nội dung chi tiết thể lệ chương trình:</span></p>
                    <div class="rule-more-detail">
                        <p>B1: Truy cập website: <a href="http://bitas.com.vn">www.bitas.com.vn</a></p>
                        <p>B2: Đăng ký/ đăng nhập tài khoản.</p>
                        <p>B3: Nhấn vào nút NHẬN TIỀN NGAY.</p>
                        <p>B4: Xem tiền thưởng.</p>
                        <p>B5: Kiểm tra tiền thưởng tại mục Tiền thưởng. Tiền thưởng sẽ tự động trừ khi mua hàng với hóa đơn trên 399.000 VNĐ.</p>
                    </div>
                    <p>- Mỗi ngày, mỗi khách hàng sẽ có 01 cơ hội nhận tiền thưởng.</p>
                    <p>- Để có thêm cơ hội nhận tiền thưởng trong ngày, quý khách vui lòng sử dụng hết số tiền được thưởng trước đó.</p>
                    <p>- Thời gian chương trình bắt đầu từ <strong>9h00 ngày 22/04/2015 cho đến 23h59 phút ngày 05/05/2015.</strong></p>
            		<p>- Số tiền thưởng sẽ tự động lưu vào mục tiền thưởng trong Tài khoản của tôi.</p>
                    <p>- Số tiền thưởng không sử dụng trong ngày sẽ tự động xóa vào <strong>23h59 phút hàng ngày</strong>.</p>
                    <p>- Chính sách hỗ trợ vận chuyển vẫn được áp dụng cho chương trình khuyến mại này.</p> 
                </div><!-- /.rule-detail -->
             </div><!-- /#rule -->
        </div><!-- /.game-content -->
    </div><!-- /.bridge -->
<?php	
	} // end check login
	else{//logged
	$pro = $i->ListTienThuongTuTinhThanh();
?>
<?php
	$checkPlay = $i->CheckDaChoiHayChua($_SESSION['email']);
	if(!$checkPlay){
?>
<div class="game-play">
    <div class="game-nav">
        <ul>
            <li class="active" data-content="#content-1">Gắn kết<br />mọi miền</li>
            <li data-content="#content-2">Thể lệ<br />chương trình</li>
        </ul>
    </div><!-- /.game-nav -->
    <div class="game-content">
        <div id="content-1" class="game content">
        	<p class="chaomung">Chào Mừng Đại Lễ 30/04 Giải Phóng Miền Nam</p>
            <div class="game-banner">
                <img src="../img/st/game/game-banner-1.png" alt="" title="Vòng quay may mắn gắn kết mọi miền" />
            </div>
            <div class="game-intro">
                Tặng tiền thưởng mua hàng trên website Bita’s khi tham gia chương trình từ 22/4 - 5/5/2015
                <p>Để tham gia, vui lòng nhấn nút <span class="nhantien">"NHẬN TIỀN NGAY"</span> và xem kết quả số tiền thưởng bên dưới</p>
            </div>
            <div class="play-main">
                <div class="play-box">
                	<?php
						while($row_pro = mysql_fetch_assoc($pro)){
							$pro_name .= $row_pro['GiaTri_Str'] . ',';
							$idTienThuong = $row_pro['idTienThuong'];
							$idTienThuong_str .= $idTienThuong . ',';
							$tienthuong = $i->detailTienThuong($idTienThuong);
							$row_tienthuong = mysql_fetch_assoc($tienthuong);
							$tienthuong_str .= number_format($row_tienthuong['GiaTri'],0,".",".") . ',';
						}
						$pro_name = substr($pro_name,0,-1);
						$idTienThuong_str = substr($idTienThuong_str,0,-1);
						$tienthuong_str = substr($tienthuong_str,0,-1);
					?>
					<input type="hidden" value="<?php echo $pro_name; ?>" data-id-money="<?php echo $idTienThuong_str; ?>" data-money="<?php echo $tienthuong_str; ?>" class="province-name" data-id-money-final="" data-email="<?php echo $_SESSION['email']; ?>" />
                    <div id="output">Số tiền của bạn</div>
					<button class="play"></button>
                </div><!-- /.play-box -->
                <div class="notice">
                    <p>Chúc mừng bạn đã nhận được số tiền thưởng là <span class="echo-money"></span> VNĐ</p>
                    <a href="home.bitas" class="shopping-now">Mua sắm ngay</a>
                </div>
                
            </div><!-- /.play-main -->
         </div><!-- /#game -->
         <div id="content-2" class="rule content">
            <h1>THỂ LỆ CHƯƠNG TRÌNH</h1>
            <div class="rule-detail">
                <p><span class="red">1. Tên chương trình khuyến mại:</span>GẮN KẾT MỌI MIỀN</p>
                <p><span class="red">2. Thời gian diễn ra:</span> 22/04/2015 – 05/05/2015</p>
                <p><span class="red">3. Hình thức khuyến mại:</span> Giảm giá - Khách hàng khi tham gia chương trình <strong>Gắn Kết Mọi Miền</strong> sẽ có cơ hội nhận tiền thưởng với giá trị lên đến <strong>100.000 VNĐ</strong> bằng cách nhấn nút <strong>"Nhận Tiền Ngay"</strong> khi truy cập website <a href="http://bitas.com.vn">www.bitas.com.vn</a>. Số tiền sẽ được lưu tại mục <strong>Tiền Thưởng và sẽ được áp dụng trừ trực tiếp trên đơn hàng từ 399.000VNĐ trở lên.</strong></p>
                <p><span class="red">4. Nội dung chi tiết thể lệ chương trình:</span></p>
                <div class="rule-more-detail">
                    <p>B1: Truy cập website: <a href="http://bitas.com.vn">www.bitas.com.vn</a></p>
                    <p>B2: Đăng ký/ đăng nhập tài khoản.</p>
                    <p>B3: Nhấn vào nút NHẬN TIỀN NGAY.</p>
                    <p>B4: Xem tiền thưởng.</p>
                    <p>B5: Kiểm tra tiền thưởng tại mục Tiền thưởng. Tiền thưởng sẽ tự động trừ khi mua hàng với hóa đơn trên 399.000 VNĐ.</p>
                </div>
                <p>- Mỗi ngày, mỗi khách hàng sẽ có 01 cơ hội nhận tiền thưởng.</p>
                <p>- Để có thêm cơ hội nhận tiền thưởng trong ngày, quý khách vui lòng sử dụng hết số tiền được thưởng trước đó.</p>
                <p>- Thời gian chương trình bắt đầu từ <strong>9h00 ngày 22/04/2015 cho đến 23h59 phút ngày 05/05/2015.</strong></p>
                <p>- Số tiền thưởng sẽ tự động lưu vào mục tiền thưởng trong Tài khoản của tôi.</p>
                <p>- Số tiền thưởng không sử dụng trong ngày sẽ tự động xóa vào <strong>23h59 phút hàng ngày</strong>.</p>
                <p>- Chính sách hỗ trợ vận chuyển vẫn được áp dụng cho chương trình khuyến mại này.</p> 
            </div><!-- /.rule-detail -->
         </div><!-- /#rule -->
    </div><!-- /.game-content -->
</div><!-- /.bridge -->
<?php }else{?>
<div class="out-of">
    <div class="notify">
    <h1>Để có thêm cơ hội nhận tiền thưởng,<span class="break-desktop"></span> vui lòng sử dụng hết số tiền thưởng trước đó</h1>
    <a href="home.bitas" class="shopping-now">Mua sắm ngay</a>
    </div><!-- /.notify -->
    <div class="rule">
        <h1>THỂ LỆ CHƯƠNG TRÌNH</h1>
        <div class="rule-detail">
            <p><span class="red">1. Tên chương trình khuyến mại:</span>GẮN KẾT MỌI MIỀN</p>
            <p><span class="red">2. Thời gian diễn ra:</span> 22/04/2015 – 05/05/2015</p>
            <p><span class="red">3. Hình thức khuyến mại:</span> Giảm giá - Khách hàng khi tham gia chương trình <strong>Gắn Kết Mọi Miền</strong> sẽ có cơ hội nhận tiền thưởng với giá trị lên đến <strong>100.000 VNĐ</strong> bằng cách nhấn nút <strong>"Nhận Tiền Ngay"</strong> khi truy cập website <a href="http://bitas.com.vn">www.bitas.com.vn</a>. Số tiền sẽ được lưu tại mục <strong>Tiền Thưởng và sẽ được áp dụng trừ trực tiếp trên đơn hàng từ 399.000VNĐ trở lên.</strong></p>
            <p><span class="red">4. Nội dung chi tiết thể lệ chương trình:</span></p>
            <div class="rule-more-detail">
                <p>B1: Truy cập website: <a href="http://bitas.com.vn">www.bitas.com.vn</a></p>
                <p>B2: Đăng ký/ đăng nhập tài khoản.</p>
                <p>B3: Nhấn vào nút NHẬN TIỀN NGAY.</p>
                <p>B4: Xem tiền thưởng.</p>
                <p>B5: Kiểm tra tiền thưởng tại mục Tiền thưởng. Tiền thưởng sẽ tự động trừ khi mua hàng với hóa đơn trên 399.000 VNĐ.</p>
            </div>
            <p>- Mỗi ngày, mỗi khách hàng sẽ có 01 cơ hội nhận tiền thưởng.</p>
            <p>- Để có thêm cơ hội nhận tiền thưởng trong ngày, quý khách vui lòng sử dụng hết số tiền được thưởng trước đó.</p>
            <p>- Thời gian chương trình bắt đầu từ <strong>9h00 ngày 22/04/2015 cho đến 23h59 phút ngày 05/05/2015.</strong></p>
            <p>- Số tiền thưởng sẽ tự động lưu vào mục tiền thưởng trong Tài khoản của tôi.</p>
            <p>- Số tiền thưởng không sử dụng trong ngày sẽ tự động xóa vào <strong>23h59 phút hàng ngày</strong>.</p>
            <p>- Chính sách hỗ trợ vận chuyển vẫn được áp dụng cho chương trình khuyến mại này.</p> 
        </div><!-- /.rule-detail -->
    </div><!-- /#rule -->
</div><!-- /.out-of -->
<?php }}?>
<script type="text/javascript">	 
	$('.play').on('click', function(e){
		animateProvince();
		$(this).attr('disabled','disabled');
		setTimeout(function(){
			$('.notice').fadeIn();
			idTienThuong = $('.province-name').attr('data-id-money-final');
			email = $('.province-name').attr('data-email');
			$.ajax({
                type:'POST',
                url:"ajax_update_tienthuong.php",
                cache:false,
                data:{idTienThuong:idTienThuong,email:email},
                success: function(){
                }
            });
		},3500);
	});
	function animateProvince(){
		var output, started, duration, pros_str;
		// Constants
		duration = 3000;
		// Initial setup
		output = $('#output');
		started = new Date().getTime();
		pros_str = $('.province-name').val();
		pros = pros_str.split(',');
		money_str = $('.province-name').attr('data-money');
		money = money_str.split(',');
		id_money_str = $('.province-name').attr('data-id-money');
		id_money = id_money_str.split(',');
		// Animate!
		animationTimer = setInterval(function() {
			// If the duration has been exceeded, stop animating
			if (new Date().getTime() - started < duration) {
				// Generate a random string to use for the next animation step
				i = Math.floor(Math.random() * pros.length);
				output.text(pros[i] + ' VNĐ');
				$('.echo-pro').text(pros[i]);
				$('.echo-money').text(money[i]);
				$('.province-name').attr('data-id-money-final',id_money[i]);
			} else {
				// Generate a random string to use for the next animation step
			}
		}, 50);
	}
	
	// handle nav click
	$(".game-nav li").on("click", function(e){
		e.preventDefault();
		var $this = $(this);
		if($this.hasClass("active")){
			return false;
		}
		$this.siblings().removeClass("active");
		$this.addClass("active");
		$(".game-content .content").hide();
		var content = $this.attr("data-content");
		$(".game-content .content").not(content).hide();
		$(content).fadeIn();
	})
	
	

</script>