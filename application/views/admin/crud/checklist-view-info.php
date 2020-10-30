<div class="cont-view-member">
	
	<div class="col-sm-10">
			<div class="row">
					<!-- heading -->
					<div class="col-sm-8 mb-3 none">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> Check List Info</h6>
						</div>
					</div>
					<div class="col-sm-8 mt-2">
            <!-- <pre>
              <?php //print_r($data); ?>
            </pre> -->
            <div class="card">
							<div class="card-body">
								<!-- <h5 class="card-title">Card title</h5> -->
								<div class="row w-100">
									<div class="col-xs-5"><img src="<?php echo base_url('assets/image/misc/logo.png'); ?>" width="120"></div>
									<div class="col-xs-7 font-12 mt-3 ml-3">PHILSYS <br> ASSETS <br> MANAGEMENT <br> SYSTEM</div>
								</div>
								<div class="row p-2">
									<!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
									<div class="col-xs-12 font-12 p-3" style="border:2px solid #000;">
										<p class="card-text">THANK YOU! <br> FOR THE ACKNOWLEDGEMENT THAT YOU HAVE RECEIVED THESE <?php echo count($countAssetChecklist); ?> REGISTRATION KITS and <?php echo count($countAssetChecklist); ?> PHOTO BOOTH KITS on your <strong><?php echo !empty($data) ? $data->province : ''; ?></strong> <br><br> 
										Date Received: <?php echo !empty($received_by) ? date('F j, Y h:i:s A', strtotime($received_by)) : '--'; ?>
										</p>
										<!-- <pre>
											<?php //print_r($data); ?>
										</pre>
										<pre>
											<?php //print_r($qrCodesData); ?>
										</pre> -->
									</div>
									<!-- <a href="#" class="card-link">Card link</a>
									<a href="#" class="card-link">Another link</a> -->
								</div>
							</div>
						</div>
					</div>
					<!-- end -->
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
	</div>
</div>