<?php
	if(isset($_GET['idNSP'])){
		$idNSP=$i->getIDFromUrl($_GET['idNSP']);
		
	}
	$i->TangSoLanXemNSP($idNSP);	
	$hinh=$i->LayHinhAnhModuleZoom($idNSP);
	$row_hinh=mysql_fetch_assoc($hinh);
	
	$nsp=$i->LayChiTietNSP($idNSP);
	$row_nsp=mysql_fetch_assoc($nsp);
	
	$sp=$i->LaySPTheoNSP($idNSP);
	
	$mau=$i->LaySPFollow($row_nsp['follow']);
	
	$yk=$i->ListYK($idNSP);
	$n_yk=mysql_num_rows($yk);
	
	$mbyl=$i->MayBeYouLike();
	
	$spcl=$i->SanPhamCungLoai($idNSP);
	
	if(isset($_SESSION['id'])){
		$check_wl=$i->CheckWishlist($_SESSION['id'],$idNSP);
	}
	
	if(isset($_POST['submit']))
	{
		$i->ThemYK($idNSP);
	}
?>
<script src="http://www.elevateweb.co.uk/wp-content/themes/radial/jquery.fancybox.pack.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://www.elevateweb.co.uk/wp-content/themes/radial/jquery.fancybox.css">
<script>
	$(document).ready(function(e) {
		var size=0;
		var soluong=0;
		var idSP=0;
		/*
		$(".size_chosen").each(function(index, element) {
            $tonkho=$(this).attr('tonkho');
			if($tonkho==0){
				$(this).attr("disabled","disabled");
				$(this).addClass("disabled");
			}
        });
		*/
        $(".size_chosen").click(function(e) {
			//add attr chosen to it
			$(this).siblings().attr("chosen",0); 
			$(this).attr("chosen",1);
			
			//change color
			$(this).css("background","#2980b9").css("color","#FFF");
			$(this).siblings().css("color","#222").css("background","#fff");
			
			//get size,idSP
			size=$(this).attr("size");
			idSP=$(this).attr("idSP");
			
			//change price
			var price=$(this).attr('price');
			var old_price=$(this).attr('old-price');
			$('.new_price span').text(price);
			if(parseInt(old_price)>parseInt(price)){
				old_price+=" VND";
				$('.old_price_detail span').text(old_price);
			}
			//change so luong ton kho
			
			$tonkho_t='<span class="conhang">Hiện đang có hàng</span>';
			$('.soluongtonkho').html($tonkho_t).fadeIn(1000);
			
    	});
		
		$('.buy').click(function(e) {
			soluong=1;
			soluong=parseInt(soluong);

			if(size==0){
				size_t="<p id='warning_size'>Quý khách vui lòng chọn kích cỡ.</p>";
				$('.kichco_warning').stop().html(size_t).fadeIn(500).delay(2000).fadeOut(500);
			}

			if(soluong && idSP){
				if(window.innerWidth >= 768){
					$.ajax({
						url: 'cart_interactive.php',
						type: 'get',
						data: {
							idSP: idSP,
							soluong: soluong,
							action: "add",
							format: "ajax"
						},
						success: function(result){
							$("#header_cart").html("").html(result);
							$("#num_in_cart").text($("#tongsl").val());
							$("#num-cart-mobile").text($("#tongsl").val());
							$("body,html").animate({ scrollTop:0},600);
							$("#cart_sum").slideDown(500);
							if($('#header_cart_button:hover').length != 0){
								setTimeout(function(){
									$("#cart_sum").slideUp(500);	
								},3000);
							}
						}
					});
				}else{
					document.location="http://bitas.com.vn/cart_interactive.php?idSP="+idSP+"&soluong="+soluong+"&action=add";
				}
			}
				
			//}
        });
		$('.wish-list-btn').click(function(e) {
			idNSP=$(this).attr('idNSP');
			act=$(this).attr('act');
			document.location='http://bitas.com.vn/wishlist.php?act='+act+'&idNSP='+idNSP+'&re=detail';
        });
		
		$("#sent-success").delay(5000).fadeOut(500);
		
		$(window).bind('scroll', function() {
			if($(window).innerWidth()>1000){
				var navHeight = 530;
				var html = document.documentElement;
				
				var height= Math.max(html.clientHeight, html.scrollHeight, html.offsetHeight);
				var h=height-870;
				
				if ($(window).scrollTop() > navHeight && $(window).scrollTop() < h) {
				 $('#maybe_you_like').removeClass('absolute_maybe');
				 $('#maybe_you_like').addClass('fixed_maybe');
				}
				else if($(window).scrollTop() > h) {
				 $('#maybe_you_like').removeClass('fixed_maybe');
				 $('#maybe_you_like').addClass('absolute_maybe');
				}
				else{
				 $('#maybe_you_like').removeClass('fixed_maybe');
				}
			}
		});
		
		//VALIDATE
		$('#d_comment_form').validationEngine();
		
    });
