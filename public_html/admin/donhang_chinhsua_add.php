<?php 
	require_once "checklogin.php";
	if(isset($_GET['idDH'])){
		$idDH=$_GET['idDH'];
	}
	$sp=$i->ListSanPham();
	
	if(isset($_POST['submit']))
	{
		$i->AddDHCT($idDH);
		header("location:index.php?p=donhang_chitiet&idDH=".$idDH);
	}
?>
<form action="" method="post" class="has-zelect">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Sản phẩm</td>
        <td colspan="3">
        	<select name="idSP" id="select-backed-zelect">
                <option value="0">Chọn sản phẩm</option>
                <?php 
					while($row_sp=mysql_fetch_assoc($sp)) {
						$s="";
						if(isset($_POST['idSP'])){
							if($_POST['idSP'] == $row_sp['idSP']){
								$s="selected='selected'";
							}
						}
				?>
                <option value="<?php echo $row_sp['idSP']?>" <?php echo $s;?>><?php echo $row_sp['Ten']?> - <?php echo $row_sp['Size']?></option>
                <?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Số lượng</td>
        <td colspan="3"><input type="text" name="soluong" class="txt" value="<?php if(isset($_POST['soluong'])) echo $_POST['soluong']; ?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Thêm" class="btn" /></td>
      </tr>
    </table>
</form>