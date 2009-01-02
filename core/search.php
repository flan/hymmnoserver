<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Main</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<?php
			/*
			Tokenize the query list.
			If only one word was specified, search for it (list Hymmnos matches first; English second.
			If multiple words were specified, go into grammar mode.
			*/
		?>
		<span style="color: red;">
			<?php
				/*
				//Connect to the database and grab all needed records.
				
				echo '<b>$count records found</b><br/>';
				*/
			?>
		</span>
		<br/><br/>
		<?php
			/*
			If in word mode, set word variables and include word.xml; repeat until results exhausted.
			
			If in grammar mode, render a table and keep stacking <td/>s next to each other, inserting syntax as needed.
			*/
		?>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
