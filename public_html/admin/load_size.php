<?php
	require_once "../db/classAdmin.php";
	$l=new admin;
	if(isset($_GET['idNSP']))
		$idNSP=$_GET['idNSP'];
	$sp=$l->ListSanPhamTheoNSP($idNSP);
	while($row_sp=mysql_fetch_assoc($sp)){
?>
<option value="<?php echo $row_sp['idSP']?>"><?php echo $row_sp['Size']?></option>
<?php }?>