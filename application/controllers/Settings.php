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
		$result 	= $this->Table->getOutput('users', ['users_id', 'screen_name', 'username', 'password', 'txt_password', 
																									'trans_date', 'trans_desc', 'is_deleted', 'last_name', 'first_name', 
																									'middle_name', 'level'], ['users_id' => 'desc']);
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
		$result 	= $this->Table->getOutput('v_activity_logs', ['created_at', 'screen_name', 'action_type', 'asset_name', 
																														'target_type', 'is_deleted', 'lat', 'lng', 'address', 'target', 
																														'default_location', 'scanned_lat', 'scanned_lng', 'code', 'asset_name2', 'target2', 'default_location2', 'scanned_lat2', 'scanned_lng2'], ['created_at' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = date('Y-m-d H:m:s A', strtotime($row->created_at));
   		$data[] = $row->screen_name == '' ? $row->screen_name : $row->screen_name;
   		$data[] = $row->action_type;
   		$data[] = $row->asset_name == '' ? $row->asset_name2 : $row->asset_name;	
			$data[] = $row->target == '' ? $row->target2 : $row->target;	
			if ($row->scanned_lat=='') {
				$data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->lat.'" data-long="'.$row->lng.'" >'.$row->default_location2.'</a>';	
				$data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showScannedUser" data-code="'.$row->code.'" data-lat="'.$row->scanned_lat2.'" data-long="'.$row->scanned_lng2.'">SCANNED USER</a>';
			} else {
				$data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->lat.'" data-long="'.$row->lng.'" >'.$row->default_location.'</a>';
				$data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showScannedUser" data-code="'.$row->code.'" data-lat="'.$row->scanned_lat.'" data-long="'.$row->scanned_lng.'">SCANNED USER</a>';
			}
			// $data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->scanned_lat.'" data-long="'.$row->scanned_lng.'" >'.$row->address.'</a>';	;	
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

	public function server_tbl_print_logs_transmittal(){
		$result 	= $this->Table->getOutput('v_print_logs', ['id', 'name_of_personnel', 'plate_no', 'print_by', 
																														'location_name', 'is_deleted', 'entry_date', 'qty', 'asset', 'file_dir', 'received_by'], ['id' => 'asc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->id;
   		$data[] = $row->print_by;
   		$data[] = date('Y-m-d', strtotime($row->entry_date));
   		$data[] = $row->location_name;	
			$data[] = $row->asset;	
			$data[] = $row->qty;	
			$data[] = '<a href="'.$row->file_dir.'" class="text-primary" download >'.explode('/', $row->file_dir)[INDEX_PRINT_LOGS].'</a>';	
			$data[] = $row->contact_person;	
			$data[] = $row->date_received == '' ? '' : date('Y-m-d h:i:s A', strtotime($row->date_received));	
			$data[] = '<a href="'.$row->file_dir.'" target="_blank" ><i class="fas fa-search"></i></a> | ' . ($this->session->level == 1 ? '' : '<a href="javascript:void(0);" onclick="removeDataInd(this)" 
																																																																								data-id="'.$row->id.'"
																																																																								data-tbl="tbl_print_logs"
																																																																								data-field="id"><i class="fas fa-trash"></i></a>');	
			// $data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->scanned_lat.'" data-long="'.$row->scanned_lng.'" >'.$row->address.'</a>';	;	
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

	public function server_tbl_print_logs_gatepass(){
		$result 	= $this->Table->getOutput('v_print_logs', ['id', 'name_of_personnel', 'plate_no', 'print_by', 
																														'location_name', 'is_deleted', 'entry_date', 'qty', 'asset', 'file_dir', 'received_by', 'gatepass_date'], ['id' => 'asc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		foreach ($result as $row) {
			$data = array();
			$no++;
			$data[] = $row->id;
			$data[] = $row->print_by;	
   		$data[] = date('Y-m-d', strtotime($row->entry_date));
   		$data[] = $row->name_of_personnel;
			$data[] = $row->plate_no;	
			$data[] = $row->location_name;	
			$data[] = '<a href="'.$row->file_dir.'" class="text-primary" download >'.explode('/', $row->file_dir)[INDEX_PRINT_LOGS].'</a>';	
			$data[] = $row->gatepass_date == '' ? '' : date('Y-m-d', strtotime($row->gatepass_date));
			$data[] = '<a href="'.$row->file_dir.'" target="_blank" ><i class="fas fa-search"></i></a> | ' . ($this->session->level == 1 ? '' : '<a href="javascript:void(0);" onclick="removeDataInd(this)" 
																																																																							data-id="'.$row->id.'"
																																																																							data-tbl="tbl_print_logs"
																																																																							data-field="id"><i class="fas fa-trash"></i></a>');	
			// <a href="javascript:void(0);" onclick="removeDataInd(this)" 
			// 																																															data-id="'.$row->id.'"
			// 																																															data-tbl="tbl_print_logs"
			// 																																															data-field="id"><i class="fas fa-trash"></i></a>
			// $data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->scanned_lat.'" data-long="'.$row->scanned_lng.'" >'.$row->address.'</a>';	;	
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

	public function server_tbl_print_logs_checklist(){
		$result 	= $this->Table->getOutput('v_print_logs', ['id', 'name_of_personnel', 'plate_no', 'print_by', 
																														'location_name', 'is_deleted', 'entry_date', 'qty', 'asset', 'file_dir', 'received_by'], ['id' => 'asc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->id;
   		$data[] = $row->print_by;
   		$data[] = date('Y-m-d', strtotime($row->entry_date));
   		$data[] = $row->location_name;	
			$data[] = $row->asset;	
			$data[] = $row->qty;	
			$data[] = '<a href="'.$row->file_dir.'" class="text-primary" download >'.explode('/', $row->file_dir)[INDEX_PRINT_LOGS].'</a>';	
			$data[] = '<a href="'.$row->file_dir.'" target="_blank" ><i class="fas fa-search"></i></a> | ' . ($this->session->level == 1 ? '' : '<a href="javascript:void(0);" onclick="removeDataInd(this)" 
																																																																						data-id="'.$row->id.'"
																																																																						data-tbl="tbl_print_logs"
																																																																						data-field="id"><i class="fas fa-trash"></i></a>');		
			// $data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->scanned_lat.'" data-long="'.$row->scanned_lng.'" >'.$row->address.'</a>';	;	
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

	public function server_tbl_print_logs_qrcodes(){
		$result 	= $this->Table->getOutput('v_print_logs', ['id', 'name_of_personnel', 'plate_no', 'print_by', 
																														'location_name', 'is_deleted', 'entry_date', 'qty', 'asset', 'file_dir', 'received_by'], ['id' => 'asc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		foreach ($result as $row) {
			$data = array();
			$no++;
			$data[] = $row->id;
			$data[] = $row->print_by;	
			$data[] = date('Y-m-d', strtotime($row->entry_date));
			$data[] = $row->location_name;	
   		$data[] = $row->asset;
			$data[] = $row->qty;	
			$data[] = '<a href="'.$row->file_dir.'" class="text-primary" download >'.explode('/', $row->file_dir)[INDEX_PRINT_LOGS].'</a>';	
			// $data[] = $row->asset;	
			// $data[] = '';	
			$data[] = '<a href="'.$row->file_dir.'" target="_blank" ><i class="fas fa-search"></i></a> | ' . ($this->session->level == 1 ? '' : '<a href="javascript:void(0);" onclick="removeDataInd(this)" 
																																																																						data-id="'.$row->id.'"
																																																																						data-tbl="tbl_print_logs"
																																																																						data-field="id"><i class="fas fa-trash"></i></a>');		
			// $data[] = '<a href="javascript:void(0);" class="text-success font-weight-bold" id="showMapGeo" data-lat="'.$row->scanned_lat.'" data-long="'.$row->scanned_lng.'" >'.$row->address.'</a>';	;	
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
   		$data[] = $row->address;
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

	public function server_departments(){
		$result 	= $this->Table->getOutput('departments', ['departments_id', 'region', 'short', 'place', 'entry_date', 'is_deleted'], ['departments_id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->region;
   		$data[] = $row->place;
 			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-departments-frm" data-id="'.$row->departments_id.'" data-title="EDIT - '.strtoupper($row->short).'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" onclick="removeData(this)" data-tbl="departments" data-field="departments_id" data-id="'.$row->departments_id.'"><i class="fas fa-trash"></i></a>';
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
	
	public function server_approver(){
		$result 	= $this->Table->getOutput('v_approver', 
																					['tbl_approver_id', 'location_id', 'first_approver', 'second_approver', 'f_approver_name', 's_approver_name', 'location_name', 'entry_date', 'is_deleted'], 
																						['tbl_approver_id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->tbl_approver_id;
   		$data[] = $row->location_name;
   		$data[] = $row->f_approver_name;
   		$data[] = $row->s_approver_name;
			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-approver-frm" data-id="'.$row->tbl_approver_id.'" data-title="EDIT - '.strtoupper($row->location_name).'">
										 <i class="fas fa-edit"></i>
									</a> | <a href="javascript:void(0);" onclick="removeData(this)" data-tbl="tbl_approver" data-field="tbl_approver_id" data-id="'.$row->tbl_approver_id.'">
													<i class="fas fa-trash"></i>
												</a>';
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
	
	public function server_asset_category(){
		$result 	= $this->Table->getOutput('asset_category', ['asset_category_id', 'code', 'name', 'entry_date', 'is_deleted'], ['asset_category_id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->code;
   		$data[] = $row->name;
 			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-asset-category-frm" data-id="'.$row->asset_category_id.'" data-title="EDIT - '.strtoupper($row->name).'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" onclick="removeData(this)" data-tbl="asset_category" data-field="asset_category_id" data-id="'.$row->asset_category_id.'"><i class="fas fa-trash"></i></a>';
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

	public function server_office(){
		$result 	= $this->Table->getOutput('office_management', ['office_management_id', 'office_code', 'office_name', 'entry_date', 'is_deleted'], ['office_management_id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->office_code;
   		$data[] = $row->office_name;
 			$data[] = '<a href="javascript:void(0);" id="loadSidePage" data-link="get-office-frm" data-id="'.$row->office_management_id.'" data-title="EDIT - '.strtoupper($row->office_code).'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" onclick="removeData(this)" data-tbl="office_management" data-field="office_management_id" data-id="'.$row->office_management_id.'"><i class="fas fa-trash"></i></a>';
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
	
	public function server_dispatch_request(){
		$result 	= $this->Table->getOutput('v_portal_request', ['tbl_asset_request_id', 'office_management_id', 'asset_category_id', 'qty', 'location_id', 
																															'other_location', 'users_id', 'purpose', 'remarks', 'is_deleted', 'entry_date', 'date_need', 
																															'date_return', 'status', 'office_name', 'category_name', 'location_name', 'screen_name', 
																															'approved_by', 'approved_date', 'disapproved_by', 'disapproved_date'], ['tbl_asset_request_id' => 'desc']);

		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;
		$status = $this->input->post('request_status');
		foreach ($result as $row) {
			$data = array();
			$no++;
			if ($status == 0) {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->location_name;
				$data[] = $row->screen_name;
				$data[] = $row->category_name;
				$data[] = ''; //$row->office_name;
				$data[] = $row->qty;
				$data[] = $row->purpose;
				$data[] = date('Y-m-d h:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url('view-dispatch-request-pending?id='.$this->encdec($row->tbl_asset_request_id, 'e')).'" target="_blank"><i class="fas fa-link"></i></a>';
										// <a href="javascript:void(0);" id="approveDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-edit"></i></a>
										// <a href="javascript:void(0);" id="disapprovedDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-times"></i></a>';
			} elseif ($status == 1) {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->location_name;
				$data[] = $row->screen_name;
				$data[] = $row->category_name;
				$data[] = ''; //$row->office_name;
				$data[] = $row->qty;
				$data[] = $row->purpose;
				$data[] = date('Y-m-d h:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url('view-dispatch-request-pending?id='.$this->encdec($row->tbl_asset_request_id, 'e')).'" target="_blank"><i class="fas fa-link"></i></a>';
										// <a href="javascript:void(0);" id="approveDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-edit"></i></a>
										// <a href="javascript:void(0);" id="disapprovedDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-times"></i></a>';
			} elseif ($status == 2){
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->location_name;
				$data[] = $row->screen_name;
				$data[] = $row->category_name;
				$data[] = ''; //$row->office_name;
				$data[] = $row->qty;
				$data[] = $row->purpose;
				$data[] = date('Y-m-d h:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url('view-dispatch-request-pending?id='.$this->encdec($row->tbl_asset_request_id, 'e')).'" target="_blank"><i class="fas fa-link"></i></a>';
										// <a href="javascript:void(0);" id="approveDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-edit"></i></a>
										// <a href="javascript:void(0);" id="disapprovedDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-times"></i></a>';
			} elseif ($status == 3){
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->location_name;
				$data[] = $row->screen_name;
				$data[] = $row->category_name;
				$data[] = ''; //$row->office_name;
				$data[] = $row->qty;
				$data[] = $row->purpose;
				$data[] = date('Y-m-d h:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url('view-dispatch-request-pending?id='.$this->encdec($row->tbl_asset_request_id, 'e')).'" target="_blank"><i class="fas fa-link"></i></a>';
										// <a href="javascript:void(0);" id="approveDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-edit"></i></a>
										// <a href="javascript:void(0);" id="disapprovedDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-times"></i></a>';
			} elseif ($status == 4){
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->location_name;
				$data[] = $row->screen_name;
				$data[] = $row->category_name;
				$data[] = ''; //$row->office_name;
				$data[] = $row->qty;
				$data[] = $row->purpose;
				$data[] = date('Y-m-d h:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url('view-dispatch-request-pending?id='.$this->encdec($row->tbl_asset_request_id, 'e')).'" target="_blank"><i class="fas fa-link"></i></a>';
										// <a href="javascript:void(0);" id="approveDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-edit"></i></a>
										// <a href="javascript:void(0);" id="disapprovedDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-times"></i></a>';
			} else {
				$data[] = $row->tbl_asset_request_id;
				$data[] = $row->location_name;
				$data[] = $row->screen_name;
				$data[] = $row->category_name;
				$data[] = ''; //$row->office_name;
				$data[] = $row->qty;
				$data[] = $row->purpose;
				$data[] = date('Y-m-d h:i:s', strtotime($row->entry_date));
				$data[] = '<a href="'.base_url('view-dispatch-request-pending?id='.$this->encdec($row->tbl_asset_request_id, 'e')).'" target="_blank"><i class="fas fa-link"></i></a>';
										// <a href="javascript:void(0);" id="approveDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-edit"></i></a>
										// <a href="javascript:void(0);" id="disapprovedDispatchRequest" data-id="'.$row->tbl_asset_request_id.'"><i class="fas fa-times"></i></a>';
			}
			



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
	
	public function server_tbl_asset_listdown(){
		$result 	= $this->Table->getOutput('v_asset_parent_sibling_child', ['id', 'parent', 'name', 'serial', 'asset_tag', 
																															'office_name', 'end_user', 'location_id', 'users_id', 'is_deleted', 'counter', 'last_name', 
																															'first_name', 'middle_name', 'designation', 'short', 'sibling', 'child_count', 
																															'sibling_count', 'property_tag', 'asset_category_name', 'status_id'], ['id' => 'desc']);
		// $this->output->enable_profiler(true);
		// $this->output->enable_profiler(true);																											
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = '<input class="float-right chk-asset-listdown" name="chk-asset-listdown[]" type="checkbox" value="'.$row->id.'">';
   		$data[] = $row->name;
   		$data[] = $row->asset_tag;
   		$data[] = $row->property_tag;
			$data[] = $row->serial;
			 
   		$data[] = '<strong>' . $row->end_user . '</strong>';
			
			 $data[] = ($row->child_count>0?'<a href="javascript:void(0);" class="text-primary" data-id="'.$row->id.'" id="viewChild" data-type="childs">childs('.$row->child_count.')</a> ':'') . 
								($row->sibling_count>0?'<a href="javascript:void(0);" class="text-primary" data-id="'.$row->id.'" id="viewSib" data-type="siblings">siblings('.$row->sibling_count.')</a>':'');
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
	
	public function server_tbl_asset_siblings_listdown(){
		$result 	= $this->Table->getOutput('v_asset_report', ['id', 'parent', 'name', 'serial', 'asset_tag', 
																															'office_name', 'end_user', 'location_id', 'users_id', 'is_deleted', 'counter', 'last_name', 
																															'first_name', 'middle_name', 'designation', 'short', 'sibling', 'child_count', 
																															'sibling_count', 'property_tag', 'asset_category_name', 'status_id'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->name;
   		$data[] = $row->asset_tag;
   		$data[] = $row->property_tag;
			$data[] = $row->serial;
   		$data[] = '<strong>' . $row->end_user . '</strong>';
			$data[] = '';
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

	public function server_tbl_asset_childs_listdown(){
		$result 	= $this->Table->getOutput('v_asset_report', ['id', 'parent', 'name', 'serial', 'asset_tag', 
																															'office_name', 'end_user', 'location_id', 'users_id', 'is_deleted', 'counter', 'last_name', 
																															'first_name', 'middle_name', 'designation', 'short', 'sibling', 'child_count', 
																															'sibling_count', 'property_tag', 'asset_category_name', 'status_id'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->name;
   		$data[] = $row->asset_tag;
   		$data[] = $row->property_tag;
			$data[] = $row->serial;
   		$data[] = '<strong>' . $row->end_user . '</strong>';
			$data[] = '';
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
	

	public function server_history(){
		$result 	= $this->Table->getOutput('v_history_logs', ['id', 'description', 'asset_tag', 'current_custodian', 
																													'previous_custodian', 'current_location', 'previous_location', 
																													'created_at', 'updated_at', 'is_deleted'], ['id' => 'desc']);
		$res 			= array();
		$no 			= isset($_POST['start']) ? $_POST['start'] : 0;

		foreach ($result as $row) {
			$data = array();
			$no++;
   		$data[] = $row->id;
   		$data[] = $row->description;
   		$data[] = $row->asset_tag;
   		$data[] = $row->current_custodian;
   		$data[] = $row->previous_custodian;
   		$data[] = $row->current_location;
   		$data[] = $row->previous_location;
   		$data[] = $row->created_at;
   		$data[] = $row->updated_at;
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

	public function getDepartmentsFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('departments', array('is_deleted' => 0,'departments_id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-departments', $params);
	}
	
	public function getApproverFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('tbl_approver', array('is_deleted' => 0,'tbl_approver_id' => $this->input->post('id')))->row();
		$params['locations'] = $this->db->get_where('tbl_locations', array('is_deleted' => 0))->result();
		$params['users'] = $this->db->query("SELECT * FROM users WHERE is_deleted = 0 AND (level = 0 OR level = 1)")->result();
		$this->load->view('admin/settings/forms/frm-approver', $params);
	}
	
	public function getAssetCategoryFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('asset_category', array('is_deleted' => 0,'asset_category_id' => $this->input->post('id')))->row();
		$this->load->view('admin/settings/forms/frm-asset-category', $params);
	}
	
	public function getSelectAssetRepair(){
		$params['data'] = $this->db->get_where('tbl_asset', array('is_deleted' => 0,'asset_category_id' => $this->input->post('asset_category_id'), 'location_id' => $this->input->post('location_id')))->result();
		$this->load->view('admin/crud/asset-container-repair', $params);
	}
	
	public function getTblAssetRow(){
		$data			 									= $this->db->get_where('tbl_asset', array('is_deleted' => 0,'asset_tag' => $this->input->post('asset_tag')))->row();
		$users				 							= $this->db->get_where('users', array('users_id' => $data->checkout_user_id, 'is_deleted'=>0))->row();
		$childAsset 								= $this->db->get_where('tbl_child_asset', array('tbl_asset_id' => $data->id, 'is_deleted'=>0))->result();
		$params['serial'] 					= $data->serial;
		$params['property_tag'] 		= $data->property_tag;
		$params['checkout_user_id'] = !empty($users) ? $users->screen_name : '';
		if (count($childAsset) > 0) {
			$params['html'] = $this->load->view('admin/crud/multiple-select-child-asset', array('childAsset' => $childAsset), TRUE);	
		}
		echo json_encode($params);
	}

	public function getEditRepairRequest(){
		$id=$this->input->post('id');
		$q = $this->db->get_where('tbl_asset_repair_request', array('id'=>$id))->row();
		$q->date_reported = date('Y-m-d', strtotime($q->date_reported));
		echo json_encode(array('data'=>$q));
	}

	public function getEditReimbursementRequest(){
		$id							 = $this->input->post('id');
		$q 							 = $this->db->get_where('tbl_reimbursement_request', array('id'=>$id))->row();
		$q->date_filed 	 = date('Y-m-d', strtotime($q->date_filed));
		// $q->image_upload = explode(',', $q->image_upload);
		// $q->file_upload  = explode(',', $q->file_upload);
		echo json_encode($q);
	}

	public function getOfficeFrm(){
		$params['has_update'] = $this->input->post('id');
		$params['data'] = $this->db->get_where('office_management', array('is_deleted' => 0,'office_management_id' => $this->input->post('id')))->row();
		$params['dataDepartments'] = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/forms/frm-office', $params);
	}
	
	public function showMapScanned(){
		$params['lat'] = $this->input->post('lat');
		$params['lng'] = $this->input->post('lng');	
		$this->load->view('admin/crud/show-map', $params);
	}
	
	public function showAddTechNotes(){
		$params['id'] = $this->input->post('id');
		$this->load->view('admin/crud/show-notes-tech', $params);
	}

	public function saveTechNotes(){
		$id = $this->input->post('id');
		$q = $this->db->update('tbl_asset_repair_request', array('tech_notes'=>$this->input->post('tech_ndtes')), array('id'=>$id));
		$res = array();
		if ($q) {
			$res['param1'] = 'Success!';
			$res['param2'] = 'Successfully Saved!';
			$res['param3'] = 'success';
		} else {
			$res['param1'] = 'Opps!';
			$res['param2'] = 'Error Encountered Saved';
			$res['param3'] = 'warning';
		}
		echo json_encode($res);
	}
	
	public function showScannedUser(){
		$params['code'] = $this->input->post('code');
		$params['lat'] = $this->input->post('lat');
		$params['lng'] = $this->input->post('lng');
		$this->load->view('admin/crud/show-scanned', $params);
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

	public function view_departments(){
		$params['settDepartments'] = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-departments', $params);
	}
	
	public function view_approval(){
		$params['settDepartments'] = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-approval', $params);
	}
	
	public function view_asset_category(){
		$params['settDepartments'] = $this->db->get_where('departments', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-asset-category', $params);
	}

	public function view_office(){
		$params['settOffcMngmnt'] = $this->db->get_where('office_management', array('is_deleted' => 0))->result();
		$this->load->view('admin/settings/view-office', $params);
	}

	public function get_asset_category(){
		$id = $this->input->post('id');
		$params['assetCategory'] = $this->db->get_where('asset_category', array('asset_category' => $id, 'is_deleted' => 0))->result();
		$this->load->view('admin/crud2/get-select-asset-category-select', $params);
	}

	// public function getJson(){
	// 	header("Access-Control-Allow-Origin: *");
	// 	header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
	// 	header("Content-type: application/json charset=UTF-8");

	// 	$request_body = file_get_contents('php://input');
	// 	$requestData 	= json_decode($request_body);


	// }


}



