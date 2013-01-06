<?php
require_once('application/Router.php');

define('RECAPTCHA_PUBLIC_KEY', '6LcRItsSAAAAAB7ZJ8vRmYv-2rHWqkZPLWw7_JyH');

if (file_exists('.development')) {
	define('CONTACT_EMAIL', 'travis.i.wyatt@gmail.com');
	$route_regex = '/^\/~travis\/rocket.sdsu.edu\/([\d\w]*)/i';
} else { // production environment
	define('CONTACT_EMAIL', 'rocketproject.sdsu@gmail.com');
	$route_regex = '/^\/([\d\w]*)/i';
}
Router::addRoute(
	array('GET', 'POST'), // method
	$route_regex,
	array(
		1 => 'page', // regex matches labeling, i.e. regex group 1 will associated with array key 'page'
	)
);
?>