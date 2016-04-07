<?php require_once "checklogin.php";
	if(isset($_GET['idnsp']))
		$idnsp=$_GET['idnsp'];
	$nsp=$i->ChiTietNhomSP($idnsp);
	$row_nsp=mysql_fetch_assoc($nsp);
	$fl=$i->ListNhomSPFollow();
	$mau=$i->ListColor();
	$lsp=$i->ListLSPDSG();
	if(isset($_POST['submit']))
	{
		$i->SuaNhomSP($idnsp);
		header("location:index.php?p=nhomsp_list");
	}
?>
<script>
	$(document).ready(function(e) {
		var idNSP=$("#nsp_h").val();
		var fl=$("#follow").val();
		var daidien=$("#daidien_h").val();
		if(daidien==0){
			//$(".anhien").attr("disabled","disabled");
			$(".anhien_cb").attr("disabled","disabled");
			//$(".gia_anhien").attr("disabled","disabled");
		}
		// Kiem tra ban dau neu san pham moi thi an checkbox new & show giagiam ra
		var stt_gg=$("#gg_h").val();
		var stt_bst = $("#bst_h").val();
		if(stt_gg==0 && stt_bst==0){
			$(".gia_anhien").attr("disabled","disabled");	
		}
		else if(stt_gg==1){
			$("#new").attr("disabled","disabled");
		}
		// Kiem tra ban dau neu san pham moi thi an checkbox new & show giagiam ra
		var stt_new=$("#new_h").val();
		//alert(stt_new);
		if(stt_new==1){
			$("#giamgia").attr("disabled","disabled");
		}
		if(fl==0)
			$("#daidien").attr("checked",true);
		$("#follow").change(function(e) {
			var fl=$("#follow").val();
            if(fl!=idNSP){
				$("#daidien").attr("checked",false);
				$(".anhien_cb").attr("disabled","disabled");
				/*
				$("#new").attr("checked",false);
				$("#giamgia").attr("checked",false);			
				$(".anhien").attr("disabled","disabled");
				$(".anhien").val("");
				$(".gia_anhien").attr("disabled","disabled");
				$(".gia_anhien").val("");
				*/
			}
			else if(fl==idNSP){
				$(".anhien").removeAttr("disabled");
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
				$(".gia_anhien").attr("disabled","disabled");
				$(".gia_anhien").val("");
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
        <td colspan="3"><input type="text" name="ten" class="txt validate[required]" value="<?php echo $row_nsp['Ten']?>" /></td>
      </tr>      
      <tr>
        <td>Mã SP</td>
        <td colspan="3"><input type="text" name="sku" class="txt validate[required]" value="<?php echo $row_nsp['SKU']?>" /></td>
      </tr>
      <tr>
        <td>OG Title</td>
        <td colspan="3"><input type="text" name="ogtitle" class="txt" value="<?php echo $row_nsp['ogTitle']?>" /></td>
      </tr>
      <tr>
        <td>OG Description</td>
        <td colspan="3"><textarea rows="5" cols="50" name="ogdesc" class="" /><?php echo $row_nsp['ogDesc']?></textarea></td>
      </tr>
      <tr>
        <td>OG Image</td>
        <td colspan="3">
        	<input type="text" name="ogimg" id="ogimg" class="txt" value="<?php echo $row_nsp['ogImg']?>" />
        	<label>
            <input onclick="BrowseServer('Images:/','ogimg')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn green" />
            </label>
        </td>
      </tr>      
      <tr>
        <td>Mô tả VN</td>
        <td align="left" colspan="3">
        	<textarea name="mota_vn" id="mota_vn"><?php echo $row_nsp['MoTa_vn']?></textarea>
            <script type="text/javascript">CKEDITOR.replace('mota_vn');</script>
        </td>
      </tr>
	<!--
      <tr>
        <td>Mô tả EN</td>
        <td align="left" colspan="3">
        	<textarea name="mota_en" id="mota_en"><?php echo $row_nsp['MoTa_en']?></textarea>
            <script type="text/javascript">CKEDITOR.replace('mota_en');</script>
        </td>
      </tr>
	-->
      <tr>
        <td>Chọn nhóm sản phẩm chính</td>
        <td colspan="3">
            <select name="follow" id="follow">
            	<option value="<?php echo $row_nsp['idNSP']?>">Nhóm SP này là nhóm SP chính</option>
                <?php while($row_nspf=mysql_fetch_assoc($fl)){
					$idnspf=$row_nsp['follow'];
				   	$s="";
				   	if($idnspf==$row_nspf['idNSP'])
				   	$s="selected=selected";
				?>
                <option value="<?php echo $row_nspf['idNSP']?>" <?php echo $s?>><?php echo $row_nspf['Ten']?></option>
                <?php }?>
            </select>
            <input type="hidden" name="daidien_h" id="daidien_h" value="<?php echo $row_nsp['represent']?>" />
            <input type="hidden" name="nsp_h" id="nsp_h" value="<?php echo $idnsp?>" />
        </td>
      </tr>
      <tr>
        <td>Bộ sưu tập</td>
        <td colspan="3">
            <select name="bst" class="bst">
            	<option value="0">Bộ sưu tập</option>
                <?php 
					$bst = $i -> ListBST();
					while($row_bst=mysql_fetch_assoc($bst)){
						$idbst=$row_nsp['idBST'];
						$s="";
						if($idbst==$row_bst['idBST'])
							$s="selected=selected";
				?>
                <option value="<?php echo $row_bst['idBST']?>" <?php echo $s?>><?php echo $row_bst['Ten']?></option>
                <?php }?>
            </select>
            <input type="hidden" id="bst_h" value="<?php echo $row_nsp['idBST']; ?>" />
        </td>
      </tr>
      <tr>
        <td><input type="checkbox" name="daidien" id="daidien" class="anhien_cb" <?php if($row_nsp['represent']==1) echo "checked=checked"?> /> Đại diện</td>
        <td><input type="checkbox" name="moi" id="new" <?php if($row_nsp['New']==1) echo "checked=checked"?> /> Mới <input type="hidden" name="new_h" id="new_h" value="<?php echo $row_nsp['New']?>" /></td>
        <td><input type="checkbox" name="giamgia" id="giamgia" <?php if($row_nsp['Discount']==1) echo "checked=checked"?> /> Giảm giá <input type="hidden" name="gg_h" id="gg_h" value="<?php echo $row_nsp['Discount']?>" /></td>
        <td><!--<input type="checkbox" name="anhien" <?php if($row_nsp['AnHien']==1) echo "checked=checked"?> /> Hiện--></td>
      </tr>
      <tr>
        <td>Màu</td>
        <td colspan="3">
        <select name="mau">
            <option value="0">Chọn màu</option>
            <?php while($row_mau=mysql_fetch_assoc($mau)){
				$idmau=$row_nsp['idMau'];
				$s="";
				if($idmau==$row_mau['idMau'])
					$s="selected=selected";
			?>
            <option value="<?php echo $row_mau['idMau']?>" <?php echo $s?>><?php echo $row_mau['Ten_vn']?></option>
            <?php }?>
        </select>
        </td>
      </tr>
      <tr>
      	<td>Size</td>
        <td><input type="text" name="size1" class="size anhien validate[required]" value="<?php echo $row_nsp['Size1']?>" /></td>
      </tr>
      <tr>
      	<td>Giá</td>
        <td>Giá 1 <input type="number" max="1000000" name="gia1_vn" class="size anhien validate[required]" value="<?php echo $row_nsp['Gia1_vn']?>" /></td>
        <td>Giá 2 <input type="number" max="1000000" name="gia2_vn" class="size anhien" value="<?php echo $row_nsp['Gia2_vn']?>" /></td>
        <td>Giá 3 <input type="number" max="1000000" name="gia3_vn" class="size anhien" value="<?php echo $row_nsp['Gia3_vn']?>" /></td>
      </tr>
      <tr>
       	<td>Giá chưa giảm</td>
        <td>Giá chưa giảm 1 <input type="number" max="1000000" name="giachuagiam1_vn" class="size gia_anhien validate[required]" value="<?php echo $row_nsp['GiaChuaGiam1_vn']?>"/></td>
        <td>Giá chưa giảm 2 <input type="number" max="1000000" name="giachuagiam2_vn" class="size gia_anhien" value="<?php echo $row_nsp['GiaChuaGiam2_vn']?>"/></td>
        <td>Giá chưa giảm 3 <input type="number" max="1000000" name="giachuagiam3_vn" class="size gia_anhien" value="<?php echo $row_nsp['GiaChuaGiam3_vn']?>"/></td>
      </tr>
      <tr>
        <td>Hình</td>
        <td colspan="3">
        	<input type="text" name="hinh" id="hinh" class="txt validate[required]" value="<?php echo $row_nsp['Hinh']?>" />
            <label>
            <input onclick="BrowseServer('Images:/','hinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn green" />
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
            <?php while($row_lsp=mysql_fetch_assoc($lsp)) {
				$idlsp=$row_nsp['idlspdsg'];
				$s="";
				if($idlsp==$row_lsp['idlspdsg'])
					$s="selected=selected";	
			?>
            <option value="<?php echo $row_lsp['idlspdsg']?>" <?php echo $s?>><?php echo $row_lsp['Ten_vn']?></option>
            <?php }?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Thứ tự</td>
        <td colspan="3"><input type="text" class="txt" name="thutu" value="<?php echo $row_nsp['ThuTu']?>"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn blue" /></td>
      </tr>
    </table>
</form>