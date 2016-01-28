<?php defined('SYSPATH') or die('No direct script access.');

class Model_Person extends ORM{


	public function rules(){
		return array(
			'firstname' => array(
				array('not_empty')
			),
			'email' => array(
				array('not_empty'),
				array('email'),
				array(array($this, 'unique'), array('email', ':value')),
			),
		);
	}

}