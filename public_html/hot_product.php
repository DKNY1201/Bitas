<?php
	$f_pro=$i->SanPhamXemNhieu();
?>
<script type="text/javascript" src="js/jquery.carouFredSel-6.2.1-packed.js"></script>
<script>
    $(function() {
     
    $('#carousel').carouFredSel({
    width: '100%',
    items: {
    visible: 'odd+2'
    },
    scroll: {
    pauseOnHover: true,
    onBefore: function() {
    $(this).children().removeClass( 'hover' );
    }
    },
    auto: {
    items: 1,
    easing: 'linear',
    duration: 5000,
    timeoutDuration: 0
    },
    pagination: {
    container: '#pager',
    items: 1,
    duration: 0.5,
    queue: 'last',
    onAfter: function() {
    var cur = $(this).triggerHandler( 'currentVisible' ),
    mid = Math.floor( cur.length / 2 );
     
    cur.eq( mid ).addClass( 'hover' );
    }
    }
    });
     
    });
</script>
<link rel="stylesheet" type="text/css" href="css/hot_product.css">
<div id="hot_wrapper">
    <div id="carousel" class="box_size" style="margin-top:50px">
    <?php while($row_f_pro=mysql_fetch_assoc($f_pro)) {?>
        <div>
        	<a href="<?php echo $i->changeTitle($row_f_pro['Ten']) . '-' . $row_f_pro['idNSP']?>/">
            <img src="<?php echo $row_f_pro['Hinh']?>" width="160px" height="106px" alt="<?php echo $row_f_pro['Ten']?>" />
            <span>{See_more}</span>
            </a>
        </div>
    <?php }?>
    </div>
</div>