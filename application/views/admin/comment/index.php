<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="#" class="active">Comment</a>
</h2>
<!-- END OF BREADCUMB -->


<!-- MAIN CONTENT -->
<div id="main">

<h3>Comment</h3>
<!-- ERROR MESSAGE -->
<?php $this->load->view('composite/_message'); ?>
<!-- END OF ERROR MESSAGE -->
<table id="capung_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Post</th>
			<th>Created at</th>
			<th>Content</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($comments as $comment):?>	
			<tr>
				<td width="17%">
					<b><?php echo $comment->author; ?></b>
					<p>
						<a class="link_manage" href="<?php echo site_url('admin/comments/publish/'.$comment->id); ?>"><?php echo $comment->status==0?'Publish':'Hide';?></a> | 
						<a class="link_manage" href="<?php echo site_url('admin/comments/delete/'.$comment->id); ?>" onclick="return confirm('Are you sure to delete comment from : <?php echo $comment->author; ?> ?')" >Delete</a>
					</p>
				</td>
				<td width="17%"><?php echo $comment->post->title; ?></td>
				<td width="17%"><?php echo $comment->created_at->format('datetime'); ?></td>
				<td><?php echo $comment->content; ?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	
	<tfoot>
		<tr>
			<td>Name</td>
			<td>Post</td>
			<td>Created at</td>
			<td>Content</td>
		</tr>
	</tfoot>
</table>

</div>
<!-- END OF MAIN CONTENT -->