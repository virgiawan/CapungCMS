<?php if(!defined('BASEPATH')) exit('No direct script accesss allowed');?>

<h2><?php echo $post->title; ?></h2>

<?php if(!empty($post->filename)):?>
	<img class="post_image" src="<?php echo base_url('uploads/images/'.$post->filename);?>" />
<?php endif;?>

<!-- CONTENT -->
<?php echo $post->content; ?>
<!-- END OF CONTENT -->