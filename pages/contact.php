<?php
require_once('plugins/recaptchalib.php');
require_once('plugins/ContactForm.php');
$title = 'Contact Us';

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	$missing = false;
	
	if (empty($_REQUEST['fname'])) {
		$missing = true;
		echo "Missing first name.\n";
	}
	if (empty($_REQUEST['lname'])) {
		$missing = true;
		echo "Missing last name.\n";
	}
	if (empty($_REQUEST['email'])) {
		$missing = true;
		echo "Missing email.\n";
	}
	
	if ($missing) {
		header('HTTP/1.0 400 Bad Request');
	} else {
		$contact = new ContactForm();
		
		$contact->subject = 'SDSU Rocket Project Contact Form';
		$contact->firstNameField = 'fname';
		$contact->lastNameField = 'fname';
		$contact->emailField = 'email';
		$contact->otherFields = array(
			'comments' => 'Comments',
		);
		
		if ($contact->send(CONTACT_EMAIL)) {
			echo "OK";
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			echo "Failed to send email.\n";
		}
	}
	
	exit();
}
?>

<div class="page">
<h1>Contact Us</h2>

<form enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
	<h2>Name</h2>
	First: <input type="text" name="fname" /><br />
	Last: <input type="text" name="lname" /><br />
	
	<h2>Email</h2>
	<input type="text" name="email" /><br />
	
	<h2>Comment</h2>
	<textarea name="comments"></textarea>
	
<?php
// TODO test if eon.sdsu.edu supports sending email from php
// TODO implement form to submit to php-based email script
echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
?>
	<input type="submit" value="Submit" />
</form>

</div>