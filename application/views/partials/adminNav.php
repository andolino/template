<!-- Sidebar  -->
<nav id="sidebar">
  <div class="sidebar-header">
    <div class="row">
      <div class="col-3"><img src="<?= base_url('assets/image/misc/pro-logo.png') ?>" width="50"></div>
      <div class="col-9"><h6 style="line-height: 3">CBAM-ERS SYSTEM </h6></div>
    </div>
  </div>
  <ul class="list-unstyled components">
      <p class="text-center"> WELCOME <?php echo strtoupper($this->session->username); ?></p>
      <?php if($logged_in->level == 0 || $logged_in->level == 1): ?>
      <li>
        <a href="<?php echo base_url(); ?>" class="font-12"><i class="fas fa-barcode"></i> DASHBOARD</a>
        <a href="<?php echo base_url(); ?>settings" class="font-12 <?php echo $logged_in->level == 1 ? 'd-none' : ''; ?>"><i class="fas fa-cog"></i> SETTINGS</a>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>view-history"><i class="fas fa-tasks"></i> HISTORY</a>
      </li>
      <li>
        <a href="<?php echo base_url(); ?>asset-list"><i class="fas fa-tasks"></i> ALL ASSETS</a>
      </li>
      <li class="">
				<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-tasks"></i> ASSET REQUEST</a>
				<ul class="collapse list-unstyled" id="homeSubmenu">
					<li>
            <a href="<?php echo base_url(); ?>asset-ready-to-deploy">Asset Ready to Deploy</a>
					</li>
					<li>
            <a href="<?php echo base_url(); ?>asset-dispatch">Asset Dispatch</a>
					</li>
					<li>
            <a href="<?php echo base_url(); ?>asset-deployed">Asset Deployed</a>
					</li>
					
					<!-- <li>
							<a href="<?php //echo base_url(); ?>loans-application">LOAN APPLICATION</a>
					</li>
					<li>
							<a href="<?php //echo base_url(); ?>claim-benefit">BENEFIT CLAIMS</a>
					</li>
					<li>
							<a href="<?php //echo base_url(); ?>official-receipt">COLLECTION</a>
					</li>
					<li>
							<a href="<?php //echo base_url(); ?>cash-gift">CASH GIFT</a>
					</li> -->
				</ul>
      </li>
      <li class="">
				<a href="#printDocxSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-print"></i> PRINT LOGS</a>
				<ul class="collapse list-unstyled" id="printDocxSubMenu">
          <li>
            <a href="<?php echo base_url(); ?>print-logs-gatepass">GATE PASS</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>print-logs-transmittal">TRANSMITTAL</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>print-logs-checklist">CHECKLIST</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>print-logs-qrcodes">QR CODE</a>
          </li>
				</ul>
      </li>
      <li class="">
				<a href="#reqSubMenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-tasks"></i> REQUEST</a>
				<ul class="collapse list-unstyled" id="reqSubMenu">
          <li>
            <a href="<?php echo base_url(); ?>dispatch-request">DISPATCH REQUEST</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>repair-request">REPAIR REQUEST</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>reimbursement-request">REIMBURSEMENT REQUEST</a>
          </li>
				</ul>
      </li>
      <?php else: ?>
        <?php if($logged_in->level == 3): ?>
          <li>
            <a href="<?php echo base_url(); ?>portal-dispatch-request"><i class="fas fa-edit"></i> Dispatch Request</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>portal-repair-request"><i class="fas fa-edit"></i> Repair Request</a>
          </li>
          <li>
            <a href="<?php echo base_url(); ?>portal-reimburse-request"><i class="fas fa-edit"></i> Reimbursement Request</a>
          </li>
        <?php elseif($logged_in->level == 2): ?>
          <li>
            <a href="<?php echo base_url(); ?>portal-repair-request-tech"><i class="fas fa-edit"></i> Repair Request</a>
          </li>
        <?php endif; ?>  
        <li>
          <a href="<?php echo base_url(); ?>change-admin-password"><i class="fas fa-key"></i> Change Password</a>
        </li>
      <?php endif; ?>
      <li><a class="nav-link" href="<?php echo base_url() . $go_logout; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>

</nav>

        <!-- Page Content  -->
<div id="content">
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-default mr-3">
            <i class="fas fa-align-left"></i>
            <!-- <span>Toggle Sidebar</span> -->
        </button>
        <!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto " type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button> -->
        <h4 class="mb-0 mt-2" id="badge-heading"><?php echo $heading; ?></h4>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                  <!-- <a class="nav-link" href="<?php //echo base_url('settings'); ?>"><i class="fas fa-cog"></i> Settings</a> -->
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="<?php echo base_url() . $go_logout; ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

