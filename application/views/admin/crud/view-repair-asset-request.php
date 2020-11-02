<div class="cont-view-member">
	
	<div class="col-sm-10">
			<div class="row">
					<!-- heading -->
					<div class="col-sm-8 mb-3 none">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> REPAIR REQUEST</h6>
						</div>
					</div>
					<div class="col-sm-10 mt-2">
            <div class="card">
							<div class="card-body">
								<div class="row w-100">
                <h6 class="mb-0 pl-3">REPAIR REQUEST</h6>
									<div class="col-lg-12 font-12 mt-3">
                    <div class="row">
                      <div class="col-lg-6">
                        <ul style="list-style-type: none;padding-left:0">
                          <li>REQUEST NO. : <strong><?php echo $dataRequest->id; ?></strong></li>
                          <li>REQUESTER : <strong><?php echo $dataRequest->requestor_name; ?></strong></li>
                          <li>OFFICE: <strong><?php echo $dataRequest->office_name; ?></strong></li>
                          <li>REPAIR FILE: <?php echo $dataRequest->file_upload == '' ? '' : '[<a href="'.base_url().'assets/image/uploads/'.$dataRequest->file_upload.'" class="text-info" download> Download Attachment </a>]'; ?></li>
                        </ul>
                      </div>
                      <div class="col-lg-6">
                        <label for="">PICTURE</label>
                        <div class="row">
                        <?php echo $dataRequest->image_upload == '' ? '' : '<div class="col-xs-4 pl-3"><img src="'.base_url().'assets/image/uploads/'.$dataRequest->image_upload.'" width="250" class="img-thumbnail"></div>'; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12"></div>
                  <div class="col-lg-6">
                    <label for="" class="font-12">DESCRIPTION OF THE PROBLEM</label>
                    <p class="font-12"><?php echo $dataRequest->problem_desc; ?></p>
                  </div>
                  <div class="col-lg-6">
                    <label for="" class="font-12">REMARKS</label>
                    <p class="font-12"><?php echo $dataRequest->remarks; ?></strong></p>
                  </div>
                  <div class="col-lg-6 font-12">
                    <ul style="list-style-type: none;padding-left:0">
                      <li>WARRANTY PERIOD: <?php echo $dataRequest->warranty_months; ?> Months</li>
                      <li>UNDER WARRANTY: <?php echo date('Y-m-d', strtotime($dataRequest->date_expire)) == date('Y-m-d') ? '<i class="fas fa-times text-danger"></i>' : '<i class="fas fa-check text-success"></i>'; ?> </li>
                    </ul>
                    
                  </div>
                  <pre>
                    <?php print_r($dataRequest); ?>
                  </pre>
								</div>
							</div>
						</div>
					</div>
					<!-- end -->
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
	</div>
</div>