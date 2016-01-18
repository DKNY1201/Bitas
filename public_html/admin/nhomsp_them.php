<?php require_once "checklogin.php";
	$lsp=$i->ListLSPDSG();
	$mau=$i->ListColor();
	$nspf=$i->ListNhomSPFollow();
	$l=$i->ListNgonNgu();
	if(isset($_POST['submit']))
	{
		$i->ThemNhomSP();
		header("location:index.php?p=nhomsp_list");
	}
?>
<script>
	$(document).ready(function(e) {
		$(".gia_anhien").attr("disabled","disabled");
		var fl=$("#follow").val();
		if(fl==0)
			$("#daidien").attr("checked",true);
		$("#follow").change(function(e) {
			var fl=$("#follow").val();
            if(fl!=0){
				$("#daidien").attr("checked",false);
				
				$(".anhien_cb").attr("disabled","disabled");
				/*
				$("#new").attr("checked",false);
				$("#giamgia").attr("checked",false);	

				$(".anhien").attr("disabled","disabled");
				$(".anhien").val("");	
				*/
				
			}
			else if(fl==0){
				
				//$(".anhien").removeAttr("disabled");
				$(".anhien_cb").removeAttr("disabled");
				$("#daidien").attr("checked",true);
			}
        });

		//check vào mới thì giảm giá disable
		$("#new").click(function(e) {
            var stt=this.checked;
			if(stt==true)
				$("#giamgia").attr("disabled","disabled");
			else if(stt==false)
				$("#giamgia").removeAttr("disabled");
        });

		//check vào giảm giá thì mới disable
		$("#giamgia").click(function(e) {
            var stt=this.checked;
			if(stt==true){
				$("#new").attr("disabled","disabled");
				$(".gia_anhien").removeAttr("disabled");
			}
			else if(stt==false){
				$("#new").removeAttr("disabled");
				if($(".bst").val()==0){
					$(".gia_anhien").attr("disabled","disabled");
					$(".gia_anhien").val("");
				}else{
					return;
				}
			}
        });
		
		// Bo suu tap
		$(".bst").on("change", function(){
			$this = $(this);
			var idBST = $this.val();
			if(idBST!=0){
				$(".gia_anhien").removeAttr("disabled");
			}
			else{
				$(".gia_anhien").attr("disabled","disabled");
				$(".gia_anhien").val("");
			}
		});
		

		//Validate
		$('#adminForm').validationEngine();
    });
</script>
<script type="text/javascript">
function BrowseServer( startupPath, functionData ){
	var finder = new CKFinder();
	finder.basePath = 'ckfinder/'; //Đường path nơi đặt ckfinder
	finder.startupPath = startupPath; //Đường path hiện sẵn cho user chọn file
	finder.selectActionFunction = SetFileField; // hàm sẽ được gọi khi 1 file được chọn
	finder.selectActionData = functionData; //id của text field cần hiện địa chỉ hình
	//finder.selectThumbnailActionFunction = ShowThumbnails; //hàm sẽ được gọi khi 1 file thumnail được chọn	
	finder.popup(); // Bật cửa sổ CKFinder
} //BrowseServer

function SetFileField( fileUrl, data ){
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}
function ShowThumbnails( fileUrl, data ){	
	var sFileName = this.getSelectedFile().name; // this = CKFinderAPI
	document.getElementById( 'thumbnails' ).innerHTML +=
	'<div class="thumb">' +
	'<img src="' + fileUrl + '" />' +
	'<div class="caption">' +
	'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
	'</div>' +
	'</div>';
	document.getElementById('preview').style.display = "";
	return false; // nếu là true thì ckfinder sẽ tự đóng lại khi 1 file thumnail được chọn
}
</script>

