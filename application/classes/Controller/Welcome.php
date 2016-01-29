<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		$view = View::factory('index');
		$view->contest = Route::url('default', 
									array('controller' => 'contest'), 
									NULL, 
									Request::$lang);
		$this->response->body($view);
	}

} // End Welcome
