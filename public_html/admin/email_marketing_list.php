<?php 
  require_once "checklogin.php";
	$em=$i->ListEmailMarketing();
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
    <th>Email</th>
    <th>Địa chỉ IP</th>
  </tr>
</thead>
<tbody>
  <?php while($row=mysql_fetch_assoc($em)){
	ob_start();  
  ?>
  <tr>
    <td>{idEM}</td>
    <td>{Date}</td>
    <td>{Email}</td>
    <td>{IP}</td>
  </tr>
  <?php 
    $str=ob_get_clean();
  	$str=str_replace("{idEM}",$row['idEM'],$str);
  	$str=str_replace("{Date}",date("d-m-Y H:i:s",strtotime($row['NgayThem'])),$str);
  	$str=str_replace("{Email}",$row['Email'],$str);
  	$str=str_replace("{IP}",$row['IP'],$str);
  	echo $str;
  }
  ?>
</tbody>
</table>
