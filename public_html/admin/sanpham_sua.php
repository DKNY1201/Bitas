<?php require_once "checklogin.php";
	
	if(isset($_GET['idsp']))
		$idsp=$_GET['idsp'];
	$sp=$i->ChiTietSP($idsp);
	$row_sp=mysql_fetch_assoc($sp);
	
	$nsp=$i->ListAllNSP();
	if(isset($_POST['submit']))
	{
		$i->SuaSanPham($idsp);
		header("location:index.php?p=sanpham_list");
	}
?>
<form action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>SKU</td>
        <td colspan="3"><input type="text" name="ten" class="txt" value="<?php echo $row_sp['Ten']?>" /></td>
      </tr>
      <tr>
        <td>Size</td>
        <td colspan="3">
            <input type="text" name="size" class="txt" value="<?php echo $row_sp['Size']?>" />
        </td>
      </tr>
      <tr>
        <td>Giá</td>
        <td colspan="3">
            <input type="number" name="gia_vn" class="txt" value="<?php echo $row_sp['Gia_vn']?>" max="1000000" />
        </td>
      </tr>
      <tr>
        <td>Giá chưa giảm</td>
        <td colspan="3">
            <input type="number" name="giachuagiam_vn" class="txt" value="<?php echo $row_sp['GiaChuaGiam_vn']?>" max="1000000" />
        </td>
      </tr>
      <tr>
        <td>Nhóm sản phẩm</td>
        <td colspan="3">
        <select name="nhomsp">
            <option value="0">Chọn nhóm SP</option>
            <?php while($row_nsp=mysql_fetch_assoc($nsp)) {
				$idMau=$row_nsp['idMau'];
				$mau=$i->ChiTietMau($idMau);
				$row_mau=mysql_fetch_assoc($mau);
				
				$s="";
				if($row_sp['idNSP']==$row_nsp['idNSP'])
					$s="selected=selected";
			?>
            <option value="<?php echo $row_nsp['idNSP']?>" <?php echo $s?>><?php echo $row_nsp['Ten']?> - <?php echo $row_mau['Ten_vn']?></option>
            <?php }?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Thứ tự</td>
        <td colspan="3"><input type="text" class="txt" name="thutu" value="<?php echo $row_sp['ThuTu']?>"/></td>
      </tr>
      <tr>
      	<td>Ẩn hiện</td>
        <td colspan="3"><input type="checkbox" name="anhien" <?php if($row_sp['AnHien']==1) echo "checked=checked";?> /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn blue" /></td>
      </tr>
    </table>
</form>