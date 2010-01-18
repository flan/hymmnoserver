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
		<title>Hymmnoserver - Word</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body style="width: 500px;">
		<?php
			$word = '';
			if(isset($_GET['word'])){
				$word = trim($_GET['word']);
			}
			if($word == ''){
				echo 'No word specified.';
				exit();
			}
			$dialect = '';
			if(isset($_GET['dialect'])){
				$dialect = trim($_GET['dialect']);
			}
			if($dialect == '' || !is_numeric($dialect)){
				echo 'No dialect specified.';
				exit();
			}
			$dialect = intval($dialect);
			
			require 'secure/db.php';
			if ($mysqli->connect_error) {
				printf("Connection failed: %s.", mysqli_connect_error());
				exit();
			}
			
			#Read the requested word from the database.
			$stmt = $mysql->prepare("SELECT word, meaning_english, meaning_japanese, kana, school, romaji, description, class FROM hymmnos WHERE word = ? AND school = ? LIMIT 1");
			$stmt->bind_param("si", $word, $dialect);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows != 1){
				echo 'Unknown word specified.';
				exit();
			}
			$stmt->bind_result($word, $meaning_english, $meaning_japanese, $kana, $dialect, $romaji, $notes, $class);
			$stmt->fetch();
			$stmt->free_result();
			$stmt->close();
			
			#Read all related words from the database.
			$stmt = $mysql->prepare("SELECT destination, destination_school FROM hymmnos_mapping WHERE source = ? AND source_school = ? ORDER BY destination ASC");
			$stmt->bind_param("si", $word, $dialect);
			$stmt->execute();
			$stmt->store_result();
			
			$links = array();
			$stmt->bind_result($link, $l_dialect);
			while($stmt->fetch()){
				array_push($links, array($link, $l_dialect));
			}
			
			$stmt->free_result();
			$stmt->close();
			
			$mysql->close();
		?>
		<?php include 'common/word.php'; ?>
		<?php
			$footer_word = true;
			include 'common/footer.xml';
		?> 
	</body>
</html>

