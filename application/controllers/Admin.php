<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$params['heading'] = 'CBAM-ERS DASHBOARD';
		$params['allAsset'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.is_deleted = 0")->row();
		$params['allAsset1'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.status_id = 2 AND a1.is_deleted = 0")->row();
		$params['allAsset2'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.status_id = 3 AND a1.is_deleted = 0")->row();
		$params['allAsset3'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.status_id = 4 AND a1.is_deleted = 0")->row();
		$this->adminContainer('admin/index', $params);
	}

	public function usr_login(){
		$this->load->view('admin/login');
	}
	
	public function forgot_password(){
		$this->load->view('admin/forgot-password');
	}
	
	public function entry_new_password(){
		$un     = $this->uri->segment(2);
		$dec_un = $this->encdec($un, 'd');
		$q 			= $this->db->get_where('users', array('username' => $dec_un))->row();
		if ($q) {
			if (strtotime("-30 minutes") > $q->fp_time) {
				$params['fp_expired'] = 'Request is expired';
				$this->load->view('admin/forgot-password', $params);
			} else {
				$params['username'] = $dec_un;
				$this->load->view('admin/entry-new-password', $params);
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function proceed_login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$errors = array();
		if ($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			$errors['msg'] = 'failed';
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$q 				= $this->db->get_where('users', array('username' => $username, 'is_deleted' => '0'));
			if (!empty($q->row())) {
				$database_password = $q->row()->password;
				$found = password_verify($password, $database_password) ? 'success' : 'failed';
				// store info in session
				$userdata = array(
					'username' => $username,
					'users_id' => $q->row()->users_id,
					'level'		 => $q->row()->level
				);
				$this->session->set_userdata($userdata);
			} else {
				$found = 'failed';
			}
			$errors['msg'] = $found;
			$errors['redirect'] = base_url();
			if ($this->session->userdata('redirects_url')) {
				// redirect($this->session->redirects_url);
				$errors['redirect'] = $this->session->redirects_url;
			}

		}
		echo json_encode($errors);
	}
	
	public function proceed_fg_pw(){
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$errors 				 = array();
		if ($this->form_validation->run() == FALSE) {
			$errors 			 = $this->form_validation->error_array();
			$errors['msg'] = 'failed';
		} else {
			$email  			 = $this->input->post('email');
			$q 		  			 = $this->db->get_where('users', array('email' => $email, 'is_deleted' => '0'));
			if (!empty($q->row())) {
				$data 			 = $q->row();
				$found 			 = 'success';
				$encUname 	 = $this->encdec($data->username, 'e');

				// $from     	= "manage_account@cpfi-webapp.com";
				$from    		 = "no-reply@cpfi-webapp.com";
				$to    	 		 = strtolower($data->email);
				$title    	 = "CBAM | Forgot Password";
				$subject  	 = "Forgot Password";
				$message     = "Dear ".strtoupper($data->screen_name).", <br><br> Your password has been reset. Please provide a new password by clicking on this link within the next 30 minutes: <a href=".base_url().'entry-new-password/'.$encUname.">Click here</a> <br><br> Thank you!";
				$this->sendEmail($from, $to, $subject, $message, $title);
				$this->db->update('users', array('fp_time' => time()), array('users_id' => $data->users_id));
			} else {
				$found 			 = 'failed';
			}
			$errors['msg'] = $found;
		}
		echo json_encode($errors);
	}
	
	public function submit_new_password(){
		$this->form_validation->set_rules('new-password', 'New Password', 'required');
		$this->form_validation->set_rules('re-new-password', 'Re-Enter New Password', 'required|matches[new-password]');
		$errors 				 = array();
		if ($this->form_validation->run() == FALSE) {
			$errors 			 = $this->form_validation->error_array();
			$errors['msg'] = 'failed';
		} else {
			$un     = $this->uri->segment(2);
			$username = $this->input->post('username');
			$hashed_pw 	 = password_hash($this->input->post('re-new-password'), PASSWORD_BCRYPT);
			$this->db->update('users', array('password' => $hashed_pw, 'txt_password' => $this->input->post('re-new-password')), array('username' => $username));
			$errors['msg'] = 'success';
		}
		echo json_encode($errors);
	}
	
	public function submit_admin_new_password(){
		$rules = array(
			[
				'field' => 'curr_password',
				'label' => 'Current Password',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|callback_valid_password'
			],
			[
				'field' => 'new_password',
				'label' => 'New Password',
				'rules' => 'required|matches[password]|callback_valid_password'
			],
		);
		$this->form_validation->set_rules($rules);
		// $this->form_validation->set_rules('new-password', 'New Password', 'required');
		// $this->form_validation->set_rules('re-new-password', 'Re-Enter New Password', 'required|matches[new-password]');
		$errors 				 = array();
		if ($this->form_validation->run() == FALSE) {
			$errors 			 = $this->form_validation->error_array();
			$errors['msg'] = 'failed';
		} else {
			$un     			 = $this->uri->segment(2);
			$curr_password 		 = $this->input->post('curr_password');
			$users = $this->db->get_where('users', array('txt_password'=>$curr_password))->row();
			if (!empty($users)) {
				$password 		 = $this->input->post('new_password');
				$hashed_pw 	 	 = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
				$this->db->update('users', array('password' => $hashed_pw, 'txt_password' => $this->input->post('new_password')), array('users_id' => $this->session->users_id));
				$errors['msg'] = 'success';
			} else {
				$errors['msg'] = 'failed';
			}
		}
		echo json_encode($errors);
	}

	public function valid_password($password = ''){
		$password = trim($password);

		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		if (empty($password)){
			$this->form_validation->set_message('valid_password', 'The {field} field is required.');
			return FALSE;
		}

		if (preg_match_all($regex_lowercase, $password) < 1){
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		}

		if (preg_match_all($regex_uppercase, $password) < 1){
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
			return FALSE;
		}

		if (preg_match_all($regex_number, $password) < 1){
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
			return FALSE;
		}

		if (preg_match_all($regex_special, $password) < 1){
			$this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
			return FALSE;
		}

		if (strlen($password) < 5){
			$this->form_validation->set_message('valid_password', 'The {field} field must be at least 5 characters in length.');
			return FALSE;
		}

		if (strlen($password) > 32){
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');
			return FALSE;
		}

		return TRUE;
	}
	
	public function changeAdminPassword(){
		$params['heading'] = "UPDATE PASSWORD";
		$params['tblMembers'] = $this->load->view('admin/crud/change-admin-password', $params, TRUE);
		$this->adminContainer('admin/asset-list', $params);	
	}

	public function destroy_sess(){
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

	public function loanApplication(){
		$params['heading'] 		 = 'LOAN APPLICATION';
		$params['loansPage'] = $this->load->view('admin/crud/loans-application-page', $params, TRUE);
		$this->adminContainer('admin/loans-application', $params);	
	}

	public function view_loan_app_page(){
		$params['heading'] = 'LOAN APPLICATION';
		$this->load->view('admin/crud/loans-application-page', $params);	
	}

	public function show_settings(){
		$params['heading'] 		 = 'SETTINGS';
		$params['settingPage'] = $this->load->view('admin/crud/setting-page', $params, TRUE);
		$this->adminContainer('admin/settings', $params);	
	}

	public function asset_list(){
		$params['heading'] = 'ASSETS LIST';
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-asset', $params, TRUE);
		$this->adminContainer('admin/asset-list', $params);	
	}
	
	public function asset_ready_to_deploy(){
		$params['heading'] = 'READY TO DEPLOY';
		$params['status'] = 2;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-asset-request', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function asset_dispatch(){
		$params['heading'] = 'DISPATCH';
		$params['status'] = 3;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-asset-request', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function asset_deployed(){
		$params['heading'] = 'DEPLOYED';
		$params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-asset-request', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}

	public function dispatch_request(){
		$params['heading'] = 'DISPATCH REQUEST';
		// $params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-request-dispatch', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function print_logs_transmittal(){
		$params['heading'] = 'PRINT LOGS TRANSMITTAL';
		// $params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-print-logs-transmittal', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}

	public function print_logs_gatepass(){
		$params['heading'] = 'PRINT LOGS GATE PASS';
		// $params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-print-logs-gatepass', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}

	public function print_logs_checklist(){
		$params['heading'] = 'PRINT LOGS CHECKLIST';
		// $params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-print-logs-checklist', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}

	public function print_logs_qrcodes(){
		$params['heading'] = 'PRINT LOGS QR CODES';
		// $params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-print-logs-qrcodes', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function repair_request(){
		$params['heading'] = 'REPAIR REQUEST';
		// $params['status'] = 0;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-request-repair', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function reimbursement_request(){
		$params['heading'] = 'REIMBURSEMENT REQUEST';
		// $params['status'] = 4;
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-request-reimbursement', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function portal_dispatch_request(){
		$params['heading'] = 'DISPATCH REQUEST';
		$params['offices'] = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['location'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['asset'] = $this->db->get_where('tbl_asset', array('is_deleted' => 0))->result();
		$params['asset_category'] = $this->db->get_where('asset_category', array('is_deleted' => 0))->result();
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-portal-dispatch-request', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}

	public function portal_repair_request(){
		$params['heading'] = 'REPAIR REQUEST';
		$params['offices'] = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['location'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['asset'] = $this->db->get_where('tbl_asset', array('is_deleted' => 0))->result();
		$params['asset_category'] = $this->db->get_where('asset_category', array('is_deleted' => 0))->result();
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-portal-repair-request', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}
	
	public function portal_repair_request_tech(){
		$params['heading'] = 'REPAIR REQUEST';
		$params['offices'] = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['location'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['asset'] = $this->db->get_where('tbl_asset', array('is_deleted' => 0))->result();
		$params['asset_category'] = $this->db->get_where('asset_category', array('is_deleted' => 0))->result();
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-portal-repair-request-tech', $params, TRUE);
		$this->adminContainer('admin/asset-request', $params);	
	}

	public function loanByMember(){
		$params['heading'] 		 			= 'LOAN BY MEMBER';
		$params['membersData'] 			= $this->db->get('v_members')->row();
		$params['loanSettings'] 		= $this->db->get('v_loan_settings')->result();
		$params['loanByMemberPage']	= $this->load->view('admin/crud/v-loans-by-member', $params, TRUE);
		$this->adminContainer('admin/loan-by-member', $params);	
	}

	public function view_settings_page(){
		$params['heading'] = 'SETTINGS';
		$this->load->view('admin/crud/setting-page', $params);	
	}

	public function tbl_asset(){
		$this->load->view('admin/crud/tbl-asset');
	}

	public function view_asset(){
		$asset_id 	  	 	 				= $this->input->get('data');
		$params['data'] 	 				= $this->AdminMod->getAssetRecord($asset_id); 
		$params['uploads'] 				= $this->db->get_where('tbl_uploads', array('asset_id' => $asset_id))->row();
		$url 							 				= $this->db->get_where('tbl_qrcodes', array('asset_id' => $asset_id))->row();
		$jsonQrData 			 				= json_decode($url->qr_code);
		$params['qrcode']  				= $jsonQrData->result->qr;
		$this->load->view('admin/crud/view-asset', $params);
	}
	
	public function view_asset_asset_details(){
		$asset_id 	  	 	 				= $this->input->get('data');
		$params['curr_badge']	  	 	 				= $this->input->get('curr_badge');
		$params['data'] 	 				= $this->AdminMod->getAssetRecordChild($asset_id); 
		$params['uploads'] 				= $this->db->get_where('tbl_uploads', array('child_asset_id' => $asset_id))->row();
		$url 							 				= $this->db->get_where('tbl_qrcodes', array('child_asset_id' => $asset_id))->row();
		if (!empty($url)) {
			$jsonQrData 			 				= json_decode($url->qr_code);
			$params['qrcode']  				= $jsonQrData->result->qr;
		} else {
			$params['qrcode']  				= '';
		}
		$this->load->view('admin/crud/view-asset-detailed-child', $params);
	}
	
	public function view_child_asset(){
		$asset_id 	  	 	 	= $this->input->get('data');
		$params['data'] 	 	= $this->AdminMod->getAssetRecord($asset_id); 
		$params['uploads'] 	= $this->db->get_where('tbl_uploads', array('asset_id' => $asset_id))->row();
		$url 							 	= $this->db->get_where('tbl_qrcodes', array('asset_id' => $asset_id))->row();
		$jsonQrData 			 	= json_decode($url->qr_code);
		$params['qrcode']  	= $jsonQrData->result->qr;
		$params['asset_id'] = $asset_id;
		$this->load->view('admin/crud/view-child-asset', $params);
	}
	
	public function view_asset_mobile(){
		$asset_id 	  	 	  = $this->input->get('data');
		$params['data'] 	  = $this->AdminMod->getAssetRecord($asset_id); 
		$params['uploads']  = $this->db->get_where('tbl_uploads', array('asset_id' => $asset_id))->row();
		$url 							  = $this->db->get_where('tbl_qrcodes', array('asset_id' => $asset_id))->row();
		$jsonQrData 			  = json_decode($url->qr_code);
		$params['qrcode']   = $jsonQrData->result->qr;
		// $this->load->view('admin/crud/view-asset', $params);
		$params['heading']  = "ASSET VIEW"; 
		$params['is_admin'] = $this->session->users_id; 
		$this->adminContainer('admin/crud/view-asset', $params);
	}
	
	public function view_checklist_mobile(){
		$location_id 	  	 	  = $this->input->get('data');
		// $params['data'] 	  = $this->AdminMod->getAssetRecord($location_id); 
		$params['data']      = $this->db->get_where('tbl_asset_checklist', array('location_id' => $location_id))->row();
		$params['countAssetChecklist']      = $this->db->get_where('tbl_asset_checklist', array('location_id' => $location_id))->result();
		$url 							  = $this->db->get_where('tbl_qrcodes_checklist', array('location_id' => $location_id))->row();
		$jsonQrData 			  = json_decode($url->qr_code);
		$params['qrcode']   = $jsonQrData->result->qr;
		// $this->load->view('admin/crud/view-asset', $params);
		$params['heading']  = "CHECKLIST DETAILS"; 
		$params['is_admin'] = $this->session->users_id; 
		$params['id'] = $location_id; 
		$params['qrCodesData'] = $url; 
		$params['received_by'] 	= $url->date_received;
		$this->customContainer('admin/crud/checklist-view-info', $params);
	}
	
	public function view_checklist_mobile_catch(){
		$location_id 	  	 	  = $this->input->get('data');
		// $params['data'] 	  = $this->AdminMod->getAssetRecord($location_id); 
		$params['data']      = $this->db->get_where('tbl_asset_checklist', array('location_id' => $location_id))->row();
		$url 							  = $this->db->get_where('tbl_qrcodes_checklist', array('location_id' => $location_id))->row();
		$jsonQrData 			  = json_decode($url->qr_code);
		$params['qrcode']   = $jsonQrData->result->qr;
		// $this->load->view('admin/crud/view-asset', $params);
		$params['heading']  = "CHECKLIST DETAILS"; 
		$params['is_admin'] = $this->session->users_id; 
		$params['id'] = $location_id; 
		$params['qrCodesData'] = $url; 
		$params['received_by'] 					 = $this->db->get_where('users', array('users_id' => $url->received_by))->row();
		$this->customContainer('admin/crud/checklist-view-info-catch', $params);
	}
	
	public function viewRepairApprovalPending(){
		$id = $this->input->get('id');
		$params['dataRequest'] = $this->db->get_where('v_repair_request', array( 'id' => $id, 'is_deleted' => 0 ))->row();
		$params['techSup'] = $this->db->get_where('users', array('level' => 2, 'is_deleted' => 0))->result();
		if ($params['dataRequest']) {
			$dataChildAsset = explode(',', $params['dataRequest']->tbl_child_asset_id);
			$params['childAsset'] = $this->db->query("SELECT tac.*, om.office_name FROM tbl_child_asset tac
																							LEFT JOIN office_management om on om.office_management_id = tac.office_management_id 
																							WHERE tac.id IN (".implode(',', $dataChildAsset).")")->result();
		}
		$this->customContainer('admin/crud/view-repair-asset-request', $params);
	}
	
	public function viewDispatchRequestPending(){
		$id = $this->input->get('id');
		$params['dataRequest'] = $this->db->get_where('v_portal_request', array('tbl_asset_request_id' => $id, 'is_deleted' => 0 ))->row();
		$params['techSup'] = $this->db->get_where('users', array('level' => 2, 'is_deleted' => 0))->result();
		if ($params['dataRequest']) {
			// $dataChildAsset = explode(',', $params['dataRequest']->tbl_child_asset_id);
			// $params['childAsset'] = $this->db->query("SELECT tac.*, om.office_name FROM tbl_child_asset tac
			// 																				LEFT JOIN office_management om on om.office_management_id = tac.office_management_id 
			// 																				WHERE tac.id IN (".implode(',', $dataChildAsset).")")->result();
		}
		$this->customContainer('admin/crud/view-dispatch-asset-request', $params);
	}

	public function submitApprovalRepairRequest(){
		if ($this->input->post('is_approved') == 'ap') {
			$data = array(
				'status' => 1, 
				'tech_support_id' => $this->input->post('tech_support_id'),
				'approved_by' => $this->session->users_id,
				'approved_date' => date('Y-m-d h:i:s')
			);
			if ($this->input->post('repair_date')) {
				$data['repair_date'] = date('Y-m-d', strtotime($this->input->post('repair_date')));
			}
			$q = $this->db->update('tbl_asset_repair_request', $data, array('id'=>$this->input->post('id')));
		} else {
			$data = array(
				'status' => 2, 
				'remarks' => $this->input->post('remarks'), 
				'tech_support_id' => $this->input->post('tech_support_id'),
				'disapproved_by' => $this->session->users_id,
				'disapproved_date' => date('Y-m-d h:i:s')
			);
			if ($this->input->post('repair_date')) {
				$data['repair_date'] = date('Y-m-d', strtotime($this->input->post('repair_date')));
			}
			$q = $this->db->update('tbl_asset_repair_request', $data, array('id'=>$this->input->post('id')));
		}
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Submitted!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered Saved';
			$res['param3'] = 'warning';
		}
		echo json_encode(array('msg'=>$res,'repair_request_id'=>$this->input->post('id')));
		// $q = $this->db->insert('tbl_asset_request', $dataToSave);
	}
	
	public function submitCloseRepairRequest(){
		$data = array(
			'status'      => 4, 
			'closed_by'   => $this->session->users_id,
			'closed_date' => date('Y-m-d h:i:s')
		);
		$q = $this->db->update('tbl_asset_repair_request', $data, array('id'=>$this->input->post('id')));
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Submitted!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered Saved';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
		// $q = $this->db->insert('tbl_asset_request', $dataToSave);
	}

	public function getRepairParentChildAsset(){
		$id = $this->input->get('id');
		$params['dataRequest'] = $this->db->get_where('v_repair_request', array( 'id' => $id, 'is_deleted' => 0))->row();
		$dataChildAsset = explode(',', $params['dataRequest']->tbl_child_asset_id);
		$params['childAsset'] = $this->db->query("SELECT tac.*, om.office_name FROM tbl_child_asset tac
																							LEFT JOIN office_management om on om.office_management_id = tac.office_management_id 
																							WHERE tac.id IN (".implode(',', $dataChildAsset).")")->result();
		$this->load->view('admin/crud/view-parent-child-repair-asset', $params);
	}

	public function view_history(){
		$asset_id 	  	 	 = $this->input->get('data');
		$params['heading']  = "HISTORY VIEW"; 
		$this->adminContainer('admin/crud/view-history', $params);
	}

	public function server_tbl_asset(){
		$result 	= $this->AdminMod->get_output_asset();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = '<input type="checkbox" class="chk-const-list-tbl" id="chk-const-list-tbl" value="'.$row->id.'" name="chk-const-list-tbl">';
   		$data[] = $row->asset_name; //
   		$data[] = $row->asset_tag; //
			$data[] = $row->property_tag; //
			$data[] = $row->serial; //
			$data[] = $row->screen_name; //custodian
			$data[] =	$row->office_name; //office\
			$data[] = $row->default_location;
			$data[] = $row->status;
   		$data[] = date('Y-m-d', strtotime($row->purchase_date));
			$data[] = $row->supplier;
			$data[] = number_format($row->purchase_cost, 2);
			$data[] = $row->warranty_months;
   		
			$data[] = '<a href="javascript:void(0);" 
										id="loadPage" 
										data-link="view-asset" 
										data-ind="'.$row->id.'" 
										data-badge-head="'.strtoupper($row->asset_name).'" 
										data-cls="cont-view-member" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="View Asset" 
										data-type="main_asset"
										data-id="'.$row->id.'"><i class="fas fa-search"></i></a> | 
								<a href="javascript:void(0);" 
										id="loadPage" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="Edit" 
										data-link="edit-asset" 
										data-ind="'.$row->id.'" 
										data-cls="cont-edit-member" 
										data-badge-head="EDIT '.strtoupper($row->asset_name).'"><i class="fas fa-edit"></i></a> | 
								<a href="javascript:void(0);" 
										id="remove-lgu-const-list" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="Remove" 
										data-id="'.$row->id.'"><i class="fas fa-trash"></i></a> | 
								<a href="javascript:void(0);" 
										id="loadPage" 
										data-link="view-child-asset" 
										data-ind="'.$row->id.'" 
										data-badge-head="'.strtoupper($row->asset_name).'" 
										data-cls="cont-view-member" 
										data-placement="top" 
										data-toggle="tooltip"
										title="View Child Asset" 
										data-id="'.$row->id.'"><i class="fas fa-project-diagram"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_asset(),
			'recordsFiltered' => $this->AdminMod->count_filter_asset(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_tbl_asset_child(){
		$result 	= $this->AdminMod->get_output_asset_child();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = '<input type="checkbox" class="chk-const-list-tbl" id="chk-const-list-tbl" value="'.$row->id.'" name="chk-const-list-tbl">';
   		$data[] = $row->asset_name;
   		$data[] = $row->asset_tag;
   		$data[] = $row->model;
			$data[] = $row->status;
			$data[] = $row->screen_name;
   		$data[] =	$row->company;
   		$data[] = date('Y-m-d', strtotime($row->purchase_date));
			$data[] = $row->supplier;
			$data[] = $row->order_number;
			$data[] = number_format($row->purchase_cost, 2);
			$data[] = $row->warranty_months;
			$data[] = $row->default_location;
			$data[] = '<a href="javascript:void(0);" 
										id="loadPage" 
										data-link="view-asset-child-details" 
										data-ind="'.$row->id.'" 
										data-badge-head="'.strtoupper($row->asset_name).'" 
										data-cls="cont-view-member" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="View Asset" 
										data-type="child_asset"
										class="child-asset-appendbadge"
										data-id="'.$row->id.'"><i class="fas fa-search"></i></a> | 
								<a href="javascript:void(0);" 
										id="loadPage" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="Edit" 
										data-link="edit-child-asset" 
										data-ind="'.$row->id.'" 
										data-cls="cont-edit-member" 
										data-badge-head="EDIT '.strtoupper($row->asset_name).'"><i class="fas fa-edit"></i></a> | 
								<a href="javascript:void(0);" 
										id="remove-child-asset" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="Remove" 
										data-id="'.$row->id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_asset(),
			'recordsFiltered' => $this->AdminMod->count_filter_asset(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_tbl_asset_request(){
		$result 	= $this->AdminMod->get_output_asset_request();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');

		foreach ($result as $row) {
			$data = array();
			$no++;
			$data[] = '<input type="checkbox" id="chk-const-list-tbl" value="'.$row->id.'" name="chk-const-list-tbl">';
			$data[] = $row->asset_name;
			$data[] = $row->asset_tag;
			$data[] = $row->model;
			$data[] = $row->status;
			$data[] = $row->screen_name;
			$data[] =	$row->company;
			$data[] = date('Y-m-d', strtotime($row->purchase_date));
			$data[] = $row->supplier;
			$data[] = $row->order_number;
			$data[] = number_format($row->purchase_cost, 2);
			$data[] = $row->warranty_months;
			$data[] = $row->default_location;
			
		 $data[] = '<a href="javascript:void(0);" 
									 id="loadPage" 
									 data-link="view-asset" 
									 data-ind="'.$row->id.'" 
									 data-badge-head="'.strtoupper($row->asset_name).'" 
									 data-cls="cont-view-member" 
									 data-placement="top" 
									 data-toggle="tooltip" 
									 title="View" 
									 data-id="'.$row->id.'"><i class="fas fa-search"></i></a> | 
							 <a href="javascript:void(0);" 
									 id="loadPage" 
									 data-placement="top" 
									 data-toggle="tooltip" 
									 title="Edit" 
									 data-link="edit-asset" 
									 data-ind="'.$row->id.'" 
									 data-cls="cont-edit-member" 
									 data-badge-head="EDIT '.strtoupper($row->asset_name).'"><i class="fas fa-edit"></i></a> | 
							 <a href="javascript:void(0);" 
									 id="remove-lgu-const-list" 
									 data-placement="top" 
									 data-toggle="tooltip" 
									 title="Remove" 
									 data-id="'.$row->id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_asset_request(),
			'recordsFiltered' => $this->AdminMod->count_filter_asset_request(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function server_tbl_admin_pending_repair_request(){
		$result 	= $this->AdminMod->get_output_admin_repair_request();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');
		$status = [0 => 'Pending', 1 => 'Approved', 2 => 'Disapproved', 3 =>'Cancelled', 4 => 'Closed'];
		foreach ($result as $row) {
			$data = array();
			$no++;
			if ($row->status==0) {
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->property_tag;
				$data[] = $status[$row->status];
				$data[] = '';
				$data[] = date('Y-m-d H:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url() . 'view-repair-approval-pending'.'?id='.$row->id.'" 
									 target="_blank" class="text-dark" data-toggle="tooltip" 
									 data-placement="top"><i class="fas fa-link"></i></a>';
			} elseif ($row->status==1) {
				$data[] = $row->id;
				$data[] = $row->asset_name;
				$data[] = $row->asset_category;
				$data[] = $row->property_tag;
				$data[] = $row->serial;
				$data[] = $row->approved_by;
				$data[] = $row->approved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->approved_date));
				$data[] = '<a href="'.base_url() . 'view-repair-approval-pending'.'?id='.$row->id.'" 
										target="_blank" class="text-dark" data-toggle="tooltip" 
										data-placement="top"><i class="fas fa-link"></i></a>';
			} elseif($row->status==2) {
				$data[] = $row->id;
				$data[] = $row->asset_name;
				$data[] = $row->asset_category;
				$data[] = $row->property_tag;
				$data[] = $row->serial;
				$data[] = $row->disapproved_by;
				$data[] = $row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '<a href="'.base_url() . 'view-repair-approval-pending'.'?id='.$row->id.'" 
									target="_blank" class="text-dark" data-toggle="tooltip" 
									data-placement="top"><i class="fas fa-link"></i></a>';
			} elseif($row->status==3){
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->property_tag;
				$data[] = $status[$row->status];
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
			} else {
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->property_tag;
				$data[] = $status[$row->status];
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
			}
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_admin_repair_request(),
			'recordsFiltered' => $this->AdminMod->count_filter_admin_repair_request(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_tbl_portal_request(){
		$result 	= $this->AdminMod->get_output_portal_request();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');
		$status = [0 => 'Pending', 1 => 'Approved', 2 => 'Disapproved', 3 =>'Cancelled', 4 => 'Closed'];
		foreach ($result as $row) {
			$data = array();
			$no++;
			if ($row->status==0) {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->category_name;
				$data[] = $row->qty;
				$data[] = $status[$row->status];
				$data[] = date('Y-m-d H:i:s', strtotime($row->entry_date));
				$data[] = '<button 
										type="button" 
										class="btn btn-xs font-12 btn-danger" id="cancel-portal-request" 
										data-id="'.$row->tbl_asset_request_id.'">Cancel</button>';
			} elseif ($row->status==1) {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->category_name;
				$data[] = $row->qty;
				$data[] = $status[$row->status];
				$data[] = $row->approved_by;
				$data[] = $row->approved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->approved_date));
				$data[] = '';
			} elseif($row->status==2) {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->category_name;
				$data[] = $row->qty;
				$data[] = $status[$row->status];
				$data[] = $row->disapproved_by;
				$data[] = $row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
			} elseif($row->status==3){
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->category_name;
				$data[] = $row->qty;
				$data[] = $status[$row->status];
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
			} else {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->category_name;
				$data[] = $row->qty;
				$data[] = $status[$row->status];
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_by;
				$data[] = '';//$row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
			}
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_portal_request(),
			'recordsFiltered' => $this->AdminMod->count_filter_portal_request(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function server_tbl_repair_request(){
		$result 	= $this->AdminMod->get_output_repair_request();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');
		$status = [0=> 'Pending', 1=> 'Approved', 2=> 'Disapproved', 3=> 'Cancelled', 4=> 'Closed'];
		foreach ($result as $row) {
			$data = array();
			$no++;
			if ($row->status==0) {
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->serial;
				$data[] = $status[$row->status];
				$data[] = date('Y-m-d H:i:s', strtotime($row->entry_date));
				$data[] = '<button 
										type="button" 
										class="btn btn-xs font-12 btn-danger" id="cancel-portal-request" 
										data-id="'.$row->id.'">Cancel</button>';
			} elseif ($row->status==1) {
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->serial;
				$data[] = $status[$row->status];
				$data[] = $row->approved_by;
				$data[] = $row->approved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->approved_date));
				if ($this->session->level == 	2) {
					$data[] = '<a href="'.base_url() . 'view-repair-approval-pending'.'?id='.$row->id.'" 
											target="_blank" class="text-dark" data-toggle="tooltip" 
											data-placement="top"><i class="fas fa-link"></i></a>';
				} else {
					$data[] = '';
				}
			} elseif($row->status==2) {
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->serial;
				$data[] = $status[$row->status];
				$data[] = $row->disapproved_by;
				$data[] = $row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
				$data[] = '';
			} elseif($row->status==3) {
				$data[] = $row->id;
				$data[] = $row->asset_category;
				$data[] = $row->serial;
				$data[] = $status[$row->status];
				$data[] = '';//cancelled by $row->disapproved_by;
				$data[] = '';//cancelled date $row->disapproved_by;
				$data[] = $row->disapproved_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->disapproved_date));
				$data[] = '';
			} else {
				$data[] = $row->id;
				$data[] = $row->asset_name;
				$data[] = $row->asset_tag;
				$data[] = $row->property_tag;
				$data[] = $row->serial;
				$data[] = $row->closed_by;
				$data[] = $row->closed_date == '' ? '' : date('Y-m-d H:i:s', strtotime($row->closed_date));
				if ($this->session->level == 	2) {
					$data[] = '<a href="'.base_url() . 'view-repair-approval-pending'.'?id='.$row->id.'" 
											target="_blank" class="text-dark" data-toggle="tooltip" 
											data-placement="top"><i class="fas fa-link"></i></a>';
				} else {
					$data[] = '';
				}
			}
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_repair_request(),
			'recordsFiltered' => $this->AdminMod->count_filter_repair_request(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function cancelPortalRequest(){
	 	$tbl = $this->input->post('tbl');
	 	$field = $this->input->post('field');
		$id = $this->input->post('id');
		return $this->db->update($tbl, array('status'=>3), array($field=>$id)); 
	}

	public function add_asset(){
		$params['asset_id']  			 = $this->input->get('data');
		$params['companies'] 			 = $this->db->get_where('tbl_companies', array('is_deleted' => 0))->result();
		$params['assetCategory'] 	 = $this->db->get_where('asset_category', array('is_deleted' => 0))->result();
		$params['models'] 	 			 = $this->db->get_where('tbl_models', array('is_deleted' => 0))->result();
		$params['status'] 	 			 = $this->db->get_where('tbl_status_labels', array('is_deleted' => 0))->result();
		$params['suppliers'] 			 = $this->db->get_where('tbl_suppliers', array('is_deleted' => 0))->result();
		$params['locations'] 			 = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['users']     			 = $this->db->get_where('users', array('is_deleted' => 0))->result();
		$params['office']    			 = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['departments']  	 = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$params['dataParentAsset'] = $this->db->query("SELECT * 
																										FROM tbl_asset ta
																										WHERE ta.id NOT IN (SELECT ta2.sibling FROM tbl_asset ta2 WHERE ta2.sibling IS NOT NULL AND ta2.is_deleted = 0) 
																										AND ta.is_deleted = 0")->result();
		$this->load->view('admin/crud/create-asset', $params);	
	}

	public function edit_asset(){
		$asset_id 			 		 		= $this->input->get('data');
		$params['dataAsset'] 		= $this->db->get_where('tbl_asset', array('id' => $asset_id))->row();
		$params['siblingName'] 	= function($id){ return $this->db->get_where('tbl_asset', array('id' => $id))->row(); };
		$params['companies'] 		= $this->db->get_where('tbl_companies', array('is_deleted' => 0))->result();
		$params['assetCategory'] 	 = $this->db->get_where('asset_category', array('is_deleted' => 0))->result();
		$params['models'] 	 		= $this->db->get_where('tbl_models', array('is_deleted' => 0))->result();
		$params['status'] 	 		= $this->db->get_where('tbl_status_labels', array('is_deleted' => 0))->result();
		$params['suppliers'] 		= $this->db->get_where('tbl_suppliers', array('is_deleted' => 0))->result();
		$params['locations'] 		= $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['uploads'] 	 		= $this->db->get_where('tbl_uploads', array('asset_id' => $asset_id))->row();
		$params['users']     		= $this->db->get_where('users', array('is_deleted' => 0))->result();
		$params['office']     	= $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['departments']  = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$params['dataParentAsset'] = $this->db->query("SELECT * 
																										FROM tbl_asset ta
																										WHERE ta.id NOT IN (SELECT ta2.sibling FROM tbl_asset ta2 WHERE ta2.sibling IS NOT NULL AND ta2.is_deleted = 0) 
																										AND ta.is_deleted = 0 
																										AND ta.id <> $asset_id")->result();
		$this->load->view('admin/crud/edit-asset', $params);
	}
	
	public function edit_child_asset(){
		$asset_id 			 		 		= $this->input->get('data');
		$params['dataAsset'] 		= $this->db->get_where('tbl_child_asset', array('id' => $asset_id))->row();
		$params['companies'] 		= $this->db->get_where('tbl_companies', array('is_deleted' => 0))->result();
		$params['models'] 	 		= $this->db->get_where('tbl_models', array('is_deleted' => 0))->result();
		$params['status'] 	 		= $this->db->get_where('tbl_status_labels', array('is_deleted' => 0))->result();
		$params['suppliers'] 		= $this->db->get_where('tbl_suppliers', array('is_deleted' => 0))->result();
		$params['locations'] 		= $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['uploads'] 	 		= $this->db->get_where('tbl_uploads', array('child_asset_id' => $asset_id))->row();
		$params['users']     		= $this->db->get_where('users', array('is_deleted' => 0))->result();
		$params['office']     	= $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['departments']  = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/crud/edit-child-asset', $params);
	}

	public function getParentCustodian(){
		$res = $this->db->get_where('tbl_asset', array('id'=>$this->input->post('asset_id')))->row();
		echo json_encode(
						array(
							'checkout_user_id'=>$res->checkout_user_id,
							'office_management_id'=>$res->office_management_id,
							'departments_id'=>$res->departments_id,
							'location_id'=>$res->location_id,
						)
					);
	}

	public function save_asset(){
		// $this->form_validation->set_rules('company_id', 'Company', 'required');
		$this->form_validation->set_rules('asset_category_id', 'Asset Category', 'required');
		if ($this->input->post('asset_tag') != $this->input->post('original_asset_tag')) {
			if (!empty($_POST['tbl_asset_id'])) {
				$this->form_validation->set_rules('asset_tag', 'Asset Tag', 'required|is_unique[tbl_child_asset.asset_tag]');
			} else {
				$this->form_validation->set_rules('asset_tag', 'Asset Tag', 'required|is_unique[tbl_asset.asset_tag]');
			}
		}
		$this->form_validation->set_message('is_unique', '%s is taken.');
		if ($this->input->post('model_id')) {
			$this->form_validation->set_rules('model_id', 'Model', 'required');
		}
		//$this->form_validation->set_rules('status_id', 'Status', 'required');
		//$this->form_validation->set_rules('serial', 'Serial', 'required');
		//$this->form_validation->set_rules('name', 'Asset Name', 'required');
		//$this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
		//$this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
		//$this->form_validation->set_rules('order_number', 'Order Number', 'required');
		//$this->form_validation->set_rules('purchase_cost', 'Purchase Cost', 'required');
		//$this->form_validation->set_rules('warranty_months', 'Warranty', 'required');

		// if (array_key_exists('pwd_id', $_POST)) {
		// 	$this->form_validation->set_rules('pwd_id', 'PWD ID', 'trim|required');
		// }
		
		$errors 		 = array();
		$isForUpdate = false;
		$updateID 	 = '';
		if ($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
		} else {
			//save entry
			$dataField 						 = array();
			foreach ($this->input->post() as $key => $value) {
				switch ($key) {
					case 'has_update':
						$isForUpdate = true;
						$updateID    = $value;
						break;
					case 'requestable':
						$dataField['requestable'] = str_replace(',', '', $value);
						break;
					case 'original_asset_tag':
							// ignoring name
							break;
					case 'tbl_asset_id':
							// ignoring name
							break;
					case 'gen_qr_code':
							// ignoring name
							break;
					case 'siblings':
							// ignoring name
							break;
					default:
						$dataField['requestable'] = 0;
						$dataField[$key] 			 = str_replace(',', '', $value);
						break;
				}
			}
			$dataField['user_id'] 				 = $this->session->users_id;
			/**
				Save members table
			*/
			if ($isForUpdate) {
				$dataField['updated_at'] = date('Y-m-d');
				
				if (!empty($_POST['tbl_asset_id'])) {
					$prev_history = $this->db->query("SELECT th.id, th.created_at, th.current_custodian_id, th.current_location_id 
																					FROM tbl_history th 
																					WHERE th.asset_child_id = " . $_POST['tbl_asset_id'] . " ORDER BY th.id desc LIMIT 1")->row();
					// $dataField['tbl_asset_id'] = $this->input->post('tbl_asset_id');
					$this->db->update('tbl_child_asset', $dataField, array('id'=>$updateID));
				} else {
					$prev_history = $this->db->query("SELECT th.id, th.created_at, th.current_custodian_id, th.current_location_id 
																					FROM tbl_history th 
																					WHERE th.asset_id = " . $updateID . " ORDER BY th.id desc LIMIT 1")->row();
					$this->db->update('tbl_asset', $dataField, array('id'=>$updateID));
				}
				
				$errors['id'] = $updateID;
				$this->upload_const_dp($updateID);
				//save history logs
				$this->save_history_logs(array(
					'asset_id' 							=> !empty($_POST['tbl_asset_id']) ? null : $updateID,
					'current_custodian_id' 	=> $this->input->post('checkout_user_id'),
					'current_location_id' 	=> $this->input->post('location_id'),
					'previous_custodian_id' => $prev_history->current_custodian_id,
					'previous_location_id' 	=> $prev_history->current_location_id,
					'description' 					=> 'update',
					'user_id' 							=> $this->session->users_id,
					'created_at' 						=> $prev_history->created_at,
					'updated_at' 						=> date('Y-m-d H:i:s'),
					'asset_child_id'				=> !empty($_POST['tbl_asset_id']) ? $_POST['tbl_asset_id'] : null
				));
			} else {
				$dataField['created_at'] = date('Y-m-d');
				if (!empty($_POST['tbl_asset_id'])) {
					$dataField['tbl_asset_id'] = $this->input->post('tbl_asset_id');
					$this->db->insert('tbl_child_asset', $dataField);
					$errors['id'] = $this->db->insert_id();
					$this->upload_const_dp($errors['id']);
					if ($this->input->post('gen_qr_code')) {
						$this->generateQR($errors['id']);
					}
				} else {
				    
				    
				    //fast track muna
				    
				    
				//   $asset_array = array();


    //                 for($x=0;$x<count($asset_array);$x++){
                    
    //                 $dataField = "";
                    
    //                 $asset_tag_values = $asset_array[$x];

    //                 $dataField = array('asset_tag'=>$asset_tag_values,'status_id'=>1, 'location_id'=>6);


				// 	$this->db->insert('tbl_asset', $dataField);
				// 	$errors['id'] = $this->db->insert_id();
				// 	$this->upload_const_dp($errors['id']);
				// 	$this->generateQR($errors['id']);

				// 	}
				    
					$this->db->insert('tbl_asset', $dataField);
					$errors['id'] = $this->db->insert_id();
					$this->upload_const_dp($errors['id']);
					$this->generateQR($errors['id']);
				}
				
				//save history logs
				$this->save_history_logs(array(
					'asset_id' 						 => !empty($_POST['tbl_asset_id']) ? null : $errors['id'],
					'current_custodian_id' => $this->input->post('checkout_user_id'),
					'current_location_id'  => $this->input->post('location_id'),
					'description' 				 => 'create',
					'user_id' 						 => $this->session->users_id,
					'created_at' 					 => date('Y-m-d H:i:s'),
					'asset_child_id'			 => !empty($_POST['tbl_asset_id']) ? $_POST['tbl_asset_id'] : null
				));
			}
		}

		//update sibling parent
		
		$this->db->update('tbl_asset', array('sibling'=>$errors['id']), array('id'=>$this->input->post('siblings')));

		echo json_encode($errors);

	}

	public function save_portal_request(){
		$dataToSave = [];
		foreach ($this->input->post() as $key => $value) {
			if ($key == 'date_need' || $key == 'date_return') {
				$dataToSave[$key] = date('Y-m-d H:i:s', strtotime($value));	
			} else {
				$dataToSave[$key] = $value;
			}
		}
		$dataToSave['entry_date'] = date('Y-m-d H:i:s');
		$q = $this->db->insert('tbl_asset_request', $dataToSave);
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Submitted!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered Saved';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
	}

	

	public function saveRepairRequest(){

		$uploadedImage = $this->upload_image('image_upload');
		$uploadedFile = $this->upload_file('file_upload');

		$dataToSave = array(
			'asset_category_id'  => $this->input->post('asset_category_id'),
			'asset_tag' 			   => $this->input->post('asset_tag'),
			'date_reported' 		 => date('Y-m-d H:i:s', strtotime($this->input->post('date_reported'))),
			'problem_desc' 			 => $this->input->post('problem_desc'), 
			'property_tag' 			 => $this->input->post('property_tag'),
			'remarks'            => $this->input->post('remarks'),
			'requestor' 				 => $this->input->post('requestor'), 
			'serial' 						 => $this->input->post('serial'),
			'tbl_child_asset_id' => implode(",", array_map(function($v){ return $v; }, $this->input->post('tbl_child_asset_id'))),
			'entry_date'				 => date('Y-m-d H:i:s'),
			'file_upload' 			 => $this->input->post('file_upload') ? $uploadedFile['file_name'] : '',
			'image_upload'			 => $this->input->post('image_upload') ? $uploadedImage['file_name'] : ''
		);
		// echo json_encode(array('post'=>$_POST,'upload1'=>$res1,'upload2'=>$res2));
		// foreach ($this->input->post() as $key => $value) {
		// 	if ($key == 'date_need' || $key == 'date_return') {
		// 		$dataToSave[$key] = date('Y-m-d H:i:s', strtotime($value));	
		// 	} else {
		// 		$dataToSave[$key] = $value;
		// 	}
		// }
		// $dataToSave['entry_date'] = date('Y-m-d H:i:s');
		$q = $this->db->insert('tbl_asset_repair_request', $dataToSave);
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Submitted!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered Saved';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
	}

	public function getAssetPrintFrm(){
		$params['locations'] = $this->db->get_where('tbl_locations', array('is_deleted'=>0))->result();
		$params['custodian'] = $this->db->get_where('users', array('is_deleted'=>0, 'level <>'=>'0'))->result();
		$params['checkList'] = $this->db->get_where('tbl_asset_checklist')->result();
		$this->load->view('admin/crud/print-asset-frm', $params);
	}
	
	public function getCheckListPrintFrm(){
		$params['locations'] = $this->db->get_where('tbl_locations', array('is_deleted'=>0))->result();
		$params['custodian'] = $this->db->get_where('users', array('is_deleted'=>0, 'level <>'=>'0'))->result();
		$params['checkList'] = $this->db->get_where('tbl_asset_checklist')->result();
		$this->load->view('admin/crud/print-checklist-frm', $params);
	}
	
	public function getTransmittalSummaryPrintFrm(){
		$params['locations'] = $this->db->get_where('tbl_locations', array('is_deleted'=>0))->result();
		$params['custodian'] = $this->db->get_where('users', array('is_deleted'=>0, 'level <>'=>'0'))->result();
		$params['checkList'] = $this->db->get_where('tbl_asset_checklist')->result();
		$this->load->view('admin/crud/print-transmital-summary-frm', $params);
	}

	public function getPrintAssetReport(){
		$where = 'WHERE is_deleted = 0';
		if($this->input->post('location_id') != ''){
			$where .= ' AND location_id = ' . $this->input->post('location_id');
		}
		if ($this->input->post('custodian') != '') {
			$where .= ' AND users_id = ' . $this->input->post('custodian');
		}
		if ($this->input->post('asset_type') == 1){
			$where .= ' AND parent IS NOT NULL';
		}
		echo json_encode(array('data'=> $this->encdec($where, 'e')));
	}
	
	public function getPrintChecklistReport(){
		$where = 'is_deleted = 0';
		if($this->input->post('location_id') != ''){
			$where .= ' AND location_id = ' . $this->input->post('location_id');
		}
		if($this->input->post('status') == 1){
			$where .= ' AND status = 1';
		} else {
			$where .= ' AND status = 0';
		}
		echo json_encode(array('data'=> $this->encdec($where, 'e')));
	}
	
	public function getPrintTransmitalSummReport(){
		$where = 'is_deleted = 0';
		if($this->input->post('location_id') != ''){
			$where .= ' AND location_id = ' . $this->input->post('location_id');
		}
		if($this->input->post('status') == 1){
			$where .= ' AND status = 1';
		} else {
			$where .= ' AND status = 0';
		}
		$this->generateQRChecklist($this->input->post('location_id'));
		echo json_encode(array('data'=> $this->encdec($where, 'e')));	
	}
	
	public function printAssetReport(){
		$where = $this->encdec($this->uri->segment(2), 'd');
		$res = $this->db->query("SELECT * FROM v_asset_report " . $where)->result();
		$params['data'] = $res;
		// $this->createPdf();
		// $this->output->enable_profiler(true);
		$html = $this->load->view('admin/crud/pdf-asset-report', $params, TRUE);
		$this->AdminMod->pdf($html, 'Asset List Report', false, 'LEGAL', false, false, false, 'ASSET LIST REPORT', '');
	}
	
	public function printTransmitalSlip(){
		$where = $this->encdec($this->uri->segment(2), 'd');
		$data_procces = $this->uri->segment(3);
		$res = $this->db->query("SELECT * FROM v_asset_report " . $where)->result();
		$motherCount = $this->db->query("SELECT count(*) as tot_mother FROM v_asset_report " . $where . ' AND parent is not null AND sibling is null')->row();
		$params['data'] = $res;
		$params['data_procces'] = $data_procces;
		$params['motherCount'] = $this->convertNumberWithourCurrency($motherCount->tot_mother);
		$this->createPdf('admin/crud/print-transmital-slip', $params);
		// $this->output->enable_profiler(true);
		// $html = $this->load->view('admin/crud/print-transmital-slip', $params, TRUE);
		// $this->AdminMod->pdfToTransmital($html, 'Transmital Slip', false, 'LEGAL', false, false, false, 'Transmital Slip', '');
	}
	
	public function printChecklist(){
		$where = $this->encdec($this->uri->segment(2), 'd');
		$data_procces = $this->uri->segment(3);
		// $res = $this->db->query("SELECT * FROM v_asset_report " . $where)->result();
		// $motherCount = $this->db->query("SELECT count(*) as tot_mother FROM v_asset_report " . $where . ' AND parent is not null AND sibling is null')->row();
		// $params['data'] = $res;
		$params['data_procces'] = $data_procces;
		$params['dataChkList'] = $this->db->get_where('tbl_asset_checklist', $where)->result();
		// $params['page_no'] = '123';//$this->convertNumberWithourCurrency($motherCount->tot_mother);//'{PAGENO} of {nbpg}';
		// $params['motherCount'] = $this->convertNumberWithourCurrency($motherCount->tot_mother);
		// $this->output->enable_profiler(true);
		$params['type'] = 'checklist';
		$this->createPdfWOHeadFoot('admin/crud/print-checklist', $params);
		// $html = $this->load->view('admin/crud/print-transmital-slip', $params, TRUE);
		// $this->AdminMod->pdfToTransmital($html, 'Transmital Slip', false, 'LEGAL', false, false, false, 'Transmital Slip', '');
	}
	
	public function printTransmitalSummary(){
		$where = $this->encdec($this->uri->segment(2), 'd');
		$locationsWhere = explode('AND', $where)[1];
		$location_id = explode(' = ', $locationsWhere)[1];
		$data_procces = $this->uri->segment(3);
		$params['data_procces'] = $data_procces;
		$params['dataChkList'] = $this->db->get_where('tbl_asset_checklist', $where)->result();
		$params['tbl_locations'] = $this->db->get_where('tbl_locations', array('id'=>$location_id))->row();
		
		//QR Code
		$url 							 				= $this->db->query("SELECT * FROM tbl_qrcodes_checklist WHERE location_id = $location_id ORDER BY id desc LIMIT 1")->row();
		$jsonQrData 			 				= json_decode($url->qr_code);
		$params['qrcode']  				= $jsonQrData->result->qr;
		$params['last_insert_id'] = $this->db->insert_id();
		$this->createPdfTransmitalSummary('admin/crud/print-transmital-summary', $params);
	}

	public function upload_const_dp($id){
		$config['upload_path'] 		= './assets/image/uploads';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']  			= 0; // any size
		$config['remove_spaces']	= true;
		// $id 											= $this->input->post('asset_id');
		$this->load->library('upload', $config);
		$this->load->library('image_lib');
		if (!$this->upload->do_upload('upload-file-dp')) {
			$data['error']	 = array('error' => $this->upload->display_errors());
			$data['success'] = false;
		} else {
			$dImg = $this->upload->data();

			//resize image to fit
			$configer =  array(
        'image_library'   => 'gd2',
        'source_image'    =>  $dImg['full_path'],
        'maintain_ratio'  =>  TRUE,
        'width'           =>  1200,
        'height'          =>  1200,
        'x_axis'          =>  '0',
        'y_axis'          =>  '0'
      );

      $configer['quality'] = "100%";
			$configer['width'] = 176;
			$configer['height'] = 234;
			$dim = (intval($dImg["image_width"]) / intval($dImg["image_height"])) - ($configer['width'] / $configer['height']);
			$configer['master_dim'] = ($dim > 0)? "height" : "width";

      $this->image_lib->clear();
      $this->image_lib->initialize($configer);
      $this->image_lib->resize();

			$chkExisting    = $this->db->get_where('tbl_uploads', array('asset_id' => $id))->result();
			if ($chkExisting) {
				$dataWhereId = [];
				if (!empty($_POST['tbl_asset_id'])) {
					$dataWhereId['child_asset_id'] = $id;
				} else {
					$dataWhereId['asset_id'] = $id;
				}
				$this->db->update('tbl_uploads', 
					array(
						'image_name' 			 => $dImg['file_name'],
						'image_path' 			 => $dImg['file_path'],
						'transaction_date' => date('Y-m-d')
					), $dataWhereId);
			} else {
				$dataSave = [];
				if (!empty($_POST['tbl_asset_id'])) {
					$dataSave['child_asset_id'] = $id;
				} else {
					$dataSave['asset_id'] = $id;
				}
				$dataSave['image_name'] = $dImg['file_name'];
				$dataSave['image_path'] = $dImg['file_path'];
				$dataSave['transaction_date'] = date('Y-m-d');
				$this->db->insert('tbl_uploads', $dataSave);	
			}
			$data['file_name'] = $dImg['file_name'];
			$data['success'] = true;
		}
		// echo json_encode($data);
	}

	public function deleteAsset(){
		$asset_id = $this->input->post('id');
		$this->db->update('tbl_asset', array('is_deleted' => '1'), array('id' => $asset_id));
		$this->db->update('tbl_child_asset', array('is_deleted' => '1'), array('tbl_asset_id' => $asset_id));
		$this->db->update('tbl_asset', array('sibling' => null), array('sibling' => $asset_id));
	}
	
	public function deleteChildAsset(){
		$asset_id = $this->input->post('id');
		$this->db->update('tbl_child_asset', array('is_deleted' => '1'), array('id' => $asset_id));
	}	
	
	public function getChkdAsset(){
		$arr_asset_id = $this->input->post('data');
		echo json_encode(array('data'=> $this->encdec(json_encode($arr_asset_id), 'e')));
	}
	
	public function getChkdChildAsset(){
		$arr_asset_id = $this->input->post('data');
		echo json_encode(array('data'=> $this->encdec(json_encode($arr_asset_id), 'e')));
	}

	public function updateData(){
		$tbl 				  = $this->input->post('tbl');
		$update_data = $this->input->post('update_data');
		$field_where 	= $this->input->post('field_where');
		$where_val 	  = $this->input->post('where_val');
		if ($field_where == 'group_code' && array_key_exists('is_deleted', $update_data)) {
			//delete all children
			$this->db->update('account_main', $update_data, array($field_where => $where_val));
		}
		$q = $this->db->update($tbl, $update_data, array($field_where => $where_val));
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Updated!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered Saved';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
	}

	public function printMembersDocx(){
		$params['members'] = $this->db->get_where('members', array('is_deleted' => 0))->result();
		$params['office_management'] = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$this->load->view('admin/crud/print-members-docs', $params);
	}

	public function get_data_assets(){
		// header("Access-Control-Allow-Origin: *");
		// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		// header("Content-type: application/json charset=UTF-8");
		// $request_body = file_get_contents('php://input');
		// $requestData 	= json_decode($request_body);
		$d = $this->uri->segment(2);
		$dec_un = $this->encdec($d, 'd');
		$res = $this->db->get_where('v_asset', array('id' => $dec_un))->result();
		$child = $this->db->get_where('v_asset_child', array('tbl_asset_id' => $dec_un))->result();
		if(!$this->session->userdata('users_id')){
			$userdata = array(
				'redirects_url'  => base_url() . "get-assets/" . $d,
			);
			$this->session->set_userdata($userdata);
		  redirect('login');
		}
		$logedUser = $this->db->get_where('users', array('users_id' => $this->session->users_id))->row();
		if ($logedUser->level == 0) {
			redirect(base_url() . 'mobile-view-asset?data=' . $dec_un);
		} else {
			$params['data']=$res;
			$params['child']=$child;
			$params['uploads']=$this->db->get_where('tbl_uploads', array('asset_id' => $dec_un))->row();
			$this->load->view('admin/asset-mobile-view', $params);
		}
	}
	
	public function get_data_checklist(){
		// header("Access-Control-Allow-Origin: *");
		// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		// header("Content-type: application/json charset=UTF-8");
		// $request_body = file_get_contents('php://input');
		// $requestData 	= json_decode($request_body);
		$d = $this->uri->segment(2);
		$dec_un = $this->encdec($d, 'd');
		$res = $this->db->get_where('tbl_locations', array('id' => $dec_un))->row();
		$existingQr   = $this->db->query("SELECT * FROM tbl_qrcodes_checklist WHERE location_id = $dec_un ORDER BY id DESC LIMIT 1")->row();
		if ($existingQr->received_by == '' || $existingQr->date_received == '') {
			redirect(base_url() . 'mobile-view-checklist-catch?data=' . $dec_un);
		} else {
			redirect(base_url() . 'mobile-view-checklist?data=' . $dec_un);
		}
		
	}
	
	public function get_data_assets_child(){
		// header("Access-Control-Allow-Origin: *");
		// header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
		// header("Content-type: application/json charset=UTF-8");
		// $request_body = file_get_contents('php://input');
		// $requestData 	= json_decode($request_body);
		$d = $this->uri->segment(2);
		$dec_un = $this->encdec($d, 'd');
		$res = $this->db->get_where('v_asset_child', array('id' => $dec_un))->result();
		$parentAsset = $this->db->get_where('v_asset', array('id' => $res[0]->tbl_asset_id))->row();

		if(!$this->session->userdata('users_id')){
			$userdata = array(
				'redirects_url'  => base_url() . "get-assets-child/" . $d,
			);
			$this->session->set_userdata($userdata);
		  redirect('login');
		}
		$logedUser = $this->db->get_where('users', array('users_id' => $this->session->users_id))->row();
		if ($logedUser->level == 0) {
			redirect(base_url() . 'mobile-view-asset?data=' . $dec_un);
		} else {
			$params['parentAsset']=$parentAsset;
			$params['data']=$res;
			$params['uploads']=$this->db->get_where('tbl_uploads', array('child_asset_id' => $dec_un))->row();
			$this->load->view('admin/asset-mobile-view', $params);
		}
	}

	public function printAssetQr(){
		$arr_asset_id = $this->uri->segment(2);
		$enc_ai = $this->encdec($arr_asset_id, 'd');
		$data = json_decode($enc_ai);
		$data = implode(',',$data);
		$params['data'] = $this->db->query("SELECT tq.*, ta.asset_tag, ta.location_id, u.screen_name
																				FROM tbl_qrcodes tq 
																				left join tbl_asset ta on ta.id = tq.asset_id 
																				left join users u on u.users_id = ta.user_id
																				WHERE ta.id in (".$data.") AND ta.is_deleted = 0")->result();
		$params['check_url'] = function($url){ return $this->check_url($url); };
		// $html = $this->load->view('admin/crud/print-asset-qr', $params, TRUE);
		// $this->AdminMod->pdf($html, 'QR Code List', false, 'LEGAL', false, false, false, 'QR CODE', '');
		$this->generatePdf('admin/crud/print-qrcode-per-page', $params);
	}
	
	public function printChildAssetQr(){
		$arr_asset_id = $this->uri->segment(2);
		$enc_ai = $this->encdec($arr_asset_id, 'd');
		$data = json_decode($enc_ai);
		$data = implode(',',$data);
		$params['data'] = $this->db->query("SELECT tq.*, ta.asset_tag FROM tbl_qrcodes tq left join tbl_child_asset ta on ta.id = tq.child_asset_id WHERE ta.id in (".$data.") AND ta.is_deleted = 0")->result();
		$html = $this->load->view('admin/crud/print-asset-qr', $params, TRUE);
		$this->AdminMod->pdf($html, 'QR Code List', false, 'LEGAL', false, false, false, 'QR CODE', '');
	}

	public function encryptKey(){
		$un     = $this->input->post('key');
		$enc_un = $this->encdec($un, 'e');
		echo json_encode(['key' => $enc_un]);
	}

	public function saveCreatedQr(){
		// Webhook
		// if JSON is submitted
		$json = json_decode(file_get_contents('php://input'));
		$qrData = $this->db->get_where('tbl_qrcodes', array('code' => $this->input->post('code')))->row();
		$address = $this->getaddress($this->input->post('lat'), $this->input->post('lng'));
		$this->db->insert('tbl_gps', array(
																	'asset_id' 		=> $qrData->child_asset_id != '' ? '' : $qrData->asset_id,
																	'event' 			=> $this->input->post('event'), 
																	'timestamp' 	=> $this->input->post('timestamp'), 
																	'redirects' 	=> $this->input->post('redirects'), 
																	'visitors' 		=> $this->input->post('visitors'), 
																	'device' 			=> $this->input->post('device'), 
																	'os' 					=> $this->input->post('os'), 
																	'country' 		=> $this->input->post('country'), 
																	'lng' 				=> $this->input->post('lng'), 
																	'lat' 				=> $this->input->post('lat'), 
																	'user' 				=> $this->input->post('user'), 
																	'email' 			=> $this->input->post('email'), 
																	'mobile' 			=> $this->input->post('mobile'), 
																	'type' 				=> $this->input->post('type'), 
																	'code' 				=> $this->input->post('code'), 
																	'secrettoken' => $this->input->post('secrettoken'),
																	'address' 	  => $address->results[0]->formatted_address, //$address->result->formatted_address
																	'child_asset_id' => $qrData->child_asset_id != '' ? $qrData->child_asset_id : '',
																));
		if ($qrData->child_asset_id != '') {
			$asset_data = $this->db->query("SELECT * FROM tbl_child_asset ta left join tbl_locations tl on ta.location_id = tl.id WHERE ta.id = ".$qrData->child_asset_id)->row();																
			$distance_diff = $this->getDistanceBetweenPoints($_POST['lat'], $_POST['lng'], $asset_data->lat, $asset_data->lng);
		} else {
			$asset_data = $this->db->query("SELECT * FROM tbl_asset ta left join tbl_locations tl on ta.location_id = tl.id WHERE ta.id = ".$qrData->asset_id)->row();																
			$distance_diff = $this->getDistanceBetweenPoints($_POST['lat'], $_POST['lng'], $asset_data->lat, $asset_data->lng);
		}
		//if distance from near location is less than 100 meters
		if ($distance_diff['meters'] <= 100) {	
			$this->db->update('tbl_asset', array('status_id' => 4), array('id' => $qrData->asset_id));
			$this->save_action_logs(array(
				'user_id' 			=> $this->session->users_id,
				'action_type' 	=> 'scanned asset to deploy',
				'target_id' 		=> $qrData->child_asset_id != '' ? 0 : $qrData->asset_id,
				'target_type' 	=> 'asset',
				// 'item_type' 	=>  'Asset',
				// 'item_id' 		=>  $updateID,
				'created_at' 		=> date('Y-m-d H:i:s'),
				'target_child_id' => $qrData->child_asset_id != '' ? $qrData->child_asset_id : null
			));
		} else {
			$this->db->update('tbl_asset', array('status_id' => 3), array('id' => $qrData->asset_id));
			$this->save_action_logs(array(
				'user_id' 			=> $this->session->users_id,
				'action_type' 	=> 'scanned asset to dispatch',
				'target_id' 		=> $qrData->child_asset_id != '' ? 0 : $qrData->asset_id,
				'target_type' 	=> 'asset',
				// 'item_type' 	=>  'Asset',
				// 'item_id' 		=>  $updateID,
				'created_at' 		=> date('Y-m-d H:i:s'),
				'target_child_id' => $qrData->child_asset_id != '' ? $qrData->child_asset_id : null
			));
		}

	}
	
	public function saveCreatedQrChecklist(){
		// Webhook
		// if JSON is submitted
		$json = json_decode(file_get_contents('php://input'));
		$qrData = $this->db->get_where('tbl_qrcodes_checklist', array('code' => $this->input->post('code')))->row();
		$dataChecklist = $this->db->get_where('tbl_asset_checklist', array('location_id' => $qrData->location_id))->row();
		$lat = explode(' ', $dataChecklist->lat_lon)[0];
		$long = explode(' ', $dataChecklist->lat_lon)[1];
		$address = $this->getaddress($this->input->post('lat'), $this->input->post('lng'));
		$this->db->insert('tbl_gps_checklist', array(
																	'location_id' => $qrData->location_id,
																	'event' 			=> $this->input->post('event'), 
																	'timestamp' 	=> $this->input->post('timestamp'), 
																	'redirects' 	=> $this->input->post('redirects'), 
																	'visitors' 		=> $this->input->post('visitors'), 
																	'device' 			=> $this->input->post('device'), 
																	'os' 					=> $this->input->post('os'), 
																	'country' 		=> $this->input->post('country'), 
																	'lng' 				=> $this->input->post('lng'), 
																	'lat' 				=> $this->input->post('lat'), 
																	'user' 				=> $this->input->post('user'), 
																	'email' 			=> $this->input->post('email'), 
																	'mobile' 			=> $this->input->post('mobile'), 
																	'type' 				=> $this->input->post('type'), 
																	'code' 				=> $this->input->post('code'), 
																	'secrettoken' => $this->input->post('secrettoken'),
																	'address' 	  => $address->results[0]->formatted_address . ' asd ' . $_POST['lat'] . ' - ' . $_POST['lng'] . ' - ' . $lat . ' - ' . $long //$address->result->formatted_address
																));
		$distance_diff = $this->getDistanceBetweenPoints($_POST['lat'], $_POST['lng'], $lat, $long);
		//if distance from near location is less than 100 meters
		// if ($distance_diff['meters'] <= 250) {	
			$location_id = $this->db->get_where('tbl_locations', array('id' => $qrData->location_id))->row();
			$this->db->update('tbl_qrcodes_checklist', array(
					'date_received' => date('Y-m-d H:i:s', strtotime($this->input->post('timestamp'))),
					'received_by' => $location_id->id
				), array('code' => $this->input->post('code')));
			// $this->save_action_logs(array(
			// 	'user_id' 			=> $this->session->users_id,
			// 	'action_type' 	=> 'scanned asset to deploy',
			// 	'target_id' 		=> $qrData->child_asset_id != '' ? 0 : $qrData->asset_id,
			// 	'target_type' 	=> 'asset',
			// 	// 'item_type' 	=>  'Asset',
			// 	// 'item_id' 		=>  $updateID,
			// 	'created_at' 		=> date('Y-m-d H:i:s'),
			// 	'target_child_id' => $qrData->child_asset_id != '' ? $qrData->child_asset_id : null
			// ));
		
		// }
	}

	function getaddress($lat, $lng){
	  $url  = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&key=AIzaSyAco3UcgCfxQooiSwgePlHlW-qM8FJkRMY&sensor=false';
	  $json = @file_get_contents($url);
		$data = json_decode($json);
		return $data;
	  //  $status = $data->status;
	  //  if($status=="OK")
	  //  {
	  //    return $data->results[0]->formatted_address;
	  //  }
	  //  else
	  //  {
	  //    return false;
	  //  }
	}

	public function test_api(){
		// $this->getaddress('14.56091', '121.0583');
		$distance_diff = $this->getDistanceBetweenPoints('14.5603435', '121.0586144', '5.07903', '119.78236');
		print_r($distance_diff);
	}

	public function printSummaryDispatch(){
		//$arr_asset_id = $this->uri->segment(2);
		//$enc_ai = $this->encdec($arr_asset_id, 'd');
		//$data = json_decode($enc_ai);
		//$data = implode(',',$data);
		$params['data'] = $this->db->query("SELECT * FROM v_regkit_count")->result();
		$params['check_url'] = function($url){ return $this->check_url($url); };
		$html = $this->load->view('admin/crud/print-summary-dispatch', $params, TRUE);
		$this->AdminMod->pdf($html, 'Total Count Summary', false, 'LEGAL', false, false, false, 'Total Count Summary', '');
		// $this->generatePdf('admin/crud/print-qrcode-per-page', $params);
	}

	public function getChkSummaryDispatch(){
		$arr_asset_id = $this->input->post('data');
		echo json_encode(array('data'=> $this->encdec(json_encode($arr_asset_id), 'e')));
	}
	
	
	//dyon
	
	
	
	
	
		public function getPrintGatePassReport(){

				$where = 'is_deleted = 0';
				$person_id = $this->input->post('personnel_id');
				$plate_no  = $this->input->post('plate_no');
				$status  = $this->input->post('status');

		if($this->input->post('location_id') != ''){
			$where .= ' AND location_id = ' . $this->input->post('location_id');
		}
		if ($this->input->post('status') == 1) {
			$where .= ' AND status = 1';
		} else {
			$where .= ' AND status = 0';
		}
		echo json_encode(array(
				'data'      => $this->encdec($where, 'e'),
				'params' => $this->encdec($person_id . '-' . $plate_no, 'e')
		));
	}



	public function printGatePass(){
		$where = $this->encdec($this->uri->segment(2), 'd');
		$data_procces = $this->uri->segment(3);
		$dec_data_process = $this->encdec($data_procces, 'd');
		$params['data_procces'] = explode('-', $dec_data_process);
		$params['dataChkList'] = $this->db->get_where('tbl_asset_checklist', $where)->result();
		$params['type'] = 'gatepass';
		if ($params['dataChkList']) {
			$this->createPdfWOHeadFoot('admin/crud/print-gatepass-slip', $params);	
		} else {
			echo "<script>alert('No data found')</script>";
		}

	}
	
public function getGatePassPrintFrm(){
		$params['locations'] = $this->db->get_where('tbl_locations', array('is_deleted'=>0))->result();
		$params['custodian'] = $this->db->get_where('users', array('is_deleted'=>0, 'level <>'=>'0'))->result();
		$params['checkList'] = $this->db->get_where('tbl_asset_checklist')->result();
		$this->load->view('admin/crud/print-gatepass-frm', $params);
	}
	
		public function locationDashboard(){
		$params['heading'] = 'DASHBOARD - LOCATION';
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-asset', $params, TRUE);
		$params['data'] = $this->db->query("SELECT * FROM v_regkit_count")->result();
		//$params['check_url'] = function($url){ return $this->check_url($url); };
		$this->adminContainer('admin/location-dashboard', $params);	
	}

	
	
}	