<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

Class Container{

	/*-- attribute --*/
	protected $ci;

	/*-- constructor --*/
	public function __construct(){
		$this->ci =& get_instance();
	}

	/*-- method-method --*/
	public function send_email($to,$subject,$message,$from='',$from_name='',$mail_type='',$attach=''){
		$from 		= !empty($from)?$from:'dev.capungcms@gmail.com';
		$from_name 	= !empty($from_name)?$from_name:'Administrator';
		$mail_type 	= !empty($mail_type)?$mail_type:'html';
		// $attach 	= (!empty($attach) and is_array($attach))?$attach:'';
		$this->ci->load->library('email');
		$this->ci->email->from($from,$from_name);
		$this->ci->email->to($to);
		$this->ci->email->subject($subject);
		$this->ci->email->message($message);
		$this->ci->email->set_mailtype($mail_type);
		// $this->ci->email->attach($attach);
		if(!$this->ci->email->send()){
			echo $this->ci->email->print_debugger();
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

}

/* End of file Container.php */
/* Location : application/libraries/Container.php */