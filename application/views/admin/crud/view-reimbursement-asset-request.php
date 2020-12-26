<div class="cont-view-member">
	<div class="col-sm-10">
			<div class="row">
					<!-- heading -->
					<div class="col-sm-12 mb-3 none">
						<div class="navbar mb-0">
							<h6 class="mb-0"><i class="fas fa-user-cog"></i> REPAIR REQUEST</h6>
						</div>
					</div>
					<div class="col-sm-12 mt-2">
            <?php if(!empty($dataRequest)): ?>
            <div class="card">
							<div class="card-body">
								<form id="frm-request-reimbursement-approval">
                <input type="hidden" name="id" value="<?php echo $dataRequest->id; ?>">
                <div class="row w-100">
                <h6 class="mb-0 pl-3">REPAIR REQUEST</h6>
									<div class="col-lg-12 font-12 mt-3">
                    <div class="row">
                      <div class="col-lg-7">
                        <ul style="list-style-type: none;padding-left:0">
                          <li class="mb-2">REQUEST NO. : <strong><?php echo str_pad($dataRequest->id, 8, '0', STR_PAD_LEFT); ?></strong></li>
                          <li class="mb-2">REQUESTER : <strong><?php echo $dataRequest->request_by; ?></strong></li>
                          <li class="mb-2">OFFICE: <strong><?php echo $dataRequest->office_name; ?></strong></li>
                          <li class="mb-2">TYPE: <strong><?php echo str_replace('_', ' ', $dataRequest->reimbursement_type); ?></strong></li>
                          <li class="mb-2">UNIT: <?php echo $dataRequest->select_unit; ?></li>
                          <li class="mb-2">ITEM DESCRIPTION: <?php echo $dataRequest->item_description; ?></li>
                          <li class="mb-2">ATTACHMENT: <br>
                            <?php $file_upload = explode(',', $dataRequest->file_upload); ?>
                            <?php if(is_array($file_upload)): ?>
                                <?php $ctr1=1; ?>
                                <?php for ($i=0; $i < count($file_upload); $i++) { ?>
                                  [<a href="<?php echo base_url().'assets/image/uploads/' . $file_upload[$i]; ?>" class="text-info" download> Download Attachment <?php echo $ctr1; ?></a>]
                                  <?php $ctr1++; ?>
                                <?php } ?>
                            <?php endif; ?>
                          </li>
                          <li class="mb-2">LINKED TO: </li>
                          <li>
                          <?php if(!empty($dispatchDetails)): ?>
                          <select name="request_id" class="custom-select custom-select-sm w-50" id="">
                            <option value="" selected></option>
                            <?php foreach($dispatchDetails as $row): ?>
                              <option value="<?php echo $row->tbl_asset_request_id; ?>" <?php echo $row->tbl_asset_request_id == $dataRequest->request_id ? 'selected' : ''; ?>><?php echo $row->purpose; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php endif; ?>

                          <?php if(!empty($repairDetails)): ?>
                          <select name="request_id" class="custom-select custom-select-sm w-50" id="">
                            <option value="" selected></option>
                            <?php foreach($repairDetails as $row): ?>
                              <option value="<?php echo $row->id; ?>" <?php echo $row->id == $dataRequest->request_id ? 'selected' : ''; ?>><?php echo $row->asset_tag; ?></option>
                            <?php endforeach; ?>
                          </select>
                          <?php endif; ?>
                          </li>
                        </ul>
                      </div>
                      <div class="col-lg-5">
                        <label for="">PICTURE</label>
                        <div class="row">
                        <?php $img_upload = explode(',', $dataRequest->image_upload); ?>
                          <?php if(is_array($img_upload)): ?>
                            <?php for ($i=0; $i < count($img_upload); $i++) { ?>
                              <div class="col-xs-3 pl-3"><img src="<?php echo base_url() . 'assets/image/uploads/' . $img_upload[$i]; ?>" width="100" class="img-thumbnail"></div>
                            <?php } ?>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <?php if($this->session->level == 2): ?>
                      <?php if($dataRequest->status == 1): ?>
                        <ul style="list-style-type: none;padding-left:0;" class="font-12">
                          <li>REPAIRED DATE. : <?php //echo $dataRequest->repair_date == '' ? '--' : date('F j, Y', strtotime($dataRequest->repair_date));  ?></li>
                          <li>STATUS : <strong>FOR REPAIR</strong></li>
                          <li>NOTES: <br> <strong><?php //echo $dataRequest->tech_notes; ?></strong> [ <strong><a href="#" id="addNotesTechSupport" data-id="<?php //echo $dataRequest->id; ?>" class="text-info"><?php //echo $dataRequest->tech_notes==''?'ADD NOTES':'UPDATE NOTES'; ?></a></strong> ]</li>
                        </ul>
                      <?php endif; ?>

                    <?php else: ?>
                    <!-- <select class="custom-select form-control-sm font-12" name="tech_support_id" id="select-tech-support" required>
                      <option selected value="" hidden>Select Technician / Tech support</option>
                      <option value="" disabled></option>
                      <?php //foreach($techSup as $row): ?>
                      <option value="<?php //echo $row->users_id; ?>"><?php //echo $row->screen_name; ?></option>
                      <?php //endforeach; ?>
                    </select> -->
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-12"></div>
                  <!-- <div class="warranty_cont">
                    <?php //if(strtotime($dataRequest->date_expire) >= strtotime(date('Y-m-d'))): ?>
                      <div class="col-lg-12">
                        <div class="alert alert-success font-12 mt-3">Coordinate with the Supplier: [<strong><?php //echo ucfirst($dataRequest->supplier_name); ?></strong>] for the repair.</div>
                      </div>
                    <?php //else: ?>
                      <div class="col-lg-12">
                        <select class="custom-select form-control-sm font-12" name="tech_support_id" id="select-tech-support" required>
                          <option selected value="" hidden>Select Technician / Tech support</option>
                          <option value="" disabled></option>
                          <?php //foreach($techSup as $row): ?>
                          <option value="<?php //echo $row->users_id; ?>"><?php //echo $row->screen_name; ?></option>
                          <?php //endforeach; ?>
                        </select>
                        <div class="alert alert-warning font-12 mt-3">This will be check and repair with the assigned technician</div>
                      </div>
                      <div class="col-lg-12"></div>
                      <div class="col-lg-8">
                        <input type="date" name="repair_date" id="repair_date" placeholder="Select Repair Date" class="form-control form-control-sm font-12" required>
                      </div>
                    <?php //endif; ?>
                    <div class="col-lg-12">
                      <textarea name="remarks" id="remarks" cols="30" rows="10" class="form-control form-control-sm font-12" placeholder="Remarks "></textarea>
                    </div>
                  </div> -->
                  <div class="col-lg-4 offset-lg-8">
                    <?php if($this->session->level == 2): ?>
                      <button type="button" id="btnCloseRepairRequest" class="btn btn-sm btn-success font-12 float-right mr-1">Close This Request</button>
                      <?php else: ?>
                      <?php if($dataRequest->status == 0): ?>
                        <button type="button" id="btnDisapproveReimbursementRequest" class="btn btn-sm btn-danger font-12 float-right"><i class="fas fa-times"></i> Disapproved</button>
                        <button type="button" id="btnApproveReimbursemetRequest" class="btn btn-sm btn-success font-12 float-right mr-1"><i class="fas fa-check"></i> Approved</button>
                      <?php elseif($dataRequest->status == 1): ?>
                        <div class="alert alert-success font-12 text-center">Approved For Repair</div>
                      <?php elseif($dataRequest->status == 2): ?>
                        <div class="alert alert-danger font-12 text-center">Disapproved</div>
                      <?php endif; ?>
                    <?php endif; ?>
                    <button type="button" id="btnPrintReimbursementRequest" data-id="<?php echo $reqID; ?>" class="btn btn-sm btn-info font-12 float-right mr-1"><i class="fas fa-print"></i> Print as PDF</button>
                  </div>

                  <!-- <pre>
                    <?php //print_r($dataRequest); ?>
                  </pre> -->
								</div>
                </form>
							</div>
						</div>
            <div class="card mt-2 none">
              <div class="card-body cont-parent-child-repair">
                <?php 
                  $status = [0 => 'Pending', 1 => 'For Repair', 2 => 'Disapproved', 3 =>'Cancelled', 4 => 'Closed'];
                ?>
                <h4>PARENT ASSET</h4>
                <div class="row">
                  <div class="col-12" style="overflow-x: scroll;">
                    <table class="table font-12 w-100" id="" data-status="1">
                    <thead>
                      <tr>
                        <th scope="col">ASSET NAME</th>
                        <th scope="col">ASSET CATEGORY </th>
                        <th scope="col">ASSET TAG </th>
                        <th scope="col">PROPERTY TAG</th>
                        <th scope="col">SERIAL NO</th>
                        <th scope="col">REMARKS</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php //echo $dataRequest->asset_name; ?></td>
                        <td><?php //echo $dataRequest->asset_category; ?></td>
                        <td><?php //echo $dataRequest->asset_tag; ?></td>
                        <td><?php //echo $dataRequest->property_tag; ?></td>
                        <td><?php //echo $dataRequest->serial; ?></td>
                        <td><?php //echo $dataRequest->remarks; ?></td>
                        <td><?php //echo $status[$dataRequest->status]; ?></td>
                        <td></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                </div>
                <h4>CHILD ASSET</h4>
                <!-- <pre>
                    <?php //print_r($childAsset); ?>
                </pre> -->
                <div class="row">
                  <div class="col-12" style="overflow-x: scroll;">
                    <table class="table font-12 w-100"  id="" data-status="1">
                      <thead>
                        <tr>
                          <th scope="col">ASSET NAME</th>
                          <th scope="col">ASSET CATEGORY </th>
                          <th scope="col">ASSET TAG </th>
                          <th scope="col">PROPERTY TAG</th>
                          <th scope="col">SERIAL NO</th>
                          <th scope="col">REMARKS</th>
                          <th scope="col">STATUS</th>
                          <th scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($childAsset as $row): ?>
                        <tr>
                          <td><?php //echo $row->name; ?></td>
                          <td><?php //echo $row->asset_category_name; ?></td>
                          <td><?php //echo $row->asset_tag; ?></td>
                          <td><?php //echo $row->property_tag; ?></td>
                          <td><?php //echo $row->serial; ?></td>
                          <td><?php $dataRequest->remarks; ?></td>
                          <td><?php //echo $status[$dataRequest->status]; ?></td>
                          <td><?php //echo $row-> ?></td>
                          <td></td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php endif; ?>
					</div>
					<!-- end -->
			</div>	
			<div class="line mt-3 mb-3 pt-0 pb-0"></div>
	</div>
</div>