<?php /**
	* Class DB ket noi toi database
	*/
	class db
	{
		PUBLIC $con=NULL;
		PUBLIC $host="localhost";
		PUBLIC $username="webbitas";
		PUBLIC $pass="6sG5788fJ6Be";
		PUBLIC $database="webbitas_maindb";
		function __construct()
		{
			$this->con=mysql_connect($this->host,$this->username,$this->pass);
			mysql_select_db($this->database);
			mysql_query("set names 'utf8'");
		}
		/*------GENERAL-----*/
		function writeNotifyLog($val){
			$sql="INSERT INTO notify_log (val,date) VALUES ('$val',NOW())";
			mysql_query($sql) or die(mysql_error());
		}
		function getIPAddress(){
			$ip = getenv('HTTP_CLIENT_IP')?:
			getenv('HTTP_X_FORWARDED_FOR')?:
			getenv('HTTP_X_FORWARDED')?:
			getenv('HTTP_FORWARDED_FOR')?:
			getenv('HTTP_FORWARDED')?:
			getenv('REMOTE_ADDR');
			return $ip;
		}
		function change_img_url_nsp(){
			$sql="SELECT idNSP,Hinh FROM nhomsp";
			$nsp=mysql_query($sql) or die(mysql_error());
			while($row_nsp=mysql_fetch_assoc($nsp)){
				$hinh=$row_nsp['Hinh'];
				$hinh=str_replace("/demo/","",$hinh);
				$idNSP=$row_nsp['idNSP'];
				$sql="UPDATE nhomsp SET Hinh='$hinh' WHERE idNSP=$idNSP";
				mysql_query($sql) or die(mysql_error());
			}
		}
		function change_img_hinh(){
			$sql="SELECT idHinh,urlHL,urlHS,urlHT FROM hinh";
			$hinh=mysql_query($sql) or die(mysql_error());
			while($row_hinh=mysql_fetch_assoc($hinh)){
				$hinhL=$row_hinh['urlHL'];
				$hinhS=$row_hinh['urlHS'];
				$hinhT=$row_hinh['urlHT'];
				$hinhL=str_replace("/demo/","",$hinhL);
				$hinhS=str_replace("/demo/","",$hinhS);
				$hinhT=str_replace("/demo/","",$hinhT);
				$idHinh=$row_hinh['idHinh'];
				$sql="UPDATE hinh SET urlHL='$hinhL',urlHS='$hinhS',urlHT='$hinhT' WHERE idHinh=$idHinh";
				mysql_query($sql) or die(mysql_error());
			}
		}
		
		function meta_description($p,$option,$idLoaispGT){
			$meta = '';				
			if(!empty($p)){
				if($p=='product'){
					if(!empty($option)){
						if($option=='hang-moi'){
							$meta = 'Bộ sưu tập những mẫu giày dép mới, cập nhật những xu hướng giày dép thời trang đang thịnh hành. Mua sắm giày dép online tại bitas.com.vn để bắt kịp xu hướng.';
						}elseif($option=='hang-giam-gia'){
							$meta = 'Mua giày online chưa bao giờ dễ dàng hơn thế với bitas.com.vn, nhiều sản phẩm giày dép sandal nam nữ, giày dép thời trang, giày trẻ em giảm giá đang chờ đón bạn.';
						}
					}
					
					if(!empty($idLoaispGT)){
						if($idLoaispGT==1){
							$meta = 'Mua online giày bé gái, dép bé gái, sandal bé gái chất lượng nhất với giá tốt nhất. Giày trẻ em tại bitas.com.vn đa dạng mẫu mã, màu sắc dành nhiều lứa tuổi';
						}elseif($idLoaispGT==2){
							$meta = 'Mua giày trẻ em online với giá ưu đãi. Bao gồm: giày bé trai, dép bé trai, sandal bé trai với nhiều kiểu dáng, chất liệu. 7 ngày đổi hàng, bảo hành 2 tháng';
						}elseif($idLoaispGT==3){
							$meta = 'Mua giày dép nữ online, giày dép thời trang, giày đẹp với mức giá cực ưu đãi. Hàng trăm mẫu giày dép sandal dành cho nữ đang chờ đón bạn tại bitas.com.vn';
						}
						elseif($idLoaispGT==4){
							$meta = 'Mua sắm online giày thể thao nam, dép nam, sandal nam với mức giá ưu đãi. Mua giày online tại bitas.com.vn được giao hàng miễn phí, 7 ngày đổi hàng, bảo hành 2 tháng';
						}
					}
				}
			}else{
				$meta = 'Bitas.com.vn là website bán giày dép online với mức giá tốt nhất. Bao gồm: giày dép nam, giày dép nữ, giày dép trẻ em, giày dép thời trang với tiêu chí rẻ, đẹp, bền';
			}
			return $meta;
		}
		
		function title($p,$pi,$idNSP,$idLoaispGT,$idLoaispDSG,$option,$lsp,$idTin){
			if($p=="")
				$title="Trang mua sắm giày dép online Bita’s | Bitas.com.vn";
			elseif($p=='product'){
				if($idLoaispGT!=''){
					$loaisp=$this->LayChiTietLSPGT($idLoaispGT);
				}
				elseif($idLoaispDSG!='')
				{
					$loaisp=$this->LayChiTietLSPDSG($idLoaispDSG);
				}
				elseif(!empty($option))
				{
					if($option=='hang-moi'){
						if($lsp=='be-gai'){
							return $title="Giày bé gái mới về | Mua giày trẻ em online mới nhất | Bitas.com.vn";
						}elseif($lsp=='be-trai'){
							return $title="Giày bé trai mới về | Mua giày trẻ em online mới nhất | Bitas.com.vn";
						}
						elseif($lsp=='nu'){
							return $title="Giày nữ mới về | Mua giày nữ online mới nhất | Bitas.com.vn";
						}
						elseif($lsp=='nam'){
							return $title="Giày nam mới về | Mua giày nam online mới nhất | Bitas.com.vn";
						}elseif($lsp=='thoi-trang'){
							return $title="Mua giày dép thời trang online mới nhất tại Bitas.com.vn";
						}else{
							return $title="Hàng mới về | Mua giày dép online mới nhất tại Bitas.com.vn";
						}
					}
					elseif($option=='hang-giam-gia'){
						if($lsp=='be-gai'){
							return $title="Hàng giảm giá bé gái | Mua giày dép trẻ em giảm giá | Bitas.com.vn";
						}elseif($lsp=='be-trai'){
							return $title="Hàng giảm giá bé trai | Mua giày dép trẻ em giảm giá | Bitas.com.vn";
						}
						elseif($lsp=='nu'){
							return $title="Hàng giảm giá nữ | Mua giày dép nữ giảm giá | Bitas.com.vn";
						}
						elseif($lsp=='nam'){
							return $title="Hàng giảm giá nam | Mua giày dép nam giảm giá | Bitas.com.vn";
						}elseif($lsp=='thoi-trang'){
							return $title="Hàng giảm giá thời trang | Mua giày dép thời trang giảm giá | Bitas.com.vn";
						}else{
							return $title="Hàng giảm giá | Mua giày dép giảm giá online | Bitas.com.vn";
						}
					}
				}
				$row=mysql_fetch_assoc($loaisp);
				$title=$row['Title'];
			}
			elseif($p=='detail'){
				$idNSP = $this->getIDFromUrl($idNSP);
				$nsp=$this->LayChiTietNSP($idNSP);
				$row_nsp=mysql_fetch_assoc($nsp);
				$sql = "SELECT Ten_vn FROM loaispdsg,nhomsp WHERE nhomsp.idlspdsg = loaispdsg.idlspdsg AND idNSP = $idNSP";
				$lsp = mysql_query($sql) or die(mysql_error());
				$row_lsp = mysql_fetch_assoc($lsp);
				$tenlsp = $row_lsp['Ten_vn'];
				$tennsp=$row_nsp['Ten'];
				$idMau=$row_nsp['idMau'];
				$mau=$this->LayMauNSP($idNSP);
				$row_mau=mysql_fetch_assoc($mau);
				$tenmau=$row_mau['Mau_vn'];
				$title="$tenlsp $tennsp | Mua $tenlsp online tại Bitas.com.vn";
			}
			elseif($p=='detail_news'){
				$tin=$this->ChiTietTin($idTin);
				$row_tin=mysql_fetch_assoc($tin);
				$tin_title=$row_tin['TieuDe'];
				$title="$tin_title | Trang mua sắm giày chính hãng Bita’s | Bitas.com.vn";
			}
			elseif($p=='cart')
				$title="Giỏ hàng - Trang mua sắm giày dép online | Bitas.com.vn";
			elseif($p=='cart_dn_dk')
				$title="Giỏ hàng | Đăng nhập - Đăng ký | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='cart_ttkh')
				$title="Giỏ hàng | Thông tin khách hàng | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='cart_finish')
				$title="Giỏ hàng | Đặt hàng thành công | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='taikhoan'){
				if($p=='taikhoan'&&$pi=='')
					$title="Tài khoản cá nhân | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_doithongtin')
					$title="Thông tin tài khoản | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_doidiachi')
					$title="Địa chỉ cá nhân | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_themdiachigiaohang')
					$title="Tài khoản | Thêm địa chỉ giao hàng | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_doidiachigiaohang')
					$title="Tài khoản | Đổi địa chỉ giao hàng | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_wishlist')
					$title="Sản phẩm yêu thích | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_donhang')
					$title="Lịch sử mua giày dép Bita’s | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_donhangchitiet')
					$title="Tài khoản | Đơn hàng chi tiết | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_doimatkhau')
					$title="Tài khoản | Đổi mật khẩu | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
				elseif($p=='taikhoan'&&$pi=='taikhoan_tienthuong')
					$title="Tài khoản | Tiền thưởng | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			}
			elseif($p=='gioithieu')
				$title="Giới thiệu - Trang mua sắm giày dép online  | Bitas.com.vn";
			elseif($p=='lienhe')
				$title="Thông tin liên hệ của giày dép online Bita’s | Bitas.com.vn";
			elseif($p=='dangki')
				$title="Đăng ký | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='dangnhap')
				$title="Đăng nhập | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='search')
				$title="Tìm kiếm giày dép online Bita’s | Bitas.com.vn";
			elseif($p=='quenpass')
				$title="Quên mật khẩu | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='quenpass_doipass')
				$title="Lấy lại mật khẩu | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='doi_baohanh_map')
				$title="Địa điểm nhận và bảo hành mua giày dép online | Bitas.com.vn ";
			elseif($p=='hethongcuahangle')
				$title="Hệ thống cửa hàng lẻ | Trang mua sắm giày dép chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='chinhsach_baomat')
				$title="Chính sách bảo mật thông tin mua giày dép online | Bitas.com.vn";
			elseif($p=='chinhsach_hotrovanchuyen')
				$title="Chính sách hỗ trợ vận chuyển mua giày online | Bitas.com.vn";
			elseif($p=='chinhsach_doihang')
				$title="Chính sách đổi hàng khi mua giày dép online | Bitas.com.vn";
			elseif($p=='chinhsach_baohanh')
				$title="Chính sách bảo hành khi mua giày dép online | Bitas.com.vn";
			elseif($p=='chinhsach_huydonhang')
				$title="Chính sách hủy đơn hàng khi mua giày dép online | Bitas.com.vn";
			elseif($p=='huongdan_muahang')
				$title="Hướng dẫn mua giày dép online | Bitas.com.vn";
			elseif($p=='huongdan_thanhtoan')
				$title="Hướng dẫn thanh toán | Trang mua sắm giày chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='huongdan_chonsize')
				$title="Hướng dẫn chọn size khi mua giày dép online | Bitas.com.vn";
			elseif($p=='baochitruyenthong')
				$title="Báo chí – Truyền thông | Bitas.com.vn";
			elseif($p=='faq')
				$title="Giải đáp thắc mắc khi mua giày dép online | Bitas.com.vn";
			elseif($p=='quayso')
				$title="Quay số trúng thưởng | Trang mua sắm giày chính hãng Bita’s | Bitas.com.vn";
			elseif($p=='dieukhoansudung')
				$title="Điều khoản sử dụng | Trang mua sắm giày chính hãng Bita’s | Bitas.com.vn";
			return $title;
		}
		function changeTitle($str){
			$str = $this->stripUnicode($str);
			$str = str_replace("?","",$str);
			$str = str_replace("&","",$str);
			$str = str_replace("'","",$str);		
			$str = str_replace("  "," ",$str);
			$str = trim($str);
			$str = mb_convert_case($str , MB_CASE_LOWER , 'utf-8');
		// MB_CASE_UPPER/MB_CASE_TITLE/MB_CASE_LOWER
			$str = str_replace(" ","-",$str);	
			return $str;
		}
		function stripUnicode($str){
			if(!$str) return false;
			$unicode = array(
			 'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
			 'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			 'd'=>'đ',
			 'D'=>'Đ',
			 'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			 'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			 'i'=>'í|ì|ỉ|ĩ|ị',	  
			 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
			 'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			 'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			 'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			 'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			 'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
			);
			foreach($unicode as $khongdau=>$codau) {
			  $arr = explode("|",$codau);
			  $str = str_replace($arr,$khongdau,$str);
			}
			return $str;
		}
		function rutgonchuoi($noidung,$num)
		{        
				$limit = $num - 1 ;
				$str_tmp = '';
				$arrstr = explode(" ", $noidung);
				if ( count($arrstr) <= $num ) {
					if (strlen($noidung)>(9*$num))
						return substr($noidung,0,(9*$num))."...";
					else
						return $noidung; 
				}
				if (!empty($arrstr))
				{
					for ( $j=0; $j< count($arrstr) ; $j++)
					{
						$str_tmp .= " " . $arrstr[$j];
						if ($j == $limit)
						{  break; }
					}
				}
				if (strlen($str_tmp)>9*$num)
					{
						return substr($str_tmp,0,9*$num)."...";
					}
				return $str_tmp."...";
		}
		function ChuoiNgauNhien($sokytu){
			$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
			for ($i=0; $i < $sokytu; $i++){
				$vitri = mt_rand( 0 ,strlen($chuoi) );
				$giatri.= substr($chuoi,$vitri,1 );
			}
			return $giatri;
		}
		function TimKiem($tukhoa,$pageNum=1,$pageSize=10,&$totalRows,$lang){
			$tukhoa=trim(strip_tags($tukhoa));
			if(get_magic_quotes_gpc()==false){
				$tukhoa=mysql_real_escape_string($tukhoa);
			}
			$totalRows=0;
			$sql="SELECT count(*) FROM nhomsp WHERE (SKU LIKE '%$tukhoa%' OR Ten LIKE '%$tukhoa%' OR MoTa_$lang LIKE '%$tukhoa%' OR ogTitle LIKE '%$tukhoa%' OR ogDesc LIKE '%$tukhoa%') AND AnHien=1 ORDER BY idNSP DESC";
			$kq=mysql_query($sql) or die(mysql_error());
			$row_kq=mysql_fetch_row($kq);
			$totalRows=$row_kq[0];
			$startRow=($pageNum-1)*$pageSize;
			$sql="SELECT * FROM nhomsp WHERE (SKU LIKE '%$tukhoa%' OR Ten LIKE '%$tukhoa%' OR MoTa_$lang LIKE '%$tukhoa%' OR ogTitle LIKE '%$tukhoa%' OR ogDesc LIKE '%$tukhoa%') AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function pagesList($totalRows , $pageNum=1,$pageSize = 16, $offset = 5){
			if($pageSize==0)
				return;
			$baseURL = '';
			parse_str($_SERVER['QUERY_STRING'],$arr);
			unset($arr['pageNum']);
			foreach($arr as $k=> $v) $str.= "&{$k}={$v}";
			$baseURL .="?".$str;
			
			if ($totalRows<=0) return "";
			$totalPages = ceil($totalRows/$pageSize);
			if ($totalPages<=1) return "";
			$firstLink="";  $prevLink="";  $lastLink="";  $nextLink="";
			if ($pageNum > 1) {
				$firstLink = "<li><a href='$baseURL'>Trang đầu</a></li>";
				$prevPage = $pageNum - 1;
				$prevLink="<li><a href='$baseURL&pageNum=$prevPage'>&#8249;</a></li>";
			}
			if ($pageNum < $totalPages) { 
				$lastLink = "<li><a href='$baseURL&pageNum=$totalPages'>Trangcuối</a></li>";
				$nextPage = $pageNum + 1;
				$nextLink = "<li><a href='$baseURL&pageNum=$nextPage'>&#8250;</a></li>";
			} 
			$from = $pageNum - $offset;	
			$to = $pageNum + $offset;
			if ($from <=0) { $from = 1;   $to = $offset*2; }
			if ($to > $totalPages) { $to = $totalPages; }
			$links = "";
			for($j = $from; $j <= $to; $j++) 
			{
				$str=($j==$pageNum)?"<li class='active'><a class='number' href = '$baseURL&pageNum=$j'>$j</a></li>":"<li><a class='number' href = '$baseURL&pageNum=$j'>$j</a></li>";
				$links= $links . $str;
			}
			return $prevLink.$links.$nextLink;
		}
		function pagesList_Discount($totalRows , $pageNum=1,$pageSize = 16, $offset = 5){
			$baseURL = $_SERVER['PHP_SELF'];
			parse_str($_SERVER['QUERY_STRING'],$arr);
			unset($arr['pageNum']);
			foreach($arr as $k=> $v) $str.= "&{$k}={$v}";
			$baseURL .="?".$str;
			if ($totalRows<=0) return "";
			$totalPages = ceil($totalRows/$pageSize);
			if ($totalPages<=1) return "";
			$firstLink="";  $prevLink="";  $lastLink="";  $nextLink="";
			if ($pageNum > 1) {
				$firstLink = "<a href='$baseURL'>Trang đầu</a>";
				$prevPage = $pageNum - 1;
				$prevLink="<a href='$baseURL&pageNum_d=$prevPage'><</a>";
			}
			if ($pageNum < $totalPages) { 
				$lastLink = "<a href='$baseURL&pageNum=$totalPages'>Trangcuối</a>";
				$nextPage = $pageNum + 1;
				$nextLink = "<a href='$baseURL&pageNum_d=$nextPage'>></a>";
			} 
			$from = $pageNum - $offset;	
			$to = $pageNum + $offset;
			if ($from <=0) { $from = 1;   $to = $offset*2; }
			if ($to > $totalPages) { $to = $totalPages; }
			$links = "";
			for($j = $from; $j <= $to; $j++) 
			{
				$str=($j==$pageNum)?"<a class='number page_current' href = '$baseURL&pageNum_d=$j'>$j</a>":"<a class='number' href = '$baseURL&pageNum_d=$j'>$j</a>";
				$links= $links . $str;
			}
			return $prevLink.$links.$nextLink;
		}
		function checkEmailPass($email,$pass){
			$sql="SELECT * FROM user WHERE Email='$email' AND password='$pass'";
			$re=mysql_query($sql) or die(mysql_error());
			$row_re=mysql_fetch_row($re);
			if($row_re[0]>=1)
				return true;
			else
				return false;
		}
		/*------END_GENERAL-----*/
		/*------INFO-----*/
		function detailInfo(){
			$sql="SELECT * FROM info WHERE idInfo=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		/*------END INFO-----*/
		/*------123PAY-----*/	
			function createOrder(){
				include '123pay/rest.client.class.php';
				include '123pay/common.class.php';
				function createUniqueOrderId($orderIdPrefix)
				{
					return $orderIdPrefix.time();
				}
				$mTransactionID = "BITAS".time();//create new value for $mTransactionID, use for second createOrder
				$this->update123PayTransactionID($mTransactionID);
				$orderIdPrefix = 'micode';
				////////////////////////////prepare data for customer
				$clientIP=$this->getIPAddress();
				$idAB=$_POST['idAB'];
				if($idAB!=""){
					$ab=$this->detailAddressBook($idAB);
					$row_ab=mysql_fetch_assoc($ab);
					$hoten=$row_ab['HoTen'];
					$diachi=$row_ab['DiaChi'];
					$dienthoai=$row_ab['DienThoai'];
					$tinhthanh=$row_ab['idTinh'];
					$quanhuyen=$row_ab['idQuanHuyen'];
					$phuong=$row_ab['idPhuong'];
				}else{
					if($_POST['hoten_re']!="")
						$hoten=$_POST['hoten_re'];
					elseif(isset($_SESSION['id']))
						$hoten=$_SESSION['hoten'];	
					if($_POST['diachi_re']!="")
						$diachi=$_POST['diachi_re'];
					elseif(isset($_SESSION['id']))
						$diachi=$_SESSION['diachi'];	
					if($_POST['dienthoai_re']!="")
						$dienthoai=$_POST['dienthoai_re'];
					elseif(isset($_SESSION['id']))
						$dienthoai=$_SESSION['dienthoai'];		
					if($_POST['tinhthanh_re']!='')
						$tinhthanh=$_POST['tinhthanh_re'];
					elseif(isset($_SESSION['id']))
						$tinhthanh=$_SESSION['tinhthanh'];		
					if($_POST['quanhuyen_re']!='')
						$quanhuyen=$_POST['quanhuyen_re'];
					elseif(isset($_SESSION['id']))
						$quanhuyen=$_SESSION['quanhuyen'];
					if($_POST['phuong_re']!='')
						$phuong=$_POST['phuong_re'];
					elseif(isset($_SESSION['id']))
						$phuong=$_SESSION['phuong'];
				}
				$idDH=$_SESSION['iddh'];
				$maDH=$_SESSION['madh'];
				$idPTTT=$_POST['howtopay'];
				$totalAmount=$this->TongGiaTriDonHang($idDH,$tinhthanh,$quanhuyen,$idPTTT);
				$totalAmount=str_replace(",","",$totalAmount);
				$email=$_SESSION['email'];
				// Chay qua trang ATM or VISA tuy vao PTTT
				if($idPTTT==2)
					$bankcode='123PAY';
				elseif($idPTTT==3)
					$bankcode='123PCC';
				////////////////////////////
				$result = null;
				$resultMessage = '';
				if($_POST)
				{
					//$mTransactionID = createUniqueOrderId($orderIdPrefix);
					$resultMessage = 'Current order id: <strong>'.$mTransactionID.'</strong><br>';
					$aData = array
					(
						'mTransactionID' => $mTransactionID,
						'merchantCode' =>'BITASVN',
						'bankCode' =>$bankcode,
						'totalAmount' =>$totalAmount,
						'clientIP' =>$clientIP,
						'custName' =>$hoten,
						'custAddress' =>$diachi,
						'custGender' =>'U',
						'custDOB' =>'',
						'custPhone' =>$dienthoai,
						'custMail' =>$email,
						'description' =>'thanh toan cho don hang '.$maDH,
						'cancelURL' => 'http://bitas.com.vn/123queryOder.php',
						'redirectURL' => 'http://bitas.com.vn/123queryOder.php',
						'errorURL' => 'http://bitas.com.vn/123queryOder.php',
						'passcode' =>'BITASVNnJuij6s9MsNxNh',
						'checksum' =>'',
						'addInfo' =>''
					);
					$aConfig = array
					(
						'url'=>'https://mi.123pay.vn/createOrder1',
						'key'=>'BITASVNqhcs4H9YNcsZh',
						'passcode'=>'BITASVNnJuij6s9MsNxNh',
						'cancelURL' => 'merchantCancelURL', //fill cancelURL here
						'redirectURL' => 'merchantRedirectURL', //fill redirectURL here
						'errorURL' => 'merchantErrorURL', //fill errorURL here
					);
					try
					{
						$data = Common::callRest($aConfig, $aData);//call 123Pay service
						$result = $data->return;
						if($result['httpcode'] ==  200)
						{
							//call service success do success flow
							if($result[0]=='1')//service return success
							{
								//re-create checksum
								$rawReturnValue = '1'.$result[1].$result[2];
								$reCalChecksumValue = sha1($rawReturnValue.$aConfig['key']);
								if($reCalChecksumValue == $result[3])//check checksum
								{
									$resultMessage .= 'Call service result:<hr>';
									$resultMessage .=  'mTransactionID='.$mTransactionID.'<br>';
									$resultMessage .=  '123PayTransactionID='.$result[1].'<br>';
									$resultMessage .=  'URL='.$result[2].'<br>';
									//call php header to redirect to input card page
									$resultMessage .= '<a style="color:red;font-weight:bold;" href="'.$result[2].'" target="_parent">Click here to go to payment process</a><br>';
									echo'<script>window.location.href="'.$result[2].'"</script>';                                        
														exit();
								}else
								{
									//Call 123Pay service create order fail, return checksum is invalid
									$resultMessage .=  'Return data is invalid<br>';
								}
							}else{
								//Call 123Pay service create order fail, please refer to API document to understand error code list
								//$result[0]=error code, $result[1] = error description
								$resultMessage .=  $result[0].': '.$result[1];
							}
						}else{
							//call service fail, do error flow
							$resultMessage .=  'Call 123Pay service fail. Please recheck your network connection<br>';
						}
					}catch(Exception $e)
					{
						$resultMessage .=  '<pre>';
						$resultMessage .= $e->getMessage();
					}
					//create new orderid
				}
			}
		/*
			function createOrder(){
				include '123pay/rest.client.class.php';
				include '123pay/common.class.php';
				function createUniqueOrderId($orderIdPrefix)
				{
					return $orderIdPrefix.time();
				}
				$mTransactionID = "BITAS".time();//create new value for $mTransactionID, use for second createOrder
				$this->update123PayTransactionID($mTransactionID);
				$orderIdPrefix = 'micode';
				////////////////////////////prepare data for customer
				$clientIP=$this->getIPAddress();
				$idAB=$_POST['idAB'];
				if($idAB!=""){
					$ab=$this->detailAddressBook($idAB);
					$row_ab=mysql_fetch_assoc($ab);
					$hoten=$row_ab['HoTen'];
					$diachi=$row_ab['DiaChi'];
					$dienthoai=$row_ab['DienThoai'];
					$tinhthanh=$row_ab['idTinh'];
					$quanhuyen=$row_ab['idQuanHuyen'];
					$phuong=$row_ab['idPhuong'];
				}else{
					if($_POST['hoten_re']!="")
						$hoten=$_POST['hoten_re'];
					elseif(isset($_SESSION['id']))
						$hoten=$_SESSION['hoten'];	
					if($_POST['diachi_re']!="")
						$diachi=$_POST['diachi_re'];
					elseif(isset($_SESSION['id']))
						$diachi=$_SESSION['diachi'];	
					if($_POST['dienthoai_re']!="")
						$dienthoai=$_POST['dienthoai_re'];
					elseif(isset($_SESSION['id']))
						$dienthoai=$_SESSION['dienthoai'];		
					if($_POST['tinhthanh_re']!='')
						$tinhthanh=$_POST['tinhthanh_re'];
					elseif(isset($_SESSION['id']))
						$tinhthanh=$_SESSION['tinhthanh'];		
					if($_POST['quanhuyen_re']!='')
						$quanhuyen=$_POST['quanhuyen_re'];
					elseif(isset($_SESSION['id']))
						$quanhuyen=$_SESSION['quanhuyen'];
					if($_POST['phuong_re']!='')
						$phuong=$_POST['phuong_re'];
					elseif(isset($_SESSION['id']))
						$phuong=$_SESSION['phuong'];
				}
				$idDH=$_SESSION['iddh'];
				$maDH=$_SESSION['madh'];
				$idPTTT=$_POST['howtopay'];
				$totalAmount=$this->TongGiaTriDonHang($idDH,$quanhuyen,$idPTTT);
				$totalAmount=str_replace(",","",$totalAmount);
				$email=$_SESSION['email'];
				// Chay qua trang ATM or VISA tuy vao PTTT
				if($idPTTT==2)
					$bankcode='123PAY';
				elseif($idPTTT==3)
					$bankcode='123PCC';
				////////////////////////////
				$result = null;
				$resultMessage = '';
				if($_POST)
				{
					//$mTransactionID = createUniqueOrderId($orderIdPrefix);
					$resultMessage = 'Current order id: <strong>'.$mTransactionID.'</strong><br>';
					$aData = array
					(
						'mTransactionID' => $mTransactionID,
						'merchantCode' =>'MICODE',
						'bankCode' =>'123PAY',
						'totalAmount' =>$totalAmount,
						'clientIP' =>$clientIP,
						'custName' =>$hoten,
						'custAddress' =>$diachi,
						'custGender' =>'U',
						'custDOB' =>'',
						'custPhone' =>$dienthoai,
						'custMail' =>$email,
						'description' =>'thanh toan cho don hang '.$maDH,
						'cancelURL' => 'http://bitas.com.vn/123queryOder.php',
						'redirectURL' => 'http://bitas.com.vn/123queryOder.php',
						'errorURL' => 'http://bitas.com.vn/123queryOder.php',
						'passcode' =>'MIPASSCODE',
						'checksum' =>'',
						'addInfo' =>''
					);
					$aConfig = array
					(
						'url'=>'https://sandbox.123pay.vn/miservice/createOrder1',
						'key'=>'MIKEY',
						'passcode'=>'MIPASSCODE',
						'cancelURL' => 'merchantCancelURL', //fill cancelURL here
						'redirectURL' => 'merchantRedirectURL', //fill redirectURL here
						'errorURL' => 'merchantErrorURL', //fill errorURL here
					);
					try
					{
						$data = Common::callRest($aConfig, $aData);//call 123Pay service
						$result = $data->return;
						if($result['httpcode'] ==  200)
						{
							//call service success do success flow
							if($result[0]=='1')//service return success
							{
								//re-create checksum
								$rawReturnValue = '1'.$result[1].$result[2];
								$reCalChecksumValue = sha1($rawReturnValue.$aConfig['key']);
								if($reCalChecksumValue == $result[3])//check checksum
								{
									$resultMessage .= 'Call service result:<hr>';
									$resultMessage .=  'mTransactionID='.$mTransactionID.'<br>';
									$resultMessage .=  '123PayTransactionID='.$result[1].'<br>';
									$resultMessage .=  'URL='.$result[2].'<br>';
									//call php header to redirect to input card page
									$resultMessage .= '<a style="color:red;font-weight:bold;" href="'.$result[2].'" target="_parent">Click here to go to payment process</a><br>';
									echo'<script>window.location.href="'.$result[2].'"</script>';                                        
														exit();
								}else
								{
									//Call 123Pay service create order fail, return checksum is invalid
									$resultMessage .=  'Return data is invalid<br>';
								}
							}else{
								//Call 123Pay service create order fail, please refer to API document to understand error code list
								//$result[0]=error code, $result[1] = error description
								$resultMessage .=  $result[0].': '.$result[1];
							}
						}else{
							//call service fail, do error flow
							$resultMessage .=  'Call 123Pay service fail. Please recheck your network connection<br>';
						}
					}catch(Exception $e)
					{
						$resultMessage .=  '<pre>';
						$resultMessage .= $e->getMessage();
					}
					//create new orderid
				}
			}*/
		/*------END 123PAY-----*/
		/*------EMAIL-----*/
			function emailRegister($email,$hoten){
				require_once "email/smtp.php";
				$title="Bitas.com.vn - Đăng ký tài khoản thành công";
				$content=file_get_contents("email/form/registerSuccessful.php");
				$content=str_replace("{email_address}",$email,$content);
				SendMail("noreply@bitas.com.vn",$email,$title,$content);
			}
			function emailOrderSuccess(){
				include_once "email/smtp.php";
				$idDH=$_SESSION['iddh'];				
				$maDH=$_SESSION['madh'];
				unset($_SESSION['iddh']);
				unset($_SESSION['madh']);
				$title="Bitas.com.vn - Đặt hàng thành công - Đơn hàng ".$maDH;
				$email=$_SESSION['email'];
				$dh=$this->ChiTietDonHang($idDH);
				$row_dh=mysql_fetch_assoc($dh);
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
                    	<td style="color:#6d6e71;font-size:20px">THÔNG BÁO ĐẶT HÀNG THÀNH CÔNG</td>
                    </tr>
                    <tr>';
				$content.='<td>Xin chào, '.$row_kh['HoTen'].'</td>';
                $content.='</tr>
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
						$content.='<td colspan="8" style="border:1px solid #ccc;border-top:0px none; text-align:left; color:#890b14; font-style:italic;">Ghi chú: '.$row_dh['GhiChu_KH'].'</td>';
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
                        	<td>Nếu Quý khách có bất cứ thắc mắc hoặc nhu cầu cần hỗ trợ xin vui lòng gọi chúng tôi qua số hotline:</td>
                        </tr>
                        <tr>
                        	<td><strong>(08) 37 54 39 54</strong> hoặc qua email: <strong>info@bitas.com.vn</strong> chúng tôi sẽ hồi đáp ngay.</td>
                        </tr>
                        <tr>
                        	<td><a href="http://www.bitas.com.vn" style="font-weight:bold;text-decoration:none;">bitas.com.vn</a> hân hạnh được phục vụ Quý khách!</td>
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
				SendMail("noreply@bitas.com.vn",$email,$title,$content);
			}
			function emailOrderSuccess_notify($idDH,$maDH,$email){
				include_once "../email/smtp.php";
				$title="Bitas.com.vn - Đặt hàng thành công - Đơn hàng ".$maDH;
				$dh=$this->ChiTietDonHang($idDH);
				$row_dh=mysql_fetch_assoc($dh);
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
                    	<td style="color:#6d6e71;font-size:20px">THÔNG BÁO ĐẶT HÀNG THÀNH CÔNG</td>
                    </tr>
                    <tr>';
				$content.='<td>Xin chào, '.$row_kh['HoTen'].'</td>';
                $content.='</tr>
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
						$content.='<td colspan="8" style="border:1px solid #ccc;border-top:0px none; text-align:left; color:#890b14; font-style:italic;">Ghi chú: '.$row_dh['GhiChu_KH'].'</td>';
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
                        	<td>Nếu Quý khách có bất cứ thắc mắc hoặc nhu cầu cần hỗ trợ xin vui lòng gọi chúng tôi qua số hotline:</td>
                        </tr>
                        <tr>
                        	<td><strong>(08) 37 54 39 54</strong> hoặc qua email: <strong>info@bitas.com.vn</strong> chúng tôi sẽ hồi đáp ngay.</td>
                        </tr>
                        <tr>
                        	<td><a href="http://www.bitas.com.vn" style="font-weight:bold;text-decoration:none;">bitas.com.vn</a> hân hạnh được phục vụ Quý khách!</td>
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
				SendMail("noreply@bitas.com.vn",$email,$title,$content);
			}
		/*------END_EMAIL-----*/
		/*------ADDRESS_BOOK-----*/
			function addAddressBook(){
				$idUser=$_SESSION['id'];
				$hoten=$_POST['hoten_re'];
				$dienthoai=$_POST['dienthoai_re'];
				$diachi=$_POST['diachi_re'];
				$idTinh=$_POST['tinhthanh_re'];
				$idQH=$_POST['quanhuyen_re'];
				$idPhuong=$_POST['phuong_re'];
				settype($idTinh,"int");
				settype($idQH,"int");
				settype($idPhuong,"int");
				$sql="INSERT INTO address_book (idUser,HoTen,DienThoai,DiaChi,idTinh,idQuanHuyen,idPhuong) VALUES ($idUser,'$hoten','$dienthoai','$diachi',$idTinh,$idQH,$idPhuong)";
				mysql_query($sql) or die(mysql_error());
			}// end addAddressBook
			function addAddressBook_Taikhoan($idUser,&$error){
				$success=true;
				$hoten=$_POST['hoten'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuong=$_POST['phuong'];
				$hoten=trim(strip_tags($hoten));
				$diachi=trim(strip_tags($diachi));
				$dienthoai=trim(strip_tags($dienthoai));
				settype($idUser,"int");
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuong,"int");
				if(get_magic_quotes_gpc()==false){
					$hoten=mysql_real_escape_string($hoten);
					$diachi=mysql_real_escape_string($diachi);
					$dienthoai=mysql_real_escape_string($dienthoai);
				}
				if($hoten==NULL){
					$success = false; 
					$error['hoten'] = "Vui lòng nhập họ tên.";
				}
				if($diachi==NULL){
					$success = false; 
					$error['diachi'] = "Vui lòng nhập địa chỉ.";
				}
				if($tinhthanh==0){
					$success = false; 
					$error['tinhthanh'] = "Vui lòng nhập tỉnh thành.";
				}
				if($quanhuyen==0){
					$success = false; 
					$error['quanhuyen'] = "Vui lòng nhập quận huyện.";
				}
				if($phuong==0){
					$success = false; 
					$error['phuong'] = "Vui lòng nhập phường xã.";
				}
				$mobile_regex_pattern="/\d{10}\d?/";
				if($dienthoai==NULL){
					$success=false;
					$error['dienthoai']="Vui lòng nhập số điện thoại.";
				}elseif(strlen($dienthoai)<10||strlen($dienthoai)>11){
					$success=false;
					$error['dienthoai']="Số điện thoại sai.";
				}elseif(!preg_match($mobile_regex_pattern,$dienthoai)){
					$success=false;
					$error['dienthoai']="Số điện thoại chỉ chấp nhận số.";
				}
				if($success==true){
					$sql="INSERT INTO address_book (idUser,HoTen,DienThoai,DiaChi,idTinh,idQuanHuyen,idPhuong) VALUES ($idUser,'$hoten','$dienthoai','$diachi',$tinhthanh,$quanhuyen,$phuong)";
					mysql_query($sql) or die(mysql_error());
				}
				return $success;
			}// end addAddressBook_Taikhoan
			function editAddressBook($idAB,&$error){
				$success=true;
				$hoten=$_POST['hoten'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuong=$_POST['phuong'];
				$hoten=trim(strip_tags($hoten));
				$diachi=trim(strip_tags($diachi));
				$dienthoai=trim(strip_tags($dienthoai));
				settype($idAB,"int");
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuong,"int");
				if(get_magic_quotes_gpc()==false){
					$hoten=mysql_real_escape_string($hoten);
					$diachi=mysql_real_escape_string($diachi);
					$dienthoai=mysql_real_escape_string($dienthoai);
				}
				if($hoten==NULL){
					$success = false; 
					$error['hoten'] = "Vui lòng nhập họ tên.";
				}
				if($diachi==NULL){
					$success = false; 
					$error['diachi'] = "Vui lòng nhập địa chỉ.";
				}
				if($tinhthanh==0){
					$success = false; 
					$error['tinhthanh'] = "Vui lòng nhập tỉnh thành.";
				}
				if($quanhuyen==0){
					$success = false; 
					$error['quanhuyen'] = "Vui lòng nhập quận huyện.";
				}
				if($phuong==0){
					$success = false; 
					$error['phuong'] = "Vui lòng nhập phường xã.";
				}
				if($dienthoai==NULL){
					$success=false;
					$error['dienthoai']="Vui lòng nhập số điện thoại.";
				}elseif(strlen($dienthoai)<10||strlen($dienthoai)>11){
					$success=false;
					$error['dienthoai']="Số điện thoại sai.";
				}
				if($success==true){
					$sql="UPDATE address_book SET HoTen='$hoten',DiaChi='$diachi',DienThoai='$dienthoai',idTinh=$tinhthanh,idQuanHuyen=$quanhuyen,idPhuong=$phuong WHERE idAB=$idAB";
					mysql_query($sql) or die(mysql_error());
				}
				return $success;
			}// end editAddressBook
			function delAddressBook($idAB){
				$sql="DELETE FROM address_book WHERE idAB=$idAB";
				mysql_query($sql) or die(mysql_error());
			}
			function detailAddressBook($idAB){
				$sql="SELECT * FROM address_book WHERE idAB=$idAB";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function listAddressBook($idUser){
				$sql="SELECT * FROM address_book WHERE idUser=$idUser";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
		/*------END_ADDRESS_BOOK-----*/
		/*------USERS-----*/
			function ChiTietUser($email){
				$sql="SELECT * FROM user WHERE Email='$email'";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ChiTietKH($idKH){
				$sql="SELECT * FROM user WHERE idUser=$idKH";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
		/*------END_USERS-----*/
		/*------ĐƠN HÀNG-----*/
			function LayIDKhuVucTuIdTinhThanh($idTT){
				$sql="SELECT khuvuc.idKV as idKV FROM khuvuc,tinhthanh WHERE tinhthanh.idTinh=$idTT AND tinhthanh.idKV=khuvuc.idKV";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_assoc($kq);
				return $row_kq['idKV'];
			}
			function LayIdKhuVucTuIdUserF($iduser){
				$sql="SELECT khuvuc.idKV as idKV FROM khuvuc,tinhthanh,user WHERE user.idUser=$iduser AND user.idTinh=tinhthanh.idTinh AND tinhthanh.idKV=khuvuc.idKV";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_assoc($kq);
				return $row_kq['idKV'];
			}
			function LayDonHangMoiNhatTheoUser($idUser){
				$sql="SELECT MaDH FROM donhang WHERE idKH=$idUser ORDER BY idDH DESC LIMIT 0,1";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_assoc($kq);
				return $row_kq['MaDH'];
			}
			function KiemTraDHByKVAndDate($idKV,$today){
				$sql="SELECT MaDH FROM donhang WHERE SUBSTRING(MaDH,1,1)=$idKV AND SUBSTRING(MaDH,2,8)='$today'";
				$re=mysql_query($sql) or die(mysql_error());
				$row_re=mysql_num_rows($re);
				return $row_re;
			}
			function SetNewMaDH($idKV,$today){
				$sql="SELECT MaDH FROM donhang WHERE SUBSTRING(MaDH,1,1)=$idKV AND SUBSTRING(MaDH,2,8)='$today' ORDER BY MaDH DESC LIMIT 0,1";//nghi van cho nay k lay dc madh cao nhat
				$re=mysql_query($sql) or die(mysql_error());
				$row_re=mysql_fetch_assoc($re);
				$madh_old=$row_re['MaDH'];
				$inc=substr($madh_old,-4,4);
				$inc=intval($inc);
				$inc++;
				if($inc<10)
					return substr($madh_old,0,9)."000".$inc;
				elseif($inc>=10&&$inc<100)
					return substr($madh_old,0,9)."00".$inc;
				elseif($inc>=100&&$inc<1000)
					return substr($madh_old,0,9)."0".$inc;
				else
					return substr($madh_old,0,9).$inc;
			}
			function update123PayTransactionID($transactionID){
				$idDH=$_SESSION['iddh'];
				$sql="UPDATE donhang SET 123payTransactionID='$transactionID' WHERE idDH=$idDH";
				mysql_query($sql) or die(mysql_error());
			}
			function updateIsPaid($idDH){
				$sql="UPDATE donhang SET isPaid=1 WHERE idDH=$idDH";
				mysql_query($sql) or die(mysql_error());
			}
			function detailOrderByTransactionID($transactionID){
				$sql="SELECT * FROM donhang WHERE 123payTransactionID='$transactionID'";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function updateIsPaidTransactionID($transactionID){
				$sql="UPDATE donhang SET isPaid=1 WHERE 123payTransactionID='$transactionID'";
				mysql_query($sql) or die(mysql_error());
			}
			function ThemDonHang_CTDH(){
				if(!$_SESSION['idPro']||!$_SESSION['SoLuong']){ // check truong hop khach hang dang o trang Thong tin khach hang ma truy cap lai Gio hang va xoa het san pham trong gio hang di
					unset($_SESSION['idPro']);
					unset($_SESSION['SoLuong']);
					return false;
					header("location:http://bitas.com.vn");
				}
				$idUser=$_SESSION['id'];
				$idAB=$_POST['idAB'];
				if($idAB!=""){
					$ab=$this->detailAddressBook($idAB);
					$row_ab=mysql_fetch_assoc($ab);
					$hoten=$row_ab['HoTen'];
					$diachi=$row_ab['DiaChi'];
					$dienthoai=$row_ab['DienThoai'];
					$tinhthanh=$row_ab['idTinh'];
					$quanhuyen=$row_ab['idQuanHuyen'];
					$phuong=$row_ab['idPhuong'];	
				}else{
					if($_POST['hoten_re']!="")
						$hoten=$_POST['hoten_re'];
					elseif(isset($_SESSION['id']))
						$hoten=$_SESSION['hoten'];
					if($_POST['diachi_re']!="")
						$diachi=$_POST['diachi_re'];
					elseif(isset($_SESSION['id']))
						$diachi=$_SESSION['diachi'];
					if($_POST['dienthoai_re']!="")
						$dienthoai=$_POST['dienthoai_re'];
					elseif(isset($_SESSION['id']))
						$dienthoai=$_SESSION['dienthoai'];
					if($_POST['tinhthanh_re']!='')
						$tinhthanh=$_POST['tinhthanh_re'];
					elseif(isset($_SESSION['id']))
						$tinhthanh=$_SESSION['tinhthanh'];
					if($_POST['quanhuyen_re']!='')
						$quanhuyen=$_POST['quanhuyen_re'];
					elseif(isset($_SESSION['id']))
						$quanhuyen=$_SESSION['quanhuyen'];
					if($_POST['phuong_re']!='')
						$phuong=$_POST['phuong_re'];
					elseif(isset($_SESSION['id']))
						$phuong=$_SESSION['phuong'];
				}
				$ghichu=$_POST['ghichu_kh'];
				$idPTTT=$_POST['howtopay'];
				settype($idUser,"int");
				settype($idPTTT,"int");
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuong,"int");
				$hoten=trim(strip_tags($hoten));
				$diachi=trim(strip_tags($diachi));
				$dienthoai=trim(strip_tags($dienthoai));
				if(get_magic_quotes_gpc()==false){
					$hoten=mysql_real_escape_string($hoten);
					$diachi=mysql_real_escape_string($diachi);
					$dienthoai=mysql_real_escape_string($dienthoai);
				}
				//$idKV=1; // ONLY HCM
				$idKV=$this->LayIDKhuVucTuIdTinhThanh($tinhthanh);
				if(!isset($_SESSION['iddh'])){			
					$today=date("Ymd",strtotime("now"));
					$checkDH=$this->KiemTraDHByKVAndDate($idKV,$today);
					if($checkDH==0)
						$madh="$idKV"."$today"."0001";
					else{
						$madh=$this->SetNewMaDH($idKV,$today);
					}
					$sql="INSERT INTO donhang (MaDH,idKH,NgayDH,NguoiNhan,DienThoai,DiaChi,idTinh,idQuanHuyen,idPhuong,idPTTT,idTT,GhiChu_KH) VALUES ('$madh',$idUser,NOW(),'$hoten','$dienthoai','$diachi',$tinhthanh,$quanhuyen,$phuong,$idPTTT,1,'$ghichu')";
					mysql_query($sql) or die(mysql_error());
					$idDH=mysql_insert_id();		
					$_SESSION['madh']=$madh;//create new SESSION for email
					$_SESSION['iddh']=$idDH;//create new SESSION for 123Pay
					$listID=implode(",",$_SESSION['idPro']);
					$sql="SELECT idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham WHERE idSP in ($listID)";
					$sp=mysql_query($sql) or die(mysql_error());
					// ================= PROMOTION ================= //
					$checkPA=$this->checkPromotionActive();
					if($checkPA){
						$activePromotion=$this->getPromotionActiveCode();
						$row_AP=mysql_fetch_assoc($activePromotion);
						$pro_code=$row_AP['code'];
						$promo=$this->detailPromotion($pro_code);
						$row_promo=mysql_fetch_assoc($promo);
					}
					$tiengiam=0;
					$tongtien=0;
					$tongtiengiam=0;
					$sl_giamgia=0;
					$tongsl = 0;
					
					$tienchuagiam = 0;
					$tongtienchuagiam = 0;
					
					while($row_sp=mysql_fetch_assoc($sp))
					{
						$idsp=$row_sp['idSP'];
						$soluong=$_SESSION['SoLuong'][$idsp];
						$tongsl += $soluong;
						$dongia=$row_sp['Gia_vn'];
						$giachuagiam=$row_sp['GiaChuaGiam_vn'];
						$sql="INSERT INTO donhangchitiet (idDH,idSP,SoLuong,Gia,GiaChuaGiam) VALUES ($idDH,$idsp,$soluong,$dongia,$giachuagiam)";
						mysql_query($sql) or die(mysql_error());
						//$this->GiamSoLuongTonKho($idsp,$soluong);
						$this->TangSoLanMua($idsp,$soluong);
						$tongtam=$dongia*$soluong;
						$tongtien+=$tongtam;
						// ================= PROMOTION ================= //
						if($dongia<$giachuagiam){
							$tiengiam=$soluong*$dongia;
							$tongtiengiam+=$tiengiam;
							$sl_giamgia+=$soluong;
						}
						if($checkPA){
							if($pro_code=='SINHNHATCTY2015'){
								if($dongia==$giachuagiam){
									$tienchuagiam=$soluong*$dongia;
									$tongtienchuagiam+=$tienchuagiam;
								}
							}
						}
						if($idPTTT==1){//clear cart session when COD
							unset($_SESSION['idPro'][$idsp]);
							unset($_SESSION['SoLuong'][$idsp]);
						}
					}
					$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
					$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
					if($checkPA){
						/* OPENNING2014
						if($tongtien_khongtinhhanggiamgia>$row_promo['conditionMoney']){
							$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
							mysql_query($sql_t) or die(mysql_error());
						}
						BUYMOREGETMORE
						switch($soluong_khongtinhhanggiamgia){
							case 1:
								break;								
							default:
								$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
						}
						*/
						
						/*QUACHONANG080315
						$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
						mysql_query($sql_t) or die(mysql_error());
						*/
						/*GIAM15
						$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
						mysql_query($sql_t) or die(mysql_error());
						*/
						/* BANHANGTOANQUOC0415
						if($tongtien_khongtinhhanggiamgia>$row_promo['conditionMoney']){
							$checkPlay = $this->CheckDaChoiHayChua($_SESSION['email']);
							if($checkPlay){
								$tt = $this -> GetTienThuong($_SESSION['email']);
								$row_tt = mysql_fetch_assoc($tt);
								$idtt = $row_tt['idTienThuong'];
								$sql_t = "UPDATE donhang SET proCode = '$pro_code',idTienThuong = $idtt WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
								$this->RemoveTienThuong($_SESSION['email']);
							}
						}
						*/
						/* NGAYCUAME2015
						$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
						mysql_query($sql_t) or die(mysql_error());
						*/
						// QUOCTETHIEUNHI2015, SINHNHATCTY2015
						if($row_promo['code']=='SINHNHATCTY2015'){
							$saleoff = $tongtienchuagiam * 0.2;
							$tongtien = $tongtien - $saleoff;
							if((int)$tongtien >= 240000){
								$sql_t="UPDATE donhang SET DuocNhanQua=1 WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
							}
						}elseif($row_promo['code']=='HAPPYHOUR'){
							if($tongtien > $row_promo['conditionMoney']){
								$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
							}
						}elseif($row_promo['code']=='GIAYDEPKHAITRUONG1'){
							$isChild = $this ->checkOrderHasChild($listID);
							if($isChild){
								$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
							}
						}elseif($row_promo['code']=='BEVUONTAMVOI'){
							if($soluong_khongtinhhanggiamgia >= 3){
								$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
							}
						}elseif($row_promo['code']=='QUOCKHANH2015'){
							$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
							mysql_query($sql_t) or die(mysql_error());
						}elseif($row_promo['code']=='TRUNGTHU2015'){
							if($tongtien_khongtinhhanggiamgia >= 100000){
								$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
							}
						}elseif($row_promo['code']=='QUATANGYEUTHUONG'){
							if($tongtien_khongtinhhanggiamgia >= 150000){
								$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
								mysql_query($sql_t) or die(mysql_error());
							}
						}elseif($row_promo['code']=='TRIANNHAGIAO2015' || $row_promo['code']=='NOEL2015' || $row_promo['code']=='DONXUAN2016' || $row_promo['code']=='TETTA2016' || $row_promo['code']=='KHAITRUONG2016' || $row_promo['code']=='832016'){
							$sql_t="UPDATE donhang SET proCode='$pro_code' WHERE idDH=$idDH";
							mysql_query($sql_t) or die(mysql_error());
						}
					}

					$this->UpdateTong($idDH);
				}//end isset($_SESSION['iddh']
				else{
					$idDH=$_SESSION['iddh'];
					$sql="UPDATE donhang SET idPTTT=$idPTTT WHERE idDH=$idDH";
					mysql_query($sql) or die(mysql_error());
					if($idPTTT==1){
						unset($_SESSION['idPro']);
						unset($_SESSION['SoLuong']);
					}
					//echo $_SESSION['iddh']."<br />".$_SESSION['madh'];
					//exit();
				}
			}

			function UpdateTong($idDH){
				$tongtien = $this->TongGiaTriDonHang_ChuaChiPhi($idDH);
				$dhct=$this->DonHangChiTiet($idDH);
				$dh=$this->ChiTietDonHang($idDH);
				$row_dh=mysql_fetch_assoc($dh);
				$idPTTT=$row_dh['idPTTT'];
				$idTinh=$row_dh['idTinh'];
				$idQH=$row_dh['idQuanHuyen'];

				$cpvc=$this->ChiPhiVanChuyen($tongtien,$idTinh,$idQH);
				$tongtien+=$cpvc;
				$pdv=$this->PhiDichVu($tongtien,$idPTTT);

				/*===== PROMOTION =====*/
				$tongtien = $this->TongGiaTriDonHang($idDH,$idTinh,$idQH,$idPTTT);
				$tongtien = str_replace(",","",$tongtien);
				$tongtien = (int)$tongtien;
				$saleoff = $this->PromotionSaleoffCalc($idDH);

				$sql = "UPDATE donhang SET TongGTDH = $tongtien, TongGTKM = $saleoff, TongCPVC = $cpvc, TongPDV = $pdv WHERE idDH=$idDH";
				echo $sql ."<br />";
				mysql_query($sql) or die(mysql_error());
			}
			
			function UpdateTongAll(){
				$sql = "SELECT idDH FROM donhang";
				$dh = mysql_query($sql) or die(mysql_error());
				while($row_dh = mysql_fetch_assoc($dh)){
					$this->UpdateTong($row_dh['idDH']);
				}
			}

			function LayDonHangTheoUser($idKH){
				$sql="SELECT * FROM donhang WHERE idKH=$idKH ORDER BY NgayDH DESC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function TongGiaTriDonHang($idDH,$idTinh,$idQH,$idPTTT){
				$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
				$kq=mysql_query($sql) or die(mysql_error());
				$tongtien=0; $idTG=0;
				while($row_kq=mysql_fetch_assoc($kq)){
					$thanhtien=$row_kq['SoLuong']*$row_kq['Gia'];
					$tongtien+=$thanhtien;
				}
				/*=========== PROMOTION ==========*/
				$dh=$this->ChiTietDonHang($idDH);
				$row_dh=mysql_fetch_assoc($dh);
				$pro_code=$row_dh['proCode'];
				if($pro_code){
					$pro=$this->detailPromotion($pro_code);
					$n_pro=mysql_num_rows($pro);
					$row_pro=mysql_fetch_assoc($pro);
					if($row_pro['code']=="OPENING241214"){
						$promotion_price=$row_pro['conditionMoney'];
						if($tongtien>$promotion_price){
							$tongtien-=$row_pro['reduceMoney'];
						}
					}// OPENING241214
					elseif($row_pro['code']=="BUYMOREGETMORE"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
						switch($soluong_khongtinhhanggiamgia){
							case 1:
								break;
							case 2:
								$tien=0;
								$tongtien=0;
								mysql_data_seek($dhct,0);
								$ii=0;
								while($row_dhct=mysql_fetch_assoc($dhct)){
									if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
									{
										if($ii==0)
											$temp=$row_dhct['Gia'];
										if($row_dhct['Gia']<=$temp)
											$temp=$row_dhct['Gia'];
										$ii++;
									}
									$dongia=$row_dhct['Gia'];
									$soluong=$row_dhct['SoLuong'];
									$tien=$soluong*$dongia;
									$tongtien+=$tien;
								}
								$tiengiam_promo = $temp * 0.3;
								$tongtien = $tongtien - $tiengiam_promo ;
								break;
							case 3:
								$tien=0;
								$tongtien=0;
								mysql_data_seek($dhct,0);
								$ii=0;
								while($row_dhct=mysql_fetch_assoc($dhct)){
									if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
									{
										if($ii==0)
											$temp=$row_dhct['Gia'];
										if($row_dhct['Gia']<=$temp)
											$temp=$row_dhct['Gia'];
										$ii++;
									}
									$dongia=$row_dhct['Gia'];
									$soluong=$row_dhct['SoLuong'];
									$tien=$soluong*$dongia;
									$tongtien+=$tien;
								}
								$tiengiam_promo = $temp * 0.4;
								$tongtien = $tongtien - $tiengiam_promo ;
								break;
							default:
								$tien=0;
								$tongtien=0;
								mysql_data_seek($dhct,0);
								$ii=0;
								while($row_dhct=mysql_fetch_assoc($dhct)){
									if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
									{
										if($ii==0)
											$temp=$row_dhct['Gia'];
										if($row_dhct['Gia']<=$temp)
											$temp=$row_dhct['Gia'];
										$ii++;
									}
									$dongia=$row_dhct['Gia'];
									$soluong=$row_dhct['SoLuong'];
									$tien=$soluong*$dongia;
									$tongtien+=$tien;
								}
								$tiengiam_promo = $temp * 0.5;
								$tongtien = $tongtien - $tiengiam_promo ;
								break;
						}
					}// BUYMOREGETMORE
					elseif($row_pro['code']=="QUACHONANG080315"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
					}// QUACHONANG080315
					elseif($row_pro['code']=="GIAM15"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
					}// GIAM15
					elseif($row_pro['code']=="BANHANGTOANQUOC0415"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
						}
						//PROMOTION
						$gttt = 0;
						if($row_dh['idTienThuong']){
							$tt = $this -> detailTienThuong($row_dh['idTienThuong']);
							$row_tt = mysql_fetch_assoc($tt);
							$gttt = $row_tt['GiaTri'];
						}
						$tongtien = $tongtien - $gttt;
					}// BANHANGTOANQUOC0415
					elseif($row_pro['code']=="NGAYCUAME2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$tiengiam = 0;
						$tongtiengiam_promo = 0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$giachuagiam = $row_dhct['GiaChuaGiam'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							// PROMOTION
							$sql="SELECT loaispgt.idlspgt as idlspgt FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP = $idsp AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
							$sp=mysql_query($sql) or die(mysql_error());
							$row_sp=mysql_fetch_assoc($sp);
							if($dongia == $giachuagiam){
								$idlspgt = $row_sp['idlspgt'];
								if($idlspgt == 1 || $idlspgt == 3){
									$tiengiam = $dongia * 0.2 * $soluong;
								}elseif($idlspgt == 2 || $idlspgt == 4){
									$tiengiam = $dongia * 0.1 * $soluong;
								}
								$tongtiengiam_promo += $tiengiam;
							}
						}
						$tongtien = $tongtien - $tongtiengiam_promo;
					}// NGAYCUAME2015
					elseif($row_pro['code']=="QUOCTETHIEUNHI2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$tiengiam = 0;
						$tongtiengiam_promo = 0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$giachuagiam = $row_dhct['GiaChuaGiam'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							// PROMOTION
							$sql="SELECT loaispgt.idlspgt as idlspgt FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP = $idsp AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
							$sp=mysql_query($sql) or die(mysql_error());
							$row_sp=mysql_fetch_assoc($sp);
							if($dongia == $giachuagiam){
								$idlspgt = $row_sp['idlspgt'];
								if($idlspgt == 1 || $idlspgt == 2){
									$tiengiam = $dongia * 0.19 * $soluong;
								}elseif($idlspgt == 3 || $idlspgt == 4){
									$tiengiam = $dongia * 0.1 * $soluong;
								}
								$tongtiengiam_promo += $tiengiam;
							}
						}
						$tongtien = $tongtien - $tongtiengiam_promo;
					}// QUOCTETHIEUNHI2015
					elseif($row_pro['code']=="SINHNHATCTY2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
					}// SINHNHATCTY2015
					elseif($row_pro['code']=="GIAYDEPKHAITRUONG1"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$listIDSP = array();
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
							
							$lisIDSP[] = $row_dhct['idSP'];
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;

						$listID = implode(",",$lisIDSP);
						$isChild = $this ->checkOrderHasChild($listID);
						if($isChild){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}
					}// GIAYDEPKHAITRUONG1
					elseif($row_pro['code']=="BEVUONTAMVOI"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$listIDSP = array();
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
							
							$lisIDSP[] = $row_dhct['idSP'];
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
						$listID = implode(",",$lisIDSP);
						if($soluong_khongtinhhanggiamgia >=3 ){
							$saleoff = $this -> calcLowestProduct_Admin($listID,$idDH);
							$tongtien = $tongtien - $saleoff;
						}
					}// BEVUONTAMVOI
					elseif($row_pro['code']=="QUOCKHANH2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= $row_pro['conditionMoney']){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}else{
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;	
						}
					}// QUOCKHANH2015
					elseif($row_pro['code']=="TRUNGTHU2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
						}elseif($tongtien_khongtinhhanggiamgia > 200000){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;	
						}
					}// TRUNGTHU2015
					elseif($row_pro['code']=="QUATANGYEUTHUONG"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
						}
					}// QUATANGYEUTHUONG
					elseif($row_pro['code']=="TRIANNHAGIAO2015" || $row_pro['code']=="NOEL2015" || $row_pro['code']=="TETTA2016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= $row_pro['conditionMoney']){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}else{
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;	
						}
					}// TRIANNHAGIAO2015 | NOEL2015 | TETTA2016
					elseif($row_pro['code']=="DONXUAN2016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
							$tongtien = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 50000);
						}elseif($tongtien_khongtinhhanggiamgia >= 500000){
							$tongtien = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 100000);
						}else{
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
						}
					}// DONXUAN2016
					elseif($row_pro['code']=="KHAITRUONG2016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
						if($soluong_khongtinhhanggiamgia > 1){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}elseif($soluong_khongtinhhanggiamgia == 1){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;	
						}
					}// KHAITRUONG2016
					elseif($row_pro['code']=="832016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$listID = "";
						$listQuantity = "";
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$listID .= "," . $idsp;
							$listQuantity .= "," . $soluong;
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
						}
						$listID = trim($listID,",");
						$listQuantity = trim($listQuantity,",");

						$discount = $this->CalcDiscountFor832016($listID,$listQuantity);
						$tongtien = $tongtien - $discount;
					}// 832016
				}// $pro_code
				if($row_pro['code'] != "HAPPYHOUR"){
					$dh = $this -> ChiTietDonHang($idDH);
					$row_dh = mysql_fetch_assoc($dh);
					$cpvc_dh=$row_dh['TongCPVC'];
					$tongtien+=$cpvc_dh;
				}
				$pdv_dh=$this->PhiDichVu($tongtien,$idPTTT);
				$tongtien+=$pdv_dh;
				return number_format($tongtien,0,".",",");				
			}
			function TongGiaTriDonHang_Goc($idDH){
				$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
				$kq=mysql_query($sql) or die(mysql_error());
				$tongtien=0; $idTG=0;
				while($row_kq=mysql_fetch_assoc($kq)){
					$thanhtien=$row_kq['SoLuong']*$row_kq['Gia'];
					$tongtien+=$thanhtien;
				}
				return $tongtien;
			}
			function TongGiaTriDonHang_ChuaChiPhi($idDH){
				$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
				$kq=mysql_query($sql) or die(mysql_error());
				$tongtien=0; $idTG=0;
				while($row_kq=mysql_fetch_assoc($kq)){
					$thanhtien=$row_kq['SoLuong']*$row_kq['Gia'];
					$tongtien+=$thanhtien;
				}
				/*=========== PROMOTION ==========*/
				$dh=$this->ChiTietDonHang($idDH);
				$row_dh=mysql_fetch_assoc($dh);
				$pro_code=$row_dh['proCode'];
				if($pro_code){
					$pro=$this->detailPromotion($pro_code);
					$n_pro=mysql_num_rows($pro);
					$row_pro=mysql_fetch_assoc($pro);
					if($row_pro['code']=="OPENING241214"){
						$promotion_price=$row_pro['conditionMoney'];
						if($tongtien>$promotion_price){
							$tongtien-=$row_pro['reduceMoney'];
						}
					}// OPENING241214
					elseif($row_pro['code']=="BUYMOREGETMORE"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
						switch($soluong_khongtinhhanggiamgia){
							case 1:
								break;
							case 2:
								$tien=0;
								$tongtien=0;
								mysql_data_seek($dhct,0);
								$ii=0;
								while($row_dhct=mysql_fetch_assoc($dhct)){
									if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
									{
										if($ii==0)
											$temp=$row_dhct['Gia'];
										if($row_dhct['Gia']<=$temp)
											$temp=$row_dhct['Gia'];
										$ii++;
									}
									$dongia=$row_dhct['Gia'];
									$soluong=$row_dhct['SoLuong'];
									$tien=$soluong*$dongia;
									$tongtien+=$tien;
								}
								$tiengiam_promo = $temp * 0.3;
								$tongtien = $tongtien - $tiengiam_promo ;
								break;
							case 3:
								$tien=0;
								$tongtien=0;
								mysql_data_seek($dhct,0);
								$ii=0;
								while($row_dhct=mysql_fetch_assoc($dhct)){
									if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
									{
										if($ii==0)
											$temp=$row_dhct['Gia'];
										if($row_dhct['Gia']<=$temp)
											$temp=$row_dhct['Gia'];
										$ii++;
									}
									$dongia=$row_dhct['Gia'];
									$soluong=$row_dhct['SoLuong'];
									$tien=$soluong*$dongia;
									$tongtien+=$tien;
								}
								$tiengiam_promo = $temp * 0.4;
								$tongtien = $tongtien - $tiengiam_promo ;
								break;
							default:
								$tien=0;
								$tongtien=0;
								mysql_data_seek($dhct,0);
								$ii=0;
								while($row_dhct=mysql_fetch_assoc($dhct)){
									if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
									{
										if($ii==0)
											$temp=$row_dhct['Gia'];
										if($row_dhct['Gia']<=$temp)
											$temp=$row_dhct['Gia'];
										$ii++;
									}
									$dongia=$row_dhct['Gia'];
									$soluong=$row_dhct['SoLuong'];
									$tien=$soluong*$dongia;
									$tongtien+=$tien;
								}
								$tiengiam_promo = $temp * 0.5;
								$tongtien = $tongtien - $tiengiam_promo ;
								break;
						}
					}// BUYMOREGETMORE
					elseif($row_pro['code']=="QUACHONANG080315"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
					}
					elseif($row_pro['code']=="GIAM15"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
					}
					elseif($row_pro['code']=="BANHANGTOANQUOC0415"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
						}
						//PROMOTION
						$gttt = 0;
						if($row_dh['idTienThuong']){
							$tt = $this -> detailTienThuong($row_dh['idTienThuong']);
							$row_tt = mysql_fetch_assoc($tt);
							$gttt = $row_tt['GiaTri'];
						}
						$tongtien = $tongtien - $gttt;
					}// BANHANGTOANQUOC0415
					elseif($row_pro['code']=="NGAYCUAME2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$tiengiam = 0;
						$tongtiengiam_promo = 0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$giachuagiam = $row_dhct['GiaChuaGiam'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							// PROMOTION
							$sql="SELECT loaispgt.idlspgt as idlspgt FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP = $idsp AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
							$sp=mysql_query($sql) or die(mysql_error());
							$row_sp=mysql_fetch_assoc($sp);
							if($dongia == $giachuagiam){
								$idlspgt = $row_sp['idlspgt'];
								if($idlspgt == 1 || $idlspgt == 3){
									$tiengiam = $dongia * 0.2 * $soluong;
								}elseif($idlspgt == 2 || $idlspgt == 4){
									$tiengiam = $dongia * 0.1 * $soluong;
								}
								$tongtiengiam_promo += $tiengiam;
							}
						}
						$tongtien = $tongtien - $tongtiengiam_promo;
					}// NGAYCUAME2015
					elseif($row_pro['code']=="QUOCTETHIEUNHI2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$tiengiam = 0;
						$tongtiengiam_promo = 0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$giachuagiam = $row_dhct['GiaChuaGiam'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							// PROMOTION
							$sql="SELECT loaispgt.idlspgt as idlspgt FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP = $idsp AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
							$sp=mysql_query($sql) or die(mysql_error());
							$row_sp=mysql_fetch_assoc($sp);
							if($dongia == $giachuagiam){
								$idlspgt = $row_sp['idlspgt'];
								if($idlspgt == 1 || $idlspgt == 2){
									$tiengiam = $dongia * 0.19 * $soluong;
								}elseif($idlspgt == 3 || $idlspgt == 4){
									$tiengiam = $dongia * 0.1 * $soluong;
								}
								$tongtiengiam_promo += $tiengiam;
							}
						}
						$tongtien = $tongtien - $tongtiengiam_promo;
					}// QUOCTETHIEUNHI2015
					elseif($row_pro['code']=="SINHNHATCTY2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
					}// SINHNHATCTY2015
					elseif($row_pro['code']=="GIAYDEPKHAITRUONG1"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$listIDSP = array();
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
							
							$lisIDSP[] = $row_dhct['idSP'];
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;

						$listID = implode(",",$lisIDSP);
						$isChild = $this ->checkOrderHasChild($listID);
						if($isChild){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}
					}// GIAYDEPKHAITRUONG1
					elseif($row_pro['code']=="BEVUONTAMVOI"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						$listIDSP = array();
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
							
							$lisIDSP[] = $row_dhct['idSP'];
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
						$listID = implode(",",$lisIDSP);
						if($soluong_khongtinhhanggiamgia >=3 ){
							$saleoff = $this -> calcLowestProduct_Admin($listID,$idDH);
							$tongtien = $tongtien - $saleoff;
						}
					}// BEVUONTAMVOI
					elseif($row_pro['code']=="QUOCKHANH2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= $row_pro['conditionMoney']){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}else{
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;	
						}
					}// QUOCKHANH2015
					elseif($row_pro['code']=="TRUNGTHU2015"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
						}elseif($tongtien_khongtinhhanggiamgia > 200000){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;	
						}
					}// TRUNGTHU2015
					elseif($row_pro['code']=="QUATANGYEUTHUONG"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
						}
					}// QUATANGYEUTHUONG
					elseif($row_pro['code']=="TRIANNHAGIAO2015" || $row_pro['code']=="NOEL2015" || $row_pro['code']=="TETTA2016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= $row_pro['conditionMoney']){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}else{
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;	
						}
					}// TRIANNHAGIAO2015 | NOEL2015 | TETTA2016
					elseif($row_pro['code']=="DONXUAN2016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$tongtiengiam=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
							$tongtien = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 50000);
						}elseif($tongtien_khongtinhhanggiamgia >= 500000){
							$tongtien = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 100000);
						}else{
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
						}
					}// DONXUAN2016
					elseif($row_pro['code']=="KHAITRUONG2016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongsl=0;
						$tongtien=0;
						$tongtiengiam=0;
						$sl_giamgia=0;
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongsl+=$soluong;
							$tongtien+=$tien;
							$giachuagiam=$row_dhct['GiaChuaGiam'];
							//PROMOTION
							if($dongia<$giachuagiam){
								$tiengiam=$soluong*$dongia;
								$tongtiengiam+=$tiengiam;
								$sl_giamgia+=$soluong;
							}
						}
						$tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
						$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
						if($soluong_khongtinhhanggiamgia > 1){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
						}elseif($soluong_khongtinhhanggiamgia == 1){
							$tongtien = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;	
						}
					}// KHAITRUONG2016
					elseif($row_pro['code']=="832016"){
						$dhct=$this->DonHangChiTiet($idDH);
						$tongtien=0;
						$listID = "";
						$listQuantity = "";
						while($row_dhct=mysql_fetch_assoc($dhct)){
							$idsp=$row_dhct['idSP'];
							$soluong=$row_dhct['SoLuong'];
							$listID .= "," . $idsp;
							$listQuantity .= "," . $soluong;
							$dongia=$row_dhct['Gia'];
							$tien=$soluong*$dongia;
							$tongtien+=$tien;
						}
						$listID = trim($listID,",");
						$listQuantity = trim($listQuantity,",");

						$discount = $this->CalcDiscountFor832016($listID,$listQuantity);
						$tongtien = $tongtien - $discount;
					}// 832016
				}
				return $tongtien;				
			}
			function ChiTietTiGia($idTG){
				$sql="SELECT * FROM tigia WHERE idTG=$idTG";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function DonHangChiTiet($idDH){
				$sql="SELECT * FROM donhangchitiet WHERE idDH=$idDH";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ChiTietDonHang($idDH){
				$sql="SELECT * FROM donhang WHERE idDH=$idDH";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function LayNSPTuSP($idSP){
				$sql="SELECT nhomsp.Hinh as Hinh,sanpham.Ten as TenSP,sanpham.Size as Size FROM sanpham,nhomsp WHERE sanpham.idNSP=nhomsp.idNSP AND sanpham.idSP=$idSP";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function KiemTraDHTheoUser($idUser){
				$sql="SELECT idDH FROM user,donhang WHERE user.idUser=$idUser AND user.idUser=donhang.idKH";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function KiemTraNoiThanh($idQH){
				$sql="SELECT NoiThanh FROM quanhuyen WHERE idQuanHuyen=$idQH";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_assoc($kq);
				return $row_kq['NoiThanh'];
			}
			function ChiPhiVanChuyen_Old($giatriDH,$idQH){
				$cpvc=0;
				$check_nt=$this->KiemTraNoiThanh($idQH);
				if($check_nt==1){
					if($giatriDH>=300000){
						$cpvc=0;
					}else{
						$cpvc=10000;
					}
				}
				else{
					if($giatriDH>=500000)
						$cpvc=0;
					else
						$cpvc=35000;
				}
				return $cpvc;
			}
			function ChiPhiVanChuyen($giatriDH,$idTinh,$idQH){
				$cpvc=0;
				switch($idTinh){
					case 72:
					case 74:
					case 75:
					case 80:
					case 82:
					case 83:
						$cpvc = 30000;
						break;
					case 1:
					case 77:
					case 70:
					case 60:
					case 87:
					case 92:
					case 86:
					case 48:
					case 49:
					case 27:
					case 30:
					case 33:
					case 26:
					case 46:
						$cpvc = 35000;
						break;
					case 89:
					case 93: 
					case 94:
					case 84:
					case 51:
					case 45:
					case 24:
					case 35:
					case 31:
					case 17:
					case 36:
					case 37:
					case 25:
					case 34:
					case 19:
						$cpvc = 40000;
						break;
					case 95:
					case 6:
					case 20:
						$cpvc = 45000;
						break;
					case 96:
					case 91:
					case 68:
					case 58:
					case 62:
					case 44:
					case 22:
					case 8:
						$cpvc = 50000;
						break;
					case 79:
						$check_nt=$this->KiemTraNoiThanh($idQH);
						if($check_nt==1){
							if($giatriDH>=300000){
								$cpvc=0;
							}else{
								$cpvc=15000;
							}
						}
						else{
							if($giatriDH>=500000)
								$cpvc=0;
							else
								$cpvc=35000;
						}
						break;
					default:
						$cpvc = 55000;
				}
				return $cpvc;
			}
			function PhiDichVu($tongtien,$pttt){
				$pgd=0;
				if($pttt==2){
					$pgd=$tongtien*0.007+1500;
				}
				elseif($pttt==3){
					$pgd=$tongtien*0.03+1500;
				}
				else
					$pgd=0;
				return $pgd;
			}
		/*------END ĐƠN HÀNG-----*/
		/*------USER ONLINE-----*/
			function LuuThongTinSession(){
				$ipAddress = $_SERVER['REMOTE_ADDR'];
				$userAgent = mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']);
				if(isset($_SESSION['email']))
					$username = $_SESSION['email'];
				$lastVisit = time();
				$session_start = time();
				$idSession = session_id();
				$sql = "SELECT idSession FROM sessions WHERE idSession='$idSession'";
				$ses = mysql_query($sql) or die (mysql_error());
				if (mysql_num_rows($ses)>0 ){ // người này có rồi, giờ request lại 
					$sql="UPDATE sessions SET last_visit = $lastVisit, username = '$username' WHERE idSession='$idSession'";
					mysql_query($sql) or die(mysql_error()." : " . $sql);
				} 
				else{ //người này chưa có, mới vào lần đầu
					$sql="INSERT INTO sessions SET idSession = '$idSession', userAgent = '$userAgent', last_visit = $lastVisit, session_start = $session_start, username = '$username',	ipAddress = '$ipAddress'";
					mysql_query($sql) or die(mysql_error());
				}
				
				$sessionTime = 60; //thời gian lưu thông tin 
				$sql="DELETE FROM sessions 
					WHERE unix_timestamp() - last_visit >= $sessionTime * 60";
				mysql_query($sql) or die(mysql_error());
				
			}
			
			function LuuThongKeKhachHang(){
				$ipAddress = $_SERVER['REMOTE_ADDR'];
				$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$referer = $_SERVER["HTTP_REFERER"];
				if(isset($_SESSION['email'])){
					$email = $_SESSION['email'];
				}
				$sessionID = session_id();

				$sql="INSERT INTO thongke_customer SET ipAddress = '$ipAddress', url = '$url', urlReferer = '$referer', time = NOW(), sessionID = '$sessionID',	email = '$email'";
				mysql_query($sql) or die(mysql_error());
				
			}
		/*------END USER ONLINE-----*/
		/*------LOGIN-----*/
			function KTEmail($email){
				$sql="SELECT * FROM user WHERE Email='$email'";
				$re=mysql_query($sql) or die(mysql_error());
				$n=mysql_num_rows($re);
				if($n>=1)
					return true;
				else
					return false;
			}
			function LayThongTinUser($email,$password){
				$sql="SELECT * FROM user WHERE Email='$email' AND password='$password'";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
		/*------END_LOGIN-----*/
		/*------DANG KI-----*/
			function DangKiThanhVien(&$error){
				$success=true;
				//Get Data
				$email=$_POST['email'];
				$pass=$_POST['pass'];
				$repass=$_POST['repass'];
				$gioitinh=$_POST['gioitinh'];
				$hoten=$_POST['hoten'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuong=$_POST['phuong'];
				$ngaysinh=$_POST['ngaysinh'];
				$bantin=$_POST['nhanbantin'];
				//Solve Data
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuong,"int");
				$email=trim(strip_tags($email));
				$pass=trim(strip_tags($pass));
				$repass=trim(strip_tags($repass));
				$hoten=trim(strip_tags($hoten));
				$dienthoai=trim(strip_tags($dienthoai));
				$diachi=trim(strip_tags($diachi));
				$ngaysinh=trim(strip_tags($ngaysinh));
				if (get_magic_quotes_gpc()==false) {
					$email = mysql_real_escape_string($email);
					$pass = mysql_real_escape_string($pass);
					$repass = mysql_real_escape_string($repass);
					$hoten = mysql_real_escape_string($hoten);
					$dienthoai = mysql_real_escape_string($dienthoai);
					$diachi = mysql_real_escape_string($diachi);
					$ngaysinh = mysql_real_escape_string($ngaysinh);
				}
				$diachi=str_replace("'","",$diachi);
				$hoten=str_replace("'","",$hoten);
				$dienthoai=str_replace("'","",$dienthoai);
				$checkEmail=$this->KTEmail($email);
				if($checkEmail==true){
					$success=false;
					$error['email']="Địa chỉ email này đã được đăng kí <a href='quenpass.php'>Quên mật khẩu</a>";
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
				$pass=md5($pass);
				if($success==true)
				{
					if($bantin=="on"){
						if($this->checkEmail($email)==1)
							$this->themEmail($email);
					}
					$sql="INSERT INTO user (Email,password,HoTen,DiaChi,idTinh,idQuanHuyen,idPhuong,DienThoai,NgaySinh,NgayDangKi,GioiTinh,idGroup) VALUES ('$email','$pass','$hoten','$diachi',$tinhthanh,$quanhuyen,$phuong,'$dienthoai','$ngaysinh','$ngaydangki',$gioitinh,3)";
					mysql_query($sql) or die(mysql_error());		
				}
				return $success;
			}
			function DangKiThanhVien_DangNhap(&$error){
				$success=true;
				//Get Data
				$email=$_POST['email'];
				$pass=$_POST['pass'];
				$repass=$_POST['repass'];
				$gioitinh=$_POST['gioitinh'];
				$hoten=$_POST['hoten'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuong=$_POST['phuong'];
				$ngaysinh=$_POST['ngaysinh'];
				$bantin=$_POST['nhanbantin'];
				/*Only HCM
				if($tinhthanh==""&&$_POST['tinhthanh_re']!="")
					$tinhthanh=$_POST['tinhthanh_re'];
				if($quanhuyen==""&&$_POST['quanhuyen_re']!="")
					$quanhuyen=$_POST['quanhuyen_re'];
				if($phuong==""&&$_POST['phuong_re']!="")
					$phuong=$_POST['phuong_re'];
				*/
				//Solve Data
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				$email=trim(strip_tags($email));
				$pass=trim(strip_tags($pass));
				$repass=trim(strip_tags($repass));
				$hoten=trim(strip_tags($hoten));
				$dienthoai=trim(strip_tags($dienthoai));
				$diachi=trim(strip_tags($diachi));
				$ngaysinh=trim(strip_tags($ngaysinh));
				if (get_magic_quotes_gpc()==false) {
					$email = mysql_real_escape_string($email);
					$pass = mysql_real_escape_string($pass);
					$repass = mysql_real_escape_string($repass);
					$hoten = mysql_real_escape_string($hoten);
					$dienthoai = mysql_real_escape_string($dienthoai);
					$diachi = mysql_real_escape_string($diachi);
					$ngaysinh = mysql_real_escape_string($ngaysinh);
				}
				$diachi=str_replace("'","",$diachi);
				$hoten=str_replace("'","",$hoten);
				$dienthoai=str_replace("'","",$dienthoai);
				if ($email==NULL){ 
					$success = false; 
					$error['email'] = "Mời bạn nhập email";
				}elseif (filter_var($email,FILTER_VALIDATE_EMAIL)==FALSE) { 
					$success = false; 
					$error['email']="Vui lòng nhập địa chỉ email hợp lệ.";
				}else{
					$checkEmail=$this->KTEmail($email);
					if($checkEmail==true){
						$success=false;
						$error['email']="Địa chỉ email này đã được đăng kí. <a style='color: #48A6D2; font-weight: bold' href='user/quen-mat-khau/'>Quên mật khẩu?</a>";
					}
				}
				if($pass==NULL){
					$success = false; 
					$error['pass'] = "Vui lòng nhập mật khẩu.";
				}elseif (strlen($pass)<6 ){
					$success = false; 
					$error['pass'] = "Mật khẩu phải nhiều hơn 6 kí tự.";
				} 
				if($repass==NULL){
					$success=false;
					$error['repass'] = "Vui lòng nhập lại mật khẩu.";
				}elseif($repass!=$pass){ 
					$success=false;
					$error['repass'] = "Vui lòng nhập mật khẩu giống nhau.";
				}
				if($hoten==NULL){
					$success=false;
					$error['hoten']="Vui lòng nhập họ tên.";
				}
				if($dienthoai==NULL){
					$success=false;
					$error['dienthoai']="Vui lòng nhập số điện thoại.";
				}elseif(strlen($dienthoai)<10||strlen($dienthoai)>11){
					$success=false;
					$error['dienthoai']="Số điện thoại sai.";
				}
				if($diachi==NULL){
					$success=false;
					$error['diachi']="Vui lòng nhập địa chỉ.";
				}
				if($tinhthanh==NULL){
					$success=false;
					$error['tinhthanh']="Vui lòng chọn tỉnh thành.";
				}
				if($quanhuyen==0){
					$success=false;
					$error['quanhuyen']="Vui lòng chọn quận huyện.";
				}
				if($phuong==0){
					$success=false;
					$error['phuong']="Vui lòng chọn phường xã.";
				}
				if($ngaysinh!=""){
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
							$error['ngaysinh']="Vui lòng nhập Ngày sinh hợp lệ.";
						}
					}
					else
					{
						$success=false;
						$error['ngaysinh']="Vui lòng nhập Ngày sinh hợp lệ.";
					}
				}
				$ngaydangki=date("Y-m-d H:i:s");
				$pass=md5($pass);
				if($success==true)
				{
					if($bantin=="on"){
						if($this->checkEmail($email)==1)
							$this->themEmail($email);
					}
					$sql="INSERT INTO user (Email,password,HoTen,DiaChi,idTinh,idQuanHuyen,idPhuong,DienThoai,NgaySinh,NgayDangKi,GioiTinh,idGroup) VALUES ('$email','$pass','$hoten','$diachi',$tinhthanh,$quanhuyen,$phuong,'$dienthoai','$ngaysinh','$ngaydangki',$gioitinh,3)";
					mysql_query($sql) or die(mysql_error());
					$_SESSION['id']=mysql_insert_id();
					$_SESSION['email']=$email;
					$_SESSION['group']=3;
					$_SESSION['hoten']=$hoten;
					$_SESSION['ngaysinh']=$ngaysinh;
					$_SESSION['gioitinh']=$gioitinh;
					$_SESSION['dienthoai']=$dienthoai;
					$_SESSION['diachi']=$diachi;
					$_SESSION['tinhthanh']=$tinhthanh;
					$_SESSION['quanhuyen']=$quanhuyen;
					$_SESSION['phuong'] = $phuong;
					//send email
					$this->emailRegister($email,$hoten);
				}
				return $success;
			}
			function OnlyTT_HCM(){
				$sql="SELECT idTinh,Ten,idKV FROM tinhthanh WHERE idTinh=79";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ListTinhThanh(){
				$sql="SELECT idTinh,Ten,idKV,idTienThuong FROM tinhthanh WHERE AnHien=1 ORDER BY Ten ASC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ListTinhThanhTruHCM(){
				$sql="SELECT idTinh,Ten,idKV,idTienThuong,CPVC FROM tinhthanh WHERE idTinh NOT IN (79) AND AnHien=1 ORDER BY Ten ASC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ListQuanHuyenByTinhThanh($idTinh){
				$sql="SELECT * FROM quanhuyen WHERE idTinh=$idTinh ORDER BY Ten ASC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ListPhuongByQH($idQH){
				$sql="SELECT * FROM phuong WHERE idQuanHuyen=$idQH ORDER BY Ten ASC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ListTinhThanhDoiTra(){
				$sql="SELECT idTinh,Ten FROM tinhthanh WHERE DoiTra=1 AND AnHien=1 ORDER BY Ten ASC";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function LayQuanHuyenTinhThanhTheoEmail($email){
				$sql="SELECT quanhuyen.Ten as TenQH,quanhuyen.idQuanHuyen as idQH,quanhuyen.type as type, tinhthanh.Ten as TenTT,tinhthanh.idTinh as idTinh,phuong.Ten as TenPhuong,phuong.type as typePhuong,phuong.idPhuong as idPhuong FROM user,tinhthanh,quanhuyen,phuong WHERE Email='$email' AND user.idTinh=tinhthanh.idTinh AND user.idQuanHuyen=quanhuyen.idQuanHuyen AND user.idPhuong=phuong.idPhuong";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ChiTietTinhThanh($idTinh){
				$sql="SELECT idTinh,Ten FROM tinhthanh WHERE idTinh=$idTinh";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ChiTietQuanHuyen($idQH){
				$sql="SELECT idQuanHuyen,Ten,type FROM quanhuyen WHERE idQuanHuyen=$idQH";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function ChiTietPhuong($idPX){
				$sql="SELECT idPhuong,Ten,type FROM phuong WHERE idPhuong=$idPX";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
		/*------END_DANG KI-----*/
		/*------TAI KHOAN-----*/
			function QuenPass(&$error){
				$success=true;
				$email=$_POST['email'];
				trim(strip_tags($email));
				if(get_magic_quotes_gpc()==false)
					$email=mysql_real_escape_string($email);
				if($email==NULL){
					$success=false;
					$error['send-pass']="Vui lòng nhập địa chỉ email.";
					return false;
				}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$error['send-pass'] = "Dạng thức email sai.";
					return false;
				}			
				$checkMail=$this->KTEmail($email);
				if($checkMail==false){
					$success=false;
					$error['send-pass']="Email không tồn tại.";
				}
				if($success==true){
					$rdk=$this->ChuoiNgauNhien(128);
					$sql="UPDATE user SET randomKey='$rdk' WHERE email='$email'";
					mysql_query($sql) or die(mysql_error());	
					//Send email to customer
					require_once "email/smtp.php";
					$subject="Bạn quên mật khẩu?";
					$content=file_get_contents("email/form/changePassword.php");
					$link = "http://www.bitas.com.vn/user/quen-mat-khau-doi-mat-khau/";
					$link = $link . "$rdk/$email/";
					$content=str_replace("{link}",$link,$content);
					$frommail="noreply@bitas.com.vn";
					$tomail="$email";
					SendMail($frommail,$tomail,$subject,$content);
					$_SESSION['thongbao_success']="Chúng tôi đã gửi email cho bạn với những hướng dẫn để thiết lập lại mật khẩu. Hãy kiểm tra hộp thư đến của bạn và bấm vào liên kết được cung cấp.";
				}
				return $success;
			}
			function checkEmailRDK($email,$rdk){
				$email=trim(strip_tags($email));
				$rdk=trim(strip_tags($rdk));
				if(get_magic_quotes_gpc()==false){
					$email=mysql_real_escape_string($email);
					$rdk=mysql_real_escape_string($rdk);
				}
				$sql="SELECT * FROM user WHERE Email='$email' AND randomKey='$rdk'";
				$re=mysql_query($sql) or die(mysql_error());
				$n=mysql_num_rows($re);
				if($n==1)
					return true;
				else
					return false;
			}
			function updateRandomKey($email){
				$rdk=$this->ChuoiNgauNhien(128);
				$sql="UPDATE user set randomKey='$rdk' WHERE Email='$email'";
				mysql_query($sql) or die(mysql_error());
			}
			function change_pass(&$error){
				$success=true;
				$email=$_SESSION['email'];
				$oldpass=$_POST['old_pass'];
				$newpass=$_POST['new_pass'];
				$renewpass=$_POST['renew_pass'];
				$oldpass=trim(strip_tags($oldpass));
				$newpass=trim(strip_tags($newpass));
				$renewpass=trim(strip_tags($renewpass));
				if(get_magic_quotes_gpc()==false){
					$oldpass=mysql_real_escape_string($oldpass);
					$newpass=mysql_real_escape_string($newpass);
					$renewpass=mysql_real_escape_string($renewpass);
				}
				if($oldpass==NULL){
					$success=false;
					$error['oldpass']="Vui lòng nhập mật khẩu cũ.";
				}else{
					$oldpass=md5($oldpass);
					$check=$this->checkEmailPass($email,$oldpass);
					if($check==false)
					{
						$success=false;
						$error['oldpass']="Mật khẩu cũ sai.";
					}
				}
				if($newpass==NULL){
					$success = false; 
					$error['new-password'] = "Vui lòng nhập mật khẩu mới.";
				}elseif (strlen($newpass)<6 ) {
					$success = false; 
					$error['new-password'] = "Mật khẩu phải nhiều hơn 6 kí tự.";
				}else{
					$newpass=md5($newpass);
					if($newpass==$oldpass){
						$success = false; 
						$error['new-password'] = "Mật khẩu mới trùng với mật khẩu củ.";
					}
				}
				if($renewpass==NULL){
					$success=false; 
					$error['re-new-password'] = "Vui lòng nhập lại mật khẩu mới.";
				}else{
					$renewpass=md5($renewpass);
					if($renewpass!=$newpass ){
						$success=false;
						$error['re-new-password'] = "Mật khẩu mới không khớp.";
					}
				}
				if($success==true){
					$sql="UPDATE user SET password='$newpass' WHERE Email='$email'";
					mysql_query($sql) or die(mysql_error());
				}
				return $success;
			}
			function quen_pass_doi_pass(&$error,$email,$rdk){
				$success=true;
				$pass=$_POST['pass'];
				$repass=$_POST['repass'];
				$pass=trim(strip_tags($pass));
				$repass=trim(strip_tags($repass));
				if(get_magic_quotes_gpc()==false){
					$pass=mysql_real_escape_string($pass);
					$repass=mysql_real_escape_string($repass);
				}
				if($pass==NULL){
					$success = false; 
					$error['pass'] = "Vui lòng nhập mật khẩu mới.";
				}elseif (strlen($pass)<6 ) {
					$success = false; 
					$error['pass'] = "Mật khẩu phải nhiều hơn 6 kí tự.";
				}
				if($repass==NULL){
					$success=false; 
					$error['repass'] = "Vui lòng nhập lại mật khẩu mới.";
				}else{
					$pass=md5($pass);
					$repass=md5($repass);
					if($repass!=$pass ){
						$success=false;
						$error['repass'] = "Mật khẩu mới không khớp.";
					}
				}
				if($success==true){
					$sql="UPDATE user SET password='$pass' WHERE Email='$email' AND randomKey='$rdk'";
					mysql_query($sql) or die(mysql_error());
					$_SESSION['thongbao_success']="Mật khẩu của bạn đã được đổi. Vui lòng đăng nhập.";
				}
				return $success;
			}
			function doithongtin(&$error){
				$success=true;
				$email=$_SESSION['email'];
				$gioitinh=$_POST['gioitinh'];
				$hoten=$_POST['hoten'];
				$ngaysinh=$_POST['ngaysinh'];
				settype($gioitinh,"int");
				$hoten=trim(strip_tags($hoten));
				$ngaysinh=trim(strip_tags($ngaysinh));
				if(get_magic_quotes_gpc()==false){
					$hoten=mysql_real_escape_string($hoten);
					$ngaysinh=mysql_real_escape_string($ngaysinh);
				}
				if($hoten==NULL){
					$success = false; 
					$error['hoten'] = "Vui lòng nhập họ tên.";
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
				if($success==true){
					$sql="UPDATE user SET GioiTinh=$gioitinh,HoTen='$hoten',NgaySinh='$ngaysinh' WHERE Email='$email'";
					mysql_query($sql) or die(mysql_error());
					$_SESSION['gioitinh']=$gioitinh;
					$_SESSION['hoten']=$hoten;
					$_SESSION['ngaysinh']=$ngaysinh;
				}
				return $success;
			}
			function doidiachi(&$error){
				$success=true;
				$email=$_SESSION['email'];
				$diachi=$_POST['diachi'];
				$tinhthanh=$_POST['tinhthanh'];
				$quanhuyen=$_POST['quanhuyen'];
				$phuong=$_POST['phuong'];
				$dienthoai=$_POST['dienthoai'];
				$diachi=trim(strip_tags($diachi));
				$dienthoai=trim(strip_tags($dienthoai));
				settype($tinhthanh,"int");
				settype($quanhuyen,"int");
				settype($phuong,"int");
				if(get_magic_quotes_gpc()==false){
					$diachi=mysql_real_escape_string($diachi);
					$dienthoai=mysql_real_escape_string($dienthoai);
				}
				if($diachi==NULL){
					$success = false; 
					$error['diachi'] = "Vui lòng nhập địa chỉ.";
				}
				if($tinhthanh==0){
					$success = false; 
					$error['tinhthanh'] = "Vui lòng nhập tỉnh thành.";
				}
				if($quanhuyen==0){
					$success = false; 
					$error['quanhuyen'] = "Vui lòng nhập quận huyện.";
				}
				if($phuong==0){
					$success = false; 
					$error['phuong'] = "Vui lòng nhập phường xã.";
				}
				if($dienthoai==NULL){
					$success=false;
					$error['dienthoai']="Vui lòng nhập số điện thoại.";
				}elseif(strlen($dienthoai)<10||strlen($dienthoai)>11){
					$success=false;
					$error['dienthoai']="Số điện thoại sai.";
				}
				if($success==true){
					$sql="UPDATE user SET DiaChi='$diachi',DienThoai='$dienthoai',idTinh=$tinhthanh,idQuanHuyen=$quanhuyen,idPhuong=$phuong WHERE Email='$email'";
					mysql_query($sql) or die(mysql_error());
					$_SESSION['diachi']=$diachi;
					$_SESSION['dienthoai']=$dienthoai;
				}
				return $success;
			}
		/*------END_TAI KHOAN-----*/
		/*------Delivery_System-----*/
			function listAllDeliverySystemCN(){
				$sql="SELECT Ten,DiaChi,DienThoai,Email,Fax,Lat,Lng,ThuTu,shortName From hethongphanphoi WHERE idLHTPP=1 AND AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllStore(){
				$sql="SELECT Ten,DiaChi,DienThoai,Email,Fax,Lat,Lng,ThuTu,shortName From hethongphanphoi WHERE AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllDeliverySystemDL(){
				$sql="SELECT idHTPP,Ten,DiaChi From hethongphanphoi WHERE idLHTPP=2 AND AnHien=1 ORDER BY ThuTu DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllCity(){
				$sql="SELECT idTinh,Ten FROM tinhthanh WHERE AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listCityHasStore(){
				$sql="SELECT idTinh,Ten FROM tinhthanh WHERE AnHien=1 AND hasStore=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listCityDoiTra(){
				$sql="SELECT idTinh,Ten FROM tinhthanh WHERE AnHien=1 AND DoiTra=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function loadDLByCity($idTT){
				settype($idTT,"int");
				$sql="SELECT Ten,DiaChi,DienThoai,Email,Fax,Lat,Lng,ThuTu,shortName FROM hethongphanphoi WHERE idTinh=$idTT AND AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function loadDoiTraByCity($idTT){
				settype($idTT,"int");
				$sql="SELECT Ten,DiaChi,DienThoai,Email,Fax,Lat,Lng,ThuTu,shortName FROM hethongphanphoi WHERE idTinh=$idTT AND DoiTra=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
		/*------END_Delivery_system-----*/
		/*------loaitin-----*/
			function LayIdLT($idTin){
				$sql="SELECT idLT FROM tintuc WHERE idTin=$idTin AND AnHien=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
		/*------end_loaitin-----*/
		/*------tintuc-----*/
			function detailBaoChiTruyenThong(){
				$sql="SELECT * FROM loaitin WHERE idLT=1 AND AnHien=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllBaoChiTruyenThong(){
				$sql="SELECT * FROM tintuc WHERE idLT=1 AND AnHien=1 ORDER BY idTin DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllGioiThieu($lang='vn'){
				$sql="SELECT idTin,TieuDe,TomTat,Hinh,NoiDung,NgayDang,NgayCapNhat,idLT,idUser,SoLanXem FROM tintuc WHERE idLT=3 AND (Lang='{$lang}' OR '{$lang}'='') AND AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllTinXaHoi_VN($lang='vn'){
				$sql="SELECT idTin,TieuDe,TomTat,Hinh,NoiDung,NgayDang,NgayCapNhat,idLT,idUser,SoLanXem FROM tintuc WHERE idLT=2 AND (Lang='{$lang}' OR '{$lang}'='') AND AnHien=1 ORDER BY ThuTu DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllTinNoiBo_VN($lang='vn'){
				$sql="SELECT idTin,TieuDe,TomTat,Hinh,NoiDung,NgayDang,NgayCapNhat,idLT,idUser,SoLanXem FROM tintuc WHERE idLT=1 AND (Lang='{$lang}' OR '{$lang}'='') AND AnHien=1 ORDER BY ThuTu DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllTinXaHoi_EN($lang='en'){
				$sql="SELECT idTin,TieuDe,TomTat,Hinh,NoiDung,NgayDang,NgayCapNhat,idLT,idUser,SoLanXem FROM tintuc WHERE idLT=4 AND (Lang='{$lang}' OR '{$lang}'='') AND AnHien=1 ORDER BY ThuTu DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function listAllTinNoiBo_EN($lang='en'){
				$sql="SELECT idTin,TieuDe,TomTat,Hinh,NoiDung,NgayDang,NgayCapNhat,idLT,idUser,SoLanXem FROM tintuc WHERE idLT=5 AND (Lang='{$lang}' OR '{$lang}'='') AND AnHien=1 ORDER BY ThuTu DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function ChiTietTin($idTin){
				settype($idTin,'int');
				$sql="SELECT TieuDe,TomTat,Hinh,NoiDung,NgayDang,NgayCapNhat,idLT,idUser,SoLanXem FROM tintuc WHERE idTin=$idTin AND AnHien=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LayTinScroll($lang){
				$sql="SELECT idTin,TieuDe FROM tintuc WHERE (Lang='$lang' OR '$lang'='') AND AnHien=1 ORDER BY idTin DESC LIMIT 0,4";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;				
			}
			function TinLienQuan($idTin){
				$lt=$this->LayIdLT($idTin);
				$row_lt=mysql_fetch_assoc($lt);
				$idLT=$row_lt['idLT'];
				$sql="SELECT idTin,TieuDe,NgayCapNhat FROM tintuc WHERE idLT=$idLT AND idTin<>$idTin AND AnHien=1 ORDER BY idTin DESC LIMIT 0,10";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;				
			}
			function SoLanXem($idTin)
			{
				$sql="UPDATE tintuc SET SoLanXem=SoLanXem+1 WHERE idTin=$idTin";
				mysql_query($sql) or die(mysql_error());
			}
		/*------END_tintuc-----*/
		/*------khuyenmai-----*/
			function KhuyenMai(){
				$sql="SELECT idKM,Ten,TomTat,NoiDung,Hinh,NgayBatDau,NgayKetThuc FROM khuyenmai WHERE AnHien=1 ORDER BY ThuTu DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;		
			}
			function ChiTietKM($idKM){
				settype($idKM,"int");
				$sql="SELECT * FROM khuyenmai WHERE idKM=$idKM AND AnHien=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;	
			}
		/*------END_khuyenmai-----*/
		/*------sanpham-----*/
			function getSLTK($idSP){
				$sql="SELECT SLTK FROM sanpham WHERE idSP=$idSP";
				$re=mysql_query($sql) or die(mysql_error());
				$row_re=mysql_fetch_assoc($re);
				$sltk=$row_re['SLTK'];
				return $sltk;
			}
			function GiamSoLuongTonKho($idSP,$soluong){
				$sltk=$this->getSLTK($idSP);
				if($soluong<=$sltk)
					$sql="UPDATE sanpham SET SLTK=SLTK-$soluong WHERE idSP=$idSP";
				else
					$sql="UPDATE sanpham SET SLTK=0 WHERE idSP=$idSP";
				mysql_query($sql) or die(mysql_error());
			}
			function TangSoLanMua($idSP,$soluong){
				$sql="UPDATE sanpham SET SoLanMua=SoLanMua+$soluong WHERE idSP=$idSP";
				mysql_query($sql) or die(mysql_error());
			}
			function ListLoaiSPGT(){
				$sql="SELECT * FROM loaispgt WHERE AnHien=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LayidlspgtTuTenSEO($lspgt){
				$sql = "SELECT idlspgt FROM loaispgt WHERE Ten_Seo = '$lspgt'";
				$re=mysql_query($sql) or die(mysql_error());
				if(mysql_num_rows($re)==1){
					$row_re = mysql_fetch_assoc($re);
					return $row_re['idlspgt'];
				}
			}
			function LayidlspdsgTuTenSEO($lspdsg){
				$sql = "SELECT idlspdsg FROM loaispdsg WHERE Ten_Seo = '$lspdsg'";
				$re=mysql_query($sql) or die(mysql_error());
				if(mysql_num_rows($re)==1){
					$row_re = mysql_fetch_assoc($re);
					return $row_re['idlspdsg'];
				}
			}			
			function ListLoaiSPDSG($idlspgt){
				$sql="SELECT * FROM loaispdsg WHERE idlspgt=$idlspgt AND AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function TangSoLanXemNSP($idNSP){
				$sql="UPDATE nhomsp SET SoLanXem=SoLanXem+1 WHERE idNSP=$idNSP";
				mysql_query($sql) or die(mysql_error());
			}
			function SanPhamXemNhieu(){
				$sql="SELECT * FROM nhomsp WHERE AnHien=1 ORDER BY SoLanXem DESC LIMIT 0,30";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LaySPTheoOption($option,$pageNum,$pageSize,&$totalRows)
			{
				if($option=='hang-moi')
				{
					$totalRows=0;
					$sql="SELECT count(*) FROM nhomsp WHERE New=1 AND AnHien=1";
					$kq=mysql_query($sql) or die(mysql_error());
					$row_kq=mysql_fetch_row($kq);
					$totalRows=$row_kq[0];
					$startRow=($pageNum-1)*$pageSize;
					if($pageSize!=0)
						$sql="SELECT * FROM nhomsp WHERE New=1 AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					else
						$sql="SELECT * FROM nhomsp WHERE New=1 AND AnHien=1 ORDER BY idNSP DESC";
					$re=mysql_query($sql) or die(mysql_error());
					return $re;
				}
				elseif($option=='hang-giam-gia')
				{
					$totalRows=0;
					$sql="SELECT count(*) FROM nhomsp WHERE Discount=1 AND AnHien=1";
					$kq=mysql_query($sql) or die(mysql_error());
					$row_kq=mysql_fetch_row($kq);
					$totalRows=$row_kq[0];
					$startRow=($pageNum-1)*$pageSize;
					if($pageSize!=0)
						$sql="SELECT * FROM nhomsp WHERE Discount=1 AND AnHien=1 ORDER BY ThuTu DESC LIMIT $startRow,$pageSize";
					else
						$sql="SELECT * FROM nhomsp WHERE Discount=1 AND AnHien=1 ORDER BY ThuTu DESC";
					$re=mysql_query($sql) or die(mysql_error());
					return $re;
				}
			}
			function LaySPTheoOptionVaLSP($option,$lsp,$pageNum,$pageSize,&$totalRows)
			{
				if($option=='hang-moi')
				{
					$totalRows=0;
					/*
					if($lsp=='footwear')
						$sql="SELECT count(*) FROM nhomsp WHERE New=1 AND idlspdsg in (1,4,7,11) AND AnHien=1 ORDER BY idNSP DESC";
					if($lsp=='sandals')
						$sql="SELECT count(*) FROM nhomsp WHERE New=1 AND idlspdsg in (2,5,8,12) AND AnHien=1 ORDER BY idNSP DESC";
					if($lsp=='shoes')
						$sql="SELECT count(*) FROM nhomsp WHERE New=1 AND idlspdsg in (3,6,9,13) AND AnHien=1 ORDER BY idNSP DESC";
					if($lsp=='fashion')
						$sql="SELECT count(*) FROM nhomsp WHERE New=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC";
						*/
					if($lsp=='be-gai')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=1 AND nhomsp.AnHien=1";
					if($lsp=='be-trai')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=2 AND nhomsp.AnHien=1";
					if($lsp=='nu')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=3 AND nhomsp.AnHien=1";
					if($lsp=='nam')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=4 AND nhomsp.AnHien=1";
					if($lsp=='thoi-trang')
						$sql="SELECT count(*) FROM nhomsp WHERE New=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC";
					$kq=mysql_query($sql) or die(mysql_error());
					$row_kq=mysql_fetch_row($kq);
					$totalRows=$row_kq[0];
					$startRow=($pageNum-1)*$pageSize;
					if($pageSize!=0)
					{
						/*
						if($lsp=='footwear')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (1,4,7,11) AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
						if($lsp=='sandals')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (2,5,8,12) AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
						if($lsp=='shoes')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (3,6,9,13) AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
						if($lsp=='fashion')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
							*/
					if($lsp=='be-gai')
						$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=1 AND nhomsp.AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					if($lsp=='be-trai')
						$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=2 AND nhomsp.AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					if($lsp=='nu')
						$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=3 AND nhomsp.AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					if($lsp=='nam')
						$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=4 AND nhomsp.AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					if($lsp=='thoi-trang')
						$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					}
					else
					{
						/*	
						if($lsp=='footwear')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (1,4,7,11) AND AnHien=1 ORDER BY idNSP DESC";
						if($lsp=='sandals')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (2,5,8,12) AND AnHien=1 ORDER BY idNSP DESC";
						if($lsp=='shoes')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (3,6,9,13) AND AnHien=1 ORDER BY idNSP DESC";
						if($lsp=='fashion')
							$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC";
							*/
						if($lsp=='be-gai')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=1 AND nhomsp.AnHien=1 ORDER BY idNSP DESC";
						if($lsp=='be-trai')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=2 AND nhomsp.AnHien=1 ORDER BY idNSP DESC";
						if($lsp=='nu')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=3 AND nhomsp.AnHien=1 ORDER BY idNSP DESC";
						if($lsp=='nam')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE New=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=4 AND nhomsp.AnHien=1 ORDER BY idNSP DESC";
					if($lsp=='thoi-trang')
						$sql="SELECT * FROM nhomsp WHERE New=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC";
					}
					$re=mysql_query($sql) or die(mysql_error());
					return $re;
				}
				elseif($option=='hang-giam-gia')
				{
					$totalRows=0;
					if($lsp=='be-gai')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=1 AND nhomsp.AnHien=1";
					if($lsp=='be-trai')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=2 AND nhomsp.AnHien=1";
					if($lsp=='nu')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=3 AND nhomsp.AnHien=1";
					if($lsp=='nam')
						$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=4 AND nhomsp.AnHien=1";
					if($lsp=='thoi-trang')
						$sql="SELECT count(*) FROM nhomsp WHERE Discount=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC";
					$kq=mysql_query($sql) or die(mysql_error());
					$row_kq=mysql_fetch_row($kq);
					$totalRows=$row_kq[0];
					$startRow=($pageNum-1)*$pageSize;
					if($pageSize!=0)
					{
						if($lsp=='be-gai')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=1 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC LIMIT $startRow,$pageSize";
						if($lsp=='be-trai')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=2 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC LIMIT $startRow,$pageSize";
						if($lsp=='nu')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=3 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC LIMIT $startRow,$pageSize";
						if($lsp=='nam')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=4 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC LIMIT $startRow,$pageSize";
						if($lsp=='thoi-trang')
							$sql="SELECT * FROM nhomsp WHERE Discount=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
					}
					else
					{
						if($lsp=='be-gai')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=1 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC";
						if($lsp=='be-trai')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=2 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC";
						if($lsp=='nu')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=3 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC";
						if($lsp=='nam')
							$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,MoTa_vn,MoTa_en,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,nhomsp.idlspdsg as idlspdsg,NguoiTao,nhomsp.ThuTu as ThuTu,nhomsp.AnHien as AnHien FROM nhomsp,loaispdsg,loaispgt WHERE Discount=1 AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt AND loaispgt.idlspgt=4 AND nhomsp.AnHien=1 ORDER BY ThuTu DESC";
						if($lsp=='thoi-trang')
							$sql="SELECT * FROM nhomsp WHERE Discount=1 AND idlspdsg in (10,14) AND AnHien=1 ORDER BY idNSP DESC";
					}
					$re=mysql_query($sql) or die(mysql_error());
					return $re;
				}
			}
			function LaySPTheoLoaiDSG($idLoaispDSG,$pageNum,$pageSize,&$totalRows)
			{
				settype($idLoaispDSG,"int");
				$totalRows=0;
				$sql="SELECT count(*) FROM nhomsp WHERE idlspdsg=$idLoaispDSG AND AnHien=1";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_row($kq);
				$totalRows=$row_kq[0];
				$startRow=($pageNum-1)*$pageSize;
				if($pageSize!=0)
					$sql="SELECT * FROM nhomsp WHERE idlspdsg=$idLoaispDSG AND AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
				else
					$sql="SELECT * FROM nhomsp WHERE idlspdsg=$idLoaispDSG AND AnHien=1 ORDER BY idNSP DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LaySPTheoLoaiGT($idLoaispGT,$pageNum,$pageSize,&$totalRows){
				settype($idLoaispGT,"int");
				$totalRows=0;
				$sql="SELECT count(*) FROM nhomsp,loaispdsg,loaispgt WHERE loaispgt.idlspgt=$idLoaispGT AND loaispdsg.idlspgt=loaispgt.idlspgt AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND nhomsp.AnHien=1";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_row($kq);
				$totalRows=$row_kq[0];
				$startRow=($pageNum-1)*$pageSize;
				if($pageSize!=0){
					$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,nhomsp.MoTa_vn as MoTa_vn,nhomsp.MoTa_en as MoTa_en,nhomsp.MoTa_cn as MoTa_cn,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,NguoiTao FROM nhomsp,loaispdsg,loaispgt WHERE loaispgt.idlspgt=$idLoaispGT AND loaispdsg.idlspgt=loaispgt.idlspgt AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND nhomsp.AnHien=1 ORDER BY idNSP DESC LIMIT $startRow,$pageSize";
				}
				else{
					$sql="SELECT idNSP,nhomsp.Ten as Ten,SKU,nhomsp.MoTa_vn as MoTa_vn,nhomsp.MoTa_en as MoTa_en,nhomsp.MoTa_cn as MoTa_cn,NgayTao,NgayCapNhat,follow,idBST,represent,New,Discount,idMau,Size1,Size2,Size3,Gia1_vn,Gia2_vn,Gia3_vn,GiaChuaGiam1_vn,GiaChuaGiam2_vn,GiaChuaGiam3_vn,nhomsp.Hinh as Hinh,SoLanXem,NguoiTao FROM nhomsp,loaispdsg,loaispgt WHERE loaispgt.idlspgt=$idLoaispGT AND loaispdsg.idlspgt=loaispgt.idlspgt AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND nhomsp.AnHien=1 ORDER BY idNSP DESC";
				}
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LayChiTietNSP($idNSP)
			{
				settype($idNSP,"int");
				$sql="SELECT * FROM nhomsp WHERE idNSP=$idNSP";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LaySPTheoNSP($idNSP){
				settype($idNSP,"int");
				$sql="SELECT * FROM sanpham WHERE idNSP=$idNSP AND AnHien=1 ORDER BY ThuTu ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LayHinhAnhModuleZoom($idNSP){
				settype($idNSP,"int");
				$sql="SELECT urlHL,urlHS,urlHT FROM hinh WHERE idNSP=$idNSP ORDER BY idHinh ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LaySPFollow($follow){
				settype($follow,"int");
				$sql="SELECT idNSP,Hinh FROM nhomsp WHERE follow=$follow AND AnHien=1 ORDER BY idNSP ASC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LaySPMoi($pageNum,$pageSize,&$totalRows_new)
			{
				$totalRows_new=0;
				$sql="SELECT count(*) FROM nhomsp WHERE new=1 AND AnHien=1 ORDER BY idNSP DESC";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_row($kq);
				$totalRows_new=$row_kq[0];
				$startPage=($pageNum-1)*$pageSize;
				$sql="SELECT * FROM nhomsp WHERE new=1 AND AnHien=1 ORDER BY idNSP DESC LIMIT $startPage,$pageSize";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LaySPKhuyenMai(){
				$sql="SELECT * FROM nhomsp WHERE Discount=1 AND AnHien=1 ORDER BY idNSP DESC";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			/*
			function LaySPKhuyenMai($pageNum,$pageSize,&$totalRows_discount)
			{
				$totalRows_discount=0;
				$sql="SELECT count(*) FROM nhomsp WHERE Discount=1 AND represent=1 AND AnHien=1 ORDER BY idNSP DESC";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_row($kq);
				$totalRows_discount=$row_kq[0];
				$startPage=($pageNum-1)*$pageSize;
				$sql="SELECT * FROM nhomsp WHERE Discount=1 AND represent=1 AND AnHien=1 ORDER BY idNSP DESC LIMIT $startPage,$pageSize";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			*/
			function LayMauNSP($idNSP){
				$sql="SELECT mau.Ten_vn as Mau_vn,mau.Ten_en as Mau_en FROM nhomsp,mau WHERE nhomsp.idNSP=$idNSP AND nhomsp.idMau=mau.idMau";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LayChiTietLSPGT($idLSPGT){
				$sql="SELECT idlspgt,Ten_Seo,Ten_vn,Ten_en,Title,Hinh FROM loaispgt WHERE idlspgt=$idLSPGT";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function LayChiTietLSPDSG($idLSPDSG){
				$sql="SELECT idlspdsg,Ten_Seo,Ten_vn,Ten_en,idlspgt,Title,Hinh FROM loaispdsg WHERE idlspdsg=$idLSPDSG";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function MayBeYouLike(){
				$sql="SELECT SKU,Hinh,Gia1_vn,GiaChuaGiam1_vn,Ten,idNSP FROM nhomsp WHERE AnHien=1 ORDER BY rand() LIMIT 0,6";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function SanPhamCungLoai($idNSP){
				$sql="SELECT idlspdsg FROM nhomsp WHERE idNSP=$idNSP";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_assoc($kq);
				$idlspdsg=$row_kq['idlspdsg'];
				$sql="SELECT SKU,Hinh,Gia1_vn,GiaChuaGiam1_vn,Ten,idNSP,Size1,Size2 FROM nhomsp WHERE idlspdsg=$idlspdsg AND idNSP!=$idNSP AND AnHien=1 ORDER BY rand() LIMIT 0,4";
				$re=mysql_query($sql) or die("There is an error");
				return $re;	
			}
			function LayChiTietLSPGTFromidSP($idSP){
				$sql="SELECT loaispgt.idlspgt as idlspgt, loaispgt.Ten_Seo as tenlspgt, loaispdsg.Ten_Seo as tenlspdsg FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE sanpham.idSP=$idSP AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt=loaispgt.idlspgt";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;	
			}
		/*------END_sanpham-----*/
		/*------Y KIEN-----*/
			function ListYK($idNSP){
				$sql="SELECT TenKH,NoiDung,NgayYK,TraLoi FROM ykienkhachhang WHERE idNSP=$idNSP AND Duyet=1";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function ListYKMoiNhat(){
				$sql="SELECT ykienkhachhang.idNSP as idNSP,TenKH,NoiDung,Ten,Hinh FROM ykienkhachhang,nhomsp WHERE nhomsp.idNSP=ykienkhachhang.idNSP AND Duyet=1 ORDER BY idYK DESC LIMIT 0,5";
				$re=mysql_query($sql) or die(mysql_error());
				return $re;
			}
			function ThemYK($idNSP){
				//get data
				$TenKH=$_POST['tenkh'];
				$Email=$_POST['email'];
				$Noidung=$_POST['noidung'];
				$NgayYK=date("Y-m-d H:i:s");
				$ip=$_POST['ip'];
				$agent=$_POST['agent'];
				$duyet=0;
				//solve data
				settype($idNSP,"int");
				$TenKH=trim(strip_tags($TenKH));
				$Email=trim(strip_tags($Email));
				$Noidung=trim(strip_tags($Noidung));
				$ip=trim(strip_tags($ip));
				$agent=trim(strip_tags($agent));
				if(get_magic_quotes_gpc()==false)
				{
					$TenKH=mysql_real_escape_string($TenKH);
					$Email=mysql_real_escape_string($Email);
					$Noidung=mysql_real_escape_string($Noidung);
					$ip=mysql_real_escape_string($ip);
					$agent=mysql_real_escape_string($agent);
				}
				//insert data
				$sql="INSERT INTO ykienkhachhang (TenKH,Email,NoiDung,idNSP,NgayYK,IP,Agent,Duyet) VALUES ('$TenKH','$Email','$Noidung',$idNSP,'$NgayYK','$ip','$agent',$duyet)";
				mysql_query($sql) or die(mysql_error());
			}
		/*------END_Y KIEN-----*/
		/*------EMAIL MARKETING-----*/
			function checkEmail($email){
				$email=trim(strip_tags($email));
				if(get_magic_quotes_gpc()==false)
				{
					$email=mysql_real_escape_string($email);	
				}
				$sql="SELECT * FROM emailmarketing WHERE Email='$email'";
				$kq=mysql_query($sql) or die(mysql_error());
				if(mysql_fetch_row($kq)>=1)
					return 0;
				else return 1;
			}
			function themEmail($email){
				$email=trim(strip_tags($email));
				if(get_magic_quotes_gpc()==false)
				{
					$email=mysql_real_escape_string($email);	
				}
				//$ngay=date("Y-m-d H:i:s");
				$sql="INSERT INTO emailmarketing (Email,NgayThem) VALUES ('$email',NOW())";
				mysql_query($sql) or die(mysql_error());
			}
		/*------END EMAIL MARKETING-----*/
		/*------WISHLIST-----*/
			function DemSoSPYeuThich($idUser){
				$sql="SELECT count(*) FROM wishlist WHERE idUser=$idUser";
				$kq=mysql_query($sql) or die(mysql_error());
				$row_kq=mysql_fetch_row($kq);
				return $row_kq[0];
			}
			function listWishList($idUser){
				$sql="SELECT idNSP FROM wishlist WHERE idUser=$idUser";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function LayChiTietNhomSPVaMau($idNSP){
				$sql="SELECT idNSP,Hinh, nhomsp.Ten as Ten, mau.Ten_vn as Mau_vn, mau.Ten_en as Mau_en FROM nhomsp,mau WHERE idNSP=$idNSP AND nhomsp.idMau=mau.idMau";
				$kq=mysql_query($sql) or die(mysql_error());
				return $kq;
			}
			function CheckWishlist($idUser,$idNSP){
				$sql="SELECT * FROM wishlist WHERE idUser=$idUser AND idNSP=$idNSP";
				$kq=mysql_query($sql) or die(mysql_error());
				$row=mysql_num_rows($kq);
				return $row;
			}
		/*------END WISHLIST-----*/
		/*------PTTT-----*/
		function ListPTTT(){
			$sql="SELECT idPTTT,MaPTTT,Ten,MoTa FROM pttt WHERE AnHien=1 ORDER BY ThuTu ASC";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function ChiTietPTTT($idPTTT){
			$sql="SELECT idPTTT,MaPTTT,Ten FROM pttt WHERE idPTTT=$idPTTT AND AnHien=1";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		/*------END PTTT-----*/
		/*------ PROMOTION -----*/
		function checkPromotionActive(){
			$sql="SELECT code FROM promotion WHERE active=1 AND NOW() > startDate AND NOW() < endDate";
			$re=mysql_query($sql) or die(mysql_error());
			$n_re=mysql_num_rows($re);
			return $n_re;
		}
		function getPromotionActiveCode(){
			$sql="SELECT code FROM promotion WHERE active=1 AND NOW() > startDate AND NOW() < endDate";
			$re=mysql_query($sql) or die(mysql_error());
			return $re;
		}
		function checkOrderHasPromotion($idDH,$code){
			$sql="SELECT idDH FROM donhang WHERE idDH=$idDH AND proCode='$code'";
			$re=mysql_query($sql) or die(mysql_error());
			$n_re=mysql_num_rows($re);
			return $n_re;
		}
		function detailPromotion($code){
			$sql="SELECT * FROM promotion WHERE code='$code'";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function DemSoDonHangPro($code){
			$sql="SELECT idDH FROM donhang WHERE proCode='$code'";
			$re=mysql_query($sql) or die(mysql_error());
			$num_re=mysql_num_rows($re);
			return $num_re;
		}
		
		function PromotionSaleoffCalc($idDH){
			$saleoff=0;
			$dh = $this->ChiTietDonHang($idDH);
			$row_dh = mysql_fetch_assoc($dh);
			$pro_code=$row_dh['proCode'];
			if($pro_code){
				$pro=$this->detailPromotion($pro_code);
				$row_pro=mysql_fetch_assoc($pro);
				if($row_pro['code']=="OPENING241214"){// tinh so tien khuyen mai
					$saleoff=$row_pro['reduceMoney'];
				}
				elseif($row_pro['code']=="BUYMOREGETMORE"){
					$dhct=$this->DonHangChiTiet($idDH);
					$tongsl=0;
					$sl_giamgia=0;
					$tiengiam_promo = 0;
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong=$row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];
						$tongsl+=$soluong;
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia<$giachuagiam){
							$sl_giamgia+=$soluong;
						}
					}
					$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
					switch($soluong_khongtinhhanggiamgia){
						case 1:
							break;
						case 2:
							mysql_data_seek($dhct,0);
							$ii=0;
							while($row_dhct=mysql_fetch_assoc($dhct)){
								if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
								{
									if($ii==0)
										$temp=$row_dhct['Gia'];
									if($row_dhct['Gia']<=$temp)
										$temp=$row_dhct['Gia'];
									$ii++;
								}
							}
							$tiengiam_promo = $temp * 0.3;
							break;
						case 3:
							mysql_data_seek($dhct,0);
							$ii=0;
							while($row_dhct=mysql_fetch_assoc($dhct)){
								if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
								{
									if($ii==0)
										$temp=$row_dhct['Gia'];
									if($row_dhct['Gia']<=$temp)
										$temp=$row_dhct['Gia'];
									$ii++;
								}
							}
							$tiengiam_promo = $temp * 0.4;
							break;
						default:
							mysql_data_seek($dhct,0);
							$ii=0;
							while($row_dhct=mysql_fetch_assoc($dhct)){
								if($row_dhct['Gia']==$row_dhct['GiaChuaGiam'])
								{
									if($ii==0)
										$temp=$row_dhct['Gia'];
									if($row_dhct['Gia']<=$temp)
										$temp=$row_dhct['Gia'];
									$ii++;
								}
							}
							$tiengiam_promo = $temp * 0.5;
							break;
					}
					$saleoff=$tiengiam_promo;
				}// BUYMOREGETMORE
				elseif($row_pro['code']=="QUACHONANG080315"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					$saleoff=$tongtienchuagiam * 0.1;
				}// QUACHONANG080315
				elseif($row_pro['code']=="GIAM15"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					$saleoff=$tongtienchuagiam * 0.15;
				}// GIAM15
				elseif($row_pro['code']=="BANHANGTOANQUOC0415"){
					$ctdh=$this->ChiTietDonHang($idDH);
					$row_ctdh = mysql_fetch_assoc($ctdh);
					$idtt = $row_ctdh['idTienThuong'];
					$tt = $this -> detailTienThuong($idtt);
					$row_tt = mysql_fetch_assoc($tt);
					$saleoff=$row_tt['GiaTri'];
				}// BANHANGTOANQUOC0415
				elseif($row_pro['code']=="NGAYCUAME2015"){
					$dhct=$this->DonHangChiTiet($idDH);
					$tiengiam = 0;
					$tongtiengiam_promo = 0;
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$idsp=$row_dhct['idSP'];
						$soluong=$row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];
						$giachuagiam = $row_dhct['GiaChuaGiam'];
						// PROMOTION
						$sql="SELECT loaispgt.idlspgt as idlspgt FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP = $idsp AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
						$sp=mysql_query($sql) or die(mysql_error());
						$row_sp=mysql_fetch_assoc($sp);
						if($dongia == $giachuagiam){
							$idlspgt = $row_sp['idlspgt'];
							if($idlspgt == 1 || $idlspgt == 3){
								$tiengiam = $dongia * 0.2 * $soluong;
							}elseif($idlspgt == 2 || $idlspgt == 4){
								$tiengiam = $dongia * 0.1 * $soluong;
							}
							$tongtiengiam_promo += $tiengiam;
						}
					}
					$saleoff = $tongtiengiam_promo;
				}// NGAYCUAME2015
				elseif($row_pro['code']=="QUOCTETHIEUNHI2015"){
					$dhct=$this->DonHangChiTiet($idDH);
					$tiengiam = 0;
					$tongtiengiam_promo = 0;
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$idsp=$row_dhct['idSP'];
						$soluong=$row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];
						$giachuagiam = $row_dhct['GiaChuaGiam'];
						// PROMOTION
						$sql="SELECT loaispgt.idlspgt as idlspgt FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP = $idsp AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
						$sp=mysql_query($sql) or die(mysql_error());
						$row_sp=mysql_fetch_assoc($sp);
						if($dongia == $giachuagiam){
							$idlspgt = $row_sp['idlspgt'];
							if($idlspgt == 1 || $idlspgt == 2){
								$tiengiam = $dongia * 0.19 * $soluong;
							}elseif($idlspgt == 3 || $idlspgt == 4){
								$tiengiam = $dongia * 0.1 * $soluong;
							}
							$tongtiengiam_promo += $tiengiam;
						}
					}
					$saleoff = $tongtiengiam_promo;
				}// QUOCTETHIEUNHI2015
				elseif($row_pro['code']=="SINHNHATCTY2015"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					$saleoff=$tongtienchuagiam * 0.2;
				}// SINHNHATCTY2015
				elseif($row_pro['code']=="GIAYDEPKHAITRUONG1"){
					$dhct=$this->DonHangChiTiet($idDH);
					$listIDSP = array();
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
						
						$lisIDSP[] = $row_dhct['idSP'];
					}

					$listID = implode(",",$lisIDSP);
					$isChild = $this ->checkOrderHasChild($listID);
					if($isChild){
						$saleoff=$tongtienchuagiam * 0.2;
					}else{
						$saleoff = 0;
					}
				}// GIAYDEPKHAITRUONG1
				elseif($row_pro['code']=="BEVUONTAMVOI"){
					$dhct=$this->DonHangChiTiet($idDH);
					$tongsl=0;
					$sl_giamgia=0;
					$listIDSP = array();
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong=$row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];
						$tongsl+=$soluong;
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia<$giachuagiam){
							$sl_giamgia+=$soluong;
						}
						
						$lisIDSP[] = $row_dhct['idSP'];
					}
					$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
					$listID = implode(",",$lisIDSP);
					if($soluong_khongtinhhanggiamgia >= 3 ){
						$saleoff = $this -> calcLowestProduct_Admin($listID,$idDH);
					}else{
						$saleoff = 0;
					}
				}// BEVUONTAMVOI
				elseif($row_pro['code']=="QUOCKHANH2015"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					if($tienchuagiam >= $row_pro['conditionMoney']){
						$saleoff=$tongtienchuagiam * 0.2;
					}else{
						$saleoff=$tongtienchuagiam * 0.1;
					}
				}// QUOCKHANH2015
				elseif($row_pro['code']=="TRUNGTHU2015"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					if($tongtienchuagiam >= 100000 && $tongtienchuagiam <= 200000){
						$saleoff=$tongtienchuagiam * 0.1;
					}elseif($tongtienchuagiam > 200000){
						$saleoff=$tongtienchuagiam * 0.2;
					}else{
						$saleoff = 0;
					}
				}// TRUNGTHU2015
				elseif($row_pro['code']=="QUATANGYEUTHUONG"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					if($tongtienchuagiam >= 150000 && $tongtienchuagiam < 300000){
						$saleoff=$tongtienchuagiam * 0.1;
					}else{
						$saleoff = 0;
					}
				}// QUATANGYEUTHUONG
				elseif($row_pro['code']=="TRIANNHAGIAO2015" || $row_pro['code']=="NOEL2015" || $row_pro['code']=="TETTA2016"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					if($tongtienchuagiam >= $row_pro['conditionMoney']){
						$saleoff=$tongtienchuagiam * 0.2;
					}else{
						$saleoff=$tongtienchuagiam * 0.1;
					}
				}// DONXUAN2016
				elseif($row_pro['code']=="DONXUAN2016"){
					$dhct=$this->DonHangChiTiet($idDH);
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];						
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}
					}
					if($tongtienchuagiam >= 300000 && $tongtienchuagiam < 500000){
						$saleoff=$tongtienchuagiam * 0.1 + 50000;
					}elseif($tongtienchuagiam >= 500000){
						$saleoff=$tongtienchuagiam * 0.1 + 100000;
					}else{
						$saleoff=$tongtienchuagiam * 0.1;
					}
				}// DONXUAN2016
				elseif($row_pro['code']=="KHAITRUONG2016"){
					$dhct=$this->DonHangChiTiet($idDH);
					$tongsl=0;
					$sl_giamgia=0;
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$soluong = $row_dhct['SoLuong'];
						$dongia=$row_dhct['Gia'];			
						$giachuagiam=$row_dhct['GiaChuaGiam'];
						$tongsl+=$soluong;
						//PROMOTION
						if($dongia==$giachuagiam){
							$tienchuagiam=$soluong*$dongia;
							$tongtienchuagiam+=$tienchuagiam;
						}elseif($dongia<$giachuagiam){
							$sl_giamgia+=$soluong;
						}
					}
					$soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
					if($soluong_khongtinhhanggiamgia > 1){
						$saleoff=$tongtienchuagiam * 0.2;
					}elseif($soluong_khongtinhhanggiamgia == 1){
						$saleoff=$tongtienchuagiam * 0.1;
					}
				}// KHAITRUONG2016
				elseif($row_pro['code']=="832016"){
					$dhct=$this->DonHangChiTiet($idDH);
					$listID = "";
					$listQuantity = "";
					while($row_dhct=mysql_fetch_assoc($dhct)){
						$idsp=$row_dhct['idSP'];
						$soluong=$row_dhct['SoLuong'];
						$listID .= "," . $idsp;
						$listQuantity .= "," . $soluong;
					}
					$listID = trim($listID,",");
					$listQuantity = trim($listQuantity,",");

					$saleoff = $this->CalcDiscountFor832016($listID,$listQuantity);
				}// 832016
				else{
					$saleoff=0;
				}
			}				
			else{
				$saleoff=0;
			}
			
			return $saleoff;
		}
		/*------END PROMOTION-----*/
		/*------TIEN THUONG-----*/
		function detailTienThuong($idTienThuong){
			$sql="SELECT GiaTri FROM tienthuong WHERE idTienThuong=$idTienThuong";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function UpdateTienThuong($idTienThuong,$email){
			$sql = "UPDATE user SET idTienThuong = $idTienThuong WHERE Email = '$email' AND idTienThuong = 0";
			mysql_query($sql) or die(mysql_error());
		}
		function CheckDaChoiHayChua($email){
			$sql = "SELECT idTienThuong FROM user WHERE Email = '$email'";
			$re=mysql_query($sql) or die(mysql_error());
			$row_re=mysql_fetch_assoc($re);
			return $row_re['idTienThuong'];
		}
		function GetTienThuong($email){
			$sql = "SELECT tienthuong.idTienThuong as idTienThuong,GiaTri FROM tienthuong,user WHERE email = '$email' AND user.idTienThuong = tienthuong.idTienThuong";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function RemoveTienThuong($email){
			$sql = "UPDATE user SET idTienThuong = 0 WHERE Email = '$email'";
			mysql_query($sql) or die(mysql_error());
		}
		function ListTienThuongTuTinhThanh(){
			$sql="SELECT GiaTri_Str,tinhthanh.idTienThuong as idTienThuong FROM tinhthanh,tienthuong WHERE tinhthanh.idTienThuong = tienthuong.idTienThuong AND AnHien=1 ORDER BY RAND()";
			$kq=mysql_query($sql) or die(mysql_error());
			return $kq;
		}
		function LuuQuaySo($idTienThuong,$email){
			$user = $this->ChiTietUser($email);
			$row_user = mysql_fetch_assoc($user);
			$ten = $row_user['HoTen'];
			$email = $row_user['Email'];
			$dienthoai = $row_user['DienThoai'];
			$tienthuong = $this->detailTienThuong($idTienThuong);
			$row_tienthuong = mysql_fetch_assoc($tienthuong);
			$sotien = $row_tienthuong['GiaTri'];
			$sql = "INSERT INTO daquay (Ten,Email,DienThoai,ThoiGianQuay,SoTien) VALUES ('$ten','$email','$dienthoai',NOW(),$sotien)";
			mysql_query($sql) or die(mysql_error());
		}
		/*------END TIEN THUONG-----*/
		
		function checkOrderHasChild($listID){
			$isChild = 0;
			$sql = "SELECT loaispgt.idlspgt as idGT,Gia_vn,GiaChuaGiam_vn FROM loaispgt,loaispdsg,nhomsp,sanpham WHERE idSP in ($listID) AND loaispgt.idlspgt = loaispdsg.idlspgt AND loaispdsg.idlspdsg = nhomsp.idlspdsg AND nhomsp.idNSP = sanpham.idNSP";
			$re = mysql_query($sql) or die(mysql_error());
			while($row_re = mysql_fetch_assoc($re)){
				if($row_re['Gia_vn'] == $row_re['GiaChuaGiam_vn']){	
					if($row_re['idGT']==1 || $row_re['idGT']==2){
						$isChild = 1;
					}
				}
			}
			return $isChild;
		}
		
		function calcLowestProduct($listID){
			$lowestPrice = 100000000;
			$sql = "SELECT Gia_vn,GiaChuaGiam_vn FROM sanpham WHERE idSP in ($listID)";
			$re = mysql_query($sql) or die(mysql_error());
			while($row_re = mysql_fetch_assoc($re)){
				if($row_re['Gia_vn'] == $row_re['GiaChuaGiam_vn']){
					if($row_re['Gia_vn'] < $lowestPrice){
						$lowestPrice = $row_re['Gia_vn'];
					}
				}
			}
			return $lowestPrice;
		}
		
		function calcLowestProduct_Admin($listID,$idDH){
			$lowestPrice = 100000000;
			$sql = "SELECT Gia,GiaChuaGiam FROM donhangchitiet WHERE idDH = $idDH AND idSP in ($listID)";
			$re = mysql_query($sql) or die(mysql_error());
			while($row_re = mysql_fetch_assoc($re)){
				if($row_re['Gia'] == $row_re['GiaChuaGiam']){
					if($row_re['Gia'] < $lowestPrice){
						$lowestPrice = $row_re['Gia'];
					}
				}
			}
			return $lowestPrice;
		}
		
		function getOgMetadataProduct($idNSP){
			$sql = "SELECT ogTitle,ogDesc,ogImg FROM nhomsp WHERE idNSP = $idNSP";
			$re = mysql_query($sql) or die(mysql_error());
			return $re;
		}
		
		function getOgMetadataNews($idNews){
			$sql = "SELECT ogTitle,ogDesc,ogImg FROM tintuc WHERE idTin = $idNews";
			$re = mysql_query($sql) or die(mysql_error());
			return $re;
		}
		
		function getIDFromUrl($url){
			$url = trim(strip_tags($url));
			$url_arr = explode('-',$url);
			$id = $url_arr[count($url_arr)-1];
			return $id;
		}
		
		function getOgMetadata($idNSP,$idNews){
			if($idNSP){
				$idNSP = $this->getIDFromUrl($idNSP);
				$ogType = "website";
				$product = $this->getOgMetadataProduct($idNSP);
				$row_product = mysql_fetch_assoc($product);
				$ogTitle = $row_product['ogTitle'];
				$ogDesc = $row_product['ogDesc'];
				$ogImg = $row_product['ogImg'];
			}else if($idNews){
				$ogType = "article";
				$news = $this->getOgMetadataNews($idNews);
				$row_news = mysql_fetch_assoc($news);
				$ogTitle = $row_news['ogTitle'];
				$ogDesc = $row_news['ogDesc'];
				$ogImg = $row_news['ogImg'];
			}
			$ogUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$find = strpos($ogImg,'http');
			if(strpos($ogImg,'http') === false){
				$ogImg = "http://bitas.com.vn" . $ogImg;
			}
			$ogArr = array("ogUrl" => $ogUrl,"ogType" => $ogType,"ogTitle" => $ogTitle,"ogDesc" => $ogDesc,"ogImg" => $ogImg);
			$ogJSON = json_encode($ogArr);
			return $ogJSON;
		}

		/*========== PROMOTION ==========*/
		function ConvertArrIndexToNonIndex($arrIndex){
			$strTemp = implode(",", $arrIndex);
			$arr = explode(",", $strTemp);
			return $arr;
		}

		function IsSaleProduct($productID){
			$isSaleProduct = false;
			$sql = "SELECT Gia_vn, GiaChuaGiam_vn FROM sanpham WHERE idSP = $productID";
			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			if($row['Gia_vn'] < $row['GiaChuaGiam_vn']){
				$isSaleProduct = true;
			}
			return $isSaleProduct;
		}

		function HasFemaleInBasket($productIDArray){
			$hasFemaleInBasket = false;
			for($i = 0; $i < count($productIDArray); $i++){
				$productID = $productIDArray[$i];
				if($this->IsSaleProduct($productID)){
					continue;
				}
				$sql = "SELECT loaispdsg.idlspgt as idGT FROM sanpham, nhomsp, loaispdsg WHERE sanpham.idSP = $productID AND sanpham.idNSP = nhomsp.idNSP AND nhomsp.idlspdsg = loaispdsg.idlspdsg";
				$result = mysql_query($sql) or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				if($row['idGT'] == 1 || $row['idGT'] == 3){
					$hasFemaleInBasket = true;
				}
			}
			return $hasFemaleInBasket;
		}

		function IsFemaleProduct($productID){
			$isFemaleProduct = false;
			$sql = "SELECT loaispdsg.idlspgt as idGT FROM sanpham, nhomsp, loaispdsg WHERE sanpham.idSP = $productID AND sanpham.idNSP = nhomsp.idNSP AND nhomsp.idlspdsg = loaispdsg.idlspdsg";
			$result = mysql_query($sql) or die(mysql_error());
			$row = mysql_fetch_assoc($result);
			if($row['idGT'] == 1 || $row['idGT'] == 3){
				$isFemaleProduct = true;
			}
			return $isFemaleProduct;
		}

		function CalcDiscountFor832016($listID,$listQuatity){
			$arrID = explode(",", $listID);
			$arrQuantity = explode(",", $listQuatity);
			$discount = 0;
			for($i = 0; $i < count($arrID); $i++){
				$productID = $arrID[$i];
				if($this->IsSaleProduct($productID)){
					continue;
				}
				$sql = "SELECT Gia_vn, GiaChuaGiam_vn FROM sanpham WHERE idSP = $productID";
				$result = mysql_query($sql) or die(mysql_error());
				$row = mysql_fetch_assoc($result);
				$isFemaleProduct = $this->IsFemaleProduct($productID);
				$quantity = $arrQuantity[$i];
				if($isFemaleProduct){
					$discount += $row['Gia_vn'] * $quantity * 0.2;
				}else{
					$discount += $row['Gia_vn'] * $quantity * 0.1;
				}
			}
			return $discount;
		}
		/*========== END PROMOTION ==========*/
	}//END_db
?>