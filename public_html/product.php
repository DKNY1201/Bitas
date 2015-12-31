<?php
	$pageSize=0;
	$pageNum=1;
	if(isset($pageNum)) $pageNum=$_GET['pageNum'];
	if($pageNum<=0) $pageNum=1;
	$totalRows=0;
	
	//$lspgt=$i->ListLoaiSPGT();
	if(isset($_POST['sub-num']))
	{
		$_SESSION['sotrang']=$_POST['num_pro'];
		$back1=$_SERVER['HTTP_REFERER'];
		$back1=str_replace('pageNum=','',$back1);
		header("location:$back1");
	}
	if(isset($_SESSION['sotrang']))
			$pageSize=$_SESSION['sotrang'];
	if(isset($_GET['lspgt']) && !isset($_GET['lspdsg']))
	{
		$lspgt = $_GET['lspgt'];
		$idLoaispGT = $i->LayidlspgtTuTenSEO($lspgt);
		$sp=$i->LaySPTheoLoaiGT($idLoaispGT,$pageNum,$pageSize,$totalRows);
		$loaisp=$i->LayChiTietLSPGT($idLoaispGT);
	}
	elseif(isset($_GET['lspgt']) && isset($_GET['lspdsg']))
	{
		
		$lspdsg = $_GET['lspdsg'];
		$idLoaispDSG = $i->LayidlspdsgTuTenSEO($lspdsg);
		
		$sp=$i->LaySPTheoLoaiDSG($idLoaispDSG,$pageNum,$pageSize,$totalRows);
		
		$loaisp=$i->LayChiTietLSPDSG($idLoaispDSG);
		
	}
	elseif(isset($_GET['option']))
	{
		$option=$_GET['option'];
		if(isset($_GET['lsp'])){
			$lsp=$_GET['lsp'];
			$sp=$i->LaySPTheoOptionVaLSP($option,$lsp,$pageNum,$pageSize,$totalRows);
		}
		else
			$sp=$i->LaySPTheoOption($option,$pageNum,$pageSize,$totalRows);
	}
	
?>
<script>
	$(document).ready(function(e) {
        $('#num_pro').change(function(e) {
            $("input[name='sub-num']").click();
        });
		
		function autoScroll(){
			var pageSize=$('#pageSize').val();
			//alert(pageSize);
			if(pageSize==1)
				$("body,html").animate({ scrollTop:350},800);
		}
		autoScroll();
    });
</script>
<div id="breadcrumb">
	<ul>
    	<li><a href="home.bitas">{Home}</a></li>
        <!-- <li><a href="cat/shopping/">{Shopping}</a></li>-->
        <?php if(isset($option)){
			if($option=='hang-moi'){	
		?>
        	<li><a href="san-pham/option/hang-moi/">Hàng mới</a></li>
            <?php if(isset($lsp)){?>
            <li><a href="san-pham/option/hang-moi/<?php echo $lsp?>/">
				<?php
					if($lang=='vn'){
						if($lsp=='be-gai')
							echo 'Bé gái';
						if($lsp=='boy')
							echo 'be-trai';
						if($lsp=='nu')
							echo 'Nữ';
						if($lsp=='nam')
							echo 'Nam';
						if($lsp=='thoi-trang')
							echo 'Thời trang';
					}
					if($lang=='en'){
						echo $lsp;
					}
				?>
            </a></li>
            <?php }?>
        <?php }else{?>
        	<li><a href="san-pham/option/hang-giam-gia/">Giảm giá</a></li>
            <?php if(isset($lsp)){?>
            <li><a href="san-pham/option/hang-giam-gia/<?php echo $lsp?>/">
				<?php
					if($lang=='vn'){
						if($lsp=='be-gai')
							echo 'Bé gái';
						if($lsp=='be-trai')
							echo 'Bé trai';
						if($lsp=='nu')
							echo 'Nữ';
						if($lsp=='nam')
							echo 'Nam';
					}
					if($lang=='en'){
						echo $lsp;
					}
				?>
            </a></li>
            <?php }?>
        <?php }?>
        <?php }//end option
		else {?>
        <?php if(isset($_GET['lspgt']) && !isset($_GET['lspdsg'])){
			$gt=$i->LayChiTietLSPGT($idLoaispGT);
			$row_gt=mysql_fetch_assoc($gt);
		?>
        <li><a href="san-pham/<?php echo $lspgt; ?>/"><?php echo $row_gt['Ten_'.$lang]?></a></li>
        <?php }?>
        <?php if(isset($_GET['lspgt']) && isset($_GET['lspdsg'])){
			$dsg=$i->LayChiTietLSPDSG($idLoaispDSG);
			$row_dsg=mysql_fetch_assoc($dsg);
			
			$idLoaispGT=$row_dsg['idlspgt'];
			$gt=$i->LayChiTietLSPGT($idLoaispGT);
			$row_gt=mysql_fetch_assoc($gt);
		?>
        <li><a href="san-pham/<?php echo $_GET['lspgt']; ?>/"><?php echo $row_gt['Ten_'.$lang]?></a></li>
        <li><a href="san-pham/<?php echo $_GET['lspgt']; ?>/<?php echo $lspdsg; ?>/"><?php echo $row_dsg['Ten_'.$lang]?></a></li>
        <?php }}?>
    </ul>
