<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PostHasTerm extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = array('id');
	// define table_name
	static $table_name = 'posts_has_terms';
	
	// define association
	static $belongs_to = array(
		array('post','class_name'=>'Post','foreign_key'=>'post_id','primary_key'=>'id'),
		array('term','class_name'=>'Term','foreign_key'=>'term_id','primary_key'=>'id'),
	);
	
}

/* End of file PostHasTerm.php */
/* Location : application/models/PostHasTerm.php */