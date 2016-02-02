<div class="breaking-news">
    <span>Thông báo lịch nghỉ và khai trương hệ thống cửa hàng lẻ <a href="http://bitas.com.vn/news/detail/54/">Xem chi tiết >></a></span>
</div><!-- /.breaking-news -->
<div id="header_top">
  <div id="header_top_content">
    <div id="hotline" class="box_size">{Hotline}: <?php echo $row_info['hotline']?>
    </div>
    <div id="space_top" class="box_size">
  		<ul>
        	<li>
            	<a href="javascript:void(0)" class="tooltip">
            		Thanh toán linh hoạt
                    <span>
                    	<img class="callout" src="img/callout.png" alt="phuong thuc thanh toan" />
                        Bạn muốn thanh toán tiền mặt khi nhận hàng? Hay chỉ đơn giản thanh toán trước bằng thẻ ATM, thẻ Visa/Mastercard trực tuyến? Website Bita's cung cấp nhiều phương thức thanh toán linh hoạt, bạn hoàn toàn có thể yên tâm mua sắm và thanh toán theo cách mình thích. 
                    </span>
                </a>
            </li>
            <li>
            	<a href="javascript:void(0)" class="tooltip">
            		Đổi hàng miễn phí
                    <span class="return-goods">
                    	<img class="callout" src="img/callout.png" alt="doi hang mien phi" />
	                    Sai cỡ số? Đổi màu sắc? Sản phẩm không hợp với bạn? Đừng lo, bạn vẫn có thể đổi lại hàng trong vòng 10 ngày hoàn toàn miễn phí.
                    </span>
                </a>
            </li>
            <li>
            	<a href="javascript:void(0)" class="tooltip">
            		Bảo hành miễn phí
                    <span class="return-money">
                    	<img class="callout" src="img/callout.png" alt="bao hanh san pham" />
                        Bita’s cam kết bảo hành sản phẩm trong vòng 60 ngày kể từ ngày nhận hàng và đổi sản phẩm mới nếu không bảo hành được.
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div class="top-right-bar">
        <?php if(!isset($_SESSION['id'])) {?><div id="reg" class="box_size"><a href="user/dang-ki/">{Register}</a></div><?php } else{
		$wl_num=$i->DemSoSPYeuThich($_SESSION['id']);
		?> 
        <div id="wishlist" class="box_size">
        	<a href="user/wish-list/" id="wishlist-link">{Wishlist} (<?php echo $wl_num?>)</a>
            <div class="wishlist-detail">
            	<?php 
					if($wl_num==0)
						echo "{No_Product_Wishlist}";
					else{
					$wl=$i->listWishList($_SESSION['id']);
					while($row_wl=mysql_fetch_assoc($wl)){
						$wl_idNSP=$row_wl['idNSP'];
						$wl_nsp=$i->LayChiTietNhomSPVaMau($wl_idNSP);
						$row_wl_nsp=mysql_fetch_assoc($wl_nsp);
				?>
                	<div class="wishlish-item">
                    	<a href="products/detail/<?php echo $wl_idNSP?>/"><img src="<?php echo $row_wl_nsp['Hinh']?>" alt="<?php echo $row_wl_nsp['Ten']?>" width="100px" /></a>
                        <div class="wishlist-item-info box_size">
                        	<h3><?php echo $row_wl_nsp['Ten']?></h3>
                            <p><span>{Color}:</span> <?php echo $row_wl_nsp['Mau_'.$lang]?></p>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php }}?>
            </div>
        </div>
		<?php }?>
        <div id="login" class="box_size">
            <?php if(isset($_SESSION['id'])==false){?>
                <span id="link_login">{Login}</span>
                <div class="form-login">
                    <img class="callout-login" src="img/callout-login.png" alt="dang nhap" >
                    <form id="formdangnhap" method="post" action="" class="box_size">
                        <div id="dn_head">
                            <h1>{Login}</h1>
                        </div>
                        <div id="dn_body">
                            <label for"email">Email:</label>
                            <input type="text" name="email" id="email" placeholder="Email" class="validate[required,custom[email]]" />
                            <label for"email">{Password}:</label>
                            <input type="password" name="password" placeholder="{Password}" class="validate[required]" />
                        </div>
                        <div id="dn_bot">
                            <input type="checkbox" name="keep-logged" id="keep-logged" checked="checked" /> <label for="keep-logged">{Keep_Login}</label></p>
                            <div class="clear"></div>
                            <input type="submit" name="btndn" id="btndn" value="{Login}">
                            <span class="forget-pass">[<a href="user/quen-mat-khau/">{Forget_Pass}?</a>]</span>
                        </div>
                    </form>
                </div> <!-- form login --> 
            <?php 
            } else {
                $ht_arr=explode(" ", $_SESSION['hoten']);
            ?>
            <div id="hello-box">
                <span id="hello">Xin chào, <?php echo $ht_arr[count($ht_arr)-1];?>!</span>
                <div class="account box_shadow">
                    <ul>
                        <li><a href="user/tai-khoan/">{My_Account}</a></li>
                        <li><a href="user/don-hang/">{My_Order}</a></li>
                        <li><a href="user/tien-thuong/">Tiền thưởng</a></li>
                        <li><a href="user/doi-mat-khau/">{Change_Pass}</a></li>  
                        <li class="divider"></li>
                        <li><a href="logout.php">{Logout}</a></li>
                    </ul>
                </div>
            </div><!-- end hello_box -->
            <?php }?>
        </div><!-- end login -->
		<!--
        <div id="country">
          <div id="cur_con" class="<?php if($lang=='vn') echo 'cur_vn'; if($lang=='en') echo 'cur_en';?>"><?php if($lang=='vn') {?><li onclick="chuyenngonngu('en')" class="en">VN</li><?php } elseif($lang=='en') {?><li onclick="chuyenngonngu('vn')"  class="vn">EN</li><?php }?></div>
        </div>
		-->
     </div><!-- end top-right-bar -->
  </div><!-- end header_top_content -->
