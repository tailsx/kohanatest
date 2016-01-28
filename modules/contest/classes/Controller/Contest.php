<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contest extends Controller {

	public function action_index()
	{
/*		$user = ORM::factory("user");

		$user->id = 1;
		$user->name = "Strator";

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
/*		$sqlResult = ORM::factory("User")->where("firstname", "=", "david")->find();
		print_r($sqlResult->as_array());*/

		$customers = ORM::factory("user");
	 	$customers = $customers->find_all();

 	 	$output = "<ol>";

 	 	foreach( $customers as $customer )
 	 	{
 	 	 	 $output .= "<li>{$customer->firstname}, {$customer->email}</li>";
 	 	}

 	 	$output .= "</ol>";


		$view = View::factory('home');

		$view->data = $output;
		$this->response->body($view);
	}

	public function action_details()
	{
		$view = View::factory('newentry');

		$this->response->body($view);
	}

	

} // End Contest
