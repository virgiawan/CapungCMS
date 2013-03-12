<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- HEADER -->
<!-- Load from header.php-->
	<?php $this->load->view('admin/template/header'); ?>
<!-- Location : views/admin/template/header.php -->
<!-- END OF HEADER -->


<body>
<!--[if lt IE 7]>
<p class="chrome-frame">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
<![endif]-->

	<!-- WRAPPER -->
	<div id="wrapper">
		
		<!-- TITLE -->
    	<!-- h1 tag stays for the logo, you can use the a tag for linking the index page -->
    	<h1><a href="#"><span><?php echo ADMIN_TITLE; ?></span></a></h1>
    	<!-- END OF TITLE -->
        
        
        <!-- MAIN NAV -->
        <!-- You can name the links with lowercase, they will be transformed to uppercase by CSS, we prefered to name them with uppercase to have the same effect with disabled stylesheet -->
        <ul id="mainNav">
        	<li><a href="#" class="active">DASHBOARD</a></li> <!-- Use the "active" class for the active menu item  -->
        	<li><a href="#">ADMINISTRATION</a></li>
        	<li><a href="#">DESIGN</a></li>
        	<li><a href="#">OPTION</a></li>
        	<li class="logout"><a href="#">LOGOUT</a></li>
        </ul>
        <!--  END OF MAIN NAV -->
        
        
        <!-- CONTAINER HOLDER -->
        <div id="containerHolder">
        	<!-- CONTAINER -->
			<div id="container">
        		<!-- SIDEBAR NAV -->
        			<?php $this->load->view('admin/template/sidebar');?>    
                <!-- END OF SIDEBAR NAV -->
                
                <!-- MAIN CONTENT -->
                	<?php $this->load->view($content);?>
                <!-- END OF MAIN CONTENT -->
                
                <div class="clear"></div>
            </div>
            <!-- END OF CONTAINER -->
        </div>	
        <!-- END OF CONTAINER HOLDER -->
        
        
        <p id="footer">CapungCMS &copy; Capung 2013</p>
    </div>
    <!-- END OF WRAPPER -->
    
</body>



<!-- FOOTER -->
<!-- Load from footer.php -->
	<?php $this->load->view('admin/template/footer'); ?>
<!-- Location : views/admin/template/footer.php -->
<!-- END OF FOOTER -->
