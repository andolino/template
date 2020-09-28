<div class="navbar bg-light custom-container none">
    <div class="row w-100">
      <div class="col-sm-3 mb-3">
        <div class="card text-left bg-info custom-dashboard text-light">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h5 class="card-title"><?php echo $allAsset->count; ?></h5>
                <p class="card-text font-12 text-white">Total Asset.</p>
              </div>
              <div class="col-4">
                <i class="fas fa-barcode"></i>
              </div>
            </div>
          </div>
          <div class="card-footer text-white font-12 text-center">
            More Info <i class="fas fa-arrow-alt-circle-right" style="font-size:12px !important;"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-3 mb-3">
        <div class="card text-left bg-primary custom-dashboard text-light">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h5 class="card-title"><?php echo $allAsset1->count; ?></h5>
                <p class="card-text font-12 text-white">Total Ready To Deploy.</p>
              </div>
              <div class="col-4">
                <i class="fas fa-bookmark"></i>
              </div>
            </div>
          </div>
          <div class="card-footer text-white font-12 text-center">
            More Info <i class="fas fa-arrow-alt-circle-right" style="font-size:12px !important;"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-3 mb-3">
        <div class="card text-left bg-warning custom-dashboard text-light">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h5 class="card-title"><?php echo $allAsset2->count; ?></h5>
                <p class="card-text font-12 text-white">Total Dispatch.</p>
              </div>
              <div class="col-4">
                <i class="fas fa-truck pr-3"></i>
              </div>
            </div>
          </div>
          <div class="card-footer text-white font-12 text-center">
            More Info <i class="fas fa-arrow-alt-circle-right" style="font-size:12px !important;"></i>
          </div>
        </div>
      </div>
      <div class="col-sm-3 mb-3">
        <div class="card text-left bg-success custom-dashboard text-light">
          <div class="card-body">
            <div class="row">
              <div class="col-8">
                <h5 class="card-title"><?php echo $allAsset3->count; ?></h5>
                <p class="card-text font-12 text-white">Total Deployed.</p>
              </div>
              <div class="col-4">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
          </div>
          <div class="card-footer text-white font-12 text-center">
            More Info <i class="fas fa-arrow-alt-circle-right" style="font-size:12px !important;"></i>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-4 pb-2 pt-3">
            <h5>ACTIVITY LOGS</h5>
          </div>
        </div>
        <table class="table table-sm font-12" id="tbl-activity-logs">
          <thead>
            <tr>
              <th>DATE/TIME</th>
              <th>USER</th>
              <th>ACTION</th>
              <th>ITEM</th>
              <th>CUSTODIAN</th>
              <th>TARGET LOCATION</th>
              <!-- <th>SCANNED LOCATION</th> -->
              <th>ACTION</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>


        <br>

        

        <!-- &zoom=12&icon=http://mbyongson.qrd.by/img/littleone.png -->

      </div>

    </div>

</div>

