<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h2>Category : <?php echo $term->name; ?></h2>
<?php foreach($term->post as $has_term):?>
	<?php if($has_term->post->type_id==POST_TYPE_ARTICLE):?>
		<code>
			<h2><?php echo $has_term->post->title?></h2>
			<?php if(!empty($has_term->post->thumbnail)):?>
				<img class="post_thumbnail" src="<?php echo base_url('uploads/thumbnails/'.$has_term->post->thumbnail);?>" />
			<?php endif;?>
			
			<?php echo $has_term->post->resume;?>
			
			<p><a href="<?php echo site_url('home/article/'.$has_term->post->id.'/'.$has_term->post->slug); ?>"><?php echo base_url('home/article/'.$has_term->post->id.'/'.$has_term->post->slug);?></a></p>
		</code>
	<?php endif;?>
<?php endforeach;?>
