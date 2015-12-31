<?php if($lang=='vn')
	{
		$tin=$i->listAllTinXaHoi_VN($lang);
		$tin_nb=$i->listAllTinNoiBo_VN($lang);
	}
	elseif($lang=='en')
	{
		$tin=$i->listAllTinXaHoi_EN($lang);
		$tin_nb=$i->listAllTinNoiBo_EN($lang);
	}
?>
<div id="tintuc">
	<div id="new_pro">
    	<h1 id="spm_li" class="title">{News_social}</h1>
    	<h1 id="spkm_li" class="title">{News_private}</h1>
    </div>
	
    <div class="page_content">
    	<div class="tin_xa_hoi" id="new_pro_li">
    	<?php while($row_tin=mysql_fetch_assoc($tin)) {?>
            <div class="tin_ele">
                <a href="news/detail/<?php echo $row_tin['idTin']?>/"><img class="box_shadow" src="<?php echo $row_tin['Hinh']?>" alt="<?php echo $row_tin['TieuDe']?>" title="<?php echo $row_tin['TieuDe']?>" ></a>
                <h3><a href="news/detail/<?php echo $row_tin['idTin']?>/"><?php echo $row_tin['TieuDe']?></a></h3>
                <p class="linhtinh"><span class="calender"><?php echo date("d/m/Y h:i:s",strtotime($row_tin['NgayCapNhat']))?></span> | <span class="author">Administrator</span></p>
                <p><?php echo $row_tin['TomTat']?></p>
                
            </div>
            <?php }?>
        </div><!--end_tin_xa_hoi-->
        <div class="tin_noi_bo" id="saleoff_pro_li">
    	<?php while($row_tin_nb=mysql_fetch_assoc($tin_nb)) {?>
            <div class="tin_ele">
                <a href="news/detail/<?php echo $row_tin_nb['idTin']?>/"><img class="box_shadow" src="<?php echo $row_tin_nb['Hinh']?>" alt="<?php echo $row_tin_nb['TieuDe']?>" title="<?php echo $row_tin_nb['TieuDe']?>" ></a>
                <h3><a href="news/detail/<?php echo $row_tin_nb['idTin']?>/"><?php echo $row_tin_nb['TieuDe']?></a></h3>
                <p class="linhtinh"><span class="calender"><?php echo date("d/m/Y h:i:s",strtotime($row_tin_nb['NgayCapNhat']))?></span> | <span class="author">Administrator</span></p>
                <p><?php echo $row_tin_nb['TomTat']?></p>
            </div>
            <?php }?>
        </div><!--end_tin_noi_bo-->
    </div><!--end_page_content-->
</div><!--end_tintuc-->