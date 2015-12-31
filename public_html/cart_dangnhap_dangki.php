<?php

	if (isset($_POST['submit'])==true){

		$email = $_POST['email'];

		$password = md5($_POST['password']);

		if (get_magic_quotes_gpc()== false) {

			$email=trim(mysql_real_escape_string($email));

			$password=trim(mysql_real_escape_string($password));

		}

	

		$sql = "SELECT * FROM user WHERE Email='$email' AND password ='$password'";

		$user = mysql_query($sql);

	

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

			if(isset($_SESSION['back']))

			{

				$back=$_SESSION['back'];

				unset($_SESSION['back']);

				header("location:$back");

			}

			else

				header("location:http://bitas.com.vn/gio-hang/thong-tin-khach-hang/");

		} 

		else { 

			$_SESSION['error_cart_dn_dk']="Sai email hoặc mật khẩu";

		}

	}	

?>

<script type="text/javascript">

	function noBack(){

		window.history.forward();

	}

</script>

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

		

		//validate formdangnhap

        $('#formdn').validationEngine();

	});

	

</script>



<div id="cart">

    	<ul id="progressbar">

        	<li class="active ok">

            	1 - {Cart}

            </li>

            <li class="active">

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

            <h1 class="title">{Login}/{Register}</h1>

        </div><!--end_cart_title-->



    	<div class="cart_nav">

        	<a href="gio-hang/tong-quan/" class="previous back">{Cart}<span></span></a>

            <a href="gio-hang/thong-tin-khach-hang/" class="next">{Register_Buy}<span>&nbsp;</span></a>

      	</div>

        <div class="clear"></div>

        <div id="login_reg_c">

        	<div id="login_c">

            	<h1 class="title">{Already_Customer}</h1>

                <p>{Plz_Login_To_Buy}</p>

                <a href="user/quen-mat-khau/">{Click_If_Forget}</a>

                <form action="" method="post" id="formdn">

	                <input type="text" name="email" placeholder="Email" class="long validate[required,custom[email]]" />

    	    		<input type="password" name="password" placeholder="Password" class="long validate[required]"  />

        	        <input type="submit" value="{Login}" name="submit" class="action-button" />

                    <div class="cart_error_login">

					<?php

                        if(isset($_SESSION['error_cart_dn_dk']))

                        {

                            echo $_SESSION['error_cart_dn_dk'];

                            unset($_SESSION['error_cart_dn_dk']);

                        }

                    ?>

                    </div>

                </form>

                

            </div>

            <div id="reg_c">

            	<h1 class="title">{First_Time_Shopping}</h1>

                <p>Click <strong>"{Register_Buy}"</strong> {To_Next_Process}</p>

                <p><i>{Your_Info_Will_Create}</i></p>

                <a href="gio-hang/thong-tin-khach-hang/" class="action-button con_cart">{Register_Buy}</a>

            </div>

           

        </div>

        <div class="clear"></div>

    </section>

</div>