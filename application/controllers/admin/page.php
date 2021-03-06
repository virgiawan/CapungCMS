<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller{
	
	/*-- filter --*/
	protected $before_filter = array(
		'action'	=> 'redirect_if_not_logged_in',
	);
	
	/*-- attribute --*/
	private $user_id;
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation','upload'));
		$this->load->helper(array('form'));
		$this->user_id = $this->session->userdata('user_id');
	}
	
	/*-- method-method --*/
	public function index(){
		$posts = Post::find('all',array('conditions'=>array('type_id = ?',POST_TYPE_PAGE)));
		$this->data['posts'] = $posts;
		$this->data['content'] = 'admin/page/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function show($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_PAGE)));
		if(!isset($post)){
			$this->session->set_flashdata('msg','Page ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/page');
		}
		$this->data['post'] = $post;
		$this->data['content'] = 'admin/page/show';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function add(){
		$this->__process_form();
		$this->data['content'] = 'admin/page/form';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function edit($id=''){
		$this->__process_form(TRUE,$id);
		$this->data['content'] = 'admin/page/form';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function delete($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_PAGE)));
		if(!isset($post)){
			$this->session->set_flashdata('msg','Page ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/page');
		}
		$post->delete();
		$this->session->set_flashdata('msg','Page has been deleted.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/page');
	}

	public function remove_upload($id='',$type=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_PAGE)));
		if(!isset($post) || empty($type)){
			$this->session->set_flashdata('msg','Page ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/page');
		}
		if($type=='filename'){
			$post->filename = '';
		}
		else{
			$this->session->set_flashdata('msg','File not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/page');
		}
		$post->save();
		redirect('admin/page/edit/'.$id);
	}
	
	/*-- private method --*/
	private function __process_form($is_edit=FALSE,$id=''){
		$post = '';
		$image = TRUE;
		
		if($is_edit){ // is form == form edit
			$post = Post::find_by_id_and_type_id($id,POST_TYPE_PAGE);
			if(!isset($post)){
				$this->session->set_flashdata('msg','Page ID not found.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/page');
			}
		}
		else{ // is form == form add
			$post = new Post();
		}
		// process input value from form add or edit
		$this->form_validation->set_rules('publish_date','Publish date','required|trim|xss_clean');
		$this->form_validation->set_rules('title','Title','required|trim|xss_clean');
		$this->form_validation->set_rules('resume','Resume','trim|xss_clean');
		$this->form_validation->set_rules('content','Content','trim|xss_clean');
		$this->form_validation->set_rules('status','Status','integer|trim|xss_clean');
		$this->form_validation->set_rules('commentable','Commentable','integer|trim|xss_clean');
		if($this->config->item('capung_dual_lang')){
			$this->form_validation->set_rules('title_alt','Title (lang)','trim|xss_clean');
			$this->form_validation->set_rules('resume_alt','Resume (lang)','trim|xss_clean');
			$this->form_validation->set_rules('content_alt','Content (lang)','trim|xss_clean');
		}
		// check validation
		if($this->form_validation->run()){
			if(!$is_edit){
				$post->author_id 		= $this->user_id;
				$post->type_id	 		= POST_TYPE_PAGE;
				$post->count_view 		= 0;
				$post->thumbnail 		= '';
				$post->filename			= '';
				$post->count_comment 	= 0;
				$post->order_num 		= '';
			}
			// build date and time to save into db
			$date_now = new ActiveRecord\DateTime($this->input->post('publish_date'));
			$date_now = $date_now->format('date_db');
			$time_now = date('H:i:s');
			$datetime_now = $date_now.' '.$time_now;
			// set data value
			$post->publish_date 	= $datetime_now;
			$post->title		 	= $this->input->post('title');
			$post->resume 			= $this->input->post('resume');
			$post->content 			= $this->input->post('content'); 
			$post->is_published		= $this->input->post('status'); 
			$post->is_commentable	= $this->input->post('commentable');
			$post->slug				= url_title($this->input->post('title'),'-',TRUE);
			if($this->config->item('capung_dual_lang')){
				$post->title_alt		 	= $this->input->post('title_alt');
				$post->resume_alt 			= $this->input->post('resume_alt');
				$post->content_alt 			= $this->input->post('content_alt'); 
			}	
			// image file processing
			if(isset($_FILES['image']['size']) && $_FILES['image']['size']>0){
				$config['upload_path'] = './uploads/images/';
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size'] = '2048';
		        $config['max_width'] = '1024';
		        $config['max_height'] = '768';
		        $this->upload->initialize($config);
		        // =============> process upload 
		        if($this->upload->do_upload('image')){
			        $upload_image = $this->upload->data();
		        	$post->filename = $upload_image['file_name'];
		        }
		        else{ // if there are some error while upload image
			        $image = FALSE;
			        $this->data['image_error'] = $this->upload->display_errors('<span class="field-message">','</span>');
		        }		        
			}
			// upload image == success or no image uploaded [$image == TRUE]
			if($image){
				if($post->save()){ // save post page
					$this->session->set_flashdata('msg','Page has been saved.');
					$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
					redirect('admin/page');	
					
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
		
		$this->data['post'] = $post;
	}
	
}
	
/* End of file page.php */
/* Location : application/controllers/admin/page.php */