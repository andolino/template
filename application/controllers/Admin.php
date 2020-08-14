<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$params['heading'] = 'WELCOME CPFI PANEL';
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

				// $from    		 = "manage_account@cpfi-webapp.com";
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

	public function member_list(){
		$params['heading'] = 'MEMBER LIST';
		$params['tblMembers'] = $this->load->view('admin/crud/tbl-members', $params, TRUE);
		$this->adminContainer('admin/member-list', $params);	
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

	public function getCgAmntPerMember(){
		$members_id = $this->input->post('m_id');
		$mData 			= $this->db->query("SELECT m.*, d.cash_gift_rate, d.contribution_rate FROM members m
																		LEFT JOIN office_management om ON om.office_management_id = m.office_management_id
																		LEFT JOIN departments d ON d.departments_id = om.departments_id WHERE m.members_id = '$members_id'")->row();
		// $cgRate 		= $this->db->get('contribution_rate')->row();
		if(strtotime($mData->date_of_effectivity) < strtotime('-1 year')){
			$amnt 		= floatval(str_replace(',', '', $mData->monthly_salary)) * (floatval(str_replace(',', '', $mData->cash_gift_rate))/100);
		} else {
			$amnt 		= 0;
		}
		echo json_encode(array(
											'amnt'=>str_replace(', ', '', $amnt)
										));
	}

	public function tbl_members(){
		$this->load->view('admin/crud/tbl-members');
	}

	public function view_member(){
		$members_id 	  	 = $this->input->get('data');
		$params['data'] 	 = $this->AdminMod->getMembersRecord($members_id); 
		$params['uploads'] = $this->db->get_where('uploads', array('members_id' => $members_id))->row();
		$this->load->view('admin/crud/view-member', $params);
	}

	public function server_tbl_members(){
		$result 	= $this->AdminMod->get_output_members();
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$viewPage = $this->input->post('page');

		foreach ($result as $row) {
			$hashed_id = $this->encdec($row->members_id, 'e');
			$data = array();
			$no++;
   		$data[] = '<input type="checkbox" id="chk-const-list-tbl" value="'.$row->members_id.'" name="chk-const-list-tbl">';
   		$data[] = $row->id_no;
   		$data[] = strtoupper($row->last_name);
   		$data[] = strtoupper($row->first_name);
   		$data[] = strtoupper($row->middle_name);
   		$data[] =	date('Y-m-d', strtotime($row->dob));
   		$data[] = $row->address;
   		$data[] = $row->status;
   		$data[] = date('Y-m-d', strtotime($row->date_of_effectivity));
   		
			$data[] = '<a href="javascript:void(0);" 
										id="loadPage" 
										data-link="view-member" 
										data-ind="'.$row->members_id.'" 
										data-badge-head="'.strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name).'" 
										data-cls="cont-view-member" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="View" 
										data-id="'.$row->members_id.'"><i class="fas fa-search"></i></a> | 
								<a href="javascript:void(0);" 
										id="loadPage" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="Edit" 
										data-link="edit-member" 
										data-ind="'.$row->members_id.'" 
										data-cls="cont-edit-member" 
										data-badge-head="EDIT '.strtoupper($row->last_name . ', ' . $row->first_name . ' ' . $row->middle_name).'"><i class="fas fa-edit"></i></a> | 
								<a href="javascript:void(0);" 
										id="remove-lgu-const-list" 
										data-placement="top" 
										data-toggle="tooltip" 
										title="Remove" 
										data-id="'.$row->members_id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->AdminMod->count_all_members(),
			'recordsFiltered' => $this->AdminMod->count_filter_members(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}



	public function add_member(){
		$params['civilStatus'] = $this->db->get_where('civil_status', array('is_deleted' => 0))->result();
		$params['ofcMngmt'] 	 = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$params['memberType']  = $this->db->get_where('member_type', array('is_deleted' => 0))->result();
		$this->load->view('admin/crud/add-member', $params);	
	}


	public function edit_member(){
		$members_id 			 		 = $this->input->get('data');
		$params['uploads'] 		 = $this->db->get_where('uploads', array('members_id' => $members_id))->row();
		$params['membersData'] = $this->db->get_where('members', array('members_id' => $members_id))->row();
		$params['civilStatus'] = $this->db->get_where('civil_status', array('is_deleted'=>0))->result();
		$params['ofcMngmt'] 	 = $this->db->get_where('office_management', array('is_deleted'=>0))->result();
		$params['memberType']  = $this->db->get_where('member_type', array('is_deleted'=>0))->result();
		$this->load->view('admin/crud/edit-member', $params);
	}

	public function save_constituent(){
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('dob', 'Date of Birth', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('civil_status_id', 'Civil Status', 'required');
		$this->form_validation->set_rules('monthly_salary', 'Monthly Salary', 'required');
		$this->form_validation->set_rules('designation', 'Designation', 'required');
		$this->form_validation->set_rules('office_management_id', 'Office', 'required');
		$this->form_validation->set_rules('date_of_effectivity', 'Date of Effectivity', 'required');
		$this->form_validation->set_rules('member_type_id', 'Member', 'required');

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
			// $childrenNFieldData 	 = array();
			// $childrenBPFieldData 	 = array();
			foreach ($this->input->post() as $key => $value) {
				switch ($key) {
					case 'social_status':
						// $dataFieldSocialStatus[] = $value;
						break;
					case 'has_update':
						$isForUpdate = true;
						$updateID    = $value;
						break;
					default:
						$dataField[$key] 			 = str_replace(',', '', $value);
						break;
				}
			}
			$dataField['entry_date'] = date('Y-m-d');
			// $dataField['social_status'] 	 = implode('|', $dataFieldSocialStatus[0]);
			$dataField['users_id'] 				 = $this->session->users_id;
			
			/**
				Save members table
			*/
			if ($isForUpdate) {
				$this->db->update('members', $dataField, array('members_id'=>$updateID));
				$errors['members_id'] = $updateID;
			} else {
				$dataField['members_id'] = $this->AdminMod->primaryKey('members_id');
				$this->db->insert('members', $dataField);
				$errors['members_id'] 	 = $dataField['members_id'];
			}
			
			//last insert id
			
			/**
				For Multiple Forms		
				Save children Table
			*/
			// $dataChildren = array();
			// if (!empty($childrenNFieldData[0])) {
			// 	for ($i=0; $i < count($childrenNFieldData[0]); $i++) { 
			// 		$dataChildren[$i]['lgu_constituent_id'] = ($isForUpdate) ? $updateID : $lguConstituentID;
			// 		$dataChildren[$i]['name'] 							= $childrenNFieldData[0][$i];
			// 		$dataChildren[$i]['birthplace'] 				= $childrenBPFieldData[0][$i];
			// 	}

			// 	if ($isForUpdate) {
			// 		$this->db->delete('children', array('lgu_constituent_id'=>$updateID));
			// 		$this->db->insert_batch('children', $dataChildren);	
			// 	} else {
			// 		$this->db->insert_batch('children', $dataChildren);
			// 	}
			// } else {
			// 	if ($isForUpdate) {
			// 		$this->db->delete('children', array('lgu_constituent_id'=>$updateID));
			// 	}
			// }

		}
		echo json_encode($errors);
	}


	public function upload_const_dp(){
		$config['upload_path'] 		= './assets/image/uploads';
		$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		$config['max_size']  			= 0; // any size
		$config['remove_spaces']	= true;
		$id 											= $this->input->post('members_id');
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

			$chkExisting    = $this->db->get_where('uploads', array('members_id' => $id))->result();
			if ($chkExisting) {
				$this->db->update('uploads', 
					array(
						'image_name' 			 => $dImg['file_name'],
						'image_path' 			 => $dImg['file_path'],
						'transaction_date' => date('Y-m-d')
					), 
					array('members_id' => $id)
				);
			} else {
				$this->db->insert('uploads', 
					array(
						'members_id' 				 => $id,
						'image_name' 				 => $dImg['file_name'],
						'image_path' 				 => $dImg['file_path'],
						'transaction_date' 	 => date('Y-m-d')
					)
				);	
			}
			$data['file_name'] = $dImg['file_name'];
			$data['success'] = true;
		}
		echo json_encode($data);
	}


	public function deleteMember(){
		$members_id = $this->input->post('id');
		$this->db->update('members', array('is_deleted' => '1'), array('members_id' => $members_id));
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

}
