<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a> &raquo;
	<a href="<?php echo site_url('admin/video')?>" >Video</a> &raquo;
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
		<h3>Add Video <a class="btn_add" href="<?php echo  site_url('admin/video') ?>">[ Cancel ]</a> </h3>
		<form action="<?php echo site_url('admin/video/add')?>" method="POST" enctype="multipart/form-data">
	<?php else:?>
		<h3>Edit Video <a class="btn_add" href="<?php echo  site_url('admin/video') ?>">[ Cancel ]</a> </h3>		
		<form action="<?php echo site_url('admin/video/edit/'.$id)?>" method="POST" enctype="multipart/form-data">
	<?php endif;?>
	<fieldset>
		<div class="field <?php echo form_error('publish_date')?'div-error':''; ?>">
			<p>
				<label for="publish_date">Publish date :</label>
				<input class="datepicker" type="text" placeholder="Please pick publish date" size="23" value="<?php echo date('d-m-Y')?>" name="publish_date"/>
				<?php echo form_error('publish_date','<span class="publish_date">','</span>') ?>
			</p>	
		</div>
		<div class="field <?php echo form_error('title')?'div-error':''; ?>">
			<p>
				<label for="title">Title :</label>
				<input type="text" size="90" placeholder="Enter title here" value="<?php echo set_value('title',$post->title)?>" name='title'/>
				<?php echo form_error('title','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<!-- IF DUAL LANGUAGE SET ON [TITLE] -->
		<?php if($this->config->item('capung_dual_lang')):?>
		<div class="field <?php echo form_error('title_alt')?'div-error':''; ?>">
			<p>
				<label for="title_alt">Title (lang) :</label>
				<input type="text" size="90" placeholder="Enter title with other language here" value="<?php echo set_value('title_alt',$post->title_alt)?>" name='title_alt'/>
				<?php echo form_error('title_alt','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<?php endif;?>
		<div class="field <?php echo form_error('resume')?'div-error':''; ?>">
			<p>
				<label for="resume">Resume :</label>
				<textarea style="width:400px;height:100px;" name="resume" placeholder="Enter resume here"><?php echo set_value('resume',$post->resume)?></textarea>
				<?php echo form_error('resume','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<!-- IF DUAL LANGUAGE SET ON [RESUME] -->
		<?php if($this->config->item('capung_dual_lang')):?>
		<div class="field <?php echo form_error('resume_alt')?'div-error':''; ?>">
			<p>
				<label for="resume_alt">Resume (lang) :</label>
				<textarea style="width:400px;height:100px;" name="resume_alt" placeholder="Enter resume with other language here"><?php echo set_value('resume_alt',$post->resume_alt)?></textarea>
				<?php echo form_error('resume_alt','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<?php endif;?>
		<div class="field <?php echo form_error('video')?'div-error':''; ?>">
			<p>
				<label for="video">Video :</label>
				<input type="file" name="video">
				<?php echo isset($video_error)?$video_error:'' ?>
			</p>
			<?php if($is_edit && !empty($post->filename)):?>
				<p>
					<?php echo base_url('uploads/files/'.$post->filename); ?>
					[ <a href="<?php echo site_url('admin/video/remove_upload/'.$post->id.'/video'); ?>" class="link_manage" >remove</a> ]
				</p>
			<?php endif;?>
		</div>
		<div class="field <?php echo form_error('status')?'div-error':''; ?>">
			<p>
				<label for="status">Status :</label>
				<select name="status">
					<?php foreach($post->options_status() as $key=>$value):?>
						<option value="<?php echo $key;?>" <?php echo ($post->is_published==$key)?'selected':set_select('status',$post->is_published); ?>><?php echo $value?></option>
					<?php endforeach;?>
				</select>
				<?php echo form_error('status','<span class="field-message">','</span>') ?>
			</p>
		</div>
		<div class="field <?php echo form_error('order_num')?'div-error':''; ?>">
			<p>
				<label for="order_num">Order</label>
				<select name="order_num">
					<?php for($i=0;$i<=10;$i++):?>
						<option value="<?php echo $i?>" <?php echo $post->order_num==$i?'selected':set_select('order_num',$post->order_num);?>><?php echo $i?></option>
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