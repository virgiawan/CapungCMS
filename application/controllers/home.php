<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{

	protected $before_filter   = array();
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('pagination','captcha','form_validation'));
	}
	
	/*-- method-method --*/
	public function index(){
		// initiate to pagging
		$config['base_url'] = base_url('home/index');
		$config['total_rows'] = count(Post::find('all',array('conditions'=>array('is_published = ? AND type_id = ?',1,POST_TYPE_ARTICLE))));
		$config['per_page'] = 1;
		// count pagging position
		$page	= $this->uri->segment(3)!=''?$this->uri->segment(3):'';
		$position = 0;
		if($page!=''){
			$position = ($config['per_page'] * $page);
		}
		// retrieve data
		$posts = Post::find('all',array('conditions'=>array('type_id = ? AND is_published = ?',POST_TYPE_ARTICLE,1),'limit'=>$config['per_page'],'offset'=>$position)); 
		$categories = Term::find('all',array('conditions'=>array('type_id = ?',TERM_TYPE_CATEGORY)));
		$tags = Term::find('all',array('conditions'=>array('type_id = ?',TERM_TYPE_TAG)));
		$this->data['posts']		= $posts;
		$this->data['categories']	= $categories;
		$this->data['tags']			= $tags;
		// initiate pagination
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		$this->data['content'] = 'public/home/index';
		$this->load->view($this->default_layout,$this->data);
	}
	
	public function article($id='',$slug=''){
		// delete latest captcha image
		if($this->captcha->isset_captcha()){
			if(file_exists('./resources/_images/captcha/'.$this->captcha->captcha_image())){
		 		unlink('./resources/_images/captcha/'.$this->captcha->captcha_image());
		 	}
		}
	
 		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ? AND slug = ? AND is_published = ?',$id,POST_TYPE_ARTICLE,$slug,1)));
 		if(!isset($post)){
	 		redirect('home');
 		}
 		// process add comment to database
 		if($post->is_commentable){
 			$this->_process_comment($id);
 		}
 		// process add count view
 		$post->count_view += 1;
 		$post->save();
 		// generate captcha
 		$cap = $this->captcha->generate_captcha();
 		// retrieve data
 		$this->data['captcha']	= $cap['image']; 
 		$this->data['post'] 	= $post;
 		$this->data['content']	= 'public/home/show_article';
 		$this->load->view($this->default_layout,$this->data);
	}
	
	public function about_us(){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',2,POST_TYPE_PAGE)));
		if(!isset($post)){
	 		redirect('home');
 		}
 		$this->data['post']		= $post;
 		$this->data['content']	= 'public/home/about_us';
 		$this->load->view($this->default_layout,$this->data);
	}
	
	public function tag($id='',$slug=''){
		$term = Term::find(array('conditions'=>array('id = ? AND slug = ? AND type_id = ?',$id,$slug,TERM_TYPE_TAG)));
		if(!isset($term)){
	 		redirect('home');
 		}
 		$this->data['term']		= $term;
 		$this->data['content']	= 'public/home/posts_tag';
 		$this->load->view($this->default_layout,$this->data);
	}
	
	public function category($id='',$slug=''){
	
		$term = Term::find(array('conditions'=>array('id = ? AND type_id = ?',$id,TERM_TYPE_CATEGORY)));
		if(!isset($term)){
	 		redirect('home');
 		}
 		$this->data['term']		= $term;
 		$this->data['content']	= 'public/home/posts_category';
 		$this->load->view($this->default_layout,$this->data);		
	}
	
	/*-- callback --*/
	public function _check_captcha($str){
		if($str!=$this->session->userdata('captcha_session')){
			$this->form_validation->set_message('_check_captcha','Captcha not valid.');
			return FALSE;
		}
		return TRUE;
	}
	
	/*-- private method --*/
	private function _process_comment($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_ARTICLE)));
		if(!isset($post)){
			redirect('home');
		}
		$this->form_validation->set_rules('name','Name','required|trim|xss_clean');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|valid_email');
		$this->form_validation->set_rules('comment','Comment','required|trim|xss_clean');
		$this->form_validation->set_rules('captcha','Captcha','required|callback__check_captcha');
		$comment = new Comment();
		if($this->form_validation->run()){
			$comment->post_id	= $id;
			$comment->author	= $this->input->post('name');
			$comment->email		= $this->input->post('email');
			$comment->url		= $this->input->post('website');
			$comment->ip		= $this->input->ip_address();
			$comment->content	= $this->input->post('comment');
			if($comment->save()){
				redirect('home/article/'.$post->id.'/'.$post->slug);
			}
		}
		$this->data['post_comment'] = $comment;
	}
	
}

/* End of file home.php */
/* Location : application/controllers/home.php */