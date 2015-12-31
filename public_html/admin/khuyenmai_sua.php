<?php require_once "checklogin.php";
	if(isset($_GET['idkm']))
		$idkm=$_GET['idkm'];
	
	$km=$i->ChiTietKM($idkm);
	$row_km=mysql_fetch_assoc($km);
	if(isset($_POST['submit']))
	{
		$i->SuaKhuyenMai($idkm);
		header("location:index.php?p=khuyenmai_list");
	}
?>
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
<script>
	$(document).ready(function(e) {
         $("#ngaybatdau").datepicker({dateFormat: 'dd/mm/yy'});
		 $("#ngayketthuc").datepicker({dateFormat: 'dd/mm/yy'}); 
    });
</script>
<form action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Tên</td>
        <td colspan="3"><input type="text" name="ten" class="txt" value="<?php echo $row_km['Ten']?>" /></td>
      </tr>
      <tr>
        <td>Tóm tắt</td>
        <td align="left" colspan="3">
        	<textarea name="tomtat" style="width:300px; height:120px"><?php echo $row_km['TomTat']?></textarea>
        </td>
      </tr>
      <tr>
        <td>Ngày bắt đầu</td>
        <td colspan="3"><input type="text" name="ngaybatdau" id="ngaybatdau" class="txt" value="<?php echo date("d/m/Y",strtotime($row_km['NgayBatDau']))?>" /></td>
      </tr>
      <tr>
        <td>Ngày kết thúc</td>
        <td colspan="3"><input type="text" name="ngayketthuc" id="ngayketthuc" class="txt" value="<?php echo date("d/m/Y",strtotime($row_km['NgayKetThuc']))?>" /></td>
      </tr>
      <tr>
        <td>Nội dung</td>
        <td align="left" colspan="3">
        	<textarea name="noidung" id="noidung"><?php echo $row_km['NoiDung']?></textarea>
            <script type="text/javascript">
				var editor = CKEDITOR.replace( 'noidung',{
					filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
					filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
					filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
					filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
				});		
				</script>
        </td>
      </tr>
      <tr>
        <td>Hình</td>
        <td colspan="3">
            <input type="text" name="hinh" class="txt" id="hinh" value="<?php echo $row_km['Hinh']?>" />
             <label>
            <input onclick="BrowseServer('Images:/','hinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn" />
            </label>
            <div id="preview">
               <div id="thumbnails"></div>
            </div>   
        </td>
      </tr>
      <tr>
        <td>Thứ tự</td>
        <td colspan="3"><input type="text" class="txt" name="thutu" value="<?php echo $row_km['ThuTu']?>"/></td>
      </tr>
      <tr>
      	<td>Ẩn hiện</td>
        <td colspan="3"><input type="checkbox" name="anhien" <?php echo ($row_km['AnHien']==1)?"checked=checked":"";?> /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn" /></td>
      </tr>
    </table>
</form>