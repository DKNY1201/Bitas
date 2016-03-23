<?php require_once "checklogin.php";
	
	if(isset($_GET['iduser']))
		$idUser=$_GET['iduser'];
	$us=$i->ChiTietUser($idUser);
	$row_us=mysql_fetch_assoc($us);
	
	$tt=$i->ListTinhThanh();
	$idTinh=$row_us['idTinh'];
	$tt_my=$i->ChiTietTinhThanh($idTinh);
	$row_tt_my=mysql_fetch_assoc($tt_my);
	
	$gr=$i->ListGroup();
	$error=array();
	if(isset($_POST['submit']))
	{
		$success=$i->SuaUser($error,$idUser);
		if($success==true)
			header("location:index.php?p=user_list");
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
});
</script>

<link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css"/>

<form id="formthemuser" name="formthemuser" action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Họ tên</td>
        <td colspan="3"><input type="text" name="hoten" class="txt validate[required]" value="<?php if(isset($_POST['hoten'])) echo $_POST['hoten']; else echo $row_us['HoTen'];?>"/></td>
      </tr>
      <tr>
        <td>Địa chỉ</td>
       	<td colspan="3"><input type="text" name="diachi" class="txt validate[required]" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']; else echo $row_us['DiaChi'];?>"/></td>
      </tr>
      <tr>
        <td>Tỉnh thành</td>
       	<td colspan="3">
        	<select name="tinhthanh">
            	<?php while($row_tt=mysql_fetch_assoc($tt)){
					$s="";
					if($row_tt_my['idTinh']==$row_tt['idTinh'])
						$s="selected=selected";	
				?>
                <option value="<?php echo $row_tt['idTinh']?>" <?php echo $s?>><?php echo $row_tt['Ten']?></option>
                <?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Điện thoại</td>
        <td colspan="3"><input type="text" name="dienthoai" class="txt validate[required]" value="<?php if(isset($_POST['dienthoai'])) echo $_POST['dienthoai']; else echo $row_us['DienThoai'];?>"/></td>
      </tr>
      <tr>
        <td>Ngày sinh</td>
        <td colspan="3"><input type="text" name="ngaysinh" id="ngaysinh" class="txt" value="<?php if(isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']; else echo date("d/m/Y",strtotime($row_us['NgaySinh']));?>"/>
        <?php if(isset($error['ngaysinh'])==true) {?> 
			<p style="display:block" id="warning_email" class="box_size"><?php echo $error['ngaysinh']?></p>
		<?php }?>
        </td>
      </tr>
      <tr>
        <td>Giới tính</td>
        <td colspan="3">
        <input type="radio" name="gioitinh" value="0" <?php echo ($row_us['GioiTinh']==0)?"checked=checked":""?> /> Nữ
        <input type="radio" name="gioitinh" value="1" <?php echo ($row_us['GioiTinh']==1)?"checked=checked":""?>/> Nam
        </td>
      </tr>
      <tr <?php	if($_SESSION['group']!=1) { echo 'style="display: none"';}?>>
        <td>Phân quyền</td>
        <td colspan="3">
        	<select name="group">
            <?php while($row_gr=mysql_fetch_assoc($gr)){
				$s="";
				if($row_us['idGroup']==$row_gr['idGroup'])
					$s='selected=selected';	
			?>
            	<option value="<?php echo $row_gr['idGroup']?>" <?php echo $s?>><?php echo $row_gr['Ten']?></option>
            <?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn blue" /></td>
      </tr>
    </table>
</form>