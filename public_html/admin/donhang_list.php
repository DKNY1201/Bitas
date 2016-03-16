<?php
    $idTT = $_GET['idTT'];
    if(!empty($idTT) && $idTT = 19){
        $isRefund = true;
    }
?>
<script>
	$(document).ready(function() {
        var getUrlParameter = function(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');

                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        var idTT = getUrlParameter('idTT');
        var url = idTT ? "ajax_orders.php?idTT=" + idTT : "ajax_orders.php";
        var table = $('#table').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url : url, // json datasource
                type: "get",  // method  , by default get
                error: function(){  // error handling
                    $(".table-error").html("");
                    $("#table").append('<tbody class="table-error"><tr><th colspan="3">Không tìm thấy đơn hàng</th></tr></tbody>');
                    $("#table").css("display","none");
                    
                }
            },
            "sPaginationType": "full_numbers",
            "iDisplayLength": 25,
            "aLengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]],
            "aaSorting" : [[0, 'desc']],
            "searchDelay" : 1000,
        });

         $('.dataTables_filter input').attr("placeholder","Mã đơn hàng, tên người nhận, ID đơn hàng");

        //table.dataTable().fnSetFilteringDelay(10000);

    });
</script>
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Thứ tự</th>
        <th>Ngày</th>
        <th>Mã ĐH</th>
        <th><?php echo $isRefund ? "Lý do hủy" : "Tình trạng";?></th>
        <th>Số lượng</th>
        <th>Tổng giá trị</th>
        <th>PTTT</th>
        <th>Tên người nhận</th>
        <th>Tỉnh thành</th>
        <th>Quận huyện</th>
        <th>Status</th>
      </tr>
    </thead>
<tfoot>
    <tr>
        <th>Thứ tự</th>
        <th>Ngày</th>
        <th>Mã ĐH</th>
        <th><?php echo $isRefund ? "Lý do hủy" : "Tình trạng";?></th>
        <th>Số lượng</th>
        <th>Tổng giá trị</th>
        <th>PTTT</th>
        <th>Tên người nhận</th>
        <th>Tỉnh thành</th>
        <th>Quận huyện</th>
        <th>Status</th>
    </tr>
</tfoot>
</table>