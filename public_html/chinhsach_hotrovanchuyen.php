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
		
		$(".tinhthanh").on("change", function(){
			$this = $(this);
			var pvc = $this.val();
			if(pvc!=0){
				$(".pvc").empty().text(pvc);
				$(".phivanchuyen").slideDown();
			}else{
				$(".phivanchuyen").hide();
			}
		})
    });
</script>
<section id="chinhsachbaomat">
	<section class="header">
    	<h1 class="title">CHÍNH SÁCH HỖ TRỢ VẬN CHUYỂN</h1>
        <p>Chúng tôi hỗ trợ chi phí vận chuyển với chính sách hỗ trợ vận chuyển cụ thể như sau:</p>
    </section>
    <section class="content">
    	<div class="chinhsachvanchuyen faq-detail-view">
            <ul class="chiphivanchuyen">
                <li>
                    <h3 class="faq-expan">
                        <p>TP. Hồ Chí Minh</p>
                        <span class="drop-down"></span>
                    </h3>
                    <div class="clear"></div>
                    <div class="guide">
                        <img src="img/st/bang-phi-van-chuyen-toan-quoc-hochiminh.jpg" alt="chinh sach ho tro van chuyen Ho Chi Minh" title="Chính sách hổ trợ vận chuyển Hồ Chí Minh" />
                    </div>
                </li>
                <li>
                	<select name="tinhthanh" class="tinhthanh">
                    	<option value="0">Các tỉnh thành khác</option>
                	<?php
                    	$tt = $i->ListTinhThanhTruHCM();
						while($row_tt = mysql_fetch_assoc($tt)){
					?>
                    	<option value="<?php echo number_format($row_tt['CPVC'],0,".",","); ?>"><?php echo $row_tt['Ten']?></option>
                    <?php
                    	}
					?>
                    </select>
                    <div class="phivanchuyen">
                    	Phí vận chuyển <span class="pvc"></span> VNĐ
                    </div>
                </li>
            </ul>
            <div class="clear"></div>
            <ul>
            	<li>Áp dụng từ 31/03/2015</li>
                <li>Phí vận chuyển không được hoàn trả trong trường hợp đổi hoặc hủy đơn hàng bởi Quý khách.</li>
                <li>Chúng tôi có quyền thay đổi hoặc ngừng chính sách hỗ trợ vận chuyển bất cứ lúc nào mà không cần phải thông báo trước.</li>
            </ul>
        </div>
    </section>
</section>