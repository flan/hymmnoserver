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
					$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school FROM hymmnos WHERE word LIKE ? ORDER BY word ASC");
					$page = $page.'%';
					$stmt->bind_param("s", $page);
				}else{
					$stmt = $mysql->prepare("SELECT word, meaning_english, kana, school FROM hymmnos WHERE word RLIKE '[0-9].*'");
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
				<th class="result-header" style="width: 100px;">Hymmnos</td>
				<th class="result-header" style="width: 170px;">Meaning</td>
				<th class="result-header" style="width: 150px;">Kana</td>
				<th class="result-header" style="width: 240px;">School</td>
			</tr>
			<?php
				if($stmt->num_rows > 0){
					$stmt->bind_result($word, $meaning_english, $kana, $school);
					
					while($stmt->fetch()){
						echo '<tr>';
							echo "<td class=\"result-cell result-school-$school\" style=\"width: 100px;\">";
								echo "<a href=\"javascript:popUp('/hymmnoserver/word.php?word=$word')\">$word</a>";
							echo '</td>';
							echo "<td class=\"result-cell result-school-$school\" style=\"width: 200px;\">$meaning_english</td>";
							echo "<td class=\"result-cell result-school-$school\" style=\"width: 140px;\">$kana</td>";
							echo "<td class=\"result-cell result-school-$school\" style=\"width: 200px;\">";
								switch($school){
									case 1:
										echo '中央正純律（共通語）';
										break;
									case 2:
										echo 'クルトシエール律（Ⅰ紀前古代語）';
										break;
									case 3:
										echo 'クラスタ律（クラスタ地方語）';
										break;
									case 4:
										echo 'アルファ律（オリジンスペル）';
										break;
									case 5:
										echo '古メタファルス律（Ⅰ紀神聖語）';
										break;
									case 6:
										echo '新約パスタリエ（パスタリア成語）';
										break;
									case 7:
										echo 'アルファ律（オリジンスペル：EOLIA属）';
										break;
								}
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
