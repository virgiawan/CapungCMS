<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class TermType extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = 'id';
	// define table name
	static $table_name = 'term_types';
	
	// define association
	static $has_many = array(
		// association to terms table
		array('terms','class_name'=>'Term','foreign_key'=>'type_id','primary_key'=>'id'),
	);
	
}

/* End of file TermType.php */
/* Location : application/models/TermType.php */