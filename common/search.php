<?php/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009-2021
*/?>

<?php
    function renderMatches($qualifier, $quality, $type, $exact){
        global $db;
        global $DIALECT;
        global $SYNTAX_CLASS_FULL;
        
        $search_mode = true; #Used to make related words open in new windows.
        $operator = 'LIKE';
        if($exact){
            $operator = '=';
        }
        
        $stmt = $db->prepare('SELECT word, meaning, japanese, kana, dialect, romaji, description, class FROM hymmnos WHERE '.$qualifier.' '.$operator.' :value ORDER BY dialect ASC');
        $stmt->bindValue(':value', $quality, SQLITE3_TEXT);
        $stmt_result = $stmt->execute();
        
        $matched = $stmt_result->numColumns() && $stmt_result->columnType(0) != SQLITE3_NULL;
        if($matched){#There are results to display.
            echo '<div style="padding-bottom: 10px;">';
                echo '<span style="color: red; font-weight: bold;">'.$type.' ('.$stmt->num_rows.' records)</span>';
                echo '<div style="padding-left: 13px;">';
                    $stmt->bind_result($word, $meaning, $japanese, $kana, $dialect, $romaji, $notes, $class);
                    
                    include_once 'common/word.php';
                    while(true){#Display every result.
                        $stmt_result_row = $stmt_result->fetchArray(SQLITE3_ASSOC);
                        if($stmt_result_row == false){
                            break;
                        }
                        
                        #Read all related words from the database.
                        $stmt2 = $db->prepare('SELECT destination, destination_dialect FROM hymmnos_mapping WHERE source = :source AND source_dialect = :source_dialect ORDER BY destination ASC, destination_dialect ASC');
                        $stmt2->bindValue(':source', $stmt_result_row['word'], SQLITE3_TEXT);
                        $stmt2->bindValue(':source_dialect', $stmt_result_row['dialect'], SQLITE3_INTEGER);
                        $stmt2_result = $stmt2->execute();
                        
                        $links = array();
                        while(true){
                            $stmt2_result_row = $stmt2_result->fetchArray(SQLITE3_ASSOC);
                            if($stmt2_result_row == false){
                                break;
                            }
                            
                            $links[] = array($stmt2_result_row['destination'], $stmt2_result_row['destination_dialect']);
                        }
                        
                        $stmt2->close();
                        
                        renderWord(
                            $stmt_result_row['word'],
                            $stmt_result_row['class'],
                            $stmt_result_row['meaning'],
                            $stmt_result_row['romaji'],
                            $stmt_result_row['japanese'],
                            $stmt_result_row['kana'],
                            $stmt_result_row['dialect'],
                            $stmt_result_row['notes'],
                            $links
                        );
                    }
                echo '</div>';
            echo '</div>';
        }
        $stmt->close();
        
        return $matched;
    }
    
    $matched = false; #Assume failure by default.
    
    if($_GET['exact'] == 'hymmnos'){#Look for exact Hymmnos matches.
        $matched = renderMatches('word', $words[0], 'Hymmnos matches', true);
    }else{#Render any matches found using any normal method.
        $word = $words[0].'%'; #Match anything starting with the query by default.
        
        $matched = renderMatches('word', $word, 'Hymmnos matches', false) || $matched;
        $matched = renderMatches('meaning', '%'.$word.'%', 'English matches', false) || $matched;
        $matched = renderMatches('romaji', $word, 'Romaji matches', false) || $matched;
        if(!$matched){#If none of the executed queries yeilded results, maybe the query is in kana.
            $matched = renderMatches('kana', $word, 'Kana matches', false);
        }
    }
    
    if(!$matched){
        echo '<span style="color: red; font-weight: bold;">No matches found</span>';
    }
?>
