<?php require_once "../db/db.php";
	class admin extends db{
//====== INFO =====//
		function updateInfo(&$error){
			$success=true;
			$companyName=$_POST['companyName'];
			$address=$_POST['address'];
			$hotline=$_POST['hotline'];
			$phone=$_POST['phone'];
			$fax=$_POST['fax'];
			$email=$_POST['email'];
			$fb=$_POST['fb'];
			$youtube=$_POST['youtube'];
			$gg=$_POST['gg'];
			$pagetitle=$_POST['pagetitle'];
			$pagedesc=$_POST['pagedesc'];
			$pagekeyword=$_POST['pagekeyword'];

			$companyName=trim(strip_tags($companyName));
			$address=trim(strip_tags($address));
			$hotline=trim(strip_tags($hotline));
			$phone=trim(strip_tags($phone));
			$fax=trim(strip_tags($fax));
			$email=trim(strip_tags($email));
			$fb=trim(strip_tags($fb));
			$youtube=trim(strip_tags($youtube));
			$gg=trim(strip_tags($gg));
			$pagetitle=trim(strip_tags($pagetitle));
			$pagedesc=trim(strip_tags($pagedesc));
			$pagekeyword=trim(strip_tags($pagekeyword));
			if(get_magic_quotes_gpc()==false){
				$companyName=mysql_real_escape_string($companyName);
				$address=mysql_real_escape_string($address);
				$hotline=mysql_real_escape_string($hotline);
				$phone=mysql_real_escape_string($phone);
				$fax=mysql_real_escape_string($fax);
				$email=mysql_real_escape_string($email);
				$fb=mysql_real_escape_string($fb);
				$youtube=mysql_real_escape_string($youtube);
				$gg=mysql_real_escape_string($gg);
				$pagetitle=mysql_real_escape_string($pagetitle);
				$pagedesc=mysql_real_escape_string($pagedesc);
				$pagekeyword=mysql_real_escape_string($pagekeyword);
			}
			if($companyName==""){
				$success=false;
				$error['companyName']="Tên công ty không được để trống";
			}
			if($address==""){
				$success=false;
				$error['address']="Địa chỉ không được để trống";
			}
			if($hotline==""){
				$success=false;
				$error['hotline']="Hotline không được để trống";
			}
			if($phone==""){
				$success=false;
				$error['phone']="Số điện thoại không được để trống";
			}
			if($fax==""){
				$success=false;
				$error['fax']="Số Fax không được để trống";
			}
			if($email==""){
				$success=false;
				$error['email']="Địa chỉ email không được để trống";
			}
			elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$success=false;
			  	$error['email'] = "Địa chỉ email không hợp lệ";
			}
			if($fb==""){
				$success=false;
				$error['fb']="Facebook không được để trống";
			}
			if($youtube==""){
				$success=false;
				$error['youtube']="Youtube không được để trống";
			}
			if($gg==""){
				$success=false;
				$error['gg']="Google Plus không được để trống";
			}
			if($pagetitle==""){
				$success=false;
				$error['pagetitle']="Page title không được để trống";
			}
			if($pagedesc==""){
				$success=false;
				$error['pagedesc']="Page description không được để trống";
			}
			if($pagekeyword==""){
				$success=false;
				$error['pagekeyword']="Page keyword không được để trống";
			}
			if($success){
				$sql="UPDATE info SET companyName='$companyName',address='$address',hotline='$hotline',phone='$phone',fax='$fax',email='$email',fb='$fb',youtube='$youtube',gg='$gg',pagetitle='$pagetitle',pagedesc='$pagedesc',pagekeyword='$pagekeyword' WHERE idInfo=1";
				mysql_query($sql) or die(mysql_error());
			}
			return $success;
		}
