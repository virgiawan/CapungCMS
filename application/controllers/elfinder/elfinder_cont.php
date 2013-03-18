<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Elfinder_cont extends CI_Controller{
	
	/*-- constructor --*/
	public function __construct(){
		parent::__construct();
	}
	
	/*-- method-method --*/
	function elfinder_init(){
	  $this->load->helper('path');
	  $opts = array(
	    // 'debug' => true, 
	    'roots' => array(
	      array( 
	        'driver' => 'LocalFileSystem', 
	        'path'   => set_realpath('uploads'.DIRECTORY_SEPARATOR.'files',TRUE),//set_realpath(BASEPATH.'..'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'files',TRUE), 
	        'URL'    => base_url('uploads/files'),
	        // more elFinder options here
	      ) 
	    )
	  );
	  $this->load->library('elfinder_lib', $opts);
	}
	
}

/* End of file elfinder_cont.php */
/* Location : application/controllers/elfinder_cont.php */