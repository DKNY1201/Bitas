<?php require_once "checklogin.php";
	$cl=$i->ListColor();
?>
<script type="text/javascript" src="../js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
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
				"iDisplayLength": -1,
			}
			
		);
    });
</script>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	<a class="addBtn" href="index.php?p=color_them">Thêm màu</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th><input type="checkbox" name="checkall"></th>
    <th>idMau</th>
    <th>Mã màu</th>
    <th>Tên màu</th>
    <th>Tên VN</th>
    <th>Tên EN</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_cl=mysql_fetch_assoc($cl)){
	ob_start();
  ?>
  <tr>
  	<td><input type="checkbox" name="check"></td>
    <td>{idCL}</td>
    <td>{MaMau}</td>
    <td>{TenMau}</td>
    <td>{Ten_vn}</td>
    <td>{Ten_en}</td>
    
    <td>
    	<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    		<a class="icon icon-edit" title="Chỉnh sửa" href="index.php?p=color_sua&idcl={idCL}"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){ ?>
        	<a onclick="return confirm('Bạn muốn xóa màu {MaMau}?')" class="icon icon-del" title="Xóa" href="color_xoa.php?idcl={idCL}"></a>
        <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idCL}",$row_cl['idMau'],$str);
	$str=str_replace("{MaMau}",$row_cl['MaMau'],$str);
	$str=str_replace("{TenMau}",$row_cl['TenMau'],$str);
	$str=str_replace("{Ten_vn}",$row_cl['Ten_vn'],$str);
	$str=str_replace("{Ten_en}",$row_cl['Ten_en'],$str);
	
	echo $str;
  }
  ?>
</tbody>
</table>