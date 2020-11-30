<div class="row w-100">
  <div class="col-5 mb-3">
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="loadPage" data-badge-head="CREATE ASSET" data-link="add-asset" data-ind="" data-cls="cont-add-member"><i class="fas fa-list"></i> Create Asset</button> -->
    <!-- <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-contribution-by-type"><i class="fas fa-user-plus"></i> Add Contribution</button>
    <button type="button" class="btn btn-default btn-md rounded-0 font-12" id="add-payments-by-type"><i class="fas fa-user-plus"></i> Add Loan Payments</button>
    <button type="button" class="btn btn-purple btn-md rounded-0 font-12" id="printMemberDocs"><i class="fas fa-print"></i> Print Docx</button> -->
  </div>
</div>
<div class="row w-100">
<div class="col-sm-8">

<nav class="pb-3">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-link active font-12" id="nav-pending-tab" data-toggle="tab" href="#disp-pending" role="tab" aria-controls="disp-pending" aria-selected="true">Pending</a>
    <a class="nav-link font-12" id="nav-approved-tab" data-toggle="tab" href="#disp-approved" role="tab" aria-controls="disp-approved" aria-selected="false">Approved</a>
    <a class="nav-link font-12" id="nav-disapproved-tab" data-toggle="tab" href="#disp-disapproved" role="tab" aria-controls="disp-disapproved" aria-selected="false">Disapproved</a>
    <a class="nav-link font-12" id="nav-incident-tab" data-toggle="tab" href="#disp-incident" role="tab" aria-controls="disp-disapproved" aria-selected="false">Incident Request</a>
    <a class="nav-link font-12" id="nav-cancelled-tab" data-toggle="tab" href="#disp-cancelled" role="tab" aria-controls="disp-disapproved" aria-selected="false">Cancelled Request</a>
    <a class="nav-link font-12" id="nav-closed-tab" data-toggle="tab" href="#disp-closed" role="tab" aria-controls="disp-disapproved" aria-selected="false">Closed</a>
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="disp-pending" role="tabpanel" aria-labelledby="disp-pending-tab">
    <table class="table font-12 w-100 nowrap condensed" id="tbl-request-dispatch-pending" data-status="0">
      <thead>
        <tr>
          <th scope="col">TICKET</th>
          <th scope="col">LOCATION</th>
          <th scope="col">DISPATCH TO</th>
          <th scope="col">ASSET CATEGORY</th>
          <th scope="col">QTY</th>
          <th scope="col">PURPOSE</th>
          <th scope="col">REQUESTEE</th>
          <th scope="col">REQ DATE TIME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="disp-approved" role="tabpanel" aria-labelledby="disp-approved-tab">
    <table class="table font-12 w-100" id="tbl-request-dispatch-approved" data-status="1">
      <thead>
        <tr>
          <th scope="col">TICKET</th>
          <th scope="col">LOCATION</th>
          <th scope="col">DISPATCH TO</th>
          <th scope="col">ASSET CATEGORY</th>
          <th scope="col">QTY</th>
          <th scope="col">PURPOSE</th>
          <th scope="col">REQUESTEE</th>
          <th scope="col">REQ DATE TIME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
  <div class="tab-pane fade" id="disp-disapproved" role="tabpanel" aria-labelledby="disp-disapproved-tab">
    <table class="table font-12 w-100" id="tbl-request-dispatch-disapproved" data-status="2">
      <thead>
        <tr>
          <th scope="col">TICKET</th>
          <th scope="col">LOCATION</th>
          <th scope="col">DISPATCH TO</th>
          <th scope="col">ASSET CATEGORY</th>
          <th scope="col">QTY</th>
          <th scope="col">PURPOSE</th>
          <th scope="col">REQUESTEE</th>
          <th scope="col">REQ DATE TIME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="disp-cancelled" role="tabpanel" aria-labelledby="disp-cancelled-tab">
    <table class="table font-12 w-100" id="tbl-request-dispatch-cancelled" data-status="3">
      <thead>
        <tr>
          <th scope="col">TICKET</th>
          <th scope="col">LOCATION</th>
          <th scope="col">DISPATCH TO</th>
          <th scope="col">ASSET CATEGORY</th>
          <th scope="col">QTY</th>
          <th scope="col">PURPOSE</th>
          <th scope="col">REQUESTEE</th>
          <th scope="col">REQ DATE TIME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="disp-incident" role="tabpanel" aria-labelledby="disp-incident-tab">
    <table class="table font-12 w-100" id="tbl-request-dispatch-incident" data-status="4">
      <thead>
        <tr>
          <th scope="col">TICKET</th>
          <th scope="col">LOCATION</th>
          <th scope="col">DISPATCH TO</th>
          <th scope="col">ASSET CATEGORY</th>
          <th scope="col">QTY</th>
          <th scope="col">PURPOSE</th>
          <th scope="col">REQUESTEE</th>
          <th scope="col">REQ DATE TIME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>

  

  <div class="tab-pane fade" id="disp-closed" role="tabpanel" aria-labelledby="disp-closed-tab">
    <table class="table font-12 w-100" id="tbl-request-dispatch-closed" data-status="5">
      <thead>
        <tr>
          <th scope="col">TICKET</th>
          <th scope="col">LOCATION</th>
          <th scope="col">DISPATCH TO</th>
          <th scope="col">ASSET CATEGORY</th>
          <th scope="col">QTY</th>
          <th scope="col">PURPOSE</th>
          <th scope="col">REQUESTEE</th>
          <th scope="col">REQ DATE TIME</th>
          <th scope="col">ACTION</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

</div>
</div>