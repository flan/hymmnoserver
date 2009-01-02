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
		<span style="font-size: 0.95em;">
			<?php
				$page = $_GET['page'];
				if($page == NULL || $page == ''){
					$page = 'a';
				}else{
					$page = strtolower($page[0]);
					$page_ord = ord($page);
					if(($page_ord < 97 || $page_ord > 122) && $page_ord != 48){
						$page = 'a';
					}
				}
				
				$characters = range('a', 'z');
				array_push($characters, '0');
				foreach($characters as $character){
					echo "<a href=\"/hymmnoserver/browse.php?page=$character\">";
					
					if($character == $page){
						echo "<span style=\"font-weight: bold; font-size: 1.5em;\">$character</span>";
					}else{
						echo $character;
					}
					
					echo '</a>';
					
					if($character != '0'){
						echo " / ";
					}
				}
			?>
		</span>
		<hr/>
		<span style="color: red;">
			<?php
				include '/home/flan/public_html/hymmnoserver.gobbledygook';
				if ($mysqli->connect_error) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();
				}
				
				if($page != '0'){
					$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school, class FROM hymmnos WHERE word LIKE ? ORDER BY word ASC");
					$page = $page.'%';
					$stmt->bind_param("s", $page);
				}else{
					$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school, class FROM hymmnos WHERE word RLIKE '^[^[:alpha:]].*'");
				}
				$stmt->execute();
				$stmt->store_result();
				
				$plural = '';
				if($stmt->num_rows != 1){
					$plural = 's';
				}
				printf('<b>%d record%s found</b><br/>', $stmt->num_rows, $plural);
			?>
			<span style="font-size: 0.8em;">Hymmnos entries will open in a new window</span>
		</span>
		<br/><br/>
		<table>
			<tr>
				<th class="result-header" style="width: 100px;">Hymmnos</th>
				<th class="result-header" style="width: 125px;">Meaning</th>
				<th class="result-header" style="width: 75px;">Class</th>
				<th class="result-header" style="width: 100px;">Kana</th>
				<th class="result-header" style="width: 240px;">Dialect</th>
			</tr>
			<?php
				if($stmt->num_rows > 0){
					$stmt->bind_result($word, $meaning_english, $kana, $school, $class);
					
					while($stmt->fetch()){
						echo '<tr>';
							echo "<td class=\"result-cell result-school-$school\">";
								echo "<a href=\"javascript:popUp('/hymmnoserver/word.php?word=$word')\">$word</a>";
							echo '</td>';
							echo "<td class=\"result-cell result-school-$school\">$meaning_english</td>";
							echo "<td class=\"result-cell result-school-$school\">";
								echo $SYNTAX_CLASS[$class];
							echo '</td>';
							echo "<td class=\"result-cell result-school-$school\">$kana</td>";
							echo "<td class=\"result-cell result-school-$school\">";
								echo $SCHOOL[$school];
							echo '</td>';
						echo '</tr>';
					}
				}else{
					echo "<tr><td colspan=\"4\" style=\"color: red; font-weight: bold; text-align: center;\">No matches found</td></tr>";
				}
				$stmt->free_result();
				$stmt->close();
				$mysql->close();
			?>
		</table>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
