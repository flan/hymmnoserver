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
        <title>Hymmnoserver - Word</title>
        <?php include 'common/resources.xml'; ?>
    </head>
    <body style="width: 500px;">
        <?php
            $word = '';
            if(isset($_REQUEST['word'])){
                $word = trim($_REQUEST['word']);
            }
            if($word == ''){
                echo 'No word specified.';
                exit();
            }
            $dialect = '';
            if(isset($_REQUEST['dialect'])){
                $dialect = trim($_REQUEST['dialect']);
            }
            if($dialect == '' || !is_numeric($dialect)){
                echo 'No dialect specified.';
                exit();
            }
            $dialect = intval($dialect);
            
            try {
                require 'database/db.php';
            } catch (Exception $e) {
                die('Failed to connect to database: '.htmlentities($e->getMessage()));
            }
            
            //Read the requested word from the database.
            $stmt = $db->prepare('SELECT word, meaning, japanese, kana, dialect, romaji, description, class FROM hymmnos WHERE word = :word AND dialect = :dialect LIMIT 1');
            $stmt->bindValue(':word', $word, SQLITE3_TEXT);
            $stmt->bindValue(':dialect', $dialect, SQLITE3_INTEGER);
            $stmt_result = $stmt->execute();
            
            $matched = $stmt_result->numColumns() && $stmt_result->columnType(0) != SQLITE3_NULL;
            if(matched){
                $stmt_result_row = $stmt_result->fetchArray(SQLITE3_ASSOC);
                $word = $stmt_result_row['word'];
                $meaning = $stmt_result_row['meaning'];
                $japanese = $stmt_result_row['japanese'];
                $kana = $stmt_result_row['kana'];
                $dialect = $stmt_result_row['dialect'];
                $romaji = $stmt_result_row['romaji'];
                $notes = $stmt_result_row['description'];
                $class = $stmt_result_row['class'];
            }
            $stmt->close();
            if(!matched) {
                die('Unknown word specified');
            }
            
            
            //Read all related words from the database.
            $stmt = $db->prepare('SELECT destination, destination_dialect FROM hymmnos_mapping WHERE source = :source AND source_dialect = :source_dialect ORDER BY destination ASC, destination_dialect ASC');
            $stmt->bindValue(':source', $word, SQLITE3_TEXT);
            $stmt->bindValue(':source_dialect', $dialect, SQLITE3_INTEGER);
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
            
            $db->close();
            
            include 'common/word.php';
            renderWord($word, $class, $meaning, $romaji, $japanese, $kana, $dialect, $notes, $links);
            
            $footer_word = true;
            include 'common/footer.xml';
        ?> 
    </body>
</html>
