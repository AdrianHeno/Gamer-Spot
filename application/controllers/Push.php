<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends CI_Controller {
	
	function __construct()
	{
	    parent::__construct();
	    $this->load->model('Push_registration_model');
	    $this->load->library(array('ion_auth','form_validation'));
	}

	public function index()
	{
		$apiKey = "AIzaSyAixtb0KkjRuN4dXrKJmsmm2RcJSXXkFkQ";
		$getRegistrationIDs = $this->Push_registration_model->get_all_by_user_id(1);
		$registrationIDs = array();
		foreach($getRegistrationIDs as $registrationID){
			$registrationIDs[] = $registrationID;
		}
		
		$message = "testing Process";
		$url = 'https://android.googleapis.com/gcm/send';
		$fields = array(
				'registration_ids'  => $registrationIDs,
				'data'              => array("message"=>$message),
				);
		$headers = array( 
				'Authorization: key=' . $apiKey,
				'Content-Type: application/json'
				);
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode($fields) );
		
		$result = curl_exec($ch);
		if(curl_errno($ch)){ echo 'Curl error: ' . curl_error($ch); }
		curl_close($ch);
		echo $result;
	}
	//Record that the user has registered for push notifications and record their push id
	public function register($registration_id){
		$user = $this->ion_auth->user()->row();
		$data = array(
			'user_id' => $user->id,
			'push_registration_id' => $registration_id,
			#'created_date' => $this->input->post('created_date',TRUE),
		);

		$this->Push_registration_model->insert($data);
	}
	
	//Delete users push id
	//ToDo only delete the id for that device? or all?
	public function delete($id) 
	{
	    $row = $this->Push_registration_model->get_by_id($id);
    
	    if ($row) {
		$this->Push_registration_model->delete($id);
		return true;
	    } else {
		return false;
	    }
	}
}
