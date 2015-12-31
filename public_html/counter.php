<?php
$filename = "counter.txt"; // 23
$count = 0;
if (file_exists($filename)==true){
	  $fp = fopen($filename, "r") or die("Mở file counter không được");
	  $size = filesize($filename);
	  $count = fread($fp, $size);
	  fclose($fp);
}

//if(!isset($_COOKIE['count'])){
 $count++;
$fp = fopen($filename, "w");
	fwrite($fp, $count);
	fclose($fp);
	setcookie('count','1'); //Hàm setcookie mà không có tham số thứ 3 (định thời gian hết hạn cookie) thì khi tắt trình duyệt nó sẽ tự động hủy cookie
//}

echo $count;

?>