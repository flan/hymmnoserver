<?php
	header("Expires: Mon, 20 Dec 1998 01:00:00 GMT");
	header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
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
		<title>Hymmnoserver - Word</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body style="width: 500px;">
		<?php
			$word = '';
			if(isset($_REQUEST['word'])){
				$word = trim($_REQUEST['word']);
			}
			if($word == ''){
				echo 'No word specified.';
				exit();
			}
			$dialect = '';
			if(isset($_REQUEST['dialect'])){
				$dialect = trim($_REQUEST['dialect']);
			}
			if($dialect == '' || !is_numeric($dialect)){
				echo 'No dialect specified.';
				exit();
			}
			$dialect = intval($dialect);
			
			require 'secure/db.php';
			if($mysql->connect_error){
				die('Failed to connect to database: '.htmlentities($mysql->connect_error));
			}
			
			//Read the requested word from the database.
			$stmt = $mysql->prepare('SELECT word, meaning, japanese, kana, dialect, romaji, description, class FROM hymmnos WHERE word = ? AND dialect = ? LIMIT 1');
			$stmt->bind_param('si', $word, $dialect);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows != 1){
				die('Unknown word specified');
			}
			$stmt->bind_result($word, $meaning, $japanese, $kana, $dialect, $romaji, $notes, $class);
			$stmt->fetch();
			$stmt->free_result();
			$stmt->close();
			
			//Read all related words from the database.
			$stmt = $mysql->prepare('SELECT destination, destination_dialect FROM hymmnos_mapping WHERE source = ? AND source_dialect = ? ORDER BY destination ASC, destination_dialect ASC');
			$stmt->bind_param('si', $word, $dialect);
			$stmt->execute();
			$stmt->store_result();
			
			$links = array();
			$stmt->bind_result($link, $link_dialect);
			while($stmt->fetch()){
				$links[] = array($link, $link_dialect);
			}
			
			$stmt->free_result();
			$stmt->close();
			
			$mysql->close();
			
			include 'common/word.php';
			renderWord($word, $class, $meaning, $romaji, $japanese, $kana, $dialect, $notes, $links);
			
			$footer_word = true;
			include 'common/footer.xml';
		?> 
	</body>
</html>
