<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contest extends Controller {

	public function action_index()
	{
/*		$user = ORM::factory("Users");

		$user->firstname = "Admini";
		$user->email = "Strator";

		try
		{
		// Try and save
		$user->save();
		}
		catch (ORM_Validation_Exception $e)
		{
		// Catch errors, make dollars
		$errors = $e->errors('User');
		}*/
		$sqlResult = ORM::factory("Users")->where("firstname", "=", "david")->find();
		print_r($sqlResult->as_array());

		$view = View::factory('home');
		$this->response->body($view);
	}

} // End Contest
