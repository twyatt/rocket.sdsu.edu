<?php
require_once('plugins/Recaptcha.php');
require_once('plugins/ContactForm.php');

$title = 'Contact Us';
$head = <<<EOT
<link href="css/contact.css" media="screen" rel="stylesheet" type="text/css" />
EOT;
$contact = new ContactForm();
$recaptcha = new Recaptcha(RECAPTCHA_PUBLIC_KEY, RECAPTCHA_PRIVATE_KEY);

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	$isPost = true;
	
	$recaptchaResponse = $recaptcha->check();
	
	$contact->setFromName($_REQUEST['fname'], $_REQUEST['lname']);
	$contact->setFromEmail($_REQUEST['email']);
	$contact->setSubject(CONTACT_SUBJECT);
	$sourceUri = ($_SERVER['SERVER_PORT'] == 443 ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$contact->setBody("First Name: " . $_REQUEST['fname'] . "\r\nLast Name: " . $_REQUEST['lname'] . "\r\n\r\nComments: \r\n" . $_REQUEST['comments'] . "\r\n\r\nSent Using:\r\n" . $sourceUri);
	
	if ($recaptchaResponse->is_valid && $contact->isValid()) {
		$contactResult = $contact->send(CONTACT_EMAIL);
	}
} else { // GET
	$isPost = false;
}
?>

<div class="page">
	<h1>Contact Us</h2>
	
<?php if ($isPost && $contactResult) { ?>
	Thank you!
<?php } else { ?>
	<div id="form-container">
		<form id="contact" enctype="multipart/form-data" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
			<label for="fname">First Name*:</label>
			<input id="fname" class="name <?php if ($isPost && !$contact->isFromFirstNameValid()) echo ' invalid'; ?>" type="text" name="fname" value="<?php echo addslashes($_REQUEST['fname']); ?>" /><br />
			
			<label for="lname">Last Name*:</label>
			<input id="lname" class="name <?php if ($isPost && !$contact->isFromLastNameValid()) echo ' invalid'; ?>" type="text" name="lname" value="<?php echo addslashes($_REQUEST['lname']); ?>" /><br />
			
			<label for="email">Email*:</label>
			<input id="email" class="<?php if ($isPost && !$contact->isFromEmailValid()) echo 'invalid'; ?>" type="text" name="email" value="<?php echo addslashes($_REQUEST['email']); ?>" /><br />
			
			<label for="comments">Comments:</label>
			<div class="clear"></div>
			<textarea id="comments" name="comments"><?php echo $_REQUEST['comments']; ?></textarea>
			
			<label>Spam Prevention:</label>
<?php
echo $recaptcha;
?>
			
			<input class="submit-button" type="submit" value="Send" />
		</form>
	</div>
<?php } ?>
</div>