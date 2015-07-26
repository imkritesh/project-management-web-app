<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile_model extends CI_Model {
 public function __construct()
 {
    parent::__construct();
 
 }
 public function getUser($uid)
 {
 	//$uid = $this->session->userdata('user_id');
 	$this->db->where("user_id",$uid);
 	$db_debug = $this->db->db_debug;
	//$this->db->db_debug = false;

	$query = $this->db->get("user");
	if(!$query)	
	{
		//$this->db->db_debug = $db_debug;
		return FALSE;
	}
	else
	{
		$userdata =  array();
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
 	}
 }
 public function updateUser()
 {
 	$phone = $this->input->post('phone');
 	$add1 = $this->input->post('add1');
 	$add2 = $this->input->post('add2');
 	$city = $this->input->post('city');
 	$state = $this->input->post('state');
 	$pin = $this->input->post('pin');
 	$country = $this->input->post('country');
 	if(empty($pin))
 		$pin = NULL;

 	$data = array(
 		'user_name' => ucwords(strtolower($this->input->post('user_name'))),
 		'email' => $this->input->post('email'),
 		'mobile' => $this->input->post('mobile_number'),
 		'department' => $this->input->post('department'),
 		'phone'=> $phone,
 		'address1'=>$add1,
 		'address2'=>$add2,
 		'city'=>$city,
 		'state'=>$state,
 		'pin'=>$pin,
 		'country'=>$country,
 		);
 	$this->db->where('user_id',$this->session->userdata("user_id"));
 	$this->db->update('user',$data);

 }
 public function deleteAvatar()
 {
 	$query = $this->db->get_where("user",array("user_id"=>$this->session->userdata("user_id")));
 	foreach ($query->result() as $rows) 
 		$img = $rows->avatar;
 	$this->db->where('user_id',$this->session->userdata("user_id"));
 	$this->db->update('user',array('avatar' => NULL));
 	#echo $img."<br>";
 	if($img)
 	{
 		if(unlink('uploads/'.$img))
 		{ 			
 			return true;
 		}
 		else
 			return false;
 	} 
 }
 public function setAvatar($img_name)
 {
 	$uid = $this->session->userdata('user_id');
 	$this->db->where("user_id",$uid);
 	$data = array(
        'avatar' => $img_name
	);
 	$this->db->update("user",$data);
 }
}
?>