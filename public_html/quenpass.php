<?php
	if(isset($_POST['send-pass'])){
		$success=$i->QuenPass($error);
		if($success==true)
			header("location:http://bitas.com.vn/user/quen-mat-khau/");
	}
?>
<script>
	$(document).ready(function(e) { 
		//VALIDATE
		$('#formdangki').validationEngine();
	});
</script>
<form id="formdangki" method="post" action="" style="width:500px">
	<h1>{Forget_Pass}</h1>
    <p class="forget-pass-intro">Quý khách vui lòng nhập email hoặc tên đăng nhập, hệ thống sẽ tự động gửi mật mã mới qua email này</p>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
    	<tr>
        	<td class="td_title"><label for="email">{Email}</label> *</td>
            <td class="note"><input type="text" id="email" name="email" class="validate[required,custom[email]] text-input" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
            </td>
            <td><button type="submit" class="btn btn-info btn-pass" name="send-pass">Gởi mật khẩu</button></td>
        </tr>
        <tr>
        	<td></td>
            <td class="note" colspan="2">
            	<?php if(isset($error['send-pass'])==true) {?> 
                	<p style="display:block" class="warning_email" class="box_size"><?php echo $error['send-pass']?></p>
                <?php }?>
                <p id="warning_email" class="box_size"></p>
            </td>
        </tr>
    </table>
</form>