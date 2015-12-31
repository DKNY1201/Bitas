<?php if(isset($_POST['sub'])){

		$error=array();

		$success=$i->doithongtin($error);

		if($success==true)

			header("location:http://bitas.com.vn/user/tai-khoan/");

	}

?>

<script>

	$(document).ready(function(e) {

		$("#ngaysinh").datepicker({

			dateFormat: 'dd/mm/yy',

			maxDate: '-10Y',

		});   

    });

	

</script>

<form id="f_changepass" action="" method="post">

	<h1 class="title page_title">{Account_Info}</h1>

	<table border="0" cellpadding="4px" cellspacing="0">

    	<tr>

        	<td>{Email}</td>

            <td class="left"><strong style="margin:0 0 0 10px"><?php echo $_SESSION['email']?></strong></td>

        </tr>

        <tr>

        	<td>{Sex}*</td>

            <td class="left">

            	<select name="gioitinh" style="margin:0 0 0 10px !important; padding:5px;">

                	<option value="0" <?php echo ($_SESSION['gioitinh']==0)?"selected=selected":""?>>{Women}</option>

                    <option value="1" <?php echo ($_SESSION['gioitinh']==1)?"selected=selected":""?>>{Men}</option>

                </select>

            </td>

        </tr>

        <tr>

        	<td>{Fullname}*</td>

            <td class="left">

            	<input type="text" class="validate[required] text-input" name="hoten" value="<?php if(isset($_POST['hoten'])) echo $_POST['hoten']; else echo $_SESSION['hoten'];?>">

            	<?php if(isset($error['hoten'])){?>

                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['hoten'];?></p>

                <?php }?>    

            </td>

        </tr>

        <tr>

        	<td>{Birthday}</td>

            <td class="left"><input type="text" class="validate[required] text-input" id="ngaysinh" name="ngaysinh" value="<?php if(isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']; else echo date("d/m/Y",strtotime($_SESSION['ngaysinh']));?>">

            <?php if(isset($error['ngaysinh'])){?>

	            <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['ngaysinh'];?></p>

            <?php }?>

            </td>

        </tr>

        <tr>

        	<td></td>

            <td class="left"><p style="margin:0 0 0 10px">* {Required_Field}</p></td>

        </tr>

        <tr>

        	<td></td>

            <td class="left"><input type="submit" value="{Change_Info}" name="sub"></td>

        </tr>

    </table>

</form>