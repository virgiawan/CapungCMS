<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller{
	
	/*-- filter --*/
	protected $before_filter = array(
		'action'	=> 'redirect_if_not_superadmin',
		'except'	=> array('change_password'),
	);
	
	/*-- attribute --*/
	private $user_id;
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','auth','upload'));
		$this->load->helper('form');
		$this->user_id = $this->session->userdata('user_id');
	}
	
	/*-- method-method --*/
	public function index(){
		$users = User::find('all',array('conditions'=>array('NOT role_id = ?',ROLE_SUPERADMIN)));
		$this->data['users']	= $users;
		$this->data['content']	= 'admin/account/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function add(){
		$this->__process_form();
		$this->data['content'] = 'admin/account/form';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function edit($id=''){
		$this->__process_form(TRUE,$id);
		$this->data['content'] = 'admin/account/form';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function delete($id=''){
		$user = User::find(array('conditions'=>array('id = ?',$id)));
		if(!isset($user)){
			$this->session->set_flashdata('msg','Account ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/account');
		}
		$user->delete();
		$this->session->set_flashdata('msg','Account has been deleted.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/account');

	}
	
	public function remove_profile_picture($id=''){
		$user = User::find(array('conditions'=>array('id = ?',$id)));
		if(!isset($user)){
			$this->session->set_flashdata('msg','Account ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/account');
		}
		$user->picture = '';
		$user->save();
		redirect('admin/account/edit/'.$id);
	}
	
	public function change_account_password($id=''){
		$this->__change_password_process($id);
		$this->data['content']	= 'admin/account/form_change_account_password';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function change_password(){
		$this->__change_password_process();
		$this->data['content']	= 'admin/account/form_change_password';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	/**-- callback --**/
	public function _check_username($str){
	    // !valid_email
	    if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix",$str)){
	      return TRUE;
	    }
	    else{
	      $this->form_validation->set_message('_check_username', 'Username cannot be an email address.');
	      return FALSE;
	    }
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
	
	/*-- private method --*/
	private function __process_form($is_edit=FALSE,$id=''){
		$user = '';
		$profile_pic = TRUE;
		$this->data['unique_err_username'] = $this->data['unique_err_email'] = '';		
		$roles = Role::find('all',array('conditions'=>array('NOT id = ?',ROLE_SUPERADMIN)));
		
		if($is_edit){ // if form == form edit 
			$user = User::find(array('conditions'=>array('id = ? AND NOT role_id = ?',$id,ROLE_SUPERADMIN)));	
		}
		else{ // if form == form add
			$user = new User();
		}
		// process input value from form add or edit
		if(!$is_edit){
			$this->form_validation->set_rules('username','Username','required|min_length[6]|trim|xss_clean|callback__check_username');
			$this->form_validation->set_rules('email','Email','required|trim|xss_clean');
			$this->form_validation->set_rules('password','Password','required|min_length[8]|trim|xss_clean|callback__check_password');
			$this->form_validation->set_rules('confirm_password','Confirm Password','required|matches[password]|trim|xss_clean');
		}
		$this->form_validation->set_rules('role','Role','integer|required|trim|xss_clean');
		$this->form_validation->set_rules('fullname','Fullname','required|trim|xss_clean');
		$this->form_validation->set_rules('status','Status','integer|required|trim|xss_clean');
		// check validation
		if($this->form_validation->run()){
			if(!$is_edit){
				$user->username 	= $this->input->post('username');
				$user->email		= $this->input->post('email');
				$user->password		= $this->auth->encrypt($this->input->post('password'));	
			}
			$user->role_id		= $this->input->post('role');
			$user->fullname		= $this->input->post('fullname');
			$user->active		= $this->input->post('status');
			// image file processing
			if(isset($_FILES['profile_picture']['size']) && $_FILES['profile_picture']['size']>0){
				$config['upload_path'] = './uploads/profile_picture/';
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size'] = '2048';
		        $config['max_width'] = '1024';
		        $config['max_height'] = '768';
		        $this->upload->initialize($config);
		        // =============> process upload 
		        if($this->upload->do_upload('profile_picture')){
			        $upload_image = $this->upload->data();
		        	$user->picture = $upload_image['file_name'];
		        }
		        else{ // if there are some error while upload image
			        $profile_pic = FALSE;
			        $this->data['image_error'] = $this->upload->display_errors('<span class="field-message">','</span>');
		        }		        
			}
			// upload image == success or no image uploaded [$image == TRUE]
			if($profile_pic){
				if($user->save()){ // save post slide
					$this->session->set_flashdata('msg','User has been added.');
					$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
					redirect('admin/account');
				}
				else{
					$this->data['unique_err_username'] = $user->errors->on('username')!=''?'<span class="field-message">The Username field must be unique</span>':'';
					$this->data['unique_err_email'] = $user->errors->on('email')!=''?'<span class="field-message">The Email field must be unique</span>':'';
				}
			}
		}
		// if in edit mode
		if($is_edit){
			$this->data['is_edit'] = TRUE;
			$this->data['id'] = $id;
		}else{
			$this->data['is_edit'] = FALSE;
			$this->data['id'] = '';
		}
		$this->data['roles'] = $roles;
		$this->data['user'] = $user;
	}
	
	private function __change_password_process($id=''){
		if($id){
			$user = User::find(array('conditions'=>array('id = ?',$id)));
		}
		else{
			$user = User::find(array('conditions'=>array('id = ? AND username = ? AND email = ?',$this->user_id,$this->session->userdata('user_name'),$this->session->userdata('user_email'))));
		}
		
		if(!isset($user) && !empty($id)){
			$this->session->set_flashdata('msg','Account ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/account');
		}
		else if(!isset($user) && empty($id)){
			$this->session->set_flashdata('msg','Account ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/account/change_password');			
		}
		
		if(empty($id)){
			$this->form_validation->set_rules('old_pass','Old Password','required|xss_clean|trim');
		}
		
		$this->form_validation->set_rules('new_pass','New Password','required|min_length[8]|trim|xss_clean|callback__check_password');
		$this->form_validation->set_rules('confirm_pass','Confirmasi Password','required|xss_clean|trim|matches[new_pass]');
		if($this->form_validation->run()){
			if($id){
				$user = User::find(array('conditions'=>array('id = ?',$id)));
			}
			else{
				$user = User::find(array('conditions'=>array('id = ? AND username = ? AND email = ?',$this->user_id,$this->session->userdata('user_name'),$this->session->userdata('user_email'),$this->auth->encrypt($this->input->post('old_pass')))));
			}
			if(!isset($user)){
				$this->session->set_flashdata('msg','Old Password not correct.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/account/change_password');
			}
			$user->password = $this->auth->encrypt($this->input->post('new_pass'));
			if($user->save()){
				if(empty($id)){
					$this->session->set_flashdata('msg','Password has been changed.');
					$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
					redirect('admin/account/change_password');
				}else{
					$this->session->set_flashdata('msg','Password has been changed.');
					$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
					redirect('admin/account');					
				}
			}
		}
		$this->data['user']	= $user;
	}
	
}

/* End of file account.php */
/* Location : application/controllers/admin/account.php */