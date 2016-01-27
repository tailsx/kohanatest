<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contest extends Controller {

	public function action_index()
	{
		$view = View::factory('newentry');
		$this->response->body($view);
	}

} // End Contest
