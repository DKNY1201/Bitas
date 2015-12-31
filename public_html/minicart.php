<div id="header_cart_button" class="box_size">
    <a href="gio-hang/tong-quan/" class="cart_cover">
        <div id="num_in_cart"></div>
        <p class="cart_text box_size">Giỏ hàng</p>
    </a>
    <div id="cart_sum" class="box_size">
    <?php 
    //echo $lang; exit();
        if(count($_SESSION['idPro'])<=0){
            echo "{non_num_in_cart}";
        }
        else{
            $tongsl=0;
            $listID=implode(',',$_SESSION['idPro']);
            $sql="SELECT idSP,sanpham.Ten as Ten,Gia_vn,Hinh,Size,mau.Ten_vn as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
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
    ?>
        <div class="cart_sum_item">
            <img src="<?php echo $hinh?>" alt="<?php echo $tensp?>" title="<?php echo $tensp?>" />
            <div class="cart_sum_item_info box_size">
                <h4><?php echo $tensp?></h4>
                <p>Màu: <span class="f_right"><?php echo $mau?></span></p>
                <p>Cỡ số: <span class="f_right"><?php echo $size?></span></p>
                <p>Số lượng: <span class="f_right"><?php echo $soluong?></span></p>
                <p>Giá: <span class="f_right"><?php echo number_format($dongia,0,",",".")?> VND</span></p>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="clear"></div>
    <div id="cart_sum_button">
        <a id="xemgiohang_btn" class="cart_btn see_cart" href="gio-hang/tong-quan/">Xem giỏ hàng</a>
        <a id="thanhtoan_btn" class="cart_btn" href="<?php if(!isset($_SESSION['id'])) echo 'gio-hang/dang-nhap-dang-ki/'; else echo 'gio-hang/thong-tin-khach-hang/'?>">Thanh toán</a>
    </div>
    <?php }?>
    </div><!--end_cart_sum-->
    <input type="hidden" value="<?php echo (isset($tongsl))?$tongsl:0?>" id="tongsl" />
</div><!--end_header_cart_button-->