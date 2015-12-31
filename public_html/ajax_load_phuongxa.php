<?php
	require_once "db/db.php";
	$ii=new db;
	if(isset($_GET['idQH']))
		$idQH=$_GET['idQH'];
	$px=$ii->ListPhuongByQH($idQH);
?>
<?php
	while($row_px=mysql_fetch_assoc($px)){
?>
	<option value="<?php echo $row_px['idPhuong']?>"><?php echo $row_px['type']." ".$row_px['Ten']?></option>
<?php }?>