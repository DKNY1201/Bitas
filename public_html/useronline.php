<?php 
	$sql="SELECT sum( if( username <>'' , 1 , 0 ) ) As SoThanhVien, sum( if( username ='' , 1 , 0 ) ) As SoKhach , count(*) As TongSoNguoi FROM sessions";
	$us=mysql_query($sql) or die(mysql_error());
	$row_us=mysql_fetch_assoc($us);
	echo $row_us['TongSoNguoi'];
?>
