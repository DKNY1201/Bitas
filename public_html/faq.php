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
				console.log("expanded");
				$(this).find(".drop-up").removeClass("drop-up");
			}
			else{
				console.log("unexpand");
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
                    <p>Làm thể nào để mua hàng online?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="truycapwebsite">
                        <p>Quý khách vui lòng truy cập website: bitas.com.vn, đăng ký tài khoản, chọn sản phẩm và tiến hành đặt hàng.</p>
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>2</i>
                    <p>Kiểm tra tình trạng đơn hàng như thế nào?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="add-pro-cart">
                        	<p>Để kiểm tra đơn hàng:</p>
                            <p>B1: Truy cập website: bitas.com.vn</p>
							<p>B2: Đăng nhập vào tài khoản</p>
							<p>B3: Nhấn chuột vào mục Xin chào và chọn Đơn hàng của tôi</p>
                            <p>B4: Thông tin đơn hàng sẽ hiển thị tại mục Lịch sử mua hàng.</p>
							<p>Hoặc Quý khách có thể gọi về tổng đài và  cung cấp mã số đơn hàng để nhân viên CSKH truy cập trực tiếp đơn hàng cho Quý khách.</p>
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>3</i>
                    <p>Cách thức đổi hàng như thế nào?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="xem-lai-cart">
                            <div class="xem-lai-cart-func">
                                <p>Để đổi hàng Quý khách vui lòng:</p>
                                <p>B1: Kiểm tra Điều kiện đổi hàng và Quy ước đổi hàng ở mục Chính sách đổi hàng trên website: bitas.com.vn</p>
                                <p>B2: Tải phiếu đổi sản phẩm tại mục chính sách đổi hàng</p>
                                <p>B3:In hoặc ghi theo mẫu và điền đầy đủ thông tin theo yêu cầu trên phiếu.</p>
                                <p>B4: Đem sản phẩm cần đổi +bao hộp + Phiếu đổi sản phẩm + phiếu giao hàng gốc đến 1 trong 4 địa điểm quy định đổi hàng của Bita’s.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>4</i>
                    <p>Địa chỉ đổi hàng và bảo hành ở đâu?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                    	<div class="dang-nhap-dk">
                           <p>Hiện nay Bita’s có tới 4 cửa hàng nhận đổi và bảo hành sản phẩm trực tiếp. </p>
                           <table class="faq-table" cellpadding="0" cellspacing="0">
                           	<thead>
                            	<th>Khu vực</th>
                                <th>Địa chỉ</th>
                            </thead>
                            <tbody>
                            	<tr>
                                	<td>Q1, Q2, Q3, Q4, Q7, Q9, Q10, Q.Tân Bình, Q.Bình Thạnh, Q.Thủ Đức, Q.Phú Nhuận</td>
                                    <td>
                                    	<p>Cửa hàng Bita’s Trần Quang Diệu</p>
                                        <p>97 Trần Quang Diệu, P.14, Q.3, Tp.HCM</p>
                                        <p>Tel: (08) 3931.1350</p>
									</td>
                                </tr>
                                <tr>
                                	<td>Q6, Q8, Q.Bình Tân</td>
                                    <td>
                                    	<p>Cửa hàng Bita’s Hậu Giang</p>
                                        <p>22 Hậu Giang, P.2, Q.6, HCM</p>
                                        <p>Tel: (08) 3960.9959</p>
									</td>
                                </tr>
                                <tr>
                                	<td>Q.5, Q11, Quận Tân Phú</td>
                                    <td>
                                    	<p>Cửa hàng Bita's Lotte Quận 11</p>
                                        <p>TTTM Lotte, Tầng 3, 968 đường 3/2, P.15, Q.10. TP HCM</p>
                                        <p>Tel: (08) 6680.7856</p>
									</td>
                                </tr>
                                <tr>
                                	<td>Cửa hàng Bita’s Hóc Môn</td>
                                    <td>
                                    	<p>Cửa Hàng Bita's Hóc Môn</p>
                                        <p>80/3B Bà Triệu, TT Hóc Môn, TP HCM</p>
                                        <p>Tel: (08) 3710.6382</p>
									</td>
                                </tr>
                            </tbody>
                           </table>
                       	</div>
                    </div>
                </div>
            </li>
        
            <li>
                <h3 class="faq-expan">
                    <i>5</i>
                    <p>Quy trình bảo hành như thế nào?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
                       <div class="giao-nhan">
                       		<p>Để bảo hành sản phẩm Quý khách vui lòng tiến hành như sau:</p>
                            <div class="giao-nhan-text">
                                <p>•	Kiểm tra điều kiện bảo hành và quy ước bảo hành trong chính sách bảo hành ở website.</p>
                                <p>•	Tải Phiếu Bảo Hành tại website.</p>
                                <p>•	In hoặc ghi theo mẫu và điền đầy đủ thông tin theo yêu cầu trên phiếu.</p>
                                <p>•	Quý khách vui lòng mang sản phẩm cần bảo hành, Phiếu Bảo Hành, và phiếu giao hàng đến địa điểm nhận bảo hành sản phẩm theo quy định. </p>
                            </div>
                       </div>
                    </div>
                </div>
            </li>

            <li>
                <h3 class="faq-expan">
                    <i>6</i>
                    <p>Giao hàng tận nơi thì có mất phí hay không?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
	                        <p>Hiện Bita’s hỗ trợ chi phí vận chuyển như sau:</p>
                           	<p>-	Khu vực nội thành Tp.HCM: miễn phí giao hàng cho đơn hàng từ 300,000Đ trở lên, dưới 300,000Đ mức phí là 10,000Đ.</p>
                            <p>-	Khu vực ngoại thành TpHCM: miễn phí giao hàng cho đơn hàng từ 500,000Đ trở lên, dưới 500,000Đ mức phí là 35,000Đ.</p>
                            <p>Quý khách vui lòng cung cấp địa chỉ cụ thể để biết chi phí chính xác của mình.</p>
							<p>-	Khu vực nội thành Tp.HCM bao gồm: Quận 1,2,3,4,5,6,7,8,10,11, Tân Bình, Tân Phú, Phú Nhuận, Bình Thạnh, Gò Vấp, Bình Tân.</p>
                            <p>-	Khu vực ngoại thành Tp.HCM bao gồm: Q9,12, Thủ Đức, Hóc Môn, Bình Chánh, Nhà Bè, Cần Giờ, Củ Chi.</p>
                    </div>
                </div>
            </li>
               
            <li>
                <h3 class="faq-expan">
                    <i>7</i>
                    <p>Tôi đã đặt hàng thành công nhưng có thể hủy đơn hàng được hay không?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
	                        <p>Đơn hàng sẽ được phép hủy khi Quý khách có yêu cầu hủy đơn hàng trong trường hợp đơn hàng chưa được xử lý và chưa bàn giao cho đơn vị vận chuyển.</p>
		           </div>
                </div>
            </li>
            
            <li>
                <h3 class="faq-expan">
                    <i>8</i>
                    <p>Làm sao để nhận lại tiền đã thanh toán trực tuyến sau khi hủy đơn hàng.</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
	                        <p>Trong trường hợp đơn hàng bị hủy bởi Bita’s: chúng tôi sẽ hoàn trả lại tiền Qúy khách đã thanh toán bao gồm tiền mua hàng và phí vận chuyển thông qua số  thẻ ngân hàng của Quý khách đã sử dụng để giao dịch</p>
                    </div>
                </div>
            </li>
            
            <li>
                <h3 class="faq-expan">
                    <i>9</i>
                    <p>Bita’s chấp nhận những hình thức thanh toán nào?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
	                        <p>Bita’s chấp nhận các hình thức thanh toán sau:</p>
                           	<p>Thanh toán khi nhận hàng: Quý khách sẽ thanh toán trực tiếp với nhân viên của chúng tôi bằng tiền mặt tại địa chỉ giao hàng.</p>
                            <p>Thanh toán qua thẻ ATM nội địa</p>
                            <p>Thanh toán qua thẻ quốc tế: Visa hoặc Mastercard</p>
                    </div>
                </div>
            </li>   
            <li>
                <h3 class="faq-expan">
                    <i>10</i>
                    <p>Phí dịch vụ là gì?</p>
                    <span class="drop-down"></span>
                </h3>
                <div class="clear"></div>
                <div class="guide">
                    <div class="faq-sum">
	                        <p>Là phí phụ thu cho dịch vụ thanh toán trực tuyến và mỗi lần xử lý giao dịch thẻ. Phí này không thể hoàn trả lại khi đã thanh toán.</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>