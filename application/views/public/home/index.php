<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php foreach($posts as $post):?>
	<code>
		<h2><?php echo $post->title?></h2>
		<?php if(!empty($post->thumbnail)):?>
			<img class="post_thumbnail" src="<?php echo base_url('uploads/thumbnails/'.$post->thumbnail);?>" />
		<?php endif;?>
		
		<?php echo $post->resume;?>
		
		<p><a href="<?php echo site_url('home/article/'.$post->id.'/'.$post->slug); ?>"><?php echo base_url('home/article/'.$post->id.'/'.$post->slug);?></a></p>
	</code>
<?php endforeach;?>

<b>Pagination : </b><?php echo $pagination?>

<!-- CATEGORIES -->
<?php if(isset($categories)):?>
	<code>
		<h2>Categories :</h2>
		<ul>
			<?php foreach($categories as $category):?>
				<li><a href="<?php echo site_url('home/category/'.$category->id.'/'.$category->slug); ?>"><?php echo $category->name?></a></li>
			<?php endforeach;?>
		</ul>
	</code>
<?php endif;?>
<!-- END OF CATEGORIES -->

<!-- TAGS -->
<?php if(isset($tags)):?>
	<code>
		<h2>Tags :</h2>
		<ul>
			<?php foreach($tags as $tag):?>
				<li><a href="<?php echo site_url('home/tag/'.$tag->id.'/'.$tag->slug); ?>"><?php echo $tag->name?></a></li>
			<?php endforeach;?>
		</ul>
	</code>
<?php endif;?>
<!-- END OF TAGS -->
