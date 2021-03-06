<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends MY_Controller{
	
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
		$posts = Post::find('all',array('conditions'=>array('type_id = ?',POST_TYPE_GALLERY)));
		$this->data['posts'] = $posts;
		$this->data['content'] = 'admin/gallery/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function show($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_GALLERY)));
		if(!isset($post)){
			$this->session->set_flashdata('msg','Gallery ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/gallery');
		}
		$this->data['post'] = $post;
		$this->data['content'] = 'admin/gallery/show';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function add(){
		$this->__process_form();
		$this->data['content'] = 'admin/gallery/form';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function edit($id=''){
		$this->__process_form(TRUE,$id);
		$this->data['content'] = 'admin/gallery/form';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function delete($id=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_GALLERY)));
		if(!isset($post)){
			$this->session->set_flashdata('msg','Gallery ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/gallery');
		}
		$post->delete();
		$this->session->set_flashdata('msg','Gallery has been deleted.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/gallery');
	}

	public function remove_upload($id='',$type=''){
		$post = Post::find(array('conditions'=>array('id = ? AND type_id = ?',$id,POST_TYPE_GALLERY)));
		if(!isset($post) || empty($type)){
			$this->session->set_flashdata('msg','Gallery ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/gallery');
		}
		if($type=='filename'){
			$post->filename = '';
		}
		else if($type=='thumbnail'){
			$post->thumbnail = '';
		}
		else{
			$this->session->set_flashdata('msg','File not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/gallery');
		}
		//echo $type;
		$post->save();
		redirect('admin/gallery/edit/'.$id);
	}
	
	/*-- private method --*/
	private function __process_form($is_edit=FALSE,$id=''){
		$post = '';
		$image = TRUE;
		$thumb = TRUE;
		// initiate value for field tags and categories
		$this->data['tags'] = $this->input->post('tags');
		$this->data['categories'] = ($this->input->post('categories')!='')?$this->input->post('categories'):array();
		
		if($is_edit){ // is form == form edit
			$post = Post::find_by_id_and_type_id($id,POST_TYPE_GALLERY);
			if(!isset($post)){
				$this->session->set_flashdata('msg','Gallery ID not found.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/gallery');
			}
			// get tags value from database
			$arr_tag = $post->get_related_tags();
			$populate_tag = array();
			foreach($arr_tag as $tag){
				array_push($populate_tag, $tag->name);
			}
			$this->data['tags'] = implode(',',$populate_tag);
			// get categories value from dataabase
			$arr_category = $post->get_related_categories();
			$populate_category = array();
			foreach($arr_category as $category){
				array_push($populate_category, $category->id);
			}
			$this->data['categories'] = $populate_category;
		}
		else{ // is form == form add
			$post = new Post();
		}
		// process input value from form add or edit
		$this->form_validation->set_rules('publish_date','Publish date','required|trim|xss_clean');
		$this->form_validation->set_rules('title','Title','required|trim|xss_clean');
		$this->form_validation->set_rules('resume','Resume','trim|xss_clean');
		$this->form_validation->set_rules('status','Status','integer|trim|xss_clean');
		$this->form_validation->set_rules('commentable','Commentable','integer|trim|xss_clean');
		$this->form_validation->set_rules('order_num','Order number','integer|trim|xss_clean');
		if($this->config->item('capung_dual_lang')){
			$this->form_validation->set_rules('title_alt','Title (lang)','trim|xss_clean');
			$this->form_validation->set_rules('resume_alt','Resume (lang)','trim|xss_clean');
		}
		// check validation
		if($this->form_validation->run()){
			if(!$is_edit){
				$post->author_id 		= $this->user_id;
				$post->type_id	 		= POST_TYPE_GALLERY;
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
			$post->is_commentable	= $this->input->post('commentable');
			$post->order_num		= $this->input->post('order_num');
			$post->slug				= url_title($this->input->post('title'),'-',TRUE);
			if($this->config->item('capung_dual_lang')){
				$post->title_alt		 	= $this->input->post('title_alt');
				$post->resume_alt 			= $this->input->post('resume_alt');
			}	
			// thumbnail processing
			if(isset($_FILES['thumbnail']['size']) && $_FILES['thumbnail']['size']>0){
				$config['upload_path'] = './uploads/thumbnails/';
		        $config['allowed_types'] = 'gif|jpg|png';
		        $config['max_size'] = '2048';
		        $config['max_width'] = '800';
		        $config['max_height'] = '600';
		        $this->upload->initialize($config);
		        // =============> process upload 
		        if($this->upload->do_upload('thumbnail')){
		        	$upload_thumb = $this->upload->data();
		        	$post->thumbnail = $upload_thumb['file_name'];
		        }
		        else{ // if there are some error while upload thumbnail image
			        $thumb = FALSE;
			        $this->data['thumbnail_error'] = $this->upload->display_errors('<span class="field-message">','</span>');
		        }
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
			// upload image == success or no image uploaded [$image == TRUE] and [$thumb == TRUE]
			if($image && $thumb){
				if($post->save()){ // save post gallery
					// massive delete categoties and tags where post_id has been saved
					PostHasTerm::delete_all(array('conditions'=>array('post_id'=>$post->id)));
					$arr_category = $this->input->post('categories');
					// if categories == null
					if(empty($arr_category)){
						$post_has_terms = new PostHasTerm();
						$post_has_terms->post_id = $post->id;
						$post_has_terms->term_id = 1; // 1 ==> Uncategorized
						if(!$is_edit){
								$category = Term::find(1);
								$category->count += 1;
								$category->save();
						}
						$post_has_terms->save();
					}
					else{ // if categories == not null
						foreach($arr_category as $key=>$value){
							$post_has_terms = new PostHasTerm();
							$post_has_terms->post_id = $post->id;
							$post_has_terms->term_id = $value;
							if(!$is_edit){
								$category = Term::find($value);
								$category->count += 1;
								$category->save();
							}
							$post_has_terms->save();
						}
					}
					// if categories =/= null
					if($this->input->post('tags')!=''){
						$arr_tag = explode(',',$this->input->post('tags'));
						foreach($arr_tag as $key=>$value){
							// build tag
							$tag = Term::find(array('conditions'=>array('name = ? AND type_id = ?',strtolower(trim($value)),TERM_TYPE_TAG)));
							if(!isset($tag)){
								$tag_attribute = array(
									'name'				=> strtolower(trim($value)),
									'description'		=> strtolower(trim($value)),
									'slug'				=> url_title($value,'-',TRUE),
									'parent'			=> 0,
									'order_num'			=> 0,
									'type_id'			=> TERM_TYPE_TAG,
									'count'				=> 1,
								);
								$tag = new Term($tag_attribute);
							}
							if(!$is_edit){
								$tag->count += 1;
							}
							$tag->save();
							// connect tag to gallery
							$post_has_terms = new PostHasTerm();
							$post_has_terms->post_id = $post->id;
							$post_has_terms->term_id = $tag->id;
							$post_has_terms->save();
						}
					}
				}
				$this->session->set_flashdata('msg','Gallery has been saved.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
				redirect('admin/gallery');
	
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

/* End of file gallery.php */
/* Location : application/controllers/admin/gallery.php */