<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Comments extends MY_Controller{
	
	/*-- filter --*/
	protected $before_filter = array(
		'action' => 'redirect_if_not_logged_in',
	);
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
	}
	
	/*-- method-method --*/
	public function index(){
		$comments = Comment::find('all');
		$this->data['comments']		= $comments;
		$this->data['content']		= 'admin/comment/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function publish($id=''){
		$a_comment = Comment::find(array('conditions'=>array('id = ?',$id)));
		if(!isset($a_comment)){
			$this->session->set_flashdata('msg','Comment ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/comments');
		}
		if($a_comment->status==1){
			$a_comment->status = 0;
		}
		else{
			$a_comment->status = 1;
		}
		$a_comment->save();
		$this->session->set_flashdata('msg','Comment has been published.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/comments');
	}
	
	public function delete($id=''){
		$a_comment = Comment::find(array('conditions'=>array('id = ?',$id)));
		if(!isset($a_comment)){
			$this->session->set_flashdata('msg','Comment ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/comments');
		}
		$a_comment->delete();
		$this->session->set_flashdata('msg','Comment has been deleted.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/comments');	
	}
	
}

/* End of file comment.php */
/* Location : application/controllers/admin/comment.php */