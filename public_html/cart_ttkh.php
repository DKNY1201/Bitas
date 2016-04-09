<?php
    if(count($_SESSION['idPro'])<=0)
        header("location:home.php");
    $error=array();
    $tt=$i->ListTinhThanh();
    $us=$i->ChiTietUser($_SESSION['email']);
    $row_us=mysql_fetch_assoc($us);
    if(isset($_POST['btn_sub'])){
        if(!isset($_SESSION['id']))
        {
            $success=$i->DangKiThanhVien_DangNhap($error);
            if($success==true)
            {
                $i->addAddressBook();
                $i->ThemDonHang_CTDH();
                if($_POST['howtopay']==2||$_POST['howtopay']==3){
                    $i->createOrder();
                }
                else{
                    $i->emailOrderSuccess();        
                    header("location:http://bitas.com.vn/gio-hang/hoan-tat-mua-hang/");
                }
            }
        }
        else{
            if($_POST['idAB']=='')
                $i->addAddressBook();
            $i->ThemDonHang_CTDH();
            if($_POST['howtopay']==2||$_POST['howtopay']==3){
                $i->createOrder();
            }
            else{
               $i->emailOrderSuccess();
               header("location:http://bitas.com.vn/gio-hang/hoan-tat-mua-hang/");
            }
        }
    }
?>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine-vi.js"></script>
<script type="text/javascript" src="js/jquery.validationEngine.js"></script>
<script>
$(document).ready(function(e) {
    $("#ngaysinh").datepicker({
        dateFormat: 'dd/mm/yy',
        maxDate: '-5Y',
    });
    //VALIDATE
    $('#formcart').validationEngine();
});
</script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/validationEngine.jquery.css"/>
<script>
    $(document).ready(function(e) {
        /*
        $(".reciever").click(function(e) {
            var stt=this.checked;
            str=String(stt);
            //Store idTT,idQH,idPX to 3 hidden inputs, use to create new user. Because when select box hidden, php cannot get values from it
            if(str=="false"){
                var idTT_h=$("#tinhthanh").val();
                var idQH_h=$("#quanhuyen").val();
                var idPX_h=$("#phuong").val();
                if(idTT_h!=""&&idQH_h!=""&&idPX_h!=""){
                    $("input[name='tinhthanh']").val(idTT_h);
                    $("input[name='quanhuyen']").val(idQH_h);
                    $("input[name='phuong']").val(idPX_h);
                }
                else{//if customer didn't chosse all tinhthanh,quanhuyen,phuong. website will get these values from tinhthanh_re,quanhuyen_re,phuong_re
                    $("input[name='tinhthanh']").val("");
                    $("input[name='quanhuyen']").val("");
                    $("input[name='phuong']").val("");
                }   
                $("#recieve_add").slideDown();
                $("#tinhthanh").attr("disabled","disabled");
                $("#quanhuyen").attr("disabled","disabled");
                $("#phuong").attr("disabled","disabled");
            }
            else{
                $("#recieve_add").slideUp();
                $("#tinhthanh").removeAttr("disabled");
                $("#quanhuyen").removeAttr("disabled");
                $("#phuong").removeAttr("disabled");
            }
        });
        */
        // show/hide add more address book
        $(".add-more-address").click(function(e) {
            $(this).css("display","none");
            $(".address-in-addressbook").css("display","none");
            $("#recieve_add").css("display","block");
            calcShippingCost_QH();
        });
        $(".choose-from-address-book").click(function(e) {
            $("#recieve_add").css("display","none");
            $(".address-in-addressbook").css("display","block");
            $(".add-more-address").css("display","block");
            calcShippingCost();
        });
        $(".next").click(function(e) {
            e.preventDefault();
            $("#btn_sub").click();
        });
        //address book
        var idAB,idQH,gtdh;
        idAB=$(".choose-address:checked").val();
        $("input[name='idAB']").val(idAB);
        calcShippingCost();
        function calcShippingCost(){
            gtdh=$("input[name='tongtien']").val();
			idTT=$(".choose-address:checked").attr("data-idtt");
            idQH=$(".choose-address:checked").attr("data-idqh");
            if(typeof idQH==='undefined' && typeof idTT==='undefined' )
                return;
            $.ajax({
                type:"GET",
                url:"ajax_chiphivanchuyen.php",
                cache:false,
                data: { gtdh: gtdh, idTT: idTT, idQH: idQH },
                success: function (data){                   
                    data=parseInt(data);
                    gtdh=parseInt(gtdh);
                    var pdv=0;
                    var pttt=$(".pttt_check:checked").val();
                    var tongtien;
                    tongtien=gtdh+data;
                    pdv=phidichvu(tongtien,pttt);
                    tongtien=gtdh+data+pdv;
                    data=format_money(data);
                    pdv=format_money(pdv);
                    tongtien=format_money(tongtien);
                    $("#cpvc").html(data);
                    $("#pdv").html(pdv);
                    $("#tongtien").html(tongtien);
                }
            });
        }
        $(".choose-address").click(function(e){
            idAB=$(this).val();
            $("input[name='idAB']").val(idAB);
            gtdh=$("input[name='tongtien']").val();
			idTT=$(this).attr("data-idtt");
            idQH=$(this).attr("data-idqh");
            $.ajax({
                type:"GET",
                url:"ajax_chiphivanchuyen.php",
                cache:false,
                data: { gtdh: gtdh, idTT: idTT, idQH: idQH },
                success: function (data){                   
                    data=parseInt(data);
                    gtdh=parseInt(gtdh);
                    var pdv=0;
                    var pttt=$(".pttt_check:checked").val();
                    var tongtien;
                    tongtien=gtdh+data;
                    pdv=phidichvu(tongtien,pttt);
                    tongtien=gtdh+data+pdv;
                    data=format_money(data);
                    pdv=format_money(pdv);
                    tongtien=format_money(tongtien);
                    $("#cpvc").html(data);
                    $("#pdv").html(pdv);
                    $("#tongtien").html(tongtien);
                }
            });
        });
        $(".add-more-address").click(function(e) {
            $("input[name='idAB']").val("");
        });
        $(".choose-from-address-book").click(function(e){
            idAB=$(".choose-address:checked").val();
            $("input[name='idAB']").val(idAB);
        });
        //end address book
        //Khi giao hang cung dia chi
        $("#tinhthanh").change(function(e) {
            var idTT=$(this).val();
            $("input[name='tinhthanh']").val(idTT);
            $("#quanhuyen").load("ajax_load_quanhuyen.php?idTT="+idTT);
        });
        $("#quanhuyen").change(function(e) {
            gtdh=$("input[name='tongtien']").val();
            idQH=$(this).val();
            $("input[name='quanhuyen']").val(idQH);
            $("#phuong").load("ajax_load_phuongxa.php?idQH="+idQH);
            /* Only HCM
            $.ajax({
                type:"GET",
                url:"ajax_chiphivanchuyen.php",
                cache:false,
                data: { gtdh: gtdh, idQH: idQH },
                success: function (data){                   
                    data=parseInt(data);
                    gtdh=parseInt(gtdh);
                    var pdv=0;
                    var pttt=$(".pttt_check:checked").val();
                    var tongtien;
                    tongtien=gtdh+data;
                    pdv=phidichvu(tongtien,pttt);

                    tongtien=gtdh+data+pdv;
                    data=format_money(data);
                    pdv=format_money(pdv);
                    tongtien=format_money(tongtien);
                    $("#cpvc").html(data);
                    $("#pdv").html(pdv);
                    $("#tongtien").html(tongtien);
                }
            });
            */
        });
        //Khi giao hang khac dia chi
        $("#tinhthanh_re").change(function(e) {
            var idTT=$(this).val();
            $("#quanhuyen_re").load("ajax_load_quanhuyen.php?idTT="+idTT);
        });
        $("#quanhuyen_re").change(function(e) {
            gtdh=$("input[name='tongtien']").val();
			idTT=$("#tinhthanh_re").val();
            idQH=$(this).val();
            if(idQH == "" && idTT == "")
                return false;
            $("#phuong_re").load("ajax_load_phuongxa.php?idQH="+idQH);
            $.ajax({
                type:"GET",
                url:"ajax_chiphivanchuyen.php",
                cache:false,
                data: { gtdh: gtdh, idTT: idTT, idQH: idQH },
                success: function (data){                   
                    data=parseInt(data);
                    gtdh=parseInt(gtdh);
                    var pdv=0;
                    var pttt=$(".pttt_check:checked").val();
                    var tongtien;
                    tongtien=gtdh+data;
                    pdv=phidichvu(tongtien,pttt);
                    tongtien=gtdh+data+pdv;
                    data=format_money(data);
                    pdv=format_money(pdv);
                    tongtien=format_money(tongtien);
                    $("#cpvc").html(data);
                    $("#pdv").html(pdv);
                    $("#tongtien").html(tongtien);
                }
            });
        });
        function calcShippingCost_QH(){
            gtdh=$("input[name='tongtien']").val();
			idTT=$("#tinhthanh_re").val();
            idQH=$("#quanhuyen_re").val();
            if(idQH=="" && idTT == "")
                return false;
            $("#phuong_re").load("ajax_load_phuongxa.php?idQH="+idQH);
            $.ajax({
                type:"GET",
                url:"ajax_chiphivanchuyen.php",
                cache:false,
                data: { gtdh: gtdh, idTT: idTT, idQH: idQH },
                success: function (data){                   
                    data=parseInt(data);
                    gtdh=parseInt(gtdh);
                    var pdv=0;
                    var pttt=$(".pttt_check:checked").val();
                    var tongtien;
                    tongtien=gtdh+data;
                    pdv=phidichvu(tongtien,pttt);
                    tongtien=gtdh+data+pdv;
                    data=format_money(data);
                    pdv=format_money(pdv);
                    tongtien=format_money(tongtien);
                    $("#cpvc").html(data);
                    $("#pdv").html(pdv);
                    $("#tongtien").html(tongtien);
                }
            });
        }
        $(".phidichvu-icon").hover(function(){
            $(".phidichvu-explain").show();
        },function(){
            $(".phidichvu-explain").hide();
        });
        $(".pttt_check").click(function(e) {
            var pttt=$(this).val();
            var thanhtien=$("input[name='tongtien']").val();
            var cpvc=$("#cpvc").text();
            cpvc=cpvc.replace(",","");
            cpvc=parseInt(cpvc);
            tongtien=parseInt(thanhtien)+cpvc;
            $.ajax({
                type:'GET',
                url:"ajax_phidichvu.php",
                cache:false,
                data:{tongtien:tongtien,pttt:pttt},
                success: function(data){
                    data=parseInt(data);
                    tongtien=parseInt(tongtien);
                    tongtien=tongtien+data;
                    tongtien=format_money(tongtien);
                    data=format_money(data);
                    $("#pdv").html(data);
                    $("#tongtien").html(tongtien);
                }
            });
        });
    });
    function format_money(n) {
        return n.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }
    function phidichvu(tongtien,pttt){
        var pdv=0;
        if(pttt==2){
            pdv=tongtien*0.007+1500;
        }
        else if(pttt==3){
            pdv=tongtien*0.03+1500;
        }
        else
            pdv=0;
        return pdv;
    }
