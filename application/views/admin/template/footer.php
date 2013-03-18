<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- PLACE JAVASCRIPT BELOW -->
<script type="text/javascript" src="<?php echo base_url('resources/_libraries/jquery-1.9.1.min.js'); ?>" ></script>
<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url('resources/_libraries/dataTable/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/_libraries/ckeditor/ckeditor.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/_libraries/jplayer/jquery.jplayer.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('resources/_libraries/jplayer/add-on/jquery.jplayer.inspector.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('resources/_libraries/elfinder/js/elfinder.min.js')?>"></script> -->
<script type="text/javascript" charset="utf-8">
	$('document').ready(function(){
	
		/*-- elfinder --*/
	    /*
var elf = $('#elfinder').elfinder({
			lang: 'no',             // language (OPTIONAL)
			url : '<?php echo base_url('elfinder/elfinder_cont/elfinder_init')?>',  // connector URL (REQUIRED)
			//requestType:'post',
		}).elfinder('instance');
*/
		 
		/*-- jquery dataTable --*/
		$('#capung_table').dataTable({
	        "sScrollY": 300,
	        "bJQueryUI": true,
	        "sPaginationType": "full_numbers",
        });//.fnSort( [ [1,'asc'] ] );
        
        /*-- close message --*/
        $('.close-msg').click(function(){
	       $(this).parent().slideUp('fast');
	       return false;
        });
        
        /*-- jplayer --*/
        $("#jquery_jplayer_2").jPlayer({
	        ready: function () {
	            $(this).jPlayer("setMedia", {
	                flv: "<?php echo isset($post->filename)?base_url('uploads/files/'.$post->filename):'';?>",
	            });
	        },
	        ended: function (event) {
	            $("#jquery_jplayer_2").jPlayer("play", 0);
	        },
	        solution: "flash, html",
	        swfPath: "<?php echo base_url('resources/_libraries/jplayer/swf')?>",
	        supplied: "flv",
	        cssSelectorAncestor: "#jp_interface_2"
	    })
	    .bind($.jPlayer.event.play, function() { // pause other instances of player when current one play
	            $(this).jPlayer("pauseOthers");
	    });
	    
	});
</script>
<!-- END JAVASCRIPT -->
</html>