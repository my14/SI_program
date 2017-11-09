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
    $date = getdate();
    $data = "INSERT INTO board (id,name,comment,create_datetime,password)VALUES('0','name0','comment0','" . $date . "','pass')";
    $res = mysql_query($data,$link);
    if($res){
        echo "成功しました。<br>".mysql_error();
    }else{
        echo "失敗しました。<br>".mysql_error();
    }
    mysql_close($link);
?>