</div>
<!--end_header_top-->
<div id="header_top_next">
  <div id="header_top_next_content">
  	<div id="header_center">
      <div id="logo" class="box_size"><a href="home.bitas"><img src="img/logo.png" alt="Bita's online" /></a></div>
      <div id="search" class="box_size">
        <form id="header_s_f" name="header_s_f" action="/" method="get">
	      <input type="hidden" name="p" value="search" />
          <input type="text" name="tukhoa" id="s_txt" class="header_s_t box_size" <?php if(isset($_GET['tukhoa'])) {?> value="<?php echo $_GET['tukhoa']?>"<?php } else{?>value="Gõ từ khóa để tìm kiếm" /<?php }?> onfocus="if(this.value=='{Search_Keyword}') this.value=''" onblur="if(this.value=='') this.value='{Search_Keyword}'" />
          <button class="header_s_b" type="submit" id="s_btn">Tìm kiếm</button>
        </form>
      </div>
	  <div id="support_top" class="box_size">
      	<ul>
        	<li class="lead_buy"><a href="cat/huong-dan-mua-hang/">Hướng dẫn mua hàng</a></li>
            <li class="support_online"><a href="#nogo" onclick="_sbzq.push(['expandWidget']);">Hỗ trợ trực tuyến</a></li>
        </ul>  
      </div>
      <div id="header_cart">
     	<?php require_once "minicart.php"; ?>
      </div><!--end_header_cart--> 
    </div><!--end_header_center-->   
  </div><!-- end header_top_next_content -->
</div><!-- end header_top_next -->
<div class="clear"></div>
<div class="nav-mobile">
	<ul>
    	<li class="sb-toggle-left"><a><i class="fa fa-bars"></i></a></li>
        <li class="search-toggle" data-toggle="search-mobile"><a><i class="fa fa-search"></i></a></li>
        <li>
        	<a href="user/wish-list/">
            	<i class="fa fa-heart"></i>
				<?php 
					if(isset($_SESSION['id'])){
                		echo '<span>('.$wl_num.')</span>';
					}else{
						echo '<span>(0)</span>';
					}	
				?>
             </a>
         </li>
        <li>
        	<a href="gio-hang/tong-quan/">
            	<i class="fa fa-shopping-cart"></i>
                <?php
					$tongsl=0;
					if(count($_SESSION['idPro'])>0){
						$listID=implode(',',$_SESSION['idPro']);
						$sql="SELECT idSP,sanpham.Ten as Ten,Gia_vn,Hinh,Size,mau.Ten_vn as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
						$sp=mysql_query($sql) or die(mysql_error());
						while($row_sp=mysql_fetch_assoc($sp))
						{
							$soluong=$_SESSION['SoLuong'][$row_sp['idSP']];
							$tongsl+=$soluong;
						}
					}
				?>
                <span class="num-cart-mobile <?php if($tongsl>0) echo 'has-item'; else echo 'no-item';?> box_size">
					<?php echo $tongsl;	?>
                </span>
            </a>
        </li>
    </ul>
</div><!-- end nav-mobile -->
<div class="nav-content-mobile search-mobile">
	<div class="nav-search">
        <form id="header_s_f" name="header_s_f" action="/" method="get">
	      <input type="hidden" name="p" value="search" />
          <div class="input-group box_size">
          	<input type="text" name="tukhoa" id="s_txt" class="header_s_t box_size form-control" <?php if(isset($_GET['tukhoa'])) {?> value="<?php echo $_GET['tukhoa']?>"<?php } else{?>value="Gõ từ khóa để tìm kiếm" /<?php }?> onfocus="if(this.value=='{Search_Keyword}') this.value=''" onblur="if(this.value=='') this.value='{Search_Keyword}'" />
          	<div class="input-group-btn">
            	<button class="header_s_b btn-success btn" type="submit" id="s_btn">Tìm kiếm</button>
            </div>
          </div>
        </form>
    </div>
</div>
<?php
	require_once "main_nav.php";
?>