<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Capung CMS</title>
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('resources/_login_style/demo.css');?>" />
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('resources/_login_style/style.css');?>" />
		<link rel="stylesheet" media="screen" type="text/css" href="<?php echo base_url('resources/_login_style/animate-custom.css');?>" />
    </head>
    <body>
        <div class="container">
            <header>
                <h1>Capung CMS</h1>
            </header>
            <section>				
                <div id="container_demo" >
                    <div id="wrapper">
                        <div id="login" class="animate form">
                           <form action="" method="POST" >
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="username"/>
                                    <?php echo form_error('username','<span class="field-message">','</span>') ?>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="password" /> 
                                     <?php echo form_error('password','<span class="field-message">','</span>') ?>
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
							</form>
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>