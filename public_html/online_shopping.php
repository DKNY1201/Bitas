<?php
	$lspgt=$i->ListLoaiSPGT();
?>
<div id="online_shopping">
    <div id="left" class="box_size">
      <div id="left_nav">
      <?php while($row_lspgt=mysql_fetch_assoc($lspgt)){
		 $idlspgt=$row_lspgt['idlspgt'];
		 $lspdsg=$i->ListLoaiSPDSG($idlspgt);
	  ?>
       	<h1><a href="products/cats/<?php echo $idlspgt?>/"><?php echo $row_lspgt['Ten_'.$lang]?></a></h1>
        <ul>
        <?php while($row_lspdsg=mysql_fetch_assoc($lspdsg)){?>
          <li><a href="products/cat/<?php echo $row_lspdsg['idlspdsg']?>/"><?php echo $row_lspdsg['Ten_'.$lang]?></a></li>
		<?php }?>
        </ul>
      <?php }?>
      </div>
      <!--end_left_nav--> 
    </div>
    <!--end_left-->
    <div id="center">
      <?php require_once "slider_product.php"?>
    </div>
    
    <div id="right" class="box_size"> <a href="catalogues/index.php" target="_blank"><img src="img/catalogues/intro.jpg" alt="Catalogue sản phẩm Bita's, Catalogues Product of Bita's" title="Catalogue sản phẩm"  /></a> <a href="#"><img src="img/black-white.jpg" alt="Sản phẩm black white" title="Sản phẩm black white"  /></a> </div>
    <div class="clear"></div>
    <div id="ads_center"> <a href="home.bitas/products/cats/3/"><img src="img/ads_1.jpg" alt="Dep Sandal Giay nu" /></a> <a href="home.bitas/products/cats/1/"><img src="img/ads_2.jpg" alt="Dep Sandal Giay tre em" /></a> <a href="home.bitas/products/cats/4/"><img src="img/ads_3.jpg" alt="Dep Sandal Giay nam" /></a> </div>
  <!--end_ads_center-->
  
  <div class="clear"></div>
  <div id="hot_product">
    <?php require_once "hot_product.php"?>
  </div>
  <!--end_hot_product-->
  
  <div class="clear"></div>

  </div>
  <!--end_online_shopping-->