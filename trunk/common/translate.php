<?php/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009
*/?>

<?php
	#Set up constants required for processing.
	$EMOTION_VOWELS = 'A|I|U|E|O|N|YA|YI|YU|YE|YO|YN|LYA|LYI|LYU|LYE|LYO|LYN';
	$EMOTION_VOWELS_REGEXP = '('.$EMOTION_VOWELS.')';
	$EMOTION_VOWELS_REGEXP_FULL = '('.$EMOTION_VOWELS.'|\.)?';
	$WORD_STRUCTURE = "/^".$EMOTION_VOWELS_REGEXP."?(.+?)(_\w+)?$/";
	
	$NOUNS = array(4, 9, 10, 15, 19);
	$ADJECTIVES = array(8, 10, 11, 17, 20, 7);
	
	#Read all Emotion Verbs from the database.
	$emotion_verbs = array();
	$stmt = $mysql->prepare("SELECT word FROM hymmnos WHERE class = 1");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($word);
	while($stmt->fetch()){
		#Store the Emotion Verb, the number of Emotion Vowels, and a regexp version.
		$emotion_verbs[] = array(
		 '/^'.str_replace('.', $EMOTION_VOWELS_REGEXP_FULL, $word).'(eh|aye|za)?$/',
		 substr_count($word, '.'),
		 $word,
		);
	}
	$stmt->free_result();
	$stmt->close();
	
	#Read the definition of every provided word and construct the displayable Hymmnos string.
	$word_list = array();
	for($i = 0; $i < count($words); $i++){
		$word = readWord($words[$i]);
		$words[$i] = $word;
		$word_list[] = decorateWord($word[0], $word[3], $word[5], false);
	}
	$word_string = implode(' ', $word_list);
	$word_list = NULL;
	
	#Read a word from the database; Emotion Verbs and Emotion Vowel-prefixed words are detected.
	function readWord($word){
		$emotion_verb = processEmotionVerb($word);
		if(!is_null($emotion_verb)){
			return $emotion_verb;
		}
		return processWord($word);
	}
	
	#Read a word from the database.
	#Return format: [word, english, kana, class, dialect, decorations, hits]
	function queryWord($word){
		$result = NULL;
		
		global $mysql;
		$stmt = $mysql->prepare('SELECT word, meaning, kana, class, dialect FROM hymmnos WHERE word = ? ORDER BY dialect ASC');
		$stmt->bind_param('s', $word);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows > 0){
			$stmt->bind_result($r_word, $meaning, $kana, $class, $dialect);
			$stmt->fetch();
			$result = array($r_word, $meaning, $kana, $class, $dialect, NULL, $stmt->num_rows);
		}else{
			$result = array($word, NULL, NULL, 0, 0, NULL, 0);
		}
		$stmt->free_result();
		$stmt->close();
		
		return $result;
	}
	
	#Determine whether a word is an Emotion Verb; if so, read it from the database.
	#Return format: [word, english, kana, class, dialect, decorations, hits] | NULL
	function processEmotionVerb($word){
		global $emotion_verbs;
		
		foreach($emotion_verbs as $emotion_verb){
			if(preg_match($emotion_verb[0], $word, $matches)){#Match found.
				$d_word = queryWord($emotion_verb[2]);
				if($d_word[3] > 0){#Match found.
					if(count($matches) - 1 <= $emotion_verb[1]){#Work around a permanent PHP bug.
						for($i = $emotion_verb[1] - count($matches); $i > -1; $i--){
							$matches[] = '.';
						}
						$matches[] = '';
					}
					$decorations = array();
					foreach(array_slice($matches, 1, -1) as $decoration){
						if(is_null($decoration)){
							$decorations[] = '.';
						}else{
							$decorations[] = $decoration;
						}
					}
					$decorations[] = $matches[count($matches) - 1];
					$d_word[5] = $decorations;
					return $d_word;
				}
			}
		}
		return NULL;
	}
	
	#Determine whether a word is enhanced while reading it from the database.
	#Return format: [word, english, kana, class, dialect, decorations, hits] | NULL
	function processWord($word){
		global $WORD_STRUCTURE;
		
		preg_match($WORD_STRUCTURE, $word, $matches);
		$d_word = queryWord($matches[2]);
		if(!is_null($d_word[1])){//Make sure songs are hit.
			if(count($matches) >= 3){
				if(count($matches) == 4){//Suffix present.
					$d_word[5] = array($matches[1], $matches[3]);
				}else{
					$d_word[5] = array($matches[1], NULL);
				}
			}
		}else{
			$d_word = queryWord($word);
		}
		return $d_word;
	}
	
	#Insert Emotion Vowels or blanks into Emotion Verbs or prefix other words.
	function decorateWord($word, $class, $decorations, $colour){
		if(is_null($decorations)){
			return htmlentities($word, ENT_COMPAT, "UTF-8");
		}
		
		if($class == 1){#Emotion Verb
			$result = '';
			$chunks = split('\.', $word);
			$i = 0;
			foreach(array_slice($decorations, 0, -1) as $vowel){
				$result = $result.htmlspecialchars($chunks[$i]);
				if($colour){
					$result .= '<span style="color: #FFD700;">'.htmlentities($vowel, ENT_COMPAT, "UTF-8").'</span>';
				}else{
					$result .= htmlentities($vowel, ENT_COMPAT, "UTF-8");
				}
				$i++;
			}
			if(!empty($decorations[count($decorations) - 1])){
				if($colour){
					return $result.'<span style="color: #FF00FF;">'.htmlentities($decorations[count($decorations) - 1], ENT_COMPAT, "UTF-8").'</span>';
				}else{
					return $result.htmlentities($decorations[count($decorations) - 1], ENT_COMPAT, "UTF-8");
				}
			}else{
				return $result;
			}
		}
		
		global $NOUNS;
		global $ADJECTIVES;
		if(in_array($class, $NOUNS) || in_array($class, $ADJECTIVES)){#noun/adj
			if($colour){
				$result = '';
				if(!empty($decorations[0])){
					$result = '<span style="color: #F0D000;">'.$decorations[0].'</span>';
				}
				$result .= htmlentities($word, ENT_COMPAT, "UTF-8");
				if(!empty($decorations[1])){
					$result .= '<span style="color: #FF00FF;">'.$decorations[1].'</span>';
				}
				return $result;
			}else{
				return $decorations[0].$word.$decorations[1];
			}
		}
		
		return htmlentities($word, ENT_COMPAT, "UTF-8");
	}
	
	#Renders a single word in the output table.
	#Return format: true if this word has alternative entries.
	function renderWord($word){
		global $SYNTAX_CLASS;
		
		list($l_word, $meaning, $kana, $class, $dialect, $decorations, $hits) = $word;
		$base_word = htmlentities($l_word, ENT_COMPAT, "UTF-8");
		if($hits == 0){
			$meaning = '???';
			$kana = '???';
		}else{
			$l_word = '<a href="javascript:popUpWord(\''.$base_word.'\', '.$dialect.')" style="color: white;">'.decorateWord($l_word, $class, $decorations, true).'</a>';
		}
		
		echo '<tr>';
			echo '<td class="word-header-'.$class.'" style="width: 17%;">'.$l_word'.</td>';
			echo '<td class="word-header-'.$class.'" style="width: 14%;">'.$SYNTAX_CLASS[$class].'</td>';
			echo '<td class="word-header-'.$class.'" style="width: 50%;">'.htmlentities($meaning, ENT_COMPAT, "UTF-8").'</td>';
			echo '<td class="word-header-'.$class.'" style="width: 19%;">'.htmlentities($kana, ENT_COMPAT, "UTF-8").'</td>';
		echo '</tr>';
		
		return $hits > 1;
	}
	
	#Processes a list of words, rendering everything provided.
	#Return format: A list of all words with alternative entries.
	function renderWords($words){
		$alternatives = array();
		foreach($words as $word){
			if(renderWord($word)){
				$word_c = $word[0];
				if(!in_array($word_c, $alternatives)){
					$alternatives[] = $word_c;
				}
			}
		}
		return $alternatives;
	}
