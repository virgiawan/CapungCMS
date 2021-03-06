<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo; 
	<a href="#" class="active">Article</a>
</h2>
<!-- END OF BREADCUMB -->


<!-- MAIN CONTENT -->
<div id="main">

<h3>Article <a class="btn_add" href="<?php echo  site_url('admin/article/add') ?>">[ Add ]</a> </h3>
<!-- ERROR MESSAGE -->
<?php $this->load->view('composite/_message'); ?>
<!-- END OF ERROR MESSAGE -->
<table id="capung_table">
	<thead>
		<tr>
			<th>Title</th>
			<th>Author</th>
			<th>Description</th>
			<th>Date</th>
			<th>Status</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($posts as $post):?>	
			<tr>
				<td>
					<b><?php echo $post->title; ?></b>
					<p>
						<a class="link_manage" href="<?php echo site_url('admin/article/show/'.$post->id)?>">View</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/article/edit/'.$post->id); ?>">Edit</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/article/delete/'.$post->id); ?>" onclick="return confirm('Are you sure to delete page : <?php echo $post->title; ?> ?')">Delete</a>
					</p>
				</td>
				<td width="10%"><?php echo $post->author->fullname; ?></td>
				<td align="justify" width="45%"><?php echo $post->resume; ?></td>
				<td width="12%"><?php echo $post->publish_date->format('date'); ?></td>
				<td width="10%"><?php echo $post->is_published=='1'?'Published':'Draft'?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	
	<tfoot>
		<tr>
			<td>Title</td>
			<td>Author</td>
			<td>Description</td>
			<td>Date</td>
			<td>Status</td>
		</tr>
	</tfoot>
</table>

</div>
<!-- END OF MAIN CONTENT -->