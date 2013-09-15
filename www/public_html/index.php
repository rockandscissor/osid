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
			    <input type="radio" id="ImageToUse1" name="ImageToUse" value="image1.img" checked="checked" />&nbsp;image1.img<br />
			    <input type="radio" id="ImageToUse2" name="ImageToUse" value="image2.img" />&nbsp;image2.img<br />
			    <input type="radio" id="ImageToUse3" name="ImageToUse" value="image3.img" />&nbsp;image3.img<br />
			</p>
		</div>
		<div class="one-third column">
            <h4>Choose devices to write to:</h4>
            <p>
                <input type="checkbox" id="DeviceA" name="DeviceA" value="sba" checked="checked" /> Device 1<br />
                <input type="checkbox" id="DeviceB" name="DeviceB" value="sbb" checked="checked" /> Device 2<br />
                <input type="checkbox" id="DeviceC" name="DeviceC" value="sbc" checked="checked" /> Device 3<br />
                <input type="checkbox" id="DeviceD" name="DeviceD" value="sbd" checked="checked" /> Device 4<br />
                <input type="checkbox" id="DeviceE" name="DeviceE" value="sbe" checked="checked" /> Device 5<br />
                <input type="checkbox" id="DeviceF" name="DeviceF" value="sbf" checked="checked" /> Device 6<br />
                <input type="checkbox" id="DeviceG" name="DeviceG" value="sbg" checked="checked" /> Device 7<br />
                <input type="checkbox" id="DeviceH" name="DeviceH" value="sbh" checked="checked" /> Device 8<br />
                <input type="checkbox" id="DeviceI" name="DeviceI" value="sbi" checked="checked" /> Device 9<br />
                <input type="checkbox" id="DeviceJ" name="DeviceJ" value="sbj" checked="checked" /> Device 10<br />
            </p>
        </div>
		<div class="one-third column">
            <h4>Start writing to devices:</h4>
            <p>
                <input type="submit" id="WriteImage" name="WriteImage" value="Write Image to Devices" />
            </p>
        </div>
        <div class="sixteen columns">
            <hr />
            <a href="license.txt">
                <img src="images/gplv3.png" width="150" height="60" border="0" align="right" />
            </a>
            <h5>Released by Rock &amp; Scissor Enterprises Limited under the GNU GPLv3.</h5>
        </div>

	</div><!-- container -->


<!-- End Document
================================================== -->
</body>
</html>