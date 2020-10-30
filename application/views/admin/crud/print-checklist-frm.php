<div class="card">
  <div class="card-body">
    <form id="frm-print-checklist-report">
      <div class="row">
        <!-- heading -->
        <div class="col-9 mb-3">
          <div class="navbar mb-0">
            <h6 class="mb-0"><i class="fas fa-list"></i> Choice Field</h6>
          </div>
        </div>
        <div class="col-12 p-0 m-0"></div>
        <!-- end -->
      </div>
      <div class="row">
        <!-- <div class="col-6">
          <label for="chk_list" class="font-12">Select Checklist</label>
          <select class="custom-select custom-select-sm font-12" id="chk_list">
						<option selected hidden value="">-SELECT-</option>
						<?php //foreach ($checkList as $row): ?>
							<option value="<?php //echo $row->idno; ?>"><?php //echo $row->luggage_asset_tag; ?></option>
						<?php //endforeach; ?>
					</select> 
        </div> -->
        <div class="col-6">
          <label for="location_id" class="font-12">Location</label>
          <select class="custom-select custom-select-sm font-12" id="location_id" name="location_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($locations as $row): ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php endforeach; ?>
					</select> 
        </div>
        <!-- <div class="col-6">
					<label for="custodian" class="font-12">Custodian</label>
					<select class="custom-select custom-select  -sm font-12" id="custodian" name="custodian">
						<option selected hidden value="">-SELECT-</option>
						<?php //foreach ($custodian as $row): ?>
							<option value="<?php //echo $row->users_id; ?>"><?php //echo $row->screen_name; ?></option>
					  <?php //endforeach; ?>
					</select> 
				</div>
        <div class="col-3 mt-3">
          <div class="custom-control custom-radio">
            <input type="radio" id="ra2" name="asset_type" value="0" class="custom-control-input">
            <label class="custom-control-label font-12" for="ra2">All Asset</label>
          </div>
				</div> 
        <div class="col-4 mt-3">
          <div class="custom-control custom-radio">
            <input type="radio" id="ra1" name="asset_type" value="1" class="custom-control-input">
            <label class="custom-control-label font-12" for="ra1">Mother Asset Only</label>
          </div>
				</div>
        <div class="col-5 mt-3">
          <label for="date_generated" class="font-12">Date (For Remital Slip)</label>
          <input type="date" class="form-control form-control-sm font-12" id="date_generated">
        </div> -->
      </div>
      <div class="line mt-3 mb-3 pt-0 pb-0"></div>

      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-info btn-md rounded-0 border float-right font-12" id="printCheckList"><i class="fas fa-save"></i> PRINT CHECKLIST</button>
        </div>
      </div>

    </form>
</div>