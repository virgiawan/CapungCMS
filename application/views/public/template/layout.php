<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0px 14px 0px;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	
	#form-comment{
		height: 360px;
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0px 14px 0px;
		padding: 12px 10px 12px 10px;
	}
	
	#main-nav{
    	padding: 0 0 20px 0;
    }

    #main-nav ul{
    	list-style: none;
    	margin: 10px 0 10px 0;
    	display: block;
    }

    #main-nav li{
    	float: left;
    	margin: 0 30px 0 0; 
    }
    
    .post_image{
	    width: 50%;
    }
    
    .post_thumbnail{
	    width: 200px;
	    height: 100px;
	    padding: 5px;
	    float: left;
    }
	
</style>

</head>
<body>

<div id="main-nav">
  <ul>
    <li><?php echo anchor('home','Home') ?></li>
    <li><?php echo anchor('home/about_us','About') ?></li>
  </ul>
</div>

<div id="container">
	<h1><?php echo SITE_TITLE; ?>!</h1>
	
		<div id="body">
		<!-- LOAD CONTENT -->
		<?php echo $this->load->view($content); ?>
		<!-- END OF LOAD CONTENT -->
		</div>
		
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>