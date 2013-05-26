<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title><?php echo SITE_TITLE; ?></title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('resources/_login_style/demo.css');?>" />
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('resources/_login_style/style.css');?>" />
		<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('resources/_login_style/animate-custom.css');?>" />
    </head>
    <body>
        <div class="container">
            <header>
                <h1><img width="320" src="<?php echo base_url('resources/_login_style/img/capung-cms.png');?>" /></h1>
            </header>
            <section>				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
                           <form action="" method="POST" >
                                <h1>Forget Password</h1>
                                <p><?php $this->load->view('composite/_message.php'); ?></p>
                                <p> 
                                    <label for="email" class="uname" data-icon="u" > Email </label>
                                    <input id="email" name="email" required="required" type="text" placeholder="email"/>
                                    <?php echo form_error('email','<span class="field-message">','</span>') ?>
                                </p>
                                <p>
                                	<label for="captcha" class="youpasswd"> Captcha </label>
                                	<br/><?php echo $captcha;?>
                                	<input id="captcha" name="captcha" required="required"  type="text" placeholder="captcha" /> 
                                    <?php echo form_error('captcha','<span class="field-message">','</span>') ?>
                                </p>
                                <p class="login button" style="margin-top:20px;"> 
                                    <input type="submit" value="Login" /> 
								</p>
							</form>
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
    <script type="text/javascript" src="<?php echo base_url('resources/_libraries/jquery-1.9.1.min.js'); ?>" ></script>
    <script type="text/javascript">
	    $('document').ready(function(){
		     /*-- close message --*/
	        $('.close-msg').click(function(){
		       $(this).parent().slideUp('fast');
		       return false;
	        }); 
	    });
    </script>
</html>