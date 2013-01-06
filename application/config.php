<?php
define('RECAPTCHA_PUBLIC_KEY', '6LcRItsSAAAAAB7ZJ8vRmYv-2rHWqkZPLWw7_JyH');
define('RECAPTCHA_PRIVATE_KEY', '6LcRItsSAAAAAFfYkjmxCU1JO-OWwXQhT2ElUvWt');

if (file_exists('.development')) {
	define('CONTACT_EMAIL', 'travis.i.wyatt@gmail.com');
	define('DEFAULT_ROUTE_REGEX', '/^\/~travis\/rocket.sdsu.edu\/([\d\w]*)/i');
} else { // production environment
	define('CONTACT_EMAIL', 'rocketproject.sdsu@gmail.com');
	define('DEFAULT_ROUTE_REGEX', '/^\/([\d\w]*)/i');
}
