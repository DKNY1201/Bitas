<script>

	$(document).ready(function(e) {

        $('.btn').click(function(e) {

			e.preventDefault();

			var by=$("input[type='radio']:checked").val();

            var info=$("input[name='info']").val();
			info=info.trim();

			//var email=$("input[name='email']").val();

			//var hoten=$("input[name='hoten']").val();

			//var sodt=$("input[name='sodt']").val();

			$("#cskh_display").load("ajax_cskh_loaddh.php?info="+info+"&by="+by);

        });

    });

</script>

<div id="cskh">

	<div class="huongdan">

    	<h4><i class="fa fa-info-circle"></i> Gỏ thông tin của đơn hàng vào trường thông tin.</h4>

    </div>

    <form method="post" action="">

        <table cellpadding="0" cellspacing="0" border="0">

            <thead>

                <th>Thông tin</th>

                <th>Tìm kiếm theo</th>

            </thead>

            <tbody>

                <tr>

                	

                    <td>

                    	<input class="txt short" type="text" name="info" placeholder="Mã đơn hàng, Email, Họ tên, Số ĐT">

                    </td>

                    <td>

                    	<input type="radio" name="by" value="1" checked="checked" /> Mã đơn hàng

                        <input type="radio" name="by" value="2" /> Email

                        <input type="radio" name="by" value="3" /> Họ tên

                        <input type="radio" name="by" value="4" /> Số điện thoại

                </tr>

                <tr>

                	<td colspan="4"><input type="submit" name="btn-sub" class="btn" value="Tìm đơn hàng"></td>

                </tr>

            </tbody>

        </table>

    </form>

    <div id="cskh_display">

    

    </div>

</div>