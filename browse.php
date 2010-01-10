<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php include 'common/constants.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>HYMMNOSERVER - Main</title>
		<?php include 'common/resources.xml'; ?>
	</head>
	<body>
		<?php include 'common/header.xml'; ?>
		<div style="font-size: 0.90em; text-align: center;">
			<?php
				#Determine the nature of the requested display; default if unintelligible.
				$page = '';
				if(isset($_GET['page'])){
					$page = trim($_GET['page']);
				}
				if($page == ''){//Assume 'a' by default.
					$page = 'a';
				}else{
					if(is_numeric($page)){
						$page = intval($page);
						if($page == 0){//0 means any numeric/special entity.
							$page = '0';
						}elseif($page < 1 || $page > 14){//1-14 are lexical class identifiers.
							$page = 1;
						}
					}else{
						$page = strtolower($page[0]);
						$page_ord = ord($page);
						if(($page_ord < 97 || $page_ord > 122)){//Detect alpha-range.
							$page = 'a';
						}
					}
				}
				
				#Render the alphabetical bar.
				$characters = range('a', 'z');
				array_push($characters, '0');
				foreach($characters as $character){
					echo "<a href=\"./browse.php?page=$character\">";
					if($character == $page){
						echo "<span style=\"font-weight: bold; font-size: 1em;\">$character</span>";
					}else{
						echo $character;
					}
					echo '</a>';
					
					if($character != '0'){
						echo " / ";
					}
				}
				echo '<br/>';
				
				#Render the syntax class bar.
				$i = 0;
				foreach(array(
				 'E.S. (I)', 'E.S. (II)', 'E.S. (III)', 'E.V.',
				 'adj.', 'adv.', 'conj.', 'cnstr.', 'intj.', 'n.',
				 'prep.', 'pron.', 'prt.', 'v.'
				) as $class){//Force an enumerable order from 1-14.
					$i++;
					echo "<a href=\"./browse.php?page=$i\">";
					if($i == $page){
						echo "<span style=\"font-weight: bold; font-size: 1em;\">$class</span>";
					}else{
						echo $class;
					}
					echo '</a>';
					
					if($i != 14){
						echo " / ";
					}
				}
			?>
		</div>
		<hr/>
		<div>
			<span style="color: red; font-size: 0.8em;">
				<?php
					require 'secure/db.php';
					if ($mysqli->connect_error) {
						printf("Connection failed: %s.", mysqli_connect_error());
						exit();
					}
					
					if($page != '0'){#0 means all non-alpha-started entries.
						if(is_numeric($page)){#Looking up records by syntax class.
							$keys = $SYNTAX_CLASS_REV[$page];
							$keys_count = count($keys);
							$search_key = $keys[0];
							for($i = 1; $i < $keys_count; $i++){
								$search_key = $search_key.','.$keys[$i];
							}
							$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school, class FROM hymmnos WHERE class IN ($search_key) ORDER BY word ASC");
						}else{#Looking up records by starting letter.
							$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school, class FROM hymmnos WHERE word LIKE ? ORDER BY word ASC");
							$page = $page.'%';
							$stmt->bind_param("s", $page);
						}
					}else{#Get all non-alpha-started entries.
						$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school, class FROM hymmnos WHERE word RLIKE '^[^[:alpha:]].*'");
					}
					$stmt->execute();
					$stmt->store_result();
					
					$plural = '';
					if($stmt->num_rows != 1){
						$plural = 's';
					}
					printf('<b>%d record%s found</b>', $stmt->num_rows, $plural);
				?>
				(Hymmnos entries will open in a new window)
			</span>
		</div>
		<table>
			<tr>
				<th class="result-header" style="width: 100px;">Hymmnos</th>
				<th class="result-header" style="width: 155px;">Meaning</th>
				<th class="result-header" style="width: 75px;">Class</th>
				<th class="result-header" style="width: 90px;">Kana</th>
				<th class="result-header" style="width: 220px;">Dialect</th>
			</tr>
			<?php
				if($stmt->num_rows > 0){#Render results only if there are results.
					$stmt->bind_result($word, $meaning_english, $kana, $dialect, $class);
					
					while($stmt->fetch()){#Render each result in its own row.
						$html_word = htmlspecialchars($word);
						echo '<tr>';
							echo "<td class=\"result-cell result-dialect-$dialect\">";
								echo "<a href=\"javascript:popUpWord('$html_word', $dialect)\">$html_word</a>";
							echo '</td>';
							echo "<td class=\"result-cell result-dialect-$dialect\">$meaning_english</td>";
							echo "<td class=\"result-cell result-dialect-$dialect\">";
								echo $SYNTAX_CLASS[$class];
							echo '</td>';
							echo "<td class=\"result-cell result-dialect-$dialect\">$kana</td>";
							echo "<td class=\"result-cell result-dialect-$dialect\">";
								echo $DIALECT[$dialect];
							echo '</td>';
						echo '</tr>';
					}
				}else{
					echo "<tr><td colspan=\"5\" style=\"color: red; font-weight: bold; text-align: center;\">No records found</td></tr>";
				}
				$stmt->free_result();
				$stmt->close();
				$mysql->close();
			?>
		</table>
		<?php include 'common/footer.xml'; ?> 
	</body>
</html>
