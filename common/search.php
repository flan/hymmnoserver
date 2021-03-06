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
	function renderMatches($qualifier, $quality, $type, $exact){
		global $mysql;
		global $DIALECT;
		global $SYNTAX_CLASS_FULL;
		
		$search_mode = true; #Used to make related words open in new windows.
		$operator = 'LIKE';
		if($exact){
			$operator = '=';
		}
		
		$stmt = $mysql->prepare('SELECT word, meaning, japanese, kana, dialect, romaji, description, class FROM hymmnos WHERE '.$qualifier.' '.$operator.' ? ORDER BY dialect ASC');
		$stmt->bind_param('s', $quality);
		$stmt->execute();
		$stmt->store_result();
		
		$matched = $stmt->num_rows > 0;
		if($matched){#There are results to display.
			$plural = '';
			if($stmt->num_rows != 1){
				$plural = 's';
			}
			echo '<div style="padding-bottom: 10px;">';
				echo '<span style="color: red; font-weight: bold;">'.$type.' ('.$stmt->num_rows.' record'.$plural.')</span>';
				echo '<div style="padding-left: 13px;">';
					$stmt->bind_result($word, $meaning, $japanese, $kana, $dialect, $romaji, $notes, $class);
					
					include_once 'common/word.php';
					while($stmt->fetch()){#Display every result.
						#Read all related words from the database.
						$stmt2 = $mysql->prepare('SELECT destination, destination_dialect FROM hymmnos_mapping WHERE source = ? AND source_dialect = ? ORDER BY destination ASC, destination_dialect ASC');
						$stmt2->bind_param('si', $word, $dialect);
						$stmt2->execute();
						$stmt2->store_result();
						
						$links = array();
						$stmt2->bind_result($link, $link_dialect);
						while($stmt2->fetch()){
							$links[] = array($link, $link_dialect);
						}
						
						$stmt2->free_result();
						$stmt2->close();
						
						renderWord($word, $class, $meaning, $romaji, $japanese, $kana, $dialect, $notes, $links);
					}
				echo '</div>';
			echo '</div>';
		}
		$stmt->free_result();
		$stmt->close();
		
		return $matched;
	}
	
	$matches = false; #Assume failure by default.
	
	if($_GET['exact'] == 'hymmnos'){#Look for exact Hymmnos matches.
		$matches = renderMatches('word', $words[0], 'Hymmnos matches', true);
	}else{#Render any matches found using any normal method.
		$word = $words[0].'%'; #Match anything starting with the query by default.
		
		$matches = renderMatches('word', $word, 'Hymmnos matches', false) || $matches;
		$matches = renderMatches('meaning', '%'.$word.'%', 'English matches', false) || $matches;
		$matches = renderMatches('romaji', $word, 'Romaji matches', false) || $matches;
		if(!$matches){#If none of the executed queries yeilded results, maybe the query is in kana.
			$matches = renderMatches('kana', $word, 'Kana matches', false);
		}
	}
	
	if(!$matches){
		echo '<span style="color: red; font-weight: bold;">No matches found</span>';
	}
?>
