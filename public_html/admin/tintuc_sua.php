<?php require_once "checklogin.php";
	
	if(isset($_GET['idtin']))
		$idTin=$_GET['idtin'];
	$tin=$i->ChiTietTin($idTin);
	$row_tin=mysql_fetch_assoc($tin);
	
	$lt=$i->ListLoaiTin();
	if(isset($_POST['submit']))
	{
		$i->SuaTinTuc($idTin);
		header("location:index.php?p=tintuc_list");
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
<form action="" method="post">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Tiêu đề</td>
        <td colspan="3"><input type="text" name="tieude" class="txt" value="<?php echo $row_tin['TieuDe']?>" /></td>
      </tr>
       <tr>
        <td>OG Title</td>
        <td colspan="3"><input type="text" name="ogtitle" class="txt validate[required]" value="<?php echo $row_tin['ogTitle']?>" /></td>
      </tr>
      <tr>
        <td>OG Description</td>
        <td colspan="3"><textarea rows="5" cols="50" name="ogdesc" class="validate[required]" /><?php echo $row_tin['ogDesc']?></textarea></td>
      </tr>
      <tr>
        <td>OG Image</td>
        <td colspan="3">
        	<input type="text" name="ogimg" id="ogimg" class="txt validate[required]" value="<?php echo $row_tin['ogImg']?>" />
        	<label>
            <input onclick="BrowseServer('Images:/','ogimg')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn" />
            </label>
        </td>
      </tr>
      <tr>
        <td>Tóm tắt</td>
        <td align="left" colspan="3">
        	<textarea name="tomtat" style="width:300px; height:120px"><?php echo $row_tin['TomTat']?></textarea>
        </td>
      </tr>
      <tr>
        <td>Nội dung</td>
        <td align="left" colspan="3">
        	<textarea name="noidung" id="noidung"><?php echo $row_tin['NoiDung']?></textarea>
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
            <input type="text" name="hinh" class="txt" id="hinh" value="<?php echo $row_tin['Hinh']?>" />
             <label>
            <input onclick="BrowseServer('Images:/','hinh')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn" />
            </label>
            <div id="preview">
               <div id="thumbnails"></div>
            </div>   
        </td>
      </tr>
      <tr>
        <td>Loại tin</td>
        <td colspan="3">
            <select name="loaitin">
            <option value="0">Chọn loại tin</option>
            <?php while($row_lt=mysql_fetch_assoc($lt)) {
				$s="";
				if($row_lt['idLT']==$row_tin['idLT'])
					$s="selected=selected";	
			?>
            <option value="<?php echo $row_lt['idLT']?>" <?php echo $s?>><?php echo $row_lt['Ten']?></option>
            <?php }?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Thứ tự</td>
        <td colspan="3"><input type="text" class="txt" name="thutu" value="<?php echo $row_tin['ThuTu']?>"/></td>
      </tr>
      <tr>
      	<td>Ẩn hiện</td>
        <td colspan="3"><input type="checkbox" name="anhien" <?php echo ($row_tin['AnHien']==1)?"checked='checked'":""; ?>/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn" /></td>
      </tr>
    </table>
</form>