<?php
	/* display error
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	*/
	
/**
 * 123Pay Merchant Service
 * @package		miservice
 * @subpackage 	notify.php
 * @copyright	Copyright (c) 2012 VNG
 * @version 	1.0
 * @author 		quannd3@vng.com.vn (live support; zingchat:kibac2001, yahoo:kibac2001, Tel:0904904402)
 * @created 	01/10/2012
 * @modified 	05/10/2012
 */
//this sample code use both GET and POST method
//You can modify to use one that you like


$mTransactionID = $_REQUEST['mTransactionID'];
$bankCode = $_REQUEST['bankCode'];
$transactionStatus = $_REQUEST['transactionStatus'];
$description = $_REQUEST['description'];
$ts = $_REQUEST['ts'];
$checksum = $_REQUEST['checksum'];

//$sMySecretkey = 'MIKEY';//key use to hash checksum that will be provided by 123Pay === for sandbox
$sMySecretkey = 'BITASVNqhcs4H9YNcsZh';
$sRawMyCheckSum = $mTransactionID.$bankCode.$transactionStatus.$ts.$sMySecretkey;
$sMyCheckSum = sha1($sRawMyCheckSum);

if($sMyCheckSum != $checksum)
{
	 response($mTransactionID, '-1', $sMySecretkey);
}

$processResult = process($mTransactionID, $bankCode, $transactionStatus);
response($mTransactionID, $processResult, $sMySecretkey);


/*===============================Function region=======================================*/
function process($mTransactionID, $bankCode, $transactionStatus)
{
	require_once "../db/db.php";
	$i=new db;
	try
	{
		//if lay status123pay duoi database len theo $mTransactionID neu==1 return 2;
		//else{
			//if($transactionStatus==1){cap nhat don hang thanh toan thanh cong}
			//luu xuong db status123pay=$transactionStatus theo mTransactionID;
			//return 1;
		//}
		$dh=$i->detailOrderByTransactionID($mTransactionID);
		$num_dh=mysql_num_rows($dh);
		if($num_dh==1){
			$row_dh=mysql_fetch_assoc($dh);
			$idDH=$row_dh['idDH'];
			$maDH=$row_dh['MaDH'];
			$idKH=$row_dh['idKH'];
			$kh=$i->ChiTietKH($idKH);
			$row_kh=mysql_fetch_assoc($kh);
			$email=$row_kh['Email'];
			
			$isPaid=$row_dh['isPaid'];
			if($isPaid==1)
				return 2;
			else{
				if($transactionStatus==1){
					$i->updateIsPaidTransactionID($mTransactionID);
					$i->emailOrderSuccess_notify($idDH,$maDH,$email);
				}
				return 1;
			}
		}
		else
			return -3;
	}
	catch(Exception $_e)
	{
		return -3;	
	}
}
function response($mTransactionID, $returnCode, $key)
{
	require_once "../db/db.php";
	$i=new db;
	$ts = time();
	$sRawMyCheckSum = $mTransactionID.$returnCode.$ts.$key;
	$checksum = sha1($sRawMyCheckSum);
	$aData = array(
		'mTransactionID' => $mTransactionID,
		'returnCode' => $returnCode,
		'ts' => time(),
		'checksum' => $checksum
	);
	$val=json_encode($aData);
	$i->writeNotifyLog($val);
	echo json_encode($aData);
	exit;
}
/*===============================End Function region=======================================*/
?>