<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{

	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('auth','form_validation'));
	}
	
	/*-- method-method --*/
	public function index(){
		if($this->auth->is_logged_in()){
			redirect('admin/dashboard');
		}
		$this->data['msg'] = $this->data['msg_type'] = null;
		$this->__exec_login();
		$this->load->view('admin/login/login_form',$this->data);
	}
	
	/*-- private method --*/
	private function __exec_login(){
		 $this->form_validation->set_rules('username','Username','required|trim|xss_clean|strip_tags');
		 $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
		 if($this->form_validation->run()){
			 $login_status = $this->auth->login($this->input->post('username'),$this->input->post('password'));
			 if($login_status){
				 redirect('admin/dashboard');
			 }
			 else{
				 $this->data['msg'] 		= 'Login failed';
				 $this->data['msg_type']	= MSG_TYPE_ERROR;
			 }
		 }
	}
	
}

/* End of file login.php */
/* Location : application/conntrollers/admin/login.php */