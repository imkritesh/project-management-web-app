<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
	private $data = array();
	public function __construct()
	 {
	  parent::__construct();
	  $this->load->model('login_model');
	  $this->data['page'] = 'login';
	 }

	public function index()
	{
		if(($this->session->userdata('user_name')!=""))
  		{
   			$this->welcome();
  		}
		else
		{
			
			$this->load->view('login_view',$this->data);
		}		
	}
	public function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_id','User id','required');
		$this->form_validation->set_rules('user_name', 'Name', 'trim|required|min_length[4]|xss_clean');
  		$this->form_validation->set_rules('email', ' Email', 'trim|required|valid_email');
  		$this->form_validation->set_rules('department', ' Department', 'trim|required');
  		$this->form_validation->set_rules('mobile_number', ' Mobile Number', 'trim|required|numeric|exact_length[10]');
  		$this->form_validation->set_rules('gender',' Gender','required');
  		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  		$this->form_validation->set_rules('cpassword', 'Password Confirmation', 'trim|required|matches[password]');
  
  		if($this->form_validation->run() == FALSE)
  			{
  				$this->data['page'] = 'registration';
  	 			$this->index();
  			}
  		else
  			{
   			$this->login_model->add_user();
   			$sucess = "Your Account Has Been Created! Login to Proceed";
	  		$this->session->set_userdata("upload_sucess",$sucess);
			redirect('login','refresh');	 
  			}
	}
	public function logyouin()
	{
		//echo "LOGIN";
		$userid=$this->input->post('username');
  		$password=md5($this->input->post('pass'));
  		if(!isset($userid) || !isset($password) || empty($userid) || empty($password))
  		{
  			$this->data['empty_fields'] = 'true';
  			$this->data['page'] = 'login';
  			$this->index();
  			return;
  		}
  		$result=$this->login_model->login($userid,$password);
  		if($result) 
  			{
  				$this->welcome();
  				//$this->load->view('correct');
  			}
  		else {
  			$this->data['wrong_cred'] = 'true';
  			$this->data['page'] = 'login';
  			$this->index();
  		}


	}
	public function logout()
	 {
	  $newdata = array(
	  'user_id'   =>'',
	  'user_name'  =>'',
	  'user_email'     => '',
	  'logged_in' => FALSE,
	  );
	  	$this->session->unset_userdata($newdata);
	  	$this->session->sess_destroy();
		redirect('login','refresh');
	 }
	public function welcome()
	{
		redirect('profile');
		
	}
}

