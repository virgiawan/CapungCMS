<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="sidebar">
	<ul class="sideNav">
		<li><h3>CONTENT</h3></li>
		<li><a href="<?php echo site_url('admin/article')?>" <?php echo $this->uri->segment(2)=='article'?'class="active"':''; ?> >Article</a></li>
		<li><a href="<?php echo site_url('admin/page')?>" <?php echo $this->uri->segment(2)=='page'?'class="active"':''; ?> >Page</a></li>
		<li><a href="<?php echo site_url('admin/gallery')?>" <?php echo $this->uri->segment(2)=='gallery'?'class="active"':''; ?> >Gallery</a></li>
		<li><a href="<?php echo site_url('admin/slide')?>" <?php echo $this->uri->segment(2)=='slide'?'class="active"':''; ?> >Slide</a></li>
		<li><a href="<?php echo site_url('admin/video')?>" <?php echo $this->uri->segment(2)=='video'?'class="active"':''; ?> >Video</a></li>
		
		<li><h3>TERM</h3></li>
		<li><a href="<?php echo site_url('admin/category')?>" <?php echo $this->uri->segment(2)=='category'?'class="active"':''; ?> >Category</a></li>
		<li><a href="<?php echo site_url('admin/tag')?>" <?php echo $this->uri->segment(2)=='tag'?'class="active"':''; ?> >Tag</a></li>
	
		<li><h3>MANAGE</h3></li>
		<!-- <li><a href="#">File</a></li> -->
		<li><a href="<?php echo site_url('admin/comments')?>" <?php echo $this->uri->segment(2)=='comments'?'class="active"':''; ?> >Comments</a></li>
		<!-- <li><a href="#">Advertising</a></li> -->
		<?php if($this->session->userdata('user_role')==ROLE_SUPERADMIN):?>
		<li><a href="<?php echo site_url('admin/account')?>" <?php echo (($this->uri->segment(3)=='index' and $this->uri->segment(2)=='account') or ($this->uri->segment(3)=='' and $this->uri->segment(2)=='account'))?'class="active"':''; ?> >Account</a></li>
		<?php endif;?>
	</ul>
</div>