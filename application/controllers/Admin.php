<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$params['heading'] = 'CBAM-ERS DASHBOARD';
		$params['allAsset'] = $this->db->query("SELECT count(*) as count from tbl_asset a1")->row();
		$params['allAsset1'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.status_id = 2")->row();
		$params['allAsset2'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.status_id = 3")->row();
		$params['allAsset3'] = $this->db->query("SELECT count(*) as count from tbl_asset a1 where a1.status_id = 4")->row();
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
					'username'  => $username,
					'users_id' => $q->row()->users_id
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
				$title    	 = "CPFI | Forgot Password";
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
		$asset_id 	  	 	 = $this->input->get('data');
		$params['data'] 	 = $this->AdminMod->getAssetRecord($asset_id); 
		$params['uploads'] = $this->db->get_where('tbl_uploads', array('asset_id' => $asset_id))->row();
		$url = $this->db->get_where('tbl_qrcodes', array('asset_id' => $asset_id))->row();
		$jsonQrData = json_decode($url->qr_code);
		$params['qrcode'] = $jsonQrData->result->qr;
		$this->load->view('admin/crud/view-asset', $params);
	}

	public function server_tbl_asset(){
		$result 	= $this->AdminMod->get_output_asset();
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

	public function add_asset(){
		$params['companies'] = $this->db->get_where('tbl_companies', array('is_deleted' => 0))->result();
		$params['models'] 	 = $this->db->get_where('tbl_models', array('is_deleted' => 0))->result();
		$params['status'] 	 = $this->db->get_where('tbl_status_labels', array('is_deleted' => 0))->result();
		$params['suppliers'] = $this->db->get_where('tbl_suppliers', array('is_deleted' => 0))->result();
		$params['locations'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['users']     = $this->db->get_where('users', array('is_deleted' => 0))->result();
		$params['office']     = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['departments']     = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/crud/create-asset', $params);	
	}

	public function edit_asset(){
		$asset_id 			 		 		= $this->input->get('data');
		$params['dataAsset'] 		= $this->db->get_where('tbl_asset', array('id' => $asset_id))->row();
		$params['companies'] 		= $this->db->get_where('tbl_companies', array('is_deleted' => 0))->result();
		$params['models'] 	 		= $this->db->get_where('tbl_models', array('is_deleted' => 0))->result();
		$params['status'] 	 		= $this->db->get_where('tbl_status_labels', array('is_deleted' => 0))->result();
		$params['suppliers'] 		= $this->db->get_where('tbl_suppliers', array('is_deleted' => 0))->result();
		$params['locations'] 		= $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['uploads'] 	 		= $this->db->get_where('tbl_uploads', array('asset_id' => $asset_id))->row();
		$params['users']     		= $this->db->get_where('users', array('is_deleted' => 0))->result();
		$params['office']     	= $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['departments']  = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/crud/edit-asset', $params);
	}

	public function save_asset(){
		$this->form_validation->set_rules('company_id', 'Company', 'required');
		$this->form_validation->set_rules('asset_tag', 'Asset Tag', 'required');
		$this->form_validation->set_rules('model_id', 'Model', 'required');
		$this->form_validation->set_rules('status_id', 'Status', 'required');
		$this->form_validation->set_rules('serial', 'Serial', 'required');
		$this->form_validation->set_rules('name', 'Asset Name', 'required');
		$this->form_validation->set_rules('purchase_date', 'Purchase Date', 'required');
		$this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
		$this->form_validation->set_rules('order_number', 'Order Number', 'required');
		$this->form_validation->set_rules('purchase_cost', 'Purchase Cost', 'required');
		$this->form_validation->set_rules('warranty_months', 'Warranty', 'required');

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
				$this->db->update('tbl_asset', $dataField, array('id'=>$updateID));
				$errors['id'] = $updateID;
				$this->upload_const_dp($updateID);
				//save logs
				$this->save_action_logs(array(
					'user_id' => $this->session->users_id,
					'action_type' => 'update',
					// 'target_id' => $updateID,
					'target_type' => 'asset',
					'item_type' =>  'Asset',
					'item_id' =>  $updateID,
					'created_at' => date('Y-m-d')
				));
			} else {
				$dataField['created_at'] = date('Y-m-d');
				$this->db->insert('tbl_asset', $dataField);
				$errors['id'] = $this->db->insert_id();
				$this->upload_const_dp($errors['id']);
				$this->generateQR($errors['id']);
				//save logs
				$this->save_action_logs(array(
					'user_id' => $this->session->users_id,
					'action_type' => 'create',
					'target_id' => $errors['id'],
					'target_type' => 'asset',
					'item_type' =>  'Asset',
					'item_id' =>  $updateID,
					'created_at' => date('Y-m-d')
				));
			}
			
			
			
		}
		echo json_encode($errors);
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
				$this->db->update('tbl_uploads', 
					array(
						'image_name' 			 => $dImg['file_name'],
						'image_path' 			 => $dImg['file_path'],
						'transaction_date' => date('Y-m-d')
					), 
					array('asset_id' => $id)
				);
			} else {
				$this->db->insert('tbl_uploads', 
					array(
						'asset_id' 					 => $id,
						'image_name' 				 => $dImg['file_name'],
						'image_path' 				 => $dImg['file_path'],
						'transaction_date' 	 => date('Y-m-d')
					)
				);	
			}
			$data['file_name'] = $dImg['file_name'];
			$data['success'] = true;
		}
		// echo json_encode($data);
	}


	public function deleteAsset(){
		$asset_id = $this->input->post('id');
		$this->db->update('tbl_asset', array('is_deleted' => '1'), array('id' => $asset_id));
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
		if(!$this->session->userdata('users_id')){
			$userdata = array(
				'redirects_url'  => base_url() . "get-assets/" . $d,
			);
			$this->session->set_userdata($userdata);
		  redirect('login');
		}
		$logedUser = $this->db->get_where('users', array('users_id' => $this->session->users_id))->row();
		// echo '<pre>';
		// echo json_encode($this->session, JSON_PRETTY_PRINT);
		// echo '</pre>';
		$params['data']=$res;
		$params['uploads']=$this->db->get_where('tbl_uploads', array('asset_id' => $dec_un))->row();
		$this->load->view('admin/asset-mobile-view', $params);
	}

	public function printAssetQr(){
		$params['data'] = $this->db->query('SELECT tq.*, ta.asset_tag FROM tbl_qrcodes tq left join tbl_asset ta on ta.id = tq.asset_id')->result();
		$html = $this->load->view('admin/crud/print-asset-qr', $params, TRUE);
		$this->AdminMod->pdf($html, 'QR Code List', false, 'LEGAL', false, false, false, 'QR CODE', '');
	}

	public function encryptKey(){
		$un     = $this->input->post('key');
		$enc_un = $this->encdec($un, 'e');
		echo json_encode(['key' => $enc_un]);
	}

	public function saveCreatedQr(){
    // Test WebHook and show post params
    error_log("Fired WebHook");
    // show Post Parameter
    foreach ($_POST as $param_name => $param_val) {
        error_log("$param_name: $param_val");
    }
    // show Get Parameter
    foreach ($_GET as $param_name => $param_val) {
        error_log("$param_name: $param_val");
    }
    // if JSON is submitted
		$json = json_decode(file_get_contents('php://input'));

		$qrData = $this->db->get_where('tbl_qrcodes', array('code' => $_POST['code']))->row();
		$address = $this->getaddress($_POST['lat'], $_POST['lng']);
		$this->db->insert('tbl_gps', array(
																	'asset_id' 		=> $qrData->asset_id,
																	'event' 			=> $_POST['event'], 
																	'timestamp' 	=> $_POST['timestamp'], 
																	'redirects' 	=> $_POST['redirects'], 
																	'visitors' 		=> $_POST['visitors'], 
																	'device' 			=> $_POST['device'], 
																	'os' 					=> $_POST['os'], 
																	'country' 		=> $_POST['country'], 
																	'lng' 				=> $_POST['lng'], 
																	'lat' 				=> $_POST['lat'], 
																	'user' 				=> $_POST['user'], 
																	'email' 			=> $_POST['email'], 
																	'mobile' 			=> $_POST['mobile'], 
																	'type' 				=> $_POST['type'], 
																	'code' 				=> $_POST['code'], 
																	'secrettoken' => $_POST['secrettoken'],
																	'address' 	  => $address->results[0]->formatted_address//$address->result->formatted_address
																));

		$this->save_action_logs(array(
			'user_id' 			=> $this->session->users_id,
			'action_type' 	=> 'scanned asset',
			'target_id' 		=> $qrData->asset_id,
			'target_type' 	=> 'asset',
			// 'item_type' 	=>  'Asset',
			// 'item_id' 		=>  $updateID,
			'created_at' 		=> date('Y-m-d')
		));

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
		$this->getaddress('14.56091', '121.0583');
	}
}	