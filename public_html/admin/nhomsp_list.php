<?php require_once "checklogin.php";
	$sp=$i->ListNhomSP();
?>
<script type="text/javascript" src="../js/dataTable.js"></script>
<link rel="stylesheet" type="text/css" href="../css/dataTable.css"/>
<script>
	$(document).ready(function(e) {
		$('#table tfoot th').each( function () {
			var title = $('#table thead th').eq( $(this).index() ).text();
			$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		} );
		// DataTable
		var table = $('#table').DataTable(
			{
				"sPaginationType": "full_numbers",
				"iDisplayLength": 25,
			    "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
				"aaSorting" : [[0, 'desc']],
				initComplete: function ()
				{
				  var r = $('#table tfoot tr');
				  r.find('th').each(function(){
					$(this).css('padding', 8);
				  });
				  $('#table thead').append(r);
				  $('#search_0').css('text-align', 'center');
				},	
			}
		);
		// Apply the search
		table.columns().eq( 0 ).each( function ( colIdx ) {
			$( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
				table
					.column( colIdx )
					.search( this.value )
					.draw();
			});
		});
		$(document).on("click", ".anhien", function(e) {
			var $this = $(this), val;
			var idNSP=$(this).attr("idNSP");
			if($this.hasClass('anhien-hien')){
				$(".popup, .overlay").show();
				$(".popup button").attr('class','').addClass(idNSP);
			}else{
				$.ajax({
					url: "ajax_anhien.php",
					type: "POST",
					dataType: "JSON",
					cache: false,
					data: {"idNSP":idNSP,"text":''},
					success: function(data){
						if(data.success){
							$(".anhien-text-"+idNSP).text("");
							if($this.hasClass("anhien-an")){
								$this.removeClass("anhien-an").addClass("anhien-hien");
								$this.text("Đang Online");
							}
							else{	
								$this.removeClass("anhien-hien").addClass("anhien-an");
								$this.text("Chưa Online");
							}
						}
					}
				});
			}
        });
		$(document).on("click",".popup button",function(){
			idNSP = $(this).attr('class');
			val = $(".input-hide").val();
			if(val==''){
				return;
			}
			$.ajax({
				url: "ajax_anhien.php",
				type: "POST",
				dataType: "JSON",
				cache: false,
				data: {"idNSP":idNSP,"text":val},
				success: function(data){
					if(data.success){
						$(".popup, .overlay").hide();
						$(".anhien-text-"+idNSP).text("Lý do: " + val);
						if($("button[idNSP="+idNSP+"]").hasClass("anhien-an")){
							$("button[idNSP="+idNSP+"]").removeClass("anhien-an").addClass("anhien-hien");
							$("button[idNSP="+idNSP+"]").text("Đang Online");
						}
						else{	
							$("button[idNSP="+idNSP+"]").removeClass("anhien-hien").addClass("anhien-an");
							$("button[idNSP="+idNSP+"]").text("Chưa Online");
						}
					}
				}
			});
		});
		
		$(document).on("keypress",".popup .input-hide",function(e){
			if(e.which == 13){
				$('.popup button').click();
			}
		});
    });
</script>
<?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
<a class="addBtn" href="index.php?p=nhomsp_them">Thêm nhóm sản phẩm</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>idNSP</th>
    <th>Mã SP</th>
    <th>Tên</th>
    <th>Ngày tạo/<br />cập nhật</th>
    <th>Follow/<br />Đại diện</th>
    <th>Size</th>
    <th>Giá</th>
    <th>Giá giảm</th>
    <th>Hình</th>
    <th>SLX</th>
    <th>Mới/<br />Giảm giá</th>
    <th>Loại sản phẩm</th>
    <th>Thứ tự/<br />Ẩn hiện</th>
    <th>Hành động</th>
  </tr>
</thead>
<tfoot>
  <tr>
    <th>idNSP</th>
    <th>Mã SP</th>
    <th>Tên</th>
    <th>Ngày tạo/<br />cập nhật</th>
    <th>Follow/<br />Đại diện</th>
    <th>Size</th>
    <th>Giá</th>
    <th>Giá giảm</th>
    <th>Hình</th>
    <th>SLX</th>
    <th>Mới/<br />Giảm giá</th>
    <th>Loại sản phẩm</th>
    <th>Thứ tự/<br />Ẩn hiện</th>
    <th>Hành động</th>
  </tr>
