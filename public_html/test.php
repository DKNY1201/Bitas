<?php
/*
	require_once "db/db.php";

	$i = new db;
	$sql = "SELECT idSP,Ten FROM sanpham";
	$re = mysql_query($sql) or die(mysql_error());
	while ($row = mysql_fetch_assoc($re)) {
		if(substr_count($row['Ten'],".") >=2){
			$idSP = $row['idSP'];
			$skuArr = explode(".", $row['Ten']);
			$newSKU = "";
			$n = count($skuArr);
			for($i = 0 ; $i<$n; $i++){
				if($i==0 || $i==$n-1){
					$newSKU .= $skuArr[$i];
				}else{
					$newSKU .= $skuArr[$i] . '.';
				}
			}

			$sql = "UPDATE sanpham SET Ten = '$newSKU' WHERE idSP = $idSP";
			
			mysql_query($sql) or die(mysql_error());
			//echo $row['Ten'] . ' ' . $idNSP . "<br />";
			//echo $newSKU . ' ' . $idNSP . "<br />";
			//echo "================" . "<br />";
		}
	}*/
?>