<script type="text/javascript" src="../js/dataTable.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.11/api/fnSetFilteringDelay.js"></script>

<link rel="stylesheet" type="text/css" href="../css/dataTable.css"/>
<script>
	$(document).ready(function() {

        var table = $('#table').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_orders.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".table-error").html("");
                    $("#table").append('<tbody class="table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
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
        <th>Tình trạng</th>
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
        <th>Tình trạng</th>
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