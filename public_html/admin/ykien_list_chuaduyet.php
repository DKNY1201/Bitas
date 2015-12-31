<?php require_once "checklogin.php";
	$yk=$i->ListYKienChuaDuyet();
	
	if(isset($_POST['duyet']))
	{
		$listyk=$_POST['listyk'];
		$listyk_arr=explode(",",$listyk);
		for($j=0;$j<count($listyk_arr);$j++)
		{
			$i->DuyetYKien($listyk_arr[$j]);
		}
		header("location:index.php?p=ykien_list_chuaduyet");
	}
		
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
		
		//them idYK vao input listyk
		
		$('#duyet').click(function(e) {
			//alert(1);
			var val="";
            $("input[name='check']").each(function() {
        		if(this.checked) val=val+","+this.value;       
            });
			val=val.substr(1);
			$("#listid").val(val);
        });
		
		//data table
		$('#table').dataTable(
			{"sPaginationType": "full_numbers"}
		);
    });
</script>

<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th><input type="checkbox" name="checkall"></th>
    <th>Khách hàng</th>
    <th>IP<br />Trình duyệt</th>
    <th>Ý kiến</th>
    <th>Sản phẩm</th>    
    <th>Duyệt</th>
    <th>Trả lời</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_yk=mysql_fetch_assoc($yk)){
	  $nsp_m=$i->LayNSP_Mau($row_yk['idNSP']);
	  $row_nsp_m=mysql_fetch_assoc($nsp_m);
	ob_start();  
  ?>
  <tr>
  	<td><input type="checkbox" name="check" value="{idYK}"></td>
    <td>Tên khách hàng: {TenKH}<br />{Email}</td>
    <td>{IP}<br />{Agent}</td>
    <td><p class="ngay">Được ghi nhận vào ngày: {Ngay}</p><p class="noidung">{NoiDung}</p></td>
    <td><a class="action" href="http://bitas.com.vn/products/detail/{idNSP}/" target="_blank">{NSP}</a></td>
    <td>{Duyet}</td>
    <td>{TraLoi}</td>
    <td>
    <?php if($_SESSION['group']==1){ ?>
    	<a class="icon icon-edit" title="Trả lời ý kiến" href="index.php?p=ykien_traloi&idyk={idYK}"></a>
	    <a onclick="return confirm('Bạn muốn xóa ý kiến của khách hàng {TenKH}?')" class="icon icon-del" title="Xóa ý kiến" href="ykien_xoa.php?idyk={idYK}"></a>
    <?php } ?>
    </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idYK}",$row_yk['idYK'],$str);
	$str=str_replace("{TenKH}",$row_yk['TenKH'],$str);
	$str=str_replace("{Email}","<a class='action' href='mailto:$row_yk[Email]'>$row_yk[Email]</a>",$str);
	$str=str_replace("{IP}",$row_yk['IP'],$str);
	$str=str_replace("{Agent}",$row_yk['Agent'],$str);
	$str=str_replace("{Ngay}",date("d/m/Y H:i:s",strtotime($row_yk['NgayYK'])),$str);
	$str=str_replace("{NoiDung}",$row_yk['NoiDung'],$str);
	$str=str_replace("{idNSP}",$row_nsp_m['idNSP'],$str);
	$str=str_replace("{TraLoi}",$row_yk['TraLoi'],$str);
	$str=str_replace("{NSP}",$row_nsp_m['Ten']." ".$row_nsp_m['Mau'],$str);
	$str=str_replace("{Duyet}",($row_yk['Duyet']==1)?"Đã duyệt":"Chưa duyệt",$str);
	echo $str;
  }
  ?>
   </tbody>
</table>
<div class="clear"></div>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    <form action="" method="post">
        <input type="hidden" value="" name="listyk" id="listid" />
        <input style="margin-left:10px" type="submit" name="duyet" class="btn" value="Duyệt" id="duyet" />
    </form>
<?php } ?>