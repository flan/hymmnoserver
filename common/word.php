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
	include 'common/constants.php';
	
	function renderWord($word, $class, $meaning, $romaji, $japanese, $kana, $dialect, $notes, $links){
		global $DIALECT;
		global $SYNTAX_CLASS_FULL;
		
		$html_word = htmlspecialchars($word);
		echo '<table style="width: 100%; border-width: 0px;">';
			echo "<tr>";
				echo "<td class=\"word-header word-header-$class\">";
					echo "<span class=\"word-text-title\">$html_word</span>";
					echo "<br/>";
					echo "<span class=\"word-text-subtitle\">$html_word</span>";
				echo "</td>";
			echo "</tr>";
			echo "<tr>";
				echo "<td class=\"word-header word-header-$class\">";
					echo "<span class=\"word-text-title-expanded\">$meaning [$romaji]";
						echo "<br/>";
					echo "$japanese [$kana]</span>";
				echo "</td>";
			echo "</tr>";
		echo '</table>';
		echo '<table style="width: 100%; border-width: 0px;">';
			echo '<tr class="word-text-dialect-usage">';
				echo '<td class="word-info-title">Dialect</td>';
				echo '<td class="word-info">';
					echo '<span style="font-weight: bold;">';
						echo $DIALECT[$dialect];
					echo '</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr class="word-text-dialect-usage">';
				echo '<td class="word-info-title">Usage</td>';
				echo '<td class="word-info">';
					echo '<span style="font-weight: bold;">';
						echo $SYNTAX_CLASS_FULL[$class];
					echo '</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr class="word-text-related-description">';
				echo '<td class="word-info-title">Related Hymmnos</td>';
				echo '<td class="word-info">';
					$links_size = count($links);
					if($links_size > 0){#Render all related hymmnos, delimited by commas.
						for($i = 0; $i < $links_size; $i++){
							list($link, $link_dialect) = $links[$i];
							$html_link = htmlspecialchars($link);
							if($search_mode){
								echo "<a href=\"javascript:popUpWord('$html_link', $link_dialect)\">$html_link</a>";
							}else{
								echo "<a href=\"./word.php?word=$html_link&dialect=$link_dialect\">$html_link</a>";
							} 
							
							if($i + 1 < $links_size){
								echo ", ";
							}
						}
					}else{
						echo 'No related Hymmnos';
					}
				echo '</td>';
			echo '</tr>';
			echo '<tr class="word-text-related-description">';
				echo '<td class="word-info-title">Notes</td>';
				echo '<td class="word-info">';
					echo htmlentities($notes);
				echo '</td>';
			echo '</tr>';
		echo '</table>';
	}
?>

