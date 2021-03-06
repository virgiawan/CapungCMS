<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User extends ActiveRecord\Model{
	
	// define table_name
	static $table_name = 'users';
	// define primary key
	static $primary_key = 'id';
	
	/**-- validate --**/
	static $validates_uniqueness_of = array(
		array('username'),
	);

	// define association
	static $belongs_to = array(
		// association to roles table
		array('role','class_name'=>'Role','foreign_key'=>'role_id','primary_key'=>'id'),
	); 
	
	static $has_many = array(
		// association to posts table
		array('posts','class_name'=>'Post','foreign_key'=>'author_id','primary_key'=>'id'),
	);
	
	/*-- define another method --*/
	// function for make options status user
	public function options_status(){
		return array('0' => 'No', '1' => 'Yes');
	}
	// function for convert role id of user to role name
	public function role_name(){
		$role = 'Not set.';
		switch($this->role_id){
			case '1' 	: $role = 'Superadmin';
				break;
			case '2'	: $role = 'Administrator';
				break;	 	
		};
		return $role;
	}
	
}

/* End of file User.php */
/* Location : application/models/User.php */