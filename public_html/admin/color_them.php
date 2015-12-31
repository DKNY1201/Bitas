<?php require_once "checklogin.php";
	if(isset($_POST['submit']))
	{
		$i->ThemColor();
		header("location:index.php?p=color_list");
	}
?>
<form action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Mã màu</td>
        <td colspan="3"><input type="text" name="mamau" class="txt" /></td>
      </tr>
      <tr>
        <td>Tên màu</td>
        <td colspan="3"><input type="text" name="tenmau" class="txt" /></td>
      </tr>
      <tr>
        <td>Tên VN</td>
        <td colspan="3"><input type="text" name="ten_vn" class="txt" /></td>
      </tr>
      <tr>
        <td>Tên EN</td>
        <td colspan="3"><input type="text" name="ten_en" class="txt" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Thêm" class="btn" /></td>
      </tr>
    </table>
</form>