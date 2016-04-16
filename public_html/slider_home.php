<link rel="stylesheet" type="text/css" href="slider/default/default.css">



<link rel="stylesheet" type="text/css" href="slider/nivo-slider.css">



<link rel="stylesheet" type="text/css" href="slider/style.css">

	<div id="wrapper">

        <div class="slider-wrapper theme-default">
            <div id="slider" class="nivoSlider">
                <?php
                    $sli = $i->ListSlider();
                    while ($row_sli = mysql_fetch_assoc($sli)) {
                    
                ?>
                    <a href="<?php echo $row_sli['url']; ?>"><img alt="<?php echo $row_sli['altText']; ?>" src="<?php echo $row_sli['imgSrc']; ?>" /></a>
                <?php
                    }
                ?>
            	
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