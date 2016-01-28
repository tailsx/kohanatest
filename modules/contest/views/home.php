<!DOCTYPE html>
<html>
<head>
	<title></title>
	<base href="<?php echo url::base(); ?>" />
</head>
<body>
	<a href='./contest/details'>Create New Entry</a>
	<br/>
	<a href='./contest/add'>EOIWNJFOEWIJFOEWJ</a>
	<table>
		<tr>
		    <td><strong>First Name</strong></td>
		    <td><strong>Email</strong></td>		
	  	</tr>
	  	<?php 
	  		foreach( $table as $t )
	  		{
	  			echo '<tr>';
	  			echo '<td>'.$t->firstname.'</td>';
	  			echo '<td>'.$t->email.'</td>';
	  			echo '<td><a href=\'./contest/details/'.$t->id.'\'>Edit</a></td>';
	  			echo '</tr>';
	  		}
	  	?>
	</table>
</body>
</html>