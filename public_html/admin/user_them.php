<?php
  require_once "checklogin.php";
	$error=array();
	
	$tt=$i->ListTinhThanh();
	if(isset($_POST['submit']))
	{
		$success=$i->ThemUser($error);
		if($success==true)
			header("location:index2.php?p=user_list");
	}
?>
<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
<script>
$(document).ready(function(e) {
	$("#ngaysinh").datepicker({
		dateFormat: 'dd/mm/yy',
		maxDate: '-10Y',
	});	 
	//VALIDATE
	$('#formthemuser').validationEngine();
  //Load Quan Huyen
  $("#tt").change(function(e) {
    var idTT=$(this).val();
        $("#qh").load("../ajax_load_quanhuyen.php?idTT="+idTT);
    });
  $("#qh").change(function(e) {
    var idQH=$(this).val();
        $("#px").load("../ajax_load_phuongxa.php?idQH="+idQH);
    });
});
</script>

<link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css"/>

<form id="formthemuser" name="formthemuser" action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Email</td>
        <td colspan="3"><input type="text" name="email" class="txt validate[required,custom[email]] text-input" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>" />
        <?php if(isset($error['email'])==true) {?> 
			<p style="display:block" id="warning_email" class="box_size"><?php echo $error['email']?></p>
		<?php }?>
        </td>
      </tr>
      <tr>
        <td>Mật khẩu</td>
        <td colspan="3"><input type="password" name="pass" class="txt validate[required,minSize[6]] text-input" /></td>
      </tr>
      <tr>
        <td>Họ tên</td>
        <td colspan="3"><input type="text" name="hoten" class="txt validate[required]" value="<?php if(isset($_POST['hoten'])) echo $_POST['hoten']?>"/></td>
      </tr>
      <tr>
        <td>Địa chỉ</td>
       	<td colspan="3"><input type="text" name="diachi" class="txt validate[required]" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']?>"/></td>
      </tr>
      <tr>
        <td>Tỉnh thành</td>
       	<td colspan="3">
        	<select id="tt" name="tinhthanh">
             <option value="">Chọn tinh thanh</option>
            <?php while($row_tt=mysql_fetch_assoc($tt)) {?>
            	<option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
            <?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Quận huyện</td>
        <td colspan="3">
          <select id="qh" name="quanhuyen" class="validate[required]">
            <option value="">Chọn quận huyện</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Phường xã</td>
        <td colspan="3">
          <select id="px" name="phuongxa" class="validate[required]">
            <option value="">Chọn phường xã</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>Điện thoại</td>
        <td colspan="3"><input type="text" name="dienthoai" class="txt validate[required]" value="<?php if(isset($_POST['dienthoai'])) echo $_POST['dienthoai']?>"/></td>
      </tr>
      <tr>
        <td>Ngày sinh</td>
        <td colspan="3"><input type="text" name="ngaysinh" id="ngaysinh" class="txt" value="<?php if(isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']?>"/>
        <?php if(isset($error['ngaysinh'])==true) {?> 
			<p style="display:block" id="warning_email" class="box_size"><?php echo $error['ngaysinh']?></p>
		<?php }?>
        </td>
      </tr>
      <tr>
        <td>Giới tính</td>
        <td colspan="3">
          <div class="control-group">
            <div class="controls">
              <label class="radio">
              <div class="radio"><span class="checked"><input type="radio" name="gioitinh" value="0"></span></div>
              Nữ
              </label>
              <label class="radio">
              <div class="radio"><span class=""><input type="radio" name="gioitinh" value="1" checked=""></span></div>
              Nam
              </label>  
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Thêm" class="btn blue" /></td>
      </tr>
    </table>
</form>