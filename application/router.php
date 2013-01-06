<?php
/**
 * Regex based routing, see preg_match() PHP function for more details.
 * {@link http://php.net/manual/en/function.preg-match.php}
 */
class Router {

	public static $_routes = array();
	
	/**
	 * Add route.
	 *
	 * @param string,array $method May be either a string or array of strings.
	 * @param string       $url
	 * @param array        $parts  Defines how regex matches should be labeled.
	 */
	public function addRoute($method, $url, $parts) {
		if (empty($method)) {
			$method = 'GET';
		}
		
		self::$_routes[] = array(
			'method' => $method,
			'url'    => $url,
			'parts'  => $parts
		);
	}
	
	public function match($method, $url, array &$matches) {
		if (empty($method) || empty($url)) {
			return false;
		}
		
		foreach (self::$_routes as $route) {
			$method_match = false;
					
			if (is_array($route['method'])) {
				foreach ($route['method'] as $route_method) {
					if (strtoupper($method) == strtoupper($route_method)) {
						$method_match = true;
					}
				}
			} else {
				if (strtoupper($method) == strtoupper($route['method'])) {
					$method_match = true;
				}
			}
			
			if ($method_match) {
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