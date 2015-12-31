<?php if(isset($_SESSION['id']))
		header("location:http://www.bitas.com.vn/");
	if(isset($_GET['email'])&&isset($_GET['rdk']))
	{
		$email=$_GET['email'];
		$rdk=$_GET['rdk'];
		$e=$i->checkEmailRDK($email,$rdk);
		if($e){
?>
<script>
	$(document).ready(function(e) {
        $('#formdangki').validationEngine();
    });
</script>
<?php $error=array();
	if(isset($_POST['changepass']))
	{
		$success=$i->quen_pass_doi_pass($error,$email,$rdk);
		if($success==true){
			$i->updateRandomKey($email);
			header("location:http://bitas.com.vn/user/tai-khoan/");
		}
	}
?>
<div class="getpass">
    <form id="formdangki" name="formdangki" method="post" action="">
    	<h1>Lấy lại mật khẩu cho tài khoản: <strong><?php echo $email?></strong></h1>
        <table border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td class="td_title">{Pass} *</td>
                <td>
                    <input id="password" type="password" name="pass" class="validate[required,minSize[6]] text-input" >
                    <?php if(isset($error['pass'])==true) {?> 
                        <p style="display:block" class="warning_email" class="box_size"><?php echo $error['pass']?></p>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td class="td_title">{Repass} *</td>
                <td>
                    <input type="password" name="repass" class="validate[required,minSize[6],equals[password]] text-input" >
                    <?php if(isset($error['repass'])==true) {?> 
                        <p style="display:block" class="warning_email" class="box_size"><?php echo $error['repass']?></p>
                    <?php }?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="changepass" id="dangki" value="Đổi mật khẩu"></td>
            </tr>
    	</table>
    </form>
</div>
<?php }
		else
			header("location:http://bitas.com.vn/user/dang-nhap/");
	}
	else
		header("location:http://bitas.com.vn/user/dang-nhap/");
?>