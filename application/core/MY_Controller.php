<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	/* Define attribute */
	protected $data;
	
	/*-- Constructor --*/
	public function __construct(){
		parent::__construct();
		// define format time for active record
		ActiveRecord\DateTime::$FORMATS['datetime'] = 'd-m-Y | H:i:s';
		ActiveRecord\DateTime::$FORMATS['datetime_db'] = 'Y-m-d H:i:s';
		ActiveRecord\DateTime::$FORMATS['date'] = 'd-m-Y';
		ActiveRecord\DateTime::$FORMATS['date_db'] = 'Y-m-d';
	}
	
}

/* End of file MY_Controller.php */
/* Location : applications/core/MY_Controller.php */