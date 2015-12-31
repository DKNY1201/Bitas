<?php
	require_once "db/db.php";
	$i=new db;
	if(isset($_GET['email']))
		$email=$_GET['email'];
		
	if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
?>
<div id="email_false" class="box_size">
	Địa chỉ email không hợp lệ.
</div>
<?php } 
else{
	$check=$i->checkEmail($email);
	//echo $check; exit();
	if($check==1)
	{
		$i->ThemEmail($email);
?>
<div id="email_true" class="box_size">
Cám ơn quý khách đã đăng kí.
</div>
<?php } else {?>
<div id="email_false" class="box_size">
	Địa chỉ email này đã đăng ký nhận bản tin.
</div>
<?php }}?>