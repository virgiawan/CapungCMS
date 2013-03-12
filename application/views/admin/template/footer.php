<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- PLACE JAVASCRIPT BELOW -->
<script type="text/javascript" src="<?php echo base_url('resources/_library/jquery-1.9.1.min.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo base_url('resources/_library/dataTable/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/_library/ckeditor/ckeditor.js')?>"></script>
<script type="text/javascript">
	$('document').ready(function(){
		$('#capung_table').dataTable( {
	        "sScrollY": 300,
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers"
        } );
        
        $('.close-msg').click(function(){
	       $(this).parent().slideUp('fast');
	       return false;
        });
	});
</script>
<!-- END JAVASCRIPT -->

</html>