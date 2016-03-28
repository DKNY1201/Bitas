<?php
session_start();
if (isset($_POST['submit'])==true){	
	require_once "../db/classAdmin.php";
	$i=new admin;
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	if (get_magic_quotes_gpc()== false) {
		$email=trim(mysql_real_escape_string($email));
		$password=trim(mysql_real_escape_string($password));
	}
	$sql = "SELECT * FROM user WHERE Email='$email' AND password ='$password'";
	$user = mysql_query($sql) or die(mysql_error());
	if (mysql_num_rows($user)==1) {//Thành công	
		if (isset($_POST['nho'])== true){
			 setcookie("em", $_POST['email'], time() + 60*60*24*7 );
			 setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
		} else {
			 setcookie("em", $_POST['email'], time() -1);
			 setcookie("pw", $_POST['password'], time() -1);
		}
		//Tạo ra các biến session để dùng cho các tác vụ khác
		$row_user = mysql_fetch_assoc($user);
		$_SESSION['id'] = $row_user['idUser'];
		$_SESSION['email'] = $row_user['Email'];
		$_SESSION['group'] = $row_user['idGroup'];
		$_SESSION['hoten'] = $row_user['HoTen'];
		$_SESSION['gioitinh'] = $row_user['GioiTinh'];
		$_SESSION['dienthoai'] = $row_user['DienThoai'];
		$_SESSION['diachi'] = $row_user['DiaChi'];
		$_SESSION['tinhthanh'] = $row_user['idTinh'];
		$_SESSION['quanhuyen'] = $row_user['idQuanHuyen'];
		$_SESSION['phuong'] = $row_user['idPhuong'];
		$_SESSION['ngaysinh'] = $row_user['NgaySinh'];

		$i->UpdateLastLoginDate($row_user['idUser']);

		if (strlen($_SESSION['back'])>0){
			if($row_user['idGroup']==6)
				header("location:index.php?p=cskh_main");
			else{
				$back = $_SESSION['back']; unset($_SESSION['back']);
				header("location:$back");
			}
		} 
		else{ 
			if($row_user['idGroup']==6)
				header("location:index.php?p=cskh_main");
			else
				header("location: index.php");
		}
	} 
	else { //Thất bại
    	header("location: login.php");
  	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Đăng nhập</title>
<link rel="stylesheet" type="text/css" href="../css/admin.css"/>
</head>
<body style="background:url(../img/admin/login_bg.jpg)">
<form id="formLogin" class="box_shadow" name="formLogin" method="POST" action="">
	<div class="login_info">
    	<div class="username">
        	<p><label for="emal">Email</label><a href="#">Thành viên mới?</a></p>
            <input type="text" name="email" class="box_shadow text" tabindex="1" />
        </div>
        <div class="password">
        	<p><label for="password">Mật khẩu</label><a href="#">Quên mật khẩu?</a></p>
            <input type="password" name="password" class="box_shadow text" tabindex="2" />
        </div>
        <div id="error_login">
        	<?php print_r($_SESSION['error_admin'])?>
        </div>
    </div><!--end_login_info-->
    <div class="login_bottom">
    	<div class="re">
	    	<input type="checkbox" name="re" tabindex="3" /><label for="re">Nhớ mật khẩu</label>
        </div>
        <input type="submit" value="Đăng nhập" name="submit" class="submit" tabindex="4" />
    </div>
</form>
</body>
</html>