<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php include 'common/constants.xml'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Search results</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div>
			<?php
				$query = $_GET['word'];
				if($query == NULL || trim($query) == ''){
					echo 'No search terms specified.';
					exit();
				}
				$words = split("[\t ,]+", preg_replace('/\/\.$/', '', trim($query), 1));
				
				require '/home/flan/hymmnoserver/hymmnoserver.gobbledygook';
				if ($mysqli->connect_error) {
					printf("Connection failed: %s.", mysqli_connect_error());
					exit();
				}
				
				if(count($words) > 1){#If more than one token is provided, parse instead of search.
					include 'common/translate.xml';
				}else{
					include 'common/search.xml';
				}
				
				$mysql->close();
			?>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
