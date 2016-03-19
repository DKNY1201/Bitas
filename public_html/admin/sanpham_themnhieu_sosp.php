<script>
	$(document).ready(function(e) {
        $("#sub").click(function(e) {
			
			var n=$("#sosp_s").val();
			//alert(n);
            //document.location("index.php?p=sanpham_themnhieu&sosp="+n);
			location.replace("index2.php?p=sanpham_themnhieu&sosp="+n);
        });
    });
</script>
<div id="sosp">
	<h1>Bạn muốn thêm bao nhiêu sản phẩm?</h1>
    <select name="sosp" id="sosp_s">
        <?php for($k=1;$k<=20;$k++){?>
        <option value="<?php echo $k?>"><?php echo $k?></option>
        <?php }?>
    </select>
    <br /><br />
    <input type="submit" value="Thêm" class="btn" id="sub">
</div>