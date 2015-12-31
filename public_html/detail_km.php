<?php
	$idKM=$_GET['idKM'];
	$km=$i->ChiTietKM($idKM);
	$row_km=mysql_fetch_assoc($km);
?>
<div id="detail_km">
	<div class="page_content">
    	<h3 class="tieude"><?php echo $row_km['Ten']?></h3>
        <p class="ngay"><span class="calender">{Start_date}: </span> <span class="ngay_sp"><?php echo date("d/m/Y",strtotime($row_km['NgayBatDau']))?></span></p>
        <p class="ngay"><span class="calender">{End_date}: </span> <span class="ngay_sp"><?php echo date("d/m/Y",strtotime($row_km['NgayKetThuc']))?></span></p>
        <p class="tomtat"><?php echo $row_km['TomTat']?></p>
        <p><?php echo $row_km['NoiDung']?></p>
    </div>
</div>