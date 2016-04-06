<?php 
  require_once "checklogin.php";
	$log=$i->ListLog();
?>
<script>
	$(document).ready(function(e) {		
		//data table
		$('#table').dataTable({
			"sPaginationType": "full_numbers",
			"iDisplayLength": 25,
			"aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
      "aaSorting" : [[0, 'desc']],
		});
  });
</script>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Ngày giờ</th>
    <th>Người thực hiện</th>
    <th>Nội dung</th>
  </tr>
</thead>
<tbody>
  <?php while($row_log=mysql_fetch_assoc($log)){
	ob_start();  
  ?>
  <tr>
    <td>{idLog}</td>
    <td>{Date}</td>
    <td>{User}</td>
    <td>{Content}</td>
  </tr>
  <?php
    $str=ob_get_clean();
    $idUser = $row_log['idUser'];
    $user = $i->ChiTietUser($idUser);
    $row_user = mysql_fetch_assoc($user);

  	$str=str_replace("{idLog}",$row_log['idLog'],$str);
  	$str=str_replace("{Date}",date("d-m-Y H:i:s",strtotime($row_log['LogDate'])),$str);
  	$str=str_replace("{User}",$row_user['HoTen'],$str);
  	$str=str_replace("{Content}",$row_log['Content'],$str);
  	echo $str;
  }
  ?>
</tbody>
</table>
