<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="#" class="active">Video</a>
</h2>
<!-- END OF BREADCUMB -->


<!-- MAIN CONTENT -->
<div id="main">

<h3>Video <a class="btn_add" href="<?php echo  site_url('admin/video/add') ?>">[ Add ]</a> </h3>
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
			<th>Order</th>
			<th>Status</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($posts as $post):?>	
			<tr>
				<td>
					<b><?php echo $post->title; ?></b>
					<p>
						<a class="link_manage" href="<?php echo site_url('admin/video/show/'.$post->id)?>">View</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/video/edit/'.$post->id); ?>">Edit</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/video/delete/'.$post->id); ?>" onclick="return confirm('Are you sure to delete video : <?php echo $post->title; ?> ?')" >Delete</a>
					</p>
				</td>
				<td echo="10%"><?php echo $post->author->fullname; ?></td>
				<td width="40%" align="justify"><?php echo $post->resume; ?></td>
				<td width="12%"><?php echo $post->publish_date->format('date'); ?></td>
				<td width="7%"><?php echo $post->order_num; ?></td>
				<td width="7%"><?php echo $post->is_published=='1'?'Published':'Draft'?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	
	<tfoot>
		<tr>
			<td>Title</td>
			<td>Author</td>
			<td>Description</td>
			<td>Date</td>
			<th>Order</th>
			<td>Status</td>
		</tr>
	</tfoot>
</table>

</div>
<!-- END OF MAIN CONTENT -->