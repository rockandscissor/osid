<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Open Source Image Duplicator</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->

	<div class="container">
		<div class="sixteen columns">
			<h1 class="remove-bottom" style="margin-top: 40px">OSID</h1>
			<h5>Open Source Image Duplicator</h5>
			<hr />
		</div>
		<div class="sixteen columns">
		    <p>1. Upload your image to the Samba share located at: <strong>\\osid\images</strong><br />2. Refresh this page and select your image from the list below<br />3. Click 'Go' to write to all present removable drives/cards.</p>
		    <p>N.B. Depending on the size of your image file it may take 30 minutes or more to complete the writing of the image</p>
		</div>
		<div class="one-third column">
			<h4>Select an image:</h4>
			<p>
			    <?php
			    //get list of files in the image root
                $ImageFiles = scandir('/etc/osid/imgroot');
                
                //create counter for files
                $countFiles = 0;
                
                //loop through each file that has been found
                foreach ($ImageFiles as &$Filename) {
                    
                    //check that file is not one of these
                    if (!($Filename == '.' || $Filename == '..') && (substr($Filename, -4) == '.img')) {
                        
                        //increment counter
                        $countFiles++;
                ?>
			    <input type="radio" id="ImageToUse<?php echo $countFiles; ?>" name="ImageToUse" value="<?php echo $Filename; ?>" />&nbsp;<?php echo $Filename; ?><br />
			    <?php
                    } //END check that file is not one of these
                    
                } //END loop through each file that has been found
                
                //check if the array is empty
                if ($countFiles == 0) {
			    ?>
			    No image files found
			    <?php
                } //END check if the array is empty
                ?>
			</p>
		</div>
		<div class="one-third column">
            <h4>Choose devices to write to:</h4>
            <p>
                <?php
                //get list of attached devices
                $DeviceList = shell_exec("lsblk -d | awk -F: '{print $1}' | awk '{print $1}'");
                
                //put list into array
                $DeviceArray = explode("\n", $DeviceList);
                
                //create counter
                $countDevices = 1;
                
                //output contents of array
                foreach ($DeviceArray as &$Device) {
                    
                    //check this is not the column header or system device
                    if (!($Device == 'NAME' || $Device == 'mmcblk0' || $Device == '')) {
                    
                        //create device id
                        $DeviceID = str_replace("sd", "", $Device);
                ?>
                <input type="checkbox" id="Device<?php echo strtoupper($DeviceID); ?>" name="Device<?php echo strtoupper($DeviceID); ?>" value="<?php echo $Device; ?>" checked="checked"<?php if ($countFiles == 0) { ?> disabled="disabled"<?php } ?> /> Device <?php echo $countDevices; ?><br />
                <?php
                        //increment counter
                        $countDevices++;
                        
                    } //END check this is not the column header or system device
                
                } //END output contents of array
                ?>
            </p>
        </div>
		<div class="one-third column">
            <h4>Start writing to devices:</h4>
            <p>
                <input type="submit" id="WriteImage" name="WriteImage" value="Write Image to Devices"<?php if ($countFiles == 0) { ?> disabled="disabled" style="color: #666;"<?php } ?> />
            </p>
        </div>
        <div class="sixteen columns">
            <hr />
            <a href="license.txt">
                <img src="images/gplv3.png" width="150" height="60" border="0" align="right" />
            </a>
            <h5>Released by <a href="http://www.rockandscissor.com/" target="_blank">Rock &amp; Scissor Enterprises Limited</a> under the <a href="http://www.gnu.org/licenses/gpl.html">GNU GPLv3</a>.</h5>
        </div>

	</div><!-- container -->


<!-- End Document
================================================== -->
</body>
</html>