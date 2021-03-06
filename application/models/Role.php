<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Role extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = 'id';
	// define table name
	static $table_name = 'roles';
	
	// define association
	static $has_many = array(
		// association to users table
		array('users','class_name'=>'User','foreign_key'=>'role_id','primary_key'=>'id'),
	);
	
}

/* End of file Role.php */
/* Location : application/models/Role.php */