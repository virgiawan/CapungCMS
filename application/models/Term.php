<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Term extends ActiveRecord\Model{
	
	// define primary key
	static $primary_key = 'id';
	// define table name
	static $table_name = 'terms';

	// define association
	static $has_many = array(
		// association to posts table
		array('post','class_name'=>'PostHasTerm','foreign_key'=>'term_id','primary_key'=>'id'),
		array('post_has_terms','class_name'=>'PostHasTerm'), // mapping in inverse side
		// self association
		array('children','class_name'=>'Term','foreign_key'=>'parent_id','primary_key'=>'id'),
	);
	
	static $belongs_to = array(
		// association to term types table
		array('term_type','class_name'=>'TermType','foreign_key'=>'type_id','primary_key'=>'id'),
		// self association
		array('parent','class_name'=>'Term','foreign_key'=>'parent_id','primary_key'=>'id'),
	);
	
	/*-- define callbacks --*/
	public function delete_related_post(){
		$term_has_posts = PostHasTerm::find('all',array('conditions'=>array('term_id'=>$this->id)));
		if(isset($term_has_posts) && !empty($term_has_posts)){
			PostHasTerm::delete_all(array('conditions'=>array('term_id'=>$this->id)));
		}
		return TRUE;
	}
	
}

/* End of file Term.php */
/* Location : application/models/Term.php */