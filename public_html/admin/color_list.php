<?php require_once "checklogin.php";
	$cl=$i->ListColor();
?>
<script>
	$(document).ready(function(e) {
        $('input[name=checkall]').click(function(e) {
            var stt=this.checked;
			$('input[name=check]').each(function(index, element) {
                this.checked=stt;
            });
        });
		
		//data table
	  $('#table').dataTable(
    {
      "sPaginationType": "full_numbers",
      "iDisplayLength": 25,
      "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
      "aaSorting" : [[0, 'desc']],
    }
    );
    });
</script>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	<a class="btn-action btn-info" href="index.php?p=color_them"><i class="fa fa-plus"></i> Thêm màu</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Mã màu</th>
    <th>Tên màu</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_cl=mysql_fetch_assoc($cl)){
	ob_start();
  ?>
  <tr>
    <td>{idCL}</td>
    <td>{MaMau}</td>
    <td>{Ten_vn}</td>    
    <td>
    	<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    		<a class="fa fa-pencil-square-o" title="Chỉnh sửa" href="index.php?p=color_sua&idcl={idCL}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){ ?>
        	<a onclick="return confirm('Bạn muốn xóa màu {MaMau}?')" class="fa fa-trash" title="Xóa" href="color_xoa.php?idcl={idCL}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idCL}",$row_cl['idMau'],$str);
	$str=str_replace("{MaMau}",$row_cl['MaMau'],$str);
	$str=str_replace("{Ten_vn}",$row_cl['Ten_vn'],$str);	
	echo $str;
  }
  ?>
</tbody>
</table>