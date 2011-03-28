<?php
function top($title, $header)
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="author" content="Wink Hosting (www.winkhosting.com)" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="google-site-verification" content="AomVHnW6VpvX4feb4hwxLi9gViorzAiyXg5z9BkZFQQ" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="shortcut icon" href="http://recyclebuddy.itjustwerx.net/Recycle-Buddy.ico" />
	<title>[Recycle Buddy] <?php echo $title; ?></title>
	<script type="text/javascript" language="javascript"><!--
	function toggleZip() {
		var zipInput = document.zipsearch.zipcode;
		var zipSubmit = document.zipsearch.submit;
		var zipError = document.getElementById("ziperror");
		if (zipInput.value == "Zip Code" || zipInput.value == "" || (zipInput.value.length == 5 && !isNaN(zipInput.value))) {
			zipError.style.display="none";
		} else {
			zipError.style.display="inline";
		}
		if (zipInput.className=="hint") {
			zipInput.className = "nohint";
			zipInput.value = "";
			zipSubmit.disabled = false;
		} else if (zipInput.value == "" || isNaN(zipInput.value)) {
			zipInput.className = "hint";
			zipInput.value = "Zip Code";
			zipSubmit.disabled = true;
		}
	}
	function checkZip() {
		var zipInput = document.zipsearch.zipcode;
		var zipSubmit = document.zipsearch.submit;
		var zipError = document.getElementById("ziperror");
		if (zipInput.value < 9999 || zipInput.value > 100000 || isNaN(zipInput.value)) {
			//toggleZip();
			zipError.style.display="inline";
			return false;
		}
	}
	// --></script>
</head>
<body onload="if (document.zipsearch.zipcode.value!='Zip Code') {document.zipsearch.zipcode.className='nohint'; document.zipsearch.submit.disabled=false;}">
	<div id="page" align="center">
		<div id="toppage" align="center">
			<div id="date">
				<div class="smalltext" style="padding:13px;"><strong><?php echo date('F j, Y'); ?></strong></div>
			</div>
			<div id="topbar">
				<div align="right" style="padding:12px;" class="smallwhitetext"><p><?php include_once('gettip.php'); ?></p></div>
			</div>
		</div>
		<div id="header" align="center">
			<div class="titletext" id="logo" style="background-image:url('Recycle-Buddy.png');background-repeat:no-repeat;background-position:top center;">
				<h1 class="logotext" style="margin:30px"><span class="orangelogotext">R</span>ecycle <span class="orangelogotext">B</span>uddy</h1> 
			</div>
			<div id="pagetitle">
				<div id="title" class="titletext" align="right"><?php echo $header; ?></div>
			</div>
		</div>
		<div id="content" align="center">
			<div id="menu" align="right">
				<div align="right" style="width:189px; height:8px;"><img src="images/mnu_topshadow.gif" width="189" height="8" alt="mnutopshadow" /></div>
				<div id="linksmenu" align="center">
					<a href="index.php" title="Home">Home</a>
					<a href="search.php" title="Search For Recycling Centers">Search</a>
					<a href="add.php" title="Add a Recycling Center">Add</a>
					<a href="tips.php" title="Tips for Green Living">Green Tips</a>
					<a href="app.php" title="Get the Android App!">Android App</a>
					<a href="about.php" title="About Recycle Buddy">About</a>
					<a href="contact.php" title="Contact">Contact</a>
					<form method="post" action="search.php" name="zipsearch" onsubmit="return checkZip()" class="linkitem">Quick Search<br /><input type="text" size="4" name="zipcode" value ="Zip Code" class="hint" maxlength="5" onfocus="toggleZip();" onblur="toggleZip();" /><input type="submit" value="&gt;" name="submit" disabled="disabled" class="nohint" /><span id="ziperror" style="display:none"><br />Please enter a<br />valid Zip Code</span></form>
				</div>
				<div align="right" style="width:189px; height:8px;"><img src="images/mnu_bottomshadow.gif" width="189" height="8" alt="mnubottomshadow" /></div>
			</div>
		<div id="contenttext">
<?php
}

function bottom() {
?>
		</div>
		</div>
		<div id="footer" class="smallgraytext" align="center">
			<a href="index.php">Home</a> | <a href="about.php">About</a> | <a href="contact.php">Contact</a> | <a href="legal.php">Legal</a><br />
			Site &amp; Content &copy; Copyright 2011 Recycle Buddy<br />
			Valid <a href="http://validator.w3.org/check?uri=referer" title="Valid XHTML 1.0 Transitional">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer" title="Valid CSS!">CSS</a><br />
		</div>
	</div>
</body>
</html>
<?php
}
?>