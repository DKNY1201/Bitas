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
        <h1 class="title">CHÍNH SÁCH BẢO HÀNH</h1>
    </section>
    <section class="content">
        <aside>
            <nav>
                <ul>
                    <li><a href="thongtin-cn">Điều kiện bảo hành</a></li>
                    <li><a href="capnhat-tt">Những trường hợp không được bảo hành</a></li>
                    <li><a href="chiase-tt">Quy ước bảo hành</a></li>
                    <li><a href="cach-thuc-bao-hanh">Cách thức bảo hành</a></li>
                    <li><a href="trachnhiem-kh">Các bước bảo hành</a></li>
                    <li><a href="luutru-tt">Địa điểm và thời gian bảo hành sản phẩm</a></li>
                </ul>
            </nav>
        </aside>
        <article>
        <div class="chinhsachdoihang">
            <div class="dieukiendoihang div-doihang">
	            <a class="dieukienbaohanh"></a>
                <h2 class="title thongtin-cn">Điều kiện bảo hành</h2>
                <ul>
                    <li>Sản phẩm do CTY TNHH SX Hàng Tiêu Dùng Bình Tân sản xuất và được mua trên trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn.</a></li>
                    <li>Thời hạn bảo hành: trong vòng <span>60 ngày</span> kể từ ngày quý khách nhận được hàng. </li>
                    <li>Sản phẩm bảo hành phải có phiếu giao hàng do Công ty TNHH SX Hàng Tiêu Dùng Bình Tân cung cấp.</li>
                    <li>Các sản phẩm đã qua sử dụng chỉ được bảo hành các lỗi sau: rạn da, bong keo, sứt chỉ, khoen nút, phụ kiện trang trí bị bung sút, đế giày bị nứt, gãy.</li>
                    <li>Các lỗi khác của sản phẩm đã qua sử dụng không được bảo hành</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="dieukiendoihang1 div-doihang">
                <h2 class="title capnhat-tt">Những trường hợp không được bảo hành</h2>
                <ul>
                    <li>Sản phẩm không phải do CTY TNHH SX Hàng Tiêu Dùng Bình Tân sản xuất và không được mua trên trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn.</a></li>
                    <li>Không có phiếu giao hàng gốc của CTY TNHH SX Hàng Tiêu Dùng Bình Tân.</li>
                    <li>Sản phẩm đã hết hạn bảo hành quy định.</li>
                    <li>Giày dép bị hư hỏng do lỗi trong quá trình sử dụng như: trầy xước, mòn đế, nóng chảy, thú vật cắn, do bị vật sắc nhọn cắt, đâm thủng.</li>
                    <li>Giày dép bị rách, hỏng do sử dụng trong những điều kiện không đảm bảo như: thường xuyên sử dụng trong điều kiện ngập nước, tiếp xúc hóa chất, hơ lửa, hoặc bị vật nặng đè lên.</li>
                    <li>Giày dép bị hao mòn tự nhiên trong quá trình sử dụng.</li>
                    <li>Giày dép đã qua sử dụng nhưng không nằm trong những lỗi được bảo hành.</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="dieukiendoihang div-doihang">
                <h2 class="title cach-thuc-bao-hanh">Cách thức bảo hành</h2>
                <p>Quý khách có thể lựa chọn 02 cách thức bảo hành như sau:</p>
                <ul>
                    <li>Bảo hành trực tiếp theo danh sách <a class="scroll" href="<?php echo $this_url."#diadiembaohanh"?>">địa điểm bảo hành</a>.</li>
                    <li>Gửi qua đường bưu điện: đóng gói sản phẩm cần bảo hành, Phiếu Yêu Cầu Bảo Hành, phiếu giao hàng gốc và gửi qua đường bưu điện về <a class="scroll" href="<?php echo $this_url."#diadiembaohanhbuudien"?>">địa chỉ bảo hành</a>.</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="dieukiendoihang div-doihang">
            	<a class="quyuocbaohanh"></a>
                <h2 class="title chiase-tt">Quy ước bảo hành</h2>
                <ul>
                    <li>Nhân viên chúng tôi sẽ xác nhận sản phẩm có đạt yêu cầu bảo hành hay không trước khi tiến hành bảo hành sản phẩm cho Quý khách.</li>
                    <li>Các sản phẩm đạt yêu cầu bảo hành trong trường hợp chúng tôi không khắc phục được lỗi sẽ được đổi sang sản phẩm cùng loại hoặc sản phẩm khác. Nếu sản phẩm đổi mới có giá trị cao hơn, Quý khách sẽ bù thêm phần chênh lệch đó. Nếu sản phẩm đổi mới có giá trị thấp hơn, phần chênh lệch sẽ không được quy đổi và không được hoàn trả lại bằng tiền mặt.</li>
                    <li>Chúng tôi chịu hoàn toàn chi phí bảo hành sản phẩm.</li>
                    <li>Trường hợp bảo hành các phụ kiện  gắn trên giày dép  nếu không còn phụ kiện để thay thế thì chúng tôi sẽ thay thế bằng phụ kiện khác.</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="cacbuocdoihang div-doihang">
                <h2 class="title trachnhiem-kh">Các bước bảo hành</h2>
                <ul>
                    <li>Kiểm tra <a class="scroll" href="<?php echo $this_url."#dieukienbaohanh"?>">điều kiện bảo hành</a> và <a class="scroll" href="<?php echo $this_url."#quyuocbaohanh"?>">quy ước bảo hành</a>.</li>
                    <li>Tải <strong>Phiếu Bảo Hành</strong> <a href="http://bitas.com.vn/download/jsview/index.html?file=phieu-bao-hanh.pdf" target="_blank">tại đây</a>.</li>
                    <li>In hoặc ghi theo mẫu và điền đầy đủ thông tin theo yêu cầu trên phiếu.</li>
                    <li>Đóng gói sản phẩm cần bảo hành kèm đầy đủ bao hộp, phiếu và quà tặng đi kèm (nếu có), <strong>Phiếu Bảo Hành Sản Phẩm</strong> và <strong>Phiếu Giao Hàng</strong> gốc và mang bảo hành trực tiếp tại <a class="scroll" href="<?php echo $this_url."#diadiembaohanh"?>">địa điểm bảo hành</a> hoặc gửi qua đường bưu điện về <a class="scroll" href="<?php echo $this_url."#diadiembaohanhbuudien"?>">địa chỉ sau</a>.</li>
                </ul>
            </div><!-- end cacbuocdoihang -->
            <a class="diadiembaohanh"></a>
            <div class="diadiemvathoigian div-doihang">
                <h2 class="title luutru-tt">Địa điểm và thời gian bảo hành sản phẩm</h2>
                <h4 style="margin-top: 10px">Nhận bảo hành trực tiếp</h4>
                <table cellspacing="0">
                    <thead>
                        <tr>
                            <th>Khu vực</th>
                            <th>Địa chỉ</th>
                            <th>Giờ nhận bảo hành</th>
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
                                SĐT: (04) 3872.6755 -107<br />
                            </td>
                            <td rowspan="4" style="vertical-align:middle"><strong>Từ 10h - 20h hàng ngày (kể  cả  ngày lễ và chủ nhật)</strong></td>
                        </tr>
                        <tr>
                            <td>Đà Nẵng</td>
                            <td>
                                <b>Cửa hàng Bita’s Thanh Khê Đà Nẵng </b><br />
								276 Lê Duẩn P. Tân Chính, Q. Thanh Khê, Tp. Đà Nẵng<br />
								Tel: (0511) 653.569 – 653.789<br />
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
                            </td>
                        </tr>
                        <tr>
                            <td>Cần Thơ</td>
                            <td>
                                <b>1.	Cửa hàng Nguyễn Trãi</b><br />
                                103 Nguyễn Trãi, P. An Hội, Q. Ninh Kiều, TP. Cần Thơ<br />
                                Tel: (071) 0381.1857<br />
                                <b>2.	Cửa hàng Nguyễn Văn Cừ</b><br />
                                288/31 -388/33 Nguyễn Văn Cừ, p. An Hòa, Q. Ninh Kiều, Tp. Cần Thơ<br />
                                Tel: (071) 0381.7754<br />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="diadiembaohanhbuudien"></a>
                <h4 style="margin-top: 10px">Bảo hành sản phẩm bằng cách gửi qua đường bưu điện (áp dụng cho tất cả các tỉnh thành trên toàn quốc)</h4>
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
            </div><!-- end diadiemvathoigian -->
        </div><!-- chinhsachdoihang -->
        </article>
    </section>
</section>