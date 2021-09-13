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
        
        $results = array();
        while(true){
            $stmt_result_row = $stmt_result->fetchArray(SQLITE3_ASSOC);
            if($stmt_result_row == false){
                break;
            }
            $results[] = $stmt_result_row;
        }
        $stmt->close();
        
        if(count($results) > 0){#There are results to display.
            echo '<div style="padding-bottom: 10px;">';
                echo '<span style="color: red; font-weight: bold;">'.$type.' ('.count($results).' record'.(count($results) != 1 ? 's' : '').')</span>';
                echo '<div style="padding-left: 13px;">';
                    include_once 'common/word.php';
                    foreach($results as $result){
                        #Read all related words from the database.
                        $stmt = $db->prepare('SELECT destination, destination_dialect FROM hymmnos_mapping WHERE source = :source AND source_dialect = :source_dialect ORDER BY destination ASC, destination_dialect ASC');
                        $stmt->bindValue(':source', $result['word'], SQLITE3_TEXT);
                        $stmt->bindValue(':source_dialect', $result['dialect'], SQLITE3_INTEGER);
                        $stmt_result = $stmt->execute();
                        
                        $links = array();
                        while(true){
                            $stmt_result_row = $stmt_result->fetchArray(SQLITE3_ASSOC);
                            if($stmt_result_row == false){
                                break;
                            }
                            
                            $links[] = array($stmt_result_row['destination'], $stmt_result_row['destination_dialect']);
                        }
                        
                        $stmt->close();
                        
                        renderWord(
                            $result['word'],
                            $result['class'],
                            $result['meaning'],
                            $result['romaji'],
                            $result['japanese'],
                            $result['kana'],
                            $result['dialect'],
                            $result['notes'],
                            $links
                        );
                    }
                echo '</div>';
            echo '</div>';
            
            return true;
        }
        
        return false;
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
