<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009
*/?>

<?php include 'common/constants.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Hymmnoserver - Search results</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div>
			<?php
				$query = '';
				if(isset($_GET['word'])){
					$query = trim($_GET['word']);
				}
				if($query == ''){
					echo 'No search terms specified.';
					exit();
				}
				$words = split("[\t ,]+", preg_replace('/,/', '', preg_replace('/\\s+\\.\\s+/', ' ', preg_replace('/^\\s*|[?!,:\'"\/\\\\]|\\.\\.+||\\s*\\.*\\s*$/', '', $query))));
				
				require 'secure/db.php';
				if ($mysqli->connect_error) {
					printf("Connection failed: %s.", mysqli_connect_error());
					exit();
				}
				
				if(count($words) > 1){#If more than one token is provided, parse instead of search.
					include 'common/translate.php';
				}else{
					include 'common/search.php';
				}
				
				$mysql->close();
			?>
		</div>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
