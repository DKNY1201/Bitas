<?php
	$htpp_cn=$i->listAllDeliverySystemCN();
	$htpp_dl=$i->listAllDeliverySystemDL();
	$tt=$i->listCityHasStore();
?>
<script>
	$(document).ready(function(e) {
        $('#tinhthanh').change(function(e) {
            var idTT=$(this).val();
			//alert(idTT);
			$('#tt_loaded').load('load_htpp.php?idTT='+idTT);
        });
    });
</script>
<div id="deli_sys">
    <h1 class="title page_title">{Distribution}</h1>
    <div class="page_content">
        <div id="chinhanh">
            <h1>{Brands}</h1>
            <?php
                while($row_htpp_cn=mysql_fetch_assoc($htpp_cn))
                {
            ?>
            <div class="deli_sys_content_ele">
                <h1><?php echo $row_htpp_cn['Ten']?></h1>
                <p><?php echo $row_htpp_cn['DiaChi']?></p>
                <p><span>{Tel}: <?php echo $row_htpp_cn['DienThoai']?>.</span> <span>Fax: <?php echo $row_htpp_cn['Fax']?></span></p>
                <p>Email: <a href="mailto:<?php echo $row_htpp_cn['Email']?>"><?php echo $row_htpp_cn['Email']?></a></p>
            </div>
            <?php
                }
            ?>
        </div>
        
        <div id="daili">
            <h1>{Stores}</h1>
            <form class="tinhthanh">
            	<select id="tinhthanh" class="select_tt">
                	<option value="1000">{Chose_district}</option>
                    <?php while($row_tt=mysql_fetch_assoc($tt)){?>
                    <option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
					<?php }?>
                </select>
            </form>
            <div id="tt_loaded">
            	
            </div>
           
            </table>
        </div>
    </div>
</div>