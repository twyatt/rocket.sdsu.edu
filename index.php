<?php
require_once('application/router.php');
Router::addRoute(
	'GET',
	'/^\/([\d\w]+)/i',
	array(
		1 => 'page',
	)
);

$method  = $_SERVER['REQUEST_METHOD'];
$url     = substr($_SERVER['REQUEST_URI'], strlen('/~travis/rocket.sdsu.edu'));
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
	
	ob_start();
	include($file);
	$content = ob_get_clean();
	
	require_once('layouts/default.php');
} else {
	require_once('pages/404.php');
}
?>