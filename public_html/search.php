<?php
	require_once "db/db.php";
	$tukhoa=$_GET['tukhoa'];
	
	$pageSize=16;
	$pageNum=1;
	if(isset($_GET['pageNum'])) $pageNum=$_GET['pageNum'];
	if($pageNum<=0) $pageNum=1;
	$totalRows=0;
	$s=$i->TimKiem($tukhoa,$pageNum,$pageSize,$totalRows,$lang);
?>
<div id="search">
    <h1 class="title page_title">{Search_Result}</h1>
    <?php if($totalRows<=0){?>
    <p class="found_s">{Cannot_Find} <strong><?php echo $tukhoa?></strong></p>
    <?php }else{?>
    <p class="found_s">{Found} <strong><?php echo $totalRows?></strong> {Product_With_Keyword} <strong><?php echo $tukhoa?></strong></p>
    <?php }?>
    <div class="clear"></div>
    
    
    <ul class="list">
		<?php
            $count=0; 
            while($row_sp=mysql_fetch_assoc($sp)){
                $giachuagiam1_vn=$row_sp['GiaChuaGiam1_vn'];
                $gia1_vn=$row_sp['Gia1_vn'];
        ?>
        <li class="list_li box_size <?php if($count%4==0) echo 'first';?>">
            <div class="img_cover box_size"><img width="240px" height="190px" src="<?php echo $row_sp['Hinh']?>" alt="<?php echo $row_sp['Ten']?>" /></div>	
            <?php if($row_sp['New']==1){?>
                <div class="ribbon title">{New}</div>
            <?php }?>
            <?php if($row_sp['Discount']!='0'){?>
                <div class="discount title">
                    <?php
                        echo ((1-round($gia1_vn/$giachuagiam1_vn,2))*100)."%"."<br />"."OFF";
                    ?>
                </div>
            <?php }?>
            <a href="<?php echo $i->changeTitle($row_sp['Ten']) . '-' . $row_sp['idNSP']?>/"><div class="li_hover"></div></a>
            <div class="info box_size">
                <h1><?php echo $row_sp['Ten']?></h1>
                <div class="size">
                    <span>{Size}: <?php echo $row_sp['Size1']?></span>
                </div>
                <div class="size">
                <?php if($row_sp['GiaChuaGiam1_vn']!="") {?>
                    <span><em style="text-decoration:line-through; color:#333; display:block;"><?php echo number_format($row_sp['GiaChuaGiam1_vn'],0,'.',',')?> VND</em></span>
                <?php }?>
                    <span><em><?php if(isset($row_sp['Gia2_vn'])&&$row_sp['Gia2_vn']!=''){?>{From}<?php }?> <?php echo number_format($row_sp['Gia1_vn'],0,'.',',')?> VND</em></span>
                </div>
             </div>
        </li>
        <?php $count++; }?>
    </ul>
    
    
    <ul class="list" id="new_pro_li">
    <?php
		$count=0; 
		while($row_nsp_s=mysql_fetch_assoc($s)){
		$giachuagiam1_vn=$row_nsp_s['GiaChuaGiam1_vn'];
		$gia1_vn=$row_nsp_s['Gia1_vn'];
    ?>
     <li class="list_li box_size <?php if($count%4==0) echo 'first';?>">
            <div class="img_cover box_size"><img width="240px" height="190px" src="<?php echo $row_nsp_s['Hinh']?>" alt="<?php echo $row_nsp_s['Ten']?>" /></div>	
            <?php if($row_nsp_s['New']==1){?>
                <div class="ribbon title">{New}</div>
            <?php }?>
            <?php if($row_nsp_s['Discount']!='0'){?>
                <div class="discount title">
                    <?php
                        echo ((1-round($gia1_vn/$giachuagiam1_vn,2))*100)."%"."<br />"."OFF";
                    ?>
                </div>
            <?php }?>
            <a href="<?php echo $i->changeTitle($row_nsp_s['Ten']) . '-' . $row_nsp_s['idNSP']?>/"><div class="li_hover"></div></a>
            <div class="info box_size">
                <h1><?php echo $row_nsp_s['Ten']?></h1>
                <div class="size">
                    <span>{Size}: <?php echo $row_nsp_s['Size1']?></span>
                </div>
                <div class="size">
                <?php if($row_nsp_s['GiaChuaGiam1_vn']!="") {?>
                    <span><em style="text-decoration:line-through; color:#333; display:block;"><?php echo number_format($row_nsp_s['GiaChuaGiam1_vn'],0,'.',',')?> VND</em></span>
                <?php }?>
                    <span><em><?php if(isset($row_nsp_s['Gia2_vn'])&&$row_sp['Gia2_vn']!=''){?>{From}<?php }?> <?php echo number_format($row_nsp_s['Gia1_vn'],0,'.',',')?> VND</em></span>
                </div>
             </div>
        </li>
    <?php $count++; }?>
    </ul>
    <div class="clear"></div>
    <div class="paging" align="right"> 
    	<ul>
		<?php echo $i->pagesList($totalRows,$pageNum,$pageSize,2); ?>
        </ul>
	</div>
</div>