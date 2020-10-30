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
        <div class="col-6">
          <label for="location_id" class="font-12">Location</label>
          <select class="custom-select custom-select-sm font-12" id="location_id" name="location_id">
						<option selected hidden value="">-SELECT-</option>
						<?php foreach ($locations as $row): ?>
							<option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
						<?php endforeach; ?>
					</select> 
        </div>
        
      </div>
      <div class="line mt-3 mb-3 pt-0 pb-0"></div>

      <div class="row">
        <div class="col-12">
          <button type="button" class="btn btn-info btn-md rounded-0 border float-right font-12" id="printTransmitalSumm"><i class="fas fa-save"></i> PRINT</button>
        </div>
      </div>

    </form>
</div>