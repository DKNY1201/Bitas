<script>
	$(document).ready(function(e) {
       	$(".faq-expan").click(function(e) {
			if($(this).hasClass("selected")){
				$(this).removeClass("selected");
				$(this).siblings(".guide").slideToggle("slow");
			}
			else{
				$(".faq-expan").removeClass("selected");
				$(this).addClass("selected");
				$(this).siblings(".guide").slideToggle("slow");
			}
			
			if($(this).find(".drop-up").length){
				$(this).find(".drop-up").removeClass("drop-up");
			}
			else{
				$(this).find(".drop-down").addClass("drop-up");
			}
    	});
    });
</script>
<div class="huongdan-muahang">
<div class="faq-detail-view">
        <ul>
            <li>
                <h3 class="faq-expan">
                    <i>1</i>
                    <p>Thanh toán tiền mặt</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="truycapwebsite">
                            <p>Quý khách thanh toán tiền mặt trực tiếp với nhân viên giao hàng khi tiến hành giao nhận sản phẩm.</p>
                            <img style="float:left" src="img/st/huong-dan-thanh-toan-01.png" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>2</i>
                    <p>Thanh toán trực tuyến bằng thẻ ATM nội địa</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="add-pro-cart">
                        	<p>Bước 1: Chọn hình thức thanh toán Thẻ ATM ngân hàng nội địa</p>
                            <p><strong>Lưu ý:</strong> <i>Thẻ ATM của Quý khách phải được đăng ký và kích hoạt chức năng thanh toán trực tuyến với ngân hàng trước khi sử dụng.</i></p>
                            <img src="img/st/huong-dan-thanh-toan-02-1.png" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
							<p>Bước 2: Lựa chọn ngân hàng muốn thanh toán.</p>
                            <img src="img/st/huong-dan-thanh-toan-02-2.png" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
							<p>Bước 3: Nhập đầy đủ thông tin thẻ theo yêu cầu.</p>
                            <img src="img/st/huong-dan-thanh-toan-02-3.png" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
                            <p>Bước 4: Xác nhận thông tin từ phía ngân hàng để hoàn tất giao dịch.</p>
                            <p>Xác thực chủ thẻ bằng OTP (OneTime Password):</p>
							<p>- OTP: sẽ được gửi tới điện thoại của khách hàng đã đăng ký với Ngân hàng.</p>
							<p>- Tiến hành nhập Mã xác nhận để hoàn tất.</p>
							<img src="img/st/huong-dan-thanh-toan-02-4.jpg" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>3</i>
                    <p>Thanh toán trực tuyến băng thẻ Visa/Mastercard.</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="xem-lai-cart">
                            <p>Bước 1: Nhấn nút thanh toán Thẻ Visa/Mastercard</p>
                            <img src="img/st/huong-dan-thanh-toan-03-1.png" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
                            <p>Bước 2: Lựa chọn loại thẻ thanh toán.</p>
                            <img src="img/st/huong-dan-thanh-toan-03-2.png" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
                            <p>Bước 3: Nhập thông tin thẻ.</p>
                            <img src="img/st/huong-dan-thanh-toan-03-3.jpg" style="width:auto" alt="huong dan thanh toan" title="Hướng dẩn thanh toán" />
                            <p>Bước 4: Hoán tất thanh toán</p>
                            <p>Nhận thông báo bằng email hoặc SMS</p>
                        </div>
                    </div>
                </div>
            </li>  
        </ul>
    </div>
</div>