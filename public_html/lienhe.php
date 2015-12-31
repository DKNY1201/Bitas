<script type="text/javascript" src="js/jquery.validationEngine-vi.js"></script>

<script type="text/javascript" src="js/jquery.validationEngine.js"></script>



<script>

$(document).ready(function(e) {

	$('#formlienhe').validationEngine();

});



</script>

<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css"/>



<h1 class="title page_title">{Contact}</h1>

<div id="lienhe_left" class="box_size">

	<div id="thanks_lh">

        <p>{Contact_Text_1}<p><br />

        <p>{Contact_Text_2}</p><br />

        <p>{Contact_Text_3}</p><br />

        <p>{Contact_Text_4}</p>

    </div>

    <form id="formlienhe" action="" method="post">

                    <div id="name_com" class="box_size">

                        <p>{Name}:<span>*</span></p>

                        <input type="text" name="name" class="name box_size validate[required] text-input" tabindex="1" /><br /><br />

                        <p>{Company}:</p>

                        <input type="text" name="com" class="com box_size" tabindex="3"/>

                    </div>

                    

                    <div id="email_add" class="box_size">

                        <p>Email:<span>*</span></p>

                        <input type="text" name="email" class="email box_size validate[required,custom[email]] text-input" tabindex="2"/><br /><br />

                        <p>{Address}:</p>

                        <input type="text" name="add" class="add box_size" tabindex="4" />

                    </div>

                  	

                    <div class="clear"></div>

                    <p>{Content}:<span>*</span></p>

                    <textarea class="box_size validate[required] text-input" tabindex="5"></textarea>

                    <div id="but">

                        <input type="submit" name="submit" class="submit" value="{Send}" />

                    </div>

    </form>
</div>
<div id="lienhe_right" class="box_size">
	<div class="thongtin">
        <p><strong>Hotline: </strong><?php echo $row_info['hotline']?></p>
        <p><strong>Email: </strong><?php echo $row_info['email']?></p>
        <p><strong>Số điện thoại: </strong><?php echo $row_info['phone']?></p>
    </div>
</div>