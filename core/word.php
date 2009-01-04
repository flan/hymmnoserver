<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php include 'common/constants.xml'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Word - ChronicleKey</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body style="width: 500px;">
		<?php
			$word = $_GET['word'];
			if($word == NULL || trim($word) == ''){
				echo 'No word specified.';
				exit();
			}
			$word = trim($word);
			
			include '/home/flan/public_html/hymmnoserver.gobbledygook';
			if ($mysqli->connect_error) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			
			$stmt = $mysql->prepare("SELECT word, meaning_english, meaning_japanese, kana, school, romaji, description, class FROM hymmnos WHERE word = ? LIMIT 1");
			$stmt->bind_param("s", $word);
			$stmt->execute();
			$stmt->store_result();
			
			if($stmt->num_rows != 1){
				echo 'Unknown word specified.';
				exit();
			}
			
			$stmt->bind_result($word, $meaning_english, $meaning_japanese, $kana, $school, $romaji, $description, $class);
			$stmt->fetch();
			$stmt->free_result();
			$stmt->close();
			
			$stmt = $mysql->prepare("SELECT destination FROM hymmnos_mapping WHERE source = ? ORDER BY destination ASC");
			$stmt->bind_param("s", $word);
			$stmt->execute();
			$stmt->store_result();
			
			$links = array();
			$stmt->bind_result($link);
			while($stmt->fetch()){
				array_push($links, $link);
			}
			
			$stmt->free_result();
			$stmt->close();
			
			$mysql->close();
		?>
		<?php include 'common/word.xml'; ?>
		<?php include 'common/footer-word.xml'; ?> 
	</body>
</html>
