<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$apiKey = "AIzaSyAixtb0KkjRuN4dXrKJmsmm2RcJSXXkFkQ";
		$registrationIDs = array("cfltqcKFRPI:APA91bHA73Us3Sczh3Lfwb3MPa2K5mlL6K1XdFvLtOWRtYxng0kL-wbpHm8jEXo7N_LWWcMKJSkwfirg_LGNTyu_6qR0K6esJAL960wK0ZSFHIywWdW66zoMbQMiMp1VK_Al-HyCB60W");
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
}
