<?php
	$bctt_detail=$i->detailBaoChiTruyenThong();
	$row_bctt_detail=mysql_fetch_assoc($bctt_detail);
	$bctt=$i->listAllBaoChiTruyenThong();
?>
<div id="tintuc">
    <div class="page_content">
    	<div class="tin_xa_hoi" id="new_pro_li">
    	<?php while($row_bctt=mysql_fetch_assoc($bctt)) {?>
            <div class="tin_ele">
                <a href="news/detail/<?php echo $row_bctt['idTin']?>/"><img class="box_shadow" src="<?php echo $row_bctt['Hinh']?>" alt="<?php echo $row_bctt['TieuDe']?>" title="<?php echo $row_bctt['TieuDe']?>" ></a>
                <h3><a href="news/detail/<?php echo $row_bctt['idTin']?>/"><?php echo $row_bctt['TieuDe']?></a></h3>
                <p class="linhtinh"><span class="calender"><?php echo date("d/m/Y h:i:s",strtotime($row_bctt['NgayCapNhat']))?></span></p>
                <p><?php echo $row_bctt['TomTat']?></p>
                
            </div>
            <?php }?>
        </div><!--end_tin_xa_hoi-->
    </div><!--end_page_content-->
</div><!--end_tintuc-->