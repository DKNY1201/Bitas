<?php
  require_once "checklogin.php";
  $error=array();
  if(isset($_POST['submit']))
  {
    $success=$i->ThemSlider($error);
    if($success==true)
      header("location:index.php?p=slider_list");
  }
?>
<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
<script>
$(document).ready(function(e) {
  //VALIDATE
  $('#sliderform').validationEngine();
  $(".date").datepicker({
    dateFormat: 'dd/mm/yy'
  });
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
<form action="" method="post" id="sliderform">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Hình ảnh</td>
        <td colspan="3">
          <input type="text" name="imgSrc" id="imgSrc" class="txt validate[required]" value="<?php echo $_POST['imgSrc'] ? $_POST['imgSrc'] : ''?>" />
          <label>
            <input onclick="BrowseServer('Images:/','imgSrc')" type="button" name="btnChonFile" id="btnChonFile" value="Chọn file" class="btn green" />
          </label>
          <?php if(isset($error['imgSrc'])==true) {?> 
            <p style="display:block" class="input-error"><?php echo $error['imgSrc']?></p>
          <?php }?>
        </td>
      </tr>
      <tr>
        <td>Url của hình ảnh</td>
        <td colspan="3">
          <input type="text" name="url" class="txt validate[required]" value="<?php echo $_POST['url'] ? $_POST['url'] : ''?>" />
          <?php if(isset($error['url'])==true) {?> 
            <p style="display:block" class="input-error"><?php echo $error['url']?></p>
          <?php }?>
        </td>
      </tr>
      <tr>
        <td>Mô tả</td>
        <td colspan="3"><input type="text" name="altText" class="txt validate[required]" value="<?php echo $_POST['altText'] ? $_POST['altText'] : ''?>" /></td>
      </tr>
      <tr>
        <td>Ngày bắt đầu hiển thị</td>
        <td colspan="3">
          <input type="text" name="beginDate" class="txt validate[required] date" value="<?php echo $_POST['beginDate'] ? $_POST['beginDate'] : ''?>" />
          <?php if(isset($error['beginDate'])==true) {?> 
            <p style="display:block" class="input-error"><?php echo $error['beginDate']?></p>
          <?php }?>
        </td>
      </tr>
      <tr>
        <td>Ngày kết thúc hiển thị</td>
        <td colspan="3">
          <input type="text" name="endDate" class="txt validate[required] date" value="<?php echo $_POST['endDate'] ? $_POST['endDate'] : ''?>" />
          <?php if(isset($error['endDate'])==true) {?> 
            <p style="display:block" class="input-error"><?php echo $error['endDate']?></p>
          <?php }?>
        </td>
      </tr>
      <tr>
        <td>Thứ tự hiển thị</td>
        <td colspan="3"><input type="text" name="thutu" class="txt validate[required]" value="<?php echo $_POST['thutu'] ? $_POST['thutu'] : ''?>" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Thêm" class="btn blue" /></td>
      </tr>
    </table>
</form>