<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<a href='<?php echo $home ?>'>Home</a>
	<?php $errors ?>
	<h1>Contest</h1>

	<?php
		echo Form::open();

		echo Form::label('firstname', 'First Name');
		echo '<br />';
		echo Form::input('firstname', $firstname);
		echo '<br />';

		echo '<br />';

		echo Form::label('email', 'E-mail');
		echo '<br />';
		echo Form::input('email', $email);
		echo '<br />';

		echo Form::submit('submit', 'Submit');

		echo Form::close();
	?>
</body>
</html>