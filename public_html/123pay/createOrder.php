<?php
include 'rest.client.class.php';
include 'common.class.php';
function createUniqueOrderId($orderIdPrefix)
{
	return $orderIdPrefix.time();
}
$mTransactionID = '123456';
$orderIdPrefix = 'micode';

$result = null;
$resultMessage = '';
if(1)
{
	$mTransactionID = createUniqueOrderId($orderIdPrefix);
	$resultMessage = 'Current order id: <strong>'.$mTransactionID.'</strong><br>';
	$aData = array
	(
		'mTransactionID' => $mTransactionID,
		'merchantCode' =>'MICODE',
		'bankCode' =>'123PAY',
		'totalAmount' =>20000,
		'clientIP' =>'172.0.0.1',
		'custName' =>'le mai tram',
		'custAddress' =>'1 nguyen trai',
		'custGender' =>'U',
		'custDOB' =>'',
		'custPhone' =>'0973111222',
		'custMail' =>'tramle120887@gmail.com',
		'description' =>'thanh toan cho don hang 3339',
		'cancelURL' => 'http://bitas.com.vn/123pay/queryoder.php',
        'redirectURL' => 'http://bitas.com.vn/123pay/queryoder.php',
        'errorURL' => 'http://bitas.com.vn/123pay/queryoder.php',
		'passcode' =>'MIPASSCODE',
		'checksum' =>'',
		'addInfo' =>''
	);
	
	$aConfig = array
	(
		'url'=>'https://sandbox.123pay.vn/miservice/createOrder1',
		'key'=>'MIKEY',
		'passcode'=>'MIPASSCODE',
		'cancelURL' => 'merchantCancelURL', //fill cancelURL here
		'redirectURL' => 'merchantRedirectURL', //fill redirectURL here
        'errorURL' => 'merchantErrorURL', //fill errorURL here
	);
	
	try
	{
		$data = Common::callRest($aConfig, $aData);//call 123Pay service
		$result = $data->return;
		if($result['httpcode'] ==  200)
		{
			//call service success do success flow
			if($result[0]=='1')//service return success
			{
				//re-create checksum
				$rawReturnValue = '1'.$result[1].$result[2];
				$reCalChecksumValue = sha1($rawReturnValue.$aConfig['key']);
				if($reCalChecksumValue == $result[3])//check checksum
				{
					$resultMessage .= 'Call service result:<hr>';
					$resultMessage .=  'mTransactionID='.$mTransactionID.'<br>';
					$resultMessage .=  '123PayTransactionID='.$result[1].'<br>';
					$resultMessage .=  'URL='.$result[2].'<br>';
					//call php header to redirect to input card page
					$resultMessage .= '<a style="color:red;font-weight:bold;" href="'.$result[2].'" target="_parent">Click here to go to payment process</a><br>';
					echo'<script>window.location.href="'.$result[2].'"</script>';                                        
                                        exit();
				}else
				{
					//Call 123Pay service create order fail, return checksum is invalid
					$resultMessage .=  'Return data is invalid<br>';
				}
			}else{
				//Call 123Pay service create order fail, please refer to API document to understand error code list
				//$result[0]=error code, $result[1] = error description
				$resultMessage .=  $result[0].': '.$result[1];
			}
		}else{
			//call service fail, do error flow
			$resultMessage .=  'Call 123Pay service fail. Please recheck your network connection<br>';
		}
	}catch(Exception $e)
	{
		$resultMessage .=  '<pre>';
		$resultMessage .= $e->getMessage();
	}
	//create new orderid
}

?>
