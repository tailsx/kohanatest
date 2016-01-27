<?php defined('SYSPATH') or die('No direct script access.');

class Controller_FizzBuzz extends Controller {

	public function action_index()
	{
		// initalize array
		$array = array();

		// loop through all number
		for($i = 1; $i <= 100; $i++)
		{

			// Determine with modulus if Fizz, Buzz, FizzBuzz or number
			if ($i % 15 == 0)
			{
				array_push($array, 'FizzBuzz');
			}
			else if ($i % 3 == 0) 
			{
				array_push($array, 'Fizz');
			}
			else if ($i % 5 == 0) 
			{
				array_push($array, 'Buzz');
			}
			else
			{
				array_push($array, $i);
			}
				
		}

		// Set up view
		$view = View::factory('fizzbuzz');

		$view->data = $array;

		$this->response->body($view);
	}

} // End FizzBuzz
