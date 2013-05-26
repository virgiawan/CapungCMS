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
                                <h1>Reset Password</h1>
                                <p><?php $this->load->view('composite/_message.php'); ?></p>
                                <p> 
                                    <label for="newpass" class="youpasswd" data-icon="p" > New Password </label>
                                    <input id="newpass" name="newpass" required="required" type="password" placeholder="new password"/>
                                    <?php echo form_error('newpass','<span class="field-message">','</span>') ?>
                                </p>
                                <p> 
                                    <label for="confirmpass" class="youpasswd" data-icon="p"> Confirm Password </label>
                                    <input id="confirmpass" name="confirmpass" required="required"  type="password" placeholder="confirm password" /> 
                                     <?php echo form_error('confirmpass','<span class="field-message">','</span>') ?>
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