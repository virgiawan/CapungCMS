<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PostType extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = 'id';
	// defien table name
	static $table_name = 'post_types';
	
	// define association
	static $has_many = array(
		array('posts','class_name'=>'Post','foreign_key'=>'type_id','primary_key'=>'id'),
	);
	
}

/* End of file PostType.php */
/* Location : application/models/PostType.php */