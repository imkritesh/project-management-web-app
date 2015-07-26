<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	private $data = array();
	public function __construct()
	 {
	 	parent::__construct();
	 	$this->load->model('dashboard_model');
	 	$this->load->library('form_validation');
	 	//$this->data['error'] = "NO error";
	 }

	public function index($x=0)
	{
		if(($this->session->userdata('user_name')!="")){
		//$this->data = $this->profile_model->getUser();
		$this->data['title'] = "Dashboard";
		$this->data['projects'] = $this->dashboard_model->get_projects();
		$this->data['tasks'] = $this->dashboard_model->get_task_assigned_to_me();
		$this->data['all_tasks'] = $this->dashboard_model->get_tasks();
		$this->data['users'] = $this->dashboard_model->get_users();
		$this->data['x'] = $x;
		$this->load->view('header_view',$this->data);
		$this->load->view('dashboard_view',$this->data);
		}
		else{
			redirect('login');
		}
		
	}
	private function setNotification($error="",$sucess="")
	{
		/*$this->data = $this->profile_model->getUser();*/
		if($error!="")
			$this->session->set_userdata("upload_error",$error);
		if($sucess!="")
			$this->session->set_userdata("upload_sucess",$sucess);
		redirect('dashboard','refresh');

	}
	public function jqueryRedirect()
	{
		$this->setNotification("","PROJECT HAS BEEN ADDED SUCESSFULLY");
	} 
	public function reportUser()
	{
		$this->form_validation->set_rules('start_date', ' Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', ' End Date', 'trim|required');
		$this->form_validation->set_rules('user_id','User Name','trim|required');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		else{
			//$this->load->helper(array('dompdf', 'file'));
			$this->load->model('profile_model');
			$data['title'] = "User Report";
			$user_id = $this->input->post('user_id');
			$data['start_date'] = $this->input->post('start_date');
			$data['end_date'] = $this->input->post('end_date');
			$data['user'] = $this->profile_model->getUser($user_id);
			$data['tasks'] = $this->dashboard_model->get_user_tasks($user_id,$data['start_date'],$data['end_date']);

			$this->load->view('header_view',$data);
			$html = $this->load->view('user_report_view',$data);
			//pdf_create($html, 'user');

		}
	}
	public function reportProject()
	{
		$this->form_validation->set_rules('start_date', ' Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', ' End Date', 'trim|required');
		$this->form_validation->set_rules('project_id','Project Name','trim|required');
		if($this->form_validation->run() == FALSE){
			$this->index(1);
		}
		else{
			//$this->load->helper(array('dompdf', 'file'));
			$this->load->model('profile_model');
			$data['title'] = "User Report";
			$project_id = $this->input->post('project_id');
			$data['start_date'] = $this->input->post('start_date');
			$data['end_date'] = $this->input->post('end_date');
			$data['project'] = $this->dashboard_model->getProject($project_id);
			$data['tasks'] = $this->dashboard_model->get_project_tasks($project_id,$data['start_date'],$data['end_date']);

			$this->load->view('header_view',$data);
			$html = $this->load->view('project_report_view',$data);
			//pdf_create($html, 'user');

		}
	}
	public function chat_msg()
	{
		$msg = $this->input->post('msg');
		if(empty($msg))
			echo json_encode(array('status' => false));
		else
		{
			$this->dashboard_model->post_chat_msg($msg);
			echo json_encode(array('status' => true));
		}

	}
	public function get_messages()
	{
		if($this->input->is_ajax_request())
			echo json_encode($this->dashboard_model->get_chat_messages());
		else 
			show_404();
	}
	public function project_submit()
	{
		if($this->input->is_ajax_request())
		{
			//$this->load->library('form_validation');
			$this->form_validation->set_rules('project_name', 'Project Name', 'trim|required|min_length[4]|xss_clean|max_length[20]');
	  		$this->form_validation->set_rules('project_desc', ' Project Description', 'required');
	  		$this->form_validation->set_rules('start_date', ' Start Date', 'trim|required');
	  		$this->form_validation->set_rules('budget', 'Budget', 'trim|required|numeric');
	  		if($this->form_validation->run() == FALSE){  
	  			echo json_encode(array("sucess"=>false,"errors"=>validation_errors()));
			}
			else{
				 $this->dashboard_model->project_submit();
				echo json_encode(array("sucess"=>true));
			}
		}
		else
		{
			show_404();
		}
	}
	public function milestone_submit()
	{
		if($this->input->is_ajax_request())
		{
			//$this->load->library('form_validation');
			$this->form_validation->set_rules('milestone_name', 'Milestone Name', 'trim|required|min_length[4]|xss_clean|max_length[20]');
	  		$this->form_validation->set_rules('milestone_desc', ' Milestone Description', 'required');
	  		$this->form_validation->set_rules('start_date', ' Start Date', 'trim|required');
	  		//$this->form_validation->set_rules('end_date', ' End Date', 'trim|required');
	  		if($this->form_validation->run() == FALSE){  
	  			echo json_encode(array("sucess"=>false,"errors"=>validation_errors()));
			}
			else
			{
				$this->dashboard_model->milestone_submit();
				echo json_encode(array("sucess"=>true));
			}
		}
		else
		{
			show_404();
		}
	}
	public function tasklist_submit()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('project_id', 'Milestone Name', 'trim|required|numeric');
		  	$this->form_validation->set_rules('milestone_id', ' Milestone ', 'required|numeric');
		  	$this->form_validation->set_rules('tasklist_name', ' Tasklist Name', 'trim|required');
		  	$this->form_validation->set_rules('tasklist_desc', ' TaskList Description', 'trim|required');
		  	if($this->form_validation->run() == FALSE){  
		  			echo json_encode(array("sucess"=>false,"errors"=>validation_errors()));
				}
				else{
					$this->dashboard_model->tasklist_submit();
					echo json_encode(array('sucess' =>true));
				}
		}
		else
		{
			show_404();
		}
	}
	public function task_submit()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('project_id', 'Project', 'trim|required|numeric');
		  	$this->form_validation->set_rules('milestone_id', ' Milestone ', 'required|numeric');
		  	$this->form_validation->set_rules('tasklist_id', ' Tasklist ', 'required|numeric');
		  	$this->form_validation->set_rules('task_name', ' Task Name', 'trim|required');
		  	$this->form_validation->set_rules('task_desc', ' Task Description', 'trim|required');
		  	$this->form_validation->set_rules('start_date', 'Start Date', 'required|trim');
		  	
		  	if($this->form_validation->run() == FALSE){  
		  			echo json_encode(array("sucess"=>false,"errors"=>validation_errors()));
				}
				else
				{
					$this->dashboard_model->task_submit();
					echo json_encode(array('sucess' =>true));
				}
		}
		else
		{
			show_404();
		}

	}
	public function assign_task()
	{
		if($this->input->is_ajax_request())
		{
			$this->form_validation->set_rules('project_id', 'Project', 'trim|required|numeric');
		  	$this->form_validation->set_rules('milestone_id', ' Milestone ', 'required|numeric');
		  	$this->form_validation->set_rules('tasklist_id', ' Tasklist ', 'required|numeric');
		  	$this->form_validation->set_rules('task_id', ' Task ', 'required|numeric');
		  	$this->form_validation->set_rules('user_id', ' User ', 'required');
		  	
		  	if($this->form_validation->run() == FALSE){  
		  			echo json_encode(array("sucess"=>false,"errors"=>validation_errors()));
				}
				else
				{
					$rval = $this->dashboard_model->assign_task_submit();
					echo json_encode(array('sucess' =>true,'query'=>$rval));
				}
		}
		else
		{
			show_404();
		}

	}
	public function add_project_assigned()
	{
		$ret = $this->dashboard_model->add_project_assigned();
		if(!$ret)
		{
			$this->data['error'] = "This user has already been added.";
		}
		$this->addProject();
	}
	/*this a page*/
	public function addProject()
	{
		if(($this->session->userdata('user_name')!="")){
		$this->data['projects'] = $this->dashboard_model->get_projects();
		$this->data['project_assigned'] = $this->dashboard_model->get_project_assigned();
		$this->data['title'] = "Add Project";
		$this->data['users'] = $this->dashboard_model->get_users();
		$this->load->view('header_view',$this->data);
		$this->load->view('addproject_view',$this->data);
		}
		else{
			redirect('login');
		}

	}
	/*this is a page*/
	public function addMilestones()
	{
		if(($this->session->userdata('user_name')!="")){
			$this->data['projects'] = $this->dashboard_model->get_projects();
			$this->data['milestones'] = $this->dashboard_model->get_milestones();
			
			$this->data['project_assigned'] = $this->dashboard_model->get_project_assigned();
			$this->data['title'] = "Add Milestones";
			$this->data['users'] = $this->dashboard_model->get_users();
			$this->data['tasklists'] = $this->dashboard_model->get_tasklists();
			
			$this->load->view('header_view',$this->data);
			$this->load->view('addmilestones_view',$this->data);
		}
		else
		{
			redirect('login');
		}
	}
	/*this is a page*/
	public function addTask()
	{
		if(($this->session->userdata('user_name')!="")){
			$this->data['projects'] = $this->dashboard_model->get_projects();
			$this->data['milestones'] = $this->dashboard_model->get_milestones();
			
			$this->data['project_assigned'] = $this->dashboard_model->get_project_assigned();
			$this->data['title'] = "Add Tasks";
			$this->data['users'] = $this->dashboard_model->get_users();
			$this->data['tasklists'] = $this->dashboard_model->get_tasklists();
			$this->data['tasks'] = $this->dashboard_model->get_tasks();
			
			$this->load->view('header_view',$this->data);
			$this->load->view('addtask_view',$this->data);
		}
		else
		{
			redirect('login');
		}
	}
	public function assignTask()
	{
		if(($this->session->userdata('user_name')!="")){
			$this->data['projects'] = $this->dashboard_model->get_projects();
			$this->data['milestones'] = $this->dashboard_model->get_milestones();
			
			$this->data['project_assigned'] = $this->dashboard_model->get_project_assigned();
			$this->data['title'] = "Assign Members";
			$this->data['users'] = $this->dashboard_model->get_users();
			$this->data['tasklists'] = $this->dashboard_model->get_tasklists();
			$this->data['tasks'] = $this->dashboard_model->get_tasks();
			$this->data['task_assigned'] = $this->dashboard_model->get_task_assigned();
			
			$this->load->view('header_view',$this->data);
			$this->load->view('assigntask_view',$this->data);
		}
		else{
			redirect('login');
		}
	}
	public function mark_task_done()
	{
		if($this->input->is_ajax_request())
		{
			$task_id = $this->input->get('task_id');
			$date = $this->input->get('date');
			if($this->dashboard_model->mark_task_done($task_id, $date))
				echo  json_encode(array('v' => true));
			else
				echo  json_encode(array('v' => false));
		}

	}
	public function mark_task_undone($task_id = "")
	{
		if($task_id == "")
			return;
		if($this->input->is_ajax_request())
		{
			if($this->dashboard_model->mark_task_undone($task_id))
				echo  json_encode(array('v' => true));
			else
				echo  json_encode(array('v' => false));
		}

	}
}