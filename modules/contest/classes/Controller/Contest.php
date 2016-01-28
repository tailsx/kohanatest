<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contest extends Controller {

	public function action_index()
	{

		// Retrieve all entries from the person model
		$person = ORM::factory("person");
	 	$person = $person->find_all();

/* 	 	$output = "<ol>";

 	 	foreach( $customers as $customer )
 	 	{
 	 	 	 $output .= "<li>{$customer->firstname}, {$customer->email}</li>";
 	 	}

 	 	$output .= "</ol>";


		$view = View::factory('home');

		$view->table = $output;*/
		// Give data to view to display
		$view = View::factory('home');
		$view->table = $person;
		$this->response->body($view);
	}

	// action that displays the 
	public function action_details()
	{
		// Set variables to send to view
		$view = View::factory('newentry');
		$view->firstname = NULL;
		$view->email = NULL;

		// If a post request comes in, handle it here
		if ($_POST)
		{
			try
			{
				$person = ORM::factory('person');
				$person->firstname = $_POST['firstname'];
				$person->email = $_POST['email'];
				$person->save();
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('person');
				print_r($errors);
			}


			/*$this->redirect('contest/details/'.$person->id);*/

/*			try
			{
				// Try and save
				$user->save();
			}
			catch (ORM_Validation_Exception $e)
			{
				// Catch errors, make dollars
				$errors = $e->errors('person');
			}*/

/*			print_r($user);
			print_r($user->id);
			print_r(URL::base());
			print_r($this->request->uri());
			print_r($this->request->url()."/".$user->id);
			$this->redirect("/".$user->id);*/

		}
		print_r(URL::site(''));

		// retrieve id parameter
		$id = $this->request->param('id', NULL);

		// If id exists, overwrite view variables to ones existing in database.
		if ($id != NULL)
		{
			// Find user with id
			$person = ORM::factory('person');
			$person->where('id', '=', $id);
			$person->find();

			// update the autofield values with database values
			$view->firstname = $person->firstname;
			$view->email = $person->email;
		}

		// Render the view
		$view->home = URL::site('').'contest';
		$view->bind('errors', $errors);
		print_r($errors);
		$this->response->body($view);
	}


	public function action_add()
	{
		$user = ORM::factory('person');
		$user->firstname = 'fweewfwfwe';
		$user->email = 'fwefwefefwefaw';
		
		
		$view = View::factory('test')
			->bind('errors', $errors);
		$this->response->body($view);
	}




} // End Contest
