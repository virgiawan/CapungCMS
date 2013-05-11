<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{

	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('auth','form_validation','captcha','container'));
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

	public function forgot_password(){
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email');
		$this->form_validation->set_rules('captcha','Captcha','required|callback__check_captcha');

		if($this->form_validation->run()){
			$user = User::find(array('conditions'=>array('email = ?',$this->input->post('email'))));
			if(!isset($user)){
				$this->session->set_flashdata('msg','Email not found.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/login/forgot_password');
			}
			$token = $this->auth->generate_token($user->email);
			$url = base_url('admin/login/reset_password/'.$token);
			$message = "Reset password click <a href='{$url}'>here</a>";
			$this->container->send_email($user->email,'Reset Password',$message);

			$this->session->set_flashdata('msg','Email has been send to your inbox.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
			redirect('admin/login/forgot_password');
		}

		// generate captcha
		if($this->captcha->isset_captcha()){
			if(file_exists('./resources/_images/captcha/'.$this->captcha->captcha_image())){
		 		unlink('./resources/_images/captcha/'.$this->captcha->captcha_image());
		 	}
		}
		$cap = $this->captcha->generate_captcha();
        $this->data['captcha'] = $cap['image'];
		
		$this->load->view('admin/login/forgot_form',$this->data);
	}

	public function reset_password($token=''){

		$user_id = $this->auth->validate_token($token);
	
		if($user_id==FALSE){
			$this->session->set_flashdata('msg','Token not valid.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/login');
		}
		else{
			$this->form_validation->set_rules('newpass','New Password','required|min_length[8]|trim|xss_clean|callback__check_password');
			$this->form_validation->set_rules('confirmpass','Confirm Password','required|matches[newpass]|trim|xss_clean');

			$user = User::find($user_id);

			if($this->form_validation->run()){
				$encrypt_pass = $this->auth->encrypt($this->input->post('newpass'));
				$user->password = $encrypt_pass;
				if($user->save()){
					$this->auth->login($user->username,$this->input->post('newpass'));
					redirect('admin/login');
				}
				else{
					$this->session->set_flashdata('msg','Can not reset password.');
					$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
					redirect('admin/login/reset_password/'.$token);
				}
			}

			
			$this->data['user'] = $user;
			$this->load->view('admin/login/reset_form',$this->data);
		}
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

	/*-- callback --*/
	public function _check_captcha($str){
		if($str!=$this->session->userdata('captcha_session')){
			$this->form_validation->set_message('_check_captcha','Captcha not valid.');
			return FALSE;
		}
		return TRUE;
	}

	public function _check_password($str){
		if(preg_match('#[0-9]#',$str) && preg_match('#[a-z]#',$str) && preg_match('#[A-Z]#',$str)){
		  return TRUE;
		}
		else{
		  $this->form_validation->set_message('_check_password', 'Password must contain uppercase, lowercase and number.');
		  return FALSE;
		}
	}
	
}

/* End of file login.php */
/* Location : application/conntrollers/admin/login.php */