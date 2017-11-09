<?php
    header('Content-Type: text/html; charset=utf-8');
    $link = mysql_connect('データベース名','ユーザー名','パスワード');
    if(!$link){
        echo "接続できません。<br>".mysql_error();
    }else{
        echo "接続できました。<br>";
    }
    $db_selected = mysql_select_db('データベース名',$link);
    if(!$db_selected){
        echo "can't use.<br>";
    }else{
        echo "can use.<br>";
    }
    mysql_set_charset('utf8');
    $data = getdate();
    $sql="UPDATE board SET name='board1',comment='board1',create_datetime='".$date."' WHERE id=1";
    if(mysql_query($sql,$link)){
        echo "テーブルの更新。<br>";
    }else{
        echo "テーブルの更新ができません。<br>";
    }
    mysql_close($link);
?>
