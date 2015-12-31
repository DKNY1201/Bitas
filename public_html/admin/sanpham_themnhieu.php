<?php require_once "checklogin.php";
	if(isset($_GET['sosp'])) $sosp=$_GET['sosp'];
	settype($sosp,"int");
	if($sosp<=0) $sosp=1;
	$nsp=$i->ListNSP();
	if(isset($_POST['submit']))
	{
		$i->ThemSanPham_Nhieu($sosp);
		header("location:index.php?p=sanpham_list");
	}
?>
<form action="" method="post">
<?php for($j=1;$j<=$sosp;$j++) {?>

    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
    	<tr>
        	<td colspan="4"><strong style="font-size:16px; text-transform:uppercase; color:#48a6d2">Sản phẩm <?php echo $j?></strong></td>
        </tr>
      <tr>
        <td>Tên</td>
        <td colspan="3"><input type="text" name="ten_<?php echo $j?>" class="txt" /></td>
      </tr>
      <tr>
        <td>Size</td>
        <td colspan="3">
            <input type="text" name="size_<?php echo $j?>" class="txt" />
        </td>
      </tr>
      <tr>
        <td>Giá</td>
        <td colspan="3">
            <input type="text" name="gia_vn_<?php echo $j?>" class="txt" />
        </td>
      </tr>
      <tr>
        <td>Giá chưa giảm</td>
        <td colspan="3">
            <input type="text" name="gia_chua_giam_vn_<?php echo $j?>" class="txt" />
        </td>
      </tr>
      <tr>
        <td>Nhóm sản phẩm</td>
        <td colspan="3">
        	<select name="nhomsp_<?php echo $j?>">
            <?php mysql_data_seek($nsp,0);
			while($row_nsp=mysql_fetch_assoc($nsp)){
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
        <td colspan="3"><input type="text" class="txt" name="thutu_<?php echo $j?>"/></td>
      </tr>
      <tr>
      	<td>Ẩn hiện</td>
        <td colspan="3"><input type="checkbox" name="anhien_<?php echo $j?>" checked="checked" /></td>
      </tr>
    </table>
<?php }?>
<div class="submit">
	<input type="submit" name="submit" value="Thêm" class="btn" />
</div>
</form>