<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="#" class="active">Account</a>
</h2>
<!-- END OF BREADCUMB -->


<!-- MAIN CONTENT -->
<div id="main">

<h3>Account <a class="btn_add" href="<?php echo  site_url('admin/account/add') ?>">[ Add ]</a> </h3>
<!-- ERROR MESSAGE -->
<?php $this->load->view('composite/_message'); ?>
<!-- END OF ERROR MESSAGE -->
<table id="capung_table">
	<thead>
		<tr>
			<th>Email</th>
			<th>Username</th>
			<th>Fullname</th>
			<th>Role</th>
			<th>Status</th>
		</tr>
	</thead>
	
	<tbody>
		<?php foreach($users as $user):?>	
			<tr>
				<td width="30%">
					<b><?php echo $user->email; ?></b>
					<p>
						<a class="link_manage" href="#" onclick="return false;">View</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/account/edit/'.$user->id); ?>">Edit</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/account/change_account_password/'.$user->id); ?>">Change Password</a> | 
						<a class="link_manage" href="<?php echo site_url('admin/account/delete/'.$user->id); ?>" onclick="return confirm('Are you sure to delete account : <?php echo $user->username; ?> ?')" >Delete</a>
					</p>
				</td>
				<td echo="10%"><?php echo $user->username; ?></td>
				<td width="30%"><?php echo $user->fullname; ?></td>
				<td width="10%"><?php echo $user->role_name(); ?></td>
				<td width="10%"><?php echo $user->active=='1'?'Active':'Not active'; ?></td>
			</tr>
		<?php endforeach;?>
	</tbody>
	
	<tfoot>
		<tr>
			<td>Email</td>
			<td>Username</td>
			<td>Fullname</td>
			<td>Role</td>
			<td>Status</td>
		</tr>
	</tfoot>
</table>

</div>
<!-- END OF MAIN CONTENT -->