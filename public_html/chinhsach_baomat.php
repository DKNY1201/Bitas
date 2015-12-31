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
        var navHeight = 480;
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
        <h1 class="title">CHÍNH SÁCH BẢO MẬT</h1>
        <p>Đối với chúng tôi, sự an tâm, tin tưởng, và thoải mái của khách hàng khi mua sắm tại website www.bitas.com.vn là điều quan trọng nhất. Chính vì vậy, chính sách bảo mật là những cam kết của chúng tôi với khách hàng về việc bảo mật những thông tin cá nhân mà khách hàng đã cung cấp cho chúng tôi. Mọi giao dịch của khách hàng với chúng tôi đều được đảm bảo thực hiện theo đúng ý chí của khách hàng, tránh bị kẻ xấu lợi dụng hay đánh cắp tài khoản truy cập.</p>
<p>Chính sách bảo mật sẽ giải thích cách thức chúng tôi thu thập, sử dụng, cập nhật thông tin và tiết lộ thông tin cá nhân của khách hàng nhằm phục vụ khách hàng tốt nhất. Bên cạnh đó, chính sách bảo mật giải thích cách thức chúng tôi thực hiện để bảo mật thông tin cá nhân của khách hàng, đồng thời thể hiện sự tôn trọng và bảo vệ quyền lợi người truy cập. Ngoài ra, chính sách bảo mật còn thể hiện rõ quyền và nghĩa vụ của khách hàng khi thực hiện giao dịch với chúng tôi thông qua website này.</p>
<p>Với chính sách bảo mật, khách hàng có thể hoàn toàn yên tâm khi thực hiện giao dịch đặt mua hàng tại website này của chúng tôi. Mọi tiếp nhận thông tin từ khách hàng cũng như ý kiến phản hồi đều giúp chúng tôi cải thiện chất lượng và phục vụ khách hàng tốt nhất. </p>
<p><i>Toàn bộ nội dung chính sách bảo mật của www.bitas.com.vn bao gồm:</i></p>
    </section>
    <section class="content">
        <aside>
            <nav>
                <ul>
                    <li><a href="thongtin-cn">Thu thập thông tin cá nhân</a></li>
                    <li><a href="capnhat-tt">Cập nhật thông tin</a></li>
                    <li><a href="chiase-tt">Sử dụng và chia sẻ thông tin</a></li>
                    <li><a href="trachnhiem-kh">Quyền và trách nghiệm của khách hàng</a></li>
                    <li><a href="luutru-tt">Thời gian lưu trữ thông tin</a></li>
                    <li><a href="baomat-tt">Bảo mật thông tin</a></li>
                    <li><a href="chinhsach-bm">Thay đổi chính sách bảo mật</a></li>
                </ul>
            </nav>
        </aside>
        <article>
            <h2 class="title thongtin-cn">THU THẬP THÔNG TIN CÁ NHÂN</h2>
            <p>
