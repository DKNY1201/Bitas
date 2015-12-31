<?php
	if(isset($_SESSION['id']))
		header("location:http://bitas.com.vn/user/tai-khoan/");
?>
<script>
$(document).ready(function(e) {
	$("#ngaysinh").datepicker({
		dateFormat: 'dd/mm/yy',
		maxDate: '-10Y',
	});
	//VALIDATE
	$('#formdangki').validationEngine();
	//Load Quan Huyen
	$("#tt").change(function(e) {
		var idTT=$(this).val();
        $("#qh").load("ajax_load_quanhuyen.php?idTT="+idTT);
    });
	$("#qh").change(function(e) {
		var idQH=$(this).val();
        $("#px").load("ajax_load_phuongxa.php?idQH="+idQH);
    });
});
</script>
<?php
	$error=array();
	$tt=$i->ListTinhThanh();
	if(isset($_POST['dangki']))
	{
		$success=$i->DangKiThanhVien_DangNhap($error);
		if($success==true)
			header("location:http://bitas.com.vn/user/tai-khoan/");	
	}
?>
<form id="formdangki" name="formdangki" method="post" action="">
	<h1>{Register} {Account}</h1>
	<table border="0" cellpadding="0" cellspacing="0">
    	<tr>
        	<td class="td_title"><label for="email">{Email}</label> *</td>
            <td class="note"><input type="text" id="email" name="email" class="validate[required,custom[email]] text-input" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
            </td>
        </tr>
        <tr>
        	<td></td>
            <td class="note">
            <?php if(isset($error['email'])==true) {?> 
			<p style="display:block" class="warning_email box_size"><?php echo $error['email']?></p>
			<?php }?>
            <i>{Email_Confirm_Text}</i>
            </td>
        </tr>
        <tr>
        	<td class="td_title">{Pass} *</td>
            <td>
            	<input id="password" type="password" name="pass" class="validate[required,minSize[6]] text-input" >
                <?php if(isset($error['pass'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['pass']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td class="td_title">Gõ lại mật khẩu *</td>
            <td>
            	<input type="password" name="repass" class="validate[required,minSize[6],equals[password]] text-input" >
                <?php if(isset($error['repass'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['repass']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td class="td_header">{Additional_Info}</td>
            <td></td>
        </tr>
        <tr>
        	<td class="td_title">{Sex}</td>
            <td>
            <input type="radio" name="gioitinh" value="0" checked="checked"><label class="radioLabel" for="gioitinh">{Women}</label>
            <input type="radio" name="gioitinh" value="1"><label class="radioLabel" for="gioitinh">{Men}</label></td>
        </tr>
        <tr>
        	<td class="td_title">{Fullname} *</td>
            <td class="note">
            	<input type="text" name="hoten" class="validate[required] text-input" value="<?php if(isset($_POST['hoten'])) echo $_POST['hoten']?>" >
                <?php if(isset($error['hoten'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['hoten']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td class="td_title">{Tel} *</td>
            <td class="note">
            	<input type="text" name="dienthoai" maxlength="11" class="validate[required,minSize[10],maxSize[11],custom[phone]] text-input" value="<?php if(isset($_POST['dienthoai'])) echo $_POST['dienthoai']?>">
            	<?php if(isset($error['dienthoai'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['dienthoai']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td class="note">
            <i>{To_Confirm_Order}</i>
            </td>
        </tr>
        <tr>
        	<td class="td_title">{Address} *</td>
            <td class="note">
            	<input type="text" name="diachi" class="validate[required] text-input" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']?>">
                <?php if(isset($error['diachi'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['diachi']?></p>
                <?php }?>
                </td>
        </tr>
        <tr>
        	<td class="td_title">{Province} *</td>
            <td class="note">
            	<select name="tinhthanh" class="select_tt validate[required]" id="tt">
                	<option value="">{Choose_Province}</option>
                <?php while($row_tt=mysql_fetch_assoc($tt)){?>
                	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
                <?php }?>
                </select>
                <?php if(isset($error['tinhthanh'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['tinhthanh']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td class="td_title">{District} *</td>
            <td class="note">
            	<select name="quanhuyen" class="select_tt validate[required]" id="qh">
                	<option value="0">{Choose_District}</option>
                </select>
                <?php if(isset($error['quanhuyen'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['quanhuyen']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td class="td_title">{Ward} *</td>
            <td class="note">
            	<select name="phuong" class="select_tt validate[required]" id="px">
                	<option value="0">{Choose_Ward}</option>
                </select>
                <?php if(isset($error['phuong'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['phuong']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td class="note">
            <i>{To_Delivery}</i>
            </td>
        </tr>
        <tr>
        	<td class="td_title">{Birthday}</td>
            <td class="note">
            	<input type="text" name="ngaysinh" id="ngaysinh" value="<?php if(isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']?>" >
            	<?php if(isset($error['ngaysinh'])==true) {?> 
                	<p style="display:block" class="warning_email box_size"><?php echo $error['ngaysinh']?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td class="td_title">* {Required_Field}</td>
            <td>
            	<p><input type="checkbox" id="nhanbantin" name="nhanbantin" checked="checked"> <label for="nhanbantin" class="radioLabel">{Get_News_Via_Email}</label></p>
                <p><input class="validate[required]" type="checkbox" id="dongydieukhoan" name="dongydieukhoan"> <label for="dongydieukhoan" class="radioLabel">Đồng ý với <a href="cat/dieu-khoan-su-dung/" class="link">điều khoản sử dụng</a></label></p>
            </td>
        </tr>      
        <tr>
        	<td></td>
            <td><input type="submit" name="dangki" id="dangki" value="{Register}"></td>
        </tr>      
    </table>
</form>
<img id="signup" src="img/register.jpg" alt="dang ki thanh vien" title="Đăng kí thành viên">