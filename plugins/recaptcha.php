<?php
require_once('../application/config.php');
require_once('recaptchalib.php');

echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY, $_REQUEST['error']);
?>