</div>

<div id="product">
<!--
    <div id="product_header" class="box_size" >
    	<?php
		/*
			if(isset($option)){
				if($option=='new'){
					echo "<img src='img/header_cat/new.jpg' alt='bitas, dep, sandal, giay' />";
				}
				if($option=='discount'){
					echo "<img src='img/header_cat/discount.jpg' alt='bitas, dep, sandal, giay' />";
				}
			}
			else{
	        	$row_lsp=mysql_fetch_assoc($loaisp);
		*/
		?>
        <img src="<?php echo $row_lsp['Hinh']?>" alt="bitas, dep, sandal, giay" />
        <?php //}?>
    </div>
-->
    <div id="top_list">
        
    </div><!-- end top_list -->  
        <div id="list_product" class="box_size">
            <div class="product_type_top box_size">
                <div class="statistic_amout"><?php echo (isset($_GET['idlspdsg']))?$row_dsg['Ten_'.$lang]:$row_gt['Ten_'.$lang]?> <span>(<?php echo $totalRows?> {product})</span></div>
                <div class="paging-form">
                    <div class="paging" align="right">
                        <ul>
                        <?php echo $i->pagesList($totalRows,$pageNum,$pageSize,2); ?>
                        </ul>
                    </div>
                    <form method="POST" action="">
                        Xem: 
                            <select name="num_pro" id="num_pro">
                                <option value="0" <?php if($_SESSION['sotrang']==0) echo "selected='selected'";?>>Tất cả</option>
                                <option value="16" <?php if($_SESSION['sotrang']==16) echo "selected='selected'";?>>16</option>
                                <option value="32" <?php if($_SESSION['sotrang']==32) echo "selected='selected'";?>>32</option>
                                <option value="48" <?php if($_SESSION['sotrang']==48) echo "selected='selected'";?>>48</option>
                                <option value="64" <?php if($_SESSION['sotrang']==64) echo "selected='selected'";?>>64</option>
                            </select>
                            <input type="submit" style="display:none" name="sub-num" value="list" />
                        
                    </form>	
                </div>
           		<div class="clear"></div>
            </div><!--end_product_type_top-->
            
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
                <?php if($row_sp['idBST']){?>
                    <div class="bst">
                    	<img src="img/bst/bst-<?php echo $row_sp['idBST']; ?>.jpg" alt="bo suu tap"  />
                    </div>
                <?php }?>
				<a href="<?php echo $i->changeTitle($row_sp['Ten']) . '-' . $row_sp['idNSP']?>/"><div class="li_hover"></div></a>
				<div class="info box_size">
					<h1><?php echo $row_sp['SKU']?></h1>
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
            <div class="clear"></div>
            <div class="product_type_top box_size">
				<div class="paging" align="right">
                	<ul>
					<?php echo $i->pagesList($totalRows,$pageNum,$pageSize,2); ?>
                    </ul>
             	</div>
           		<div class="clear"></div>
            </div><!--end_product_type_top-->
</div>