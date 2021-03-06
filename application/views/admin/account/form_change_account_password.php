<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="<?php echo site_url('admin/account');?>">Account</a> &raquo; 
	<a href="#" class="active">Change Password</a>
</h2>
<!-- END OF BREADCUMB -->

<!-- MAIN CONTENT -->
<div id="main">
	<h3>Change Password <a class="btn_add" href="<?php echo  site_url('admin/dashboard') ?>">[ Cancel ]</a> </h3>		
	<!-- ERROR MESSAGE -->
	<?php $this->load->view('composite/_message'); ?>
	<!-- END OF ERROR MESSAGE -->
	<form action="" method="POST">
	<fieldset>
		<div class="field">
			<p>
				<label for="username">Username :</label>
				<input type="text" size="45" name="username" value="<?php echo $user->username?>" disabled/>
			</p>
		</div>
		<div class="field <?php echo form_error('new_pass')?'div-error':''; ?>">
			<p>
				<label for="new_pass">New Password :</label>
				<input type="password" size="45" placeholder="Enter new password here" name="new_pass"/>
				<?php echo form_error('new_pass','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('confirm_pass')?'div-error':''; ?>">
			<p>
				<label for="confirm_pass">Retype Password :</label>
				<input type="password" size="45" placeholder="Retype new password here" name="confirm_pass"/>
				<?php echo form_error('confirm_pass','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field">
			<p><input type="submit" value="Save" onclick="return confirm('Are you sure want to change password of this account ?')"/></p>
		</div>
	</fieldset>
	</form>
</div>
<!-- END OF MAIN CONTENT -->