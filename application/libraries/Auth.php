<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth{
	
	/*-- attribute --*/
	protected $ci;
	protected $salt = 'CAPUNGCMS[at]ORANYEMEDIA[dot]COM';
	
	/*-- constructor --*/
	public function __construct(){
		$this->ci =& get_instance();
	}
	
	/*-- method-method --*/
	// check user logged in system or not
	public function is_logged_in(){
		return $this->ci->session->userdata('user_id')!=''?TRUE:FALSE;
	}
	
	public function is_admin_role(){
		$role = $this->ci->session->userdata('user_id');
		if($role){
			return (($role == ROLE_SUPERADMIN) || ($role == ROLE_ADMIN));
		}
		else{
			return FALSE;
		}
	}
	
	public function is_superadmin_role(){
		$role = $this->ci->session->userdata('user_id');
		if($role){
			return (($role == ROLE_SUPERADMIN));
		}
		else{
			return FALSE;
		}
	}
	
	/*
	* username can be  username or email address
	* password is encryption of plain text password
	*/
	public function login($username,$password){
		// check is user in database or not
		$user = User::find(array('conditions'=>array('email = ? AND password = ? AND active = ?',$username,$this->encrypt($password),1))); // check using email address
		if(isset($user)){
			if($user->email==$username && $user->password==$this->encrypt($password)){
				$this->ci->session->set_userdata('user_id',$user->id);
				$this->ci->session->set_userdata('user_email',$user->email);
				$this->ci->session->set_userdata('user_name',$user->username);
				$this->ci->session->set_userdata('user_fullname',$user->fullname);
				$this->ci->session->set_userdata('user_role',$user->role_id);
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		else{ // check using username
			$user = User::find(array('conditions'=>array('username = ? AND password = ? AND active = ?',$username,$this->encrypt($password),1))); // check user using username
			if(isset($user)){
				if($user->username==$username && $user->password==$this->encrypt($password)){
					$this->ci->session->set_userdata('user_id',$user->id);
					$this->ci->session->set_userdata('user_email',$user->email);
					$this->ci->session->set_userdata('user_name',$user->username);
					$this->ci->session->set_userdata('user_fullname',$user->fullname);
					$this->ci->session->set_userdata('user_role',$user->role_id);
					return TRUE;
				}
				else{
					return FALSE;
				}				
			}
			else{
				return FALSE;
			}
		}
	}
	
	public function logout(){
	    $this->ci->session->unset_userdata('user_id');
	    $this->ci->session->unset_userdata('user_email');
	    $this->ci->session->unset_userdata('user_name');
	    $this->ci->session->unset_userdata('user_fullname');
	    $this->ci->session->unset_userdata('user_role');
	    return TRUE;
	}
	
	public function encrypt($plain_text){
		return md5((sha1(md5('!@#'.$plain_text.'$%^'))));
	}

	public function generate_token($email=''){
		$user = User::find(array('conditions'=>array('email = ?',$email)));
		if(!isset($user)){ 
			return FALSE;
		}
		else{
			$time = time();
			$user_id = $user->id;
			$pass = $user->password;

			return dechex($time).'-'.dechex($user_id).'-'.sha1($user_id.$time.$pass.$this->salt);
		}
	}

	public function validate_token($token=''){
		$items = preg_split('/[-]/', $token);    
		if(!isset($items[0]) || !isset($items[1]) || !isset($items[2])) return FALSE;

		$time = hexdec($items[0]);
		if((time()-$time)>3600) return FALSE;

		$user_id = hexdec($items[1]);    
		$hash = $items[2];

		$user = User::find($user_id);
		if(!isset($user)) return FALSE;

		$pass = $user->password;
		$check = sha1($user_id.$time.$pass.$this->salt);

		return ($hash == $check) ? $user_id : FALSE;
	}
	
}

/* End of file Auth.php */
/* Location : application/libraries/Auth.php */