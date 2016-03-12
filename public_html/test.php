<?php

	require_once "dbconnect.php";
	//$sql = "SELECT idDH FROM donhang WHERE NgayDH BETWEEN '2015-01-30' AND '2015-01-14'";
	$sql = "SELECT count(idDH) as NumDH FROM donhang WHERE DATEDIFF(NOW(),NgayDH)<=20 GROUP BY DATE(NgayDH)";
	$result = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_assoc($result)){
		echo $row['NumDH']."<br />";
	}
	

	
	//echo "123";
?>