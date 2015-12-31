<h1 class="title page_title">{My_Wishlist} (<?php echo $wl_num?>)</h1>
<?php if($wl_num==0)
		echo '<p style="margin-top:10px">{No_Product_Wishlist}</p>';
	else{
	mysql_data_seek($wl,0);
?>
<?php while($row_wl=mysql_fetch_assoc($wl)){
		$wl_idNSP=$row_wl['idNSP'];
		$wl_nsp=$i->LayChiTietNhomSPVaMau($wl_idNSP);
		$row_wl_nsp=mysql_fetch_assoc($wl_nsp);
?>
	<div class="wishlish-list box_shadow box_size">
        <a href="products/detail/<?php echo $wl_idNSP?>/"><img width="160px" src="<?php echo $row_wl_nsp['Hinh']?>" alt="<?php echo $row_wl_nsp['Ten']?>" /></a>
        <div id="wishlist-table-info">
            <h3><a href="products/detail/<?php echo $wl_idNSP?>/"><?php echo $row_wl_nsp['Ten']?></a></h3>
            <p><span>{Color}:</span> <?php echo $row_wl_nsp['Mau_'.$lang]?></p>
            <p><a href="wishlist.php?act=del&idNSP=<?php echo $wl_idNSP?>">{Del_Pro}</a></p>
        </div><!-- end wishlist-table-info -->
    </div><!-- end wishlish-list -->
<?php }}?>