<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller{
	
	/*-- filter --*/
	protected $before_filter = array(
		'action'	=> 'redirect_if_not_logged_in',
	);
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
	}
	
	/*-- method-method --*/
	public function index(){
		$this->_latest_article();
		$this->_latest_slide();
		$this->_latest_comment();
		$this->data['content'] = 'admin/dashboard/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	/*-- private function --*/
	private function _latest_article(){
		$posts = Post::find('all',array('conditions'=>array('type_id = ?',POST_TYPE_ARTICLE),'limit'=>10,'order'=>'id DESC'));
		$this->data['articles'] = $posts;
	}
	
	private function _latest_slide(){
		$posts = Post::find('all',array('conditions'=>array('type_id = ?',POST_TYPE_SLIDE),'limit'=>10,'order'=>'id DESC'));
		$this->data['slides'] = $posts;
	}
	
	private function _latest_comment(){
		$comments = Comment::find('all',array('limit'=>20,'order'=>'id DESC'));
		$this->data['comments'] = $comments;
	}
	
}

/* End of file dashboard.php */
/* Location : application/controllers/dashboard.php */