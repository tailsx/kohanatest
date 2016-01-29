<!DOCTYPE html>
<html>
<head>
	<title>Part 2: Contest</title>
</head>
<body>
	<a href='./contest/details'>Create New Entry</a>
<!-- 	<table>
		<tr>
		    <td><strong>First Name</strong></td>
		    <td><strong>Email</strong></td>		
	  	</tr> -->
	  	<?php
	  		if(!empty($table)){
	  			echo '<br>';
		  		echo '<br>'; 
	  			echo '<table>';
	  			echo '<tr>';
	  			echo '<td><strong>First Name</strong></td>';
	  			echo '<td><strong>Email</strong></td>';		
	  			echo '</tr>';
	  			foreach( $table as $t )
		  		{
		  			echo '<tr>';
		  			echo '<td>'.$t->firstname.'</td>';
		  			echo '<td>'.$t->email.'</td>';
		  			echo '<td><a href=\'./contest/details/'.$t->id.'\'>Edit</a></td>';
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
<!-- 	</table> -->
</body>
</html>