<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if($this->session->flashdata('msg')!='' && $this->session->flashdata('msg_type')!=''):?>
	<div class="<?php echo $this->session->flashdata('msg_type'); ?>">
		<?php echo $this->session->flashdata('msg'); ?>
		<a class="close-msg" href="#">X</a>
	</div>
<?php endif;?>