?>
<table style="border-collapse: collapse; border: 1px solid black; width: 100%;">
	<tr>
		<td style="color: #00008B; text-align: center; background: #D3D3D3;">
			<div style="font-family: hymmnos; font-size: 24pt;">
				<?php echo $word_string; ?>
			</div>
			<div style="font-size: 18pt;">
				<?php echo $word_string; ?>
			</div>
		</td>
	</tr>
	<tr>
		<td style="background: #808080; color: white;">
			<table style="width: 100%; border-spacing: 1px;">
				<?php
					$alternatives = renderWords($words);
				?>
			</table>
		</td>
	</tr>
	<?php
		$alternatives_pos = 0;
		foreach($alternatives as $alternative){
			$alternatives[$alternatives_pos++] = '<a href="./search.php?word='.urlencode($alternative).'&exact=hymmnos" style="color: white;">'.htmlspecialchars($alternative).'</a>';
		}
		if($alternatives_pos > 0){
			echo '<tr>';
				echo '<td style="color: white; background: black; font-size: 0.85em;">';
					echo 'Words with alternate meanings: '.implode(', ', $alternatives);
				echo '</td>';
			echo '</tr>';
		}
	?>
	<tr>
		<td style="color: #00008B; text-align: right; background: #D3D3D3; font-size: 0.7em;">
			<?php
				echo 'If this is a complete sentence, you may <a href="./grammar.py?query='.urlencode($query).'">inspect its structure</a>';
			?>
		</td>
	</tr>
</table>
<hr/>
<div style="color: #808080; font-size: 0.6em;">
	<?php
		if($alternatives_pos > 0){
			echo '<p style="color: black;">';
				echo 'Please make note of the words identified as having alternate meanings.';
				echo '<br/>';
				echo 'In particular, consider that Pastalia forms should typically take precedence when other Pastalia words are present.';
			echo '</p>';
		}
	?>
	<p>
		There is no difference between singular and plural nouns, unless implied by context:
		&quot;wart&quot;, for example, can mean either &quot;word&quot; or &quot;words&quot;,
		depending on which is more appropriate.<br/>
	</p>
	<p>
		The presented kana and meaning do <strong>not</strong> take Emotion Vowels into consideration.
	</p>
</div>
