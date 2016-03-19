<?php 
	require_once "checklogin.php";
	$sp=$i->ListNhomSP();
?>
<script>
	$(document).ready(function(e) {
		$('#table').dataTable(
			{
				"sPaginationType": "full_numbers",
				"iDisplayLength": 25,
			  "aLengthMenu": [[25, 50, 100, 200, -1], [25, 50, 100, 200, "All"]],
				"aaSorting" : [[0, 'desc']],
			}
		);

		$(document).on("click", ".anhien", function(e) {
			var $this = $(this), val;
			var idNSP=$this.attr("idNSP");
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
<a class="btn-action btn-info" href="index2.php?p=nhomsp_them"><i class="fa fa-plus"></i> Thêm nhóm sản phẩm</a>
<?php } ?>
<table id="table" class="display" width="100%" cellspacing="0" cellpadding="4">
<thead>
  <tr>
    <th>Thứ tự</th>
    <th>Tình trạng</th>
    <th>Mã SP</th>
    <th>Hình ảnh</th>
    <th>Tên</th>
    <th>Màu</th>
    <th>Loại sản phẩm</th>
    <th>Hành động</th>
  </tr>
</thead>
<tbody>
  <?php while($row_sp=mysql_fetch_assoc($sp)){
	  $h=$i->ListHinhTheoNSP($row_sp['idNSP']);
	  $n=mysql_num_rows($h);
	  ob_start();  
  ?>
  <tr>
    <td>{idNSP}</td>
    <td>
	    <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
	    <button idNSP="{idNSP}" class="anhien <?php echo ($row_sp['AnHien']==1)?" anhien-hien":" anhien-an" ?>" tooltip="<?php echo ($row_sp['AnHien']==1)?"Nhấn để ẩn":"Nhấn để hiện" ?>">{AnHien}</button>
	    <?php }else{ ?>
			<button class="<?php echo ($row_sp['AnHien']==1)?" anhien-hien":" anhien-an" ?>">{AnHien}</button>
		<?php } ?>
	    <p class="anhien-text-{idNSP}">{LyDoAn}</p>
    </td>
    <td>{SKU}</td>
    <td>{Hinh}</td>
    <td><a class="action" href="index2.php?p=sanpham_list&idNSP={idNSP}">{Ten}</a></td>
    <td>{Mau}</td>
    <td>{LoaiSP}</td>   
    <td>
    	<a href="http://bitas.com.vn/<?php echo $i->changeTitle($row_sp['Ten']) . '-' . $row_sp['idNSP']?>/" class="preview btn" target="_blank">Xem trước</a>
        <?php if($_SESSION['group']==1 || $_SESSION['group']==8){ ?>
		<?php if($n>=1){?>
        	<a class="fa fa-chain-broken" onclick="return confirm('Bạn muốn hình ảnh zoom của sản phẩm {Ten}?')" href="nhomsp_xoahinhzoom.php?idNSP={idNSP}" title="Xóa ảnh zoom"></a>
		<?php } else {?>
        	<a class="fa fa-picture-o" href="index2.php?p=nhomsp_themhinhzoom&idNSP={idNSP}" title="Thêm ảnh zoom"></a>
		<?php }?>
	        <a class="fa fa-pencil-square-o" href="index2.php?p=nhomsp_sua&idnsp={idNSP}" title="Chỉnh sửa"></a>
        <?php } ?>
        <?php if($_SESSION['group']==1){?>
	        <a onclick="return confirm('Bạn muốn xóa nhóm sản phẩm {Ten}?')" class="fa fa-trash" href="nhomsp_xoa.php?idnsp={idNSP}" title="Xóa"></a>
        <?php } ?>
   </td>
  </tr>
  <?php $str=ob_get_clean();
	$str=str_replace("{idNSP}",$row_sp['idNSP'],$str);
	$str=str_replace("{SKU}",$row_sp['SKU'],$str);
	$str=str_replace("{Mau}",$row_sp['Mau'],$str);;
	$str=str_replace("{Hinh}","<img width='120px' src='../$row_sp[Hinh]'>",$str);
	$str=str_replace("{LoaiSP}",$row_sp['TenTL'],$str);
	$str=str_replace("{AnHien}",($row_sp['AnHien']==1)?"Đang Online":"Chưa Online",$str);
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