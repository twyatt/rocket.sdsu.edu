<?php
require_once('plugins/recaptchalib.php');
require_once('plugins/ContactForm.php');
$title = 'Contact Us';

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	if (empty($_REQUEST['fname'])) {
		$problems[] = 'fname';
	}
	if (empty($_REQUEST['lname'])) {
		$problems[] = 'lname';
	}
	if (empty($_REQUEST['email'])) {
		$problems[] = 'email';
	}
	$recaptcha = recaptcha_check_answer(
		RECAPTCHA_PRIVATE_KEY,
		$_SERVER['REMOTE_ADDR'],
		$_REQUEST["recaptcha_challenge_field"],
		$_REQUEST["recaptcha_response_field"]
	);
	
	if (empty($problems) && $recaptcha->is_valid) {
		$contact = new ContactForm();
		
		$contact->subject = 'SDSU Rocket Project Contact Form';
		$contact->firstNameField = 'fname';
		$contact->lastNameField = 'fname';
		$contact->emailField = 'email';
		$contact->otherFields = array(
			'comments' => 'Comments',
			'sentfrom' => 'Sent From',
		);
		
		if ($contact->send(CONTACT_EMAIL)) {
			echo "success('Thank you!')";
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			echo "Failed to send email.";
		}
	} else {
		//header('HTTP/1.0 400 Bad Request');
		
		if (!empty($problems)) {
			echo "error(['" . implode("', '", $problems) . "']);\n";
		}
		if (!$recaptcha->is_valid) {
			echo "recaptcha('" . $recaptcha->error . "');\n";
		}
	}
	
	exit();
} else { // GET
	$head = <<<EOT
<link href="css/contact.css" media="screen" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.form.js"></script>
<script type="text/javascript" src="scripts/contact.js"></script>
EOT;
}
?>

<div class="page">
	<h1>Contact Us</h2>
	
	<div id="contact_container">
		<form id="contact" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
			<h2>Name</h2>
			
			<label for="fname">First:</label>
			<input id="fname" class="required" type="text" name="fname" /><br />
			
			<label for="lname">Last:</label>
			<input id="lname" class="required" type="text" name="lname" /><br />
			
			<label for="email">Email:</label>
			<input id="email" class="required" type="text" name="email" /><br />
			
			<h2>Comment</h2>
			<textarea name="comments"></textarea>
			
			<div id="recaptcha">
<?php
echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
?>
			</div>
			
			<input type="hidden" name="sentfrom" value="<?php echo ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
			
			<input type="submit" value="Send" />
		</form>
	</div>
</div>