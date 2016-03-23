<div class="order-cancel">
<?php session_start();
	if (isset($_SESSION['id'])== false){
		$_SESSION['error_admin']='Bạn chưa đăng nhập';
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
		header('location:login.php'); 
		exit();
	}
	else if ($_SESSION['group']!=1){
		$_SESSION['error_admin']='Bạn không có quyền xem trang này';
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
		header('location:login.php');
		exit();
	}
	
	
	if(isset($_GET['idDH']))
		$idDH=$_GET['idDH'];
	$dh=$i->CheckDHHuy($idDH);
	if($dh)
	{
		if(isset($_POST['huy']))
		{
			$i->HuyDonHang($idDH);
			header("location:index.php");
		}
		
		if(isset($_POST['khonghuy']))
		{
			$i->KhongHuyDonHang($idDH);
			header("location:index.php");
		}
?>

<form action="" method="post" id="adminForm" class="huy-form">
	<textarea name="lydo_huy" class="validate[required]" rows="5" placeholder="Lý do hủy"></textarea>
	<div class="action">
	    <input type="submit" name="huy" value="Hủy" class="red btn" />
	    <input type="submit" name="khong-huy" value="Không hủy" class="btn" />
    </div>
</form>
<?php } else{?>
<h1 class="huy-error">CÓ LỔI XÃY RA - ĐƠN HÀNG ĐÃ ĐƯỢC HỦY HOẶC KHÔNG CÓ YÊU CẦU HỦY CHO ĐƠN HÀNG NÀY</h1>
<?php }?>
</div>