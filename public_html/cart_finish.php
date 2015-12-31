<?php

	require_once "checklogin.php";

	$MaDH=$i->LayDonHangMoiNhatTheoUser($_SESSION['id']);

?>

<div id="cart">

    	<ul id="progressbar">

        	<li class="active ok">

            	1 - {Cart}

            </li>

            <li class="active ok">

            	2 - {Login}/{Register}

            </li>

            <li class="active ok">

            	3 - {Customer_Info}

            </li>

            <li class="active ok">

            	4 - {Finish_Cart}

            </li>

        </ul><!--end_process-->

    

    <div class="clear"></div>

    <section class="cart_detail">

            <div class="cart_title">

                <h1 class="title">{Finish_Cart}</h1>

            </div><!--end_cart_title-->



            <div class="clear"></div>

            <div id="check_again" class="box_size">
				<img class="thankyou-img" src="img/Thank-You.jpg" alt="dat hang thanh cong" title="Đặt hàng thành công" />
                
                <h1 class="title">Chúc mừng bạn đã đặt hàng thành công !</h1>

                <div class="check-again-info">

                    <p>{Your_Order_Code}: <strong class="madh"><?php echo $MaDH?></strong></p>

                    <p>{To_Track_Order_Status} <a class="qldh" href="user/don-hang/">{Order_History}</a></p>

                    <p>{Your_Order_Info_Send_Email} <strong><?php echo $_SESSION['email']?></strong></p>

                </div>

                

                <a href="home.php" class="action-button con_cart" style="margin: 20px auto;">{Continue_Shopping}</a>

            </div>

    </section>

</div>