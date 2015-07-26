<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller
{
	private $data = array();
	public function __construct()
	 {
	 	parent::__construct();
	 	$this->load->model('profile_model');
	 	$this->data['error'] = "NO error";
	 }

	public function index()
	{

		//show_404();
		$user = $this->session->userdata('user_id');
		if(($this->session->userdata('user_name')!="")){
		$this->data = $this->profile_model->getUser($user);
		$this->data['title'] = "Your Profile";
		$this->data['edit'] = TRUE;
		$this->load->view('header_view',$this->data);
		$this->load->view('profile_view',$this->data);
		}
		else{
			redirect('login');
		}
		
	}
	/*this function is for uploading image*/
	public function see($user = FALSE)
	{
		if(!$user)
		{
			show_404();
			return;
		}
		else
		{
			$this->data = $this->profile_model->getUser($user);
			if(!($this->data))
			{
				show_404();
				return;
			}
			$this->data['title'] = "Search Profile";
			$this->data['edit'] = FALSE;
			$this->load->view('header_view',$this->data);
			$this->load->view('profile_view',$this->data);

		}

	}
	public function removeAvatar()
	{
		/*DELETE OLD IMAGE FROM UPLOADS FOLDER AS WELL AS FROM DATABASE!*/
		if($this->profile_model->deleteAvatar())
			echo  json_encode(array('v' => true));
		else
			echo json_encode(array('v' => false));
	}
	/*TO UPLOAD PROFILE PICTURE!*/
	public function do_upload()
	{
		$uid = $this->session->userdata('user_id');
		$config['file_name'] = time()."_".$uid;
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['overwrite'] = true;
		$config['max_size']	= '3000';
		$config['max_width']  = '5000';
		$config['max_height']  = '5000';

		$this->load->library('upload',$config);
		/*UNSUCESSFUL UPLOAD*/
		if(!$this->upload->do_upload())
		{
			$error_msg = $this->upload->display_errors();
			$this->setNotification($error_msg,"");
		}
		else
		/*SUCESS*/
		{
			/*DELETE OLD IMAGE FROM UPLOADS FOLDER AS WELL AS FROM DATABASWE!*/
			$this->profile_model->deleteAvatar();
			$sucess_msg = "PROFILE PHOTO UPLOADED SUCCESFULLY!";
			$img_data = $this->upload->data();
			$img_name= $img_data['file_name'];
			$this->profile_model->setAvatar($img_name);
			//echo "yo sucess<br>";
			$this->setNotification("",$sucess_msg);
		}
	}
	/*this function sets sessions that re used for notification in profile_view*/
	/*the redirects to profile*/
	private function setNotification($error="",$sucess="")
	{
		/*$this->data = $this->profile_model->getUser();*/
		if($error!="")
			$this->session->set_userdata("upload_error",$error);
		if($sucess!="")
			$this->session->set_userdata("upload_sucess",$sucess);
		redirect('profile','refresh');

	}
	public function jqueryRedirect()
	{
		$this->setNotification("","PROFILE HAS BEEN UPDATED SUCESSFULLY");
	} 
	public function updateData()
	{
		/*check if request is ajax*/
		if($this->input->is_ajax_request())
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_name', 'Name', 'trim|required|min_length[4]|xss_clean|max_length[20]|callback_alpha_space');
  			$this->form_validation->set_rules('email', ' Email', 'trim|required|valid_email');
  			$this->form_validation->set_rules('department', ' Department', 'trim|required');
  			$this->form_validation->set_rules('mobile_number', ' Mobile Number', 'trim|required|numeric|exact_length[10]');
  			$this->form_validation->set_rules('phone', 'Phone', 'trim|numeric');
  			$this->form_validation->set_rules('city', 'city', 'trim|alpha');
  			$this->form_validation->set_rules('state', 'state', 'trim|callback_alpha_space');
  			$this->form_validation->set_rules('country', 'country', 'trim|alpha');
  			$this->form_validation->set_rules('pin', 'Pin', 'trim|numeric|exact_length[6]');
  			if($this->form_validation->run() == FALSE){  
				echo json_encode(array("sucess"=>false,"errors"=>validation_errors()));
		}
		else{
			$this->profile_model->updateUser();
			echo json_encode(array("sucess"=>true));
		}
		}	

	}
	/*this is my own validation rule*/
	function alpha_space($str)
	{
		$this->form_validation->set_message('alpha_space', 'The %s field can contain only alphabets');
    	return ( ! preg_match("/^([-a-z ])+$/i", $str)) ? FALSE : TRUE;
	}

	
}

