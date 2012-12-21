<?php
/**
 * Regex based routing, see preg_match() PHP function for more details.
 * {@link http://php.net/manual/en/function.preg-match.php}
 */
class Router {

	public static $_routes = array();
	
	public function addRoute($method, $url, $parts) {
		if (empty($method)) {
			$method = 'GET';
		}
		
		self::$_routes[] = array(
			'method' => strtoupper($method),
			'url'    => $url,
			'parts'  => $parts
		);
	}
	
	public function match($method, $url, array &$matches) {
		if (empty($method) || empty($url)) {
			return false;
		}
		
		foreach (self::$_routes as $route) {
			if ($route['method'] == strtoupper($method)) {
				$m = array();
				if (preg_match($route['url'], $url, $m)) {
					foreach ($route['parts'] as $key => $value) {
						if (isset($m[$key])) {
							$matches[$value] = $m[$key];
						}
					}
					
					return true;
				}
			}
		}
		
		return false;
	}
	
}
?>