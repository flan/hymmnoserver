<?php
    header("Expires: Mon, 20 Dec 1998 01:00:00 GMT");
    header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php/*
All code, unless otherwise indicated, is original, and subject to the terms of
the GNU GPLv3 or, at your option, any later version of the GPL.

All content is derived from public domain, promotional, or otherwise-compatible
sources and published uniformly under the
Creative Commons Attribution-Share Alike 3.0 license.

See license.README for details.
 
(C) Neil Tallim, 2009-2021
*/?>

<?php include 'common/constants.php'; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Hymmnoserver - Main</title>
        <?php include 'common/resources.xml'; ?>
    </head>
    <body>
        <?php include 'common/header.xml'; ?>
        <div style="font-size: 0.90em; text-align: center;">
            <?php
                //Determine the nature of the requested display; default if unintelligible.
                $page = '';
                if(isset($_REQUEST['page'])){
                    $page = trim($_REQUEST['page']);
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
                $characters[] = '0';
                $sections = array();
                foreach($characters as $character){
                    $section = '<a href="./browse.php?page='.$character.'">';
                    if($character == $page){
                        $section .= '<span style="font-weight: bold; font-size: 1em;">'.$character.'</span>';
                    }else{
                        $section .= $character;
                    }
                    $sections[] = $section.'</a>';
                }
                echo implode(' / ', $sections);
                
                echo '<br/>';
                
                //Render the syntax class bar.
                $sections = array();
                $i = 0;
                foreach(array(
                 'E.S. (I)', 'E.S. (II)', 'E.S. (III)', 'E.V.',
                 'adj.', 'adv.', 'conj.', 'cnstr.', 'intj.', 'n.',
                 'prep.', 'pron.', 'prt.', 'v.'
                ) as $class){//Force an enumerable order from 1-14.
                    $i++;
                    $section = '<a href="./browse.php?page='.$i.'">';
                    if($i == $page){
                        $section .= '<span style="font-weight: bold; font-size: 1em;">'.$class.'</span>';
                    }else{
                        $section .= $class;
                    }
                    $sections[] = $section.'</a>';
                }
                echo implode(' / ', $sections);
            ?>
        </div>
        <hr/>
        <div>
            <span style="color: red; font-size: 0.8em;">
                <?php
                    try {
                        require 'database/db.php';
                    } catch (Exception $e) {
                        die('Failed to connect to database: '.htmlentities($e->getMessage()));
                    }
                    
                    if($page != '0'){//0 means all non-alpha-started entries.
                        if(is_numeric($page)){//Looking up records by syntax class.
                            $stmt = $db->prepare('SELECT word, meaning, kana, dialect, class FROM hymmnos WHERE class IN ('.implode(',', $SYNTAX_CLASS_REV[$page]).') ORDER BY word ASC');
                        }else{#Looking up records by starting letter.
                            $stmt = $db->prepare('SELECT word, meaning, kana, dialect, class FROM hymmnos WHERE word LIKE :letter ORDER BY word ASC');
                            $stmt->bindValue(':letter', $page.'%', SQLITE3_TEXT);
                        }
                    }else{//Get all non-alpha-started entries.
                        $stmt = $db->prepare("SELECT word, meaning, kana, dialect, class FROM hymmnos WHERE word RLIKE '^[^[:alpha:]].*'");
                    }
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
                    $db->close();
                    
                    printf('<b>%d record%s found</b>', count($results), count($results) != 1 ? 's' : '');
                ?>
                (Hymmnos entries will open in a popup window)
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
                if(count($results) > 0){//Render results only if there are results.
                    foreach($results as $result){
                        $dialect = $result['dialect'];
                        $html_word = htmlentities($result['word'], ENT_COMPAT, "UTF-8");
                        echo '<tr>';
                            echo '<td class="result-cell result-dialect-'.$dialect.'">';
                                echo '<a href="javascript:popUpWord(\''.$html_word.'\', '.$dialect.')">'.$html_word.'</a>';
                            echo '</td>';
                            echo '<td class="result-cell result-dialect-'.$dialect.'">'.htmlentities($result['meaning'], ENT_COMPAT, "UTF-8").'</td>';
                            echo '<td class="result-cell result-dialect-'.$dialect.'">';
                                echo $SYNTAX_CLASS[$result['class']];
                            echo '</td>';
                            echo '<td class="result-cell result-dialect-'.$dialect.'">'.htmlentities($result['kana'], ENT_COMPAT, "UTF-8").'</td>';
                            echo '<td class="result-cell result-dialect-'.$dialect.'">';
                                echo $DIALECT[$dialect];
                            echo '</td>';
                        echo '</tr>';
                    }
                }else{
                    echo '<tr><td colspan="5" style="color: red; font-weight: bold; text-align: center;">No records found</td></tr>';
                }
            ?>
        </table>
        <?php include 'common/footer.xml'; ?> 
    </body>
</html>