</tfoot>
<tbody>
  <?php while($row_sp=mysql_fetch_assoc($sp)){
	  $h=$i->ListHinhTheoNSP($row_sp['idNSP']);
	  $n=mysql_num_rows($h);
	  ob_start();  
  ?>
  <tr>
    <td>{idNSP}</td>
    <td><a class="action" href="index.php?p=sanpham_list&idNSP={idNSP}">{SKU}</a></td>
    <td>{Ten}</td>
    <td>{NgayTao}<br />{NgayCapNhat}</td>
    <td>{follow}/{represent}</td>
    <td>{Size1}<br />{Size2}<br />{Size3}</td>
    <td>{Gia1_vn}<br />{Gia2_vn}<br />{Gia3_vn}</td>
    <td>{GiaChuaGiam1_vn}<br />{GiaChuaGiam2_vn}<br />{GiaChuaGiam3_vn}</td>
    <td>{Hinh}</td>
    <td>{SLX}</td>
    <td>{new}/{discount}</td>
    <td>{LoaiSP}</td>
    <td>{ThuTu}<br />
    <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
    <button idNSP="{idNSP}" class="anhien <?php echo ($row_sp['AnHien']==1)?" anhien-hien":" anhien-an" ?>" tooltip="<?php echo ($row_sp['AnHien']==1)?"Nhấn để ẩn":"Nhấn để hiện" ?>">{AnHien}</button>
    <?php }else{ ?>
		<button class="<?php echo ($row_sp['AnHien']==1)?" anhien-hien":" anhien-an" ?>">{AnHien}</button>
	<?php } ?>
    <p class="anhien-text-{idNSP}">{LyDoAn}</p>
    </td>
    <td>
    	<a href="http://bitas.com.vn/<?php echo $i->changeTitle($row_sp['Ten']) . '-' . $row_sp['idNSP']?>/" class="preview btn" target="_blank">Xem trước</a>
        <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
		<?php if($n>=1){?>
        	<a class="icon icon-img-del" onclick="return confirm('Bạn muốn hình ảnh zoom của sản phẩm {Ten}?')" href="nhomsp_xoahinhzoom.php?idNSP={idNSP}" title="Xóa ảnh zoom"></a>
		<?php } else {?>
        	<a class="icon icon-img" href="index.php?p=nhomsp_themhinhzoom&idNSP={idNSP}" title="Thêm ảnh zoom"></a>
		<?php }?>
	        <a class="icon icon-edit" href="index.php?p=nhomsp_sua&idnsp={idNSP}" title="Chỉnh sửa"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){?>
	        <a onclick="return confirm('Bạn muốn xóa nhóm sản phẩm {Ten}?')" class="icon icon-del" href="nhomsp_xoa.php?idnsp={idNSP}" title="Xóa"></a>
        <?php } ?>
   </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idNSP}",$row_sp['idNSP'],$str);
	$str=str_replace("{SKU}",$row_sp['SKU'],$str);
	$str=str_replace("{SLX}",$row_sp['SoLanXem'],$str);
	$str=str_replace("{NgayTao}",date("d/m/Y",strtotime($row_sp['NgayTao'])),$str);
	$str=str_replace("{NgayCapNhat}",date("d/m/Y",strtotime($row_sp['NgayCapNhat'])),$str);
	$str=str_replace("{follow}",$row_sp['follow'],$str);
	$str=str_replace("{represent}",$row_sp['represent'],$str);
	$str=str_replace("{Size1}",$row_sp['Size1'],$str);
	$str=str_replace("{Size2}",$row_sp['Size2'],$str);
	$str=str_replace("{Size3}",$row_sp['Size3'],$str);
	$str=str_replace("{Hinh}","<img width='120px' src='../$row_sp[Hinh]'>",$str);
	$str=str_replace("{new}",($row_sp['New']==1)?"Có":"Không",$str);
	$str=str_replace("{discount}",($row_sp['Discount']==1)?"Có":"Không",$str);
	$str=str_replace("{LoaiSP}",$row_sp['TenTL'],$str);
	$str=str_replace("{ThuTu}",$row_sp['ThuTu'],$str);
	$str=str_replace("{AnHien}",($row_sp['AnHien']==1)?"Đang Online":"Chưa Online",$str);
	$str=str_replace("{Gia1_vn}",($row_sp['Gia1_vn']>0)?number_format($row_sp['Gia1_vn'],0,".",",")." VND":"",$str);
	$str=str_replace("{Gia2_vn}",($row_sp['Gia2_vn']>0)?number_format($row_sp['Gia2_vn'],0,".",",")." VND":"",$str);
	$str=str_replace("{Gia3_vn}",($row_sp['Gia3_vn']>0)?number_format($row_sp['Gia3_vn'],0,".",",")." VND":"",$str);
	$str=str_replace("{GiaChuaGiam1_vn}",($row_sp['GiaChuaGiam1_vn']>0)?number_format($row_sp['GiaChuaGiam1_vn'],0,".",",")." VND":"",$str);
	$str=str_replace("{GiaChuaGiam2_vn}",($row_sp['GiaChuaGiam2_vn']>0)?number_format($row_sp['GiaChuaGiam2_vn'],0,".",",")." VND":"",$str);
	$str=str_replace("{GiaChuaGiam3_vn}",($row_sp['GiaChuaGiam3_vn']>0)?number_format($row_sp['GiaChuaGiam3_vn'],0,".",",")." VND":"",$str);
	$str=str_replace("{Ten}",$row_sp['Ten'],$str);
	$str=str_replace("{idNSP}",$row_sp['idNSP'],$str);
	$str=str_replace("{LyDoAn}",$row_sp['LyDoAn']?"<br />Lý do: " . $row_sp['LyDoAn']:'',$str);
	echo $str;
  }
  ?>
</tbody>
</table>
<div class="overlay"></div>
<div class="popup">
    	<input type="text" placeholder="Lý do ẩn" class="input-hide" />
        <button class="">Submit</button>
        <!--<i class="fa fa-times-circle"></i>-->
</div>