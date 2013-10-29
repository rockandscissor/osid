<?php
// /usr/bin/dcfldd bs=4M if=/etc/osid/imgroot/cloudmonitor-probe-2-4.img of=/dev/sda of=/dev/sdb of=/dev/sdc sizeprobe=if statusinterval=1 2> /etc/osid/system/progress.info

//check if the form has been submitted
if (isset($_POST['WriteImage'])) {
    
    //make sure imagefile.info is blank
    shell_exec("cat /dev/null > /etc/osid/system/imagefile.info");
    
    //write selected image to the info file
    shell_exec("echo \"" . $_POST['ImageToUse'] . "\" > /etc/osid/system/imagefile.info");
    
    //create device list from checkbox array
    foreach ($_POST['Device'] as &$DeviceName) {
        
        //put device into variable for use in dcfldd command
        $DeviceList .= "of=/dev/" . $DeviceName . " ";
        
        //put device into variable for unmounting of drives
        $UmountList .= "/usr/bin/umount /dev/" . $DeviceName . " & ";
        
    } //END create device list from checkbox array
    
    //trim off trailing space from device list varaible
    $DeviceList = rtrim($DeviceList);
    
    //trim off trailing space from umount list variable
    $UmountList = substr($UmountList, 0, -3);
    
    //make sure devicelist.info is blank
    shell_exec("cat /dev/null > /etc/osid/system/devicelist.info");
    
    //write devices to the info file
    shell_exec("echo \"" . $DeviceList . "\" > /etc/osid/system/devicelist.info");
    
    //make sure umountlist.info is blank
    shell_exec("cat /dev/null > /etc/osid/system/umountlist.info");
    
    //write devices to the info file
    shell_exec("echo \"" . $UmountList . "\" > /etc/osid/system/umountlist.info");
    
    //make sure imagefile.info is blank
    shell_exec("cat /dev/null > /etc/osid/system/status.info");
    
    //write selected image to the info file
    shell_exec("echo \"1\" > /etc/osid/system/status.info");
    
} //END check if the form has been submitted
?>
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
	
	<script src="scripts/ajax.js" type="text/javascript"></script>
	<script type="text/javascript">
	function startMonitor() {

        xmlhttp=GetXmlHttpObject();
    
        if (xmlhttp==null) {
            
            alert ("Browser does not support HTTP Request");
            return;
            
        }
        
        var url="monitor.php?sid="+Math.random();
    
        xmlhttp.onreadystatechange=stateStartMonitor;
        xmlhttp.open("GET",url,true);
        xmlhttp.send(null);
        
    }
    
    function stateStartMonitor() {
        
        if (xmlhttp.readyState==4) {
            
            if (xmlhttp.responseText == 'Error') {
                
                alert("There was problem checking progress");
            
            } else {
                
                var writeInfoArray = xmlhttp.responseText.split("|");
                
                if (writeInfoArray[2] != 'in' && writeInfoArray[2] != 'out' && writeInfoArray[2] != '') {
                
                    percentCompleted = parseInt(writeInfoArray[0]);
                    totalFileSize = parseInt(writeInfoArray[1]);
                    fileSizeWritten = parseInt(writeInfoArray[2]);
                    timeRemaining = writeInfoArray[3];
                    
                    if (percentCompleted > 6 && percentCompleted <= 100) {
                        document.getElementById('progress_bar').style.width = percentCompleted+'%';
                        document.getElementById('unprogress_bar').style.width = (100 - percentCompleted)+'%';
                    }
                    document.getElementById('progress_bar').innerHTML = percentCompleted+'%';
                    
                    var timeArray = timeRemaining.split(":");
                    
                    var timeHours = parseInt(timeArray[0]);
                    var timeMinutes = parseInt(timeArray[1]);
                    var timeSeconds = parseInt(timeArray[2]);
                    
                    if (timeHours > 0) {
                        
                        if (timeHours > 1) {
                            hoursText = 'hours';
                        } else {
                            hoursText = 'hour';
                        }
                        document.getElementById('StatusMessage').innerHTML = '<strong>'+fileSizeWritten+'Mb</strong> of <strong>'+totalFileSize+'Mb</strong> written to device(s). <strong>' + timeHours + '</strong> ' + hourText + ' <strong>' + timeMinutes + '</strong> minutes remaining...';
                        
                    } else if (timeMinutes > 0) {
                        
                        if (timeMinutes > 1) {
                            minutesText = 'minutes';
                        } else {
                            minutesText = 'minute';
                        }
                        document.getElementById('StatusMessage').innerHTML = '<strong>'+fileSizeWritten+'Mb</strong> of <strong>'+totalFileSize+'Mb</strong> written to device(s). <strong>'+timeMinutes+'</strong> '+minutesText+' remaining...';
                        
                    } else {
                        
                        if (timeSeconds > 1) {
                            secondsText = 'seconds';
                        } else {
                            secondsText = 'second';
                        }
                        document.getElementById('StatusMessage').innerHTML = '<strong>'+fileSizeWritten+'Mb</strong> of <strong>'+totalFileSize+'Mb</strong> written to device(s). <strong>'+timeSeconds+'</strong> '+secondsText+' remaining...';
                        
                    }
                    
                    waitTime();
                    
                } else if (writeInfoArray[2] != 'out') {
                    
                    document.getElementById('progress_bar').style.width = '100%';
                    document.getElementById('progress_bar').style.backgroundColor = '#00CC33';
                    document.getElementById('progress_bar').innerHTML = 'Done...';
                    document.getElementById('unprogress_bar').style.width = '0%';
                    document.getElementById('StatusMessage').innerHTML = 'Completed writing to device(s)';
                    
                } else {
                    
                    document.getElementById('StatusMessage').innerHTML = 'Waiting for device(s) to be ready...';
                    
                }
            
            }
        
        }
    
    }
    
    function waitTime() {
        setTimeout("startMonitor()", 1000);
    }
	</script>

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
		<div class="sixteen columns osid_icon">
			<h1 class="remove-bottom" style="margin-top: 40px; padding-left: 85px;">OSID</h1>
			<h5 style="padding-left: 85px;">Open Source Image Duplicator v1.0</h5>
			<hr />
		</div>
		<div class="sixteen columns">
		    <p>1. Upload your image to the Samba share located at: <strong>\\osid\images</strong> (Windows) or <strong>smb://osid/images</strong> (Mac/Linux)<br />2. Refresh this page and select your image from the list below<br />3. Click 'Go' to write to all present removable drives/cards.</p>
		    <p>N.B. Depending on the size of your image file it may take 30 minutes or more to complete the writing of the image</p>
		</div>
		<div class="one-third column">
		    <form id="WriteForm" name="WriteForm" action="/" method="POST">
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
                    if (substr($Filename, -4) == '.img') {
                            
                        //create file size variable
                        $FileSizeB = explode(" ", shell_exec("ls -s /etc/osid/imgroot/" . $Filename), 1);
                        $FileSizeGB = round(($FileSizeB[0] / 1024) / 1024, 2);
                        
                        //increment counter
                        $countFiles++;
                ?>
			    <input type="radio" id="ImageToUse<?php echo $countFiles; ?>" name="ImageToUse" value="<?php echo $Filename; ?>"<?php if ($countFiles == 1) { ?> checked="checked"<?php } ?> />&nbsp;<?php echo $Filename; ?> (<?php echo $FileSizeGB; ?>GB)<br />
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
                        
                        //create device size in gb
                        $DeviceSize = round(((shell_exec("cat /sys/block/sd" . $DeviceID . "/size") / 2) / 1024) / 1024, 2);
                ?>
                <input type="checkbox" id="Device<?php echo strtoupper($DeviceID); ?>" name="Device[]" value="<?php echo $Device; ?>" checked="checked"<?php if ($countFiles == 0) { ?> disabled="disabled"<?php } ?> /> Device <?php echo $countDevices; ?> (<?php echo $DeviceSize; ?>GB)<br />
                <?php
                        //increment counter
                        $countDevices++;
                        
                    } //END check this is not the column header or system device
                
                } //END output contents of array
                
                //check if the array is empty
                if ($countDevices == 1) {
                ?>
                No devices found
                <?php
                } //END check if the array is empty
                ?>
            </p>
        </div>
		<div class="one-third column">
            <h4>Start writing to devices:</h4>
            <p>
                <input type="submit" id="WriteImage" name="WriteImage" value="Write Image to Devices"<?php if ($countFiles == 0) { ?> disabled="disabled" style="color: #666;"<?php } ?> />
            </p>
            </form>
        </div>
        <div class="sixteen columns">
            <hr />
            <a href="license.txt">
                <img src="images/gplv3.png" width="150" height="60" border="0" align="right" />
            </a>
            <h5>Released by <a href="http://www.rockandscissor.com/" target="_blank">Rock &amp; Scissor Enterprises Limited</a> under the <a href="license.txt">GNU GPLv3</a>.</h5>
        </div>

	</div><!-- container -->
	
    <?php
    //clear the stat cache before checking size of file
    clearstatcache();
    
    //check if the form was submitted
    if (isset($_POST['WriteImage']) || !(filesize('/etc/osid/system/progress.info') == 0)) {
    ?>
    <div id="progress_bg">
        <div id="progress_display">
            <h5>Progress</h5>
            <div id="progress_bar">0%</div><div id="unprogress_bar"></div>
            <p id="StatusMessage" align="center">
                Waiting for ready state...
            </p>
        </div>
    </div>
    <script type="text/javascript">
    startMonitor();
    </script>
    <?php
    } //END check if the form was submitted
    ?>
    
<!-- End Document
================================================== -->
</body>
</html>