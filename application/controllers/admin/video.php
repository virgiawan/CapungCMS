<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Video extends MY_Controller{
	
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
		$posts = Post::find('all',array('conditions'=>array('type_id = ?',POST_TYPE_VIDEO)));
		$this->data['posts'] = $posts;
		$this->data['content'] = 'admin/video/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	

	public function show($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_VIDEO)));
		if(!isset($post)){
			$this->session->set_flashdata('msg','Video ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/video');
		}
		$this->data['post'] = $post;
		$this->data['content'] = 'admin/video/show';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function add(){
		$this->__process_form();
		$this->data['content'] = 'admin/video/form';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function edit($id=''){
		$this->__process_form(TRUE,$id);
		$this->data['content'] = 'admin/video/form';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function delete($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_VIDEO)));
		if(!isset($post)){
			$this->session->set_flashdata('msg','Video ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/video');
		}
		$post->delete();
		$this->session->set_flashdata('msg','Video has been deleted.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/video');
	}

	public function remove_upload($id='',$type=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_VIDEO)));
		if(!isset($post) || empty($type)){
			$this->session->set_flashdata('msg','Video ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/video');
		}
		if($type=='video'){
			$post->filename = '';
		}
		else{
			$this->session->set_flashdata('msg','File not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/video');
		}
		//echo $type;
		$post->save();
		redirect('admin/video/edit/'.$id);
	}
	
	/*-- private method --*/
	private function __process_form($is_edit=FALSE,$id=''){
		$post = '';
		$video = TRUE;
	
		if($is_edit){ // is form == form edit
			$post = Post::find_by_id_and_type_id($id,POST_TYPE_VIDEO);
			if(!isset($post)){
				$this->session->set_flashdata('msg','Video ID not found.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/video');
			}
		}
		else{ // is form == form add
			$post = new Post();
		}
		// process input value from form add or edit
		$this->form_validation->set_rules('publish_date','Publish date','required|trim|xss_clean');
		$this->form_validation->set_rules('title','Title','required|trim|xss_clean');
		$this->form_validation->set_rules('resume','Resume','trim|xss_clean');
		$this->form_validation->set_rules('status','Status','integer|trim|xss_clean');
		$this->form_validation->set_rules('order_num','Order number','integer|trim|xss_clean');
		if($this->config->item('capung_dual_lang')){
			$this->form_validation->set_rules('title_alt','Title (lang)','trim|xss_clean');
			$this->form_validation->set_rules('resume_alt','Resume (lang)','trim|xss_clean');
		}
		// check validation
		if($this->form_validation->run()){
			if(!$is_edit){
				$post->author_id 		= $this->user_id;
				$post->type_id	 		= POST_TYPE_VIDEO;
				$post->count_view 		= 0;
				$post->thumbnail 		= '';
				$post->filename		= '';
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
			$post->is_published		= $this->input->post('status'); 
			$post->order_num		= $this->input->post('order_num');
			$post->slug				= url_title($this->input->post('title'),'-',TRUE);
			if($this->config->item('capung_dual_lang')){
				$post->title_alt		 	= $this->input->post('title_alt');
				$post->resume_alt 			= $this->input->post('resume_alt');
			}	
			// video file processing
			if(isset($_FILES['video']['size']) && $_FILES['video']['size']>0){
				$config['upload_path'] = './uploads/files/';
		        $config['allowed_types'] = 'flv|m4v|mp4';
		        $config['max_size'] = '10240';
		        $this->upload->initialize($config);
		        // =============> process upload 
		        if($this->upload->do_upload('video')){
			        $upload_video = $this->upload->data();
		        	$post->filename = $upload_video['file_name'];
		        }
		        else{ // if there are some error while upload video
			        $video = FALSE;
			        $this->data['video_error'] = $this->upload->display_errors('<span class="field-message">','</span>');
		        }		        
			}
			// upload video == success or no video uploaded [$video == TRUE]
			if($video){
				if($post->save()){ // save post video
					$this->session->set_flashdata('msg','Video has been saved.');
					$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
					redirect('admin/video');
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

/* End of file video.php */
/* Location : application/controllers/admin/video.php */