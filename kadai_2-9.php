<?php
    header('Content-Type: text/html; charset=utf-8');
    try {
        $dbh = new PDO('データベース名', 'ユーザー名', 'パスワード');
        foreach($dbh->query('SHOW TABLES FROM データベース名') as $row) {
            echo "Table: {$row[0]}<br>";
        }
        $dbh = null;
    } catch (PDOException $e) {
        print "エラーです。" . $e->getMessage() . "<br/>";
        die();
    }
?>
