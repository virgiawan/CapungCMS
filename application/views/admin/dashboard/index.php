<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- BREADCUMB -->
<h2>
	<a href="#">Dashboard</a> &raquo; 
</h2>
<!-- END OF BREADCUMB -->


<!-- MAIN CONTENT -->
<div id="main">

<!-- TABLE FOR LATEST ARTICLES -->
<?php $this->load->view('admin/dashboard/_articles'); ?>
<!-- END OF TABLE FOR LATEST ARTICLES -->

<div class="clear" style="margin-bottom:50px;margin-top:50px;"></div>

<!-- TABLE FOR LATEST SLIDES -->
<?php $this->load->view('admin/dashboard/_slides'); ?>
<!-- END OF TABLE FOR LATEST SLIDES -->

<div class="clear" style="margin-bottom:50px;margin-top:50px;"></div>

<!-- TABLE FOR LATEST SLIDES -->
<?php $this->load->view('admin/dashboard/_comments'); ?>
<!-- END OF TABLE FOR LATEST SLIDES -->

</div>
<!-- END OF MAIN CONTENT -->