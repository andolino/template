<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Settings extends MY_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function deleteData(){
		$tbl 	= $this->input->post('tbl');
		$fld 	= $this->input->post('w');
		$id 	= $this->input->post('v');
		$this->db->update($tbl, array('is_deleted' => 1), array($fld => $id));
	}

	public function addData(){
		$tbl 	= $this->input->post('tbl');
		$id 	= $this->input->post('has_update');
		$mustUnique 	= $this->input->post('unique');
		$data = array();
		foreach ($this->input->post() as $key => $value) {
			if ($key!='tbl'&&$key!='has_update'&&$key!='pk_key'&&$key!='unique'&&$key!='original_val') {
				$data[$key] = $value;	
			}
		}
		$errors = [];
		$res = array();

		$checkIsDeleted = $this->db->get_where($tbl, array($mustUnique => $_POST[$mustUnique], 'is_deleted' => 0))->row();
		//ignore validate if value is existing for update
		if ($_POST[$mustUnique] != $this->input->post('original_val') && $checkIsDeleted) {
			$this->form_validation->set_rules($mustUnique, 
																				strtoupper(str_replace('_', ' ', $mustUnique)),
																				'trim|required|is_unique['.$tbl.'.'.$mustUnique.']');
		}
		if ($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			if (!empty($errors)) {
				$res['param1'] = 'Opps!';
				$res['param2'] = $errors[$mustUnique] . '! changes not updated';
				$res['param3'] = 'warning';	
			} else {
				if ($this->input->post('has_update')!='') {
					$q = $this->db->update($tbl, $data, array($this->input->post('pk_key') => $this->input->post('has_update')));
				} else {
					$q = $this->db->insert($tbl, $data);
				}
				if ($q) {
					$res['param1'] = 'Success!';
					$res['param2'] = 'Successfully Saved!';
					$res['param3'] = 'success';
				} else {
					$res['param1'] = 'Opps!';
					$res['param2'] = 'Error Encountered Saved';
					$res['param3'] = 'warning';
				}
			}
		} else {
			if ($this->input->post('has_update')!='') {
				$q = $this->db->update($tbl, $data, array($this->input->post('pk_key') => $this->input->post('has_update')));
			} else {
				$q = $this->db->insert($tbl, $data);
			}
			if ($q) {
				$res['param1'] = 'Success!';
				$res['param2'] = 'Successfully Saved!';
				$res['param3'] = 'success';
			} else {
				$res['param1'] = 'Opps!';
				$res['param2'] = 'Error Encountered Saved';
				$res['param3'] = 'warning';
			}
		}

		//upload image
		if ($tbl=='tbl_companies') {
			if ($this->input->post('has_update')) {
				$this->uploadImage($this->input->post('has_update'), 'id', 'tbl_companies');
			} else {
				$this->uploadImage($this->db->insert_id(), 'id', 'tbl_companies');
			}
		}

		echo json_encode($res);
	}

	public function view_users(){
		$params['coaUsers'] = $this->db->get_where('users', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-users', $params);
	}

	public function server_users(){
		$result 	= $this->Table->getOutput('users', ['users_id', 'screen_name', 'username', 'password', 'txt_password', 'trans_date', 'trans_desc', 'is_deleted', 'last_name', 'first_name', 'middle_name', 'level'], ['users_id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->screen_name;
   		$data[] = $row->username;
   		$data[] = $row->last_name . ', ' . $row->first_name . ' ' . ($row->middle_name ?? '');
   		$data[] = $this->AdminMod->getUserType($row->level);
 			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-users-frm" data-id="'.$row->users_id.'" data-title="EDIT - '.strtoupper($row->screen_name).'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" id="loadSidePage" data-link="get-users-frm-fp" data-id="'.$row->users_id.'" data-title="UPDATE PASSWORD - '.strtoupper($row->screen_name).'"><i class="fas fa-key"></i></a> | <a href="javascript:void(0);" onclick="removeData(this)" data-tbl="users" data-field="users_id" data-id="'.$row->users_id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->Table->countAllTbl(),
			'recordsFiltered' => $this->Table->countFilterTbl(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function server_tbl_activity_logs(){
		$result 	= $this->Table->getOutput('v_activity_logs', ['created_at', 'screen_name', 'action_type', 'asset_name', 'target_type', 'is_deleted', 'lat', 'lng', 'address'], ['created_at' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = date('Y-m-d', strtotime($row->created_at));
   		$data[] = $row->screen_name;
   		$data[] = $row->action_type;
   		$data[] = $row->asset_name;	
   		$data[] = $row->target;	
   		$data[] = $row->address;	
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->Table->countAllTbl(),
			'recordsFiltered' => $this->Table->countFilterTbl(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function server_companies(){
		$result 	= $this->Table->getOutput('tbl_companies', ['id', 'name', 'image', 'is_deleted'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->name;
   		$data[] = $row->image;
			 $data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-companies-frm" data-id="'.$row->id.'" data-title="EDIT - '.strtoupper($row->name).'"><i class="fas fa-edit"></i></a> | 
			 						<a href="javascript:void(0);" onclick="removeData(this)" data-tbl="tbl_companies" data-field="id" data-id="'.$row->id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->Table->countAllTbl(),
			'recordsFiltered' => $this->Table->countFilterTbl(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_models(){
		$result 	= $this->Table->getOutput('tbl_models', ['id', 'name', 'is_deleted'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->name;
			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-models-frm" data-id="'.$row->id.'" data-title="EDIT - '.strtoupper($row->name).'"><i class="fas fa-edit"></i></a> | 
			 						<a href="javascript:void(0);" onclick="removeData(this)" data-tbl="tbl_models" data-field="id" data-id="'.$row->id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->Table->countAllTbl(),
			'recordsFiltered' => $this->Table->countFilterTbl(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_suppliers(){
		$result 	= $this->Table->getOutput('tbl_suppliers', ['id', 'name', 'is_deleted'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->name;
   		$data[] = $row->contact_no;
			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-supplier-frm" data-id="'.$row->id.'" data-title="EDIT - '.strtoupper($row->name).'"><i class="fas fa-edit"></i></a> | 
			 						<a href="javascript:void(0);" onclick="removeData(this)" data-tbl="tbl_suppliers" data-field="id" data-id="'.$row->id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->Table->countAllTbl(),
			'recordsFiltered' => $this->Table->countFilterTbl(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}
	
	public function server_locations(){
		$result 	= $this->Table->getOutput('tbl_locations', ['id', 'name', 'is_deleted'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->name;
			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-locations-frm" data-id="'.$row->id.'" data-title="EDIT - '.strtoupper($row->name).'"><i class="fas fa-edit"></i></a> | 
			 						<a href="javascript:void(0);" onclick="removeData(this)" data-tbl="tbl_locations" data-field="id" data-id="'.$row->id.'"><i class="fas fa-trash"></i></a>';
			$res[] = $data;
		}

		$output = array (
			'draw' 						=> isset($_POST['draw']) ? $_POST['draw'] : null,
			'recordsTotal' 		=> $this->Table->countAllTbl(),
			'recordsFiltered' => $this->Table->countFilterTbl(),
			'data' 						=> $res
		);

		echo json_encode($output);
	}

	public function getUsersFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('users', array('is_deleted' => 0, 'users_id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-users', $params);
	}

	public function getUsersFrmFp(){
		$params['has_update'] = $this->input->post('id');
		$this->load->view('admin/settings/forms/frm-users-fp', $params);
	}

	public function getCompaniesFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('tbl_companies', array('is_deleted' => 0,'id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-companies', $params);
	}
	
	public function getModelsFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('tbl_models', array('is_deleted' => 0,'id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-models', $params);
	}
	
	public function getSupplierFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('tbl_suppliers', array('is_deleted' => 0,'id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-supplier', $params);
	}
	
	public function getLocationsFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0,'id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-locations', $params);
	}

	public function saveUsersData(){
		if (count($_POST) == 3) {
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
		} 
		elseif(count($_POST) > 3 && $this->input->post('has_update')!=''){
			$this->form_validation->set_rules('screen_name','Screen Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			// $this->form_validation->set_rules('middle_name','Middle Name','trim|required');
			if ($this->input->post('email') != $this->input->post('original_email')) {
				$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
			}
			if ($this->input->post('username') != $this->input->post('original_username')) {
				$this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
			}
			$this->form_validation->set_rules('level','Level','required');
			$this->form_validation->set_rules('designation','Designation','trim|required');
		} else {
			$this->form_validation->set_rules('screen_name','Screen Name','trim|required');
			$this->form_validation->set_rules('last_name','Last Name','trim|required');
			$this->form_validation->set_rules('first_name','First Name','trim|required');
			// $this->form_validation->set_rules('middle_name','Middle Name','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('username','Username','trim|required|is_unique[users.username]');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]');
			$this->form_validation->set_rules('level','Level','required');
			$this->form_validation->set_rules('designation','Designation','trim|required');
		}
		$errors = array();
		if ($this->form_validation->run() == FALSE){
			$errors = $this->form_validation->error_array();
			$errors['msg'] = 'fail';
		} else {
			if ($this->input->post('has_update')!='') {
				$data=array();
				if (count($_POST) == 3) {
					$password = $this->input->post('password');
					$hashed_password = password_hash($password, PASSWORD_BCRYPT);
					$data = [
						'password'		=> $hashed_password,
						'txt_password'=> $password,
					];
				} else {
					$data = [
						'screen_name' => $this->input->post('screen_name'),
						'username' 		=> $this->input->post('username'),
						'last_name' 	=> $this->input->post('last_name'),
						'first_name' 	=> $this->input->post('first_name'),
						'middle_name' => $this->input->post('middle_name'),
						'email' 			=> $this->input->post('email'),
						'level' 			=> $this->input->post('level'),
						'designation' => $this->input->post('designation'),
						'trans_date'	=> date('Y-m-d')
					];
				}
				$this->db->update('users', $data, array('users_id' => $this->input->post('has_update')));
				$errors['msg']		 	 = 'success';
			} else {
				$password = $this->input->post('password');
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);
				$data = [
						'screen_name' => $this->input->post('screen_name'),
						'username' 		=> $this->input->post('username'),
						'last_name' 	=> $this->input->post('last_name'),
						'first_name' 	=> $this->input->post('first_name'),
						'middle_name' => $this->input->post('middle_name'),
						'email' 			=> $this->input->post('email'),
						'level' 			=> $this->input->post('level'),
						'designation' => $this->input->post('designation'),
						'password'		=> $hashed_password,
						'txt_password'=> $password,
						'trans_date'	=> date('Y-m-d')
				];
				$this->db->insert('users', $data);
				$users_id = $this->db->insert_id();
				$errors['msg']		 	 = 'success';
			}
		}
		echo json_encode($errors);

	}

	public function view_companies(){
		$params['settDepartments'] = $this->db->get_where('tbl_companies', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-companies', $params);
	}
	
	public function view_models(){
		$params['settDepartments'] = $this->db->get_where('tbl_models', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-models', $params);
	}	
	
	public function view_suppliers(){
		$params['settDepartments'] = $this->db->get_where('tbl_suppliers', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-suppliers', $params);
	}
	
	public function view_locations(){
		$params['settDepartments'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-locations', $params);
	}


}



