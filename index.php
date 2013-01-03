<?php
define('DEBUG', false);

require_once('application/Router.php');
Router::addRoute(
	'GET',
	'/^\/([\d\w]*)/i',
	array(
		1 => 'page',
	)
);

$method  = $_SERVER['REQUEST_METHOD'];
$url     = substr($_SERVER['REQUEST_URI'], strlen('/~travis/rocket.sdsu.edu'));
$matches = array();

if (DEBUG) {
	echo "<pre>";
	echo "method: $method\n";
	echo "url: $url\n";
}

if (Router::match($method, $url, $matches)) {
	if (DEBUG) echo "MATCH\n";
	extract($matches, EXTR_SKIP);
	
	if (empty($page) || $page == 'index') {
		$page = 'home';
	}
	
	$file = "pages/$page.php";
	if (!is_readable($file)) {
		$file = 'pages/404.php';
	}
} else {
	if (DEBUG) echo "NO MATCH\n";
	$file = 'pages/404.php';
}

if (DEBUG) {
	echo "file: $file\n";
	exit();
}

ob_start();
include($file);
$content = ob_get_clean();

require_once('layouts/default.php');
?>