<?php
	include("topbot.inc.php");
	$header="Contact Recycle Buddy";
	top("Contact", $header);
?>
<?php
	if($_REQUEST["Submitted"]) {
		require_once('recaptchalib.php');
		$privatekey = "6Ldx2bwSAAAAAFyRa8sI05cRI1VWRTdNDlN3a-NY";
		$resp = recaptcha_check_answer ($privatekey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["recaptcha_challenge_field"],
		$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
			// What happens when the CAPTCHA was entered incorrectly
			echo ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
				"<br />(reCAPTCHA said: " . $resp->error . ")");
		} else { ?>
			<div class="bodytext" style="padding:12px;" align="justify">
				<strong>Thank you for contacting us.</strong><br />
				<br />
				All submissions will be read in a timely manner; if any reply is needed, we will respond to the e-mail address provided. Thank you for helping us improve this site.
			</div>
			<div class="panel" align="justify">
				<div class="bodytext"><br />
				<strong>Here is the information you submitted. If anything is incorrect, you can re-submit the form by using your browser's back button.</strong>
				<table>
				<tr><td>Your Name:</td><td><?php echo $_REQUEST["name"]; ?></td></tr>
				<tr><td>Your eMail:</td><td><?php echo $_REQUEST["email"]; ?></td></tr>
				<tr><td>Regarding:</td><td><?php echo $_REQUEST["subject"]; ?></td></tr>
				<tr><td colspan="2">Your Message:<br /><blockquote><?php echo nl2br($_REQUEST["message"]); ?></blockquote></td></tr>
				<tr><td colspan="2">
<?php
	//Send the E-mail
	$to = "neard@itjustwerx.net";
	$subject = $_REQUEST["subject"] . " [It Just Werx Site Submission]";
	$message = "This was a form submission from the It Just Werx Site.\nIt was submitted by " . $_REQUEST["name"] . ".\nTheir e-mail is " . $_REQUEST["email"] . "\nIt is regarding " . $_REQUEST["subject"] . ".\nTheir message was:\n" . $_REQUEST["message"] . "\n\nIt was submitted on " . date(r);
	$headers = "From: " . $_REQUEST["name"] . "<" . $_REQUEST["email"]. ">" . "\r\n";
	$headers .= "Reply-To: " . $_REQUEST["name"] . "<" . $_REQUEST["email"]. ">" . "\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion() . " on http://recyclebuddy.itjustwerx.net";
	error_reporting(0);
	$wasSent = mail($to, $subject, $message, $headers);
	if ($wasSent == FALSE) {
		echo "The message could not be sent to us for some reason. We apologize for the inconvenience. Please try again later.<br />Thank you.";
	} else {
		echo "The message was successfully sent. Thank you again.";
	}
?>
				</td></tr>
				</table>
				</div>			</div>
<?php } } else { ?>
			<div class="bodytext" style="padding:12px;" align="justify">
				<strong>You can use the form below to contact us. Please fill out all information completely, and we'll get back to you as soon as possible.</strong><br />
			</div>
			<div class="panel" align="justify">
				<div class="bodytext">
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
				<table>
				<tr><td><label for="frmName">Your Name:</label></td><td><input type="text" name="name" id="frmName" size="60" /></td></tr>
				<tr><td><label for="frmEmail">Your eMail:</label></td><td><input type="text" name="email" id="frmEmail" size="60" /></td></tr>
				<tr><td><label for="frmRegarding">Regarding:</label></td><td><select name="subject" id="frmRegarding">
					<optgroup label="Please Choose:">
					<option value="Error with Site">Error with Site</option>
					<option value="Suggestion or Addition to Site">Suggestion or Addition to Site</option>
					<option value="Problems with or Suggestions for Android App">Problems with or Suggestions for Android App</option>
					<option value="Change/Remove Recycling Center Information">Change/Remove Recycling Center Information</option>
					<option value="Other">Other (Please detail in message)</option>
					</optgroup>
				</select></td></tr>
				<tr><td colspan="2"><label for="frmMessage">Your Message:</label><br /><textarea name="message" rows="10" cols="66" id="frmMessage"></textarea></td></tr>
				<tr><td colspan="2"><?php
					require_once('recaptchalib.php');
					$publickey = "6Ldx2bwSAAAAADDexgf_ysb9D7RiLkZJ58tXzMKY"; // you got this from the signup page
					echo recaptcha_get_html($publickey);
				?></td></tr>
				<tr><td><input type="submit" value="Submit!" name="Submitted" /></td><td><input type="reset" value="Clear Form" /></td></tr>
				</table>
				</form>
				</div>
			</div>
<?php } ?>
<?php
	bottom();
?>