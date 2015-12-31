<?php
	$khuyenmai=$i->KhuyenMai();
	$nsp_km=$i->LaySPKhuyenMai($lang);
?>
<div id="khuyenmai">
	<h1 class="title page_title">{Promotion}</h1>
    <div class="page_content">
    <h2 class="name_km">{Promotion_program}</h2>
    <?php while($row_khuyenmai=mysql_fetch_assoc($khuyenmai)) {?>
    	<div class="tin_ele">
        	<a href="home.bitas?p=detail_km&idKM=<?php echo $row_khuyenmai['idKM']?>"><img class="box_shadow" src="<?php echo $row_khuyenmai['Hinh']?>" alt="<?php echo $row_khuyenmai['Ten']?>" title="<?php echo $row_khuyenmai['Ten']?>" ></a>
        <h3><a href="home.bitas?p=detail_km&idKM=<?php echo $row_khuyenmai['idKM']?>"><?php echo $row_khuyenmai['Ten']?></a></h3>
        <p class="ngay"><span class="calender">{Start_date}:</span> <span class="ngay_sp"><?php echo date("d/m/Y",strtotime($row_khuyenmai['NgayBatDau']))?></span></p>
        <p class="ngay"><span class="calender">{End_date}:</span> <span class="ngay_sp"><?php echo date("d/m/Y",strtotime($row_khuyenmai['NgayKetThuc']))?></span></p>
        <p><?php echo $row_khuyenmai['TomTat']?></p>
        </div>
    <?php }?>
    </div>
    <h2 class="name_km" style="padding:0 0 0 10px">{Promotion_product}</h2>
    <ul class="list">
                <?php while($row_nsp_km=mysql_fetch_assoc($nsp_km)) {
					$gia1=intval($row_nsp_km['Gia1']);
					$giagiam1=intval($row_nsp_km['GiaGiam1']);
				?>
                	
                    <li class="list_li box_size">
                        <div class="img_cover box_size">
                            <img src="<?php echo $row_nsp_km['Hinh']?>"  alt="Bitas, Dép, Sandal, Giày"  />
                        </div>
                        <div class="discount title">-<?php echo (1-round($giagiam1/$gia1,2))*100?>%</div>
                        <a href="products/detail/<?php echo $row_nsp_km['idNSP']?>/"><div class="li_hover"></div></a>
                        
                        <div class="info">
                            <h1><?php echo $row_nsp_km['Ten']?></h1>
                            <div class="sort_des"><?php echo $i->rutgonchuoi($row_nsp_km['MoTa'],10)?></div>
                            <p class="price">{Size}: <span style="color:#f06f00"><?php echo $row_nsp_km['Size1']?></span> - {Price}: <span class="old_price"><?php echo number_format($row_nsp_km['Gia1'],0,",",".")?> {Rate}</span> <span style="color:#f06f00"><?php echo number_format($row_nsp_km['GiaGiam1'],0,",",".")?> {Rate}</span></p>
                        <?php if($row_nsp_km['Size2']!=''){?>
                        <p class="price">{Size}: <span style="color:#f06f00"><?php echo $row_nsp_km['Size2']?></span> - {Price}:  <span class="old_price"><?php echo number_format($row_nsp_km['Gia2'],0,",",".")?> {Rate}</span> <span style="color:#f06f00"><?php echo number_format($row_nsp_km['GiaGiam2'],0,",",".")?> {Rate}</span></p>
                        <?php }?>
                        
                         <?php if($row_nsp_km['Size3']!=''){?>
                        <p class="price">{Size}: <span style="color:#f06f00"><?php echo $row_nsp_km['Size3']?></span> - {Price}:  <span class="old_price"><?php echo number_format($row_nsp_km['Gia3'],0,",",".")?> {Rate}</span> <span style="color:#f06f00"><?php echo number_format($row_nsp_km['GiaGiam3'],0,",",".")?> {Rate}</span></p>
                        <?php }?>
                        
                         <?php if($row_nsp_km['Size4']!=''){?>
                        <p class="price">{Size}: <span style="color:#f06f00"><?php echo $row_nsp_km['Size4']?></span> - {Price}:  <span class="old_price"><?php echo number_format($row_nsp_km['Gia4'],0,",",".")?> {Rate}</span> <span style="color:#f06f00"><?php echo number_format($row_nsp_km['GiaGiam4'],0,",",".")?> {Rate}</span></p>
                        <?php }?>
                            <div class="size">
                                <ul>
                                    <li style="color:#000">{Color}: </li>
                                    <?php //lấy id các nhóm sản phẩm cùng follow với nhóm sản phẩm này và đưa vào mảng $arr_id
                                        $f=$i->LaySPFollow($row_nsp_km['follow']);
                                        $arr_id=array();
                                        $k=0;
                                        while($row_f=mysql_fetch_assoc($f)){
                                            $arr_id[$k]=$row_f['idNSP'];
                                            $k++;
                                        }
                                        for($j=0;$j<count($arr_id);$j++)
                                        {										
                                            $color_f=$i->LayMauNSP($arr_id[$j]);
                                            $row_color_f=mysql_fetch_assoc($color_f);
                                    ?>
                                    <li><?php echo $row_color_f['Mau']?></li>
                                    <?php }//end for?>
                                </ul>
                            </div>
                         </div>
                    </li>
                <?php }?>
    </ul>
</div>