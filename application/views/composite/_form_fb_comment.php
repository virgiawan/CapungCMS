<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
	/*
	|
	| ===========================================================
	| Facebook Comment Configuration
	| ===========================================================
	| initiate Facebook appId and channelUrl
	| configuration from file application/config/facebook.php
	| 
	*/

	// load file config facebook.php in application/config/facebook.php
	$this->config->load('facebook', TRUE);
	$fb_config		= $this->config->item('facebook');
	$fb_appId		= $fb_config['appId'];
	$fb_data_href	= $fb_config['data-href'];

?>
<code>
	<h2>Facebook Comment :</h2>
	
	<div id="fb-root"></div>

	<!-- load Facebook SDK for Javascript -->
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $fb_appId?>";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<div class="fb-comments" data-href="<?php echo $fb_data_href?>" data-width="800" data-num-posts="10"></div>
</code>
