<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model {
 public function __construct()
 {
  parent::__construct();
 }
 public function add_user()
 {
 	$data = array(
 		'user_id' => $this->input->post('user_id'),
 		'user_name' => ucwords(strtolower($this->input->post('user_name'))),
 		'password' => md5($this->input->post('password')),
 		'email' => $this->input->post('email'),
 		'mobile' => $this->input->post('mobile_number'),
 		'department' => $this->input->post('department'),
 		'gender' =>$this->input->post('gender')
 		);
 	$this->db->insert('user',$data);

 }
 public function login($user_name,$password)
 {
 	//log_message("LOGIN FUNCTION");
 	if(empty($user_name) || empty($password))
 		return false;
 	$this->db->where("user_id",$user_name);
 	$this->db->where("password",$password);   
    
 	$query = $this->db->get("user");
 	if($query->num_rows()>0){
 		foreach ($query->result() as $rows) {
 			$newdata = array(
 				'user_id' => $rows->user_id,
 				'user_name' => $rows->user_name,
 				'user_email' => $rows->email,
 				'logged_in' => TRUE,
 				);
 		}
 		$this->session->set_userdata($newdata);
   		return true;
 	}
 	return false;
 }
 /*public function getUser()
 {
 	$uid = $this->session->userdata('user_id');
 	$this->db->where("user_id",$uid);
 	$query = $this->get("user");
 	foreach ($query->result() as $rows) {
 		$userdata = array(
 			'name'=>$rows->user_name,
 			'user_id'=>$rows->user_id,
 			'email'=>$rows->email,
 			'department'=>$rows->department,
 			'mobile'=>$rows->mobile,
 			'phone'=>$rows->phone,
 			'gender'=>$rows->gender,
 			'add1'=>$rows->address1,
 			'add2'=>$rows->address2,
 			'city'=>$rows->city,
 			'state'=>$rows->state,
 			'pin'=>$rows->pin,
 			'country'=>$rows->country,
 			'avatar'=>$rows->avatar
 			);
 	}
 	return $userdata;
 }*/
}
?>