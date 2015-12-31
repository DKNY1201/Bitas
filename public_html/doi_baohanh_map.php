<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script>
  $(document).ready(function(e) {
	$(".info li").css('display','none');
	$(".info li:eq(0)").css('display','block');
	var marker,map,n;

	$(".store").click(function(e){
		e.preventDefault();
		n=$(this).attr("stt");
		lat=$(this).attr("lat");
		lng=$(this).attr("lng");
		//$(this).parent().siblings().removeClass('active');
		$('.first-level li').removeClass('active');
		$(this).parent().addClass('active');
		$(".info li").hide();
		$('.info li').each(function(index, element) {
            if($(this).hasClass(n))
				$(this).fadeIn()
        });
		changeMarkerPos(lat, lng);
	});

	function initialize() {
		var styles = [{
			stylers: [{
				saturation: 0
			}]
		}];

		var fLat=$(".active .store").attr("lat");
		var fLng=$(".active .store").attr("lng");
		
		var mapProp = {
			center: new google.maps.LatLng(fLat, fLng),
			zoom: 17,
			panControl: true,
			zoomControl: true,
			mapTypeControl: false,
			scaleControl: true,
			streetViewControl: true,
			overviewMapControl: false,
			rotateControl: true,
			scrollwheel: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		};

		map = new google.maps.Map(document.getElementById("map_canvas"), mapProp);

		marker = new google.maps.Marker({
			position: new google.maps.LatLng(fLat, fLng),
			animation: google.maps.Animation.BOUNCE,
			icon: 'img/icon/map-markers.png',
		});

		marker.setMap(map);
		map.panTo(marker.position);

		google.maps.event.addListener(marker, "click", function () {
			this['infowindow'].open(map, this);
		});
	}
	
	function changeMarkerPos(lat, lon, title){
		myLatLng = new google.maps.LatLng(lat, lon)
		marker.setPosition(myLatLng);
		marker['infowindow'] = new google.maps.InfoWindow({
            content: title
        });
		map.panTo(myLatLng);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
});

</script>
<div id="map">
	<h1>Địa điểm nhận đổi, bảo hành</h1>
    <div class="content">
        <div id='cssmenu'>
            <ul>
            	<?php
					$tt=$i->listCityDoiTra();
					$zz=0;
					while($row_tt=mysql_fetch_assoc($tt)){
						$idTT=$row_tt['idTinh'];
						$htpp=$i->loadDoiTraByCity($idTT);
						$kk=0;
				?>
                <li class="first-level"><span><?php echo $row_tt['Ten']?></span>
                	<ul>
                    	<?php while($row_htpp=mysql_fetch_assoc($htpp)){ ?>
                        	<li <?php if($kk==0&&$zz==0) echo "class='active'";?>><a class="store" stt="<?php echo $row_htpp['ThuTu']?>" lat="<?php echo $row_htpp['Lat']?>" lng="<?php echo $row_htpp['Lng']?>"><span><?php echo $row_htpp['shortName']?></span></a></li>
                        <?php $kk++; }?>
                    </ul>
                </li>
               <?php $zz++; }?>
            </ul>
        </div>
        <div class="detail">
            <div class="info">
                <ul>
                    <?php
						$htpp=$i->listAllStore();
                        while($row_htpp=mysql_fetch_assoc($htpp)){
                    ?>
                    <li class="<?php echo $row_htpp['ThuTu']?>">
                        <h2><?php echo $row_htpp['Ten']?></h2>
                        <p><?php echo $row_htpp['DiaChi']?></p>
                        <p><span class="info-left">Điện thoại: <?php echo $row_htpp['DienThoai']?></span><!-- <span class="info-right">Fax: <?php echo $row_htpp['Fax']?></span>--></p>
                        <!--<p>Email: <?php echo $row_htpp['Email']?></p>-->
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div id="map_canvas"></div>
        </div>
    </div>
</div>