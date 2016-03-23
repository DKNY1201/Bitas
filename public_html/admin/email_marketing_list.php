<?php 
  require_once "checklogin.php";
	$sr=$i->ListSearch();
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
    <th>Từ khóa</th>
    <th>Địa chỉ IP</th>
  </tr>
</thead>
<tbody>
  <?php while($row=mysql_fetch_assoc($sr)){
	ob_start();  
  ?>
  <tr>
    <td>{idSR}</td>
    <td>{Date}</td>
    <td>{Keywork}</td>
    <td>{IP}</td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idSR}",$row['idSR'],$str);
	$str=str_replace("{Date}",$row['SubmitDate'],$str);
	$str=str_replace("{Keywork}",$row['Keywork'],$str);
	$str=str_replace("{IP}",$row['IP'],$str);
	echo $str;
  }
  ?>
</tbody>
</table>
