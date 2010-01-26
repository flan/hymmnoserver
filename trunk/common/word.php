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
		
		$html_word = htmlentities($word, ENT_COMPAT, "UTF-8");
		echo '<table style="width: 100%; border-width: 0px;">';
			echo '<tr>';
				echo '<td class=\"word-header word-header-'.$class.'\">';
					echo '<span class=\"word-text-title\">'.$html_word.'</span>';
					echo '<br/>';
					echo '<span class=\"word-text-subtitle\">'.$html_word.'</span>';
				echo '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td class=\"word-header word-header-'.$class.'\">';
					echo '<span class=\"word-text-title-expanded\">'.htmlentities($meaning, ENT_COMPAT, "UTF-8").' ['.htmlentities($romaji, ENT_COMPAT, "UTF-8").']';
						echo '<br/>';
					echo htmlentities($japanese, ENT_COMPAT, "UTF-8").' ['.htmlentities($kana, ENT_COMPAT, "UTF-8").']</span>';
				echo '</td>';
			echo '</tr>';
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
						$links_rendered = array();
						for($i = 0; $i < $links_size; $i++){
							list($link, $link_dialect) = $links[$i];
							$html_link = htmlentities($link, ENT_COMPAT, "UTF-8");
							if($search_mode){
								$links_rendered[] = '<a href="javascript:popUpWord(\''.$html_link.'\', '.$link_dialect.')">'.$html_link.'</a>';
							}else{
								$links_rendered[] = '<a href="./word.php?'.
									htmlentities(http_build_query(array(
									 'word' => $link,
									 'dialect' => $link_dialect
									)), ENT_COMPAT, "UTF-8").
									'">'.$html_link.'</a>';
							}
						}
						echo implode(', ', $links_rendered);
					}else{
						echo 'No related Hymmnos';
					}
				echo '</td>';
			echo '</tr>';
			echo '<tr class="word-text-related-description">';
				echo '<td class="word-info-title">Notes</td>';
				echo '<td class="word-info">';
					echo htmlentities($notes, ENT_COMPAT, "UTF-8");
				echo '</td>';
			echo '</tr>';
		echo '</table>';
	}
?>
