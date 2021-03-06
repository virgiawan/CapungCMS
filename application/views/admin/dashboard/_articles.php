<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h3>Latest Article</h3>

<table class="capung_dashboard_table">
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
		<?php foreach($articles as $article):?>	
			<tr>
				<td width="35%">
					<b><?php echo $article->title; ?></b>
					<p>
						<a class="link_manage" href="<?php echo site_url('admin/article/show/'.$article->id)?>">View</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/article/edit/'.$article->id); ?>">Edit</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/article/delete/'.$article->id); ?>" onclick="return confirm('Are you sure to delete page : <?php echo $article->title; ?> ?')">Delete</a>
					</p>
				</td>
				<td width="10%"><?php echo $article->author->fullname; ?></td>
				<td align="justify"><?php echo $article->resume; ?></td>
				<td width="12%"><?php echo $article->publish_date->format('date'); ?></td>
				<td width="10%"><?php echo $article->is_published=='1'?'Published':'Draft'?></td>
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