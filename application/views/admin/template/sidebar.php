<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div id="sidebar">
	<ul class="sideNav">
		<li><a href="#" <?php echo $this->uri->segment(2)=='dashboard'?'class="active"':''; ?> >Dasboard</a></li>
		<li><a href="<?php echo site_url('admin/article')?>" <?php echo $this->uri->segment(2)=='article'?'class="active"':''; ?> >Article</a></li>
		<li><a href="<?php echo site_url('admin/page')?>" <?php echo $this->uri->segment(2)=='page'?'class="active"':''; ?> >Page</a></li>
		<li><a href="<?php echo site_url('admin/gallery')?>" <?php echo $this->uri->segment(2)=='gallery'?'class="active"':''; ?> >Gallery</a></li>
	</ul>
</div>