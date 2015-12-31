<?php require_once "checklogin.php";
	$nsp=$i->ListAllNSP();
	
	if(isset($_POST['submit']))
	{
		$i->ThemSanPham();
		header("location:index.php?p=sanpham_list");
	}
?>
<form action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Tên</td>
        <td colspan="3"><input type="text" name="ten" class="txt" /></td>
      </tr>
      <tr>
        <td>Size</td>
        <td colspan="3">
            <input type="text" name="size" class="txt" />
        </td>
      </tr>
      <tr>
        <td>Giá</td>
        <td colspan="3">
            <input type="number" name="gia_vn" class="txt" max="1000000" />
        </td>
      </tr>
      <tr>
        <td>Giá chưa giảm</td>
        <td colspan="3">
            <input type="number" name="giachuagiam_vn" class="txt" max="1000000" />
        </td>
      </tr>
      <tr>
        <td>Nhóm sản phẩm</td>
        <td colspan="3">
       		<select name="nhomsp">
			<?php while($row_nsp=mysql_fetch_assoc($nsp)){
                $idMau=$row_nsp['idMau'];
                $mau=$i->ChiTietMau($idMau);
                $row_mau=mysql_fetch_assoc($mau);	
            ?>
            <option value="<?php echo $row_nsp['idNSP']?>"><?php echo $row_nsp['Ten']?> - <?php echo $row_mau['Ten_vn']?></option>
            <?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Thứ tự</td>
        <td colspan="3"><input type="text" class="txt" name="thutu"/></td>
      </tr>
      <tr>
      	<td>Ẩn hiện</td>
        <td colspan="3"><input type="checkbox" name="anhien" checked="checked" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Thêm" class="btn" /></td>
      </tr>
    </table>
</form>