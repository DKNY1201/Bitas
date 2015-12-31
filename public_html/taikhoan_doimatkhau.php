<?php if(isset($_POST['sub'])){
		$error=array();
		$success=$i->change_pass($error);
		if($success==true)
			header("location:http://bitas.com.vn/user/tai-khoan/");
	}
?>

<h1 class="title page_title">{Change_Pass}</h1>
<form method="post" action="" id="f_changepass">
	<h3>{Info_Change}</h3>
    <table border="0" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td>{Old_Pass}</td>
            <td class="left"><input type="password" name="old_pass" class="validate[required,minSize[6]] text-input" /></td>
        </tr>
        <tr>
        	<td></td>
            <td class="left">
            <?php if(isset($error['oldpass'])) {?>
            	<p style="display:block; margin:0 0 0 10px; color:#900; font-weight:bold"><?php echo $error['oldpass'];?></p>
            <?php }?>
            </td>
        </tr>
        <tr>
        	<td>{New_Pass}</td>
            <td class="left">
            	<input type="password" name="new_pass" id="newpass" class="validate[required,minSize[6]] text-input" />
            	<?php if(isset($error['new-password'])) {?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"><?php echo $error['new-password'];?></p>
                <?php }?>    
            </td>
        </tr>
        <tr>
        	<td>{Renew_Pass}</td>
            <td class="left">
            	<input type="password" name="renew_pass" class="validate[required,minSize[6],equals[newpass]] text-input" />
            	<?php if(isset($error['re-new-password'])) {?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"><?php echo $error['re-new-password'];?></p>
                <?php }?>       
            </td>
        </tr>
        <tr>
        	<td></td>
            <td class="left"><input type="submit" name="sub" value="{Change_Pass}" /></td>
        </tr>
    </table>
</form>