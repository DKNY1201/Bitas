<?php
	require_once "db/db.php";
	$ii=new db;
	if(isset($_GET['idTT']))
		$idTT=$_GET['idTT'];
	$qh=$ii->ListQuanHuyenByTinhThanh($idTT);
?>
	<option value="">Chọn quận huyện</option>
<?php
	while($row_qh=mysql_fetch_assoc($qh)){
?>
	<option value="<?php echo $row_qh['idQuanHuyen']?>"><?php echo$row_qh['type']." ".$row_qh['Ten']?></option>
<?php }?>