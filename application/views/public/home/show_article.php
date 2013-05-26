<?php if(!defined('BASEPATH')) exit('No direct script accesss allowed');?>

<code>
	<h2><?php echo $post->title; ?></h2>
	
	<?php if(!empty($post->filename)):?>
		<img class="post_image" src="<?php echo base_url('uploads/images/'.$post->filename);?>" />
	<?php endif;?>
	
	<!-- CONTENT -->
	<?php echo $post->content; ?>
	<!-- END OF CONTENT -->
	
	<?php
		
		/*-- build tags --*/
		$arr_tag = array();
		foreach($post->get_related_tags() as $tag){
			$str = "<a href=".site_url('home/tag/'.$tag->id.'/'.$tag->slug).">".$tag->name."</a>";
			array_push($arr_tag, $str);	
		}
		
		/*-- build categories --*/
		$arr_category = array();
		foreach($post->get_related_categories() as $category){
			$str = "<a href=".site_url('home/category/'.$category->id.'/'.$category->slug).">".$category->name."</a>";
			array_push($arr_category, $str);	
		}
		
	?>
</code>

<code>
	<p><b>Categories : </b> <?php echo implode($arr_category,', '); ?></p>
</code>

<code>
	<p><b>Tags : </b> <?php echo implode($arr_tag,', '); ?></p>
</code>

<?php if($post->is_commentable):?>
	<?php $this->load->view('public/home/_comment_form'); ?>
<?php endif;?>

<?php if($post->is_commentable and $this->config->item('fb_comment')):?>
	<?php $this->load->view('composite/_form_fb_comment')?>
<?php endif;?>