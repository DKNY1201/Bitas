<?php
	$lspgt = $_GET['lspgt'];
	$idgt = $i->LayidlspgtTuTenSEO($lspgt);
	$lspdsg = $_GET['lspdsg'];
	$iddsg = $i->LayidlspdsgTuTenSEO($lspdsg);
?>
<div class="nav">
	<div class="nav-content">
        <div id="header_nav">
          <ul>
            <li class="box_size dropdown-toggle home <?php if($p=='') echo 'active';?>">
                <a class="home" href="home.bitas"></a>
            </li>
            <li class="box_size dropdown-toggle <?php if($p=='product'&&$_GET['option']=='hang-moi') echo 'active';?>">
                <a class="new" href="san-pham/option/hang-moi/">Hàng mới</a>
                <div class="dropdown_columns">
                    <ul>
                    	<li><a href="san-pham/option/hang-moi/nam/">Nam</a></li>
                        <li><a href="san-pham/option/hang-moi/nu/">Nữ</a></li>
                        <li><a href="san-pham/option/hang-moi/be-trai/">Bé trai</a></li>
                        <li><a href="san-pham/option/hang-moi/be-gai/">Bé gái</a></li> 
                        <li><a href="san-pham/option/hang-moi/thoi-trang/">Thời trang</a></li>
                    </ul>
                </div>
            </li>
            <li class="box_size dropdown-toggle <?php if(($p=='product'&&$idgt==4)||($p=='product'&&$iddsg==11)||($p=='product'&&$iddsg==12)||($p=='product'&&$iddsg==13)) echo 'active';?>">
                <a class="men" href="san-pham/nam/">Nam</a>
                <div class="dropdown_columns">
                    <ul>
                        <li><a href="san-pham/nam/dep-nam/">{Foot_wear}</a></li>
                        <li><a href="san-pham/nam/sandal-nam/">Sandals</a></li>
                        <li><a href="san-pham/nam/giay-nam/">{Shoes}</a></li>
                        <li><a href="san-pham/nam/thoi-trang-nam/">{Fashion}</a></li>
                    </ul>
                </div>
            </li>
            <li class="box_size dropdown-toggle <?php if(($p=='product'&&$idgt==3)||($p=='product'&&$iddsg==7)||($p=='product'&&$iddsg==8)||($p=='product'&&$iddsg==9)) echo 'active';?>">
                <a class="women" href="san-pham/nu/">Nữ</a>
                <div class="dropdown_columns">
                    <ul>
                        <li><a href="san-pham/nu/dep-nu/">{Foot_wear}</a></li>
                        <li><a href="san-pham/nu/sandal-nu/">Sandals</a></li>
                        <li><a href="san-pham/nu/giay-nu/">{Shoes}</a></li>
                        <li><a href="san-pham/nu/thoi-trang-nu/">{Fashion}</a></li>
                    </ul>
                </div>
            </li>
            <li class="box_size dropdown-toggle <?php if(($p=='product'&&$idgt==2)||($p=='product'&&$iddsg==4)||($p=='product'&&$iddsg==5)||($p=='product'&&$iddsg==6)) echo 'active';?>">
                <a class="baby_boy" href="san-pham/giay-tre-em-be-trai/">Bé trai</a>
                <div class="dropdown_columns">
                    <ul>
                        <li><a href="san-pham/giay-tre-em-be-trai/dep-be-trai/">{Foot_wear}</a></li>
                        <li><a href="san-pham/giay-tre-em-be-trai/sandal-be-trai/">Sandals</a></li>
                        <li><a href="san-pham/giay-tre-em-be-trai/giay-be-trai/">{Shoes}</a></li>
                    </ul>
                </div>
            </li>
            <li class="box_size dropdown-toggle <?php if(($p=='product'&&$idgt==1)||($p=='product'&&$iddsg==1)||($p=='product'&&$iddsg==2)||($p=='product'&&$iddsg==3)) echo 'active';?>">
                <a class="baby_girl" href="san-pham/giay-tre-em-be-gai/">Bé gái</a>
                <div class="dropdown_columns">
                    <ul>
                        <li><a href="san-pham/giay-tre-em-be-gai/dep-be-gai/">{Foot_wear}</a></li>
                        <li><a href="san-pham/giay-tre-em-be-gai/sandal-be-gai/">Sandals</a></li>
                        <li><a href="san-pham/giay-tre-em-be-gai/giay-be-gai/">{Shoes}</a></li>
                    </ul>
                </div>
            </li>
            <li class="box_size dropdown-toggle <?php if($p=='product'&&$_GET['option']=='hang-giam-gia') echo 'active';?>">
                <a class="sale_off" href="san-pham/option/hang-giam-gia/">Giảm giá</a>
                <div class="dropdown_columns">
                    <ul>
                    	<li><a href="san-pham/option/hang-giam-gia/nam/">Nam</a></li>
                        <li><a href="san-pham/option/hang-giam-gia/nu/">Nữ</a></li>
                        <li><a href="san-pham/option/hang-giam-gia/be-trai/">Bé trai</a></li>
                        <li><a href="san-pham/option/hang-giam-gia/be-gai/">Bé gái</a></li>  
                        <li><a href="san-pham/option/hang-giam-gia/thoi-trang/">Thời trang</a></li>
                    </ul>
                </div>
            </li>
          </ul>    
        </div><!-- end header_nav -->
    </div><!-- end nav content -->
</div><!--end nav -->