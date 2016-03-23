<?php
	require_once "checklogin.php";
	if(isset($_GET['idyk'])){
		$idyk = $_GET['idyk'];
		$yk = $i -> ChiTietYKien($idyk);
		$row_yk = mysql_fetch_assoc($yk);
	}
	if(isset($_POST['submit'])){
		$i -> TraLoiYKien($idyk);
	}
?>

<script type="text/javascript" src="../js/jquery.validationEngine-vi.js"></script>
<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>
<script>
$(document).ready(function(e) {
	$('#formthemykien').validationEngine();
});
</script>

<link rel="stylesheet" type="text/css" href="../css/validationEngine.jquery.css"/>

<form id="formthemykien" name="formthemykien" action="" method="post" class="input-text">
    <table class="them" width="800px" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td>Nội dung trả lời</td>
        <td colspan="3">
        	<textarea name="traloi" class="txt validate[required]" /><?php if(isset($_POST['traloi'])) echo $_POST['traloi']; else echo $row_yk['TraLoi'];?></textarea>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><input type="submit" name="submit" value="Trả lời" class="btn blue" /></td>
      </tr>
    </table>
</form>