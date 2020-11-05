<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';

class MY_Controller extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}

	public function adminContainer($data, $param = array(), $return = FALSE){
		if(!$this->session->userdata('users_id')){
		  redirect('login');
		}
		$param['go_logout'] = 'logout';
		$param['logged_in'] 	 = $this->db->get_where('users', array('users_id' => $this->session->users_id))->row();
		$this->load->view('partials/adminHdr', $param);
		$this->load->view('partials/adminNav', $param);
		$this->load->view($data, $param, $return);
		$this->load->view('partials/adminFtr');	
	}
	
	public function customContainer($data, $param = array(), $return = FALSE){
		// if(!$this->session->userdata('users_id')){
		//   redirect('login');
		// }
		// $param['go_logout'] = 'logout';
		// $param['logged_in'] 	 = $this->db->get_where('users', array('users_id' => $this->session->users_id))->row();
		$this->load->view('partials/adminHdr', $param);
		// $this->load->view('partials/adminNav', $param);
		$this->load->view($data, $param, $return);
		$this->load->view('partials/adminFtr');	
	}

	function encdec( $string, $action) {
    // you may change these values to your own
    $secret_key = '5ad44e8a7dc00132ea2c93add9aefadb';
    $secret_iv = '5ad44e8a7dc00132ea2c93add9aefadb';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
    return $output;
	}
	
	public function sendEmail($from, $email, $subject, $message, $title){
    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.cpfi-webapp.com',
      'smtp_port' => 2083,
      'smtp_user' => 'manage_account@cpfi-webapp.com', 
      'smtp_pass' => 'OuPqjDymP#4V', 
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      // 'charset' => 'utf-8',
      'wordwrap' => TRUE
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->set_header('MIME-Version', '1.0; charset=utf-8'); //must add this line
		$this->email->set_header('Content-type', 'text/html'); //must add this line
		$this->email->from($from, $title);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);
		// $this->email->attach('C:\Users\xyz\Desktop\images\abc.png');
		if($this->email->send()){
			// echo 'Email send.';
		} else {
			show_error($this->email->print_debugger());
		}
  }

  function convertIntegerToWords($x) {
        $w = '';
    $nwords = array('ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN',
                         'EIGHT', 'NINE', 'TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN',
                         'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN',
                         'NINETEEN', 'TWENTY', 30 => 'THIRTY', 40 => 'FORTY',
                         50 => 'FIFTY', 60 => 'SIXTY', 70 => 'SEVENTY', 80 => 'EIGHTY',
                         90 => 'NINETY' );

         if(!is_numeric($x)) {
             $w = '#';
         } else if(fmod($x, 1) != 0) {
             $w = '#';
         } else {
             if($x < 0) {
                 $w = 'MINUS ';
                 $x = -$x;
             } else {
                 $w = '';
             }

             if($x < 21) {
                 $w .= $nwords[$x];
             } else if($x < 100) {
                    $w .= $nwords[10 * floor($x/10)];
                    $r = fmod($x, 10);
                    if($r > 0) {
                      $w .= '-'. $nwords[$r];
                    }
             } else if($x < 1000) {
                 $w .= $nwords[floor($x/100)] .' HUNDRED';
                 $r = fmod($x, 100);
                 if($r > 0) {
                     // $w .= ' and '. $this->convertIntegerToWords($r);
                     $w .= ' '. $this->convertIntegerToWords($r);
                 }
             } else if($x < 1000000) {
                 $w .= $this->convertIntegerToWords(floor($x/1000)) .' THOUSAND';
                 $r = fmod($x, 1000);
                 if($r > 0) {
                     $w .= ' ';
                     if($r < 100) {
                         $w .= 'AND ';
                     }
                     $w .= $this->convertIntegerToWords($r);
                 }
             } else {
                 $w .= $this->convertIntegerToWords(floor($x/1000000)) .' MILLION';
                 $r = fmod($x, 1000000);
                 if($r > 0) {
                        $w .= ' ';
                        if($r < 100) {
                            $word .= 'AND ';
                        }
                        $w .= $this->convertIntegerToWords($r);
                 }
             }
            }
        return $w;
    }

    function convertNumber($number) {
        $out = '';
        $currencylabelsarray = array('PESO/S' => 'PESOS/S', 'CENTAVO/S' => 'CENTAVO/S');
        if(!is_numeric($number)) return false;
        $nums = explode('.', $number);
        $out = $this->convertIntegerToWords($nums[0]) . ' PESO/S';
        if(isset($nums[1])) {
        $out .= ' AND ' . $this->convertIntegerToWords((is_string($nums[1]) ? (int) $nums[1] : $nums[1])) .' CENTAVO/S';
        }
        return ucwords($out);
		}
		
		function convertNumberWithourCurrency($number) {
        $out = '';
        // $currencylabelsarray = array('PESO/S' => 'PESOS/S', 'CENTAVO/S' => 'CENTAVO/S');
        if(!is_numeric($number)) return false;
        $nums = explode('.', $number);
        $out = $this->convertIntegerToWords($nums[0]);
        if(isset($nums[1])) {
        $out .= ' AND ' . $this->convertIntegerToWords((is_string($nums[1]) ? (int) $nums[1] : $nums[1]));
        }
        return ucwords($out);
    }

		
		public function uploadImage($id, $field_id, $tbl){
			$config['upload_path'] 		= './assets/image/uploads';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']  			= 0; // any size
			$config['remove_spaces']	= true;
			// $id 											= $this->input->post('asset_id');
			$this->load->library('upload', $config);
			$this->load->library('image_lib');
			if (!$this->upload->do_upload('image')) {
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
	
				$chkExisting    = $this->db->get_where($tbl, array($field_id => $id))->result();
				if ($chkExisting) {
					$this->db->update($tbl, array('image'=> $dImg['file_name']), array($field_id => $id));
				} else {
					$this->db->insert($tbl, array('image'=> $dImg['file_name']));	
				}
				$data['file_name'] = $dImg['file_name'];
				$data['success'] = true;
			}
			// echo json_encode($data);
		}

		public function generateQR($id){
			if (!empty($_POST['tbl_asset_id'])) {
				$encId 		  	= $this->encdec($id, 'e');
				$apiKey       = "c7ed8171ec916e31a875e77c159efea7";
				$apiUrl       = "https://philsys.qrd.by/api";
				$action       = "short";
				$url          = base_url() . "get-assets-child/" . $encId . '&gps=1';
				$jsonurl      = "$apiUrl/$action?key=$apiKey&url=$url";
				$json         = file_get_contents($jsonurl, 0, null, null);
				$json_output  = json_decode($json);
				$json_encoded = json_encode($json_output);
				$code         = explode('/', $json_output->result->qr);
				return $this->db->insert('tbl_qrcodes', array(
																									'child_asset_id' => $id,
																									'qr_code'  => $json_encoded,
																									'code'     => $code[4],
																								));
			} else {
				$encId 		  	= $this->encdec($id, 'e');
				$apiKey       = "c7ed8171ec916e31a875e77c159efea7";
				$apiUrl       = "https://philsys.qrd.by/api";
				$action       = "short";
				$url          = base_url() . "get-assets/" . $encId . '&gps=1';
				$jsonurl      = "$apiUrl/$action?key=$apiKey&url=$url";
				$json         = file_get_contents($jsonurl, 0, null, null);
				$json_output  = json_decode($json);
				$json_encoded = json_encode($json_output);
				$code         = explode('/', $json_output->result->qr);
				return $this->db->insert('tbl_qrcodes', array(
																									'asset_id' => $id,
																									'qr_code'  => $json_encoded,
																									'code'     => $code[4],
																								));
			}
		}

		public function generateQRChecklist($id){
				$encId 		  	= $this->encdec($id, 'e');
				$apiKey       = "2bbd756624aaeee7945627b397b832bb";
				$apiUrl       = "https://philsys.qrd.by/api";
				$action       = "short";
				$url          = base_url() . "scanned-checklist/" . $encId . '&gps=1';
				$jsonurl      = "$apiUrl/$action?key=$apiKey&url=$url";
				$json         = file_get_contents($jsonurl, 0, null, null);
				$json_output  = json_decode($json);
				$code         = explode('/', $json_output->result->qr);
				$checkListData = $this->db->query("SELECT count(*) as count_per_prov, province FROM tbl_asset_checklist WHERE location_id = $id")->row();
				$json_output->result->shorturl = 'https://philsys.qrd.by/'.$code[4].'?q=' . $checkListData->count_per_prov . '&l=' . $checkListData->province;
				$json_encoded = json_encode($json_output);

				$existingQr   = $this->db->query("SELECT * FROM tbl_qrcodes_checklist WHERE location_id = $id ORDER BY id DESC LIMIT 1")->row();
				if ($existingQr->received_by == '' || $existingQr->date_received == '') {
					return $this->db->update('tbl_qrcodes_checklist', array(
																															'location_id' => $id,
																															'qr_code'  		=> $json_encoded,
																															'code'    	 	=> $code[4],
																														), array('id' => $existingQr->id));
				} else {
					return $this->db->insert('tbl_qrcodes_checklist', array(
																															'location_id' => $id,
																															'qr_code'  		=> $json_encoded,
																															'code'    	 	=> $code[4],
																														));
				}
		}

		public function save_action_logs($data){
			return $this->db->insert('tbl_action_logs', $data);
		}
		
		public function save_history_logs($data){
			return $this->db->insert('tbl_history', $data);
		}
        
		public function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
			$theta 			= $lon1 - $lon2;
			$miles 			= (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
			$miles 			= acos($miles);
			$miles 			= rad2deg($miles);
			$miles 			= $miles * 60 * 1.1515;
			$feet	 			= $miles * 5280;
			$yards 			= $feet / 3;
			$kilometers = $miles * 1.609344;
			$meters 		= $kilometers * 1000;
			return compact('miles','feet','yards','kilometers','meters'); 
			
		}
	
		public function createPdf($data, $param = array()){
			$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch', 'setAutoBottomMargin' => 'stretch']);
			$logoFileName1 = base_url() . "/assets/image/misc/psa-logo.png";
   		$logoFileName2 = base_url() . "/assets/image/misc/footer-trans.png";
			$ht = $this->load->view($data, $param, TRUE);
			$mpdf->defaultheaderline = 0;
			$mpdf->defaultfooterline = 0;
			$mpdf->SetHeader('<img src="'.$logoFileName1.'" width="580" style="float:left;margin-bottom:20px;">');
			$mpdf->SetFooter('<img src="'.$logoFileName2.'" width="320" style="float:left;margin-top:20px;">');	
			$mpdf->WriteHTML($ht);
			$mpdf->Output();
		}

		public function generatePdf($data, $param = array()){
			$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
			$fontDirs = $defaultConfig['fontDir'];
			$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
			$fontData = $defaultFontConfig['fontdata'];
			$mpdf = new \Mpdf\Mpdf([
								'fontDir' => array_merge($fontDirs, [
									__DIR__ . '/fonts',
							]),
							'fontdata' => $fontData + [
								'quicksand' => [
										'R' => 'Quicksand-Regular.ttf',
										'I' => 'Quicksand-Bold.ttf'
								],
								'serif' => [
									'R' => 'OpenSans-Regular.ttf',
									'I' => 'OpenSans-Semibold.ttf'
								],
								'arial' => [
									'R' => 'ArialCE.ttf',
									'I' => 'ArialCEItalic.ttf'
								]
							],
							'default_font' => 'arial'
						]);
			$logoFileName1 = base_url() . "/assets/image/misc/psa-logo.png";
   		$logoFileName2 = base_url() . "/assets/image/misc/footer-trans.png";
			$ht = $this->load->view($data, $param, TRUE);
			$mpdf->defaultheaderline = 0;
			$mpdf->defaultfooterline = 0;
			// $mpdf->SetHeader('<img src="'.$logoFileName1.'" width="580" style="float:left;margin-bottom:20px;">');
			// $mpdf->SetFooter('<img src="'.$logoFileName2.'" width="320" style="float:left;margin-top:20px;">');	
			$mpdf->WriteHTML($ht);
			$mpdf->Output();
		}

		public function createPdfTransmitalSummary($data, $param = array()){
			$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
			$fontDirs = $defaultConfig['fontDir'];
			$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
			$fontData = $defaultFontConfig['fontdata'];
			$mpdf = new \Mpdf\Mpdf([
								'fontDir' => array_merge($fontDirs, [
									__DIR__ . '/fonts',
							]),
							'setAutoTopMargin' 		=> 'stretch', 
							'setAutoBottomMargin' => 'stretch',
							'fontdata' => $fontData + [
								'quicksand' => [
										'R' => 'Quicksand-Regular.ttf',
										'I' => 'Quicksand-Bold.ttf'
								],
								'serif' => [
									'R' => 'OpenSans-Regular.ttf',
									'I' => 'OpenSans-Semibold.ttf'
								],
								'arial' => [
									'R' => 'ArialCE.ttf',
									'I' => 'ArialCEItalic.ttf'
								]
							],
							'default_font' => 'arial'
						]);
			$mpdf->SetTitle('Checklist');
			$logoFileName1 = base_url() . "/assets/image/misc/psa-logo.png";	
			$logoFileName2 = base_url() . "/assets/image/misc/footer-trans.png";
			// $param['page_no'] = '{PAGENO} of {nbpg}';
			// {nbpg} which prints the total number of pages considering page 
			$param['intToWords'] = function($int){ return $this->convertNumberWithourCurrency($int); };
			$ht = $this->load->view($data, $param, TRUE);
			$ht2 = $this->load->view('admin/crud/regkits-summary', $param, TRUE);
			// $header = $this->load->view('partials/checkListHeader', $param, TRUE);
			$mpdf->defaultheaderline = 0;
			$mpdf->defaultfooterline = 0;
			// $mpdf->SetHeader($header);
			// $mpdf->SetHeader('<img src="'.$logoFileName1.'" width="580" style="float:left;margin-bottom:20px;">');
			$mpdf->WriteHTML($ht);
			$mpdf->SetFooter('<img src="'.$logoFileName2.'" width="320" style="float:left;margin-top:20px;">');	

			$mpdf->AddPage('L','','1','i','on');
			$mpdf->WriteHTML($ht2);
			$mpdf->SetFooter();	
			$mpdf->Output();
		}

		public function createPdfWOHeadFoot($data, $param = array()){
			$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
			$fontDirs = $defaultConfig['fontDir'];

			$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
			$fontData = $defaultFontConfig['fontdata'];
			$mpdf = new \Mpdf\Mpdf([
								'fontDir' => array_merge($fontDirs, [
									__DIR__ . '/fonts',
							]),
							'setAutoTopMargin' 		=> 'stretch', 
							'setAutoBottomMargin' => 'stretch',
							'fontdata' => $fontData + [
								'quicksand' => [
										'R' => 'Quicksand-Regular.ttf',
										'I' => 'Quicksand-Bold.ttf'
								],
								'serif' => [
									'R' => 'OpenSans-Regular.ttf',
									'I' => 'OpenSans-Semibold.ttf'
								],
								'arial' => [
									'R' => 'ArialCE.ttf',
									'I' => 'ArialCEItalic.ttf'
								]
							],
							'default_font' => 'arial'
						]);
			$mpdf->SetTitle('Checklist');
			$logoFileName1 = base_url() . "/assets/image/misc/psa-logo.png";	
			$logoFileName2 = base_url() . "/assets/image/misc/footer-trans.png";
			// $param['page_no'] = '{PAGENO} of {nbpg}';
			// {nbpg} which prints the total number of pages considering page 
			$ht = $this->load->view($data, $param, TRUE);
			// $header = $this->load->view('partials/checkListHeader', $param, TRUE);
			$mpdf->defaultheaderline = 0;
			// $mpdf->defaultfooterline = 0;
			// $mpdf->SetHeader($header);
			// $mpdf->SetFooter('<img src="'.$logoFileName2.'" width="320" style="float:left;margin-top:20px;">');	
			$mpdf->WriteHTML($ht);
			$mpdf->Output();
		}

		public function upload_image($name){
			$config['upload_path'] 		= './assets/image/uploads';
			$config['allowed_types'] 	= '*';
			$config['max_size']  			= 0; // any size
			$config['remove_spaces']	= true;
			// $id 											= $this->input->post('asset_id');
			$this->load->library('upload', $config);
			// $this->load->library('image_lib');
			$data = [];
			if (!$this->upload->do_upload($name)) {
				$data['error']	 = array('error' => $this->upload->display_errors());
				$data['success'] = false;
			} else {
				$dImg = $this->upload->data();
				$data['file_name'] = $dImg['file_name'];
				$data['success'] = true;
			}
			return $data;
		}

		public function upload_file($name){
			$config['upload_path'] 		= './assets/image/uploads';
			$config['allowed_types'] 	= '*';
			$config['max_size']  			= 0; // any size
			$config['remove_spaces']	= true;
			// $id 											= $this->input->post('asset_id');
			$this->load->library('upload', $config);
			// $this->load->library('image_lib');
			$data = [];
			if (!$this->upload->do_upload($name)) {
				$data['error']	 = array('error' => $this->upload->display_errors());
				$data['success'] = false;
			} else {
				$dImg = $this->upload->data();
				$data['file_name'] = $dImg['file_name'];
				$data['success'] = true;
			}
			return $data;
		}

		function check_url($url) {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			$headers = curl_getinfo($ch);
			curl_close($ch);
	
			return $headers['http_code'];
	}

}