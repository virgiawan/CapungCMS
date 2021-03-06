<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = 'id';
	// define table name
	static $table_name = 'comments';
	
	// define association
	static $belongs_to = array(
		array('post','class_name'=>'Post','foreign_key'=>'post_id','primary_key'=>'id'),
	);
		
}
/* End of file Comment.php */
/* Location : application/models/Comment.php */