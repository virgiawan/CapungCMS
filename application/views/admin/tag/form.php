<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="<?php echo site_url('admin/tag')?>" >Tag</a> &raquo;
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
		<h3>Add Tag <a class="btn_add" href="<?php echo  site_url('admin/tag') ?>">[ Cancel ]</a> </h3>
		<form action="<?php echo site_url('admin/tag/add')?>" method="POST">
	<?php else:?>
		<h3>Edit Tag <a class="btn_add" href="<?php echo  site_url('admin/tag') ?>">[ Cancel ]</a> </h3>		
		<form action="<?php echo site_url('admin/tag/edit/'.$id)?>" method="POST">
	<?php endif;?>
	<fieldset>
		<div class="field <?php echo form_error('name')?'div-error':''; ?>">
			<p>
				<label for="name">Name :</label>
				<input type="text" size="90" placeholder="Enter name here" value="<?php echo set_value('title',$term->name)?>" name='name'/>
				<?php echo form_error('name','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('description')?'div-error':''; ?>">
			<p>
				<label for="description">Description :</label>
				<textarea style="width:400px;height:100px;" name="description" placeholder="Enter description here"><?php echo set_value('description',$term->description)?></textarea>
				<?php echo form_error('description','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('order_num')?'div-error':''; ?>">
			<p>
				<label for="order_num">Order</label>
				<select name="order_num">
					<?php for($i=0;$i<=10;$i++):?>
						<option value="<?php echo $i?>" <?php echo $term->order_num==$i?'selected':set_select('order_num',$term->order_num);?>><?php echo $i?></option>
					<?php endfor;?>
				</select>
				<?php echo form_error('order_num','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field">
			<p><input type="submit" value="Save" /></p>
		</div>
	</fieldset>
	</form>
</div>
<!-- END OF MAIN CONTENT -->