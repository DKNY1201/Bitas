<?php /*
	session_start();
	$idKH=$_SESSION['id'];
	
	$listID=implode(",",$_SESSION['idPro']);

	$sql="SELECT idSP,Gia_vn,GiaChuaGiam_vn,nhomsp.Ten as TenSP,mau.Ten_vn as Mau,Size FROM sanpham,nhomsp,mau WHERE sanpham.idNSP=nhomsp.idNSP AND nhomsp.idMau=mau.idMau AND idSP in ($listID)";

	$sp=mysql_query($sql) or die(mysql_error());

	*/

	require_once "../../db/db.php";

	$ii=new db;

	$sql="SELECT MAX(idDH) as idDH FROM donhang";
	$dh=mysql_query($sql) or die(mysql_error());

	$row_dh=mysql_fetch_assoc($dh);

	$idDH=$row_dh['idDH'];

	$sql="SELECT * FROM donhang WHERE idDH=$idDH";

	$dh=mysql_query($sql) or die(mysql_error());

	$row_dh=mysql_fetch_assoc($dh);

	$idTinh=$row_dh['idTinh'];

	$idQH=$row_dh['idQuanHuyen'];

	$idPhuong=$row_dh['idPhuong'];

	$sql="SELECT * FROM tinhthanh WHERE idTinh=$idTinh";

	$tinh=mysql_query($sql) or die(mysql_error());

	$row_tinh=mysql_fetch_assoc($tinh);

	$sql="SELECT * FROM quanhuyen WHERE idQuanHuyen=$idQH";

	$qh=mysql_query($sql) or die(mysql_error());

	$row_qh=mysql_fetch_assoc($qh);

	$sql="SELECT * FROM phuong WHERE idPhuong=$idPhuong";

	$phuong=mysql_query($sql) or die(mysql_error());

	$row_phuong=mysql_fetch_assoc($phuong);

	$idKH=$row_dh['idKH'];

	$sql="SELECT HoTen FROM user WHERE idUser=$idKH";

	$kh=mysql_query($sql) or die(mysql_error());

	$row_kh=mysql_fetch_assoc($kh);

?>

