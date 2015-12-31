<?php
	if(isset($_GET['idTin']))
		$idTin=$_GET['idTin'];
	$tin=$i->ChiTietTin($idTin);
	$row_tin=mysql_fetch_assoc($tin);
	$tinlq=$i->TinLienQuan($idTin);
	$i->SoLanXem($idTin);
	
?>
<div id="detail_news">
    <div class="page_content">
    	<h3 class="tieude"><?php echo $row_tin['TieuDe']?></h3>
        <p class="linhtinh"><span class="calender"><?php echo date("d/m/Y h:i:s",strtotime($row_tin['NgayCapNhat']))?></span> | <span class="hitpoint"><?php echo $row_tin['SoLanXem']?> {View}</span></p>
        <p class="tomtat"><?php echo $row_tin['TomTat']?></p>
        <!--<img src="<?php echo $row_tin['Hinh']?>" alt="<?php echo $row_tin['TieuDe']?>" title="<?php echo $row_tin['TieuDe']?>"  />-->
        <p><?php echo $row_tin['NoiDung']?></p>
    </div>
    <!--
    <div id="tinlienquan" class="page_content">
    	<h1 class="title page_title">{Another_acticle}</h1>
        <ul>
        <?php while($row_tinlq=mysql_fetch_assoc($tinlq)){?>
        	<li><a href="news/detail/<?php echo $row_tinlq['idTin']?>/"><?php echo $row_tinlq['TieuDe']?></a> <span>(<?php echo date("d/m/Y",strtotime($row_tinlq['NgayCapNhat']))?>)</span></li>
        <?php }?>
        </ul>
    </div>
    -->
</div>