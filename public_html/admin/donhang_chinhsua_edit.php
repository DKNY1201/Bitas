<?php 
	require_once "checklogin.php";
	if(isset($_GET['idDHCT'])){
		$idDHCT=$_GET['idDHCT'];
	}
	$dhct = $i->ChiTietDonHangChiTiet($idDHCT);
	$row_dhct = mysql_fetch_assoc($dhct);
	
	$sp=$i->ListSanPham();
	
	if(isset($_POST['submit']))
	{
		$i->EditDHCT($idDHCT);
		header("location:index.php?p=donhang_chitiet&idDH=".$row_dhct['idDH']);
	}
?>
<form action="" method="post" class="has-zelect">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Sản phẩm</td>
        <td colspan="3">
        	<select name="idSP" id="select-backed-zelect">
                <option value="0">Chọn sản phẩm</option>
                <?php while($row_sp=mysql_fetch_assoc($sp)) {
                    $s="";
                    if($row_sp['idSP']==$row_dhct['idSP'])
                        $s="selected=selected";
                ?>
                <option value="<?php echo $row_sp['idSP']?>" <?php echo $s?>><?php echo $row_sp['Ten']?> - <?php echo $row_sp['Size']?></option>
                <?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Số lượng</td>
        <td colspan="3"><input type="text" name="soluong" class="txt" value="<?php echo $row_dhct['SoLuong']?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn" /></td>
      </tr>
    </table>
</form>