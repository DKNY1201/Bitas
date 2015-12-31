<?php
	require_once "db/db.php";
	$ii=new db;
	if(isset($_GET['idTT']))
		$idTT=$_GET['idTT'];
	$ch=$ii->loadDLByCity($idTT);
?>
<table class="content" width="100%" border="0" cellspacing="0" cellpadding="4" >
            <tr>
            	<th>Tên</th>
                <th>Thông tin</th>
            </tr>
<?php while($row_ch=mysql_fetch_assoc($ch)) {?>
	<tr <?php if($row_ch['idHTPP']%2==0) echo 'class="odd"'?>>
    	<td><strong><?php echo $row_ch['Ten']?></strong></td>
        <td>
        	<p><strong>Địa chỉ:</strong> <?php echo $row_ch['DiaChi']?></p>
            <?php if($row_ch['DienThoai']!="") {?><p><strong>Điện thoại:</strong> <?php echo $row_ch['DienThoai']?></p><?php }?>
            <?php if($row_ch['Fax']!="") {?><p><strong>Fax:</strong> <?php echo $row_ch['Fax']?></p><?php }?>
        </td>
    </tr>
<?php }?>
 </table>