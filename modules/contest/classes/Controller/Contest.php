<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Contest extends Controller {

	public function action_index()
	{

		// Retrieve all entries from the person model
		$person = ORM::factory("person");
	 	$people = $person->find_all()->as_array();

		// Give data to view to display
		$view = View::factory('home');
		$view->bind ('table', $people);
		$this->response->body($view);
	}

	// action responsible for adding and editing records
	public function action_details()
	{
		// Set up view variables here that will be needed
		$view = View::factory('newentry');
		$view->firstname = NULL;
		$view->email = NULL;
		$view->home = URL::site('').'contest';

		// Set up variables for redirect if needed
		$redirect_flag = FALSE;
		$redirect_link = NULL;

		// If a post request comes in, handle it here
		if ($_POST)
		{
			try
			{
				// Set record to be added
				$person = ORM::factory('person');
				$person->firstname = $_POST['firstname'];
				$person->email = $_POST['email'];

				// Try and store it
				$person->save();

				// If everything goes well, change the flag to signal redirect
				$redirect_flag = TRUE;
				$redirect_link = 'contest/details/'.$person->id;
			}
			catch (ORM_Validation_Exception $e)
			{
				$errors = $e->errors('person');
			}

		}


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

		// Bind errors to this view
		$view->bind('errors', $errors);

		// Decide if we need to redirect
		if($redirect_flag)
		{
			$this->redirect($redirect_link);
		}
		else
		{
			$this->response->body($view);
		}
	}



} // End Contest
