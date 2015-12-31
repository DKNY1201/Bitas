<?php $u=$i->ChiTietUser($_SESSION['email']);
	$row_u=mysql_fetch_assoc($u);
	$idKH=$row_u['idUser'];
	$dh=$i->LayDonHangTheoUser($idKH);
?>
<h1 class="title page_title">{Order_History}</h1>
<div class="table-responsive">
    <table id="donhang" border="0" width="100%" cellpadding="4" cellspacing="0" class="table">
        <tr>
            <th class="order">{Order} #</th>
            <th class="date">{Date}</th>
            <th class="delivery">{Delivery_Address}</th>
            <th class="status">{Status}</th>
            <th class="value">{Order_Value}</th>
            <th class="rest"></th>
        </tr>
        <?php while($row_dh=mysql_fetch_assoc($dh)) {
            $idDH=$row_dh['idDH'];
            $idTinh=$row_dh['idTinh'];
            $tt=$i->ChiTietTinhThanh($idTinh);
            $row_tt=mysql_fetch_assoc($tt);
            $idQH=$row_dh['idQuanHuyen'];
            $qh=$i->ChiTietQuanHuyen($idQH);
            $row_qh=mysql_fetch_assoc($qh);
            $idPX=$row_dh['idPhuong'];
            $px=$i->ChiTietPhuong($idPX);
            $row_px=mysql_fetch_assoc($px);
            $tongtien=$i->TongGiaTriDonHang($idDH,$idTinh,$idQH,$row_dh['idPTTT']);
        ?>
            <tr>
                <td><?php echo $row_dh['MaDH']?></td>
                <td><?php echo date("d/m/Y H:i:s",strtotime($row_dh['NgayDH']))?></td>
                <td><?php echo $row_dh['DiaChi']?>, <?php echo $row_px['type']." ".$row_px['Ten']?>, <?php echo $row_qh['type']." ".$row_qh['Ten']?>, <?php echo $row_tt['Ten']?></td>
                <td>
                    <?php $idTT=$row_dh['idTT'];
                        if($idTT==8)
                            echo "Đã giao";
                        elseif($idTT==9)
                            echo "Đã hủy";
                        else
                            echo "Đang giao";
                    ?>
                </td>
                <td><?php echo $tongtien?> VND</td>
                <td><a href="user/don-hang-chi-tiet/<?php echo $idDH?>/" class="btn">{Detail}</a></td>
            </tr>
        <?php }?>
    </table>
</div>