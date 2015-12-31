<?php
	if(isset($_SESSION['id']))
		header("location:http://bitas.com.vn/");
?>
<script>

$(document).ready(function(e) {

	$("#ngaysinh").datepicker({

		dateFormat: 'dd/mm/yy',

		maxDate: '-10Y',

	});

			 

	//VALIDATE

	$('#formdangki').validationEngine();

});

</script>

<form id="formdangki" method="post" action="" class="box_size">

        <h1>{Login}</h1>

<table border="0" cellpadding="0" cellspacing="0">

    	<tr>

        	<td class="td_title"><label for="email">{Email}</label> *</td>

            <td><input type="text" name="email" id="email" placeholder="Email" class="validate[required,custom[email]]" /><br />

            </td>

        </tr>

        <tr>

        	<td class="td_title"><label for"email">{Password}:</label> *</td>

            <td><input type="password" name="password" placeholder="{Password}" />

            </td>

        </tr>

        <tr>

        	<td class="td_title"></td>

            <td><input type="checkbox" name="keep-logged" id="keep-logged-page" checked="checked" /> <label for="keep-logged-page">{Keep_Login}</label>

            </td>

        </tr>

        <tr>

        	<td class="td_title"></td>

            <td><input type="submit" name="btndn" id="btndn" value="{Login}">

        	<span class="forget-pass">[<a href="user/quen-mat-khau/" class="forget-pass">{Forget_Pass}?</a>]</span>

            <input type="hidden" value="1" name="wishlist" />

            </td>

        </tr>

</table>

</form>

<div class="new-customer box_size">

	<div class="new-customer-inside">

		<h1>{New_Customer}</h1>

    	<a href="user/dang-ki/">{Register}</a>

    </div>

</div>