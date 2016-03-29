<?php require_once "checklogin.php";
	
	if(isset($_GET['iduser']))
		$idUser=$_GET['iduser'];
	$us=$i->ChiTietUser($idUser);
	$row_us=mysql_fetch_assoc($us);
	
	$tt=$i->ListTinhThanh();
	$idTinh=$row_us['idTinh'];
	$tt_my=$i->ChiTietTinhThanh($idTinh);
	$row_tt_my=mysql_fetch_assoc($tt_my);

  $idQH=$row_us['idQuanHuyen'];
  $qh=$i->ListQuanHuyenByTinhThanh($idTinh);
  $idPX=$row_us['idPhuong'];
  $px=$i->ListPhuongByQH($idQH);

	$error=array();
	if(isset($_POST['submit']))
	{
		$success=$i->SuaUser($error,$idUser);
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
        	<select name="tinhthanh" id="tt">
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
        <td>Quan huyen</td>
        <td colspan="3">
          <select name="quanhuyen" id="qh" class="select_tt validate[required]">
            <option value="">Chon quan huyen</option>
              <?php 
                while($row_qh=mysql_fetch_assoc($qh)) {
                $s="";
                if($idQH==$row_qh['idQuanHuyen'])
                  $s="selected=selected";
              ?>
              <option value="<?php echo $row_qh['idQuanHuyen']?>" <?php echo $s?>><?php echo $row_qh['type']." ".$row_qh['Ten']?></option>
             <?php }?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Phuong xa</td>
        <td colspan="3">
          <select name="phuongxa" id="px" class="select_tt validate[required]">
            <option value="">Chon phuong xa</option>
              <?php 
              while($row_px=mysql_fetch_assoc($px)) {
                $s="";
                if($idPX==$row_px['idPhuong'])
                  $s="selected=selected";
              ?>
              <option value="<?php echo $row_px['idPhuong']?>" <?php echo $s?>><?php echo $row_px['type']." ".$row_px['Ten']?></option>
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
          <div class="control-group">
            <div class="controls">
              <label class="radio">
              <div class="radio"><span class="checked"><input type="radio" name="gioitinh" value="0" <?php echo ($row_us['GioiTinh']==0)?"checked=checked":""?>></span></div>
              Nữ
              </label>
              <label class="radio">
              <div class="radio"><span class=""><input type="radio" name="gioitinh" value="1" <?php echo ($row_us['GioiTinh']==1)?"checked=checked":""?>></span></div>
              Nam
              </label>  
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn blue" /></td>
      </tr>
    </table>
</form>