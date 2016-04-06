<?php require_once "checklogin.php"; 
?>
<?php //phan quyen
if($_SESSION['group']==1) {?>
<ul id="main_nav">
	<li><a style="background:url(../img/admin/gCons/container.png) no-repeat center 10px" href="index.php?p=nhomsp_list">Quản lí nhóm sản phẩm</a></li>
    <li><a style="background:url(../img/admin/gCons/addressbook.png) no-repeat center 10px" href="index.php?p=sanpham_list">Quản lí sản phẩm</a></li>
    <li><a style="background:url(../img/admin/gCons/chat.png) no-repeat center 10px" href="index.php?p=ykien_list_chuaduyet">Duyệt ý kiến</a></li>
    <li><a style="background:url(../img/admin/gCons/happy-face.png) no-repeat center 10px" href="index.php?p=user_list">Quản lí User</a></li>
    <li><a style="background:url(../img/admin/gCons/server.png) no-repeat center 10px" href="index.php?p=donhang_list">Quản lí Đơn hàng</a></li>
    <li><a style="background:url(../img/admin/gCons/server.png) no-repeat center 10px" href="index.php?p=color_list">Quản lí màu sắc</a></li>
</ul>
<?php }?>