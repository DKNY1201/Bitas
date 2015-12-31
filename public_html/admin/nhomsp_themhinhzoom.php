<?php require_once "checklogin.php";
	if(isset($_GET['idNSP']))
		$idNSP=$_GET['idNSP'];
	if(isset($_POST['submit']))
	{
		$i->ThemHinhZoom($idNSP);
		header("location:index.php?p=nhomsp_list");
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
    <table class="them" width="900px" border="0" cellspacing="0" cellpadding="4">
      <tr>
      	<th width="33%">Hình lớn</th>
        <th width="33%">Hình nhỏ</th>
        <th width="33%">Hình thumb</th>
      </tr>
      <?php for($j=1;$j<=6;$j++) {?>
      <tr>
        <td>
        <input type="text" name="lg-<?php echo $j?>" id="lg-<?php echo $j?>" class="txt" style="width:175px;" />
            <label>
            <input onclick="BrowseServer('Images:/','lg-<?php echo $j?>')" type="button" name="lg-<?php echo $j?>" id="lg-<?php echo $j?>" value="Chọn file" class="btn" />
            </label>
        </td>
        <td>
        <input type="text" name="sm-<?php echo $j?>" id="sm-<?php echo $j?>" class="txt" style="width:175px;"/>
            <label>
            <input onclick="BrowseServer('Images:/','sm-<?php echo $j?>')" type="button" name="sm-<?php echo $j?>" id="sm-<?php echo $j?>" value="Chọn file" class="btn" />
            </label>
        </td>
        <td>
        <input type="text" name="th-<?php echo $j?>" id="th-<?php echo $j?>" class="txt" style="width:175px;"/>
            <label>
            <input onclick="BrowseServer('Images:/','th-<?php echo $j?>')" type="button" name="th-<?php echo $j?>" id="th-<?php echo $j?>" value="Chọn file" class="btn" />
            </label>
        </td>
      </tr>
      <?php }?>
      <tr>
        <td colspan="4"><input type="submit" name="submit" value="Thêm hình" class="btn" /></td>
      </tr>
    </table>
</form>