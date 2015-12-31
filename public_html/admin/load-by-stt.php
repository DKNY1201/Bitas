<?php
	require_once "../db/classAdmin.php";
	$i=new admin;
	$dvvc=$i->ListDVVC();
	$tt=$i->ListTinhThanh();
	$tt_dt=$i->ListTinhThanhDoiTra();
	if(isset($_GET['idDH'])&&$_GET['idDH']!='')
		$idDH=$_GET['idDH'];
?>
<style>
	.txt{
		width:100%;
		height:30px;
		border:1px solid #ccc;
		transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;
		padding:0 5pxs;
	}
	
	.load-table td{
		border:1px solid #ddd !important;
	}
</style>
<script>
	$(document).ready(function(e) {
        var listid = "";
		$("input[name='doi_check']").click(function(){
			if (this.checked) 
				listid = listid + "," + this.value;
			if(this.checked==false){
				var revVal=","+this.value;
				//console.log(revVal);
				listid = listid.replace(revVal,"");
			}
			//listid=listid.substr(1);
			//console.log(listid);
			$("input[name='doi_ctdh']").val(listid);
	   	});
		
		$("input[name='bh_check']").click(function(){
			if (this.checked) 
				listid = listid + "," + this.value;
			if(this.checked==false){
				var revVal=","+this.value;
				//console.log(revVal);
				listid = listid.replace(revVal,"");
			}
			//listid=listid.substr(1);
			//console.log(listid);
			$("input[name='bh_ctdh']").val(listid);
	   	});
		
		$(".xuatkho_nhomsp").change(function(e) {
			var idNSP=$(this).val();
            $(this).next(".size").load("load_size.php?idNSP="+idNSP);
        });
    });
