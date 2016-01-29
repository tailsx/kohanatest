<!DOCTYPE html>
<html>
<head>
	<title>Part 3:</title>
</head>
<body>
	<?php

		// Naviagtion
		echo '<a href=\'';
		echo $home;
		echo '\'>';
		echo __('Home');
		echo '</a>';
		echo '<br />';
		echo '<br />';

		// Heading
		echo '<h1>Contest</h1>';

		// Form
		echo Form::open();

		echo Form::label('firstname', __('First Name'));
		echo '<br />';
		if (!empty($errors['firstname']))
		{
			echo $errors['firstname'];
		}
		echo '<br />';
		echo Form::input('firstname', $firstname);
		echo '<br />';

		echo '<br />';

		echo Form::label('email', __('Email'));
		echo '<br />';
		if (!empty($errors['email']))
		{
			echo $errors['email'];
		}
		echo '<br />';
		echo Form::input('email', $email);
		echo '<br />';

		echo Form::submit('submit', __('Submit'));

		echo Form::close();
	?>
</body>
</html>