<div id="breadcrumb" style="">
	<ul>
    	<li><a href="home.bitas">{Home}</a></li>
        <?php
        	switch($p)
			{
				case "gioithieu": echo "<li>{About_Us}</li>";break;
				case "online_shopping": echo "<li>{Shopping}</li>";break;
				case "delivery_system": echo "<li>{Distribution}</li>";break;
				case "khuyenmai": echo "<li>{Promotion}</li>";break;
				case "tintuc": echo "<li>{News}</li>";break;
				case "tuyendung": echo "<li>{Recruitment}</li>";break;
				case "lienhe": echo "<li>{Contact}</li>";break;
				case "dangki": echo "<li>{Register} {Account}</li>";break;
				case "dangnhap": echo "<li>{Login}</li>";break;
				case "taikhoan": echo "<li>{Account}</li>";break;
				case "quenpass": echo "<li>{Forget_Pass}</li>";break;
				case "quenpass_doipass": echo "<li>Lấy lại mật khẩu</li>";break;
				case "doi_baohanh_map": echo "<li>{Return_Warranty_Location}</li>";break;
				case "hethongcuahangle": echo "<li>Hệ thống cửa hàng lẻ</li>";break;
				case "detail_news": 
				if(isset($_GET['idTin']))
					$idTin=$_GET['idTin'];
					$sql="SELECT tintuc.idLT as LoaiTin,Ten,idTin,TieuDe FROM tintuc,loaitin WHERE idTin=$idTin AND loaitin.idLT=tintuc.idLT";
					$kq=mysql_query($sql) or die(mysql_error());
					$row_kq=mysql_fetch_assoc($kq);
				echo "<li><a href='cat/bao-chi-truyen-thong/'>$row_kq[Ten]</a></li>"."<li>$row_kq[TieuDe]</li>";
				break;
				case "detail_km":
					$idKM=$_GET['idKM'];
					$sql="SELECT * FROM khuyenmai WHERE idKM=$idKM";
					$kq=mysql_query($sql) or die(mysql_error());
					$row_kq=mysql_fetch_assoc($kq);
					echo "<li><a href='cat/khuyen-mai/'>Khuyến mãi</a></li>"."<li>$row_kq[Ten]</li>";
					break;
				case "chinhsach_baomat": echo "<li>{Privacy_Policy}</li>";break;
				case "chinhsach_hotrovanchuyen": echo "<li>Chính sách hỗ trợ vận chuyển</li>";break;
				case "chinhsach_doihang": echo "<li>Chính sách đổi hàng</li>";break;
				case "chinhsach_baohanh": echo "<li>Chính sách bảo hành</li>";break;
				case "chinhsach_huydonhang": echo "<li>Chính sách hủy đơn hàng</li>";break;
				case "huongdan_muahang": echo "<li>Hướng dẫn mua hàng</li>";break;
				case "huongdan_thanhtoan": echo "<li>Hướng dẫn thanh toán</li>";break;
				case "huongdan_chonsize": echo "<li>Hướng dẫn chọn size</li>";break;
				case "baochitruyenthong": echo "<li>Báo chí & truyền thông</li>";break;
				case "faq": echo "<li>Hỏi đáp</li>";break;
				case "dieukhoansudung": echo "<li>Điều khoản sử dụng</li>";break;
				//case "quayso": echo "<li>Quay số trúng thưởng</li>";break;
			}
		?>
    </ul>
</div>