<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Captcha{
	
	/*-- private method --*/
	private $ci;
	
	/*-- constructor --*/
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->helper('captcha');
	}
	
	public function generate_captcha(){
		$original_string = array_merge(range(0,9), range('a','z'), range('A', 'Z'));
        $original_string = implode("", $original_string);
        $captcha = substr(str_shuffle($original_string), 0, 6);

        $vals = array(
                'word' => $captcha,
                'img_path' => './resources/_images/captcha/',
                'img_url' => base_url('resources/_images/captcha/'),
                'font_path' => BASEPATH.'fonts/texb.ttf',
                'img_width' => 150,
                'img_height' => 50,
                'expiration' => 7200
        );
        
        $cap = create_captcha($vals);
        // set session for captcha and captcha image
        $this->ci->session->set_userdata('captcha_session',$cap['word']);
        $this->ci->session->set_userdata('captcha_image_name',$cap['time']);
        return $cap;
	}
	
	public function isset_captcha(){
		return ( ($this->ci->session->userdata('captcha_image_name')!='') && ($this->ci->session->userdata('captcha_session')!='') );
	}
	
	public function captcha_image(){
		return $this->ci->session->userdata('captcha_image_name').'.jpg';
	}
	
	public function unset_captcha(){
		$this->ci->session->unset_userdata('captcha_session');
		$this->ci->session->unset_userdata('captcha_image_name');
	}
	
}

/* End of file Captcha.php */
/* Location : application/libraries/Captcha.php */