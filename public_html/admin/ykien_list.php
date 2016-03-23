<?php require_once "checklogin.php";
	$yk=$i->ListYKienAll();
	
	if(isset($_POST['boduyet']))
	{
		$listyk=$_POST['listyk'];
		$listyk_arr=explode(",",$listyk);
		for($j=0;$j<count($listyk_arr);$j++)
		{
			$i->BoDuyetYKien($listyk_arr[$j]);
		}
		header("location:index2.php?p=ykien_list_daduyet");
	}
		
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

    // Approve/Unapproved comment
    $("body").on("click",".approve",function(e){
      e.preventDefault();
      var $this = $(this);
      var idYK = $this.attr("idyk");
      $.ajax({
        url: "ajax_approve_comment.php",
        type: "POST",
        dataType: "JSON",
        cache: false,
        data: {"idYK":idYK},
        success: function(data){
          if(data.success){
            if($this.hasClass("fa-ban")){
              $this.removeClass("fa-ban").addClass("fa-check");
              $this.attr("title","Duyệt");
              $this.parents("tr").find("td.approve-td").text("Chưa duyệt");
            }
            else{ 
              $this.removeClass("fa-check").addClass("fa-ban");
              $this.attr("title","Bỏ duyệt");
              $this.parents("tr").find("td.approve-td").text("Đã duyệt");
            }
          }
        }
      });
    })
  });
</script>

<table id="table" class="display customer-comment" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Ngày giờ</th>
    <th>Tình trạng</th>
    <th>Sản phẩm</th> 
    <th>Khách hàng</th>
    <th>IP</th>
    <th>Ý kiến</th>
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
    <td>{idYK}</td>
    <td>{Ngay}</td>
    <td class="approve-td">{Duyet}</td>
    <td><a class="action" href="http://bitas.com.vn/<?php echo $i->changeTitle($row_nsp_m['Ten']) . '-' . $row_nsp_m['idNSP']?>/" target="_blank">{NSP}</a></td>
    <td>Tên khách hàng: {TenKH}<br />{Email}</td>
    <td>{IP}</td>
    <td><p class="ngay">Được ghi nhận vào ngày: {Ngay}</p><p class="noidung">{NoiDung}</p></td>
    <td>{TraLoi}</td>
    <td class="action">
    <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
      <a idyk="{idYK}" class="fa approve <?php echo $row_yk['Duyet']==1 ? 'fa-ban' : 'fa-check' ?>" title="<?php echo $row_yk['Duyet']==1 ? 'Bỏ duyệt' : 'Duyệt' ?>"></a>
      <?php if($_SESSION['group']==1){?>
    	<a class="fa fa-comment" title="Trả lời ý kiến" href="index2.php?p=ykien_traloi&idyk={idYK}"></a>
    	<a onclick="return confirm('Bạn muốn xóa ý kiến của khách hàng {TenKH}?')" class="fa fa-trash" title="Xóa ý kiến" href="ykien_xoa.php?idyk={idYK}"></a>
      <?php }?>
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