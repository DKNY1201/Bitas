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
                    <i>Bước 1</i>
                    <p>
                        Truy cập website: bitas.com.vn</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="truycapwebsite">
                            <ul>
                                <li>- Xem <strong>Danh mục sản phẩm</strong> để lựa chọn sản phẩm cần mua.</li>
                                <li>- Nhập mã sản phẩm vào mục Tìm kiếm để tìm sản phẩm đó.</li>
                                <li>- Nhấn vào <strong>Hỗ trợ trực tuyến</strong> để chat với nhân viên tư vấn.</li>
                                <li>- Đăng ký nhận bản tin bằng cách nhập địa chỉ email để được cập nhật những chương trình khuyến mại, ưu đãi giảm giá, thông báo sản phẩm mới...</li>
                            </ul>
                            <img class="huong-dan-img" src="img/st/huong-dan-mua-hang-01.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng" />
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>Bước 2</i>
                    <p>
                        Thêm sản phẩm vào giỏ hàng</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="add-pro-cart">
                        	<p>Mục Catalogue giới thiệu thông tin sơ lược về sản phẩm, bao gồm: mã sản phẩm, đơn giá và dòng size. Lưu ý: chữ “Từ” trước đơn giá nghĩa là sản phẩm này có nhiều dòng size với mức giá khác nhau.</p>
                            <img class="add-pro-cart-img-1" src="img/st/huong-dan-mua-hang-02-1.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng" />
                            <p>- Chọn sản phẩm cần mua để xem: Mã sản phẩm, mô tả sản phẩm, hình ảnh sản phẩm.</p>
							<p>- Chọn màu, size, để xem đơn giá của sản phẩm đã chọn.</p>
							<p>- Nhấn nút mua hàng để thêm sản phẩm vào giỏ hàng hoặc nhấn Yêu Thích để thêm vào danh sách yêu thích.</p>
                            <img class="add-pro-cart-img-2" src="img/st/huong-dan-mua-hang-02-2.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng" />
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>Bước 3</i>
                    <p>
                        Xem lại giỏ hàng</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="xem-lai-cart">
                            <h4>Tại đây có các chức năng như sau:</h4>
                            <div class="xem-lai-cart-func">
                                <p>- Xóa sản phẩm</p>
                                <p>- Thay đổi số lượng</p>
                                <p>- Nhấn chuột vào hình ảnh sản phẩm để quay lại thay đổi size hoặc màu sắc.</p>
                            </div>
                            <img src="img/st/huong-dan-mua-hang-03.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng"/>
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>Bước 4</i>
                    <p>
                        Đăng nhập/Đăng ký tài khoản</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="dang-nhap-dk">
                           <p>- Đăng nhập tài khoản với email và mật khẩu đã đăng ký trước đó.</p>
                           <p>-	Nếu chưa đăng ký, điền thông tin email và mật khẩu để tạo tài khoản mới.</p>
                           <img src="img/st/huong-dan-mua-hang-04.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng"/>
                       	</div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>Bước 5</i>
                    <p>
                        Cung cấp địa chỉ giao nhận</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                       <div class="giao-nhan">
                            <div class="giao-nhan-text">
                                <p>- Nhập địa chỉ giao hàng một lần duy nhất. Tại đây, hệ thống sẽ tự ghi nhận lại địa chỉ cho những lần mua hàng sau.</p>
                                <p>- Trong trường hợp cần thay đổi địa chỉ giao hàng trong lần mua hàng sau, chọn Tạo thêm địa chỉ giao hàng.</p>
                            </div>
                            <img src="img/st/huong-dan-mua-hang-05.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng"/>
                       </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>Bước 6</i>
                    <p>
                        Lựa chọn hình thức thanh toán</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="thanh-toan">
	                        <p>- Kiểm tra giỏ hàng lần cuối, sau đó lựa chọn một hình thức thanh toán:</p>
                            <div class="thanh-toan-child">
                            	<p>o Tiền mặt: thanh toán khi giao hàng.</p>
                                <p>o Thanh toán trực tuyến: lựa chọn thẻ ATM nội địa, Internet Banking hay thẻ Visa quốc tế. Lưu ý: có thu phí giao dịch bằng thẻ qua ngân hàng.</p>
                            </div>
                            <p>- Nhấn nút Thanh toán để hoàn tất mua hàng</p>
                            <p>- Đơn hàng sẽ tự động gửi đến địa chỉ email đã được đăng ký.</p>
                        </div>
                        <img src="img/st/huong-dan-mua-hang-06.png" alt="huong dan mua hang" title="Hướng dẩn mua hàng" />
                    </div>
                </div>
            </li>    
        </ul>
    </div>
</div>