<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{

	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('auth','form_validation','captcha'));
	}
	
	/*-- method-method --*/
	public function index(){
		if($this->auth->is_logged_in()){
			redirect('admin/dashboard');
		}
		
		if($this->captcha->isset_captcha()){
			if(file_exists('./resources/_images/captcha/'.$this->captcha->captcha_image())){
		 		unlink('./resources/_images/captcha/'.$this->captcha->captcha_image());
		 	}
		}
		
		$cap = $this->captcha->generate_captcha();
        $this->data['captcha'] = $cap['image'];
        
		$this->load->view('admin/login/login_form',$this->data);
	}
	
	public function logout(){
		if(!$this->auth->is_logged_in()){
			redirect('admin/login');
		}
		
		if($this->auth->logout()){
			$this->session->set_flashdata('msg','Logout succesed.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
			redirect('admin/login'); 
		}
		else{
			$this->session->set_flashdata('msg','Logout failed.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/article'); 
		}
	}
	
	/*-- callback --*/
	public function _check_captcha($str){
		if($str!=$this->session->userdata('captcha_session')){
			$this->form_validation->set_message('_check_captcha','Captcha not valid.');
			return FALSE;
		}
		return TRUE;
	}
	
	public function exec_login(){
		 $this->form_validation->set_rules('username','Username','required|trim|xss_clean|strip_tags');
		 $this->form_validation->set_rules('password','Password','required|trim|xss_clean');
		 $this->form_validation->set_rules('captcha','Captcha','required|callback__check_captcha');
		 if($this->form_validation->run()){
			 $login_status = $this->auth->login($this->input->post('username'),$this->input->post('password'));
			 if(file_exists('./resources/_images/captcha/'.$this->captcha->captcha_image())){
			 	unlink('./resources/_images/captcha/'.$this->captcha->captcha_image());
			 }
			 if($login_status){
			 	// unset captcha
				$this->captcha->unset_captcha();
				redirect('admin/dashboard');
			 }
			 else{
			 	// unset captcha
			 	$this->captcha->unset_captcha();
			 	$this->session->set_flashdata('msg','Login failed. Username, password, and captcha arn\'t valid.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/login'); 
			 }
		 }
		 else{
		 	if(file_exists('./resources/_images/captcha/'.$this->captcha->captcha_image())){
		 		unlink('./resources/_images/captcha/'.$this->captcha->captcha_image());
		 	}
		 	// unset captcha
		 	$this->captcha->unset_captcha();
			$this->session->set_flashdata('msg','Login failed. Username, password, and captcha arn\'t valid.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/login'); 
		 }
	}
	
}

/* End of file login.php */
/* Location : application/conntrollers/admin/login.php */