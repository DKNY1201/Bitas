<?php
session_start();
require_once "../db/db.php";
$i=new db;

include 'common.class.php';

//get all data from querystring
//transactionID=123P1210020000506&time=1349164000&status=1&ticket=0d5b8e8d4aea134c3cd159dd500f3598

$aConfig = array
(
	'merchantCode'=>'MICODE',
	'url'=>'https://sandbox.123pay.vn/miservice/queryOrder',
	'key'=>'MIKEY',
	'passcode'=>'MIPASSCODE',
);

$transactionID = $_GET['transactionID'];
$time = $_GET['time'];
$status = $_GET['status'];
$ticket = $_GET['ticket'];

$recalChecksum = md5($status.$time.$transactionID.$aConfig['key']);
if($recalChecksum != $ticket)
{
	echo 'Invalid url';
	exit;	
}

		try
		{
			$aData = array
			(
				'mTransactionID' => $transactionID,
				'merchantCode' =>$aConfig['merchantCode'],
				'clientIP' =>'127.0.0.1',//current browser ip
				'passcode' =>$aConfig['passcode'],
				'checksum' =>'',
			);
			$data = Common::callRest($aConfig, $aData);
			
			$result = $data->return;
			if($result['httpcode'] ==  200)
			{
				/* Retun data format
				Array
				(
					[0] => 1
					[1] => 123P1210020000507
					[2] => 1
					[3] => 100000
					[4] => 100000
					[5] => BANKNET
					[6] => 
					[7] => bc44083e998b5e24a922ffad04ea779a84bb2ee3
					[httpcode] => 200
				)
				*/
				if($result[0]=='1')
				{	
					/*
					echo 'Order info:<hr>';
					echo 'mTransactionId:'.$transactionID.'<br>';
					echo '123PayTransactionId: '.$result[1].'<br>';
					echo 'Status: '.$result[2].'<br>';
					echo 'Amount: '.$result[3].'<br>';
					echo '<hr>';
					*/
					if($result[2]=='1')//success
					{
						//Do success call service
						unset($_SESSION['idPro']);
						unset($_SESSION['SoLuong']);
						$idDH=$_SESSION['iddh'];
						if($idDH=="")
							header("location:http://bitas.com.vn");
						$i->updateIsPaid($idDH);
						$i->emailOrderSuccess();
						
						header("location:http://bitas.com.vn/Gio-Hang/Hoan-Tat-Mua-Hang/");
						//echo 'Checkout process successfully';
					}else{					
						//echo 'Show message base on order status ('.$result[2].')';
						echo "Quý khách đã hủy việc thanh toán. Quý khách vui lòng nhấn vào <a href='http://bitas.com.vn/gio-hang/thong-tin-khach-hang/'>đây</a> để thanh toán lại hoặc nhấn vào <a href='http://bitas.com.vn/'>đây</a> để trở về trang chủ";
					}
				}else{
					//echo 'Call service queryOrder fail: Order is processing. Please waiting some munite and check your order history list';
					echo "Quá trình thanh toán xãy ra lổi. Quý khách vui lòng nhấn vào <a href='http://bitas.com.vn/gio-hang/thong-tin-khach-hang/'>đây</a> để thanh toán lại";
				}
			}else{
				//do error call service.
				//echo 'Call service queryOrder fail: Order is processing. Please waiting some munite and check your order history list';
				echo "Quá trình thanh toán xãy ra lổi. Quý khách vui lòng nhấn vào <a href='http://bitas.com.vn/gio-hang/thong-tin-khach-hang/'>đây</a> để thanh toán lại";
			}
		}catch(Exception $e)
		{
			//write log here to monitor your exception
			echo 'Call service queryOrder fail: Order is processing. Please waiting some munite and check your order history list';
		}

?>
