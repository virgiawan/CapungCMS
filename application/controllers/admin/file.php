<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller{
	
	
	public function index(){
		redirect('admin/dashboard');
//		$this->data['content'] = 'admin/file/index';
		$this->load->view('admin/template/header');
		$this->load->view('admin/file/index');
		$this->load->view('admin/template/footer');
	}
	
}

/* End of file file.php */
/* Location : application/controllers/admin/file.php  */