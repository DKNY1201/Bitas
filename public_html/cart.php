<?php
	session_start();
?>
<script>
	$(document).ready(function(e) {
		$(".reciever").click(function(e) {
            var stt=this.checked;
			//alert(stt);
			str=String(stt);
			//alert(str);
			if(str=="false")
				$("#recieve_add").slideDown();
			else
			 	$("#recieve_add").slideUp();
        });
		// tang giam so luong
		$(".plus").click(function(e) {
            var current_amount=$(this).parent().find($(".amount_text")).val();
			current_amount= parseInt(current_amount) + 1;
			$(this).parent().find($(".amount_text")).val(current_amount);
			soluong=$(".amount_text").val();
			var list_sl="";
			var list_idsp="";
			$("input[name='amount_text']").each(function(){
				list_sl = list_sl + "," + this.value;
				list_idsp = list_idsp + "," + $(this).attr("idSP");
		   	})
			list_sl=list_sl.substr(1);
			list_idsp=list_idsp.substr(1);
            document.location="cart_interactive.php?list_idSP="+list_idsp+"&list_soluong="+list_sl+"&action=update";
        });
		$(".minus").click(function(e) {
            var current_amount=$(this).parent().parent().find($(".amount_text")).val();
			if(current_amount>1)
				current_amount= parseInt(current_amount) - 1;
			$(this).parent().find($(".amount_text")).val(current_amount);
			soluong=$(".amount_text").val();
			var list_sl="";
			var list_idsp=""
			$("input[name='amount_text']").each(function(){
				list_sl = list_sl + "," + this.value;
				list_idsp = list_idsp + "," + $(this).attr("idSP");
		   	})
			list_sl=list_sl.substr(1);
			list_idsp=list_idsp.substr(1);
            document.location="cart_interactive.php?list_idSP="+list_idsp+"&list_soluong="+list_sl+"&action=update";
        });
		$("select[name='amount_pro']").change(function(e) {
			idsp=$(this).attr('idSP');
			sl=$(this).val();
            document.location="cart_interactive.php?idSP="+idsp+"&soluong="+sl+"&action=update";
        });
    });
