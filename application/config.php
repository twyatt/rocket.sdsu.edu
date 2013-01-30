<?php
require_once('config.private.php');

define('CONTACT_SUBJECT', 'SDSU Rocket Project Contact Form');

if (file_exists('.development')) {
	define('CONTACT_EMAIL', 'travis.i.wyatt@gmail.com');
	define('DEFAULT_ROUTE_REGEX', '/^\/~travis\/rocket.sdsu.edu\/([\d\w]*)/i');
} else { // production environment
	define('CONTACT_EMAIL', 'rocketproject.sdsu@gmail.com');
	define('DEFAULT_ROUTE_REGEX', '/^\/([\d\w]*)/i');
}
