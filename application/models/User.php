<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = 'id';
	// define table_name
	static $table_name = 'users';
	
	// define association
	static $belongs_to = array(
		// association to roles table
		array('role','class_name'=>'Role','foreign_key'=>'role_id','primary_key'=>'id'),
	); 
	
	static $has_many = array(
		// association to posts table
		array('posts','class_name'=>'Post','foreign_key'=>'author_id','primary_key'=>'id'),
	);
	
}

/* End of file User.php */
/* Location : application/models/User.php */