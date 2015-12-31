<?php require_once "checklogin.php";
	$info=$i->detailInfo();
	$row_info=mysql_fetch_assoc($info);
	$error=array();
	if(isset($_POST['submit']))
	{
		$success=$i->updateInfo($error);
		if($success==true)
			header("location:index.php?p=info");
	}
?>
<script>
	$(document).ready(function(e) {
    	//$("#updateInfo").validationEngine();
    });
</script>
<form id="updateInfo" name="updateInfo" action="" method="POST">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Tên công ty</td>
        <td colspan="3">
        	<input type="text" name="companyName" class="txt validate[required] text-input" value="<?php if(isset($_POST['companyName'])) echo $_POST['companyName']; else echo $row_info['companyName'];?>"/>
        	<?php if(isset($error['companyName'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['companyName']?></p>
			<?php }?>    
        </td>
      </tr>
      <tr>
        <td>Địa chỉ</td>
       	<td colspan="3">
        	<input type="text" name="address" class="txt validate[required]" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']; else echo $row_info['address'];?>"/>
            <?php if(isset($error['address'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['address']?></p>
			<?php }?>
        </td>
      </tr>
      <tr>
        <td>Hotline</td>
       	<td colspan="3">
        	<input type="text" name="hotline" class="txt validate[required]" value="<?php if(isset($_POST['hotline'])) echo $_POST['hotline']; else echo $row_info['hotline'];?>"/>
            <?php if(isset($error['hotline'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['hotline']?></p>
			<?php }?>
        </td>
      </tr>
      <tr>
        <td>Điện thoại</td>
        <td colspan="3">
        	<input type="text" name="phone" class="txt validate[required]" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; else echo $row_info['phone'];?>"/>
        	<?php if(isset($error['phone'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['phone']?></p>
			<?php }?>    
        </td>
      </tr>
      <tr>
        <td>Fax</td>
        <td colspan="3">
        	<input type="text" name="fax" class="txt validate[required]" value="<?php if(isset($_POST['fax'])) echo $_POST['fax']; else echo $row_info['fax'];?>"/>
        	<?php if(isset($error['fax'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['fax']?></p>
			<?php }?>    
        </td>
      </tr>
	  <tr>
        <td>Email</td>
        <td colspan="3">
        	<input type="text" name="email" class="txt validate[required,custom[email]]" value="<?php if(isset($_POST['email'])) echo $_POST['email']; else echo $row_info['email'];?>"/>
            <?php if(isset($error['email'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['email']?></p>
			<?php }?>
        </td>
      </tr>
      <tr>
      <tr>
        <td>Facebook</td>
        <td colspan="3">
        	<input type="text" name="fb" class="txt validate[required]" value="<?php if(isset($_POST['fb'])) echo $_POST['fb']; else echo $row_info['fb'];?>"/>
            <?php if(isset($error['fb'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['fb']?></p>
			<?php }?>
        </td>
      </tr>
      <tr>
        <td>Youtube</td>
        <td colspan="3">
        	<input type="text" name="youtube" class="txt validate[required]" value="<?php if(isset($_POST['youtube'])) echo $_POST['youtube']; else echo $row_info['youtube'];?>"/>
            <?php if(isset($error['youtube'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['youtube']?></p>
			<?php }?>
        </td>
      </tr>
      <tr>
        <td>Google Plus</td>
        <td colspan="3">
        	<input type="text" name="gg" class="txt validate[required]" value="<?php if(isset($_POST['gg'])) echo $_POST['gg']; else echo $row_info['gg'];?>"/>
            <?php if(isset($error['gg'])==true) {?> 
				<p style="display:block" class="warning_email box_size"><?php echo $error['gg']?></p>
			<?php }?>
        </td>
      </tr>
      <?php if($_SESSION['group']==1) { ?>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Sửa" class="btn" /></td>
      </tr>
      <?php } ?>
    </table>
</form>