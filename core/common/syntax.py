<?php
	#Set up constants required for processing.
	$EMOTION_VOWELS = 'A|I|U|E|O|N|YA|YI|YU|YE|YO|YN|LYA|LYI|LYU|LYE|LYO|LYN';
	$EMOTION_VOWELS_REGEXP = '('.$EMOTION_VOWELS.')';
	$EMOTION_VOWELS_REGEXP_FULL = '('.$EMOTION_VOWELS.'|\.)?';
	
	#Read all Emotion Verbs from the database.
	$emotion_verbs = array();
	$stmt = $mysql->prepare("SELECT word FROM hymmnos WHERE class = 1");
	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result($word);
	while($stmt->fetch()){
		#Store the Emotion Verb, the number of Emotion Vowels, and a regexp version.
		array_push($emotion_verbs, array('/^'.str_replace('.', $EMOTION_VOWELS_REGEXP_FULL, $word).'(eh)?$/', substr_count($word, '.'), $word));
	}
	$stmt->free_result();
	$stmt->close();
	
	#Read the definition of every provided word and construct the displayable Hymmnos string.
	$word_list = array();
	for($i = 0; $i < count($words); $i++){
		$word = readWord($words[$i]);
		$words[$i] = $word;
		array_push($word_list, decorateWord($word[0], $word[3], $word[5], false));
	}
	$word_string = implode(" ", $word_list);
	$word_list = NULL;
	
	#Read a word from the database; Emotion Verbs and Emotion Vowel-prefixed words are detected.
	function readWord($word){
		$emotion_verb = processEmotionVerb($word);
		if($emotion_verb != NULL){
			return $emotion_verb;
		}
		$emotion_word = processEmotionWord($word);
		if($emotion_word != NULL){
			return $emotion_word;
		}
		return queryWord($word);
	}
	
	#Read a word from the database.
	#Return format: [word, english, kana, class, dialect, decorations, hits]
	function queryWord($word){
		$result = NULL;
		
		global $mysql;
		$stmt = $mysql->prepare("SELECT word, meaning_english, kana, class, school FROM hymmnos WHERE word = ? ORDER BY school ASC");
		$stmt->bind_param("s", $word);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows > 0){
			$stmt->bind_result($r_word, $english, $kana, $class, $dialect);
			$stmt->fetch();
			$result = array($r_word, $english, $kana, $class, $dialect, NULL, $stmt->num_rows);
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
							array_push($matches, '.');
						}
						array_push($matches, ''); 
					}
					$decorations = array();
					foreach(array_slice($matches, 1, -1) as $decoration){
						if($decoration == NULL){
							array_push($decorations, '.');
						}else{
							array_push($decorations, $decoration);
						}
					}
					array_push($decorations, $matches[count($matches) - 1]);
					$d_word[5] = $decorations;
					return $d_word;
				}
			}
		}
		return NULL;
	}
	
	#Determine whether a word is an Emotion Vowel-prefixed word; if so, read it from the database.
	#Return format: [word, english, kana, class, dialect, decorations, hits] | NULL
	function processEmotionWord($word){
		global $EMOTION_VOWELS_REGEXP;
		
		if(preg_match("/^$EMOTION_VOWELS_REGEXP(.+)$/", $word, $matches)){
			$d_word = queryWord($matches[2]);
			if($d_word[3] > 0){#Match found.
				$d_word[5] = array($matches[1]);
				return $d_word;
			}
		}
		return NULL;
	}
	
	#Insert Emotion Vowels or blanks into Emotion Verbs or prefix other words.
	function decorateWord($word, $class, $decorations, $colour){
		if($decorations == NULL){
			return htmlspecialchars($word);
		}
		
		if($class == 1){#Emotion Verb
			$result = '';
			$chunks = split('\.', $word);
			$i = 0;
			foreach(array_slice($decorations, 0, -1) as $vowel){
				$result = $result.htmlspecialchars($chunks[$i]);
				if($colour){
					$result = $result."<span style=\"color: #FFD700;\">".htmlspecialchars($vowel)."</span>";
				}else{
					$result = $result.htmlspecialchars($vowel);
				}
				$i++;
			}
			if(!empty($decorations[count($decorations) - 1])){
				if($colour){
					return $result."<span style=\"color: #FF00FF;\">".htmlspecialchars($decorations[count($decorations) - 1])."</span>";
				}else{
					return $result.htmlspecialchars($decorations[count($decorations) - 1]);
				}
			}else{
				return $result;
			}
		}
		
		global $NOUNS;
		global $ADJECTIVES;
		if(in_array($class, $NOUNS) || in_array($class, $ADJECTIVES)){#noun/adj
			if($colour){
				return "<span style=\"color: #FFD700;\">".$decorations[0]."</span>".htmlspecialchars($word);
			}else{
				return $decorations[0].$word;
			}
		}
	}
	
	#Renders a single word in the output table.
	#Return format: true if this word has alternative entries.
	function renderWord($word){
		global $SYNTAX_CLASS;
		
		list($l_word, $english, $kana, $class, $dialect, $decorations, $hits) = $word;
		$base_word = htmlspecialchars($l_word);
		if($hits == 0){
			$english = '???';
			$kana = '???';
		}else{
			$l_word = "<a href=\"javascript:popUpWord('$base_word', $dialect)\" style=\"color: white;\">".decorateWord($l_word, $class, $decorations, true)."</a>";
		}
		
		echo "<tr>";
			echo "<td class=\"word-header-$class\" style=\"width: 17%;\">$l_word</td>";
			echo "<td class=\"word-header-$class\" style=\"width: 14%;\">$SYNTAX_CLASS[$class]</td>";
			echo "<td class=\"word-header-$class\" style=\"width: 50%;\">$english</td>";
			echo "<td class=\"word-header-$class\" style=\"width: 19%;\">$kana</td>";
		echo "</tr>";
		
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
					array_push($alternatives, $word_c);
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
			$alternatives[$alternatives_pos++] = "<a href=\"/hymmnoserver/search.php?word=".urlencode($alternative)."&exact=hymmnos\" style=\"color: white;\">".htmlspecialchars($alternative)."</a>";
		}
		if($alternatives_pos > 0){
			echo "<tr>";
				echo "<td style=\"color: white; background: black; font-size: 0.85em;\">";
					echo "Words with alternative meanings: ".implode(", ", $alternatives);
				echo "</td>";
			echo "</tr>";
		}
	?>
	<tr>
		<td style="color: #00008B; text-align: right; background: #D3D3D3; font-size: 0.7em;">
			<?php
				$query_encode = urlencode($query);
				echo "If this is a sentence, you may <a href=\"/hymmnoserver/grammar.psp?query=$query_encode\">inspect its structure</a>";
			?>
		</td>
	</tr>
</table>
<hr/>
<div style="color: #808080; font-size: 0.6em;">
	<?php
		if($alternatives_pos > 0){
			echo "<p style=\"color: black;\">Please make note of the words identified as having alternate meanings. In particular, consider that Pastalia forms typically take precedence when other Pastalia words are present.</p>";
		}
	?>
	<p>
		There is no difference between singular and plural nouns, unless implied by context:
		&quot;wart&quot;, for example, can mean either &quot;word&quot; or &quot;words&quot;,
		depending on which is more appropriate.<br/>
	</p>
	<p>
		The presented kana does not take Emotion Vowels into consideration.
	</p>
</div>

#If alternative words in other dialects could have been used instead,
#render all permutations at the bottom of the output.
#Format: word$dialect, like "tie$6", to indicate which variant to use.