</script>
<script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
<link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css">
<?php
	if(isset($_GET['idStt']))
		$idStt=$_GET['idStt'];
	switch($idStt){
		case 4:		
?>
		<input type="text" class="txt validate[required]" tabindex="1" placeholder="Mã phiếu xuất kho" name="xuatkho_ma">
<?php
		break;
		case 5:		
?>
		<input type="text" class="txt validate[required]" tabindex="0" placeholder="Mã vận đơn" name="dvvc_ma"><br /><br />
		<?php while($row_dvvc=mysql_fetch_assoc($dvvc)){?>
        <input type="radio" name="dvvc_dv" value="<?php echo $row_dvvc['idDVVC']?>" checked> <?php echo $row_dvvc['Ten']?>
        <?php }?>
<?php
		break;
		case 6:		
?>
		<input type="text" class="txt validate[required]" tabindex="0" placeholder="Lý do hoàn trả" name="hoantra_lydo">     
<?php 
		break;
		case 8:		
?>
		<input type="text" class="txt validate[required]" tabindex="0" placeholder="Thời gian giao hàng" name="hoantat_thoigian" id="ngaygiaohang">     
<?php 
		break;
		case 9:
?>
	<input type="text" class="txt validate[required]" tabindex="1" placeholder="Lý do hủy" name="huy_lydo">
<?php 
		break;
		case 10:
?>
	Hình thức:&nbsp; <input type="radio" name="doi_hinhthuc" value="0" checked="checked" /> Trực tiếp 
    <input type="radio" name="doi_hinhthuc" value="1" /> Bưu điện<br /><br />
    
    <select name="doi_noitiepnhan">
    	<?php while($row_tt=mysql_fetch_assoc($tt_dt)){?>
    	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
        <?php }?>
    </select><br /><br />
    
	<input type="text" class="txt validate[required]" tabindex="1" placeholder="Lý do đổi" name="doi_lydo"><br /><br />
    
    	<?php
        	$dhct=$i->DonHangChiTiet($idDH);
		?>
        <table id="table" width="100%" cellspacing="0" cellpadding="4" class="load-table">
            <thead>
              <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng cộng</th>
                <th>Khuyến mãi</th>
                <th>Thành tiền</th>
                <th>Đổi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $j=1;
              while($row_dhct=mysql_fetch_assoc($dhct)){
                  $idSP=$row_dhct['idSP'];
                  $sp=$i->ChiTietSP($idSP);
                  $row_sp=mysql_fetch_assoc($sp);
                  $idNSP=$row_sp['idNSP'];
                  $nsp=$i->ChiTietNhomSP($idNSP);
                  $row_nsp=mysql_fetch_assoc($nsp);
                  $idMau=$row_nsp['idMau'];
                  $mau=$i->ChiTietMau($idMau);
                  $row_mau=mysql_fetch_assoc($mau);
                  ob_start();
              ?>
              <tr>
                <td><?php echo $j?></td>
                <td>{SP}</td>
                <td>{Mau}</td>
                <td>{Size}</td>
                <td>{SL}</td>
                <td>{Gia} VNĐ</td>
                <td>{TongCong} VNĐ</td>
                <td>{KhuyenMai}%</td>
                <td>{ThanhTien} VNĐ</td>
                <td><input type="checkbox" name="doi_check" value="<?php echo $row_dhct['idDHCT']?>" /></td>
              </tr>
              <?php
                $str=ob_get_clean();
                $soluong=$row_dhct['SoLuong'];
                if($row_dhct['GiaChuaGiam']>$row_dhct['Gia'])
                    $gia=$row_dhct['GiaChuaGiam'];
                else $gia=$row_dhct['Gia'];
                $tongcong=$soluong*$gia;
                $giachuagiam=$row_dhct['GiaChuaGiam'];
                $khuyenmai=100-round(($row_dhct['Gia']/$giachuagiam)*100,2);
                $thanhtien=$tongcong*($row_dhct['Gia']/$giachuagiam);
                $tongtien+=$thanhtien;
                $str=str_replace("{SP}",$row_sp['Ten'],$str);
                $str=str_replace("{SL}",$soluong,$str);
                $str=str_replace("{Mau}",$row_mau['Ten_vn'],$str);
                $str=str_replace("{Size}",$row_sp['Size'],$str);
                $str=str_replace("{Gia}",number_format($gia,0,".",","),$str);
                $str=str_replace("{TongCong}",number_format($tongcong,0,".",","),$str);
                $str=str_replace("{KhuyenMai}",$khuyenmai,$str);
                $str=str_replace("{ThanhTien}",number_format($thanhtien,0,".",","),$str);
                $j++;
                echo $str;
              }
              ?>
              <input type="hidden" name="doi_ctdh" value=""/>
        </tbody>
    </table>
    
<?php 
		break;
		case 11:
?>
	<select name="nhapdoi_kho">
    	<?php 
			mysql_data_seek($tt_dt,0);
			while($row_tt=mysql_fetch_assoc($tt_dt)){
		?>
    	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
        <?php }?>
    </select>
<?php 
		break;
		case 12:
			$doi_num=$i->DemSoSPKHDoi($idDH);
			$nhomsp=$i->ListNSP();
?>
	<select name="xuatdoi_kho">
    	<?php 
			mysql_data_seek($tt_dt,0);
			while($row_tt=mysql_fetch_assoc($tt_dt)){
		?>
    	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
        <?php }?>
    </select><br /><br />
    
    <?php for($k=1;$k<=$doi_num;$k++){?>
 	<select name="xuatkho_nhomsp_<?php echo $k?>" class="xuatkho_nhomsp">
    	<option value="0">Chọn nhóm SP</option>
    	<?php
        	mysql_data_seek($nhomsp,0);
			while($row_nhomsp=mysql_fetch_assoc($nhomsp)){
				$idMau=$row_nhomsp['idMau'];
				$mau=$i->ChiTietMau($idMau);
				$row_mau=mysql_fetch_assoc($mau);
		?>
        	<option value="<?php echo $row_nhomsp['idNSP']?>"><?php echo $row_nhomsp['Ten']." - ".$row_mau['Ten_vn']?></option>
        <?php }?>
    </select>
    <select name="xuatkho_sp_<?php echo $k?>" class="size">
    	<option value="0">Chọn size</option>
    </select><br /><br />
    <input type="text" class="txt validate[required]" placeholder="Số lượng" name="xuatkho_soluong_<?php echo $k?>"><br /><br />
    <?php }?>
<?php 
		break;
		case 13:
?>
		<?php 
			mysql_data_seek($dvvc,0);
			while($row_dvvc=mysql_fetch_assoc($dvvc)){
		?>
        	<input type="radio" name="dvvc2_dv" value="<?php echo $row_dvvc['idDVVC']?>" checked> <?php echo $row_dvvc['Ten']?>
        <?php }?><br /><br />
        <input type="text" class="txt validate[required]" placeholder="Mã vận đơn" name="dvvc2_ma"><br /><br />
        <input type="text" class="txt validate[required]" placeholder="Chi phí" name="dvvc2_chiphi"><br /><br />
		Bên chịu:&nbsp; <input type="radio" name="dvvc2_benchiu" value="0" checked="checked" /> Khách hàng 
    	<input type="radio" name="dvvc2_benchiu" value="1" /> Công ty<br /><br />
<?php 
		break;
		case 14:
?>
		<select name="tra_kho">
    	<?php 
			mysql_data_seek($tt_dt,0);
			while($row_tt=mysql_fetch_assoc($tt_dt)){
		?>
    	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
        <?php }?>
    	</select><br /><br />
        
        <?php
        	$dhct=$i->DonHangChiTiet($idDH);
		?>
        <table id="table" width="100%" cellspacing="0" cellpadding="4" class="load-table">
            <thead>
              <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng cộng</th>
                <th>Khuyến mãi</th>
                <th>Thành tiền</th>
                <th>Trả</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $j=1;
              while($row_dhct=mysql_fetch_assoc($dhct)){
                  $idSP=$row_dhct['idSP'];
                  $sp=$i->ChiTietSP($idSP);
                  $row_sp=mysql_fetch_assoc($sp);
                  $idNSP=$row_sp['idNSP'];
                  $nsp=$i->ChiTietNhomSP($idNSP);
                  $row_nsp=mysql_fetch_assoc($nsp);
                  $idMau=$row_nsp['idMau'];
                  $mau=$i->ChiTietMau($idMau);
                  $row_mau=mysql_fetch_assoc($mau);
                  ob_start();
              ?>
              <tr>
                <td><?php echo $j?></td>
                <td>{SP}</td>
                <td>{Mau}</td>
                <td>{Size}</td>
                <td>{SL}</td>
                <td>{Gia} VNĐ</td>
                <td>{TongCong} VNĐ</td>
                <td>{KhuyenMai}%</td>
                <td>{ThanhTien} VNĐ</td>
                <td><input type="checkbox" name="doitra_check" value="<?php echo $row_dhct['idDHCT']?>" /></td>
              </tr>
              <?php
                $str=ob_get_clean();
                $soluong=$row_dhct['SoLuong'];
                if($row_dhct['GiaChuaGiam']>$row_dhct['Gia'])
                    $gia=$row_dhct['GiaChuaGiam'];
                else $gia=$row_dhct['Gia'];
                $tongcong=$soluong*$gia;
                $giachuagiam=$row_dhct['GiaChuaGiam'];
                $khuyenmai=100-round(($row_dhct['Gia']/$giachuagiam)*100,2);
                $thanhtien=$tongcong*($row_dhct['Gia']/$giachuagiam);
                $tongtien+=$thanhtien;
                $str=str_replace("{SP}",$row_sp['Ten'],$str);
                $str=str_replace("{SL}",$soluong,$str);
                $str=str_replace("{Mau}",$row_mau['Ten_vn'],$str);
                $str=str_replace("{Size}",$row_sp['Size'],$str);
                $str=str_replace("{Gia}",number_format($gia,0,".",","),$str);
                $str=str_replace("{TongCong}",number_format($tongcong,0,".",","),$str);
                $str=str_replace("{KhuyenMai}",$khuyenmai,$str);
                $str=str_replace("{ThanhTien}",number_format($thanhtien,0,".",","),$str);
                $j++;
                echo $str;
              }
              ?>
              <input type="hidden" name="doitra_ctdh" value=""/>
<?php 
		break;
		case 17:
?>
	Hình thức:&nbsp; <input type="radio" name="bh_hinhthuc" value="0" checked="checked" /> Trực tiếp 
    <input type="radio" name="bh_hinhthuc" value="1" /> Bưu điện<br /><br />
    
    <select name="bh_noitiepnhan">
    	<?php while($row_tt=mysql_fetch_assoc($tt_dt)){?>
    	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
        <?php }?>
    </select><br /><br />
    
	<input type="text" class="txt validate[required]" tabindex="1" placeholder="Lý do bảo hành" name="bh_lydo"><br /><br />
    <?php
        	$dhct=$i->DonHangChiTiet($idDH);
		?>
        <table id="table" width="100%" cellspacing="0" cellpadding="4" class="load-table">
            <thead>
              <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Tổng cộng</th>
                <th>Khuyến mãi</th>
                <th>Thành tiền</th>
                <th>Bảo hành</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $j=1;
              while($row_dhct=mysql_fetch_assoc($dhct)){
                  $idSP=$row_dhct['idSP'];
                  $sp=$i->ChiTietSP($idSP);
                  $row_sp=mysql_fetch_assoc($sp);
                  $idNSP=$row_sp['idNSP'];
                  $nsp=$i->ChiTietNhomSP($idNSP);
                  $row_nsp=mysql_fetch_assoc($nsp);
                  $idMau=$row_nsp['idMau'];
                  $mau=$i->ChiTietMau($idMau);
                  $row_mau=mysql_fetch_assoc($mau);
                  ob_start();
              ?>
              <tr>
                <td><?php echo $j?></td>
                <td>{SP}</td>
                <td>{Mau}</td>
                <td>{Size}</td>
                <td>{SL}</td>
                <td>{Gia} VNĐ</td>
                <td>{TongCong} VNĐ</td>
                <td>{KhuyenMai}%</td>
                <td>{ThanhTien} VNĐ</td>
                <td><input type="checkbox" name="bh_check" value="<?php echo $row_dhct['idDHCT']?>" /></td>
              </tr>
              <?php
                $str=ob_get_clean();
                $soluong=$row_dhct['SoLuong'];
                if($row_dhct['GiaChuaGiam']>$row_dhct['Gia'])
                    $gia=$row_dhct['GiaChuaGiam'];
                else $gia=$row_dhct['Gia'];
                $tongcong=$soluong*$gia;
                $giachuagiam=$row_dhct['GiaChuaGiam'];
                $khuyenmai=100-round(($row_dhct['Gia']/$giachuagiam)*100,2);
                $thanhtien=$tongcong*($row_dhct['Gia']/$giachuagiam);
                $tongtien+=$thanhtien;
                $str=str_replace("{SP}",$row_sp['Ten'],$str);
                $str=str_replace("{SL}",$soluong,$str);
                $str=str_replace("{Mau}",$row_mau['Ten_vn'],$str);
                $str=str_replace("{Size}",$row_sp['Size'],$str);
                $str=str_replace("{Gia}",number_format($gia,0,".",","),$str);
                $str=str_replace("{TongCong}",number_format($tongcong,0,".",","),$str);
                $str=str_replace("{KhuyenMai}",$khuyenmai,$str);
                $str=str_replace("{ThanhTien}",number_format($thanhtien,0,".",","),$str);
                $j++;
                echo $str;
              }
              ?>
              <input type="hidden" name="bh_ctdh" value=""/>
        </tbody>
    </table>
<?php 
		break;
		case 18:
?>
	<input type="text" class="txt validate[required]" placeholder="Chi phí bảo hành" name="bh_ok_chiphi"><br /><br />
    <select name="bh_ok_noibh">
    	<?php while($row_tt=mysql_fetch_assoc($tt_dt)){?>
    	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
        <?php }?>
    </select><br /><br /> 
<?php 
		break;
}?>