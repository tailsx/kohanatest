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
		// Set variables to send to view
		$view = View::factory('newentry');
		$view->firstname = NULL;
		$view->email = NULL;

		// retrieve id parameter
		$id = $this->request->param('id', NULL);
		
		// If id exists, overwrite view variables to ones existing in database.
		if ($id != NULL)
		{

			// Find user with id
			$user = ORM::factory('user', $id);
			$view->firstname = $user->firstname;
			$view->email = $user->email;
		}

		$this->response->body($view);
	}



} // End Contest
