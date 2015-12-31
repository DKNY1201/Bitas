<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script>
	$(window).load(function() {
		$('#slider').nivoSlider({
			effect: 'random',               // Specify sets like: 'fold,fade,sliceDown'
			slices: 1,                     // For slice animations
			boxCols: 8,                     // For box animations
			boxRows: 4,                     // For box animations
			animSpeed: 500,                 // Slide transition speed
			pauseTime: 5000,                // How long each slide will show
			startSlide: 0,                  // Set starting Slide (0 index)
			directionNav: true,             // Next & Prev navigation
			controlNav: true,               // 1,2,3... navigation
			controlNavThumbs: false,        // Use thumbnails for Control Nav
			pauseOnHover: true,             // Stop animation while hovering
			manualAdvance: false,           // Force manual transitions
			prevText: 'Prev',               // Prev directionNav text
			nextText: 'Next',               // Next directionNav text
			randomStart: false,         	
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="css/slider.css"/>
<div id="pagewrap">
	<div id="slidewrap">
		<div id="slider">
				<img alt="Gallery Picture" title="#caption1" src="img/slider_shopping_online/sample.jpg" />
				<img alt="Gallery Picture" title="#caption2" src="img/slider_shopping_online/sample1.jpg" />
				<img alt="Gallery Picture" title="#caption3" src="img/slider_shopping_online/sample2.jpg" />
				<img alt="Gallery Picture" title="#caption4" src="img/slider_shopping_online/sample3.jpg" />
		</div>
	</div>
</div>