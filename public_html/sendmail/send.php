<?php
include "class.phpmailer.php"; 
include "class.smtp.php"; 

$mail = new PHPMailer();
$mail->IsSMTP(); // set mailer to use SMTP
$mail->Host = "mail.bitas.com.vn"; // specify main and backup server
$mail->Port = 25; // set the port to use
$mail->SMTPAuth = true; // turn on SMTP authentication
//$mail->SMTPSecure = 'ssl';
$mail->Username = "cskh@bitas.com.vn"; // your SMTP username or your gmail username
$mail->Password = "binhtan@12345"; // your SMTP password or your gmail password
$from = "cskh@bitas.com.vn"; // Reply to this email
$to="mb.longhm@gmail.com"; // Recipients email ID
$name="Vo Duy Tuan"; // Recipient's name
$mail->From = $from;
$mail->FromName = "Your From Name"; // Name to indicate where the email came from when the recepient received
$mail->AddAddress($to,$name);
$mail->AddReplyTo($from,"Vo Duy Tuan");
$mail->WordWrap = 50; // set word wrap
$mail->IsHTML(true); // send as HTML
$mail->Subject = "Test mail script";
$mail->Body = "<b>Mail nay duoc goi bang phpmailer class. </b>"; //HTML Body
$mail->AltBody = "Mail nay duoc goi bang phpmailer class. "; //Text Body
//$mail->SMTPDebug = 2;
if(!$mail->Send())
{
	echo "<h1>Loi khi goi mail: " . $mail->ErrorInfo . '</h1>';
}
else
{
	echo "<h1>Send mail thanh cong</h1>";
}
?>