<table align="center" style="width:700px; padding:0; margin:0 auto; border:0;font-family:Arial,Helvetica,sans-serif;color:#414042;font-size:12px;" cellpadding="0" cellspacing="0">

	<tbody>

    	<tr>

        	<td>

            	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">

                	<tr style="vertical-align:top;text-align:left;padding:0;background:#ec1c24;height:52px;">

                    	<td>

                        	<a href="http://www.bita's.com.vn" title="Bitas Online" style="text-decoration:none;display:block;margin:10px 0 0 60px" target="_blank"><img alt="Bita's Online" src="http://bitas.com.vn/email/img/logo.png" style="outline:none;text-decoration:none;width:auto;max-width:100%;float:left;clear:both;display:block;border:none" align="left"></a>

                        </td>

                    </tr>

                </table>

            </td>

        </tr><!-- end header -->

        <tr style="height:30px;">

            <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top;text-align:left;width:0px;font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:12px;margin:0;padding:0;border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

        	<td style="border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;">
            	<table style="width:600px;margin:0 auto;padding:0;font-size:11px" cellspacing="0" cellpadding="4">

                	<tr>

                    	<td style="color:#6d6e71;font-size:20px">THÔNG BÁO ĐẶT HÀNG THÀNH CÔNG</td>

                    </tr>

                    <tr>

                    	<td>Xin chào, <?php echo $row_kh['HoTen']?></td>

                    </tr>

                    <tr>

                        <td>Cảm ơn Quý khách đã dành thời gian mua sắm tại <a href="http://www.bitas.com.vn" style="color:#000;">www.bitas.com.vn</a></td>

                    </tr>

                    <tr>

						<td style="line-height:1.6em">Đơn hàng của Quý khách đã được ghi nhận, nhân viên chăm sóc khách hàng của chúng tôi sẽ sớm liên lạc với Quý khách để xác nhận đơn hàng. Quý khách vui lòng kiểm tra lại thông tin đơn hàng đã đặt của mình như sau:</td>

                    </tr>

                </table>

            </td>

        </tr>

        <tr style="height:30px;">

            <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top;text-align:left;width:0px;font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:12px;margin:0;padding:0;border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

        	<td style="border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;">

            	<table style="width:600px;margin:0 auto;padding:0;font-size:11px;" cellspacing="0" cellpadding="4">

                	<thead>

                    	<th style="background:#6d6e71; text-align:left; color:#fff; height:25px;">THÔNG TIN ĐƠN HÀNG</th>

                    </thead>

           			<tbody style="border:1px solid #ccc; display:block">

                    	<tr>

                        	<td>Mã đơn hàng: <?php echo $row_dh['MaDH']?></td>

                        </tr>

                        <tr>

                        	<td>Người mua: <?php echo $row_dh['MaDH']?></td>

                        </tr>

                        <tr>

                        	<td>Người nhận: <?php echo $row_dh['NguoiNhan']?></td>

                        </tr>

                        <tr>

                        	<td>ĐT: <?php echo $row_dh['DienThoai']?></td>

                        </tr>

                        <tr>

                        	<td>Địa chỉ giao hàng: <?php echo $row_dh['DiaChi']?>,  <?php echo $row_phuong['type']." ".$row_phuong['Ten']?>, <?php echo $row_qh['type']." ".$row_qh['Ten']?>, <?php echo $row_tinh['Ten']?></td>

                        </tr>

                    </tbody>

                </table>

            </td>

        </tr>

        <tr style="height:10px;">

            <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top;text-align:left;width:0px;font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:12px;margin:0;padding:0;border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

        	<td style="border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;">

            	<table style="width:600px;margin:0 auto;padding:0;font-size:11px; text-align:center" cellspacing="0" cellpadding="4">

                	<tbody>

                    	<tr height="25px">

                        	<td style="border:1px solid #ccc;">Sản phẩm</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Màu</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Size</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Số lượng</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Đơn giá</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Tổng cộng</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Khuyến mãi</td>

                            <td style="border:1px solid #ccc; border-left:0px none">Thành tiền</td>

                        </tr>

                        <?php

							$subTotal=0;

							$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";

							$dhct=mysql_query($sql) or die(mysql_error());

							while($row_dhct=mysql_fetch_assoc($dhct)){

								$idsp=$row_dhct['idSP'];

								$sql="SELECT nhomsp.Ten as TenNSP,mau.Ten_vn as Mau,Size FROM sanpham,nhomsp,mau WHERE sanpham.idNSP=nhomsp.idNSP AND nhomsp.idMau=mau.idMau AND idSP=$idsp";

								$sp=mysql_query($sql) or die(mysql_error());

								$row_sp=mysql_fetch_assoc($sp);

								$soluong=$row_dhct['SoLuong'];

								$tensp=$row_sp['TenNSP'];

								$mau=$row_sp['Mau'];

								$size=$row_sp['Size'];

								$dongia=$row_dhct['Gia'];

								$giachuagiam=$row_dhct['GiaChuaGiam'];

								$tongcong=$soluong*$dongia;

								$tongcong_km=$soluong*$giachuagiam;

								$khuyenmai=$tongcong-$tongcong_km;

								$subTotal+=$tongcong_km;

								$phivc=$ii->ChiPhiVanChuyen($subTotal,$idQH);

								$subTotal_vc=$subTotal+$phivc;

								$pttt=$row_dh['idPTTT'];

								$phidv=$ii->PhiDichVu($subTotal_vc,$pttt);

								$total=$subTotal_vc+$phidv;

						?>

                        <tr>

                        	<td style="border:1px solid #ccc; border-top:0px none;"><?php echo $tensp?></td>

                            <td style="border:1px solid #ccc; border-left:0px none; border-top:0px none;"><?php echo $mau?></td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none; "><?php echo $size?></td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo $soluong?></td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($dongia,0,".",",");?> VND</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($tongcong,0,".",",")?> VND</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($khuyenmai,0,".",",")?> VND</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($tongcong_km,0,".",",")?> VND</td>

                        </tr>

                        

                        <?php }

						?>

                        <tr height="25px">

                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Tổng tiền sản phẩm</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($subTotal,0,".",",")?></td>

                        </tr>

                        <tr height="25px">

                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Phí vận chuyển</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($phivc,0,".",",")?></td>

                        </tr>

                        <tr height="25px">

                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Phí dịch vụ</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($phidv,0,".",",")?></td>

                        </tr>

                        <tr height="25px">

                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Tổng tiền thanh toán</td>

                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;"><?php echo number_format($total,0,".",",")?></td>

                        </tr>

                        <tr>

                        	<td colspan="8" style="border:1px solid #ccc;border-top:0px none; text-align:left; color:#890b14; font-style:italic;">Ghi chú: <?php echo $row_dh['GhiChu_KH']?></td>

                        </tr>

                    </tbody>

                </table>

            </td>

        </tr>

        <tr style="height:15px;">

            <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top;text-align:left;width:0px;font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:12px;margin:0;padding:0;border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

        	<td style="border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;">

            	<table style="width:600px;margin:0 auto;padding:0;font-size:11px; text-align:left" cellspacing="0" cellpadding="4">

                	<tbody>

                    	<tr>

                        	<td>Nếu Quý khách có bất cứ thắc mắc hoặc nhu cầu cần hỗ trợ xin vui lòng gọi chúng tôi qua số hotline:</td>

                        </tr>

                        <tr>

                        	<td><strong>(08) 37 54 39 54</strong> hoặc qua email: <strong>info@bitas.com.vn</strong> chúng tôi sẽ hồi đáp ngay.</td>

                        </tr>

                        <tr>

                        	<td>Bitas.com.vn hân hạnh được phục vụ Quý khách!</td>

                        </tr>

                    </tbody>

                </table>

            </td>

        </tr>

        <tr style="height:30px;">

            <td style="word-break:break-word;border-collapse:collapse!important;vertical-align:top;text-align:left;width:0px;font-family:Arial,Helvetica,sans-serif;color:#000000;font-size:12px;margin:0;padding:0;border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

        	<td style="border-left:1px solid #E5E5E5; border-right:1px solid #E5E5E5;">

            	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">

                	<tr>

                    	<td width="25%">

                        	<a href="http://www.bitas.com.vn" style="display:block;" target="_blank"><img alt="Bita's Online" src="http://bitas.com.vn/email/img/product-1.jpg" style="outline:none;text-decoration:none;border:none; margin-left:50px;"></a>

                         </td>

                         <td width="25%">

                        	<a href="http://www.bitas.com.vn" style="display:block;" target="_blank"><img alt="Bita's Online" src="http://bitas.com.vn/email/img/product-2.jpg" style="outline:none;text-decoration:none;border:none; margin-left:12px;"></a>

                         </td>

                         <td width="25%">

                        	<a href="http://www.bitas.com.vn" style="display:block;" target="_blank"><img alt="Bita's Online" src="http://bitas.com.vn/email/img/product-3.jpg" style="outline:none;text-decoration:none;border:none; margin-left:4px;"></a>

                         </td>

                         <td width="25%">

                        	<a href="http://www.bitas.com.vn" style="display:block;" target="_blank"><img alt="Bita's Online" src="http://bitas.com.vn/email/img/product-4.jpg" style="outline:none;text-decoration:none;border:none; margin-right:50px;"></a>

                         </td>

                    </tr>

                </table>

            </td>

        </tr><!-- end 4 product -->
        <tr>

        	<td background="http://bitas.com.vn/email/img/content-3.jpg" width="100%" height="246px">

            	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">

                	<tr>

                    	<td style="width:500px">&nbsp;</td>

                        <td>

                        	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">

                            	<tr height="155px">

                                	<td colspan="4">&nbsp;</td>

                                </tr>

                                <tr>

                                	<td width="37px"><a href="https://bitas.com.vn" style="display:block;"><img src="http://bitas.com.vn/email/img/icon-fb.png"></a></td>

                                    <td width="37px"><a href="https://bitas.com.vn" style="display:block;"><img style="margin-right:5px" src="http://bitas.com.vn/email/img/icon-tw.png"></a></td>

                                    <td width="37px"><a href="https://bitas.com.vn" style="display:block;"><img style="margin-right:5px" src="http://bitas.com.vn/email/img/icon-gg.png"></a></td>

                                    <td width="37px"><a href="https://bitas.com.vn" style="display:block;"><img style="margin-right:5px" src="http://bitas.com.vn/email/img/icon-youtube.png"></a></td>

                                    <td>&nbsp;</td>

                                </tr>

                            </table>

                        </td>

                    </tr>

                </table>

            </td>

        </tr><!-- end footer -->

    </tbody>

</table>