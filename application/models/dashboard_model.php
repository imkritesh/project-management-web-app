<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model {
 public function __construct()
 {
    parent::__construct();
 
 }
 public function post_chat_msg($msg)
 {
 	$date = new DateTime();
 	$data = array(
 	'msg' => $msg,
 	'user_id' => $this->session->userdata('user_id'),
 	'posted_on' => $date->format('Y-m-d H:i:s'),
 	'dp' => $this->session->userdata('avatar')
 	);
 	$this->db->insert('chat',$data);
 }
 public function get_chat_messages()
 {
 	$ci = $this->input->post('chat_id');
 	$this->db->where("chat_id > $ci");
 	$query = $this->db->get("chat");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();	
 }
 public function getProject($project_id)
 {
 	$this->db->where("project_id",$project_id);
 	$db_debug = $this->db->db_debug;
	//$this->db->db_debug = false;

	$query = $this->db->get("project");
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
 			'name'=>$rows->name,
 			'start_date'=>$rows->start_dt,
 			'end_date'=>$rows->end_dt,
 			'description'=>$rows->desc,
 			'budget'=>$rows->budget,
 			);
 	}
 	return $userdata;
 	}
 }

 public function project_submit()
 {
 	$data = array(
 		'name' => ucwords(strtolower($this->input->post('project_name'))),
 		'desc' => $this->input->post('project_desc'),
 		'start_dt' => $this->input->post('start_date'),
 		'status' => 'S',//S-start F-finish
 		'user_id'=>$this->session->userdata('user_id') ,
 		'budget' => $this->input->post('budget')
 		);
 	$this->db->insert('project',$data);
 }
 public function milestone_submit()
 {
 	$data = array(
 		'project_id' => $this->input->post('project_id'),
 		'name' => ucwords(strtolower($this->input->post('milestone_name'))),
 		'desc'=> $this->input->post('milestone_desc'),
 		'start_dt' => $this->input->post('start_date'),
 		'end_dt' => $this->input->post('end_date'),//S-start F-finish
 		'status'=>'S'//S-start F-finish
 		);
 	$this->db->insert('milestones',$data);
 }
 public function tasklist_submit()
 {
 	$data =  array('name' => ucwords(strtolower($this->input->post('tasklist_name'))),
 		'desc' => $this->input->post('tasklist_desc'),
 		'status' => 'S',
 		'mile_id' => $this->input->post('milestone_id'),
 		'project_id' => $this->input->post('project_id')
 		);
 	$this->db->insert('tasks_list',$data);
 }
 public function task_submit()
 {
 	$data =  array('name' => ucwords(strtolower($this->input->post('task_name'))),
 		'desc' => $this->input->post('task_desc'),
 		'status' => 'S',
 		'start_dt' => $this->input->post('start_date'),
 		'project_id' => $this->input->post('project_id'),
 		'mile_id' => $this->input->post('milestone_id'),
 		'tasklist_id' => $this->input->post('tasklist_id')
 		);
 	$this->db->insert('tasks',$data);
 }
 public function assign_task_submit()
 {
 	$data = array('project_id' => $this->input->post('project_id'), 
 		'mile_id' => $this->input->post('milestone_id'), 
 		'tasklist_id' => $this->input->post('tasklist_id'), 
 		'task_id' => $this->input->post('task_id'), 
 		'user_id' => $this->input->post('user_id')
 		);
 	$db_debug = $this->db->db_debug;
	$this->db->db_debug = false;
	if(!$this->db->insert('task_assigned',$data))
		$x = false;
	else
		$x = true;
	$this->db->db_debug = $db_debug;
 	return $x;
 }
 public function mark_task_done($task_id,$date)
 {
 	$data = array('status' => 'F','end_dt' => $date);
 	$this->db->where('task_id',$task_id);
 	if($this->db->update('tasks',$data))
 		return true;
 	else
 		return false;
 }
 public function mark_task_undone($task_id)
 {
 	$data = array('status' => 'S','end_dt' => NULL);
 	$this->db->where('task_id',$task_id);
 	if($this->db->update('tasks',$data))
 		return true;
 	else
 		return false;
 }
 public function get_projects()
 {
 	$uid = $this->session->userdata('user_id');
 	$this->db->where("user_id",$uid);
 	$query = $this->db->get("project");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 	
 }
 public function get_milestones()
 {
 	$query = $this->db->get("milestones");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 	
 }
 public function get_tasklists()
 {
 	$query = $this->db->get("tasks_list");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 }
 public function get_tasks()
 {
 	$query = $this->db->get("tasks");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 }
 public function get_project_tasks($project_id,$start_date,$end_date)
 {
 	$this->db->where('status','F');
 	$this->db->where('project_id',$project_id);
 	$this->db->where("(start_dt, end_dt) OVERLAPS ('$start_date'::DATE, '$end_date'::DATE)");
 	$query = $this->db->get('tasks');

 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();

 }
 public function get_user_tasks($user_id,$start_date,$end_date)
 {
 	$this->db->select('task_id');
 	$this->db->where('user_id',$user_id);
 	$this->db->get('task_assigned');
 	$sub_query = $this->db->last_query();
 	$this->db->where('status','F');
 	$this->db->where("(start_dt, end_dt) OVERLAPS ('$start_date'::DATE, '$end_date'::DATE)");
 	$this->db->where("task_id IN($sub_query)");
 	$query = $this->db->get('tasks');

 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 }
 public function get_task_assigned()
 {
 	$query = $this->db->get("task_assigned");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 }
 public function get_task_assigned_to_me()
 {
 	$this->db->select('task_id');
 	$this->db->where('user_id',$this->session->userdata('user_id'));
 	$this->db->get('task_assigned');
 	$sub_query = $this->db->last_query();

 	$this->db->where("task_id IN($sub_query)");
 	$query = $this->db->get('tasks');

 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();
 }
 
 public function get_users()
 {
 	$query = $this->db->get("user");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();	
 }
 public function get_project_assigned()
 {
 	$query = $this->db->get("project_assigned");
 	if($query->num_rows>0)
 		return $query->result_array();
 	else
 		return array();	
 }
 public function add_project_assigned()
 {
 	$data = array('user_id' => $this->input->post('user_id'),
 	'project_id'=> $this->input->post('project_id')); 
 	$db_debug = $this->db->db_debug;
	$this->db->db_debug = false;
	if(! $this->db->insert('project_assigned',$data))
		$x = false;
	else
		$x = true;
	$this->db->db_debug = $db_debug;
	return $x;
 }

}