<!DOCTYPE html>
<html>
<head>
	<title>Part 3</title>
</head>
<body>
	  	<?php

	  		// Naviagtion
			echo '<a href=\'';
			echo $test;
			echo '\'>';
			echo __('Create New Entry');
			echo '</a>';
			echo '<br />';
			echo '<br />';

			// If there's data, print.  Else, say theres no data
	  		if(!empty($table)){
	  			echo '<br>';
		  		echo '<br>'; 
	  			echo '<table>';
	  			echo '<tr>';
	  			echo '<td><strong>';
	  			echo __('First Name');
	  			echo '</strong></td>';
	  			echo '<td><strong>';
	  			echo __('Email');
	  			echo '</strong></td>';		
	  			echo '</tr>';
	  			foreach( $table as $t )
		  		{
		  			echo '<tr>';
		  			echo '<td>'.$t->firstname.'</td>';
		  			echo '<td>'.$t->email.'</td>';
		  			echo '<td><a href=\'./contest/details/'.$t->id.'\'>';
		  			echo __('Edit');
		  			echo '</a></td>';
		  			echo '</tr>';
		  		}
		  		echo '<table>';
		  	}
		  	else
		  	{
		  		echo '<br>';
		  		echo '<br>';
		  		echo 'No data';
		  	}
	  	?>
</body>
</html>