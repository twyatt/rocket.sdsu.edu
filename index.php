<?php
require_once('application/config.php');
require_once('application/Router.php');

Router::addRoute(
	array('GET', 'POST'), // method
	DEFAULT_ROUTE_REGEX,
	array(
		1 => 'page', // regex matches labeling, i.e. regex group 1 will associated with array key 'page'
	)
);

$method  = $_SERVER['REQUEST_METHOD'];
$url     = $_SERVER['REQUEST_URI'];
$matches = array();

if (Router::match($method, $url, $matches)) {
	extract($matches, EXTR_SKIP);
	
	if (empty($page) || $page == 'index') {
		$page = 'home';
	}
	
	$file = "pages/$page.php";
	if (!is_readable($file)) {
		$file = 'pages/404.php';
	}
} else {
	$file = 'pages/404.php';
}

ob_start();
include($file);
$content = ob_get_clean();

require_once('layouts/default.php');
?>