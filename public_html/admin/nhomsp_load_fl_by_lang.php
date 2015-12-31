<?php
	require_once "../db/classAdmin.php";
	$i=new admin;
	$le=$_GET['le'];
	$nspf=$i->ListNhomSPFollow($le);
?>
<option value="0">Follow me</option>
<?php while($row_nspf=mysql_fetch_assoc($nspf)){?>
<option value="<?php echo $row_nspf['idNSP']?>"><?php echo $row_nspf['Ten']?></option>
<?php }?>