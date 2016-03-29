<?php if(isset($_POST['sub'])){
		$success=$i->doidiachi($error);
		if($success==true)
			header("location:http://bitas.com.vn/user/tai-khoan/");
	}
	$tt_my=$i->LayQuanHuyenTinhThanhTheoEmail($_SESSION['email']);
	$row_tt_my=mysql_fetch_assoc($tt_my);
	$idTinh=$row_tt_my['idTinh'];
	$tt=$i->ListTinhThanh();
	$idQH=$row_tt_my['idQH'];
	$qh=$i->ListQuanHuyenByTinhThanh($idTinh);
	$idPX=$row_tt_my['idPhuong'];
	$px=$i->ListPhuongByQH($idQH);
?>
<script>
	$(document).ready(function(e) {
        //Load Quan Huyen
		$("#tt").change(function(e) {
			var idTT=$(this).val();
			$("#qh").load("ajax_load_quanhuyen.php?idTT="+idTT);
		});
		$("#qh").change(function(e) {
			var idQH=$(this).val();
			$("#px").load("ajax_load_phuongxa.php?idQH="+idQH);
		});
    });
</script>
<form id="f_changepass" action="" method="post">
	<h1 class="title page_title">{Address}</h1>
	<table border="0" cellpadding="4px" cellspacing="0">
    	<tr>
        	<td>{Address}*</td>
            <td class="left">
            	<input type="text" class="validate[required] text-input" name="diachi" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']; else echo $_SESSION['diachi'];?>">
                <?php if(isset($error['diachi'])){?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['diachi'];?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td>{Province}*</td>
            <td class="left">
            	<select name="tinhthanh" id="tt" class="select_tt validate[required]" style="margin-left:10px;">
                <?php while($row_tt=mysql_fetch_assoc($tt)) {
				$s="";
				if($idTinh==$row_tt['idTinh'])
					$s="selected=selected";
				?>
                	<option value="<?php echo $row_tt['idTinh']?>" <?php echo $s?>><?php echo $row_tt['Ten']?></option>
                <?php }?>
                </select>
                <?php if(isset($error['tinhthanh'])){?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['tinhthanh'];?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td>{District}*</td>
            <td class="left">
            	<select name="quanhuyen" id="qh" class="select_tt validate[required]" style="margin-left:10px;">
                	<option value="">{Choose_District}</option>
                    <?php while($row_qh=mysql_fetch_assoc($qh)) {
						$s="";
						if($idQH==$row_qh['idQuanHuyen'])
							$s="selected=selected";
						?>
							<option value="<?php echo $row_qh['idQuanHuyen']?>" <?php echo $s?>><?php echo $row_qh['type']." ".$row_qh['Ten']?></option>
               		 <?php }?>
                </select>
                <?php if(isset($error['quanhuyen'])){?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['quanhuyen'];?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td>{Ward}*</td>
            <td class="left">
            	<select name="phuong" id="px" class="select_tt validate[required]" style="margin-left:10px;">
                	<option value="">{Choose_Ward}</option>
                    <?php while($row_px=mysql_fetch_assoc($px)) {
						$s="";
						if($idPX==$row_px['idPhuong'])
							$s="selected=selected";
						?>
							<option value="<?php echo $row_px['idPhuong']?>" <?php echo $s?>><?php echo $row_px['type']." ".$row_px['Ten']?></option>
               		 <?php }?>
                </select>
                <?php if(isset($error['phuong'])){?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['phuong'];?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td>{Tel}*</td>
            <td class="left">
            	<input type="text" class="validate[required,minSize[10],maxSize[11],custom[phone]] text-input" name="dienthoai" value="<?php if(isset($_POST['dienthoai'])) echo $_POST['dienthoai']; else echo $_SESSION['dienthoai'];?>">
                <?php if(isset($error['dienthoai'])){?>
                    <p style="display:block; margin:5px 0 0 10px; color:#900; font-weight:bold"> <?php echo $error['dienthoai'];?></p>
                <?php }?>
            </td>
        </tr>
        <tr>
        	<td></td>
            <td class="left"><p style="margin:0 0 0 10px">* {Required_Field}</p></td>
        </tr>
        <tr>
        	<td></td>
            <td class="left"><input type="submit" value="{Change}" name="sub"></td>
        </tr>
    </table>
</form>