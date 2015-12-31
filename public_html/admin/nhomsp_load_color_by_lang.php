<?php
	require_once "../db/classAdmin.php";
	$i=new admin;
	$le=$_GET['le'];
	$mau=$i->ListColor($le);
?>
<?php while($row_mau=mysql_fetch_assoc($mau)){?>
	<option value="<?php echo $row_mau['idMau']?>"><?php echo $row_mau['Ten']?></option>
<?php }?>