</script>
<div id="cart">
    	<ul id="progressbar">
        	<li class="active">
            	1 - {Cart}
            </li>
            <li class="">
            	2 - {Login}/{Register}
            </li>
            <li class="">
            	3 - {Customer_Info}
            </li>
            <li class="">
            	4 - {Finish_Cart}
            </li>
        </ul><!--end_process-->
    <div class="clear"></div>
    <section class="cart_detail">
        <div class="cart_title">
            <h1 class="title">{Cart}</h1>
        </div><!--end_cart_title-->
		<?php   
			if(count($_SESSION['idPro'])<=0){
		?>
        	<div class="clear"></div>
			<div id="empty_cart">
				<p>{No_Product_In_Cart}</p>
				<p><a href="home.bitas" title="{Continue_Shopping}">{Continue_Shopping}</a></p>
			</div>
		<?php
			}
			else
			{   
		?>
    	<div class="cart_nav">
        <?php
			if(isset($_SESSION['idTTMS']))
			{	
			$idSP_ttms=$_SESSION['idTTMS'];
			$idlspgt_ttms=$i->LayChiTietLSPGTFromidSP($idSP_ttms);
			$row_ttms=mysql_fetch_assoc($idlspgt_ttms);
		?>
        	<a href="san-pham/<?php echo $row_ttms['tenlspgt']?>/<?php echo $row_ttms['tenlspdsg']?>/" class="back">{Continue_Shopping}<span></span></a>
        <?php }else{?>
	        <a href="home.bitas" class="back">{Continue_Shopping}<span></span></a>
       	<?php }?>
            <a href="<?php if(!isset($_SESSION['id'])) echo 'gio-hang/dang-nhap-dang-ki/'; else echo 'gio-hang/thong-tin-khach-hang/' ;?>" class="next">{Process_Payment}<span>&nbsp;</span></a>
      	</div><!-- end cart_nav -->
        
        <div class="cart-table-mobile">
        	 <?php
					$tongsl=0;
					$tongtien=0;
					$tongtiengiam=0;
					$sl_giamgia=0;
					$listID=implode(",",$_SESSION['idPro']);
					$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
					$sp=mysql_query($sql) or die(mysql_error());
					while($row_sp=mysql_fetch_assoc($sp))
					{
						$idsp=$row_sp['idSP'];
						$tensp=$row_sp['Ten'];
						$hinh=$row_sp['Hinh'];
						$soluong=$_SESSION['SoLuong'][$idsp];
						$mau=$row_sp['Mau'];
						$size=$row_sp['Size'];
						$dongia=$row_sp['Gia_vn'];
						$tien=$soluong*$dongia;
						$tongsl+=$soluong;
						$tongtien+=$tien;
						
						$giachuagiam=$row_sp['GiaChuaGiam_vn'];
						//PROMOTION
						if($dongia<$giachuagiam){
							$tiengiam=$soluong*$dongia;
							$tongtiengiam+=$tiengiam;
							$sl_giamgia+=$soluong;
						}
				?>
              <div class="row_item">
                <div class="img_d box_size"><a href="<?php echo $i->changeTitle($row_sp['Ten']) . '-' . $row_sp['idNSP']?>/"><img src="<?php echo $hinh?>" alt='<?php echo $row_sp['Ten']?>' /></a></div>
                <div class="des_d">
                	<h1 class="title"><?php echo $tensp?></h1>
                    <p>{Color}: <?php echo $mau?></p>
                    <p>{Size}: <?php echo $size?></p>
                    <p><?php echo number_format($dongia,0,".",",")?> VND</p>
                    <p>
                    	<select name="amount_pro" class="small_select" idSP=<?php echo $idsp?>>
                        	<?php
								//$sltk=$row_sp['SLTK'];
								for($pro_n=1;$pro_n<=10;$pro_n++){
							?>
                        		<option value="<?php echo $pro_n?>" <?php if($pro_n==$_SESSION['SoLuong'][$idsp]) echo 'selected';?>><?php echo $pro_n?></option>
                            <?php }?>
                        </select>
                        <a class="remove_item" onclick="return confirm('Bạn muốn bỏ sản phẩm này khỏi giỏ hàng?')" href="cart_interactive.php?idSP=<?php echo $idsp?>&action=remove">{Del_Pro}</a>
                    </p>
                    <?php if($dongia<$giachuagiam && $checkPA && $pro_code != 'HAPPYHOUR'){?>
                    <p style="color:#900; font-size:11px">Hàng giảm giá sẽ không được tính vào chương trình khuyến mãi</p>
                    <?php } ?>
				</div>
              </div>
              <?php
				}
				//PROMOTION
				if($checkPA){
					$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
					$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
					/*
					//BUYMOREGETMORE
					switch($soluong_khongtinhhanggiamgia){
						case 1:
							break;
						case 2:
							$tien=0;
							$tongtien=0;
							
							$listID=implode(",",$_SESSION['idPro']);
							$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
							$sp=mysql_query($sql) or die(mysql_error());
							$ii=0;
							while($row_sp=mysql_fetch_assoc($sp))
							{
								if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
								{
									if($ii==0)
										$temp=$row_sp['Gia_vn'];
									if($row_sp['Gia_vn']<=$temp)
										$temp=$row_sp['Gia_vn'];
									$ii++;
								}
								$idsp=$row_sp['idSP'];
								$dongia=$row_sp['Gia_vn'];
								$soluong=$_SESSION['SoLuong'][$idsp];
								$tien=$soluong*$dongia;
								$tongtien+=$tien;
							}
							$tiengiam_promo = $temp * 0.3;
							$tongtien_promo = $tongtien - $tiengiam_promo ;
							break;
						case 3:
							$tien=0;
							$tongtien=0;
							
							$listID=implode(",",$_SESSION['idPro']);
							$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
							$sp=mysql_query($sql) or die(mysql_error());
							$ii=0;
							while($row_sp=mysql_fetch_assoc($sp))
							{
								if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
								{
									if($ii==0)
										$temp=$row_sp['Gia_vn'];
									if($row_sp['Gia_vn']<=$temp)
										$temp=$row_sp['Gia_vn'];
									$ii++;
								}
								$idsp=$row_sp['idSP'];
								$dongia=$row_sp['Gia_vn'];
								$soluong=$_SESSION['SoLuong'][$idsp];
								$tien=$soluong*$dongia;
								$tongtien+=$tien;
							}
							$tiengiam_promo = $temp * 0.4;
							$tongtien_promo = $tongtien - $tiengiam_promo ;
							break;
						default:
							$tien=0;
							$tongtien=0;
							
							$listID=implode(",",$_SESSION['idPro']);
							$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
							$sp=mysql_query($sql) or die(mysql_error());
							$ii=0;
							while($row_sp=mysql_fetch_assoc($sp))
							{
								if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
								{
									if($ii==0)
										$temp=$row_sp['Gia_vn'];
									if($row_sp['Gia_vn']<=$temp)
										$temp=$row_sp['Gia_vn'];
									$ii++;
								}
								$idsp=$row_sp['idSP'];
								$dongia=$row_sp['Gia_vn'];
								$soluong=$_SESSION['SoLuong'][$idsp];
								$tien=$soluong*$dongia;
								$tongtien+=$tien;
							}
							
							$tiengiam_promo = $temp * 0.5;
							$tongtien_promo = $tongtien - $tiengiam_promo ;
							break;
					}// end switch
					*/
				}// end if
			  ?>
              <div class="thanhtien">
                	<div class="vanchuyen">
                        <p class="vanchuyen_f">Thành tiền</p>
                        <p class="vanchuyen_l"><?php echo number_format($tongtien,0,".",",")?> VND 
                        </p>
                    </div>
                    <!-- ================================================ -->
                    <!-- ================================================ -->
                    <!-- =================== PROMOTION ================== -->
                    <!-- ================================================ -->
                    <!-- ================================================ -->
                    <div class="promotion_text">
                        <?php
                            if($checkPA){
							 /* OPENNING2014
								if($tongtien_khongtinhhanggiamgia<$promotion_price){
									$remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
									echo "<strong>(Mua thêm ".number_format($remain_to_promo,0,".",",")." VND để được giảm giá ".number_format($reduceMoney,0,".",",")." VND)</strong>";
								}
								*/
								/* BUYMOREGETMORE
								if($soluong_khongtinhhanggiamgia<=1&&$checkPA){
									echo '<strong>(Mua trên 2 sản phẩm sẽ nhận được ưu đãi <a href="#" style="color: #2980b9; text-decoration: underline">hấp dẫn</a>)</strong>';
								}
								*/
								/* QUACHONANG080315
								if($tongtien_khongtinhhanggiamgia<$promotion_price){
									$remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
									echo '<strong>(Mua thêm '.number_format($remain_to_promo,0,".",",").' VND để được tặng phiếu massage '.'<a target="_blank" href="http://bitas.com.vn/news/detail/34/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}*/
								
								// GIAM15: No promotion text
								
								/* BANHANGTOANQUOC0415
								if(!isset($_SESSION['id'])){
									echo '<strong>(Đăng nhập và nhận tiền thưởng <a href="cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									$checkPlay = $i->CheckDaChoiHayChua($_SESSION['email']);
									if(!$checkPlay){
										echo '<strong>(Chương trình nhận tiền thưởng <a href="cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
									else{
										$tt = $i -> GetTienThuong($_SESSION['email']);
										$row_tt = mysql_fetch_assoc($tt);
										$gttt = $row_tt['GiaTri'];
										echo '<strong>Bạn có ' . number_format($gttt,0,".",",") . ' tiền thưởng.</strong><br />';
										if($tongtien_khongtinhhanggiamgia<$promotion_price){
											$remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
											echo '<strong>(Mua thêm '.number_format($remain_to_promo,0,".",",").' VND để sử dụng tiền thưởng '.'<a href="http://bitas.com.vn/cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
										}
									}
								}*/
								
								// NGAYCUAME2015: No promotion text
								// QUOCTETHIEUNHI2015: No promotion text
								// SINHNHATCTY2015: No promotion text
								// GIAYDEPKHAITRUONG1
								if($pro_code=='GIAYDEPKHAITRUONG1'){
									$isChild = $i ->checkOrderHasChild($listID);
									if($isChild){
										echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/41/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Mua ít nhất 1 mã hàng trẻ em sẽ được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/41/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='BEVUONTAMVOI'){
									if($soluong_khongtinhhanggiamgia >= 3){
										echo '<strong>(Bạn được miển phí sản phẩm chính phẩm có giá trị thấp nhất trong đơn hàng <a href="http://bitas.com.vn/news/detail/42/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Mua ít nhất 3 sản phẩm chính phẩm sẽ được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/42/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='QUOCKHANH2015'){
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/45/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 500,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/45/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='TRUNGTHU2015'){
									if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}elseif($tongtien_khongtinhhanggiamgia > 200000){
										echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
									else{
										echo '<strong>(Mua trên 100,000 VNĐ hàng chính phẩm để được giảm giá <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='QUATANGYEUTHUONG'){
									if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}elseif($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
										echo '<strong>(Bạn được tặng phiếu mua hàng siêu thị Coop Mart trị giá 50.000 VNĐ <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}elseif($tongtien_khongtinhhanggiamgia >= 500000){
										echo '<strong>(Bạn được tặng phiếu mua hàng siêu thị Coop Mart trị giá 100.000 VNĐ <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Mua trên 150,000 VNĐ hàng chính phẩm để được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='TRIANNHAGIAO2015'){
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/49/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 350,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/49/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='NOEL2015'){
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/50/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 300,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/50/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
								if($pro_code=='DONXUAN2016'){
									if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng và giảm thêm 50,000 VNĐ <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}elseif($tongtien_khongtinhhanggiamgia >= 500000){
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng và giảm thêm 100,000 VNĐ <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}else{
										echo '<strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
							}
                        ?>
                    </div>
                    <div class="vanchuyen">
                        <p class="vanchuyen_f">Khuyến mãi</p>
                        <p class="vanchuyen_l">
                            <?php
                                if($checkPA){
									/* OPENNING2014
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										echo number_format($reduceMoney,0,".",",");
									}else{
										echo "0";
									}
									*/
									/* BUYMOREGETMORE
									if($tongtien_promo){	
										echo number_format($tiengiam_promo,0,".",",");
									}
									else{
										echo "0";
									}
									*/
									/* QUACHONANG080315
									echo number_format($tongtien_khongtinhhanggiamgia*0.1,0,".",",");
									*/
									
									/*GIAM15
									echo number_format($tongtien_khongtinhhanggiamgia * 0.15,0,".",",");
									*/
									
									/* BANHANGTOANQUOC0415
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										echo number_format($gttt,0,".",",");
									}else{
										echo '0';
									}*/
									/* NGAYCUAME2015
									$listID=implode(",",$_SESSION['idPro']);
									$sql="SELECT loaispgt.idlspgt as idlspgt,idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP in ($listID) AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
									$sp=mysql_query($sql) or die(mysql_error());
									$tiengiam = 0;
									$tongtiengiam_promo = 0;
									while($row_sp=mysql_fetch_assoc($sp))
									{
										if($row_sp['Gia_vn'] == $row_sp['GiaChuaGiam_vn']){
											$idsp = $row_sp['idSP'];
											$soluong=$_SESSION['SoLuong'][$idsp];
											$idlspgt = $row_sp['idlspgt'];
											if($idlspgt == 1 || $idlspgt == 3){
												$tiengiam = $row_sp['Gia_vn'] * 0.2 * $soluong;
											}elseif($idlspgt == 2 || $idlspgt == 4){
												$tiengiam = $row_sp['Gia_vn'] * 0.1 * $soluong;
											}
											$tongtiengiam_promo += $tiengiam;
										}
									}
									echo number_format($tongtiengiam_promo,0,".",",");
									// end NGAYCUAME2015 */
									/* QUOCTETHIEUNHI2015
									$listID=implode(",",$_SESSION['idPro']);
									$sql="SELECT loaispgt.idlspgt as idlspgt,idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP in ($listID) AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
									$sp=mysql_query($sql) or die(mysql_error());
									$tiengiam = 0;
									$tongtiengiam_promo = 0;
									while($row_sp=mysql_fetch_assoc($sp))
									{
										if($row_sp['Gia_vn'] == $row_sp['GiaChuaGiam_vn']){
											$idsp = $row_sp['idSP'];
											$soluong=$_SESSION['SoLuong'][$idsp];
											$idlspgt = $row_sp['idlspgt'];
											if($idlspgt == 1 || $idlspgt == 2){
												$tiengiam = $row_sp['Gia_vn'] * 0.19 * $soluong;
											}elseif($idlspgt == 3 || $idlspgt == 4){
												$tiengiam = $row_sp['Gia_vn'] * 0.1 * $soluong;
											}
											$tongtiengiam_promo += $tiengiam;
										}
									}
									echo number_format($tongtiengiam_promo,0,".",",");
									// end QUOCTETHIEUNHI2015 */
									/* SINHNHATCTY2015
									echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
									*/
									//HAPPYHOUR
									if($pro_code=='HAPPYHOUR'){
										if((int)$tongtien >= (int)$promotion_price){
											echo '<span class="promotion_text" style="position:static"><strong>(Miễn phí Phí vận chuyển <a href="http://bitas.com.vn/news/detail/39/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></span>';
										}else{
											echo '<span class="promotion_text" style="position:static"><strong>(Mua trên ' . number_format($promotion_price,0,".",",") . ' VNĐ sẽ được miễn phí Phí vận chuyển <a href="http://bitas.com.vn/news/detail/39/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></span>';
										}
									}
									// GIAYDEPKHAITRUONG1
									if($pro_code=='GIAYDEPKHAITRUONG1'){
										if($isChild){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo '0';
										}
									}
									// BEVUONTAMVOI
									if($pro_code=='BEVUONTAMVOI'){
										if($soluong_khongtinhhanggiamgia >= 3){
											$saleoff = $i->calcLowestProduct($listID);
											echo number_format($saleoff,0,".",",");
										}else{
											echo '0';
										}
									}
									// QUOCKHANH2015
									if($pro_code=='QUOCKHANH2015'){
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}
									}
									// TRUNGTHU2015
									if($pro_code=='TRUNGTHU2015'){
										if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia > 200000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo '0';
										}
									}
									// QUATANGYEUTHUONG
									if($pro_code=='QUATANGYEUTHUONG'){
										if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}else{
											echo '0';
										}
									}
									// TRIANNHAGIAO2015 | NOEL2015
									if($pro_code=='TRIANNHAGIAO2015' || $pro_code=='NOEL2015'){
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}
									}
									// DONXUAN2016
									if($pro_code=='DONXUAN2016'){
										if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1 + 50000,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia >= 500000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1 + 100000,0,".",",");
										}else{
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}
									}
								}else{
									echo "0";
								}
                            ?> 
                            <?php
								if(!($checkPA && $pro_code == 'HAPPYHOUR')){
							?>
                            VND
                            <?php }else{} ?>
                                
                        </p>
                    </div>
                    <div class="clear"></div>
                    <div id="tongtien">
                        <p class="tongtien_l">Tạm tính</p>
                        <p class="tongtien_r">
                            <?php
                                if($checkPA){
									/* OPENNING 2014
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										$tongtien-=$reduceMoney;
									}
									*/
									/* BUYMOREGETMORE
									if($tongtien_promo){	
										echo number_format($tongtien_promo,0,".",",");
									}
									else{
										echo number_format($tongtien,0,".",",");
									}
									*/
									
									/* GIAM15
									$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
									echo number_format($tongtien_promotion,0,".",",");
									*/
									
									/* BANHANGTOANQUOC0415
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										$tongtien_promotion = $tongtien - $gttt;
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										echo number_format($tongtien,0,".",",");
									}*/
									/* NGAYCUAME2015
									$tongtien_promotion = $tongtien - $tongtiengiam_promo;
									echo number_format($tongtien_promotion,0,".",",");
									*/
									/* QUOCTETHIEUNHI2015
									$tongtien_promotion = $tongtien - $tongtiengiam_promo;
									echo number_format($tongtien_promotion,0,".",",");
									*/
									/* SINHNHATCTY2015
									$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
									echo number_format($tongtien_promotion,0,".",",");
									*/
									//HAPPYHOUR
									if($pro_code=='HAPPYHOUR'){
										echo number_format($tongtien,0,".",",");
									}
									// GIAYDEPKHAITRUONG1
									if($pro_code=='GIAYDEPKHAITRUONG1'){
										if($isChild){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											echo number_format($tongtien,0,".",",");
										}
									}
									// BEVUONTAMVOI
									if($pro_code=='BEVUONTAMVOI'){										
										if($soluong_khongtinhhanggiamgia >= 3){
											$tongtien_promotion = $tongtien - $saleoff;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											echo number_format($tongtien,0,".",",");
										}
									}
									// QUOCKHANH2015
									if($pro_code=='QUOCKHANH2015'){										
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}
									}
									// TRUNGTHU2015
									if($pro_code=='TRUNGTHU2015'){										
										if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia > 200000){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											echo number_format($tongtien,0,".",",");
										}
									}
									// QUATANGYEUTHUONG
									if($pro_code=='QUATANGYEUTHUONG'){										
										if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											echo number_format($tongtien,0,".",",");
										}
									}
									// TRIANNHAGIAO2015 | NOEL2015
									if($pro_code=='TRIANNHAGIAO2015' || $pro_code=='NOEL2015'){										
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}
									}
									// DONXUAN2016
									if($pro_code=='DONXUAN2016'){										
										if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
											$tongtien_promotion = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 50000);
											echo number_format($tongtien_promotion,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia >= 500000){
											$tongtien_promotion = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 100000);
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}
									}
								}else{
									echo number_format($tongtien,0,".",",");
								}
                            ?> VND
                        </p>
                    </div>
                    <div class="clear"></div>
                    <div class="tax">( Đã bao gồm thuế )</div>
              </div>
        </div><!-- end cart-table-mobile -->
        
    	 <table width="100%" border="0" cellspacing="0" cellpadding="4" class="cart-table-desktop">
              <tr>
                <th class="img_h">&nbsp;</td>
                <th class="des_h">{Description}</td>
                <th class="price_h">{Price}</td>
                <th class="amount_h">{Quantity}</td>
                <th class="total_h">{Total}</td>
              </tr>
                <?php
					$tongsl=0;
					$tongtien=0;
					$tongtiengiam=0;
					$sl_giamgia=0;
					$listID=implode(",",$_SESSION['idPro']);
					$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
					$sp=mysql_query($sql) or die(mysql_error());
					while($row_sp=mysql_fetch_assoc($sp))
					{
						$idsp=$row_sp['idSP'];
						$tensp=$row_sp['Ten'];
						$hinh=$row_sp['Hinh'];
						$soluong=$_SESSION['SoLuong'][$idsp];
						$mau=$row_sp['Mau'];
						$size=$row_sp['Size'];
						$dongia=$row_sp['Gia_vn'];
						$tien=$soluong*$dongia;
						$tongsl+=$soluong;
						$tongtien+=$tien;
						
						$giachuagiam=$row_sp['GiaChuaGiam_vn'];
						//PROMOTION
						if($dongia<$giachuagiam){
							$tiengiam=$soluong*$dongia;
							$tongtiengiam+=$tiengiam;
							$sl_giamgia+=$soluong;
						}
				?>
              <tr class="row_item" height="150px">
                <td class="img_d box_size"><a href="<?php echo $i->changeTitle($row_sp['Ten']) . '-' . $row_sp['idNSP']?>/"><img width="180px" src="<?php echo $hinh?>" alt='<?php echo $row_sp['Ten']?>' /></a></td>
                <td class="des_d">
                	<h1 class="title"><?php echo $tensp?></h1>
                    <p>{Color}: <?php echo $mau?></p>
                    <p>{Size}: <?php echo $size?></p>
                    <?php if($dongia<$giachuagiam && $checkPA && $pro_code != 'HAPPYHOUR'){?>
                    <p style="color:#900; font-size:11px">Hàng giảm giá sẽ không được tính vào chương trình khuyến mãi</p>
                    <?php } ?>
				</td>
                <td class="price_d"><?php echo number_format($dongia,0,".",",")?> VND</td>
                <td class="amount_d">
                	<div class="amount reset_m_p">
                    	<select name="amount_pro" class="small_select" idSP=<?php echo $idsp?>>
                        	<?php
								//$sltk=$row_sp['SLTK'];
								for($pro_n=1;$pro_n<=10;$pro_n++){
							?>
                        		<option value="<?php echo $pro_n?>" <?php if($pro_n==$_SESSION['SoLuong'][$idsp]) echo 'selected';?>><?php echo $pro_n?></option>
                            <?php }?>
                        </select>
                    </div>
                    <a class="remove_item" onclick="return confirm('Bạn muốn bỏ sản phẩm này khỏi giỏ hàng?')" href="cart_interactive.php?idSP=<?php echo $idsp?>&action=remove">{Del_Pro}</a>
                </td>
                <td class="total_d"><?php echo number_format($tien,0,".",",")?> VND</td>
              </tr>
              <?php
				}
				//PROMOTION
				if($checkPA){
					$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
					$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
					/*
					//BUYMOREGETMORE
					switch($soluong_khongtinhhanggiamgia){
						case 1:
							break;
						case 2:
							$tien=0;
							$tongtien=0;
							
							$listID=implode(",",$_SESSION['idPro']);
							$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
							$sp=mysql_query($sql) or die(mysql_error());
							$ii=0;
							while($row_sp=mysql_fetch_assoc($sp))
							{
								if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
								{
									if($ii==0)
										$temp=$row_sp['Gia_vn'];
									if($row_sp['Gia_vn']<=$temp)
										$temp=$row_sp['Gia_vn'];
									$ii++;
								}
								$idsp=$row_sp['idSP'];
								$dongia=$row_sp['Gia_vn'];
								$soluong=$_SESSION['SoLuong'][$idsp];
								$tien=$soluong*$dongia;
								$tongtien+=$tien;
							}
							$tiengiam_promo = $temp * 0.3;
							$tongtien_promo = $tongtien - $tiengiam_promo ;
							break;
						case 3:
							$tien=0;
							$tongtien=0;
							
							$listID=implode(",",$_SESSION['idPro']);
							$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
							$sp=mysql_query($sql) or die(mysql_error());
							$ii=0;
							while($row_sp=mysql_fetch_assoc($sp))
							{
								if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
								{
									if($ii==0)
										$temp=$row_sp['Gia_vn'];
									if($row_sp['Gia_vn']<=$temp)
										$temp=$row_sp['Gia_vn'];
									$ii++;
								}
								$idsp=$row_sp['idSP'];
								$dongia=$row_sp['Gia_vn'];
								$soluong=$_SESSION['SoLuong'][$idsp];
								$tien=$soluong*$dongia;
								$tongtien+=$tien;
							}
							$tiengiam_promo = $temp * 0.4;
							$tongtien_promo = $tongtien - $tiengiam_promo ;
							break;
						default:
							$tien=0;
							$tongtien=0;
							
							$listID=implode(",",$_SESSION['idPro']);
							$sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
							$sp=mysql_query($sql) or die(mysql_error());
							$ii=0;
							while($row_sp=mysql_fetch_assoc($sp))
							{
								if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
								{
									if($ii==0)
										$temp=$row_sp['Gia_vn'];
									if($row_sp['Gia_vn']<=$temp)
										$temp=$row_sp['Gia_vn'];
									$ii++;
								}
								$idsp=$row_sp['idSP'];
								$dongia=$row_sp['Gia_vn'];
								$soluong=$_SESSION['SoLuong'][$idsp];
								$tien=$soluong*$dongia;
								$tongtien+=$tien;
							}
							
							$tiengiam_promo = $temp * 0.5;
							$tongtien_promo = $tongtien - $tiengiam_promo ;
							break;
					}// end switch
					*/
				}// end if
			  ?>
              
              <tr class="total_product">
                <td colspan="3"></td>
                <td>{Into_Cash}</td>
                <td><?php echo number_format($tongtien,0,".",",")?> VND</td>
              </tr>
          </table><!-- end cart-table-desktop -->
          <div id="more_content" class="box_shadow box_size">
          	<div id="bonus_service">
            	<ul>
                	<li class="vanchuyen">{Will_be_at_ur_house} <span>{In_n_day}</span></li>
                    <li class="thanhtoan">{Pay_Flexible}</li>
                    <li class="trahang">Đổi hàng trong 7 ngày</li>
                    <li class="hoantien">Bảo hành 60 ngày</li>
                    <li class="hotline">Hotline: <?php echo $row_info['hotline']?></li>
                </ul>
            </div>
            <div id="total_money">
            	<div class="vanchuyen">
                	<p class="vanchuyen_f">Thành tiền</p>
                    <p class="vanchuyen_l"><?php echo number_format($tongtien,0,".",",")?> VND 
                    </p>
                </div>
                <!-- ================================================ -->
                <!-- ================================================ -->
                <!-- =================== PROMOTION ================== -->
                <!-- ================================================ -->
                <!-- ================================================ -->
                <div class="promotion_text">
					<?php
						if($checkPA){
						 /* OPENNING2014
                            if($tongtien_khongtinhhanggiamgia<$promotion_price){
                                $remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
                                echo "<strong>(Mua thêm ".number_format($remain_to_promo,0,".",",")." VND để được giảm giá ".number_format($reduceMoney,0,".",",")." VND)</strong>";
                            }
                            */
                            /* BUYMOREGETMORE
                            if($soluong_khongtinhhanggiamgia<=1&&$checkPA){
                                echo '<strong>(Mua trên 2 sản phẩm sẽ nhận được ưu đãi <a href="#" style="color: #2980b9; text-decoration: underline">hấp dẫn</a>)</strong>';
                            }
							*/
                            /* QUACHONANG080315
                            if($tongtien_khongtinhhanggiamgia<$promotion_price){
                                $remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
                                echo '<strong>(Mua thêm '.number_format($remain_to_promo,0,".",",").' VND để được tặng phiếu massage '.'<a target="_blank" href="http://bitas.com.vn/news/detail/34/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
                            }*/
							
							// GIAM15: No promotion text
							
							/* BANHANGTOANQUOC0415
							if(!isset($_SESSION['id'])){
								echo '<strong>(Đăng nhập và nhận tiền thưởng <a href="cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
							}else{
								$checkPlay = $i->CheckDaChoiHayChua($_SESSION['email']);
								if(!$checkPlay){
									echo '<strong>(Chương trình nhận tiền thưởng <a href="cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
								else{
									$tt = $i -> GetTienThuong($_SESSION['email']);
									$row_tt = mysql_fetch_assoc($tt);
									$gttt = $row_tt['GiaTri'];
									echo '<strong>Bạn có ' . number_format($gttt,0,".",",") . ' tiền thưởng.</strong><br />';
									if($tongtien_khongtinhhanggiamgia<$promotion_price){
										$remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
										echo '<strong>(Mua thêm '.number_format($remain_to_promo,0,".",",").' VND để sử dụng tiền thưởng '.'<a href="http://bitas.com.vn/cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
									}
								}
							}*/
							
							// NGAYCUAME2015: No promotion text
							// QUOCTETHIEUNHI2015: No promotion text
							// SINHNHATCTY2015: No promotion text
							// GIAYDEPKHAITRUONG1
							if($pro_code=='GIAYDEPKHAITRUONG1'){
								$isChild = $i ->checkOrderHasChild($listID);
								if($isChild){
									echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/41/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Mua ít nhất 1 mã hàng trẻ em sẽ được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/41/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='BEVUONTAMVOI'){
								if($soluong_khongtinhhanggiamgia >= 3){
									echo '<strong>(Bạn được miển phí sản phẩm chính phẩm có giá trị thấp nhất trong đơn hàng <a href="http://bitas.com.vn/news/detail/42/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Mua ít nhất 3 sản phẩm chính phẩm sẽ được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/42/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='QUOCKHANH2015'){
								if($tongtien_khongtinhhanggiamgia >= $promotion_price){
									echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/45/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 500,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/45/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='TRUNGTHU2015'){
								if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}elseif($tongtien_khongtinhhanggiamgia > 200000){
									echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
								else{
									echo '<strong>(Mua trên 100,000 VNĐ hàng chính phẩm để được giảm giá <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='QUATANGYEUTHUONG'){
								if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}elseif($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
									echo '<strong>(Bạn được tặng phiếu mua hàng siêu thị Coop Mart trị giá 50.000 VNĐ <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}elseif($tongtien_khongtinhhanggiamgia >= 500000){
									echo '<strong>(Bạn được tặng phiếu mua hàng siêu thị Coop Mart trị giá 100.000 VNĐ <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Mua trên 150,000 VNĐ hàng chính phẩm để được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='TRIANNHAGIAO2015'){
								if($tongtien_khongtinhhanggiamgia >= $promotion_price){
									echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/49/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 350,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/49/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='NOEL2015'){
								if($tongtien_khongtinhhanggiamgia >= $promotion_price){
									echo '<strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/50/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 300,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/50/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
							if($pro_code=='DONXUAN2016'){
								if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng và giảm thêm 50,000 VNĐ <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}elseif($tongtien_khongtinhhanggiamgia >= 500000){
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng và giảm thêm 100,000 VNĐ <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}else{
									echo '<strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong>';
								}
							}
						}
                    ?>
                </div>
                <div class="vanchuyen">
                	<p class="vanchuyen_f">Khuyến mãi</p>
                    <p class="vanchuyen_l">
						<?php
							if($checkPA){
								/* OPENNING2014
								if($tongtien_khongtinhhanggiamgia>$promotion_price){
									echo number_format($reduceMoney,0,".",",");
								}else{
									echo "0";
								}
								*/
								/* BUYMOREGETMORE
								if($tongtien_promo){	
									echo number_format($tiengiam_promo,0,".",",");
								}
								else{
									echo "0";
								}
								*/
								/* QUACHONANG080315
								echo number_format($tongtien_khongtinhhanggiamgia*0.1,0,".",",");
								*/
								/*GIAM15
								echo number_format($tongtien_khongtinhhanggiamgia * 0.15,0,".",",");
								*/
								/* BANHANGTOANQUOC0415
								if($tongtien_khongtinhhanggiamgia>$promotion_price){
									echo number_format($gttt,0,".",",");
								}else{
									echo '0';
								}*/
								/* NGAYCUAME2015
								$listID=implode(",",$_SESSION['idPro']);
								$sql="SELECT loaispgt.idlspgt as idlspgt,idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP in ($listID) AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
								$sp=mysql_query($sql) or die(mysql_error());
								$tiengiam = 0;
								$tongtiengiam_promo = 0;
								while($row_sp=mysql_fetch_assoc($sp))
								{
									if($row_sp['Gia_vn'] == $row_sp['GiaChuaGiam_vn']){
										$idsp = $row_sp['idSP'];
										$soluong=$_SESSION['SoLuong'][$idsp];
										$idlspgt = $row_sp['idlspgt'];
										if($idlspgt == 1 || $idlspgt == 3){
											$tiengiam = $row_sp['Gia_vn'] * 0.2 * $soluong;
										}elseif($idlspgt == 2 || $idlspgt == 4){
											$tiengiam = $row_sp['Gia_vn'] * 0.1 * $soluong;
										}
										$tongtiengiam_promo += $tiengiam;
									}
								}
								echo number_format($tongtiengiam_promo,0,".",",");
								// end NGAYCUAME2015 */
								/* QUOCTETHIEUNHI2015
								$listID=implode(",",$_SESSION['idPro']);
								$sql="SELECT loaispgt.idlspgt as idlspgt,idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP in ($listID) AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
								$sp=mysql_query($sql) or die(mysql_error());
								$tiengiam = 0;
								$tongtiengiam_promo = 0;
								while($row_sp=mysql_fetch_assoc($sp))
								{
									if($row_sp['Gia_vn'] == $row_sp['GiaChuaGiam_vn']){
										$idsp = $row_sp['idSP'];
										$soluong=$_SESSION['SoLuong'][$idsp];
										$idlspgt = $row_sp['idlspgt'];
										if($idlspgt == 1 || $idlspgt == 2){
											$tiengiam = $row_sp['Gia_vn'] * 0.19 * $soluong;
										}elseif($idlspgt == 3 || $idlspgt == 4){
											$tiengiam = $row_sp['Gia_vn'] * 0.1 * $soluong;
										}
										$tongtiengiam_promo += $tiengiam;
									}
								}
								echo number_format($tongtiengiam_promo,0,".",",");
								// end QUOCTETHIEUNHI2015*/
								/* SINHNHATCTY2015
								echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
								*/
								//HAPPYHOUR
								if($pro_code=='HAPPYHOUR'){
									if((int)$tongtien >= (int)$promotion_price){
										echo '<span class="promotion_text" style="position:static"><strong>(Miễn phí Phí vận chuyển <a href="http://bitas.com.vn/news/detail/39/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></span>';
									}else{
										echo '<span class="promotion_text" style="position:static"><strong>(Mua trên ' . number_format($promotion_price,0,".",",") . ' VNĐ sẽ được miễn phí Phí vận chuyển <a href="http://bitas.com.vn/news/detail/39/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></span>';
									}
								}
								// GIAYDEPKHAITRUONG1
								if($pro_code=='GIAYDEPKHAITRUONG1'){
									if($isChild){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
									}else{
										echo '0';
									}
								}
								// BEVUONTAMVOI
								if($pro_code=='BEVUONTAMVOI'){
									if($soluong_khongtinhhanggiamgia >= 3){
										echo number_format($saleoff,0,".",",");
									}else{
										echo '0';
									}
								}
								// QUOCKHANH2015
								if($pro_code=='QUOCKHANH2015'){
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
									}else{
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
									}
								}
								// TRUNGTHU2015
								if($pro_code=='TRUNGTHU2015'){
									if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
									}elseif($tongtien_khongtinhhanggiamgia > 200000){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
									}else{
										echo '0';
									}
								}
								// QUATANGYEUTHUONG
								if($pro_code=='QUATANGYEUTHUONG'){
									if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
									}else{
										echo '0';
									}
								}
								// TRIANNHAGIAO2015 | NOEL2015
								if($pro_code=='TRIANNHAGIAO2015' || $pro_code=='NOEL2015'){
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
									}else{
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
									}
								}
								// DONXUAN2016
								if($pro_code=='DONXUAN2016'){
									if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1 + 50000,0,".",",");
									}elseif($tongtien_khongtinhhanggiamgia >= 500000){
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1 + 100000,0,".",",");
									}else{
										echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
									}
								}
							}else{
								echo "0";
							}
						?>  
						<?php
							if(!($checkPA && $pro_code == 'HAPPYHOUR')){
						?>
						VND
						<?php }else{} ?>
                            
                    </p>
                </div>
                <div class="clear"></div>
                <div id="tongtien">
                	<p class="tongtien_l">Tạm tính</p>
                    <p class="tongtien_r">
						<?php
							if($checkPA){
								/* OPENNING 2014
								if($tongtien_khongtinhhanggiamgia>$promotion_price){
									$tongtien-=$reduceMoney;
								}
								*/
								/* BUYMOREGETMORE
								if($tongtien_promo){	
									echo number_format($tongtien_promo,0,".",",");
								}
								else{
									echo number_format($tongtien,0,".",",");
								}
								*/
								/* QUACHONANG080315
								$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
								echo number_format($tongtien_promotion,0,".",",");
								*/
								
								/* GIAM15
								$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
								echo number_format($tongtien_promotion,0,".",",");
								*/
								
								/* BANHANGTOANQUOC0415
								if($tongtien_khongtinhhanggiamgia>$promotion_price){
									$tongtien_promotion = $tongtien - $gttt;
									echo number_format($tongtien_promotion,0,".",",");
								}else{
									echo number_format($tongtien,0,".",",");
								}
								*/
								/* NGAYCUAME2015
								$tongtien_promotion = $tongtien - $tongtiengiam_promo;
								echo number_format($tongtien_promotion,0,".",",");
								*/
								/* QUOCTETHIEUNHI2015
								$tongtien_promotion = $tongtien - $tongtiengiam_promo;
								echo number_format($tongtien_promotion,0,".",",");
								*/
								/* SINHNHATCTY2015
								$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
								echo number_format($tongtien_promotion,0,".",",");
								*/
								//HAPPYHOUR
								if($pro_code=='HAPPYHOUR'){
									echo number_format($tongtien,0,".",",");
								}
								// GIAYDEPKHAITRUONG1
								if($pro_code=='GIAYDEPKHAITRUONG1'){
									if($isChild){
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										echo number_format($tongtien,0,".",",");
									}
								}
								// BEVUONTAMVOI
								if($pro_code=='BEVUONTAMVOI'){										
									if($soluong_khongtinhhanggiamgia >= 3){
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										echo number_format($tongtien,0,".",",");
									}
								}
								// QUOCKHANH2015
								if($pro_code=='QUOCKHANH2015'){										
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo number_format($tongtien_promotion,0,".",",");
									}
								}
								// TRUNGTHU2015
								if($pro_code=='TRUNGTHU2015'){										
									if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo number_format($tongtien_promotion,0,".",",");
									}elseif($tongtien_khongtinhhanggiamgia > 200000){
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										echo number_format($tongtien,0,".",",");
									}
								}
								// QUATANGYEUTHUONG
								if($pro_code=='QUATANGYEUTHUONG'){										
									if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										echo number_format($tongtien,0,".",",");
									}
								}
								// TRIANNHAGIAO2015 | NOEL2015
								if($pro_code=='TRIANNHAGIAO2015' || $pro_code=='NOEL2015'){										
									if($tongtien_khongtinhhanggiamgia >= $promotion_price){
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo number_format($tongtien_promotion,0,".",",");
									}
								}
								// DONXUAN2016
								if($pro_code=='DONXUAN2016'){										
									if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
										$tongtien_promotion = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 50000);
										echo number_format($tongtien_promotion,0,".",",");
									}elseif($tongtien_khongtinhhanggiamgia >= 500000){
										$tongtien_promotion = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 100000);
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo number_format($tongtien_promotion,0,".",",");
									}
								}
							}else{
								echo number_format($tongtien,0,".",",");
							}
						?> VND
                        
                   	</p>
                </div>
                <div class="clear"></div>
                <div class="tax">( Đã bao gồm thuế )</div>
            </div>
          </div>
          <div class="cart_nav">
        	<?php
			if(isset($_SESSION['idTTMS']))
				{	
				$idSP_ttms=$_SESSION['idTTMS'];
				unset($_SESSION['idTTMS']);
				$idlspgt_ttms=$i->LayChiTietLSPGTFromidSP($idSP_ttms);
				$row_ttms=mysql_fetch_assoc($idlspgt_ttms);
			?>
                <a href="san-pham/<?php echo $row_ttms['tenlspgt']?>/<?php echo $row_ttms['tenlspdsg']?>/" class="back">{Continue_Shopping}<span></span></a>
			<?php }else{?>
				<a href="home.bitas" class="back">{Continue_Shopping}<span></span></a>
			<?php }?>
            <a href="<?php if(!isset($_SESSION['id'])) echo 'gio-hang/dang-nhap-dang-ki/'; else echo 'gio-hang/thong-tin-khach-hang/' ;?>" class="next">{Process_Payment}<span>&nbsp;</span></a>
    	</div>
        <?php }?>
         <div class="clear"></div>
    </section><!--end_cart_detail-->
</div>