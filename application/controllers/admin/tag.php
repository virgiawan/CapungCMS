<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tag extends MY_Controller{

	/*-- filter --*/
	protected $before_filter = array(
		'action'	=> 'redirect_if_not_logged_in',
	);
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
	}
	
	/*-- method-method --*/
	public function index(){
		$terms = Term::find('all',array('conditions'=>array('type_id = ?',TERM_TYPE_TAG)));
		$this->data['terms'] = $terms;
		$this->data['content'] = 'admin/tag/index';
		$this->load->view('admin/template/layout',$this->data);
	}
	

	public function add(){
		$this->__process_form();
		$this->data['content'] = 'admin/tag/form';
		$this->load->view('admin/template/layout',$this->data);
	}
	
	public function edit($id=''){
		$this->__process_form(TRUE,$id);
		$this->data['content'] = 'admin/tag/form';
		$this->load->view('admin/template/layout',$this->data);
	}

	public function delete($id=''){
		$term = Term::find(array('conditions'=>array('id = ? AND type_id = ?',$id,TERM_TYPE_TAG)));
		if(!isset($term)){
			$this->session->set_flashdata('msg','Tag ID not found.');
			$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
			redirect('admin/tag');
		}
		$term->delete();
		$this->session->set_flashdata('msg','Tag has been deleted.');
		$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
		redirect('admin/tag');
	}
	
	/*-- private method --*/
	private function __process_form($is_edit=FALSE,$id=''){
		$term = '';
		
		if($is_edit){ // if form == form edit 
			$term = Term::find(array('conditions'=>array('id'=>$id,'type_id'=>TERM_TYPE_TAG)));
			if(!isset($term)){
				$this->session->set_flashdata('msg','Tag ID not found.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_ERROR);
				redirect('admin/tag');
			}
		}
		else{ // if form == form add
			$term = new Term();
		}
		
		// process input value from form add or edit
		$this->form_validation->set_rules('name','Name','required|trim|xss_clean');
		$this->form_validation->set_rules('description','Description','trim|xss_clean');
		$this->form_validation->set_rules('order_num','Order','integer|trim|xss_clean');
		// check validation
		if($this->form_validation->run()){
			$term->name			= $this->input->post('name');
			$term->description	= $this->input->post('description');
			$term->order_num	= $this->input->post('order_num');
			$term->slug			= url_title($this->input->post('name'),'-',TRUE);
			$term->type_id		= TERM_TYPE_TAG;
			if($term->save()){
				$this->session->set_flashdata('msg','Tag has been saved.');
				$this->session->set_flashdata('msg_type',MSG_TYPE_SUCCESS);
				redirect('admin/tag');
			}
		}
		
		if($is_edit){
			$this->data['is_edit']	= $is_edit;
			$this->data['id']		= $id;
		}
		
		$this->data['is_edit'] = $is_edit;
		$this->data['term'] = $term;
	}
	
}

/* End of file tag.php */
/* Location : application/controllers/admin/tag.php */