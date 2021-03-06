<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="#" class="active">Category</a>
</h2>
<!-- END OF BREADCUMB -->


<!-- MAIN CONTENT -->
<div id="main">

<h3>Category <a class="btn_add" href="<?php echo  site_url('admin/category/add') ?>">[ Add ]</a> </h3>
<!-- ERROR MESSAGE -->
<?php $this->load->view('composite/_message'); ?>
<!-- END OF ERROR MESSAGE -->
<table id="capung_table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Order</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($terms as $term):?>	
			<tr>
				<td width="40%">
					<b><?php echo $term->name; ?></b>
					<p>
						<a class="link_manage" href="#" onclick="return false;">View</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/category/edit/'.$term->id); ?>">Edit</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/category/delete/'.$term->id); ?>" onclick="return confirm('Are you sure to delete category : <?php echo $term->name; ?> ?')" >Delete</a>
					</p>
				</td>
				<td echo="10%"><?php echo $term->description; ?></td>
				<td width="7%"><?php echo $term->order_num; ?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	
	<tfoot>
		<tr>
			<td>Name</td>
			<td>Description</td>
			<td>Order</td>
		</tr>
	</tfoot>
</table>

</div>
<!-- END OF MAIN CONTENT -->