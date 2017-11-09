<?php
    header('Content-Type: text/html; charset=utf-8');
    try {
    $dbh = new PDO('データベース名', 'ユーザー名', 'パスワード');
    if(!$dbh){
        echo "接続できません。<br>".mysql_error();
    }else{
        echo "接続できました。<br>";
    }
    $data = 'SELECT * FROM board';
    $res = $dbh->query($data);
    if($res){
        echo "成功です。<br>";
        while($row = $res->fetch(PDO::FETCH_ASSOC)) {
            echo $row["id"] . $row["name"] . $row["comment"] . $row["create_datetime"] . $row["password"] . "<br>";
        }
    }else{
        echo "失敗です。<br>".mysql_error();
    }
    } catch (PDOException $e) {
        print "エラーです。<br>" . $e->getMessage();
        die();
    }
?>
