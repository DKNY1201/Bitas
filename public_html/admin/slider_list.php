<?php 
  require_once "checklogin.php";
	$sli=$i->ListSlider();
?>
<script>
  $(document).ready(function(e) {   
    //data table
    $('#table').dataTable({
      "sPaginationType": "full_numbers",
      "iDisplayLength": -1,
      "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
      "aaSorting" : [[0, 'asc']],
    });
  });
</script>
<a class="btn-action btn-info" href="index.php?p=slider_them"><i class="fa fa-plus"></i> Thêm Banner</a>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Hình ảnh</th>
    <th>Link</th>
    <th>Mô tả hình ảnh</th>
    <th>Ngày bắt đầu hiển thị</th>
    <th>Ngày kết thúc hiển thị</th>
    <th>Thứ tự hiển thị</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php
  	$i = 1;
  	while($row_sli=mysql_fetch_assoc($sli)){
	ob_start();  
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><img width="150px" src="{imgSrc}" alt="{altText}" /></td>
    <td><a href="{url}" target="blank">{url}</a></td>
    <td>{altText}</td>
    <td>{beginDate}</td>
    <td>{endDate}</td>
    <td>{ThuTu}</td>
    <td width="80px">
      <a class="fa fa-pencil-square-o" title="Chỉnh sửa" href="index.php?p=slider_sua&idSlider={idSlider}"></a>
      <?php if($_SESSION['group']==1){ ?>
        <a onclick="return confirm('Bạn muốn xóa banner quảng cáo {altText}?')" class="fa fa-trash" title="Xóa" href="slider_xoa.php?idSlider={idSlider}"></a>
      <?php } ?>
    </td>
  </tr>
  <?php
    $str=ob_get_clean();
    $i++;
    $str=str_replace("{idSlider}",$row_sli['idSlider'],$str);
    $str=str_replace("{altText}",$row_sli['altText'],$str);
    $str=str_replace("{url}",$row_sli['url'],$str);
    $str=str_replace("{imgSrc}",$row_sli['imgSrc'],$str);
    $str=str_replace("{beginDate}",date("d-m-Y H:i:s",strtotime($row_sli['beginDate'])),$str);
    $str=str_replace("{endDate}",date("d-m-Y H:i:s",strtotime($row_sli['endDate'])),$str);
    $str=str_replace("{ThuTu}",$row_sli['ThuTu'],$str);
    echo $str;
  }
  ?>
</tbody>
</table>
