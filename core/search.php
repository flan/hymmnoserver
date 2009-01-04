<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php include 'common/constants.xml'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Main</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<?php
			$query = $_GET['word'];
			if($query == NULL || trim($query) == ''){
				echo 'No search terms specified.';
				exit();
			}
			$words = split(" ", trim($query));
			
			include '/home/flan/public_html/hymmnoserver.gobbledygook';
			if ($mysqli->connect_error) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			if(count($words) > 1){
				include 'common/grammar.xml';
			}else{
				include 'common/search.xml';
			}
			
			$mysql->close();
		?>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