Chúng tôi thu thập thông tin cá nhân để giao dịch mua bán giữa chúng tôi và khách hàng được thực hiện một cách thành công, và việc giao hàng cho khách hàng mua sắm trên website này được tiến hành thuận lợi. Đồng thời việc thu thập thông tin cá nhân là để chúng tôi thông báo, hỗ trợ việc giao hàng, cũng như cung cấp thông tin đơn hàng cho đơn vị vận chuyển hoặc đơn vị cung cấp dịch vụ thanh toán trực tuyến (nếu có). Ngoài ra, chúng tôi dựa vào thông tin cá nhân để giải đáp mọi thắc mắc của khách hàng cũng như dùng để nghiên cứu thị trường, nắm bắt nhu cầu và thị hiếu của khách hàng.</p>
<p>
Chúng tôi không thu thập thông tin cá nhân nhằm vào mục đích mua bán, trao đổi hay vụ lợi cá nhân.  
</p>
<p>
Khi quý khách đăng ký tài khoản tại www.bitas.com.vn, thông tin cá nhân mà chúng tôi thu thập bao gồm:<br />
-   Họ và tên<br />
-   Địa chỉ<br />
-   Số điện thoại liên lạc <br />
-   Email<br />
-   Ngày tháng năm sinh<br />
-    Giới tính<br />
-   Nghề nghiệp<br />
-   Quốc gia, tỉnh/thành….<br />
</p>
<h2 class="title capnhat-tt">CẬP NHẬT THÔNG TIN</h2>
<p>
Khách hàng có thể truy cập website: www.bitas.com.vn và tự cập nhật thông tin trong mục <strong>"Tài khoản của tôi"</strong> vào bất cứ thời điểm nào để chỉnh sửa những thông tin cá nhân của mình sau khi đăng nhập.
</p>
<h2 class="title chiase-tt">SỬ DỤNG VÀ CHIA SẺ THÔNG TIN</h2>
<p>Chúng tôi thu thập và sử dụng thông tin của khách hàng với mục đích phù hợp và hoàn toàn tuân thủ nội dung của <strong>"Chính sách bảo mật"</strong> này. Chúng tôi có thể sử dụng những thông tin đã thu thập để liên hệ trực tiếp với khách hàng thông qua các hình thức như: gửi email thông báo việc đặt hàng đã thành công, gửi thư ngỏ, thư cảm ơn, gọi điện thoại xác nhận đơn hàng, nghiên cứu thị trường, nhân khẩu học, quảng cáo, tiếp thị….</p>
<p>Chúng tôi có thể tiết lộ hoặc cung cấp thông tin cá nhân của khách hàng trong các trường hợp thật sự cần thiết như:</p><br />
<section class="list">
<p>-    Đơn vị vận chuyển hoặc đơn vị cung cấp dịch vụ thanh toán trực tuyến (nếu có).</p>
<p>-    Khi có yêu cầu của các cơ quan có thẩm quyền.</p>
<p>-    Nhằm bảo vệ quyền và lợi ích chính đáng của chúng tôi trước pháp luật.</p>
</section>
<h2 class="title trachnhiem-kh">QUYỀN LỢI VÀ TRÁCH NHIỆM CỦA KHÁCH HÀNG</h2>
<p>Khách hàng được xem chi tiết đơn hàng trên mục <strong>"Lịch sử mua hàng"</strong>, được nhận thông tin về các chương trình khuyến mãi và các mẫu sản phẩm mới/tiếp thị. Khách hàng phải chịu trách nhiệm về tính hợp pháp và chính xác đối với những thông tin đã cung cấp hoặc khai báo với chúng tôi. Quý khách vui lòng không chia sẻ hay tiết lộ thông tin về <i>"tài khoản"</i> và <i>"mật khẩu"</i> đã đăng ký truy cập vào website của chúng tôi cho bất kỳ người nào khác. Khách hàng hoàn toàn chịu trách nhiệm và gánh chịu những tổn thất (nếu có) khi tiết lộ hoặc cung cấp thông tin về <i>"tài khoản"</i> và <i>"mật khẩu"</i> cho người khác.</p>
<h2 class="title luutru-tt">THỜI GIAN LƯU GIỮ THÔNG TIN</h2>
<p>
Thông tin của khách hàng được lưu giữ trên hệ thống, ngay cả khi khách hàng đã ngừng sử dụng dịch vụ của chúng tôi. Những dữ liệu này vẫn sẽ tồn tại trên hệ thống cho đến khi nào chúng tôi không còn mục đích sử dụng (như đã đề cập ở trên), thì thông tin sẽ được xóa khỏi hệ thống lưu trữ của chúng tôi.
</p>
<h2 class="title baomat-tt">BẢO MẬT THÔNG TIN</h2>
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
<h2 class="title chinhsach-bm">THAY ĐỔI CHÍNH SÁCH BẢO MẬT</h2>
<p>Chúng tôi có quyền thay đổi bất kỳ lúc nào nội dung của chính sách bảo mật này nhằm đảm bảo phù hợp với từng thời điểm mà không cần phải thông báo trước và sẽ được đăng tải công khai trên website này. Khách hàng truy cập vào website của chúng tôi sau khi thông tin đã được chỉnh sửa, đồng nghĩa với việc khách hàng đã chấp nhận và tuân thủ những chỉnh sửa này. Chúng tôi khuyến nghị khách hàng nên tham khảo kỹ nội dung trang này trước khi truy cập các nội dung khác trên website của chúng tôi.</p><br />
<p>Xin cám ơn,<br />
Công ty TNHH Sản Xuất Hàng Tiêu Dùng Bình Tân.</p>
        </article>
    </section>
</section>