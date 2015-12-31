<?php require_once "checklogin.php";
	if(isset($_GET['idcl']))
		$idCL=$_GET['idcl'];
	$cl=$i->ChiTietMau($idCL);
	$row_cl=mysql_fetch_assoc($cl);
	if(isset($_POST['submit']))
	{
		$i->SuaColor($idCL);
		header("location:index.php?p=color_list");
	}
?>
<form action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
   	  <tr>
        <td>Mã màu</td>
        <td colspan="3"><input type="text" name="mamau" class="txt" value="<?php echo $row_cl['MaMau']?>" /></td>
      </tr>
      <tr>
        <td>Tên màu</td>
        <td colspan="3"><input type="text" name="tenmau" class="txt" value="<?php echo $row_cl['TenMau']?>" /></td>
      </tr>
      <tr>
        <td>Tên VN</td>
        <td colspan="3"><input type="text" name="ten_vn" class="txt" value="<?php echo $row_cl['Ten_vn']?>" /></td>
      </tr>
      <tr>
        <td>Tên EN</td>
        <td colspan="3"><input type="text" name="ten_en" class="txt" value="<?php echo $row_cl['Ten_en']?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn" /></td>
      </tr>
    </table>
</form>