</script>
   <style>
		/*set a border on the images to prevent shifting*/
		 #gal img{border:1px solid #AAA;}
		 #gal {margin:10px 0;}
		 /*Change the colour*/
 		.active img{border:1px solid #ED1C24 !important;}
	</style>
    
<div id="breadcrumb">
	<ul>
    	<li><a href="home.bitas">{Home}</a></li>
        <?php
			$idDSG=$row_nsp['idlspdsg'];
			//echo $idDSG; exit();
			$dsg=$i->LayChiTietLSPDSG($idDSG);
			$row_dsg=mysql_fetch_assoc($dsg);
			
			$idGT=$row_dsg['idlspgt'];
			
			$gt=$i->LayChiTietLSPGT($idGT);
			$row_gt=mysql_fetch_assoc($gt);
		?>
        <li><a href="san-pham/<?php echo $row_gt['Ten_Seo']?>/"><?php echo $row_gt['Ten_'.$lang]?></a></li>
        <li><a href="san-pham/<?php echo $row_gt['Ten_Seo']?>/<?php echo $row_dsg['Ten_Seo']?>/"><?php echo $row_dsg['Ten_'.$lang]?></a></li>
        <li><?php echo $row_nsp['SKU']?></li>
    </ul>
</div>
<div id="msg-div">
	<?php 
		if(count($_POST)>0){ 
			echo "<div id='sent-success'>{Tks_for_comment}</div>";
		}
		
	?>
</div>
<div id="detail" class="box_size">
	<div id="d_left">
    	<div id="img_show">
        	<img id="zoom_03" src="<?php echo $row_hinh['urlHS']?>" data-zoom-image="<?php echo $row_hinh['urlHL']?>" alt="<?php echo $row_nsp['Ten'] ?>" />
			<div id="gal">
            <?php
            	mysql_data_seek($hinh,0);
				while($row_hinh=mysql_fetch_assoc($hinh))
				{
			?>
                <a href="#" data-image="<?php echo $row_hinh['urlHS']?>" data-zoom-image="<?php echo $row_hinh['urlHL']?>">
                    <img id="img_01" src="<?php echo $row_hinh['urlHT']?>" alt="<?php echo $row_nsp['Ten'] ?>" />
                </a>
    		<?php }?>
              
			</div><!--end_gal-->
            <script>
				$("#zoom_03").elevateZoom({gallery:'gal', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, easing : true, zoomWindowWidth:435, zoomWindowHeight:420, loadingIcon: 'img/spinner.gif'}); 
			
				//pass the images to Fancybox
				$("#zoom_03").on("click", function(e) {  
					var ez =   $('#zoom_03').data('elevateZoom');	
					$.fancybox(ez.getGalleryList());
				  	return false;
				});
				
			</script>
        </div><!--end_img_show-->
        <div id="d_info">
        	<h1 class="roboto"><?php echo $row_nsp['Ten'] . ' ' . $row_nsp['SKU']?></h1>
            <div id="d_des">
            	<?php echo $row_nsp['MoTa_'.$lang]?>
            </div>
            <h1 class="roboto border_bot">{Choose_size}</h1>
            <ul>
            <?php while($row_sp=mysql_fetch_assoc($sp)){
			?>
            	<button class="size_chosen" price="<?php echo number_format($row_sp['Gia_vn'],0,'.',',')?>" old-price="<?php echo number_format($row_sp['GiaChuaGiam_vn'],0,'.',',')?>" chosen="0" idSP="<?php echo $row_sp['idSP']?>" size="<?php echo $row_sp['Size']?>"><?php echo $row_sp['Size']?></button>
            <?php }?>
            </ul>
            <div class="clear"></div>
            <div class="kichco_warning"></div>
            <div class="soluongtonkho"></div>
            <div class="clear"></div>

            <h1 class="roboto border_bot">{Choose_color}</h1>
            <?php while($row_mau=mysql_fetch_assoc($mau)){
				$color=$i->LayMauNSP($row_mau['idNSP']);
				$row_color=mysql_fetch_assoc($color);
			?>
            <a class="img_color" title="<?php echo $row_color['Mau_'.$lang]?>" href="<?php echo $i->changeTitle($row_nsp['Ten']) . '-' . $row_mau['idNSP']?>/"><img class="<?php if($row_mau['idNSP']==$idNSP) echo 'bor';?>" src="<?php echo $row_mau['Hinh']?>" alt="<?php echo $row_nsp['Ten'] ?>"></a>
            <?php }?>
            
        </div>
        <div class="clear"></div>
        <div id="sanphamcungloai">
        	<h1 class="title page_title">{Same_Type_Product}</h1>
            <div class="spcl-list">
				<?php while($row_spcl=mysql_fetch_assoc($spcl)){?>
                <div class="spcl-item">
                    <a href="<?php echo $i->changeTitle($row_nsp['Ten']) . '-' . $row_spcl['idNSP']?>/"><img width="95%" src="<?php echo $row_spcl['Hinh']?>" alt="<?php echo $row_nsp['Ten'] ?>" /></a>
                    <h1><?php echo $row_spcl['SKU']?></h1>
                    <div class="spcl-info">
                        <p>{Size}: <span><?php echo $row_spcl['Size1']?></span></p>
                        <p><span class="gia">{Price}: <span><?php echo number_format($row_spcl['Gia1_vn'],0,'.',',')?> VND</span></span></p>
                    </div>
                </div>
                <?php }?>
             </div>
        </div>
        <div class="clear"></div>
        <div id="d_comment">
        	<h1 class="comment_title">{Customer_comment}</h1>
            <div class="commented">
            	<?php 
				if($n_yk==0)
						echo "{Plz_comment}";
				while($row_yk=mysql_fetch_assoc($yk)){
						
				?>
                <div class="commented_row">
                    <p class="name"><?php echo $row_yk['TenKH']?><span class="date"> (<?php echo date("d/m/Y H:i:s",strtotime($row_yk['NgayYK']))?>)</span></p>
                    <p class="cm"><?php echo $row_yk['NoiDung']?></p>
                    	<?php
                        	if($row_yk['TraLoi']!=''){
						?>
                        	<div class="answer">
                            	<p class="name">Bita's</p>
                    			<p class="cm"><?php echo $row_yk['TraLoi']?></p>
                            </div>
                        <?php }?>
                </div>
                <?php }?>
             </div>
            
            <div class="your_comment">
            	<h1>{We_want_to_know_your_comment}</h1>
                <form id="d_comment_form" method="post" action="">
					<label for="customer_name">{Name} *</label><br />
					<input type="text" name="tenkh" class="customer_name validate[required]" /><br />
                    <label for="customer_email">Email <i>({Will_be_sec}) * </i></label><br />
					<input type="text" name="email" class="customer_email validate[required,custom[email]]" /><br />
					<label for="customer_comment">{Comment} *</label><br />
                    <textarea class="customer_comment validate[required]" name="noidung"></textarea><br />
                    <input type="submit" value="{Send_Comment}" class="btn btn-info" name="submit" id="btn-sub" />
                    <input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']?>" />
                    <input type="hidden" name="agent" value="<?php echo mysql_real_escape_string($_SERVER['HTTP_USER_AGENT'])?>" />
                </form>
            </div>
        </div>
    </div><!--end_d_left-->
    
    <div id="d_right">
    	<div id="buy_good">
        	<p>{Price}</p>
			<div class="old_price_detail"><span></span></div>
            <div class="new_price"><span>0</span> VND</div>
            
            <button class="buy">{Buy_good}</button>
            <button class="wish-list-btn <?php if($check_wl==0) echo 'not-in-wl'; elseif($check_wl==1) echo 'in-wl'?>" <?php if($check_wl==0) echo "act='add'"; elseif($check_wl==1) echo "act='del'";?> idNSP=<?php echo $idNSP?>>{Wishlist}</button>
        </div>
        
        <div id="more_option">
        	<p>{Will_be_at_ur_house} <span>{In_n_day}</span></p>
    		<p>{Pay_Flexible}</p>
		    <p>Đổi hàng trong 7 ngày</p>
    		<p>Bảo hành 60 ngày</p>
    		<p>HOTLINE: <span class="block-in"><?php echo $row_info['hotline']?></span></p>
        </div>
        
        <div id="maybe_you_like">
            <h1 class="title page_title">{Maybe_you_like}</h1>
                <div class="slide" >
                <?php while($row_mbyl=mysql_fetch_assoc($mbyl)){?>
                    <a href="<?php echo $i->changeTitle($row_mbyl['Ten']) . '-' . $row_mbyl['idNSP']?>/">
                    <div class="slide_element">
                        <img src="<?php echo $row_mbyl['Hinh']?>" width="85" height="65" alt="<?php echo $row_mbyl['Ten']?>" />
                        <h1><?php echo $row_mbyl['SKU']?></h1>
                        <?php if($row_mbyl['GiaChuaGiam1_vn']!="") {?><p class="old_price"><?php echo number_format($row_mbyl['GiaChuaGiam1_vn'],0,",",".")?> VND</p><?php }?>
                        <p class="price red"><?php echo number_format($row_mbyl['Gia1_vn'],0,".",",")?> {Rate}</p>
                    </div>
                    </a>
                <?php
				 }?>
                </div>
         </div><!--end_maybe_you_like-->
    </div><!--end_d_right-->
</div><!--end_detail-->