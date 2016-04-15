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
      "aaSorting" : [[0, 'desc']],
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
    <th>Thứ tự</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_sli=mysql_fetch_assoc($sli)){
	ob_start();  
  ?>
  <tr>
    <td>{idSlider}</td>
    <td><img src="{imgSrc}" alt="{altText}" /></td>
    <td><a href="{url}" target="blank">{url}</a></td>
    <td>{altText}</td>
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
    $str=str_replace("{idSlider}",$row_sli['idSlider'],$str);
    $str=str_replace("{altText}",$row_sli['altText'],$str);
    $str=str_replace("{url}",$row_sli['url'],$str);
    $str=str_replace("{imgSrc}",$row_sli['imgSrc'],$str);
    $str=str_replace("{ThuTu}",$row_sli['ThuTu'],$str);
    echo $str;
  }
  ?>
</tbody>
</table>
