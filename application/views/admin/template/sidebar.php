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
	</ul>
</div>