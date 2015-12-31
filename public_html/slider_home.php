<link rel="stylesheet" type="text/css" href="slider/default/default.css">



<link rel="stylesheet" type="text/css" href="slider/nivo-slider.css">



<link rel="stylesheet" type="text/css" href="slider/style.css">

	<div id="wrapper">

        <div class="slider-wrapper theme-default">

            <div id="slider" class="nivoSlider">
            	<?php 
  					if($checkPA && $pro_code=="DONXUAN2016"){
				?>
                
                <a href="http://bitas.com.vn/news/detail/51/"><img alt="don xuan 2016" src="img/slider_home/don-xuan-2016.jpg" /></a>
                <?php }?>
                <a href="http://bitas.com.vn/news/detail/50/"><img alt="giang sinh 2015" src="img/slider_home/banner-giang-sinh-2015.jpg" /></a>
            	<a href="javascript:void(0)"><img alt="trung thu 2015" src="img/slider_home/banner-giang-sinh-2015.jpg" /></a>
            	<a href="http://bitas.com.vn/news/detail/49/"><img alt="trung thu 2015" src="img/slider_home/nha-giao-viet-nam-2015.jpg" /></a>
            	<a href="http://bitas.com.vn/news/detail/47/"><img alt="trung thu 2015" src="img/slider_home/trao-qua-yeu-thuong-banner.jpg" /></a>
            	<a href="http://bitas.com.vn/news/detail/46/"><img alt="trung thu 2015" src="img/slider_home/banner-trung-thu-2015.jpg" /></a>
				<a href="http://bitas.com.vn/news/detail/45/"><img alt="quoc khanh 2015" src="img/slider_home/quoc-khanh-2015.jpg" /></a>
            	<a href="http://bitas.com.vn/san-pham/option/hang-giam-gia/thoi-trang/"><img alt="thoi trang giam gia" src="img/slider_home/thoi-trang-giam-gia.jpg" /></a>
            </div>

        </div>

    </div>



    <script type="text/javascript" src="slider/jquery.nivo.slider.js"></script>



    <script type="text/javascript">

	

    $(window).load(function() {

        $('#slider').nivoSlider({

			effect: 'random',               // Specify sets like: 'fold,fade,sliceDown'

			slices: 15,                     // For slice animations

			boxCols: 8,                     // For box animations

			boxRows: 4,                     // For box animations

			animSpeed: 1000,                 // Slide transition speed

			pauseTime: 10000,                // How long each slide will show

			startSlide: 0,                  // Set starting Slide (0 index)

			directionNav: true,             // Next & Prev navigation

			controlNav: true,               // 1,2,3... navigation

			controlNavThumbs: true,        // Use thumbnails for Control Nav

			pauseOnHover: true,             // Stop animation while hovering

			manualAdvance: false,           // Force manual transitions

			prevText: 'Prev',               // Prev directionNav text

			nextText: 'Next',               // Next directionNav text

			randomStart: false,             // Start on a random slide

		});

    });



</script>