//====== END INFO =====//
//====== NGÔN NGỮ =====//
		function ListNgonNgu(){
			$sql="SELECT * FROM ngonngu WHERE AnHien=1 ORDER BY ThuTu ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietNgonNgu($le){
			$sql="SELECT * FROM ngonngu WHERE Ma='$le' AND AnHien=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
//====== MÀU SẮC =====//
		function ListColor(){
			$sql="SELECT * FROM mau ORDER BY Ten_vn ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietMau($idMau){
			$sql="SELECT * FROM mau WHERE idMau=$idMau";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ThemColor(){
			$mamau=$_POST['mamau'];
			$tenmau=$_POST['tenmau'];
			$ten_vn=$_POST['ten_vn'];
			$ten_en=$_POST['ten_en'];
			$sql="INSERT INTO mau (MaMau,TenMau,Ten_vn,Ten_en) VALUES ('$mamau','$tenmau','$ten_vn','$ten_en')";
			mysql_query($sql) or die(mysql_error());
		}
		function SuaColor($idCL){
			$mamau=$_POST['mamau'];
			$tenmau=$_POST['tenmau'];
			$ten_vn=$_POST['ten_vn'];
			$ten_en=$_POST['ten_en'];
			$sql="UPDATE mau SET MaMau='$mamau',TenMau='$tenmau',Ten_vn='$ten_vn',Ten_en='$ten_en' WHERE idMau=$idCL";
			mysql_query($sql) or die(mysql_error());
		}
		function XoaColor($idCL){
			$sql="DELETE FROM mau WHERE idMau=$idCL";
			mysql_query($sql) or die(mysql_error());
		}
//====== TỈ GIÁ =====//		
		function ChiTietTiGia($idTG){
			$sql="SELECT * FROM TiGia WHERE idTG=$idTG AND AnHien=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
//====== TÌNH TRẠNG GIAO HÀNG =====//
		function ChiTietTinhTrang($idTT){
			$sql="SELECT idTT,Ten FROM tinhtrang WHERE idTT=$idTT AND AnHien=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListTinhTrang(){
			$sql="SELECT idTT,Ten FROM tinhtrang WHERE AnHien=1 ORDER BY ThuTu ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
//====== ĐƠN HÀNG =====//
		function ListDonHang(){
			$sql="SELECT * FROM donhang ORDER BY idDH DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function CountOrders(){
			$sql = "SELECT count(*) as totalOrder FROM donhang";
			$re = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($re);
			$totalOrder = $row['totalOrder'];
			return $totalOrder;
		}
		function CountOrderByStatus($idTT){
			$sql = "SELECT count(*) as TotalOrder FROM donhang WHERE idTT = $idTT";
			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			return $row['TotalOrder'];
		}
		function ListOrder($orderBy, $direction, $start, $limit){
			$sql="SELECT * FROM donhang ORDER BY $orderBy $direction LIMIT $start,$limit";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListOrderByStatus($orderBy, $direction, $start, $limit, $idStt){
			$sql="SELECT * FROM donhang WHERE idTT = $idStt ORDER BY $orderBy $direction LIMIT $start,$limit";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function SearchOrderCount($keyword){
			$sql = "SELECT count(*) as SearchCount FROM donhang WHERE idDH LIKE '%$keyword%' OR MaDH LIKE '%$keyword%' OR NguoiNhan LIKE '%$keyword%'";
			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			return $result['SearchCount'];
		}
		function SearchOrderCountByStatus($keyword, $idStt){
			$sql = "SELECT count(*) as SearchCount FROM donhang WHERE (idTT = $idStt) AND (idDH LIKE '%$keyword%' OR MaDH LIKE '%$keyword%' OR NguoiNhan LIKE '%$keyword%')";
			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			return $result['SearchCount'];
		}
		function SearchOrder($keyword, $orderBy, $direction, $start, $limit){
			$sql = "SELECT * FROM donhang WHERE idDH LIKE '%$keyword%' OR MaDH LIKE '%$keyword%' OR NguoiNhan LIKE '%$keyword%' ORDER BY $orderBy $direction LIMIT $start, $limit";
			$result = mysql_query($sql) or die(mysql_error());
			return $result;
		}
		function SearchOrderByStatus($keyword, $orderBy, $direction, $start, $limit, $idStt){
			$sql = "SELECT * FROM donhang WHERE (idTT = $idStt) AND (idDH LIKE '%$keyword%' OR MaDH LIKE '%$keyword%' OR NguoiNhan LIKE '%$keyword%') ORDER BY $orderBy $direction LIMIT $start, $limit";
			$result = mysql_query($sql) or die(mysql_error());
			return $result;
		}
		function OrderQuantity($orderID){
			$dhct=$this->DonHangChiTiet($orderID);
			$quantityTotal = 0;
			while($row_dhct=mysql_fetch_assoc($dhct)){
				$quantity = $row_dhct['SoLuong'];
				$quantityTotal += $quantity;
			}
			return $quantityTotal;
		}
		function ListOrderRecentByDay($number){
			settype($number, "int");
			$sql = "SELECT NgayDH,count(idDH) as orderQuantity FROM donhang WHERE DATEDIFF(NOW(),NgayDH)<=$number GROUP BY DATE(NgayDH) ORDER BY DATE(NgayDH) DESC";
			$result = mysql_query($sql) or die(mysql_error());
			return $result;
		}
		function ListDonHangDoiTra(){
			$sql="SELECT * FROM donhang WHERE AnHien=1 AND ((HoanTat_Ngay!='' AND (DATEDIFF(NOW(),HoanTat_Ngay))<=7) OR Doi_Ngay IS NOT NULL) AND BH_Ngay IS NULL ORDER BY idDH DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListDonHangBaoHanh(){
			$sql="SELECT * FROM donhang WHERE AnHien=1 AND ((HoanTat_Ngay!='' AND (DATEDIFF(NOW(),HoanTat_Ngay))<=60) OR BH_Ngay IS NOT NULL) ORDER BY idDH DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListDonHangTheoUser($idUser){
			$sql="SELECT * FROM donhang WHERE AnHien=1 AND idKH=$idUser ORDER BY idDH DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietDonHang($idDH){
			$sql="SELECT * FROM donhang WHERE idDH=$idDH";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function DonHangChiTiet($idDH){
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietDonHangChiTiet($idDHCT){
			$sql="SELECT * FROM donhangchitiet WHERE idDHCT=$idDHCT";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function AddDHCT($idDH){
			$idSP = $_POST['idSP'];
			$soluong = $_POST['soluong'];
			settype($idSP,"int");
			settype($soluong,"int");
			settype($idDH,"int");
			$sp = $this->ChiTietSP($idSP);
			$row_sp = mysql_fetch_assoc($sp);
			$gia = $row_sp['Gia_vn'];
			$giachuagiam = $row_sp['GiaChuaGiam_vn'];
			$sql = "INSERT INTO donhangchitiet (idDH,idSP,SoLuong,Gia,GiaChuaGiam) VALUES ($idDH,$idSP,$soluong,$gia,$giachuagiam)";
			mysql_query($sql) or die(mysql_error());
			$this->UpdateTong($idDH);
		}
		function EditDHCT($idDHCT){
			$idSP = $_POST['idSP'];
			$soluong = $_POST['soluong'];
			settype($idSP,"int");
			settype($soluong,"int");
			$sp = $this->ChiTietSP($idSP);
			$row_sp = mysql_fetch_assoc($sp);
			$gia = $row_sp['Gia_vn'];
			$giachuagiam = $row_sp['GiaChuaGiam_vn'];
			$sql = "UPDATE donhangchitiet SET idSP=$idSP,SoLuong=$soluong,Gia=$gia,GiaChuaGiam=$giachuagiam WHERE idDHCT=$idDHCT";
			mysql_query($sql) or die(mysql_error());
			
			$sql = "SELECT idDH FROM donhangchitiet WHERE idDHCT=$idDHCT";
			$dh = mysql_query($sql) or die(mysql_error());
			$row_dh = mysql_fetch_assoc($dh);
			$idDH = $row_dh['idDH'];
			$this->UpdateTong($idDH);
		}
		function DelDHCT($idDHCT){
			$sql = "SELECT idDH FROM donhangchitiet WHERE idDHCT=$idDHCT";
			$dh = mysql_query($sql) or die(mysql_error());
			$row_dh = mysql_fetch_assoc($dh);
			$idDH = $row_dh['idDH'];
			
			$sql = "DELETE FROM donhangchitiet WHERE idDHCT=$idDHCT";
			mysql_query($sql) or die(mysql_error());
			
			$this->UpdateTong($idDH);
		}
		function DonHangChiTiet_Doi($idDH){
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH AND Doi=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function DonHangChiTiet_BaoHanh($idDH){
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH AND BaoHanh=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function DonHangChiTiet_DoiTra($idDH){
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH AND DoiTra=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function LayEmailTheoID($idUs){
			$sql="SELECT Email FROM user WHERE idUser=$idUs";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function CapNhatTinhTrang($idDH){
			$idTT=$_POST['tinhtrang'];
			settype($idTT,"int");
			//date_default_timezone_set('Asia/Ho_Chi_Minh');
			//$ngaygh=date("Y-m-d H:i:s",strtotime("now"));
			$sql="UPDATE donhang SET idTT=$idTT, NgayGiaoHang=NOW() WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function LayIdKhuVucTuIdUser($iduser){
			$sql="SELECT khuvuc.idKV as idKV FROM khuvuc,tinhthanh,user WHERE user.idUser=$iduser AND user.idTinh=tinhthanh.idTinh AND tinhthanh.idKV=khuvuc.idKV";
			$kq=mysql_query($sql) or die(mysql_error());
			$row_kq=mysql_fetch_assoc($kq);
			return $row_kq['idKV'];
		}
		function LayDonHangTheoKhuVucVaCap($idKV){
			$sql="SELECT * FROM donhang WHERE idTinh IN (SELECT idTinh FROM tinhthanh WHERE tinhthanh.idKV=$idKV) ORDER BY idDH DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function GiamSoLuongSP($idSP,$soluong){
			$sql="UPDATE sanpham SET SoLuongTonKho=SoLuongTonKho-$soluong WHERE idSP=$idSP";
			mysql_query($sql) or die(mysql_error());
		}
		function TangSoLanMua($idSP,$soluong){
			$sql="UPDATE sanpham SET SoLanMua=SoLanMua+$soluong WHERE idSP=$idSP";
			mysql_query($sql) or die(mysql_error());
		}
		function TongGiaTriDH($idDH){
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
			$kq=mysql_query($sql) or die(mysql_error());
			$tong=0;
			$thanhtien=0;
			while($row_kq=mysql_fetch_assoc($kq)){
				$thanhtien=$row_kq['SoLuong']*$row_kq['Gia'];
				$tong+=$thanhtien;
			}
			return $tong;
		}
		function ChiTietPTTT($idPTTT){
			$sql="SELECT * FROM pttt WHERE idPTTT=$idPTTT";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietDVVC($idDVVC){
			$sql="SELECT * FROM dvvc WHERE idDVVC=$idDVVC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListDVVC(){
			$sql="SELECT * FROM dvvc WHERE AnHien=1 ORDER BY idDVVC ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function CapNhatUuTien($idDH){
			$isUT=$_POST['uutien'];
			$lydo=$_POST['uutien-lydo'];
			if($isUT=='on')
				$idUT=1;
			else{
				$idUT=0;
				$lydo='';
			}
			trim(strip_tags($lydo));
			if(get_magic_quotes_gpc()==false){
				$lydo=mysql_real_escape_string($lydo);
			}
			$sql="UPDATE donhang SET isUuTien=$idUT, UuTien='$lydo' WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function CapNhatGap($idDH){
			$isGap=$_POST['gap'];
			$lydo=$_POST['gap-lydo'];
			if($isGap=='on')
				$idGap=1;
			else{
				$idGap=0;
				$lydo='';
			}
			trim(strip_tags($lydo));
			if(get_magic_quotes_gpc()==false){
				$lydo=mysql_real_escape_string($lydo);
			}
			$sql="UPDATE donhang SET isGap=$idGap, Gap='$lydo' WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function CapNhatGhiChuAdmin($idDH){
			$isGhiChu=$_POST['ghichu-admin'];
			$lydo=$_POST['ghichu-admin-lydo'];
			if($isGhiChu=='on')
				$idGhiChu=1;
			else{
				$idGhiChu=0;
				$lydo='';
			}
			trim(strip_tags($lydo));
			if(get_magic_quotes_gpc()==false){
				$lydo=mysql_real_escape_string($lydo);
			}
			$sql="UPDATE donhang SET isGhiChu_Admin=$idGhiChu, GhiChu_Admin='$lydo' WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function CapNhatGhiChuSale($idDH){
			$isGhiChu=$_POST['ghichu-sale'];
			$lydo=$_POST['ghichu-sale-lydo'];
			if($isGhiChu=='on')
				$idGhiChu=1;
			else{
				$idGhiChu=0;
				$lydo='';
			}
			trim(strip_tags($lydo));
			if(get_magic_quotes_gpc()==false){
				$lydo=mysql_real_escape_string($lydo);
			}
			$sql="UPDATE donhang SET isGhiChu_Sale=$idGhiChu, GhiChu_Sale='$lydo' WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function CapNhatGhiChuKho($idDH){
			$isGhiChu=$_POST['ghichu-kho'];
			$lydo=$_POST['ghichu-kho-lydo'];
			if($isGhiChu=='on')
				$idGhiChu=1;
			else{
				$idGhiChu=0;
				$lydo='';
			}
			trim(strip_tags($lydo));
			if(get_magic_quotes_gpc()==false){
				$lydo=mysql_real_escape_string($lydo);
			}
			$sql="UPDATE donhang SET isGhiChu_Kho=$idGhiChu, GhiChu_Kho='$lydo' WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function CapNhatYCKH($idDH){
			$isYCKH=$_POST['yckh'];
			$lydo=$_POST['yckh-lydo'];
			if($isYCKH=='on')
				$idYCKH=1;
			else{
				$idYCKH=0;
				$lydo='';
			}
			trim(strip_tags($lydo));
			if(get_magic_quotes_gpc()==false){
				$lydo=mysql_real_escape_string($lydo);
			}
			$sql="UPDATE donhang SET isYCKH=$idYCKH, YCKH='$lydo' WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function CapNhatCSKH($idDH){
			$cskh=$_POST['cskh'];
			settype($cskh,"int");
			$sql="UPDATE donhang SET CSKH=$cskh WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
		}
		function DemSoSPKHDoi($idDH){
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH AND doi=1";
			$sp=mysql_query($sql) or die(mysql_error());
			$row_sp=mysql_num_rows($sp);
			return $row_sp;
		}
		function ThayDoiTinhTrang($idDH){
			$tinhtrang=$_POST['tinhtrang'];
			$idNV=$_SESSION['id'];
			$xuatkho_ma=$_POST['xuatkho_ma'];
			$dvvc_ma=$_POST['dvvc_ma'];
			$dvvc_dv=$_POST['dvvc_dv'];
			$hoantra_lydo=$_POST['hoantra_lydo'];
			$huy_lydo=$_POST['huy_lydo'];
			$doi_hinhthuc=$_POST['doi_hinhthuc'];
			$doi_noitiepnhan=$_POST['doi_noitiepnhan'];
			$doi_lydo=$_POST['doi_lydo'];
			$doi_ctdh=$_POST['doi_ctdh'];
			$doi_ctdh=substr($doi_ctdh,1);
			$doi_ctdh_arr=explode(",",$doi_ctdh);
			$nhapdoi_kho=$_POST['nhapdoi_kho'];
			$tra_kho=$_POST['tra_kho'];
			$dvvc2_dv=$_POST['dvvc2_dv'];
			$dvvc2_ma=$_POST['dvvc2_ma'];
			$dvvc2_chiphi=$_POST['dvvc2_chiphi'];
			$dvvc2_benchiu=$_POST['dvvc2_benchiu'];
			$bh_hinhthuc=$_POST['bh_hinhthuc'];
			$bh_noitiepnhan=$_POST['bh_noitiepnhan'];
			$bh_lydo=$_POST['bh_lydo'];
			$bh_ctdh=$_POST['bh_ctdh'];
			$bh_ctdh=substr($bh_ctdh,1);
			$bh_ctdh_arr=explode(",",$bh_ctdh);
			$bh_ok_chiphi=$_POST['bh_ok_chiphi'];
			$bh_ok_noibh=$_POST['bh_ok_noibh'];
			settype($tinhtrang,"int");
			settype($idNV,"int");
			settype($dvvc_dv,"int");
			settype($doi_hinhthuc,"int");
			settype($doi_noitiepnhan,"int");
			settype($nhapdoi_kho,"int");
			settype($xuatdoi_kho,"int");
			settype($dvvc2_dv,"int");
			settype($dvvc2_benchiu,"int");
			settype($xuatdoi_idsp,"int");
			settype($xuatkho_soluong,"int");
			settype($bh_hinhthuc,"int");
			settype($bh_noitiepnhan,"int");
			settype($bh_ok_noibh,"int");
			$xuatkho_ma=trim(strip_tags($xuatkho_ma));
			$dvvc_ma=trim(strip_tags($dvvc_ma));
			$hoantra_lydo=trim(strip_tags($hoantra_lydo));
			$huy_lydo=trim(strip_tags($huy_lydo));
			$doi_lydo=trim(strip_tags($doi_lydo));
			$dvvc2_ma=trim(strip_tags($dvvc2_ma));
			$bh_lydo=trim(strip_tags($bh_lydo));
			if(get_magic_quotes_gpc()==false){
				$xuatkho_ma=mysql_real_escape_string($xuatkho_ma);
				$dvvc_ma=mysql_real_escape_string($dvvc_ma);
				$hoantra_lydo=mysql_real_escape_string($hoantra_lydo);
				$huy_lydo=mysql_real_escape_string($huy_lydo);
				$doi_lydo=mysql_real_escape_string($doi_lydo);
				$dvvc2_ma=mysql_real_escape_string($dvvc2_ma);
				$bh_lydo=mysql_real_escape_string($bh_lydo);
			}
			switch($tinhtrang){
				case 2:
					$sql="UPDATE donhang SET idTT=$tinhtrang,XacNhan_Ngay=NOW(),XacNhan_NV=$idNV WHERE idDH=$idDH";
					break;
				case 16:// kiem tra ton kho
					$sql="UPDATE donhang SET idTT=$tinhtrang,KTTK_Ngay=NOW(),KTTK_NV=$idNV WHERE idDH=$idDH";
					break;
				case 3:
					$sql="UPDATE donhang SET idTT=$tinhtrang,ChuyenTiep_Ngay=NOW(),ChuyenTiep_NV=$idNV WHERE idDH=$idDH";
					break;
				case 4:
					$sql="UPDATE donhang SET idTT=$tinhtrang,XuatKho_Ngay=NOW(),XuatKho_NV=$idNV,XuatKho_Ma='$xuatkho_ma' WHERE idDH=$idDH";
					break;
				case 5:
					$sql="UPDATE donhang SET idTT=$tinhtrang,DVVC_Ngay=NOW(),DVVC_NV=$idNV,DVVC_Ma='$dvvc_ma',DVVC_DV=$dvvc_dv WHERE idDH=$idDH";
					break;
				case 6:
					$sql="UPDATE donhang SET idTT=$tinhtrang,HoanTra_Ngay=NOW(),HoanTra_NV=$idNV,HoanTra_LyDo='$hoantra_lydo' WHERE idDH=$idDH";
					break;
				case 7:
					$sql="UPDATE donhang SET idTT=$tinhtrang,NhapKho_Ngay=NOW(),NhapKho_NV=$idNV WHERE idDH=$idDH";
					break;
				case 8:
					$tggh=$_POST['hoantat_thoigian'];
					$tggh_arr=explode("/",$tggh);
					if(count($tggh_arr)==3)
					{
						$d=$tggh_arr[0];	
						$m=$tggh_arr[1];
						$y=$tggh_arr[2];
						if(checkdate($m,$d,$y)==true)
							$tggh=$y."-".$m."-".$d;
						else
							$tggh=date("Y-m-d H:i:s");
					}
					else
						$tggh=date("Y-m-d H:i:s");
					$sql="UPDATE donhang SET idTT=$tinhtrang,HoanTat_Ngay='$tggh',HoanTat_NV=$idNV WHERE idDH=$idDH";
					$this->updateIsPaid($idDH);
					break;
				case 9:
					$sql="UPDATE donhang SET idTT=$tinhtrang,Huy_Ngay=NOW(),Huy_NV=$idNV,Huy_LyDo='$huy_lydo' WHERE idDH=$idDH";
					break;
				case 10:
					for($k=0;$k<count($doi_ctdh_arr);$k++){
						$idDHCT=$doi_ctdh_arr[$k];
						$sql1="UPDATE donhangchitiet SET Doi=1 WHERE idDHCT=$idDHCT";
						mysql_query($sql1) or die(mysql_error());
					}
					$sql="UPDATE donhang SET idTT=$tinhtrang,Doi_Ngay=NOW(),Doi_NV=$idNV,Doi_HinhThuc=$doi_hinhthuc,Doi_NoiTiepNhan=$doi_noitiepnhan,Doi_LyDo='$doi_lydo' WHERE idDH=$idDH";
					break;
				case 11:
					$sql="UPDATE donhang SET idTT=$tinhtrang,NhapDoi_Ngay=NOW(),NhapDoi_NV=$idNV,NhapDoi_Kho=$nhapdoi_kho WHERE idDH=$idDH";
					break;
				case 12:
					$doi_num=$this->DemSoSPKHDoi($idDH);
					$xuatdoi_kho=$_POST['xuatdoi_kho'];
					for($l=1;$l<=$doi_num;$l++){
						$xuatdoi_idsp=$_POST["xuatkho_sp_".$l];
						$xuatkho_soluong=$_POST["xuatkho_soluong_".$l];
						$sp=$this->ChiTietSP($xuatdoi_idsp);
						$row_sp=mysql_fetch_assoc($sp);
						$gia=$row_sp['Gia_vn'];
						$giachuagiam=$row_sp['GiaChuaGiam_vn'];
						$sql1="INSERT INTO donhangchitiet (idDH,idSP,SoLuong,Gia,GiaChuaGiam,DoiTra) VALUES ($idDH,$xuatdoi_idsp,$xuatkho_soluong,$gia,$giachuagiam,1)";
						mysql_query($sql1) or die(mysql_error());
					}
					$sql="UPDATE donhang SET idTT=$tinhtrang,XuatDoi_Ngay=NOW(),XuatDoi_NV=$idNV,XuatDoi_Kho=$xuatdoi_kho WHERE idDH=$idDH";
					break;
				case 13:
					$sql="UPDATE donhang SET idTT=$tinhtrang,DVVC2_Ngay=NOW(),DVVC2_NV=$idNV,DVVC2_DV=$dvvc2_dv,DVVC2_Ma='$dvvc2_ma',DVVC2_ChiPhi=$dvvc2_chiphi,DVVC2_BenChiu=$dvvc2_benchiu WHERE idDH=$idDH";
					break;
				case 14:
					for($k=0;$k<count($doitra_ctdh_arr);$k++){
						$idDHCT=$doitra_ctdh_arr[$k];
						$sql1="UPDATE donhangchitiet SET Tra=1 WHERE idDHCT=$idDHCT";
						mysql_query($sql1) or die(mysql_error());
					}
					$sql="UPDATE donhang SET idTT=$tinhtrang,Tra_Ngay=NOW(),Tra_NV=$idNV,Tra_Kho=$tra_kho WHERE idDH=$idDH";
					break;
				case 15:
					$sql="UPDATE donhang SET idTT=$tinhtrang,KetThuc_Ngay=NOW(),KetThuc_NV=$idNV WHERE idDH=$idDH";
					break;
				case 17:
					for($k=0;$k<count($bh_ctdh_arr);$k++){
						$idDHCT=$bh_ctdh_arr[$k];
						$sql1="UPDATE donhangchitiet SET BaoHanh=1 WHERE idDHCT=$idDHCT";
						mysql_query($sql1) or die(mysql_error());
					}
					$sql="UPDATE donhang SET idTT=$tinhtrang,BH_Ngay=NOW(),BH_NV=$idNV,BH_HinhThuc=$bh_hinhthuc,BH_NoiTiepNhan=$bh_noitiepnhan,BH_LyDo='$bh_lydo' WHERE idDH=$idDH";
					break;
				case 18:
					$sql="UPDATE donhang SET idTT=$tinhtrang,BH_OK_Ngay=NOW(),BH_OK_NV=$idNV,BH_OK_ChiPhi=$bh_ok_chiphi,BH_OK_NoiBH=$bh_ok_noibh WHERE idDH=$idDH";
					break;
			}
			mysql_query($sql) or die(mysql_error());
		}
		function HuyDonHang_SendEmail($idDH){
			$lydo=$_POST['lydo_huy'];
			$sql="UPDATE donhang SET idTT=19, Huy_LyDo='$lydo', Huy_Ngay=NOW() WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
			$dh=$this->ChiTietDonHang($idDH);
			$row_dh=mysql_fetch_assoc($dh);
			$madh=$row_dh['MaDH'];
			$title="Bitas.com.vn - Yêu cầu hủy đơn hàng - Đơn hàng ".$madh;
			$send_email=$_SESSION['email'];
			$recieve_email="banbanle@bitas.com.vn,grace.hdo@gmail.com";
			include_once "../email/smtp.php";
			$content="<p>Có yêu cầu hủy đơn hàng từ nhân viên: ".$_SESSION['hoten'].".</p><p> Vui lòng nhấn vào <a href=http://bitas.com.vn/admin/index.php?p=donhang_huy&idDH=".$idDH.">đây</a> để xử lí đơn hàng.</p><p>Lý do: <strong>".$lydo."</strong></p><p>Nhấn vào <a href=http://bitas.com.vn/admin/index.php?p=donhang_chitiet&idDH=".$idDH.">đây</a> để xem chi tiết đơn hàng.</p>";
			SendMail($send_email,$recieve_email,$title,$content);
		}
		function CheckDHHuy($idDH){
			$sql="SELECT idDH FROM donhang WHERE idDH=$idDH AND idTT=19";
			$re=mysql_query($sql) or die(mysql_error());
			$row_re=mysql_num_rows($re);
			if($row_re==1)
				return true;
			else
				return false;	
		}
		function HuyDonHang($idDH){
			$idUser=$_SESSION['id'];
			$dh = $this->ChiTietDonHang($idDH);
			$row_dh = mysql_fetch_assoc($dh);
			$huy_tg = date("d/m/Y",strtotime($row_dh['Huy_Ngay']));
			$madh = $row_dh['MaDH'];
			$idPTTT=$row_dh['idPTTT'];
			$idTinh=$row_dh['idTinh'];
			$idQH=$row_dh['idQuanHuyen'];
			$idPhuong=$row_dh['idPhuong'];
			$idKH=$row_dh['idKH'];
			$tinh=$this->ChiTietTinhThanh($idTinh);
			$row_tinh=mysql_fetch_assoc($tinh);
			$qh=$this->ChiTietQuanHuyen($idQH);
			$row_qh=mysql_fetch_assoc($qh);
			$phuong=$this->ChiTietPhuong($idPhuong);
			$row_phuong=mysql_fetch_assoc($phuong);
			$kh=$this->ChiTietKH($idKH);
			$row_kh=mysql_fetch_assoc($kh);
		
			$sql="UPDATE donhang SET Huy_Ngay=NOW(), Huy_NV=$idUser, idTT=9 WHERE idDH=$idDH";
			mysql_query($sql) or die(mysql_error());
			include_once "../email/smtp.php";
			$sql="SELECT Email FROM donhang,user WHERE idDH=$idDH AND donhang.idKH=user.idUser";
			$re=mysql_query($sql) or die(mysql_error());
			$row_re=mysql_fetch_assoc($re);
			//Tang SLTK
			/*
			$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
			$ctdh=mysql_query($sql) or die(mysql_error());
			while($row_ctdh=mysql_fetch_assoc($ctdh)){
				$idSP=$row_ctdh['idSP'];
				$sl=$row_ctdh['SoLuong'];
				$sql="UPDATE sanpham SET SLTK=SLTK+$sl WHERE idSP=$idSP";
				mysql_query($sql) or die(mysql_error());
			}
			*/
			//config email
			$recieve_email=$row_re['Email'];
			$send_email="noreply@bitas.com.vn";
			$title="bitas.com.vn - Hủy đơn hàng - Đơn hàng ".$madh;
				
			$content='<table align="center" style="width:700px; padding:0; margin:0 auto; border:0;font-family:Arial,Helvetica,sans-serif;color:#414042;font-size:12px;" cellpadding="0" cellspacing="0">
	<tbody>
    	<tr>
        	<td>
            	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">
                	<tr style="vertical-align:top;text-align:left;padding:0;">
                    	<td>
                        	<a href="http://www.bitas.com.vn" title="Bitas Online" style="text-decoration:none;display:block;" target="_blank"><img alt="Bitas Online" src="http://bitas.com.vn/email/img/header-email.jpg" style="outline:none;text-decoration:none;width:auto;max-width:100%;float:left;clear:both;display:block;border:none" align="left"></a>
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
                    	<td style="color:#6d6e71;font-size:20px">THÔNG BÁO ĐƠN HÀNG HỦY THÀNH CÔNG</td>
                    </tr>
                    <tr>';
				$content.='<td>Xin chào, '.$row_kh['HoTen'].'</td>';
                $content.='</tr>
                    <tr>
                        <td>Cảm ơn Quý khách đã ghé thăm trang web <a href="http://www.bitas.com.vn" style="color:#000;">www.bitas.com.vn</a> của chúng tôi.</td>
                    </tr>
                    <tr>
						<td style="line-height:1.6em">Bitas xin xác nhận đơn hàng số <b>' . $madh . '</b> của ' . $row_kh['HoTen'] . ' đã được hủy thành công theo yêu cầu hủy đơn hàng vào ngày ' . $huy_tg . '.</td>
                    </tr>
					<tr>
						<td style="line-height:1.6em">Bitas rất lấy làm tiếc khi không được phục vụ bạn lần này. Thông tin đơn hàng được hủy như sau:</td>
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
                    	<tr>';  
				$content.='<td>Mã đơn hàng: '.$row_dh["MaDH"].'</td>'; 
				$content.='</tr><tr>';
                $content.='<td>Người mua: '.$row_kh['HoTen'].'</td>';      
				$content.='</tr><tr>';
                $content.='<td>Người nhận: '.$row_dh['NguoiNhan'].'</td>';
				$content.='</tr><tr>';
                $content.='<td>Điện thoại: '.$row_dh['DienThoai'].'</td>';      
				$content.='</tr><tr>';
                $content.='<td>Địa chỉ giao hàng: '.$row_dh['DiaChi'].', '.$row_phuong['type']." ".$row_phuong['Ten'].', '.$row_qh['type'].' '.$row_qh['Ten'].', '.$row_tinh['Ten'].'</td>';
				$content.='</tr>
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
                        </tr>';
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
								$khuyenmai=$tongcong_km-$tongcong;
								$subTotal=$this->TongGiaTriDonHang_ChuaChiPhi($idDH);
								if($row_dh['proCode'] != "HAPPYHOUR"){
									$phivc=$row_dh['TongCPVC'];
								}else{
									$phivc = 0;
								}
								$subTotal_vc=$subTotal+$phivc;
								$pttt=$row_dh['idPTTT'];
								$phidv=$this->PhiDichVu($subTotal_vc,$pttt);
								$total=$subTotal_vc+$phidv;
								/*===== PROMOTION =====*/
								$total=$this->TongGiaTriDonHang($idDH,$idTinh,$idQH,$idPTTT);
						$content.='
                        <tr>
                        	<td style="border:1px solid #ccc; border-top:0px none;">'.$tensp.'</td>
                            <td style="border:1px solid #ccc; border-left:0px none; border-top:0px none;">'.$mau.'</td>
                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none; ">'.$size.'</td>
                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.$soluong.'</td>
                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($giachuagiam,0,".",",").' VND</td>
                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($tongcong_km,0,".",",").' VND</td>
                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($khuyenmai,0,".",",").' VND</td>
                            <td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($tongcong,0,".",",").' VND</td>
                        </tr>';
						}
						$content.='<tr height="25px">
                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Tổng tiền sản phẩm</td>';
						$tonggoc=$this->TongGiaTriDonHang_Goc($idDH);
						$content.='<td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($tonggoc,0,".",",").' VND</td>';
						$content.='<tr height="25px">
                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Khuyến mãi</td>';
						/*===== PROMOTION =====*/
						$saleoff = $this->PromotionSaleoffCalc($idDH);
						$content.='<td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($saleoff,0,".",",").' VND</td>';
						$content.='</tr>
                        <tr height="25px">
                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Phí vận chuyển</td>';
						$content.='<td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($phivc,0,".",",").' VND</td>';
						$content.=' </tr>
                        <tr height="25px">
                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Phí dịch vụ</td>';
						$content.='<td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.number_format($phidv,0,".",",").' VND</td>';
						$content.='</tr>
                        <tr height="25px">
                        	<td colspan="7" style="background:#e6e7e8; text-align:right; padding-right:10px; border:1px solid #ccc; border-top:0px none;">Tổng tiền thanh toán</td>';
						$content.='<td style="border:1px solid #ccc; border-left:0px none;border-top:0px none;">'.$total.' VND</td>';
						$content.='</tr><tr>';
						$content.='<td colspan="8" style="border:1px solid #ccc;border-top:0px none; text-align:left; color:#890b14; font-style:italic;">Lý do hủy: '.$row_dh['Huy_LyDo'].'</td>';
						$content.='</tr>
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
                        	<td>Bitas hân hạnh chào đón sự trở lại của bạn trong một ngày gần nhất.</td>
                        </tr>
                        <tr>
                        	<td>Thao khảo chi tiết sản phẩm tại <a href="http://www.bitas.com.vn" style="font-weight:bold;text-decoration:none;">www.bitas.com.vn</a> hoặc hotline <strong style="color: #ed1c24">(08) 37 54 39 54</strong> để được phục vụ nhanh chóng</td>
                        </tr>
                        <tr>
                        	<td>Chúc bạn có một ngày vui vẻ!</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
        	<td background="http://bitas.com.vn/email/img/content-3.jpg" width="100%" height="246px">
            	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td style="width:70%">&nbsp;</td>
                        <td>
                        	<table width="100%" style="padding:0; margin:0 auto; border:0" cellpadding="0" cellspacing="0">
                            	<tr height="155px">
                                	<td colspan="4">&nbsp;</td>
                                </tr>
                                <tr>
                                	<td width="37px"><a href="https://www.facebook.com/bitasfootwear" style="display:block;"><img src="http://bitas.com.vn/email/img/icon-fb.png"></a></td>
                                    <td width="37px"><a href="http://bitas.com.vn" style="display:block;"><img style="margin-right:5px" src="http://bitas.com.vn/email/img/icon-tw.png"></a></td>
                                    <td width="37px"><a href="http://bitas.com.vn" style="display:block;"><img style="margin-right:5px" src="http://bitas.com.vn/email/img/icon-gg.png"></a></td>
                                    <td width="37px"><a href="http://bitas.com.vn" style="display:block;"><img style="margin-right:5px" src="http://bitas.com.vn/email/img/icon-youtube.png"></a></td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr><!-- end footer -->
    </tbody>
</table>';
			SendMail($send_email,$recieve_email,$title,$content);
		}
		
		
//====== USER =====//
		function UserCount(){
			$sql = "SELECT idUser FROM user WHERE idGroup = 3";
			$result = mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($result);
		}
		function ListUser(){
			$sql="SELECT idUser,Email,HoTen,DiaChi,idTinh,idQuanHuyen,DienThoai,Email,NgaySinh,GioiTinh,Ten,TaiKhoanTichLuy FROM user,group_user WHERE user.idGroup=group_user.idGroup ORDER BY idUser DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListKhachHang(){
			$sql="SELECT idUser,Email,HoTen,DiaChi,idTinh,idQuanHuyen,DienThoai,Email,NgaySinh,GioiTinh,Ten FROM user,group_user WHERE user.idGroup=group_user.idGroup AND user.idGroup=3 ORDER BY idUser DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListGroup(){
			$sql="SELECT idGroup,Ten FROM group_user WHERE AnHien=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ThemUser(&$error){
				$success=true;
				//Get Data
				$email=$_POST['email'];
				$hoten=$_POST['hoten'];
				$pass=$_POST['pass'];
				$gioitinh=$_POST['gioitinh'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuongxa=$_POST['phuongxa'];
				$ngaysinh=$_POST['ngaysinh'];
				$group=$_POST['group'] ? $_POST['group'] : 3;
				//Solve Data
				settype($gioitinh,"int");
				settype($group,"int");
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuongxa,"int");
				$email=trim(strip_tags($email));
				$pass=trim(strip_tags($pass));
				$hoten=trim(strip_tags($hoten));
				$dienthoai=trim(strip_tags($dienthoai));
				$diachi=trim(strip_tags($diachi));
				$ngaysinh=trim(strip_tags($ngaysinh));
				if (get_magic_quotes_gpc()==false) {
					$email = mysql_real_escape_string($email);
					$pass = mysql_real_escape_string($pass);
					$hoten = mysql_real_escape_string($hoten);
					$dienthoai = mysql_real_escape_string($dienthoai);
					$diachi = mysql_real_escape_string($diachi);
					$ngaysinh = mysql_real_escape_string($ngaysinh);
				}
				$checkEmail=$this->KTEmail($email);
				if($checkEmail==true){
					$success=false;
					$error['email']="Địa chỉ email này đã được đăng kí";
				}
				$ngaysinh_arr=explode("/",$ngaysinh);
				if(count($ngaysinh_arr)==3)
				{
					$d=$ngaysinh_arr[0];	
					$m=$ngaysinh_arr[1];
					$y=$ngaysinh_arr[2];
					if(checkdate($m,$d,$y)==true)
						$ngaysinh=$y."-".$m."-".$d;
					else
					{
						$success=false;
						$error['ngaysinh']="Ngày sinh không hợp lệ";
					}
				}
				else
				{
					$success=false;
					$error['ngaysinh']="Ngày sinh không hợp lệ";
				}
				date_default_timezone_set('Asia/Jakarta');
				$ngaydangki = date('Y-m-d H:i:s', time());
				$pass=md5($pass);
				if($success==true)
				{
					$sql="INSERT INTO user (Email,password,HoTen,DiaChi,idTinh,idQuanHuyen,idPhuong,DienThoai,NgaySinh,NgayDangKi,GioiTinh,idGroup) VALUES ('$email','$pass','$hoten','$diachi',$tinhthanh,$quanhuyen,$phuongxa,'$dienthoai','$ngaysinh','$ngaydangki',$gioitinh,$group)";
					mysql_query($sql) or die(mysql_error());		
				}
				return $success;
			}
			function SuaUser(&$error,$idUser){
				$success=true;
				//Get Data
				$hoten=$_POST['hoten'];
				$gioitinh=$_POST['gioitinh'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuongxa=$_POST['phuongxa'];
				$ngaysinh=$_POST['ngaysinh'];
				$group=$_POST['group'] ? $_POST['group'] : 3;
				//Solve Data
				settype($gioitinh,"int");
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuongxa,"int");
				settype($group,"int");
				$hoten=trim(strip_tags($hoten));
				$dienthoai=trim(strip_tags($dienthoai));
				$diachi=trim(strip_tags($diachi));
				$ngaysinh=trim(strip_tags($ngaysinh));
				if (get_magic_quotes_gpc()==false) {
					$hoten = mysql_real_escape_string($hoten);
					$dienthoai = mysql_real_escape_string($dienthoai);
					$diachi = mysql_real_escape_string($diachi);
					$ngaysinh = mysql_real_escape_string($ngaysinh);
				}			
				$ngaysinh_arr=explode("/",$ngaysinh);
				if(count($ngaysinh_arr)==3)
				{
					$d=$ngaysinh_arr[0];	
					$m=$ngaysinh_arr[1];
					$y=$ngaysinh_arr[2];
					if(checkdate($m,$d,$y)==true)
						$ngaysinh=$y."-".$m."-".$d;
					else
					{
						$success=false;
						$error['ngaysinh']="Ngày sinh không hợp lệ";
					}
				}
				else
				{
					$success=false;
					$error['ngaysinh']="Ngày sinh không hợp lệ";
				}
				$ngaydangki=date("Y-m-d H:i:s");
				if($success==true)
				{
					$sql="UPDATE user SET HoTen='$hoten',DiaChi='$diachi',idTinh=$tinhthanh,idQuanHuyen=$quanhuyen,idPhuong=$phuongxa,DienThoai='$dienthoai',NgaySinh='$ngaysinh',GioiTinh=$gioitinh,idGroup=$group WHERE idUser=$idUser";
					mysql_query($sql) or die(mysql_error());		
				}
				return $success;
			}
			function ChiTietUser($idUser){
				$sql="SELECT * FROM user WHERE idUser=$idUser";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ChiTietUserByEmail($email){
				$sql="SELECT * FROM user WHERE email='$email'";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function XoaUser($idUser){
				settype($idUser,"int");
				$sql="DELETE FROM user WHERE idUser=$idUser";
				mysql_query($sql) or die(mysql_error());
			}

			function ListAdmin(){
				$sql="SELECT idUser,Email,HoTen,DiaChi,idTinh,idQuanHuyen,DienThoai,Email,NgaySinh,GioiTinh,Ten,NgayDangKi,LastLoginDate FROM user,group_user WHERE user.idGroup=group_user.idGroup AND user.idGroup!=3 ORDER BY idUser DESC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
//====== NHOM SAN PHAM =====//
		function ProductGroupCount(){
			$sql = "SELECT idNSP FROM nhomsp";
			$result=mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($result);
		}
		function ListNhomSP(){
			$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,loaispdsg.Ten_vn as TenTL,NgayTao,NgayCapNhat,follow,represent,New,Discount,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien,LyDoAn, mau.Ten_vn as Mau FROM nhomsp,loaispdsg,mau WHERE loaispdsg.idlspdsg=nhomsp.idlspdsg AND nhomsp.idMau = mau.idMau ORDER BY idNSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListAllNSP(){
			$sql="SELECT * FROM nhomsp ORDER BY idNSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListNSP(){
			$sql="SELECT * FROM nhomsp WHERE AnHien=1 ORDER BY idNSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListNSPByLang($lang){
			$sql="SELECT * FROM nhomsp WHERE AnHien=1 AND Lang='$lang' ORDER BY idNSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ThemNhomSP(){
			//Get Data
			$ten=$_POST['ten'];
			$sku=$_POST['sku'];
			$og_title=$_POST['ogtitle'];
			$og_desc=$_POST['ogdesc'];
			$og_img=$_POST['ogimg'];
			$mota_vn=$_POST['mota_vn'];
			$mota_en=$_POST['mota_en'];
			$size1=$_POST['size1'];
			$gia1_vn=$_POST['gia1_vn'];
			$gia2_vn=$_POST['gia2_vn'];
			$gia3_vn=$_POST['gia3_vn'];
			$giachuagiam1_vn=$_POST['giachuagiam1_vn'];
			$giachuagiam2_vn=$_POST['giachuagiam2_vn'];
			$giachuagiam3_vn=$_POST['giachuagiam3_vn'];
			$hinh=$_POST['hinh'];
			$follow=$_POST['follow'];
			$bst=$_POST['bst'];
			$mau=$_POST['mau'];
			$loaisp=$_POST['loaisp'];
			$thutu=$_POST['thutu'];
			$daidien=$_POST['daidien'];
			if($daidien=="on")
				$daidien=1;
			else $daidien=0;
			$moi=$_POST['moi'];
			if($moi=="on")
				$moi=1;
			else $moi=0;
			$giamgia=$_POST['giamgia'];
			if($giamgia=="on")
				$giamgia=1;
			else $giamgia=0;
			/*
			$anhien=$_POST['anhien'];
			if($anhien=="on")
				$anhien=1;
			else $anhien=0;
			*/
			$ngaytao=date("Y-m-d");
			$ngaycapnhat=date("Y-m-d");
			$nguoitao=$_SESSION['id'];
			//Solve Data
			$ten=trim(strip_tags($ten));
			$sku=trim(strip_tags($sku));
			$og_title=trim(strip_tags($og_title));
			$og_desc=trim(strip_tags($og_desc));
			$og_img=trim(strip_tags($og_img));
			$size1=trim(strip_tags($size1));
			$gia1_vn=trim(strip_tags($gia1_vn));
			$gia2_vn=trim(strip_tags($gia2_vn));
			$gia3_vn=trim(strip_tags($gia3_vn));
			$giachuagiam1_vn=trim(strip_tags($giachuagiam1_vn));
			$giachuagiam2_vn=trim(strip_tags($giachuagiam2_vn));
			$giachuagiam3_vn=trim(strip_tags($giachuagiam3_vn));
			$hinh=trim(strip_tags($hinh));
			if(get_magic_quotes_gpc()==false)
			{
				$ten=mysql_real_escape_string($ten);
				$sku=mysql_real_escape_string($sku);
				$og_title=mysql_real_escape_string($og_title);
				$og_desc=mysql_real_escape_string($og_desc);
				$og_img=mysql_real_escape_string($og_img);
				$size1=mysql_real_escape_string($size1);
				$gia1_vn=mysql_real_escape_string($gia1_vn);
				$gia2_vn=mysql_real_escape_string($gia2_vn);
				$gia3_vn=mysql_real_escape_string($gia3_vn);
				$giachuagiam1_vn=mysql_real_escape_string($giachuagiam1_vn);
				$giachuagiam2_vn=mysql_real_escape_string($giachuagiam2_vn);
				$giachuagiam3_vn=mysql_real_escape_string($giachuagiam3_vn);
				$hinh=mysql_real_escape_string($hinh);
			}
			settype($follow,"int");
			settype($bst,"int");
			settype($mau,"int");
			settype($loaisp,"int");
			settype($thutu,"int");
			//Insert Data
			$sql="INSERT INTO nhomsp (Ten,SKU,ogTitle,ogDesc,ogImg,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,Hinh,SoLanXem,idlspdsg,NguoiTao,ThuTu) VALUES ('$ten','$sku','$og_title','$og_desc','$og_img','$mota_vn','$mota_en','$ngaytao','$ngaycapnhat',$follow,$bst,$daidien,$moi,$giamgia,$mau,'$size1','$gia1_vn','$gia2_vn','$gia3_vn','$giachuagiam1_vn','$giachuagiam2_vn','$giachuagiam3_vn','$hinh',0,$loaisp,$nguoitao,$thutu)";
			mysql_query($sql) or die(mysql_error());
			if($follow==0)
			{
				$follow=mysql_insert_id();
				$sql="UPDATE nhomsp SET follow=$follow WHERE idNSP=$follow";
				mysql_query($sql) or die(mysql_error());
			}
		}
		function SuaNhomSP($idnsp){
			//Get Data
			$ten=$_POST['ten'];
			$sku=$_POST['sku'];
			$og_title=$_POST['ogtitle'];
			$og_desc=$_POST['ogdesc'];
			$og_img=$_POST['ogimg'];
			$mota_vn=$_POST['mota_vn'];
			$mota_en=$_POST['mota_en'];
			$size1=$_POST['size1'];
			$size2=$_POST['size2'];
			$size3=$_POST['size3'];
			$gia1_vn=$_POST['gia1_vn'];
			$gia2_vn=$_POST['gia2_vn'];
			$gia3_vn=$_POST['gia3_vn'];
			$giachuagiam1_vn=$_POST['giachuagiam1_vn'];
			$giachuagiam2_vn=$_POST['giachuagiam2_vn'];
			$giachuagiam3_vn=$_POST['giachuagiam3_vn'];
			$hinh=$_POST['hinh'];
			$follow=$_POST['follow'];
			$bst=$_POST['bst'];
			$mau=$_POST['mau'];
			$loaisp=$_POST['loaisp'];
			$thutu=$_POST['thutu'];
			$daidien=$_POST['daidien'];
			if($daidien=="on")
				$daidien=1;
			else $daidien=0;
			$moi=$_POST['moi'];
			if($moi=="on")
				$moi=1;
			else $moi=0;
			$giamgia=$_POST['giamgia'];
			if($giamgia=="on")
				$giamgia=1;
			else $giamgia=0;
			/*
			$anhien=$_POST['anhien'];
			if($anhien=="on")
				$anhien=1;
			else $anhien=0;
			*/
			$ngaycapnhat=date("Y-m-d");			
			//Solve Data
			$ten=trim(strip_tags($ten));
			$sku=trim(strip_tags($sku));
			$og_title=trim(strip_tags($og_title));
			$og_desc=trim(strip_tags($og_desc));
			$og_img=trim(strip_tags($og_img));
			$size1=trim(strip_tags($size1));
			$size2=trim(strip_tags($size2));
			$size3=trim(strip_tags($size3));
			$gia1_vn=trim(strip_tags($gia1_vn));
			$gia2_vn=trim(strip_tags($gia2_vn));
			$gia3_vn=trim(strip_tags($gia3_vn));
			$giachuagiam1_vn=trim(strip_tags($giachuagiam1_vn));
			$giachuagiam2_vn=trim(strip_tags($giachuagiam2_vn));
			$giachuagiam3_vn=trim(strip_tags($giachuagiam3_vn));
			$hinh=trim(strip_tags($hinh));
			if(get_magic_quotes_gpc()==false)
			{
				$ten=mysql_real_escape_string($ten);
				$sku=mysql_real_escape_string($sku);
				$og_title=mysql_real_escape_string($og_title);
				$og_desc=mysql_real_escape_string($og_desc);
				$og_img=mysql_real_escape_string($og_img);
				$size1=mysql_real_escape_string($size1);
				$size2=mysql_real_escape_string($size2);
				$size3=mysql_real_escape_string($size3);
				$gia1_vn=mysql_real_escape_string($gia1_vn);
				$gia2_vn=mysql_real_escape_string($gia2_vn);
				$gia3_vn=mysql_real_escape_string($gia3_vn);
				$giachuagiam1_vn=mysql_real_escape_string($giachuagiam1_vn);
				$giachuagiam2_vn=mysql_real_escape_string($giachuagiam2_vn);
				$giachuagiam3_vn=mysql_real_escape_string($giachuagiam3_vn);
				$hinh=mysql_real_escape_string($hinh);
			}
			settype($follow,"int");
			settype($bst,"int");
			settype($mau,"int");
			settype($loaisp,"int");
			settype($thutu,"int");
			//Update Data
			$sql="UPDATE nhomsp SET Ten='$ten', SKU='$sku', ogTitle='$og_title', ogDesc='$og_desc', ogImg='$og_img', MoTa_vn='$mota_vn', MoTa_en='$mota_en', NgayCapNhat='$ngaycapnhat', follow=$follow,idBST=$bst, represent=$daidien, New=$moi, Discount=$giamgia, idMau=$mau, Size1='$size1', Size2='$size2', Size3='$size3', Gia1_vn='$gia1_vn', Gia2_vn='$gia2_vn', Gia3_vn='$gia3_vn', GiaChuaGiam1_vn='$giachuagiam1_vn', GiaChuaGiam2_vn='$giachuagiam2_vn', GiaChuaGiam3_vn='$giachuagiam3_vn', Hinh='$hinh', idlspdsg=$loaisp, ThuTu=$thutu WHERE idNSP=$idnsp";
			mysql_query($sql) or die(mysql_error());
		}
		function XoaNhomSP($idnsp){
			settype($idnsp,"int");
			$sql="DELETE FROM sanpham WHERE idNSP=$idnsp";
			mysql_query($sql) or die(mysql_error());
			$sql="DELETE FROM hinh WHERE idNSP=$idnsp";
			mysql_query($sql) or die(mysql_error());
			$sql="DELETE FROM nhomsp WHERE idNSP=$idnsp";
			mysql_query($sql) or die(mysql_error());
		}	
		function ListNhomSPFollow(){
			$sql="SELECT idNSP,Ten FROM nhomsp WHERE represent=1 ORDER BY idNSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietNhomSP($idnsp){
			$sql="SELECT * FROM nhomsp WHERE idNSP=$idnsp";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListHinhTheoNSP($idNSP){
			$sql="SELECT * FROM hinh WHERE idNSP=$idNSP";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ThemHinhZoom($idNSP){
			if($_POST['lg-1']!="")
				$lg1=$_POST['lg-1'];
			if($_POST['sm-1']!="")
				$sm1=$_POST['sm-1'];
			if($_POST['th-1']!="")
				$th1=$_POST['th-1'];
			if($_POST['lg-2']!="")
				$lg2=$_POST['lg-2'];
			if($_POST['sm-2']!="")
				$sm2=$_POST['sm-2'];
			if($_POST['th-2']!="")
				$th2=$_POST['th-2'];
			if($_POST['lg-3']!="")
				$lg3=$_POST['lg-3'];
			if($_POST['sm-3']!="")
				$sm3=$_POST['sm-3'];
			if($_POST['th-3']!="")
				$th3=$_POST['th-3'];
			if($_POST['lg-4']!="")
				$lg4=$_POST['lg-4'];
			if($_POST['sm-4']!="")
				$sm4=$_POST['sm-4'];
			if($_POST['th-4']!="")
				$th4=$_POST['th-4'];
			if($_POST['lg-5']!="")
				$lg5=$_POST['lg-5'];
			if($_POST['sm-5']!="")
				$sm5=$_POST['sm-5'];
			if($_POST['th-5']!="")
				$th5=$_POST['th-5'];
			if($_POST['lg-6']!="")
				$lg6=$_POST['lg-6'];
			if($_POST['sm-6']!="")
				$sm6=$_POST['sm-6'];
			if($_POST['th-6']!="")
				$th6=$_POST['th-6'];
			if(get_magic_quotes_gpc()==false){
				$lg1=mysql_real_escape_string($lg1);
				$lg2=mysql_real_escape_string($lg2);
				$lg3=mysql_real_escape_string($lg3);
				$lg4=mysql_real_escape_string($lg4);
				$lg5=mysql_real_escape_string($lg5);
				$lg6=mysql_real_escape_string($lg6);
				$sm1=mysql_real_escape_string($sm1);
				$sm2=mysql_real_escape_string($sm2);
				$sm3=mysql_real_escape_string($sm3);
				$sm4=mysql_real_escape_string($sm4);
				$sm5=mysql_real_escape_string($sm5);
				$sm6=mysql_real_escape_string($sm6);
				$th1=mysql_real_escape_string($th1);
				$th2=mysql_real_escape_string($th2);
				$th3=mysql_real_escape_string($th3);
				$th4=mysql_real_escape_string($th4);
				$th5=mysql_real_escape_string($th5);
				$th6=mysql_real_escape_string($th6);
			}
			if($lg1 !="" && $sm1 != "" && $th1 != ""){
				$sql="INSERT INTO hinh (urlHL,urlHS,urlHT,idNSP) VALUES ('$lg1','$sm1','$th1',$idNSP)";
				mysql_query($sql) or die(mysql_error());	
			}
			if($lg2 !="" && $sm2 != "" && $th2 != ""){
				$sql="INSERT INTO hinh (urlHL,urlHS,urlHT,idNSP) VALUES ('$lg2','$sm2','$th2',$idNSP)";
				mysql_query($sql) or die(mysql_error());
			}
			if($lg3 !="" && $sm3 != "" && $th3 != ""){
				$sql="INSERT INTO hinh (urlHL,urlHS,urlHT,idNSP) VALUES ('$lg3','$sm3','$th3',$idNSP)";
				mysql_query($sql) or die(mysql_error());
			}
			if($lg4 !="" && $sm4 != "" && $th4 != ""){
				$sql="INSERT INTO hinh (urlHL,urlHS,urlHT,idNSP) VALUES ('$lg4','$sm4','$th4',$idNSP)";
				mysql_query($sql) or die(mysql_error());
			}
			if($lg5 !="" && $sm5 != "" && $th5 != ""){
				$sql="INSERT INTO hinh (urlHL,urlHS,urlHT,idNSP) VALUES ('$lg5','$sm5','$th5',$idNSP)";
				mysql_query($sql) or die(mysql_error());
			}
			if($lg6 !="" && $sm6 != "" && $th6 != ""){
				$sql="INSERT INTO hinh (urlHL,urlHS,urlHT,idNSP) VALUES ('$lg6','$sm6','$th6',$idNSP)";
				mysql_query($sql) or die(mysql_error());
			}
		}
		function XoaHinhZoom($idnsp){
			$sql="DELETE FROM hinh WHERE idNSP=$idnsp";
			mysql_query($sql) or die(mysql_error());
		}
//====== SAN PHAM =====//
		function ListSanPham(){
			$sql="SELECT idSP, sanpham.Ten as Ten, Gia_vn,GiaChuaGiam_vn, Size, sanpham.AnHien as AnHien, SKU, mau.Ten_vn as Mau FROM sanpham, nhomsp, mau WHERE sanpham.idNSP=nhomsp.idNSP AND nhomsp.idMau = mau.idMau ORDER BY idSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListSanPhamTheoNSP($idNSP){
			$sql="SELECT idSP, sanpham.Ten as Ten, sanpham.NgayTao as NgayTao, sanpham.NgayCapNhat as NgayCapNhat, Gia_vn,GiaChuaGiam_vn, Size, SoLanMua, sanpham.idNSP as idNSP, nhomsp.Ten as TenNhomSP, sanpham.ThuTu as ThuTu, sanpham.AnHien as AnHien, SKU FROM sanpham, nhomsp WHERE sanpham.idNSP=nhomsp.idNSP AND sanpham.idNSP=$idNSP ORDER BY idSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ThemSanPham(){
			//get data
			$ten=$_POST['ten'];
			$gia_vn=$_POST['gia_vn'];
			$giachuagiam_vn=$_POST['giachuagiam_vn'];
			$size=$_POST['size'];
			$nsp=$_POST['nhomsp'];
			//$sltk=$_POST['sltk'];
			$thutu=$_POST['thutu'];
			$anhien=$_POST['anhien'];
			if($anhien=="on")
				$anhien=1;
			else $anhien=0;
			$ngaytao=date("Y-m-d H:i:s");
			$ngaycapnhat=date("Y-m-d H:i:s");
			//resolve data
			$ten=trim(strip_tags($ten));
			if(get_magic_quotes_gpc()==false)
			{
				$ten=mysql_real_escape_string($ten);
			}
			settype($nsp,"int");
			//settype($sltk,"int");
			settype($thutu,"int");
			settype($anhien,"int");
			//insert data
			$sql="INSERT INTO sanpham (Ten,NgayTao,NgayCapNhat,Gia_vn,GiaChuaGiam_vn,Size,SoLanMua,idNSP,ThuTu,AnHien) VALUES ('$ten','$ngaytao','$ngaycapnhat',$gia_vn,$giachuagiam_vn,$size,0,$nsp,$thutu,$anhien)";
			mysql_query($sql) or die(mysql_error());
		}
		function ThemSanPham_Nhieu($sosp){
			for($i=1;$i<=$sosp;$i++)
			{
				//get data
				$ten=$_POST['ten_'.$i];
				$size=$_POST['size_'.$i];
				$gia_vn=$_POST['gia_vn_'.$i];
				$gia_chua_giam_vn=$_POST['gia_chua_giam_vn_'.$i];
				$nsp=$_POST['nhomsp_'.$i];
				//$sltk=$_POST['sltk_'.$i];
				$thutu=$_POST['thutu_'.$i];
				$anhien=$_POST['anhien_'.$i];
				if($anhien=="on")
					$anhien=1;
				else $anhien=0;
				$ngaytao=date("Y-m-d H:i:s");
				$ngaycapnhat=date("Y-m-d H:i:s");
				//resolve data
				$ten=trim(strip_tags($ten));
				if(get_magic_quotes_gpc()==false)
				{
					$ten=mysql_real_escape_string($ten);
				}
				//settype($gia,"bigint");
				settype($nsp,"int");
				//settype($sltk,"int");
				settype($thutu,"int");
				settype($anhien,"int");
				//insert data
				$sql="INSERT INTO sanpham (Ten,NgayTao,NgayCapNhat,Gia_vn,GiaChuaGiam_vn,Size,SoLanMua,idNSP,ThuTu,AnHien) VALUES ('$ten','$ngaytao','$ngaycapnhat',$gia_vn,$gia_chua_giam_vn,$size,0,$nsp,$thutu,$anhien)";
				mysql_query($sql) or die(mysql_error());
			}
		}
		function SuaSanPham($idsp){
			//get data
			$ten=$_POST['ten'];
			$gia_vn=$_POST['gia_vn'];
			$giachuagiam_vn=$_POST['giachuagiam_vn'];
			$size=$_POST['size'];
			//$sltk=$_POST['sltk'];
			$nsp=$_POST['nhomsp'];
			$thutu=$_POST['thutu'];
			$anhien=$_POST['anhien'];
			if($anhien=="on")
				$anhien=1;
			else $anhien=0;
			$ngaycapnhat=date("Y-m-d H:i:s");
			//resolve data
			$ten=trim(strip_tags($ten));
			if(get_magic_quotes_gpc()==false)
			{
				$ten=mysql_real_escape_string($ten);
			}
			settype($nsp,"int");
			//settype($sltk,"int");
			settype($thutu,"int");
			settype($anhien,"int");
			//update data
			$sql="UPDATE sanpham SET Ten='$ten',NgayCapNhat='$ngaycapnhat',Gia_vn=$gia_vn,GiaChuaGiam_vn=$giachuagiam_vn,Size=$size,idNSP=$nsp,ThuTu=$thutu,AnHien=$anhien WHERE idSP=$idsp";
			mysql_query($sql) or die(mysql_error());
		}
		function ChiTietSP($idsp){
			$sql="SELECT * FROM sanpham WHERE idSP=$idsp";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function XoaSanPham($idsp){
			settype($idsp,"int");
			$sql="DELETE FROM sanpham WHERE idSP=$idsp";
			mysql_query($sql) or die(mysql_error());
		}
		function ProductCount(){
			$sql="SELECT idSP FROM sanpham";
			$result=mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($result);
		}
//====== LOAI SAN PHAM DSG =====//
		function ListLSPDSG(){
			$sql="SELECT idlspdsg,Ten_vn,Ten_en FROM loaispdsg WHERE AnHien=1 ORDER BY idlspdsg ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}		
//====== TIN TUC =====//
		function ListLoaiTin(){
			$sql="SELECT idLT,Ten FROM loaitin WHERE AnHien=1 ORDER BY idLT ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListTinTuc(){
			$sql="SELECT idTin,TieuDe,tintuc.Hinh as Hinh,NgayDang,NgayCapNhat,Ten,HoTen,SoLanXem,tintuc.ThuTu as ThuTu, tintuc.AnHien as AnHien,tintuc.idLT as idLT FROM tintuc,loaitin,user WHERE tintuc.idLT=loaitin.idLT AND tintuc.idUser=user.idUser ORDER BY idTin DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListnNews($limit){
			$sql="SELECT idTin,TieuDe,tintuc.Hinh as Hinh,NgayDang,NgayCapNhat,Ten,HoTen,SoLanXem,tintuc.ThuTu as ThuTu, tintuc.AnHien as AnHien,tintuc.idLT as idLT FROM tintuc,loaitin,user WHERE tintuc.AnHien = 1 AND tintuc.idLT=loaitin.idLT AND tintuc.idUser=user.idUser ORDER BY idTin DESC LIMIT 0,$limit";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListTinTucTheoLT($idLT){
			$sql="SELECT idTin,TieuDe,tintuc.Hinh as Hinh,NgayDang,NgayCapNhat,Ten,HoTen,SoLanXem,tintuc.ThuTu as ThuTu, tintuc.AnHien as AnHien,tintuc.idLT as idLT FROM tintuc,loaitin,user WHERE tintuc.idLT=$idLT AND tintuc.idLT=loaitin.idLT AND tintuc.idUser=user.idUser ORDER BY idTin DESC";
			$kq=mysql_query($sql) or die(mysql_error());

			return $kq;
		}
		function ThemTinTuc(){
			//get data
			$tieude=$_POST['tieude'];
			$og_title=$_POST['ogtitle'];
			$og_desc=$_POST['ogdesc'];
			$og_img=$_POST['ogimg'];
			$tomtat=$_POST['tomtat'];
			$noidung=$_POST['noidung'];
			$hinh=$_POST['hinh'];
			$loaitin=$_POST['loaitin'];
			$thutu=$_POST['thutu'];
			$anhien=$_POST['anhien'];
			if($anhien=='on')
				$anhien=1;
			else	
				$anhien=0;
			$tieude_khongdau=$this->changeTitle($tieude);
			$ngaydang=date("Y-m-d H:i:s");
			$ngaycapnhat=date("Y-m-d H:i:s");
			$iduser=$_SESSION['id'];
			//solve data
			$tieude=trim(strip_tags($tieude));
			$og_title=trim(strip_tags($og_title));
			$og_desc=trim(strip_tags($og_desc));
			$og_img=trim(strip_tags($og_img));
			$hinh=trim(strip_tags($hinh));
			$tomtat=trim(strip_tags($tomtat));
			$noidung=trim(strip_tags($noidung));
			if(get_magic_quotes_gpc()==false)
			{
				$tieude=mysql_real_escape_string($tieude);
				$og_title=mysql_real_escape_string($og_title);
				$og_desc=mysql_real_escape_string($og_desc);
				$og_img=mysql_real_escape_string($og_img);
				$hinh=mysql_real_escape_string($hinh);
				$tomtat=mysql_real_escape_string($tomtat);
			}
			settype($loaitin,"int");
			settype($thutu,"int");
			settype($anhien,"int");
			//insert data
			$sql="INSERT INTO tintuc (TieuDe, ogTitle, ogDesc, ogImg, TieuDe_KhongDau, TomTat, NoiDung, Hinh, NgayDang, NgayCapNhat, idLT, idUser, SoLanXem, ThuTu, AnHien) VALUES ('$tieude', '$og_title', '$og_desc', '$og_img', '$tieude_khongdau', '$tomtat', '$noidung', '$hinh', '$ngaydang', '$ngaycapnhat', $loaitin, $iduser, 0, $thutu, $anhien)";
			//echo $sql; exit();
			mysql_query($sql) or die(mysql_error());
		}
		function ChiTietTin($idtin){
			$sql="SELECT * FROM tintuc WHERE idTin=$idtin";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function SuaTinTuc($idtin){
			//get data
			$tieude=$_POST['tieude'];
			$og_title=$_POST['ogtitle'];
			$og_desc=$_POST['ogdesc'];
			$og_img=$_POST['ogimg'];
			$tomtat=$_POST['tomtat'];
			$noidung=$_POST['noidung'];
			$hinh=$_POST['hinh'];
			$loaitin=$_POST['loaitin'];
			$thutu=$_POST['thutu'];
			$anhien=$_POST['anhien'];
			if($anhien=='on')
				$anhien=1;
			else	$anhien=0;
			$tieude_khongdau=$this->changeTitle($tieude);
			$ngaycapnhat=date("Y-m-d H:i:s");
			//solve data
			$tieude=trim(strip_tags($tieude));
			$og_title=trim(strip_tags($og_title));
			$og_desc=trim(strip_tags($og_desc));
			$og_img=trim(strip_tags($og_img));
			$hinh=trim(strip_tags($hinh));
			if(get_magic_quotes_gpc()==false)
			{
				$tieude=mysql_real_escape_string($tieude);
				$og_title=mysql_real_escape_string($og_title);
				$og_desc=mysql_real_escape_string($og_desc);
				$og_img=mysql_real_escape_string($og_img);
				$hinh=mysql_real_escape_string($hinh);
			}
			settype($loaitin,"int");
			settype($thutu,"int");
			settype($anhien,"int");
			//update data
			$sql="UPDATE tintuc SET TieuDe='$tieude',ogTitle='$og_title',ogDesc='$og_desc',ogImg='$og_img',TieuDe_KhongDau='$tieude_khongdau',TomTat='$tomtat',NoiDung='$noidung',Hinh='$hinh',NgayCapNhat='$ngaycapnhat',idLT=$loaitin,ThuTu=$thutu,AnHien=$anhien WHERE idTin=$idtin";
			mysql_query($sql) or die(mysql_error());
		}
		function XoaTin($idtin){
			settype($idtin,"int");
			$sql="DELETE FROM tintuc WHERE idTin=$idtin";
			mysql_query($sql) or die(mysql_error());
		}
//====== KHUYEN MAI =====//
		function ListKhuyenMai(){
			$sql="SELECT * FROM khuyenmai ORDER BY idKM DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ThemKhuyenMai(){
			//get data
			$ten=$_POST['ten'];
			$tomtat=$_POST['tomtat'];
			$ngaybatdau=$_POST['ngaybatdau'];
			$ngayketthuc=$_POST['ngayketthuc'];
			$noidung=$_POST['noidung'];
			$hinh=$_POST['hinh'];
			$thutu=$_POST['thutu'];
			$anhien=$_POST['anhien'];
			if($anhien=='on') $anhien=1;
			else $anhien=0;
			//sovle data
			$ten=trim(strip_tags($ten));
			$tomtat=trim(strip_tags($tomtat));
			$ngaybatdau=trim(strip_tags($ngaybatdau));
			$ngayketthuc=trim(strip_tags($ngayketthuc));
			$hinh=trim(strip_tags($hinh));
			if(get_magic_quotes_gpc()==false)
			{
				$ten=mysql_real_escape_string($ten);
				$tomtat=mysql_real_escape_string($tomtat);
				$ngaybatdau=mysql_real_escape_string($ngaybatdau);
				$ngayketthuc=mysql_real_escape_string($ngayketthuc);
				$hinh=mysql_real_escape_string($hinh);
			}
			$ngaybd_arr=explode("/",$ngaybatdau);
			if(count($ngaybd_arr)==3)
			{
				$d=$ngaybd_arr[0];	
				$m=$ngaybd_arr[1];
				$y=$ngaybd_arr[2];
				if(checkdate($m,$d,$y)==true)
					$ngaybatdau=$y."-".$m."-".$d." 00:00:01";
				else
					$ngaybatdau=date("Y-m-d H:i:s");
			}
			else
				$ngaybatdau=date("Y-m-d H:i:s");
			$ngaykt_arr=explode("/",$ngayketthuc);
			if(count($ngaykt_arr)==3)
			{
				$d=$ngaykt_arr[0];	
				$m=$ngaykt_arr[1];
				$y=$ngaykt_arr[2];
				if(checkdate($m,$d,$y)==true)
					$ngayketthuc=$y."-".$m."-".$d." 23:59:59";
				else
					$ngayketthuc=date("Y-m-d H:i:s");
			}
			else
				$ngaybatdau=date("Y-m-d H:i:s");
			settype($thutu,"int");
			settype($anhien,"int");
			//insert data
			$sql="INSERT INTO khuyenmai (Ten,TomTat,NgayBatDau,NgayKetThuc,NoiDung,Hinh,ThuTu,AnHien) VALUES ('$ten','$tomtat','$ngaybatdau','$ngayketthuc','$noidung','$hinh',$thutu,$anhien)";
			mysql_query($sql) or die(mysql_error());
		}
		function SuaKhuyenMai($idkm){
			//get data
			$ten=$_POST['ten'];
			$tomtat=$_POST['tomtat'];
			$ngaybatdau=$_POST['ngaybatdau'];
			$ngayketthuc=$_POST['ngayketthuc'];
			$noidung=$_POST['noidung'];
			$hinh=$_POST['hinh'];
			$thutu=$_POST['thutu'];
			$anhien=$_POST['anhien'];
			if($anhien=='on') $anhien=1;
			else $anhien=0;
			//sovle data
			$ten=trim(strip_tags($ten));
			$tomtat=trim(strip_tags($tomtat));
			$ngaybatdau=trim(strip_tags($ngaybatdau));
			$ngayketthuc=trim(strip_tags($ngayketthuc));
			$hinh=trim(strip_tags($hinh));
			if(get_magic_quotes_gpc()==false)
			{
				$ten=mysql_real_escape_string($ten);
				$tomtat=mysql_real_escape_string($tomtat);
				$ngaybatdau=mysql_real_escape_string($ngaybatdau);
				$ngayketthuc=mysql_real_escape_string($ngayketthuc);
				$hinh=mysql_real_escape_string($hinh);
			}
			$ngaybd_arr=explode("/",$ngaybatdau);
			if(count($ngaybd_arr)==3)
			{
				$d=$ngaybd_arr[0];	
				$m=$ngaybd_arr[1];
				$y=$ngaybd_arr[2];
				if(checkdate($m,$d,$y)==true)
					$ngaybatdau=$y."-".$m."-".$d." 00:00:01";
				else
					$ngaybatdau=date("Y-m-d H:i:s");
			}
			else
				$ngaybatdau=date("Y-m-d H:i:s");
			$ngaykt_arr=explode("/",$ngayketthuc);
			if(count($ngaykt_arr)==3)
			{
				$d=$ngaykt_arr[0];	
				$m=$ngaykt_arr[1];
				$y=$ngaykt_arr[2];
				if(checkdate($m,$d,$y)==true)
					$ngayketthuc=$y."-".$m."-".$d." 23:59:59";
				else
					$ngayketthuc=date("Y-m-d H:i:s");
			}
			else
				$ngaybatdau=date("Y-m-d H:i:s");
			settype($thutu,"int");
			settype($anhien,"int");
			//update data
			$sql="UPDATE khuyenmai SET Ten='$ten',TomTat='$tomtat',NgayBatDau='$ngaybatdau',NgayKetThuc='$ngayketthuc',NoiDung='$noidung',Hinh='$hinh',ThuTu=$thutu,AnHien=$anhien WHERE idKM=$idkm";
			mysql_query($sql) or die(mysql_error());
		}
		function XoaKhuyenMai($idkm){
			settype($idkm,"int");
			$sql="DELETE FROM khuyenmai WHERE idKM=$idkm";
			mysql_query($sql) or die(mysql_error());
		}
//====== Y KIEN =====//
		function CommentPendingCount(){
			$sql = "SELECT idYK FROM ykienkhachhang WHERE Duyet = 0";
			$result = mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($result);
		}
		function ListYKienAll(){
			$sql="SELECT * FROM ykienkhachhang ORDER BY idYK DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListYKienChuaDuyet(){
			$sql="SELECT * FROM ykienkhachhang WHERE Duyet=0 ORDER BY idYK DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ListYKienDaDuyet(){
			$sql="SELECT * FROM ykienkhachhang WHERE Duyet=1 ORDER BY idYK DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function LayNSP_Mau($idnsp){
			$sql="SELECT idNSP,nhomsp.Ten as Ten,mau.Ten_vn as Mau FROM nhomsp,mau WHERE idNSP=$idnsp AND nhomsp.idMau=mau.idMau";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function DuyetYKien($idYK){
			$sql="UPDATE ykienkhachhang SET Duyet=1 WHERE idYK=$idYK";
			mysql_query($sql) or die(mysql_error());
		}
		function BoDuyetYKien($idYK){
			$sql="UPDATE ykienkhachhang SET Duyet=0 WHERE idYK=$idYK";
			mysql_query($sql) or die(mysql_error());
		}
		function XoaYKien($idyk){
			$sql="DELETE FROM ykienkhachhang WHERE idYK=$idyk";
			mysql_query($sql) or die(mysql_error());
		}
		function ChiTietYKien($idyk){
			$sql = "SELECT * FROM ykienkhachhang WHERE idYK = $idyk";
			$re = mysql_query($sql) or die(mysql_error());
			return $re;
		}
		function TraLoiYKien($idyk){
			$traloi = $_POST['traloi'];
			$traloi = trim(strip_tags($traloi));
			if(!get_magic_quotes_gpc()){
				$traloi = mysql_real_escape_string($traloi);
			}
			$sql = "UPDATE ykienkhachhang SET TraLoi = '$traloi' WHERE idYK = $idyk";
			mysql_query($sql) or die(mysql_error());
		}
		function ApproveComment($idYK){
			settype($idYK, "int");
			$sql = "UPDATE ykienkhachhang SET Duyet = !Duyet WHERE idYK = $idYK";
			if(mysql_query($sql)){
				return 1;
			}else{
				return 0;
			}
		}
		function CSKH_TimKiemDonHang($info,$by){
			$info=trim(strip_tags($info));
			if(get_magic_quotes_gpc()==false)
				$info=mysql_real_escape_string($info);
			settype($by,"int");
			switch($by){
				case 1:
					$sql="SELECT * FROM donhang WHERE MaDH='$info'";
					break;
				case 2:
					$sql="SELECT * FROM donhang,user WHERE user.idUser=donhang.idKH AND Email='$info'";
					break;
				case 3:
					$sql="SELECT * FROM donhang WHERE NguoiNhan LIKE '%$info%'";
					break;
				case 4:
					$sql="SELECT * FROM donhang WHERE DienThoai='$info'";
					break;
			}
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		/*
		function updateAnHien($idNSP){
			settype($idNSP,"int");
			$sql="SELECT AnHien FROM nhomsp WHERE idNSP=$idNSP";
			$re=mysql_query($sql) or die(mysql_error());
			$row_re=mysql_fetch_assoc($re);
			$anhien=$row_re['AnHien'];
			if($anhien){
				$sql="UPDATE nhomsp SET AnHien=0 WHERE idNSP=$idNSP";
				mysql_query($sql) or die(mysql_error());
				return 0;
			}
			else{
				$sql="UPDATE nhomsp SET AnHien=1 WHERE idNSP=$idNSP";
				mysql_query($sql) or die(mysql_error());
				return 1;
			}
		}*/
		
		function updateAnHien($idNSP,$text){
			settype($idNSP,"int");
			$text = trim(strip_tags($text));
			if(get_magic_quotes_gpc() == false){
				$text = mysql_real_escape_string($text);
			}
			$sql = "UPDATE nhomsp SET LyDoAn = '$text',AnHien = !AnHien WHERE idNSP = $idNSP";
			mysql_query($sql) or die(mysql_error());
			$sql = "UPDATE sanpham SET LyDoAn = '$text' WHERE idNSP = $idNSP";
			if(mysql_query($sql)){
				return 1;
			}else{
				return 0;
			}
		}
		
		//====== BO SUU TAP =====//
		function ListBST(){
			$sql = "SELECT * FROM bosuutap ORDER BY idBST DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		//====== END BO SUU TAP =====//
		//====== TIEN THUONG =====//
		function ListTienThuong(){
			$sql = "SELECT * FROM daquay ORDER BY idDQS ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		//====== END BO SUU TAP =====//

		//====== EMAIL MARKETING =====//
		function EmailMarketingCount(){
			$sql = "SELECT idEM FROM emailmarketing";
			$result=mysql_query($sql) or die(mysql_error());
			return mysql_num_rows($result);
		}

		function ListEmailMarketing(){
			$sql = "SELECT * FROM emailmarketing ORDER BY idEM DESC";
			$result=mysql_query($sql) or die(mysql_error());
			return $result;
		}
		//====== END EMAIL MARKETING =====//

		function ListSearch(){
			$sql = "SELECT * FROM search_result ORDER BY idSR DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}	
	}
?>