<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h3>Latest Slide</h3>

<table class="capung_dashboard_table">
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
		<?php foreach($slides as $slide):?>	
			<tr>
				<td>
					<b><?php echo $slide->title; ?></b>
					<p>
						<a class="link_manage" href="<?php echo site_url('admin/slide/show/'.$slide->id)?>">View</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/slide/edit/'.$slide->id); ?>">Edit</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/slide/delete/'.$slide->id); ?>" onclick="return confirm('Are you sure to delete slide : <?php echo $slide->title; ?> ?')" >Delete</a>
					</p>
				</td>
				<td echo="10%"><?php echo $slide->author->fullname; ?></td>
				<td width="40%" align="justify"><?php echo $slide->resume; ?></td>
				<td width="12%"><?php echo $slide->publish_date->format('date'); ?></td>
				<td width="7%"><?php echo $slide->order_num; ?></td>
				<td width="7%"><?php echo $slide->is_published=='1'?'Published':'Draft'?></td>
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