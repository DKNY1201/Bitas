<div id="dashboard">
	<div class="row-fluid">
		<div class="span12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-shopping-cart"></i>Đơn hàng (<?php echo $i->CountOrders(); ?>)</div>
				</div>
				<div class="portlet-body">
					<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible="0">
						<ul class="feeds">
							<?php 
								$status = $i->ListTinhTrang();
								while($row_stt = mysql_fetch_assoc($status)){
									$count = $i->CountOrderByStatus($row_stt['idTT']);
							?>
								<li>
									<a href="index.php?p=donhang_list&idTT=<?php echo $row_stt['idTT']; ?>">
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-success">                        
														<i class="icon-bar-chart"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														<?php echo $row_stt['Ten']; ?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<span class="label label-inverse label-mini"><?php echo number_format($count,0,".",","); ?> đơn hàng</span>
										</div>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="scroller-footer">
						<div class="pull-right">
							<a href="index.php?p=donhang_list">Xem tất cả đơn hàng <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- BEGIN DASHBOARD STATS -->
	<div class="row-fluid">
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="icon-comments"></i>
				</div>
				<div class="details">
					<div class="number">
						<?php echo  number_format($i->CommentPendingCount(),0,".",","); ?>
					</div>
					<div class="desc">                           
						Ý kiến chưa duyệt
					</div>
				</div>
				<a class="more" href="index.php?p=ykien_list_chuaduyet">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
				</a>                 
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
			<div class="dashboard-stat green">
				<div class="visual">
					<i class="icon-user"></i>
				</div>
				<div class="details">
					<div class="number"><?php echo number_format($i->UserCount(),0,".",","); ?></div>
					<div class="desc">Khách hàng</div>
				</div>
				<a class="more" href="index.php?p=user_list">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
				</a>                 
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">
			<div class="dashboard-stat purple">
				<div class="visual">
					<i class="icon-envelope-alt"></i>
				</div>
				<div class="details">
					<div class="number"><?php echo number_format($i->EmailMarketingCount(),0,".",","); ?></div>
					<div class="desc">Email nhận tin</div>
				</div>
				<a class="more" href="#">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
				</a>                 
			</div>
		</div>
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
			<div class="dashboard-stat yellow">
				<div class="visual">
					<i class="icon-coffee"></i>
				</div>
				<div class="details">
					<div class="number"><?php echo number_format($i->ProductCount(),0,".",","); ?></div>
					<div class="desc">Sản phẩm</div>
				</div>
				<a class="more" href="index.php?p=sanpham_list">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
				</a>                 
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span3 responsive" data-tablet="span6" data-desktop="span3">
			<div class="dashboard-stat blue">
				<div class="visual">
					<i class="icon-food"></i>
				</div>
				<div class="details">
					<div class="number">
						<?php echo  number_format($i->ProductGroupCount(),0,".",","); ?>
					</div>
					<div class="desc">                           
						Nhóm sản phẩm
					</div>
				</div>
				<a class="more" href="index.php?p=nhomsp_list">
				Xem thêm <i class="m-icon-swapright m-icon-white"></i>
				</a>                 
			</div>
		</div>
	</div>
	<!-- END DASHBOARD STATS -->
	<div class="clearfix"></div>
	<div class="row-fluid">
		<div class="span6">
			<!-- BEGIN PORTLET-->
			<div class="portlet solid light-grey bordered">
				<div class="portlet-title">
					<div class="caption"><i class="icon-bullhorn"></i>Đơn hàng 20 ngày gần nhất</div>
				</div>
				<div class="portlet-body">
					<div id="site_activities_loading">
						<img src="assets/img/loading.gif" alt="loading" />
					</div>
					<div id="site_activities_content" class="hide">
						<div id="site_activities" style="height:250px;"></div>
					</div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
		<div class="span6">
			<!-- BEGIN PORTLET-->
			<div class="portlet solid light-grey bordered">
				<div class="portlet-title">
					<div class="caption"><i class="icon-bullhorn"></i>Đơn hàng 20 tháng gần nhất</div>
				</div>
				<div class="portlet-body">
					<div id="site_activities_loading">
						<img src="assets/img/loading.gif" alt="loading" />
					</div>
					<div id="site_activities_content" class="hide">
						<div id="site_activities" style="height:250px;"></div>
					</div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>		
	</div>
	<div class="row-fluid">
		<div class="span6">
			<!-- BEGIN PORTLET-->
			<div class="portlet solid bordered light-grey">
				<div class="portlet-title">
					<div class="caption"><i class="icon-bar-chart"></i>Site Visits</div>
					<div class="tools">
						<div class="btn-group pull-right" data-toggle="buttons-radio">
							<a href="" class="btn mini">Users</a>
							<a href="" class="btn mini active">Feedbacks</a>
						</div>
					</div>
				</div>
				<div class="portlet-body">
					<div id="site_statistics_loading">
						<img src="assets/img/loading.gif" alt="loading" />
					</div>
					<div id="site_statistics_content" class="hide">
						<div id="site_statistics" class="chart"></div>
					</div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
		<div class="span6">
			<!-- BEGIN PORTLET-->
			<div class="portlet solid bordered light-grey">
				<div class="portlet-title">
					<div class="caption"><i class="icon-bar-chart"></i>Site Visits</div>
					<div class="tools">
						<div class="btn-group pull-right" data-toggle="buttons-radio">
							<a href="" class="btn mini">Users</a>
							<a href="" class="btn mini active">Feedbacks</a>
						</div>
					</div>
				</div>
				<div class="portlet-body">
					<div id="site_statistics_loading">
						<img src="assets/img/loading.gif" alt="loading" />
					</div>
					<div id="site_statistics_content" class="hide">
						<div id="site_statistics" class="chart"></div>
					</div>
				</div>
			</div>
			<!-- END PORTLET-->
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption"><i class="icon-book"></i>Tin tức</div>
				</div>
				<div class="portlet-body">
					<div class="scroller" data-always-visible="1" data-rail-visible="0">
						<ul class="feeds">
							<?php 
								$news = $i->ListnNews(7);
								while($row_news = mysql_fetch_assoc($news)){
							?>
								<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<img class="icon" src="<?php echo $row_news['Hinh']; ?>">
												</div>
												<div class="cont-col2">
													<div class="desc">
														<a href="http://bitas.com.vn/news/detail/<?php echo $row_news['idTin']; ?>/" target="_blank"><?php echo $row_news['TieuDe']; ?></a> <span class="date">(<?php echo $row_news['NgayCapNhat']; ?>)</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<a href="http://bitas.com.vn/news/detail/<?php echo $row_news['idTin']; ?>/"><span class="label label-success label-mini" target="_blank">Xem chi tiết</span></a>
											<a href="index.php?p=tintuc_sua&idtin=<?php echo $row_news['idTin']; ?>"><span class="label label-important label-mini">Chỉnh sửa</span></a>

										</div>

								</li>
							<?php } ?>
						</ul>
					</div>
					<div class="scroller-footer">
						<div class="pull-right">
							<a href="index.php?p=tintuc_list">Xem tất cả tin tức <i class="m-icon-swapright m-icon-gray"></i></a> &nbsp;
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>