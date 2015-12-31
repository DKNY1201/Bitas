<?php
	require_once "../db/classAdmin.php";
	$ii=new admin;
	$idTG=$_GET['idTG'];
	if($idTG==1)
		$lang="vn";
	elseif($idTG==2)
		$lang="en";
	else
		$lang="cn";
	$nsp=$ii->ListNSPByLang($lang);
	
	$tt=0;
	if(isset($_GET['TT']))
		$tt=$_GET['TT'];
?>
<select name="nhomsp<?php echo ($tt!=0)?"_$tt":""; ?>">
	<?php while($row_nsp=mysql_fetch_assoc($nsp)){
		$idMau=$row_nsp['idMau'];
		$mau=$ii->ChiTietMau($idMau);
		$row_mau=mysql_fetch_assoc($mau);	
	?>
	<option value="<?php echo $row_nsp['idNSP']?>"><?php echo $row_nsp['Ten']?> - <?php echo $row_mau['Ten']?></option>
    <?php }?>
</select>