<form action="" method="post" id="adminForm">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Tên</td>
        <td colspan="3"><input type="text" name="ten" class="txt validate[required]" /></td>
      </tr>
      <tr>
        <td>Mã SP</td>
        <td colspan="3"><input type="text" name="sku" class="txt validate[required]" /></td>
      </tr>
      <tr>
        <td>OG Title</td>
        <td colspan="3"><input type="text" name="ogtitle" class="txt" /></td>
      </tr>
      <tr>
        <td>OG Description</td>
        <td colspan="3"><textarea rows="5" cols="50" name="ogdesc" class="" /></textarea></td>
      </tr>
      <tr>
        <td>OG Image</td>
        <td colspan="3">
        	<input type="text" name="ogimg" id="ogimg" class="txt" />
        	<label>
            <input onclick="BrowseServer('Images:/','ogimg')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn" />
            </label>
        </td>
      </tr>
      <tr>
        <td>Mô tả VN</td>
        <td align="left" colspan="3">
        	<textarea name="mota_vn" id="mota_vn"></textarea>
            <script type="text/javascript">CKEDITOR.replace('mota_vn'); </script>
        </td>
      </tr>
      <!--
      <tr>
        <td>Mô tả EN</td>
        <td align="left" colspan="3">
        	<textarea name="mota_en" id="mota_en"></textarea>
            <script type="text/javascript">CKEDITOR.replace('mota_en'); </script>
        </td>
      </tr>
      -->
      <tr>
        <td>Chọn nhóm sản phẩm chính</td>
        <td colspan="3">
            <select name="follow" id="follow">
            	<option value="0">Nhóm SP này là nhóm SP chính</option>
					<?php while($row_nspf=mysql_fetch_assoc($nspf)){?>
                    <option value="<?php echo $row_nspf['idNSP']?>"><?php echo $row_nspf['Ten']?></option>
                 	<?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td>Bộ sưu tập</td>
        <td colspan="3">
            <select name="bst" class="bst">
            	<option value="0">Chọn Bộ sưu tập</option>
					<?php 
						$bst = $i -> ListBST();
						while($row_bst=mysql_fetch_assoc($bst)){	
					?>
                    <option value="<?php echo $row_bst['idBST']?>"><?php echo $row_bst['Ten']?></option>
                 	<?php }?>
            </select>
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="daidien" id="daidien" class="anhien_cb" checked="checked" /> Đại diện</td>
        <td><input type="checkbox" name="moi" id="new" /> Mới</td>
        <td><input type="checkbox" name="giamgia" id="giamgia" /> Giảm giá</td>
        <td><!--<input type="checkbox" name="anhien" /> Hiện --></td>
      </tr>
      <tr>
        <td>Màu</td>
        <td colspan="3">
        <select name="mau" id="mau">
        	<?php while($row_mau=mysql_fetch_assoc($mau)){?>
                <option value="<?php echo $row_mau['idMau']?>"><?php echo $row_mau['Ten_vn']?></option>
            <?php }?>
        </select>
        </td>
      </tr>
      <tr>
      	<td>Size</td>
        <td><input type="text" name="size1" class="size anhien validate[required]" /></td>
      </tr>
      <tr>
      	<td>Giá</td>
        <td>Giá 1 <input type="number" max="1000000" name="gia1_vn" class="size anhien validate[required]" /></td>
        <td>Giá 2 <input type="number" max="1000000" name="gia2_vn" class="size anhien" /></td>
        <td>Giá 3 <input type="number" max="1000000" name="gia3_vn" class="size anhien" /></td>
      </tr>
      <tr>
      	<td>Giá chưa giảm</td>
        <td>Giá chưa giảm 1 <input type="number" max="1000000" name="giachuagiam1_vn" class="size gia_anhien validate[required]" /></td>
        <td>Giá chưa giảm 2 <input type="number" max="1000000" name="giachuagiam2_vn" class="size gia_anhien" /></td>
        <td>Giá chưa giảm 3 <input type="number" max="1000000" name="giachuagiam3_vn" class="size gia_anhien" /></td>
      </tr>
      <tr>
        <td>Hình</td>
        <td colspan="3">
        	<input type="text" name="hinh" id="hinh" class="txt validate[required]" />
            <label>
            <input onclick="BrowseServer('Images:/','hinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn" />
            </label>
            <div id="preview">
               <div id="thumbnails"></div>
            </div>   
        </td>
      </tr>
      <tr>
        <td>Loại sản phẩm</td>
        <td colspan="3">
        <select name="loaisp">
            <?php while($row_lsp=mysql_fetch_assoc($lsp)) {?>
            <option value="<?php echo $row_lsp['idlspdsg']?>"><?php echo $row_lsp['Ten_vn']?></option>
            <?php }?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Thứ tự</td>
        <td colspan="3"><input type="text" class="txt" name="thutu"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Thêm" class="btn" /></td>
      </tr>
    </table>
</form>