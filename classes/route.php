<?php defined('SYSPATH') or die('No direct script access.');

class Route extends Kohana_Route {

	/**
	 * Extension of Route::url that adds a fourth parameter for setting a language key.
	 * The current language (Request::$lang) is used by default.
	 *
	 *     echo Route::url('default', array('controller' => 'foo', 'action' => 'bar'), NULL, 'fr');   // custom language
	 *     echo Route::url('default', array('controller' => 'foo', 'action' => 'bar'), NULL, FALSE);  // no language
	 *
	 * @param   string  $name      route name
	 * @param   array   $params    URI parameters
	 * @param   mixed   $protocol  protocol string or boolean, adds protocol and domain
	 * @param   mixed   $lang      Language key to prepend to the URI, or FALSE to not prepend a language
	 * @return  string
	 * @since   3.0.7
	 * @uses    Route::get
	 * @uses    URL::site
	 */
	public static function url($name, array $params = NULL, $protocol = NULL, $lang = TRUE)
	{
		$route = Route::get($name);

		// Create a URI with the route and convert it to a URL
		if ($route->is_external())
			return Route::get($name)->uri($params);
		else
			return URL::site(Route::get($name)->uri($params), $protocol, TRUE, $lang);
	}

} // End Route
