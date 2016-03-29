<?php
	$this_url="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
?>
<script>
	$(document).ready(function(e) {
		var href;
		var p;
		var top;
        $("aside a").click(function(e) {
			e.preventDefault();
			$(this).parent().siblings().find("a").css("color","#000");
			$(this).css("color","#2980b9");
            href=$(this).attr("href");
			p=$("."+href).position();
			top=p.top+90;
			$("html,body").animate({
				scrollTop: top,
			},500);
        });

		$(window).bind('scroll', function() {
        var navHeight = 220;
             if ($(window).scrollTop() > navHeight) {
                 $('aside').addClass('fixed_maybe');
             }
             else {
                 $('aside').removeClass('fixed_maybe');
             }
        });
		$('.scroll').click(function(e) {
			e.preventDefault();
            link=$(this).attr("href");
			name_arr=link.split("#");
			name=name_arr[1];
			p=$("."+name).position();
			top=p.top+90;
			$("html,body").animate({
				scrollTop: top,
			},500);
        });
    });
</script>
<section id="chinhsachbaomat">

	<section class="header">

    	<h1 class="title">CHÍNH SÁCH ĐỔI HÀNG</h1>

    </section>

    <section class="content">
    	<aside>
        	<nav>
            	<ul>
                	<li><a href="thongtin-cn">Điều kiện đổi hàng</a></li>
                    <li><a href="capnhat-tt">Quy ước đổi hàng</a></li>
                    <li><a href="cach-thuc-doi-hang">Cách thức đổi hàng</a></li>
                    <li><a href="chiase-tt">Các bước đổi hàng</a></li>
                    <li><a href="trachnhiem-kh">Địa điểm và thời gian đổi sản phẩm</a></li>
                    <li><a href="luutru-tt">QUY ĐỊNH SẢN PHẨM MIỄN ĐỔI HÀNG</a></li>
                </ul>
            </nav>
        </aside>
		<article>
    	<div class="chinhsachdoihang div-doihang">
            <div class="dieukiendoihang">
            <a name="dieukiendoihang" class="dieukiendoihang"></a>
                <h2 class="title thongtin-cn">Điều kiện đổi hàng</h2>
                <ul>
                    <li>Sản phẩm do CTY TNHH SX Hàng Tiêu Dùng Bình Tân sản xuất và được mua trên trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn.</a></li>
                    <li>Thời gian đổi hàng: trong vòng <span>10 ngày</span> kể từ ngày quý khách nhận được hàng và được đổi hàng duy nhất <span>01</span> lần (theo chi tiết trong <a class="scroll" href="<?php echo $this_url."#quyuocdoihang"?>">quy ước đổi hàng</a>).</li>
                    <li>Sản phẩm đổi phải còn nguyên tem, nhãn mác,  đầy đủ các chi tiết, còn đủ bao hộp như ban đầu cùng phiếu giao hàng, các phụ kiện, phiếu và quà tặng đi kèm (nếu có) và không có dấu hiệu đã qua sử dụng.</li>
                    <li>Không áp dụng cho sản phẩm giảm giá</li>
                </ul>   
            </div><!-- end dieukiendoihang -->
            <div class="quyuocdoihang div-doihang">
            <a name="quyuocdoihang" class="quyuocdoihang"></a>
	            <h2 class="title capnhat-tt">Quy ước đổi hàng</h2>
                <h3>1.	Trường Hợp 1: Đổi hàng do phát sinh từ Quý Khách</h3>
                <ul>
                    <li>Áp dụng cho những sản phẩm cần đổi cỡ số hoặc màu sắc.</li>
                    <li>Trong trường hợp sản phẩm đổi không còn cỡ số hoặc màu sắc như Quý khách yêu cầu, Quý khách vui lòng đổi sang sản phẩm khác. Nếu sản phẩm đổi mới có giá trị cao hơn, Quý khách sẽ bù thêm phần chênh lệch đó. Nếu sản phẩm đổi mới có giá trị thấp hơn, phần chênh lệch sẽ không được quy đổi và không được hoàn trả  lại bằng tiền mặt.</li>
                </ul>
                <h3 style="margin-top:10px;">2.	Trường Hợp 2: Đổi hàng do lỗi của nhà sản xuất</h3>
                <ul>
                    <li>Áp dụng cho những sản phẩm bị lỗi do nhà sản xuất hoặc sản phẩm đã giao không đúng như đơn đặt hàng của Quý khách.</li>
                    <li>Lỗi của sản phẩm phải do nhân viên của chúng tôi xác nhận trước khi đổi hàng cho Quý khách. Và sản phẩm bị lỗi sẽ được đổi mới 100%.</li>
                    <li>Trong trường hợp sản phẩm đổi không còn hàng như Quý khách yêu cầu, Quý khách vui lòng đổi sang sản phẩm khác. Nếu sản phẩm đổi mới có giá trị cao hơn, Quý khách sẽ bù thêm phần chênh lệch đó. Nếu sản phẩm đổi mới có giá trị thấp hơn, phần chênh lệch sẽ không được quy đổi và không được hoàn trả lại bằng tiền mặt.</li>
                </ul>
    		</div><!-- end quyuocdoihang --> 
            <div class="cachthucdoihang div-doihang">
	            <h2 class="title cach-thuc-doi-hang">Cách thức đổi hàng</h2>
                <p>Quý khách có thể lựa chọn 02 cách thức đổi hàng như sau:</p>
            	<ul>
                	<li>Đổi  hàng trực tiếp theo danh sách địa điểm nhận đổi hàng <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihang"?>">xem tại đây</a>.</li>
                    <li>Gửi qua đường bưu điện: Quý khách đóng gói sản phẩm cần đổi và gửi về địa chỉ đổi hàng <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihangbuudien"?>">xem tại đây</a>.</li>
                </ul>
            </div><!-- end cachthucdoihang -->
            <div class="cacbuocdoihang div-doihang">
	            <h2 class="title chiase-tt">Các bước đổi hàng</h2>
            	<ul>
                	<li>Kiểm tra <a class="scroll" href="<?php echo $this_url."#dieukiendoihang"?>">điều kiện đổi hàng</a> và <a class="scroll" href="<?php echo $this_url."#quyuocdoihang"?>">quy ước đổi hàng</a>.</li>
                    <li>Tải mẫu <strong>Phiếu Đổi Sản Phẩm</strong> <a href="http://bitas.com.vn/download/jsview/index.html?file=phieu-doi-san-pham.pdf" target="_blank">tại đây</a> hoặc đến các địa điểm nhận đổi hàng để lấy <strong>Phiếu Đổi Sản Phẩm</strong>.</li>
                    <li>In hoặc ghi theo mẫu và điền đầy đủ thông tin theo yêu cầu trên phiếu.</li>
                    <li>Đóng gói sản phẩm cần đổi kèm đầy đủ bao hộp, phiếu và quà tặng đi kèm (nếu có), <strong>Phiếu Đổi Sản Phẩm</strong> và <strong>Phiếu Giao Hàng</strong> gốc và mang đổi trực tiếp đến <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihang"?>">địa điểm đổi hàng</a> hoặc gửi qua đường bưu điện về <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihangbuudien"?>">địa chỉ sau</a>.</li>
                </ul>
            </div><!-- end cacbuocdoihang -->
            <a class="diadiemnhandoihang"></a>
            <div class="diadiemvathoigian div-doihang">
            	<h2 class="title trachnhiem-kh">Địa điểm và thời gian đổi sản phẩm</h2>
                <h4>Nhận đổi hàng trực tiếp</h4>
                <table cellspacing="0">
                	<thead>
                    	<tr>
                        	<th>Khu vực</th>
                            <th>Địa chỉ</th>
                            <th>Giờ nhận đổi hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td>Hà Nội</td>
                            <td>                                  
                                <b>1.	Cửa hàng Royal City</b><br />
								72A Nguyễn Trãi, P. Thượng Đỉnh, Q. Thanh Xuân, Hà Nội<br />
								Tel: (04) 6664.0268<br />
                                <b>2.	Cửa hàng Times City</b><br />
                                Số 458 Minh Khai, Q. Hai Bà Trưng, Hà Nội<br />
                                Tel: (04) 3200.5768<br />
                                <b>3.	Cửa hàng Bạch Mai</b><br />
                                464 Bạch Mai, P. Trương Định, Q. Hai Bà Trưng, Hà Nội<br />
                                Tel: (04) 3627.7126<br />
                                <b>4.	 Cửa hàng Ngọc Thụy</b><br />
                                Số 326 tổ 18 P. Ngọc Thụy, Q. Long Biên, Hà Nội<br />
                                SĐT: (04) 3872. 6755 -107<br />
                                <a href="http://bitas.com.vn/cat/dia-diem-doi-bao-hanh/">Xem bản đồ</a><br />
                            </td>
                            <td rowspan="4" style="vertical-align:middle"><strong>Từ 10h - 20h hàng ngày (kể  cả  ngày lễ và chủ nhật)</strong></td>
                        </tr>
                        <tr>
                        	<td>Đà Nẵng</td>
                            <td>
                            	<b>Cửa hàng Bita’s Thanh Khê Đà Nẵng </b><br />
								276 Lê Duẩn P. Tân Chính, Q. Thanh Khê, Tp. Đà Nẵng<br />
								Tel: (0511) 653.569 – 653.789<br />
                                <a href="http://bitas.com.vn/cat/dia-diem-doi-bao-hanh/">Xem bản đồ</a><br />
                            </td>
                        </tr>
                        <tr>
                        	<td>TP Hồ Chí Minh</td>
                            <td>
                            	<b>1.	 Cửa hàng Hậu Giang</b><br />
                                22 Hậu Giang, P.2, Q.6 Tp. HCM<br />
                                Tel: (08) 3960.9959<br />
                                <b>2.	Cửa hàng  Trần Quang Diệu</b><br />
                                97 Trần Quang Diệu, P.14, Q.3, Tp. HCM<br />
                                Tel: (08) 3931.1305<br />
                                <b>3.	Cửa hàng Bita’s Hóc Môn</b><br />
                                80/3B Bà Triệu, TT Hóc Môn, Tp. HCM<br />
                                Tel: (08) 3710.6382<br />
                                <a href="http://bitas.com.vn/cat/dia-diem-doi-bao-hanh/">Xem bản đồ</a><br />
                            </td>
                        </tr>
                        <tr>
                        	<td>Cần Thơ</td>
                            <td>
                            	<b>1.	Cửa hàng Nguyễn Trãi</b><br />
                                103 Nguyễn Trãi, P. An Hội, Q. Ninh Kiều, TP. Cần Thơ<br />
                                Tel: (071) 0381.1857<br />
                                <b>2.	Cửa hàng Nguyễn Văn Cừ</b><br />
                                288/31 - 288/33 Nguyễn Văn Cừ, p. An Hòa, Q. Ninh Kiều, Tp. Cần Thơ<br />
                                Tel: (071) 0381.7754<br />
                                <a href="http://bitas.com.vn/cat/dia-diem-doi-bao-hanh/">Xem bản đồ</a><br />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="diadiemnhandoihangbuudien"></a>
                <h4 style="margin-top: 10px">Đổi hàng qua đường bưu điện (áp dụng cho tất cả các tỉnh thành trên toàn quốc)</h4>
                <table cellspacing="0">
                	<thead>
                    	<tr>
                        	<th>Khu vực</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td>Miền Bắc</td>
                            <td>
                                <b>Chi Nhánh Bita's Miền Bắc</b><br />
                                Số 326 tổ 18 P. Ngọc Thụy, Q. Long Biên, Hà Nội<br />
                                Tel: (04) 3872.6755<br />
                            </td>
                        </tr>
                        <tr>
                        	<td>Miền Trung</td>
                            <td>
                                <b>Chi Nhánh Bita's Miền Trung</b><br />
                                Số 276 Lê Duẩn P. Tân Chính, Q. Thanh Khê, Tp. Đà Nẵng<br />
                                Tel: (0511) 3653.569<br />
                            </td>
                        </tr>
                        <tr>
                        	<td>Miền Nam</td>
                            <td>
                                <b>Công Ty TNHH Sản Xuất Hàng Tiêu Dùng Bình Tân</b><br />
                                Bộ Phận Chăm Sóc Khách Hàng Online<br />
                                1016A Hương Lộ 2, P. Bình Trị Đông A, Q. Bình Tân, Tp. HCM<br />
                                Tel: (08)3754.3954<br />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="luuy">
                	<h2>*Lưu ý:</h2>
                    <ul>
                    	<li>Chúng tôi có quyền thay đổi chính sách vào bất kỳ thời điểm nào mà không cần phải thông báo trước. 
</li>
						<li>Xin Quý khách vui lòng liên hệ <strong>Bộ Phận Chăm Sóc Khách Hàng Online</strong> theo đường dây nóng (08) 3754 3954 hoặc chat trực tuyến với chúng tôi trước khi đổi hàng để chúng tôi phục vụ Quý khách tốt nhất.</li>
                    </ul>
                </div><!-- end luuy -->
                <div class="miendoihang div-doihang">
                	<h2 class="title luutru-tt">QUY ĐỊNH SẢN PHẨM MIỄN ĐỔI HÀNG</h2>
                    <ul>
                	<li>Sản phẩm không phải do CTY TNHH SX Hàng Tiêu Dùng Bình Tân sản xuất và không phải mua trên trang web <a href="" class="normal">www.bitas.com.vn</a>. 
</li>
						<li>Sản phẩm quá thời hạn quy định đổi.</li>
                        <li>Sản phẩm không còn nguyên tem và nhãn mác và đã qua sử dụng.</li>
                        <li>Sản phẩm bị hư hỏng do tác động bởi yếu tố ngoại lực. </li>
                    </ul>
                </div><!-- end miendoihang -->
            </div><!-- end diadiemvathoigian -->
        </div><!-- chinhsachdoihang -->
        </article>
    </section>
</section>