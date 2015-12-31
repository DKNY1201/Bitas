<div id="footer">
  <div id="footer-inside" class="box_size">
    <div class="footer_ele">
      <h1 class="title">{Company}</h1>
        <ul>
            <li><a href="cat/gioi-thieu/">{About_Us}</a></li>
            <li><a href="cat/chinh-sach-ho-tro-van-chuyen/">Chính sách hỗ trợ vận chuyển</a></li>
            <li><a href="cat/bao-chi-truyen-thong/">Báo chí & truyền thông</a></li>
            <li><a href="cat/chinh-sach-bao-mat/">Chính sách bảo mật</a></li>
            <li><a href="cat/chinh-sach-doi-hang/">Chính sách đổi hàng</a></li>
            <li><a href="cat/chinh-sach-bao-hanh/">Chính sách bảo hành</a></li>
            <li><a href="cat/lien-he/">Liên hệ</a></li
        ></ul>
    </div>
    <div class="footer_ele">
      <h1 class="title">{Support}</h1>
        <ul>
          <li><a href="cat/faq/">{FAQ}</a></li>
            <li><a href="cat/huong-dan-mua-hang/">Hướng dẫn mua hàng</a></li>
            <li><a href="cat/huong-dan-thanh-toan/">Hướng dẫn thanh toán</a></li>
            <li><a href="cat/chinh-sach-huy-don-hang/">Chính sách hủy đơn hàng</a></li>
            <li><a href="cat/huong-dan-chon-size/">Hướng dẫn chọn size</a></li>
            <li><a href="cat/dia-diem-doi-bao-hanh/">Địa điểm đổi, bảo hành</a></li>
            <li><a href="cat/he-thong-cua-hang-le/">Hệ thống cửa hàng lẻ</a></li>   
        </ul>
    </div> 
    <div class="footer_ele two-ele">
      <h1 class="title">Thành viên</h1>
        <ul>
          <li><a href="http://www.bitasic.com.vn/" target="_blank">Bita's IC</a></li>
            <li><a href="http://www.nhattan.vn/" target="_blank">Nhật Tân</a></li>
        </ul>
        <h1 class="title second-ele" style="margin-top:10px;">{Connect_us}</h1>
        <ul id="social">
            <li class="fb"><a href="<?php echo $row_info['fb']?>" target="_blank">Facebook</a></li>
            <li class="youtube"><a href="<?php echo $row_info['youtube']?>" target="_blank">Youtube</a></li>
            <li class="gg"><a href="<?php echo $row_info['gg']?>" target="_blank">Google Plus</a></li>
        </ul>
    </div>
    <div class="footer_ele box_size" id="contact-footer">
        <h1 class="title">{Contact_us}</h1>
        <ul>
          <li class="company-name"><?php echo $row_info['companyName']?></li>
          <li><span>{Address}:</span> <?php echo $row_info['address']?></li>
          <li><span>{Tel}:</span> <?php echo $row_info['phone']?></li>
          <li><span>Fax:</span> <?php echo $row_info['fax']?></li>
          <li><span>Email:</span> <a href="mailto:<?php echo $row_info['email']?>" title="Gởi email cho chúng tôi"><?php echo $row_info['email']?></a></li>
        </ul>
    </div>
    <div class="footer_ele" id="news_letter">
      <h1 class="title">{Newsletter}</h1>
        <p>{Newsletter_text}.</p>
        <div class="input-group">
          <input type="text" value="{Your_Email}" onfocus="if(this.value=='{Your_Email}') this.value=''" onblur="if(this.value=='') this.value='{Your_Email}'" name="email_news" />
          <input type="submit" value=">" name="email_sub" id="email_sub" />
        </div>
        <div id="thank">
        </div>
    </div>
    <div class="clear"></div>
    <div class="all-right">
    	2015 © Bita's. All rights reserved.
        <div align="center" style="font-size:12px; padding-top:20px;">Giấy chứng nhận ĐKKD số: 0301422012 do Sở Kế Hoạch và Đầu Tư TPHCM cấp lần đầu ngày 18/05/1992. <br>
Người chịu trách nhiệm quản lý nội dung: Phạm Thị Thu Hằng
</div>
    </div>
  </div><!-- end footer-inside -->
</div><!--end_footer--> 