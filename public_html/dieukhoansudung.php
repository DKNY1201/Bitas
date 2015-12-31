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
<section id="chinhsachbaomat" class="dieukhoansudung">
    <section class="header">
        <h1 class="title">Điều khoản sử dụng</h1>
    </section>
    <section class="content">
        <aside>
            <nav>
                <ul>
                    <li><a href="thongtin-cn">I. Chính sách đổi hàng</a></li>
                    <li><a href="capnhat-tt">II. Chính sách hủy đơn hàng</a></li>
                    <li><a href="chiase-tt">III. Chính sách bảo hành</a></li>
                    <li><a href="cach-thuc-bao-hanh">IV. Chính sách bảo mật</a></li>
                    <li><a href="trachnhiem-kh">V. Các thông tin khác</a></li>
                </ul>
            </nav>
        </aside>
        <article>
        <div class="chinhsachdoihang">
        	<p>Điều khoản sử dụng này là những quy định về mối quan hệ và trách nhiệm của Công Ty TNHH Sản Xuất Hàng Tiêu Dùng Bình Tân (Bita's) và Khách hàng trong việc cung cấp và sử dụng các thông tin, dịch vụ trên trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn.</a></p>
            <h3 class="dk-title-h3">Khái niệm</h3>
             <ul>
                <li><strong>"Bita's"</strong> là Công Ty TNHH Sản Xuất Hàng Tiêu Dùng Bình Tân, ban lãnh đạo và toàn thể nhân viên.</li>
                <li><strong>"Khách hàng"</strong> là những cá nhân, tổ chức, hoặc bất kỳ ai truy cập và sử dụng trang <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn</a> dưới mọi hình thức.</li>
                <li><strong>"Trang web"</strong> là trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn</a>, bao gồm cả các trang liên kết đối với các sản phẩm và dịch vụ của Bita's.</li>
                <li><strong>"Điều khoản sử dụng"</strong> là những điều kiện và điểu khoản mà người truy cập trang <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn</a> cần tuân theo. Khách hàng sử dụng website được mặc nhiên hiểu rằng đã đọc và hiểu rõ những quy định sử dụng của website, đồng ý với các quy định được đặt ra một cách tự nguyện.</li>
            </ul>
            <h3 class="dk-title-h3">Quyền thay đổi nội dung điều khoản</h3>
            <p>Chúng tôi có thể, tùy theo sự suy xét của chính mình, thay đổi, thay thế, sửa đổi, thêm vào và/hoặc bỏ bớt đi một phần nào đó của các Điều khoản. Điều khoản sẽ có hiệu lực lập tức khi công bố trên website. Vì vậy, mỗi khi sử dụng website này, bạn cần phải xem lại nội dung của Điều khoản để đảm bảo có được những thông tin đầy đủ nhất.</p>
           <h3 class="dk-title-h3"> Mua hàng trên trên website <a href="http://www.bitas.com.vn" class="normal">bitas.com.vn</a>, quý khách đồng ý rằng:</h3>
           <ul>
                <li>Chấp nhận các chính sách bán hàng của <a href="http://www.bitas.com.vn" class="normal">bitas.com.vn</a> và tuân thủ các quy định về giao nhận, vận chuyển, thanh toán, trả hàng đã được bitas.com.vn đăng tải công khai tại trang web.</li>
                <li>Cam kết trách nhiệm thanh toán đúng theo quy định của hình thức thanh toán mà quý khách chọn lựa khi thực hiện đặt mua hàng.</li>
                <li>Cam kết các thông tin cung cấp là đúng và chịu trách nhiệm về các thông tin thanh toán, thông tin thẻ và chịu trách nhiệm trước phát luật nước Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam nếu có sự gian lận hoặc lừa đảo.</li>
            </ul>
        </div><!-- /.chinhsachdoihang -->
        </article>
        <article>
    	<div class="chinhsachdoihang div-doihang">
        	<h2 class="title thongtin-cn">I. Chính sách đổi hàng</h2>
            <div class="dieukiendoihang">
            <a name="dieukiendoihang" class="dieukiendoihang"></a>
                <h3>1. Điều kiện đổi hàng</h3>
                <ul>
                    <li>Sản phẩm do CTY TNHH SX Hàng Tiêu Dùng Bình Tân sản xuất và được mua trên trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn.</a></li>
                    <li>Thời gian đổi hàng: trong vòng <span>10 ngày</span> kể từ ngày quý khách nhận được hàng và được đổi hàng duy nhất <span>01</span> lần (theo chi tiết trong <a class="scroll" href="<?php echo $this_url."#quyuocdoihang"?>">quy ước đổi hàng</a>).</li>
                    <li>Sản phẩm đổi phải còn nguyên tem, nhãn mác,  đầy đủ các chi tiết, còn đủ bao hộp như ban đầu cùng phiếu giao hàng, các phụ kiện, phiếu và quà tặng đi kèm (nếu có) và không có dấu hiệu đã qua sử dụng.</li>
                    <li>Không áp dụng cho sản phẩm giảm giá</li>
                </ul>   
            </div><!-- end dieukiendoihang -->
            <div class="quyuocdoihang div-doihang">
            <a name="quyuocdoihang" class="quyuocdoihang"></a>
	            <h3 class="dk-title-h3">Quy ước đổi hàng</h3>
                <h3>a.	Trường Hợp 1: Đổi hàng do phát sinh từ Quý Khách</h3>
                <ul>
                    <li>Áp dụng cho những sản phẩm cần đổi cỡ số hoặc màu sắc.</li>
                    <li>Trong trường hợp sản phẩm đổi không còn cỡ số hoặc màu sắc như Quý khách yêu cầu, Quý khách vui lòng đổi sang sản phẩm khác. Nếu sản phẩm đổi mới có giá trị cao hơn, Quý khách sẽ bù thêm phần chênh lệch đó. Nếu sản phẩm đổi mới có giá trị thấp hơn, phần chênh lệch sẽ không được quy đổi và không được hoàn trả  lại bằng tiền mặt.</li>
                </ul>
                <h3 style="margin-top:10px;">b.	Trường Hợp 2: Đổi hàng do lỗi của nhà sản xuất</h3>
                <ul>
                    <li>Áp dụng cho những sản phẩm bị lỗi do nhà sản xuất hoặc sản phẩm đã giao không đúng như đơn đặt hàng của Quý khách.</li>
                    <li>Lỗi của sản phẩm phải do nhân viên của chúng tôi xác nhận trước khi đổi hàng cho Quý khách. Và sản phẩm bị lỗi sẽ được đổi mới 100%.</li>
                    <li>Trong trường hợp sản phẩm đổi không còn hàng như Quý khách yêu cầu, Quý khách vui lòng đổi sang sản phẩm khác. Nếu sản phẩm đổi mới có giá trị cao hơn, Quý khách sẽ bù thêm phần chênh lệch đó. Nếu sản phẩm đổi mới có giá trị thấp hơn, phần chênh lệch sẽ không được quy đổi và không được hoàn trả lại bằng tiền mặt.</li>
                </ul>
    		</div><!-- end quyuocdoihang --> 
            <div class="cachthucdoihang div-doihang">
	            <h3 class="dk-title-h3">2. Cách thức đổi hàng</h3>
                <p>Quý khách có thể lựa chọn 02 cách thức đổi hàng như sau:</p>
            	<ul>
                	<li>Đổi  hàng trực tiếp theo danh sách địa điểm nhận đổi hàng <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihang"?>">xem tại đây</a>.</li>
                    <li>Gửi qua đường bưu điện: Quý khách đóng gói sản phẩm cần đổi và gửi về địa chỉ đổi hàng <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihangbuudien"?>">xem tại đây</a>.</li>
                </ul>
            </div><!-- end cachthucdoihang -->
            <div class="cacbuocdoihang div-doihang">
	            <h3 class="dk-title-h3">3. Các bước đổi hàng</h3>
            	<ul>
                	<li>Kiểm tra <a class="scroll" href="<?php echo $this_url."#dieukiendoihang"?>">điều kiện đổi hàng</a> và <a class="scroll" href="<?php echo $this_url."#quyuocdoihang"?>">quy ước đổi hàng</a>.</li>
                    <li>Tải mẫu <strong>Phiếu Đổi Sản Phẩm</strong> <a href="http://bitas.com.vn/download/jsview/index.html?file=phieu-doi-san-pham.pdf" target="_blank">tại đây</a> hoặc đến các địa điểm nhận đổi hàng để lấy <strong>Phiếu Đổi Sản Phẩm</strong>.</li>
                    <li>In hoặc ghi theo mẫu và điền đầy đủ thông tin theo yêu cầu trên phiếu.</li>
                    <li>Đóng gói sản phẩm cần đổi kèm đầy đủ bao hộp, phiếu và quà tặng đi kèm (nếu có), <strong>Phiếu Đổi Sản Phẩm</strong> và <strong>Phiếu Giao Hàng</strong> gốc và mang đổi trực tiếp đến <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihang"?>">địa điểm đổi hàng</a> hoặc gửi qua đường bưu điện về <a class="scroll" href="<?php echo $this_url."#diadiemnhandoihangbuudien"?>">địa chỉ sau</a>.</li>
                </ul>
            </div><!-- end cacbuocdoihang -->
            <a class="diadiemnhandoihang"></a>
            <div class="diadiemvathoigian div-doihang">
            	<h3 class="dk-title-h3">4. Địa điểm và thời gian đổi sản phẩm</h3>
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
                                288/31 -388/33 Nguyễn Văn Cừ, p. An Hòa, Q. Ninh Kiều, Tp. Cần Thơ<br />
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
                	<h3>QUY ĐỊNH SẢN PHẨM MIỄN ĐỔI HÀNG</h3>
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
        <article style="margin-top:30px;">
    	<div class="chinhsachdoihang">
			<h2 class="title capnhat-tt">II. Chính sách hủy đơn hàng</h2>
            <div class="dieukiendoihang div-doihang">

                <h3 class="dk-title-h3">1. Điều kiện hủy đơn hàng</h3>

                <ul>

                    <li>Đơn hàng sẽ tự động hủy nếu như sản phẩm không có sẵn vì bất cứ lý do nào.</li>

                    <li>Đơn hàng sẽ tự động hủy khi Quý khách có yêu cầu thay đổi thông tin về sản phẩm của đơn hàng (trừ trường hợp đơn hàng đã được xử lý và xuất kho).</li>

                    <li>Đơn hàng sẽ được phép hủy khi Quý khách có yêu cầu hủy đơn hàng trước khi đơn hàng được xử lý, xuất kho và bàn giao cho đơn vị vận chuyển.</li>

                </ul>

            </div><!-- end dieukiendoihang -->

            <div class="dieukiendoihang1 div-doihang">

	            <h3 class="dk-title-h3">2. Cam kết khi hủy đơn hàng</h3>

                <ul>

                	<li>Trong trường hợp đơn hàng được <a href="">hủy bởi chúng tôi</a>, chúng tôi sẽ có trách nhiệm thông báo đến Quý khách trong thời gian sớm nhất. Quý khách sẽ không phải trả bất kỳ chi phí hủy đơn hàng nào trong trường hợp này.</li>

                    <li>Trong trường hợp đơn hàng được <a href="">hủy bởi Quý khách</a>, Quý khách phải có trách nhiệm thông báo đến chúng tôi trong thời gian sớm nhất. Nếu không, mọi khiếu nại sẽ không được giải quyết khi đơn hàng đã được xử lý.</li>

                    <li>Trong trường hợp Quý khách đã thanh toán trực tuyến, chúng tôi sẽ hoàn trả tiền mua hàng và phí vận chuyển thông qua tài khoản ngân hàng của Quý khách. Quý khách lưu ý phí dịch vụ cho xử lý giao dịch thẻ với ngân hàng sẽ không hoàn trả một khi đã thanh toán.</li>

                    <li>Xin Quý khách vui lòng liên hệ với <strong>Bộ Phận Chăm Sóc Khách Hàng Online</strong> theo đường dây nóng (08) 3754 3954 hoặc chat trực tuyến với chúng tôi trước khi hủy đơn hàng để được hướng dẫn thêm.</li>

                </ul>

    		</div><!-- end dieukiendoihang -->

        </div><!-- chinhsachdoihang -->
		</article>
        
        
        <article style="margin-top:30px;">
        <div class="chinhsachdoihang">
        	<h2 class="title chiase-tt">III. Chính sách bảo hành</h2>
            <div class="dieukiendoihang div-doihang">
	            <a class="dieukienbaohanh"></a>
                <h3 class="dk-title-h3">1. Điều kiện bảo hành</h3>
                <ul>
                    <li>Sản phẩm do CTY TNHH SX Hàng Tiêu Dùng Bình Tân sản xuất và được mua trên trang web <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn.</a></li>
                    <li>Thời hạn bảo hành: trong vòng <span>60 ngày</span> kể từ ngày quý khách nhận được hàng. </li>
                    <li>Sản phẩm bảo hành phải có phiếu giao hàng do Công ty TNHH SX Hàng Tiêu Dùng Bình Tân cung cấp.</li>
                    <li>Các sản phẩm đã qua sử dụng chỉ được bảo hành các lỗi sau: rạn da, bong keo, sứt chỉ, khoen nút, phụ kiện trang trí bị bung sút, đế giày bị nứt, gãy.</li>
                    <li>Các lỗi khác của sản phẩm đã qua sử dụng không được bảo hành</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="dieukiendoihang1 div-doihang">
                <h3 class="dk-title-h3">2. Những trường hợp không được bảo hành</h3>
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
                <h3 class="dk-title-h3">3. Cách thức bảo hành</h3>
                <p>Quý khách có thể lựa chọn 02 cách thức bảo hành như sau:</p>
                <ul>
                    <li>Bảo hành trực tiếp theo danh sách <a class="scroll" href="<?php echo $this_url."#diadiembaohanh"?>">địa điểm bảo hành</a>.</li>
                    <li>Gửi qua đường bưu điện: đóng gói sản phẩm cần bảo hành, Phiếu Yêu Cầu Bảo Hành, phiếu giao hàng gốc và gửi qua đường bưu điện về <a class="scroll" href="<?php echo $this_url."#diadiembaohanhbuudien"?>">địa chỉ bảo hành</a>.</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="dieukiendoihang div-doihang">
            	<a class="quyuocbaohanh"></a>
                <h3 class="dk-title-h3">4. Quy ước bảo hành</h3>
                <ul>
                    <li>Nhân viên chúng tôi sẽ xác nhận sản phẩm có đạt yêu cầu bảo hành hay không trước khi tiến hành bảo hành sản phẩm cho Quý khách.</li>
                    <li>Các sản phẩm đạt yêu cầu bảo hành trong trường hợp chúng tôi không khắc phục được lỗi sẽ được đổi sang sản phẩm cùng loại hoặc sản phẩm khác. Nếu sản phẩm đổi mới có giá trị cao hơn, Quý khách sẽ bù thêm phần chênh lệch đó. Nếu sản phẩm đổi mới có giá trị thấp hơn, phần chênh lệch sẽ không được quy đổi và không được hoàn trả lại bằng tiền mặt.</li>
                    <li>Chúng tôi chịu hoàn toàn chi phí bảo hành sản phẩm.</li>
                    <li>Trường hợp bảo hành các phụ kiện  gắn trên giày dép  nếu không còn phụ kiện để thay thế thì chúng tôi sẽ thay thế bằng phụ kiện khác.</li>
                </ul>
            </div><!-- end dieukiendoihang -->
            <div class="cacbuocdoihang div-doihang">
                <h3 class="dk-title-h3">5. Các bước bảo hành</h3>
                <ul>
                    <li>Kiểm tra <a class="scroll" href="<?php echo $this_url."#dieukienbaohanh"?>">điều kiện bảo hành</a> và <a class="scroll" href="<?php echo $this_url."#quyuocbaohanh"?>">quy ước bảo hành</a>.</li>
                    <li>Tải <strong>Phiếu Bảo Hành</strong> <a href="http://bitas.com.vn/download/jsview/index.html?file=phieu-bao-hanh.pdf" target="_blank">tại đây</a>.</li>
                    <li>In hoặc ghi theo mẫu và điền đầy đủ thông tin theo yêu cầu trên phiếu.</li>
                    <li>Đóng gói sản phẩm cần bảo hành kèm đầy đủ bao hộp, phiếu và quà tặng đi kèm (nếu có), <strong>Phiếu Bảo Hành Sản Phẩm</strong> và <strong>Phiếu Giao Hàng</strong> gốc và mang bảo hành trực tiếp tại <a class="scroll" href="<?php echo $this_url."#diadiembaohanh"?>">địa điểm bảo hành</a> hoặc gửi qua đường bưu điện về <a class="scroll" href="<?php echo $this_url."#diadiembaohanhbuudien"?>">địa chỉ sau</a>.</li>
                </ul>
            </div><!-- end cacbuocdoihang -->
            <a class="diadiembaohanh"></a>
            <div class="diadiemvathoigian div-doihang">
                <h3 class="dk-title-h3">6. Địa điểm và thời gian bảo hành sản phẩm</h3>
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
        
        
        
        
        <article style="margin-top: 30px;">
            <h2 class="title cach-thuc-bao-hanh">IV. Chính sách bảo mật</h2>
            <p>Đối với chúng tôi, sự an tâm, tin tưởng, và thoải mái của khách hàng khi mua sắm tại website www.bitas.com.vn là điều quan trọng nhất. Chính vì vậy, chính sách bảo mật là những cam kết của chúng tôi với khách hàng về việc bảo mật những thông tin cá nhân mà khách hàng đã cung cấp cho chúng tôi. Mọi giao dịch của khách hàng với chúng tôi đều được đảm bảo thực hiện theo đúng ý chí của khách hàng, tránh bị kẻ xấu lợi dụng hay đánh cắp tài khoản truy cập.</p><br />

<p>Chính sách bảo mật sẽ giải thích cách thức chúng tôi thu thập, sử dụng, cập nhật thông tin và tiết lộ thông tin cá nhân của khách hàng nhằm phục vụ khách hàng tốt nhất. Bên cạnh đó, chính sách bảo mật giải thích cách thức chúng tôi thực hiện để bảo mật thông tin cá nhân của khách hàng, đồng thời thể hiện sự tôn trọng và bảo vệ quyền lợi người truy cập. Ngoài ra, chính sách bảo mật còn thể hiện rõ quyền và nghĩa vụ của khách hàng khi thực hiện giao dịch với chúng tôi thông qua website này.</p><br />

<p>Với chính sách bảo mật, khách hàng có thể hoàn toàn yên tâm khi thực hiện giao dịch đặt mua hàng tại website này của chúng tôi. Mọi tiếp nhận thông tin từ khách hàng cũng như ý kiến phản hồi đều giúp chúng tôi cải thiện chất lượng và phục vụ khách hàng tốt nhất.</p>
            <h3 class="dk-title-h3">1. THU THẬP THÔNG TIN CÁ NHÂN</h3>
            <p>
Chúng tôi thu thập thông tin cá nhân để giao dịch mua bán giữa chúng tôi và khách hàng được thực hiện một cách thành công, và việc giao hàng cho khách hàng mua sắm trên website này được tiến hành thuận lợi. Đồng thời việc thu thập thông tin cá nhân là để chúng tôi thông báo, hỗ trợ việc giao hàng, cũng như cung cấp thông tin đơn hàng cho đơn vị vận chuyển hoặc đơn vị cung cấp dịch vụ thanh toán trực tuyến (nếu có). Ngoài ra, chúng tôi dựa vào thông tin cá nhân để giải đáp mọi thắc mắc của khách hàng cũng như dùng để nghiên cứu thị trường, nắm bắt nhu cầu và thị hiếu của khách hàng.</p>
<p>
Chúng tôi không thu thập thông tin cá nhân nhằm vào mục đích mua bán, trao đổi hay vụ lợi cá nhân.  
</p>
<p>
Khi quý khách đăng ký tài khoản tại <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn</a>, thông tin cá nhân mà chúng tôi thu thập bao gồm:<br />
-   Họ và tên<br />
-   Địa chỉ<br />
-   Số điện thoại liên lạc <br />
-   Email<br />
-   Ngày tháng năm sinh<br />
-    Giới tính<br />
-   Nghề nghiệp<br />
-   Quốc gia, tỉnh/thành….<br />
</p>
<h3 class="dk-title-h3">2. SỬ DỤNG VÀ CHIA SẺ THÔNG TIN</h3>
<p>Chúng tôi thu thập và sử dụng thông tin của khách hàng với mục đích phù hợp và hoàn toàn tuân thủ nội dung của <strong>"Chính sách bảo mật"</strong> này. Chúng tôi có thể sử dụng những thông tin đã thu thập để liên hệ trực tiếp với khách hàng thông qua các hình thức như: gửi email thông báo việc đặt hàng đã thành công, gửi thư ngỏ, thư cảm ơn, gọi điện thoại xác nhận đơn hàng, nghiên cứu thị trường, nhân khẩu học, quảng cáo, tiếp thị….</p>
<p>Chúng tôi có thể tiết lộ hoặc cung cấp thông tin cá nhân của khách hàng trong các trường hợp thật sự cần thiết như:</p><br />
<section class="list">
<p>-    Đơn vị vận chuyển hoặc đơn vị cung cấp dịch vụ thanh toán trực tuyến (nếu có).</p>
<p>-    Khi có yêu cầu của các cơ quan có thẩm quyền.</p>
<p>-    Nhằm bảo vệ quyền và lợi ích chính đáng của chúng tôi trước pháp luật.</p>
</section>
<h3 class="dk-title-h3">3. QUYỀN LỢI VÀ TRÁCH NHIỆM CỦA KHÁCH HÀNG</h3>
<p>Khách hàng được xem chi tiết đơn hàng trên mục <strong>"Lịch sử mua hàng"</strong>, được nhận thông tin về các chương trình khuyến mãi và các mẫu sản phẩm mới/tiếp thị. Khách hàng phải chịu trách nhiệm về tính hợp pháp và chính xác đối với những thông tin đã cung cấp hoặc khai báo với chúng tôi. Quý khách vui lòng không chia sẻ hay tiết lộ thông tin về <i>"tài khoản"</i> và <i>"mật khẩu"</i> đã đăng ký truy cập vào website của chúng tôi cho bất kỳ người nào khác. Khách hàng hoàn toàn chịu trách nhiệm và gánh chịu những tổn thất (nếu có) khi tiết lộ hoặc cung cấp thông tin về <i>"tài khoản"</i> và <i>"mật khẩu"</i> cho người khác.</p>
<h3 class="dk-title-h3">4. THỜI GIAN LƯU GIỮ THÔNG TIN</h3>
<p>
Thông tin của khách hàng được lưu giữ trên hệ thống, ngay cả khi khách hàng đã ngừng sử dụng dịch vụ của chúng tôi. Những dữ liệu này vẫn sẽ tồn tại trên hệ thống cho đến khi nào chúng tôi không còn mục đích sử dụng (như đã đề cập ở trên), thì thông tin sẽ được xóa khỏi hệ thống lưu trữ của chúng tôi.
</p>
<h3 class="dk-title-h3">5. BẢO MẬT THÔNG TIN</h3>
<p>
Khi khách hàng gửi thông tin cá nhân cho chúng tôi, đồng nghĩa với việc khách hàng đã chấp thuận với các điều khoản mà chúng tôi đã nêu ở trên. Chúng tôi cam kết:</p><br />
<section class="list">
<p>-    Không bán, không chia sẻ hay trao đổi thông tin cá nhân cho bất kỳ bên thứ 3 nào trừ đơn vị vận chuyển hoặc đơn vị thanh toán trực tuyến đã nêu trên.</p>
<p>-    Sử dụng trong nội bộ công ty đúng mục đích công việc và chỉ các nhân viên được phân công phụ trách.</p>
<p>-    Không cung cấp chi tiết đơn hàng cho bất kỳ ai trừ trường hợp đặc biệt theo yêu cầu của cơ quan có thẩm quyền (như đã nêu ở trên).</p>
<p>-    Bằng mọi cách thức có thể nhằm bảo vệ thông tin cá nhân của khách hàng không bị truy lục, sử dụng hoặc tiết lộ ngoài ý muốn.</p>
</section>
<p>
<strong>Lưu ý:</strong> Khách hàng nên đăng xuất, hoặc thoát tất cả cửa sổ web đang mở nếu sử dụng máy vi tính công cộng hoặc trong trường hợp nhiều người cùng sử dụng một máy nhằm hạn chế việc bị đánh cắp thông tin tài khoản.
</p>
        </article>
        
        
        
        <article style="margin-top: 30px;">
        <div class="chinhsachdoihang">
            <h2 class="title trachnhiem-kh">V. Các thông tin khác</h2>
            <h3 class="dk-title-h3">1. Quyền sở hữu trí tuệ</h3>
            <p>Tất cả các tài nguyên trong website: <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn</a> này và hệ thống website thuộc quyền sở hữu của Bita's và/hoặc người đăng ký của nó và được bảo vệ bởi Luật Sở hữu trí tuệ bao gồm các vấn đề liên quan tới bản quyền, nhãn hiệu, sáng chế và các đối tượng khác. Quyền sở hữu trí tuệ cũng được bảo hộ trên nhiều quốc gia khác dựa theo các điều ước quốc tế đa phương và song phương.</p>
<p>Bạn có quyền được sử dụng website này và/hoặc tài nguyên của website này cho cá nhân hay nội bộ không nhằm mục đích kinh doanh, chúng tôi khuyến khích việc sử dụng này cùng với việc trích dẫn nguồn cũng như giữ nguyên đường liên kết (link/url) đến tài nguyên trên website này. Bất kỳ việc sử dụng khác, bao gồm việc sao chép, sửa đổi, tái xuất bản một phần hay toàn bộ, truyền tải, phân phối, cấp phép, bán hay xuất bản bất cứ tài nguyên nào đều bị cấm nếu không được sự chấp thuận trước bằng văn bản của Bita's. Các nhãn hiệu, biểu tượng của Bita's đã đăng ký hoặc đang trong quá trình nghiên cứu duyệt bảo hộ theo Luật của Nhà nước CHXHCN Việt Nam.</p>
<h3>Hạn chế sử dụng</h3>
<p>
Khách hàng có thể truy cập website: <a href="http://www.bitas.com.vn" class="normal">www.bitas.com.vn</a> và tự cập nhật thông tin trong mục <strong>"Tài khoản của tôi"</strong> vào bất cứ thời điểm nào để chỉnh sửa những thông tin cá nhân của mình sau khi đăng nhập.
</p>
<h3 class="dk-title-h3">2. Sử dụng và chia sẽ thông tin</h3>
<p>Bita's không chấp nhận bất kỳ việc sử dụng website và/hoặc tài nguyên nào cùa website vào một trong những việc sau:</p>
<ul>
<li>Chống phá nhà nước CHXHCN Việt Nam.</li>
<li>Xâm phạm quyền tự do cá nhân của người khác; và/hoặc làm nhục, phỉ báng, bôi nhọ người khác; và/hoặc gây phương hại hay gây bất lợi cho người khác.</li>
<li>Gây rối trật tự công cộng; và/hoặc phạm pháp hình sự.</li>
<li>Truyền bá và phân phối thông tin cá nhân của bên thứ ba mà không được sự chấp thuận của họ.</li>
<li>Sử dụng vào mục đích kinh doanh và/hoặc thương mại mà không có sự chấp thuận trước bằng văn bản của chúng tôi, như là các cuộc thi, cá cược, đổi chác, quảng cáo hoặc kinh doanh đa cấp.</li>
<li>Truyền đi những tập tin máy tính bị nhiễm virus gây hư hại hoạt động của các máy tính khác.</li>
<li>Sử dụng các loại robot, nhện máy (spiders) và/hoặc bất kỳ thiết bị tự động nào, và/hoặc tự tay theo dõi và thu thập tài nguyên của website cho bất kỳ mục đích tái sử dụng mà không được sự cho phép trước bằng văn bản của chúng tôi.</li>
<li>Sử dụng bất kỳ thiết bị, phần mềm và/hoặc tiến trình nào nhằm xâm phạm hoặc cố ý xâm phạm đến hoạt động của website.</li>
<li>Bất kỳ hành động nào không hợp pháp và/hoặc bị cấm bởi các bộ luật tương ứng.</li>
<li>Bất kỳ hành động nào mà chúng tôi cho rằng không thích hợp.</li>
</ul>

<br /><br /><br />
<strong>
<p>Xin cám ơn,<br />
Công ty TNHH Sản Xuất Hàng Tiêu Dùng Bình Tân.</p></strong>
		</div>
        </article>
        
    </section>
</section>