</script>
<div id="cart">
        <ul id="progressbar">
            <li class="active ok">
                1 - Giỏ hàng
            </li>
            <li class="active ok">
                2 - Đăng nhập/Đăng ký
            </li>
            <li class="active">
                3 - Thông tin khách hàng
            </li>
            <li class="">
                4 - Hoàn tất mua hàng
            </li>
        </ul><!--end_process-->
    <div class="clear"></div>
<form action="" method="post" id="formcart">   
    <section class="cart_detail">
            <div class="cart_title">
                <h1 class="title">Thông tin khách hàng</h1>
            </div><!--end_cart_title-->
            <div class="cart_nav cart-nav-ttkh">
                    <a href="#" class="next">Hoàn tất mua hàng<span>&nbsp;</span></a>
             </div>
            <div class="clear"></div>
            <div id="customer_info">
                <h1 class="title">Thông tin khách hàng</h1>
                <?php if(!isset($_SESSION['id'])){ //not login?>
                    <p>Email *</p>
                    <input type="text" name="email" placeholder="Email" class="long validate[required,custom[email]] text-input" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>" />
                    <?php if(isset($error['email'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['email']?></p>
                    <?php }?>
                    <p><i>Chúng tôi sẽ gửi thư xác nhận đến địa chỉ email này. Xin hãy chắc chắn rằng bạn có thể truy cập và sử dụng địa chỉ email này để nhận thư.</i></p><br />
                    <p>Mật khẩu *</p>
                    <input type="password" id="password" name="pass" placeholder="{Password}" class="long validate[required,minSize[6]] text-input" />
                    <?php if(isset($error['pass'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['pass']?></p>
                    <?php }?>
                    <input type="password" name="repass" placeholder="{Re_Enter_Pass}" class="long validate[required,minSize[6],equals[password]] text-input" />
                    <?php if(isset($error['repass'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['repass']?></p>
                    <?php }?>
                    <p>Họ tên *</p>
                    <input type="text" name="hoten" placeholder="{Name}" class="long validate[required] text-input"  value="<?php if(isset($_POST['hoten'])) echo $_POST['hoten']?>" />
                    <?php if(isset($error['hoten'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['hoten']?></p>
                    <?php }?>
                    <p>Điện thoại *</p>
                    <input type="text" name="dienthoai" placeholder="{Tel}" class="long validate[required,minSize[10],maxSize[11],custom[phone]] text-input" value="<?php if(isset($_POST['dienthoai'])) echo $_POST['dienthoai']?>" />
                    <?php if(isset($error['dienthoai'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['dienthoai']?></p>
                    <?php }?>
                    <p>Ngày sinh</p>
                    <input type="text" name="ngaysinh" id="ngaysinh" placeholder="{Birthday}" class="long" value="<?php if(isset($_POST['ngaysinh'])) echo $_POST['ngaysinh']?>"  />
                    <?php if(isset($error['ngaysinh'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important;" id="warning_email" class="box_size"><?php echo $error['ngaysinh']?></p>
                    <?php }?>
                    <p>Địa chỉ *</p>
                    <input type="text" name="diachi" placeholder="{Address}" class="long validate[required] text-input" value="<?php if(isset($_POST['diachi'])) echo $_POST['diachi']?>" />
                    <?php if(isset($error['diachi'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['diachi']?></p>
                    <?php }?>
                    <p>Tỉnh thành *</p>
                    <select id="tinhthanh" name="tinhthanh_s" class="validate[required]" >
                        <option value="">Chọn tỉnh thành</option>
                    <?php while($row_tt=mysql_fetch_assoc($tt)) {?>
                        <option value="<?php echo $row_tt['idTinh']; ?>"><?php echo $row_tt['Ten']?></option>
                    <?php }?>
                    </select>
                    <?php if(isset($error['tinhthanh'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['tinhthanh']?></p>
                    <?php }?>
                    <input type="hidden" value="" name="tinhthanh" />
                    <p>Quận huyện *</p>
                    <select id="quanhuyen" name="quanhuyen_s" class="validate[required]">
                        <option value="">Chọn quận huyện</option>
                    </select>
                     <?php if(isset($error['quanhuyen'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['quanhuyen']?></p>
                    <?php }?>
                    <input type="hidden" value="" name="quanhuyen" />
                    <p>Phường xã *</p>
                    <select id="phuong" name="phuong" class="validate[required]">
                        <option value="">Chọn phường xã</option>
                    </select>
                     <?php if(isset($error['phuong'])==true) {?> 
                        <p style="display:block; margin:0 0 5px 75px !important; color:#e74c3c" class="box_size"><?php echo $error['phuong']?></p>
                    <?php }?>
                    <!--<input type="hidden" value="" name="phuong" />-->
                    <p>Giới tính *</p>
                    <div class="input_gt">
                        <input type="radio" name="gioitinh" value="0" <?php if(isset($_POST['gioitinh'])){ echo ($_POST['gioitinh']==0)?'checked="checked"':''; }else{ echo 'checked="checked"';} ?>> <label>Nữ</label>
                        <input type="radio" name="gioitinh" value="1" <?php if(isset($_POST['gioitinh'])){ echo ($_POST['gioitinh']==1)?'checked="checked"':''; }else{ echo '';} ?>> <label>Nam</label>
                    </div>
                    <h1 class="address-title">Địa chỉ giao hàng</h1>
                    <div id="recieve_add" style="display:block">
                        <p>Họ tên *</p>
                        <input type="text" name="hoten_re" placeholder="{Name}" class="long validate[required]" value="<?php if(isset($_POST['hoten_re'])) echo $_POST['hoten_re']?>" />
                        <p>Điện thoại *</p>
                        <input type="text" name="dienthoai_re" placeholder="{Tel}" class="long validate[required,minSize[10],maxSize[11],custom[phone]]" value="<?php if(isset($_POST['dienthoai_re'])) echo $_POST['dienthoai_re']?>" />
                        <p>Địa chỉ *</p>
                        <input type="text" name="diachi_re" placeholder="{Address}" class="long validate[required]" value="<?php if(isset($_POST['diachi_re'])) echo $_POST['diachi_re']?>" />
                        <p>Tỉnh thành *</p>
                        <select id="tinhthanh_re" name="tinhthanh_re" class="validate[required]">
                            <option value="">{Choose_Province}</option>
                            <?php                            
                            mysql_data_seek($tt,0);
                            while($row_tt=mysql_fetch_assoc($tt)) {?>
                                <option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
                            <?php }?>
                        </select>
                        <select id="quanhuyen_re" name="quanhuyen_re" class="validate[required]">
                            <option value="">Chọn quận huyện</option>
                        </select>
                        <select id="phuong_re" name="phuong_re" class="validate[required]">
                            <option value="">Chọn phường xã</option>
                        </select>
                    </div><!--end_recieve_add-->
                    <div class="ghichu-kh">
                        <p>Ghi chú*</p>
                        <textarea placeholder="{Note_Text}" name="ghichu_kh"></textarea>
                    </div>
                    <p><input class="validate[required]" type="checkbox" id="dongydieukhoan" name="dongydieukhoan"> <label for="dongydieukhoan" class="radioLabel">Đồng ý với <a href="cat/dieu-khoan-su-dung/" class="link" target="_blank">điều khoản sử dụng</a></label></p>
                    <?php }else{//logged
                        $tt_my=$i->LayQuanHuyenTinhThanhTheoEmail($_SESSION['email']);
                        $row_tt_my=mysql_fetch_assoc($tt_my);
                    ?>
                    <table width="100%" id="thongtingiaohang" cellspacing="0">
                        <tr>
                            <td width="100px">Người nhận</td>
                            <td><?php echo $_SESSION['hoten']?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $_SESSION['email']?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td><?php echo $_SESSION['dienthoai']?></td>
                        </tr>
                        <!-- Only HCM
                        <tr>
                            <td>{Address}</td>
                            <td><?php echo $_SESSION['diachi']?>, <?php echo $row_tt_my['typePhuong']." ".$row_tt_my['TenPhuong']?>, <?php echo $row_tt_my['type']." ".$row_tt_my['TenQH']?>, <?php echo $row_tt_my['TenTT']?></td>
                        </tr>
                        -->
                    </table>
                    <p></p>
                    <h1 class="address-title">Địa chỉ giao hàng</h1>
                    <?php
                        //if(isset($_SESSION['id'])){
                        $address=$i->listAddressBook($_SESSION['id']);
                        $n_address=mysql_num_rows($address);
                        if($n_address>=1){// AB created
                    ?>
                        <div class="address-in-addressbook">
                            <h1>Hãy chọn địa chỉ giao hàng</h1>
                            <?php
                            $j=0;
                                while($row_address=mysql_fetch_assoc($address)){
                                    $idTinh=$row_address['idTinh'];
                                    $idQH=$row_address['idQuanHuyen'];
                                    $idPhuong=$row_address['idPhuong'];
                                    $tinh=$i->ChiTietTinhThanh($idTinh);
                                    $row_tinh=mysql_fetch_assoc($tinh);
                                    $qh=$i->ChiTietQuanHuyen($idQH);
                                    $row_qh=mysql_fetch_assoc($qh);
                                    $px=$i->ChiTietPhuong($idPhuong);
                                    $row_px=mysql_fetch_assoc($px);
                                    $j++;
                            ?>
                            <div class="element">
                                <input type="radio" id="choose-address-<?php echo $row_address['idAB']?>" value="<?php echo $row_address['idAB']?>" data-idtt="<?php echo $row_address['idTinh']?>" data-idqh="<?php echo $row_address['idQuanHuyen']?>" <?php if($j==1) echo 'checked="checked"';?> name="choose-address" class="choose-address" />
                                <label for="choose-address-<?php echo $row_address['idAB']?>">
                                    <p><?php echo $row_address['HoTen']?></p>
                                    <p><?php echo $row_address['DienThoai']?></p>
                                    <p><?php echo $row_address['DiaChi'].", ".$row_px['type']." ".$row_px['Ten'].", ".$row_qh['type']." ".$row_qh['Ten'].", ".$row_tinh['Ten']?></p>
                                </label>
                            </div>
                            <?php }?>
                            <input type="hidden" name="idAB" value=""/>
                        </div><!-- end address_in_addressbook -->
                    <div class="clear"></div>
                    <!--<label><input type="checkbox" name="reciever" checked="checked" class="reciever"/>{Same_Address_Shipping}</label>-->
                    <div class="add-more-address">Tạo thêm địa chỉ giao hàng</div>
                    <div id="recieve_add">
                        <div class="choose-from-address-book">Chọn địa chỉ từ danh sách</div>
                        <div class="new-address">
                            <p>Họ tên *</p>
                            <input type="text" name="hoten_re" placeholder="{Name}" class="long validate[required]" />
                            <p>Điện thoại *</p>
                            <input type="text" name="dienthoai_re" placeholder="{Tel}" class="long validate[required,minSize[10],maxSize[11],custom[phone]]" />
                            <p>Địa chỉ *</p>
                            <input type="text" name="diachi_re" placeholder="{Address}" class="long validate[required]" />
                            <p>Tỉnh thành *</p>
                            <select id="tinhthanh_re" name="tinhthanh_re" class="validate[required]">
                                <option value="">Chọn tỉnh thành</option>
                                <?php
                                mysql_data_seek($tt,0);
                                while($row_tt=mysql_fetch_assoc($tt)) {?>
                                    <option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
                                <?php }?>
                            </select>
                            <select id="quanhuyen_re" name="quanhuyen_re" class="validate[required]">
                                <option value="">Chọn quận huyện</option>
                            </select>
                            <select id="phuong_re" name="phuong_re" class="validate[required]">
                                <option value="">Chọn phường xã</option>
                            </select>
                        </div><!-- end new-address -->
                    </div><!--end_recieve_add-->
                    <?php }else{?>
                    <div id="recieve_add_1">
                        <div class="new-address">
                            <p>Họ tên *</p>
                            <input type="text" name="hoten_re" placeholder="Họ tên" class="long validate[required]" />
                            <p>Điện thoại *</p>
                            <input type="text" name="dienthoai_re" placeholder="Điện thoại" class="long validate[required,minSize[10],maxSize[11],custom[phone]]" />
                            <p>Địa chỉ *</p>
                            <input type="text" name="diachi_re" placeholder="Địa chỉ " class="long validate[required]" />
                            <p>Tỉnh thành *</p>
                            <select id="tinhthanh_re" name="tinhthanh_re" class="validate[required]">
                                <option value="">Chọn tỉnh thành</option>
                                <?php
                                mysql_data_seek($tt,0);
                                while($row_tt=mysql_fetch_assoc($tt)) {?>
                                    <option value="<?php echo $row_tt['idTinh']?>"><?php echo $row_tt['Ten']?></option>
                                <?php }?>
                            </select>
                            <select id="quanhuyen_re" name="quanhuyen_re" class="validate[required]">
                                <option value="">Chọn quận huyện</option>
                            </select>
                            <select id="phuong_re" name="phuong_re" class="validate[required]">
                                <option value="">Chọn phường xã</option>
                            </select>
                        </div><!-- end new-address -->
                    </div><!--end_recieve_add-->
                    <?php }?>
                    <div class="ghichu-kh">
                        <p>Ghi chú*</p>
                        <textarea placeholder="{Note_Text}" name="ghichu_kh"></textarea>
                    </div>
                    <?php if(!isset($_SESSION['id'])){?>
                    <p></p>
                    <label><input type="checkbox" name="nhanbantin" checked="checked" /> Đăng ký nhận bản tin</label>
                    <?php }?> 
                <?php }//end logged?>
                <div class="clear"></div>
            </div><!--end_customer_info-->
            <div id="howtopay_cart">
              <div id="howtopay" class="box_size">
                <h1 class="title">Phương thức thanh toán</h1>
                <ul>
                    <?php 
                        $pttt=$i->ListPTTT();
                        while($row_pttt=mysql_fetch_assoc($pttt)){
                    ?>
                    <li>
                        <div class="first_row"><label><input class="pttt_check" type="radio" <?php echo ($row_pttt['idPTTT']==1)?"checked='checked'":""?> name="howtopay" value="<?php echo $row_pttt['idPTTT']?>" /> <strong><?php echo $row_pttt['Ten']?></strong></label></div>
                        <p><?php echo $row_pttt['MoTa']?></p>
                    </li>
                    <?php }?>
                </ul> 
            </div><!--end_howtopay-->
            <div class="clear"></div>
            <div id="cart_end" class="box_size">
                <h1 class="title">Đơn hàng</h1>
                <table width="100%" border="0" cellpadding="4px" cellspacing="0">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th class="text_c">Tổng cộng</th>
                    </tr>
                    <?php
                        $tongsl=0;
                        $tongtien=0;
                        $tongtiengiam=0;
                        $sl_giamgia=0;
                        $listID=implode(",",$_SESSION['idPro']);
                        $sql="SELECT idSP,sanpham.Ten as Ten,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
                        $sp=mysql_query($sql) or die(mysql_error());
                        while($row_sp=mysql_fetch_assoc($sp))
                        {
                            $idsp=$row_sp['idSP'];
                            $tensp=$row_sp['Ten'];
                            $hinh=$row_sp['Hinh'];
                            $soluong=$_SESSION['SoLuong'][$idsp];
                            $mau=$row_sp['Mau'];
                            $size=$row_sp['Size'];
                            $dongia=$row_sp['Gia_vn'];
                            $tien=$soluong*$dongia;
                            $tongsl+=$soluong;
                            $tongtien+=$tien;
                            $giachuagiam=$row_sp['GiaChuaGiam_vn'];
                            //PROMOTION
                            if($dongia<$giachuagiam){
                                $tiengiam=$soluong*$dongia;
                                $tongtiengiam+=$tiengiam;
                                $sl_giamgia+=$soluong;
                            }
                    ?>
                    <tr>
                        <td style="width:40%">
                            <img src="<?php echo $hinh?>" alt="<?php echo $tensp?>">
                            <h3><?php echo $tensp?></h3>
                            <p>Màu: <?php echo $mau?></p>
                            <p>Cỡ số: <?php echo $size?></p>
                            <?php if($dongia<$giachuagiam && $checkPA && $pro_code != 'HAPPYHOUR'){?>
                                <p style="color:#900; font-size:11px;">Hàng giảm giá sẽ không được tính vào chương trình khuyến mãi</p>
                            <?php } ?>
                        </td>
                        <td class="center-mobile"><?php echo $soluong?></td>
                        <td class="text_c"><?php echo number_format($tien,0,".",",")?> VND</td>
                    </tr>
                    <?php
                        }
                        //PROMOTION
                        if($checkPA){
                            $tongtien_khongtinhhanggiamgia=$tongtien - $tongtiengiam;
                            $soluong_khongtinhhanggiamgia=$tongsl - $sl_giamgia;
                            /*
							//BUYMOREGETMORE
                            switch($soluong_khongtinhhanggiamgia){
                                case 1:
                                    break;
                                case 2:
                                    $tien=0;
                                    $tongtien=0;
                                    $listID=implode(",",$_SESSION['idPro']);
                                    $sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
                                    $sp=mysql_query($sql) or die(mysql_error());
                                    $ii=0;
                                    while($row_sp=mysql_fetch_assoc($sp))
                                    {
                                        if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
                                        {
                                            if($ii==0)
                                                $temp=$row_sp['Gia_vn'];
                                            if($row_sp['Gia_vn']<=$temp)
                                                $temp=$row_sp['Gia_vn'];
                                            $ii++;
                                        }
                                        $idsp=$row_sp['idSP'];
                                        $dongia=$row_sp['Gia_vn'];
                                        $soluong=$_SESSION['SoLuong'][$idsp];
                                        $tien=$soluong*$dongia;
                                        $tongtien+=$tien;
                                    }
                                    $tiengiam_promo = $temp * 0.3;
                                    $tongtien_promo = $tongtien - $tiengiam_promo ;
                                    break;
                                case 3:
                                    $tien=0;
                                    $tongtien=0;
                                    $listID=implode(",",$_SESSION['idPro']);
                                    $sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
                                    $sp=mysql_query($sql) or die(mysql_error());
                                    $ii=0;
                                    while($row_sp=mysql_fetch_assoc($sp))
                                    {
                                        if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
                                        {
                                            if($ii==0)
                                                $temp=$row_sp['Gia_vn'];
                                            if($row_sp['Gia_vn']<=$temp)
                                                $temp=$row_sp['Gia_vn'];
                                            $ii++;
                                        }
                                        $idsp=$row_sp['idSP'];
                                        $dongia=$row_sp['Gia_vn'];
                                        $soluong=$_SESSION['SoLuong'][$idsp];
                                        $tien=$soluong*$dongia;
                                        $tongtien+=$tien;
                                    }
                                    $tiengiam_promo = $temp * 0.4;
                                    $tongtien_promo = $tongtien - $tiengiam_promo ;
                                    break;
                                default:
                                    $tien=0;
                                    $tongtien=0;
                                    $listID=implode(",",$_SESSION['idPro']);
                                    $sql="SELECT idSP,sanpham.idNSP as idNSP,sanpham.Ten as Ten,SLTK,Gia_vn,GiaChuaGiam_vn,Hinh,Size,mau.Ten_$lang as Mau FROM sanpham,nhomsp,mau WHERE idSP in ($listID) AND nhomsp.idNSP=sanpham.idNSP AND nhomsp.idMau=mau.idMau";
                                    $sp=mysql_query($sql) or die(mysql_error());
                                    $ii=0;
                                    while($row_sp=mysql_fetch_assoc($sp))
                                    {
                                        if($row_sp['Gia_vn']==$row_sp['GiaChuaGiam_vn'])
                                        {
                                            if($ii==0)
                                                $temp=$row_sp['Gia_vn'];
                                            if($row_sp['Gia_vn']<=$temp)
                                                $temp=$row_sp['Gia_vn'];
                                            $ii++;
                                        }
                                        $idsp=$row_sp['idSP'];
                                        $dongia=$row_sp['Gia_vn'];
                                        $soluong=$_SESSION['SoLuong'][$idsp];
                                        $tien=$soluong*$dongia;
                                        $tongtien+=$tien;
                                    }
                                    $tiengiam_promo = $temp * 0.5;
                                    $tongtien_promo = $tongtien - $tiengiam_promo ;
                                    break;
                            }
							*/
                        }
                    ?>
                    <tr class="tongcong">
                        <td></td>
                        <td>Tạm tính</td>
                        <td>
                            <?php echo number_format($tongtien,0,".",",")?> VND
                            <!--
                            <input type="hidden" name="tongtien" value="<?php echo $tongtien?>" />
                            -->
                        </td>
                    </tr>
                    <!-- ================================================ -->
                    <!-- ================================================ -->
                    <!-- =================== PROMOTION ================== -->
                    <!-- ================================================ -->
                    <!-- ================================================ -->
                    <?php
					if($checkPA){
                    /*if($tongtien_khongtinhhanggiamgia<$promotion_price){*/
                    ?>
                    <!-- OPENNING2014 -->
                    <!--
                    <tr class="tongcong">
                        <td colspan="3">
                            <?php
                                    /*
                                    $remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
                                    echo "<p class='promotion_text'><strong>(Mua thêm ".number_format($remain_to_promo,0,".",",")." VND để được giảm giá  ".number_format($reduceMoney,0,".",",")." VND)</strong><p>"; */
                            ?>
                        </td>
                    </tr>
                    -->
                   <?php //}?>
                    <!-- BUYMOREGETMORE -->
                    <!--
                    <?php //if($soluong_khongtinhhanggiamgia<=1){?>
                    <tr class="tongcong">
                        <td colspan="3">
                            <?php //echo '<p class="promotion_text"><strong>(Mua trên 2 sản phẩm sẽ nhận được ưu đãi <a href="#" style="color: #2980b9; text-decoration: underline">hấp dẫn</a>)</strong></p>';?>
                        </td>
                    </tr>
                    <?php //}?>
                    -->
                    <?php 
						//QUACHONANG080315
						/*
                    	if($tongtien_khongtinhhanggiamgia<$promotion_price){
                    		echo '<tr class="tongcong"><td colspan="3">';
                            if($tongtien_khongtinhhanggiamgia<$promotion_price){
                                $remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;
                                echo '<p class="promotion_text"><strong>(Mua thêm '.number_format($remain_to_promo,0,".",",").' VND để được tặng phiếu massage '.'<a target="_blank" href="http://bitas.com.vn/news/detail/34/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }
							echo '</td></tr>';
						} */ // end QUACHONANG080315
						
						//GIAM15: No promotion text
						
						/*BANHANGTOANQUOC0415
						if(!isset($_SESSION['id'])){
							echo '<tr class="tongcong"><td colspan="3">';
							echo '<p class="promotion_text"><strong>(Đăng nhập và nhận tiền thưởng <a href="cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							echo '</td></tr>';
						}else{
							$checkPlay = $i->CheckDaChoiHayChua($_SESSION['email']);
							if(!$checkPlay){
								echo '<tr class="tongcong"><td colspan="3">';
								echo '<p class="promotion_text"><strong>(Chương trình nhận tiền thưởng <a href="cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
								echo '</td></tr>';
							}
							else{
								$tt = $i -> GetTienThuong($_SESSION['email']);
								$row_tt = mysql_fetch_assoc($tt);
								$gttt = $row_tt['GiaTri'];
								echo '<tr class="tongcong"><td colspan="3">';
								echo '<p class="promotion_text"><strong>Bạn có ' . number_format($gttt,0,".",",") . ' tiền thưởng.</strong></p><br />';
								if($tongtien_khongtinhhanggiamgia<$promotion_price){
									$remain_to_promo=$promotion_price-$tongtien_khongtinhhanggiamgia;	
									echo '<p class="promotion_text"><strong>(Mua thêm '.number_format($remain_to_promo,0,".",",").' VND để sử dụng tiền thưởng '.'<a href="http://bitas.com.vn/cat/quay-so/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
									
								}
								echo '</td></tr>';
							}
						}*/ // end BANHANGTOANQUOC0415 
						// NGAYCUAME2015: No promotion text
						// QUOCTETHIEUNHI2015: No promotion text
						// SINHNHATCTY2015: No promotion text
						// GIAYDEPKHAITRUONG1
						if($pro_code=='GIAYDEPKHAITRUONG1'){
							echo '<tr class="tongcong"><td colspan="3">';
							$isChild = $i ->checkOrderHasChild($listID);
							if($isChild){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/41/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Mua ít nhất 1 mã hàng trẻ em sẽ được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/41/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
						// BEVUONTAMVOI
						if($pro_code=='BEVUONTAMVOI'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($soluong_khongtinhhanggiamgia >= 3){
								echo '<p class="promotion_text"><strong>(Bạn được miển phí sản phẩm chính phẩm có giá trị thấp nhất trong đơn hàng <a href="http://bitas.com.vn/news/detail/42/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Mua ít nhất 3 sản phẩm chính phẩm sẽ được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/42/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}							
						// QUOCKHANH2015
						if($pro_code=='QUOCKHANH2015'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($tongtien_khongtinhhanggiamgia >= $promotion_price){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/45/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 500,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/45/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
						// TRUNGTHU2015
						if($pro_code=='TRUNGTHU2015'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}elseif($tongtien_khongtinhhanggiamgia > 200000){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Mua trên 100,000 VNĐ để được giảm giá <a href="http://bitas.com.vn/news/detail/46/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
						// QUATANGYEUTHUONG
						if($pro_code=='QUATANGYEUTHUONG'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}elseif($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
								echo '<p class="promotion_text"><strong>(Bạn được tặng phiếu mua hàng siêu thị Coop Mart trị giá 50.000 VNĐ <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}elseif($tongtien_khongtinhhanggiamgia >= 500000){
								echo '<p class="promotion_text"><strong>(Bạn được tặng phiếu mua hàng siêu thị Coop Mart trị giá 100.000 VNĐ <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Mua trên 150,000 VNĐ để được hưởng khuyến mãi <a href="http://bitas.com.vn/news/detail/47/" style="color: #2980b9; text-decoration: underline" target="_blank">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
						// TRIANNHAGIAO2015
						if($pro_code=='TRIANNHAGIAO2015'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($tongtien_khongtinhhanggiamgia >= $promotion_price){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/49/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 350,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/49/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
						// NOEL2015
						if($pro_code=='NOEL2015'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($tongtien_khongtinhhanggiamgia >= $promotion_price){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/50/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 300,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/50/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
						// DONXUAN2016
						if($pro_code=='DONXUAN2016'){
							echo '<tr class="tongcong"><td colspan="3">';
							if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng và giảm thêm 50,000 VNĐ <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}elseif($tongtien_khongtinhhanggiamgia >= 500000){
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng và giảm thêm 100,000 VNĐ <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}else{
								echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/51/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
							}
							echo '</td></tr>';
						}
                        // TETTA2016
                        if($pro_code=='TETTA2016'){
                            echo '<tr class="tongcong"><td colspan="3">';
                            if($tongtien_khongtinhhanggiamgia >= $promotion_price){
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/53/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }else{
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 300,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/53/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }
                            echo '</td></tr>';
                        }
                        // KHAITRUONG2016
                        if($pro_code=='KHAITRUONG2016'){
                            echo '<tr class="tongcong"><td colspan="3">';
                            if($soluong_khongtinhhanggiamgia > 1){
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/55/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }elseif($soluong_khongtinhhanggiamgia == 1){
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 10% giá trị đơn hàng, mua trên 300,000 VNĐ để được giảm 20% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/55/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }
                            echo '</td></tr>';
                        }
                         // 832016
                        if($pro_code=='832016'){
                            echo '<tr class="tongcong"><td colspan="3">';
                            echo '<p class="promotion_text"><strong>(Bạn được giảm 10% cho sản phẩm "Nam" và "Bé trai", 20% cho sản phẩm "Nữ" và "Bé gái" <a href="http://bitas.com.vn/news/detail/56/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            echo '</td></tr>';
                        }
                        // 30042016
                        if($pro_code=='30042016'){
                            echo '<tr class="tongcong"><td colspan="3">';
                            if($tongtien_khongtinhhanggiamgia >= 500000){
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 25% giá trị đơn hàng <a href="http://bitas.com.vn/news/detail/60/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }elseif($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 20% giá trị đơn hàng, mua trên 500,000 VNĐ để được giảm 25% <a href="http://bitas.com.vn/news/detail/60/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }elseif($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
                                echo '<p class="promotion_text"><strong>(Bạn được giảm 15% giá trị đơn hàng, mua trên 500,000 VNĐ để được giảm 25% <a href="http://bitas.com.vn/news/detail/60/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }else{
                                echo '<p class="promotion_text"><strong>(Mua trên 150,000 VNĐ để được giảm giá <a href="http://bitas.com.vn/news/detail/60/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
                            }
                            echo '</td></tr>';
                        }
					}// end checkPA
					?>
                    <tr class="tongcong">
                        <td></td>
                        <td>Khuyến mãi</td>
                        <td>
                            <?php
								if($checkPA){
									/* OPENNING2014
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										echo number_format($reduceMoney,0,".",",");
									}else{
										echo "0";
									}
									*/
									/* BUYMOREGETMORE

									if($tongtien_promo){    
										echo number_format($tiengiam_promo,0,".",",");
									}
									else{
										echo "0";
									}
									*/
									/* QUACHONANG080315
									echo number_format($tongtien_khongtinhhanggiamgia*0.1,0,".",",");
									*/
									/* GIAM15
									echo number_format($tongtien_khongtinhhanggiamgia * 0.15,0,".",",");
									*/								
									/* BANHANGTOANQUOC0415
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										echo number_format($gttt,0,".",",");
									}else{
										echo '0';
									}*/
									/* NGAYCUAME2015
									$listID=implode(",",$_SESSION['idPro']);
									$sql="SELECT loaispgt.idlspgt as idlspgt,idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP in ($listID) AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
									$sp=mysql_query($sql) or die(mysql_error());
									$tiengiam = 0;
									$tongtiengiam_promo = 0;
									while($row_sp=mysql_fetch_assoc($sp))
									{
										if($row_sp['Gia_vn'] == $row_sp['GiaChuaGiam_vn']){
											$idsp = $row_sp['idSP'];
											$soluong=$_SESSION['SoLuong'][$idsp];
											$idlspgt = $row_sp['idlspgt'];
											if($idlspgt == 1 || $idlspgt == 3){
												$tiengiam = $row_sp['Gia_vn'] * 0.2 * $soluong;
											}elseif($idlspgt == 2 || $idlspgt == 4){
												$tiengiam = $row_sp['Gia_vn'] * 0.1 * $soluong;
											}
											$tongtiengiam_promo += $tiengiam;
										}
									}
									echo number_format($tongtiengiam_promo,0,".",",");
									// end NGAYCUAME2015 */
									/* QUOCTETHIEUNHI2015
									$listID=implode(",",$_SESSION['idPro']);
									$sql="SELECT loaispgt.idlspgt as idlspgt,idSP,Gia_vn,GiaChuaGiam_vn FROM sanpham,nhomsp,loaispdsg,loaispgt WHERE idSP in ($listID) AND sanpham.idNSP=nhomsp.idNSP AND nhomsp.idlspdsg=loaispdsg.idlspdsg AND loaispdsg.idlspgt = loaispgt.idlspgt";
									$sp=mysql_query($sql) or die(mysql_error());
									$tiengiam = 0;
									$tongtiengiam_promo = 0;
									while($row_sp=mysql_fetch_assoc($sp))
									{
										if($row_sp['Gia_vn'] == $row_sp['GiaChuaGiam_vn']){
											$idsp = $row_sp['idSP'];
											$soluong=$_SESSION['SoLuong'][$idsp];
											$idlspgt = $row_sp['idlspgt'];
											if($idlspgt == 1 || $idlspgt == 2){
												$tiengiam = $row_sp['Gia_vn'] * 0.19 * $soluong;
											}elseif($idlspgt == 3 || $idlspgt == 4){
												$tiengiam = $row_sp['Gia_vn'] * 0.1 * $soluong;
											}
											$tongtiengiam_promo += $tiengiam;
										}
									}
									echo number_format($tongtiengiam_promo,0,".",",");
									// end QUOCTETHIEUNHI2015*/
									/* SINHNHATCTY2015
									echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
									*/
									//HAPPY HOUR
									if($pro_code == "HAPPYHOUR"){
										echo "0";
									}
									// GIAYDEPKHAITRUONG1
									if($pro_code=='GIAYDEPKHAITRUONG1'){
										if($isChild){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo '0';
										}
									}
									// BEVUONTAMVOI
									if($pro_code=='BEVUONTAMVOI'){
										if($soluong_khongtinhhanggiamgia >= 3){
											$saleoff = $i->calcLowestProduct($listID);
											echo number_format($saleoff,0,".",",");
										}else{
											echo '0';
										}
									}
									// QUOCKHANH2015
									if($pro_code=='QUOCKHANH2015'){
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}
									}
									// TRUNGTHU2015
									if($pro_code=='TRUNGTHU2015'){
										if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia > 200000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo '0';
										}
									}
									// QUATANGYEUTHUONG
									if($pro_code=='QUATANGYEUTHUONG'){
										if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}else{
											echo '0';
										}
									}
									// TRIANNHAGIAO2015 | NOEL2015 | TETTA2016
									if($pro_code=='TRIANNHAGIAO2015' || $pro_code=='NOEL2015' || $pro_code=='TETTA2016'){
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
										}else{
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}
									}
									// DONXUAN2016
									if($pro_code=='DONXUAN2016'){
										if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1 + 50000,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia >= 500000){
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1 + 100000,0,".",",");
										}else{
											echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
										}
									}
                                    // KHAITRUONG2016
                                    if($pro_code=='KHAITRUONG2016'){
                                        if($soluong_khongtinhhanggiamgia > 1){
                                            echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
                                        }elseif($soluong_khongtinhhanggiamgia == 1){
                                            echo number_format($tongtien_khongtinhhanggiamgia * 0.1,0,".",",");
                                        }
                                    }
                                    // 832016
                                    if($pro_code=='832016'){
                                        $listID=implode(",",$_SESSION['idPro']);
                                        $listQuantity = implode(",",$_SESSION['SoLuong']);
                                        $discount = $i->CalcDiscountFor832016($listID,$listQuantity);
                                        echo number_format($discount,0,".",",");
                                    }
                                    // 30042016
                                    if($pro_code=='30042016'){
                                        if($tongtien_khongtinhhanggiamgia >= 500000){
                                            echo number_format($tongtien_khongtinhhanggiamgia * 0.25,0,".",",");
                                        }elseif($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
                                            echo number_format($tongtien_khongtinhhanggiamgia * 0.2,0,".",",");
                                        }elseif($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
                                            echo number_format($tongtien_khongtinhhanggiamgia * 0.15,0,".",",");
                                        }else{
                                            echo '0';
                                        }
                                    }
								}else{
									echo "0";
								}
                            ?> VND
                        </td>
                    </tr>
                    <tr class="tongcong">
                        <td></td>
                        <td>Tổng tiền</td>
                        <td>
                            <?php
								if($checkPA){
									/* OPENNING 2014
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										$tongtien-=$reduceMoney;
									}
									*/
									/* BUYMOREGETMORE
									if($tongtien_promo){    
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promo.'" />';
										echo number_format($tongtien_promo,0,".",",");
									}
									else{
										echo '<input type="hidden" name="tongtien" value="'.$tongtien.'?>" />';
										echo number_format($tongtien,0,".",",");
									}*/
									/*
										QUACHONANG080315
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
										echo number_format($tongtien_promotion,0,".",",");
									*/
									
									/*GIAM15
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
										echo number_format($tongtien_promotion,0,".",",");
									*/
									/* BANHANGTOANQUOC0415
									if($tongtien_khongtinhhanggiamgia>$promotion_price){
										$tongtien_promotion = $tongtien - $gttt;
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
										echo number_format($tongtien_promotion,0,".",",");
									}else{
										echo '<input type="hidden" name="tongtien" value="'.$tongtien.'" />';
										echo number_format($tongtien,0,".",",");
									}*/
									/* NGAYCUAME2015
									$tongtien_promotion = $tongtien - $tongtiengiam_promo;
									echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									echo number_format($tongtien_promotion,0,".",",");
									*/
									/* QUOCTETHIEUNHI2015
									$tongtien_promotion = $tongtien - $tongtiengiam_promo;
									echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									echo number_format($tongtien_promotion,0,".",",");
									*/
									/* SINHNHATCTY2015
									$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
									echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									echo number_format($tongtien_promotion,0,".",",");
									*/
									// HAPPYHOUR
									if($pro_code=='HAPPYHOUR'){
										echo '<input type="hidden" name="tongtien" value="'.$tongtien.'" />';
										echo number_format($tongtien,0,".",",");
									}
									// GIAYDEPKHAITRUONG1
									if($pro_code=='GIAYDEPKHAITRUONG1'){
										if($isChild){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
											echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
										}else{
											echo number_format($tongtien,0,".",",");
											echo '<input type="hidden" name="tongtien" value="'.$tongtien.'" />';
										}
									}
									// BEVUONTAMVOI
									if($pro_code=='BEVUONTAMVOI'){										
										if($soluong_khongtinhhanggiamgia >= 3){
											$tongtien_promotion = $tongtien - $saleoff;
											echo number_format($tongtien_promotion,0,".",",");
											echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
										}else{
											echo number_format($tongtien,0,".",",");
											echo '<input type="hidden" name="tongtien" value="'.$tongtien.'" />';
										}
									}
									// QUOCKHANH2015
									if($pro_code=='QUOCKHANH2015'){										
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									}
									// TRUNGTHU2015
									if($pro_code=='TRUNGTHU2015'){										
										if($tongtien_khongtinhhanggiamgia >= 100000 && $tongtien_khongtinhhanggiamgia <= 200000){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia > 200000){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtien;
											echo number_format($tongtien,0,".",",");
										}
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									}
									// QUATANGYEUTHUONG
									if($pro_code=='QUATANGYEUTHUONG'){										
										if($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtien;
											echo number_format($tongtien,0,".",",");
										}
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									}
									// TRIANNHAGIAO2015 | NOEL2015 | TETTA2016
									if($pro_code=='TRIANNHAGIAO2015' || $pro_code=='NOEL2015' || $pro_code=='TETTA2016'){										
										if($tongtien_khongtinhhanggiamgia >= $promotion_price){
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									}
									// DONXUAN2016
									if($pro_code=='DONXUAN2016'){										
										if($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
											$tongtien_promotion = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 50000);
											echo number_format($tongtien_promotion,0,".",",");
										}elseif($tongtien_khongtinhhanggiamgia >= 500000){
											$tongtien_promotion = $tongtiengiam + ($tongtien_khongtinhhanggiamgia * 0.9 - 100000);
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
											echo number_format($tongtien_promotion,0,".",",");
										}
										echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
									}
                                    // KHAITRUONG2016
                                    if($pro_code=='KHAITRUONG2016'){                                       
                                        if($soluong_khongtinhhanggiamgia > 1){
                                            $tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
                                            echo number_format($tongtien_promotion,0,".",",");
                                        }elseif($soluong_khongtinhhanggiamgia == 1){
                                            $tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
                                            echo number_format($tongtien_promotion,0,".",",");
                                        }
                                        echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
                                    }
                                    // 832016
                                    if($pro_code=='832016'){
                                        $remain_total = $tongtien - $discount;
                                        echo number_format($remain_total,0,".",",");
                                        echo '<input type="hidden" name="tongtien" value="'.$remain_total.'" />';
                                    }
                                    // 30042016
                                    if($pro_code=='30042016'){
                                        if($tongtien_khongtinhhanggiamgia >= 500000){
                                            $tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.75;
                                            echo number_format($tongtien_promotion,0,".",",");
                                        }elseif($tongtien_khongtinhhanggiamgia >= 300000 && $tongtien_khongtinhhanggiamgia < 500000){
                                            $tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.8;
                                            echo number_format($tongtien_promotion,0,".",",");
                                        }elseif($tongtien_khongtinhhanggiamgia >= 150000 && $tongtien_khongtinhhanggiamgia < 300000){
                                            $tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
                                            echo number_format($tongtien_promotion,0,".",",");
                                        }else{
                                            $tongtien_promotion = $tongtien;
                                            echo number_format($tongtien,0,".",",");
                                        }
                                        echo '<input type="hidden" name="tongtien" value="'.$tongtien_promotion.'" />';
                                    }	
								}else{
									echo '<input type="hidden" name="tongtien" value="'.$tongtien.'" />';
									echo number_format($tongtien,0,".",",");
								}
                            ?> VND
                        </td>
                    </tr>
                    <?php
						if($checkPA){
							if($pro_code == "HAPPYHOUR"){
								if((int)$tongtien >= (int)$promotion_price){
									echo '<tr class="tongcong"><td colspan="3">';
									echo '<p class="promotion_text"><strong>(Miễn phí Phí vận chuyển <a href="http://bitas.com.vn/news/detail/39/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
									echo '</td></tr>';
								}else{
									echo '<tr class="tongcong"><td colspan="3">';
									echo '<p class="promotion_text"><strong>(Mua trên ' . number_format($promotion_price,0,".",",") . ' VNĐ sẽ được miễn phí Phí vận chuyển <a href="http://bitas.com.vn/news/detail/39/" style="color: #2980b9; text-decoration: underline">xem thêm</a>)</strong></p>';
									echo '</td></tr>';
								}
							}
						}
					?>
                    <tr class="vanchuyen">
                        <td></td>
                        <td>Phí vận chuyển</td>
                        <td>
                        	<?php
								if($checkPA && $pro_code == 'HAPPYHOUR'){
                            		if($tongtien > $promotion_price){
										echo 'Miễn phí';
										echo '<div id="cpvc" style="display:none">0</div>';
									}else{
							?>
                            			<div id="cpvc" style="display:inline">0</div> VND
                            <?php
                            		}
								}else{
							?>
                            	<div id="cpvc" style="display:inline">0</div> VND
                            <?php } ?>
                        </td>
                    </tr>
                    <tr class="vanchuyen">
                        <td></td>
                        <td>
                        Phí dịch vụ
                        <div class="phidichvu">
                            <img class="phidichvu-icon" src="img/icon/question-icon.png" alt="phi dich vu" />
                            <div class="phidichvu-explain">
                                Là phí phụ thu cho dịch vụ thanh toán trực tuyến và mỗi lần xử lý giao dịch thẻ. Phí này không thể hoàn lại khi đã thanh toán.
                            </div>
                        </div>
                        </td>
                        <td>
                            <div id="pdv" style="display:inline">0</div> VND
                        </td>
                    </tr>
                    <tr class="tongtien">
                        <td></td>
                        <td>Tổng số tiền</td>
                        <td class="tongtien_num">
                            <div id="tongtien" style="display:inline">
                            	<?php
									if($checkPA){
										/* OPENNING 2014
										if($tongtien_khongtinhhanggiamgia>$promotion_price){
											$tongtien-=$reduceMoney;
										}
										*/
										/* BUYMOREGETMORE
										if($tongtien_promo){    
											echo number_format($tongtien_promo,0,".",",");
										}
										else{
											echo number_format($tongtien,0,".",",");
										}
										*/
										/* QUACHONANG080315
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.9;
										echo number_format($tongtien_promotion,0,".",",");
										*/
										/*GIAM15
										$tongtien_promotion = $tongtiengiam + $tongtien_khongtinhhanggiamgia * 0.85;
										echo number_format($tongtien_promotion,0,".",",");
										*/
										/* BANHANGTOANQUOC0415
										if($tongtien_khongtinhhanggiamgia>$promotion_price){
											$tongtien_promotion = $tongtien - $gttt;
											echo number_format($tongtien_promotion,0,".",",");
										}else{
											echo number_format($tongtien,0,".",",");
										}*/
										echo number_format($tongtien_promotion,0,".",",");
									}
									else{
										echo number_format($tongtien,0,".",",");
									}
								?>
                            </div> VND
                        </td>
                    </tr>
                </table>
            </div><!--end_cart_end-->
        </div><!--end_howtopay_cart-->
        <div class="clear"></div>
        <div class="cart_nav cart-nav-ttkh">
                    <a href="#" class="next">Hoàn tất mua hàng<span>&nbsp;</span></a>
                    <input type="submit" name="btn_sub" id="btn_sub" style="display:none" />
        </div>
    </section>
</form>
</div>