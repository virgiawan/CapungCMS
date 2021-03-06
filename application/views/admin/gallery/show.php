<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="<?php echo site_url('admin/gallery')?>">Gallery</a> &raquo;
	<a href="#" class="active">View</a>
</h2>
<!-- END OF BREADCUMB -->

<!-- MAIN CONTENT -->
<div id="main">
	<h3>View Gallery : <?php echo $post->title?><a class="btn_add" href="<?php echo  site_url('admin/gallery') ?>">[ Cancel ]</a> </h3>
	<table>
		<tr class="odd">
			<td width="20%">Publish date</td>
			<td><?php echo $post->publish_date->format('datetime');?></td>
		</tr>
		<tr class="odd">
			<td width="20%">Title</td>
			<td><?php echo $post->title;?></td>
		</tr>
		<?php if($this->config->item('capung_dual_lang')):?>
		<tr class="odd">
			<td>Title (lang)</td>
			<td><?php echo $post->title_alt;?></td>
		</tr>
		<?php endif;?>
		<tr class="odd">
			<td>Resume</td>
			<td align="justify"><?php echo $post->resume;?></td>
		</tr>
		<?php if($this->config->item('capung_dual_lang')):?>
		<tr class="odd">
			<td>Resume (lang)</td>
			<td align="justify"><?php echo $post->resume_alt;?></td>
		</tr>
		<?php endif;?>
		<?php if(!empty($post->thumbnail)):?>
		<tr class="odd">
			<td>Thumbnail</td>
			<td><img src="<?php echo base_url('uploads/thumbnails/'.$post->thumbnail)?>" width="200px" /></td>
		</tr>
		<?php endif;?>
		<?php if(!empty($post->filename)):?>
		<tr class="odd">
			<td>Image</td>
			<td><img src="<?php echo base_url('uploads/images/'.$post->filename)?>" width="200px" /></td>
		</tr>
		<?php endif;?>
		<tr class="odd">
			<td>Commentable</td>
			<td><?php echo $post->is_commentable==0?'No':'Yes'; ?></td>
		</tr>
		<tr class="odd">
			<td>Status</td>
			<td><?php echo $post->is_published==0?'No':'Yes'; ?></td>
		</tr>
		<tr class="odd">
			<td>Order Number</td>
			<td><?php echo $post->order_num; ?></td>
		</tr>
		<tr class="odd">
			<td>Categories</td>
			<td>
				<?php 
					$categories = $post->get_related_categories();
					$populate_category = array(); 
					foreach($categories as $category){
						array_push($populate_category, $category->name);
					}
					echo implode(', ', $populate_category);
				?>
			</td>
		</tr>
		<tr class="odd">
			<td>Tags</td>
			<td>
				<?php 
					$tags = $post->get_related_tags();
					$populate_tag = array(); 
					foreach($tags as $tag){
						array_push($populate_tag, $tag->name);
					}
					echo implode(', ', $populate_tag);
				?>
			</td>
		</tr>
	</table>
</div>
<!-- END OF AIN CONTENT -->