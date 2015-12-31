<?php
	if(isset($_GET['filename'])&&$_GET['filename']!='')
		$filename=$_GET['filename'];
	$url = 'download/'.$filename;
	$mimetype="application/force-download";//mime_content_type($url);
	
	$filesize = filesize($url);
	header("Content-Description: File Transfer");
	header("Content-Type: $mimetype");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: " . $filesize);
	$file = fopen($url,"rb");
	if ($file) {
		while(!feof($file)) {
			print(fread($file, 1024*8));
			flush();
		}
		fclose($file);
	}
?>