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
    });
</script>
<section id="chinhsachbaomat">

	<section class="header">

    	<h1 class="title">Chính sách hủy đơn hàng</h1>

    </section>

    <section class="content">
		<aside>
        	<nav>
            	<ul>
                	<li><a href="thongtin-cn">Điều kiện hủy đơn hàng</a></li>
                    <li><a href="capnhat-tt">Cam kết khi hủy đơn hàng</a></li>
                </ul>
            </nav>
        </aside>
		<article>
    	<div class="chinhsachdoihang">

            <div class="dieukiendoihang div-doihang">

                <h2 class="title thongtin-cn">Điều kiện hủy đơn hàng</h2>

                <ul>

                    <li>Đơn hàng sẽ tự động hủy nếu như sản phẩm không có sẵn vì bất cứ lý do nào.</li>

                    <li>Đơn hàng sẽ tự động hủy khi Quý khách có yêu cầu thay đổi thông tin về sản phẩm của đơn hàng (trừ trường hợp đơn hàng đã được xử lý và xuất kho).</li>

                    <li>Đơn hàng sẽ được phép hủy khi Quý khách có yêu cầu hủy đơn hàng trước khi đơn hàng được xử lý, xuất kho và bàn giao cho đơn vị vận chuyển.</li>

                </ul>

            </div><!-- end dieukiendoihang -->

            <div class="dieukiendoihang1 div-doihang">

	            <h2 class="title capnhat-tt">Cam kết khi hủy đơn hàng</h2>

                <ul>

                	<li>Trong trường hợp đơn hàng được <a href="">hủy bởi chúng tôi</a>, chúng tôi sẽ có trách nhiệm thông báo đến Quý khách trong thời gian sớm nhất. Quý khách sẽ không phải trả bất kỳ chi phí hủy đơn hàng nào trong trường hợp này.</li>

                    <li>Trong trường hợp đơn hàng được <a href="">hủy bởi Quý khách</a>, Quý khách phải có trách nhiệm thông báo đến chúng tôi trong thời gian sớm nhất. Nếu không, mọi khiếu nại sẽ không được giải quyết khi đơn hàng đã được xử lý.</li>

                    <li>Trong trường hợp Quý khách đã thanh toán trực tuyến, chúng tôi sẽ hoàn trả tiền mua hàng và phí vận chuyển thông qua tài khoản ngân hàng của Quý khách. Quý khách lưu ý phí dịch vụ cho xử lý giao dịch thẻ với ngân hàng sẽ không hoàn trả một khi đã thanh toán.</li>

                    <li>Xin Quý khách vui lòng liên hệ với <strong>Bộ Phận Chăm Sóc Khách Hàng Online</strong> theo đường dây nóng (08) 3754 3954 hoặc chat trực tuyến với chúng tôi trước khi hủy đơn hàng để được hướng dẫn thêm.</li>

                </ul>

    		</div><!-- end dieukiendoihang -->

        </div><!-- chinhsachdoihang -->
		</article>
    </section>

</section>