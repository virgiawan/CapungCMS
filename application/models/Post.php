<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Post extends ActiveRecord\Model{
	
		// define primary key
		static $primary_key = 'id';
		// define table name
		static $table_name = 'posts';
		
		// define association
		static $belongs_to = array(
			// association to post type table
			array('post_type','class_name'=>'PostType','foreign_key'=>'type_id','primary_key'=>'id'),
			// association to users table
			array('author','class_name'=>'User','foreign_key'=>'author_id','primary_key'=>'id'),
		);
		
		static $has_many = array(
			// association to comments table
			array('comments','class_name'=>'Comment','foreign_key'=>'post_id','primary_key'=>'id','conditions'=>array('status = ?',1)),
			// association to terms table
			array('post_has_terms','class_name'=>'PostHasTerm','foreign_key'=>'post_id','primary_key'=>'id'),
			array('terms','through'=>'post_has_terms'),
		);
		
		// excute callbacks
		static $after_destroy = array('delete_related_terms','delete_related_comments');
		
		/*-- define callbacks method --*/
		public function delete_related_terms(){
			$terms = PostHasTerm::find_by_sql("
				SELECT * FROM posts_has_terms pht, terms t
				WHERE pht.post_id='".$this->id."' AND pht.term_id=t.id
				ORDER BY pht.order_num ASC
			");
			if(isset($terms)){
				foreach($terms as $temp){
					$term = Term::find($temp->id);
					$term->count -= 1;
					$term->save();
				}
				PostHasTerm::delete_all(array('conditions'=>array('post_id'=>$this->id)));
			}
			return TRUE;
		}
		
		public function delete_related_comments(){
			$comments = Comment::find('all',array('conditions'=>array('post_id = ?',$this->id)));
			if(isset($comments)){
				Comment::delete_all(array('conditions'=>array('post_id'=>$this->id)));
			}
			return TRUE;
		}
		
		/*-- define another method --*/
		// function for get listed category
		public function get_categories(){
			return Term::find('all',array('type_id'=>TERM_TYPE_CATEGORY));
		}
		// function for get listed tags
		public function get_tags(){
			return Term::find('all',array('type_id'=>TERM_TYPE_TAG));
		}
		// function for make options commentable in form article, page, etc
		public function options_commentable(){
			return array('0' => 'No', '1' => 'Yes');
		}
		// function for make options status in form article, page, etc		
		public function options_status(){
			return array('0' => 'Draft', '1' => 'Published');
		}
		// functiion get related tags
		public function get_related_tags(){
			$tags = PostHasTerm::find_by_sql("
				SELECT * FROM posts_has_terms pht, terms t
				WHERE pht.post_id='".$this->id."' AND pht.term_id=t.id
				AND t.type_id='".TERM_TYPE_TAG."' ORDER BY pht.order_num ASC
			");
			return $tags;
		}
		// function get related categories
		public function get_related_categories(){
			$categories = PostHasTerm::find_by_sql("
				SELECT * FROM posts_has_terms pht, terms t
				WHERE pht.post_id='".$this->id."' AND pht.term_id=t.id
				AND t.type_id='".TERM_TYPE_CATEGORY."' ORDER BY pht.order_num ASC
			");
			return $categories; 
		}
		
	}

/* End of file Post.php  */
/* Location : application/models/Post.php */