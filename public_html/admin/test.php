<?php
	require_once "dbconnect.php";
	
	$sql="SELECT * FROM sanpham WHERE ISNULL(GiaChuaGiam_vn) AND AnHien=1";
	$kq=mysql_query($sql) or die(mysql_error());
	while($row_kq=mysql_fetch_assoc($kq)){
		$gia=$row_kq['Gia_vn'];
		$id=$row_kq['idSP'];
		$sql="UPDATE sanpham SET GiaChuaGiam_vn=$gia WHERE idSP=$id";
			echo $sql;
		mysql_query($sql) or die(mysql_error());
?>
    
<?php }?>