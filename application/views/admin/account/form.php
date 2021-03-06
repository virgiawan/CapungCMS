<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo; 
	<a href="<?php echo site_url('admin/account');?>">Account</a> &raquo; 
	<?php if(!$is_edit):?> 
		<a href="#" class="active">Add</a>
	<?php else:?>
		<a href="#" class="active">Edit</a>
	<?php endif;?>
</h2>
<!-- END OF BREADCUMB -->

<!-- MAIN CONTENT -->
<div id="main">
	<?php if(!$is_edit):?>
		<h3>Add Account <a class="btn_add" href="<?php echo  site_url('admin/account') ?>">[ Cancel ]</a> </h3>
		<form action="<?php echo site_url('admin/account/add')?>" method="POST" enctype="multipart/form-data">
	<?php else:?>
		<h3>Edit Account <a class="btn_add" href="<?php echo  site_url('admin/account') ?>">[ Cancel ]</a> </h3>		
		<form action="<?php echo site_url('admin/account/edit/'.$id)?>" method="POST" enctype="multipart/form-data">
	<?php endif;?>
	<fieldset>
		<div class="field <?php echo form_error('username')?'div-error':''; ?>">
			<p>
				<label for="username">Username :</label>
				<input type="text" size="55" placeholder="Enter username here" value="<?php echo set_value('username',$user->username)?>" name='username' <?php echo $is_edit?'disabled':''; ?>/>
				<?php echo $unique_err_username!=''?$unique_err_username:form_error('username','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('email')?'div-error':''; ?>">
			<p>
				<label for="email">Email :</label>
				<input type="text" size="55" placeholder="Enter email here" value="<?php echo set_value('email',$user->email)?>" name='email' <?php echo $is_edit?'disabled':''; ?> />
				<?php echo $unique_err_email!=''?$unique_err_email:form_error('email','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('role')?'div-error':''; ?>">
			<p>
				<label for="role">Role :</label>
				<select name="role">
					<?php foreach($roles as $role):?>
						<option value="<?php echo $role->id; ?>" <?php echo ($user->role_id==$role->id)?'selected':set_select('role',$user->role_id); ?>><?php echo $role->name; ?></option>
					<?php endforeach;?>
				</select>
				<?php echo form_error('role','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('fullname')?'div-error':''; ?>">
			<p>
				<label for="fullname">Fullname :</label>
				<input type="text" size="55" placeholder="Enter fullname here" value="<?php echo set_value('fullname',$user->fullname)?>" name='fullname'/>
				<?php echo form_error('fullname','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<?php if(!$is_edit):?>
		<div class="field <?php echo form_error('password')?'div-error':''; ?>">
			<p>
				<label for="password">Password :</label>
				<input type="password" size="55" placeholder="Enter password here" name='password'/>
				<?php echo form_error('password','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('confirm_password')?'div-error':''; ?>">
			<p>
				<label for="confirm_password">Confirm Password :</label>
				<input type="password" size="55" placeholder="Enter confirm password here" name='confirm_password'/>
				<?php echo form_error('confirm_password','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<?php endif;?>
		<div class="field <?php echo form_error('status')?'div-error':''; ?>">
			<p>
				<label for="status">Status :</label>
				<select name="status">
					<?php foreach($user->options_status() as $key => $value):?>
						<option value="<?php echo $key;?>" <?php echo $user->active==$key?'selected':set_select('status',$key) ?>><?php echo $value;?></option>
					<?php endforeach;?>		
				</select>
			</p>
		</div>
		<div class="field <?php echo form_error('profile_picture')?'div-error':''; ?>">
			<p>
				<label for="profile_picture">Profile Picture :</label>
				<input type="file" name="profile_picture">
				<?php echo isset($image_error)?$image_error:'' ?>
			</p>
			<?php if($is_edit && !empty($user->picture)):?>
				<p>
					<img src="<?php echo base_url('uploads/profile_picture/'.$user->picture); ?>" width="200px" />
					[ <a href="<?php echo site_url('admin/account/remove_profile_picture/'.$user->id); ?>" class="link_manage" >remove</a> ]
				</p>
			<?php endif;?>
		</div>
		<div class="field">
			<p><input type="submit" value="Save" /></p>
		</div>
	</fieldset>
	</form>
</div>
<!-- END OF MAIN CONTENT -->